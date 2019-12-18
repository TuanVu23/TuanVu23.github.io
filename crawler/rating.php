<?php
	header("Content-type: text/html; charset=utf-8");
	ini_set('max_execution_time', 600);
	require "simple_html_dom.php";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "test";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset($conn, 'UTF8');

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	function stripUnicode($str){
        if (!$str) return false;
        $unicode = array(
          ''=>'\!|\?|\.'
        );
        foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        return $str;
    }

	//moveek
	$url_sql = $conn->query("SELECT movie_id, url FROM movie WHERE type_id = 1");
	$url = array();
	while ($row = mysqli_fetch_assoc($url_sql)) {
		$key = $row['movie_id'];
		$url[$key] = $row['url'];
	}
	foreach ($url as $key => $value) {
		//break;
		$html = file_get_html($value);
		if ($html->find("div[class=col text-center text-sm-left] a",0)) {
			// $rating = trim($html->find("div[class=col text-center text-sm-left] a",0)->plaintext);
			// list($point, $pt) = explode("%", $rating);
			// $point = $point/10;
			$link = "https://moveek.com".$html->find("ul[class=nav nav-tabs border-bottom-0] li a",2)->href;
			$html1 = file_get_html($link);
			if ($html1->find("span[class=summary-rating-point font-weight-bold]",0) && $html1->find("span[class=summary-rating-total font-weight-bold]",0)) {
				$point = $html1->find("span[class=summary-rating-point font-weight-bold]",0)->plaintext;
				$vote = $html1->find("span[class=summary-rating-total font-weight-bold]",0)->plaintext;

				$sql = $conn->query("SELECT * FROM rating WHERE movie_id = '$key' AND source_id = 3");
				if (mysqli_num_rows($sql) == 0) {
					$conn->query("INSERT INTO rating (movie_id, source_id, point, vote) VALUES ('$key', '3', '$point', '$vote')");
					echo "insert source 3: ".$key."<br>";
				}
				else {
					$conn->query("UPDATE rating SET point = '$point', vote = '$vote' WHERE movie_id = '$key' AND source_id = 3");
					echo "update source 3: ".$key."<br>";
				}
			}			
		}
	}

	//get movie_name
	$movie_name = $conn->query("SELECT movie_id, name_vi, name_en FROM movie WHERE type_id = 1 ORDER BY movie_id DESC");
	$movie = array();
	while ($row = mysqli_fetch_assoc($movie_name)) {
		$key = $row['movie_id'];
		$movie[$key]['vi'] = $row['name_vi'];
		$movie[$key]['en'] = $row['name_en'];
 	}

	//galaxycine (source 6)
	$html = file_get_html("https://www.galaxycine.vn/phim-dang-chieu");
	$div = $html->find("div[id=tab_onshow]",0);
	foreach ($div->find("div[class=watchmovie-item]") as $element) {
		//break;
		$url = "https://www.galaxycine.vn".$element->find('a',0)->href;
		$html1 = file_get_html($url);

		if ($html1->find("div[class=rating-value detail] strong",0) && $html1->find("div[class=rating-view] span",0)) {
			$name_en = $html1->find("h2[class=detail-title upper-text]",0)->plaintext;
			$name_vi = $html1->find("h2[class=detail-title vn upper-text]",0)->plaintext;

			$movie_id = -1;
			foreach ($movie as $key => $value) {
				$array = explode(': ', $value['en']);
				if ((!empty($value['en']) && strpos(strtolower($name_en), strtolower(stripUnicode($value['en']))) !== false) || strpos($name_en, $value['vi']) !== false || (count($array) > 1 && (strpos($name_en, $array[0]) !== false || strpos($name_en, $array[1]) !== false))) {
					$movie_id = $key;
					break;
				}
			}
			if ($movie_id == -1) continue;

			$strpoint = $html1->find("div[class=rating-value detail] strong",0)->plaintext;
			list($a, $point, $b) = explode('"', $strpoint);
			$strvote = $html1->find("div[class=rating-view] span",0)->plaintext;
			list($a, $vote, $b) = explode('"', $strvote);

			$sql = $conn->query("SELECT * FROM rating WHERE movie_id = '$movie_id' AND source_id = 6");
			if (mysqli_num_rows($sql) == 0) {
				$conn->query("INSERT INTO rating (movie_id, source_id, point, vote) VALUES ('$movie_id', '6', '$point', '$vote')");
				echo "insert source 6: ".$movie_id."<br>";
			}
			else {
				$conn->query("UPDATE rating SET point = '$point', vote = '$vote' WHERE movie_id = '$movie_id' AND source_id = 6");
				echo "update source 6: ".$movie_id."<br>";
			}
		}
	}

	//123phim

	//imdb
	$movies = $conn->query("SELECT movie_id, name_en, imdb FROM movie where type_id = 1");
	while ($row = mysqli_fetch_assoc($movies)) {
		$rating = $row['imdb'];
		$movie_id = $row['movie_id'];

		if (!empty($row['name_en'])) {
			$name_en = $row['name_en'];
			$search = str_replace(' ', '+', $name_en);
			$url = "https://www.imdb.com/search/title/?title=".$search."&title_type=feature&sort=release_date,desc";

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_REFERER, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			$str = curl_exec($curl);
			curl_close($curl);
			// Create a DOM object
			$html = new simple_html_dom();
			// Load HTML from a string
			$html->load($str);

			if ($html->find("div[class=inline-block ratings-imdb-rating] strong",0)) {
				$rating = $html->find("div[class=inline-block ratings-imdb-rating] strong",0)->plaintext;
			}
		}		
		$conn->query("UPDATE movie SET imdb = '$rating' WHERE movie_id = '$movie_id'");
		echo 'update imdb '.$movie_id.': '.$rating.'<br>';
 	}

	$conn->close();
?>