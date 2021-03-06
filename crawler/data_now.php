<?php
	header("Content-type: text/html; charset=utf-8");
	ini_set('max_execution_time', 300);
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

	function stripUnicode($string){
	    if (!$string) return false;
	    $unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|&#225;|&#224;|&#227;|&#193;|&#192;|&#195;',
			'd'=>'đ|Đ|&#273;|&#272;',
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|&#233;|&#232;|&#200;|&#201;',
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị|&#237;|&#236;|&#297;|&#296;',
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|&#243;|&#242;|&#245;|&#211;|&#210;|&#213;',
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|&#250;|&#249;|&#361;|&#360;|&#217;|&#218;',
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ|&#253;|&#221;'   
	    );
	    foreach($unicode as $nonUnicode=>$uni) $string = preg_replace("/($uni)/i",$nonUnicode,$string);
	    return $string;
	}

	//get current movie
	$movie = $conn->query("SELECT movie_id, url FROM movie WHERE type_id = 1");
	$rowmovie = array();
	while ($row = mysqli_fetch_assoc($movie)) {
		$i = $row['movie_id'];
		$rowmovie[$i] = $row['url'];
	}

	//get comming soon movie
	$soon = $conn->query("SELECT movie_id, url FROM movie WHERE type_id = 3 ORDER BY release_date ASC");
	$soonmovie = array();
	while ($row = mysqli_fetch_assoc($soon)) {
		$j = $row['movie_id'];
		$soonmovie[$j] = $row['url'];
	}

	//get old movie
	$old = $conn->query("SELECT movie_id, url FROM movie WHERE type_id = 2 ORDER BY release_date DESC");
	$oldmovie = array();
	while ($row = mysqli_fetch_assoc($old)) {
		$k = $row['movie_id'];
		$oldmovie[$k] = $row['url'];
	}

	//film in moveek
	$html = file_get_html("https://moveek.com/dang-chieu/");
	$base = "https://moveek.com";
	foreach ($html->find("h3[class=text-truncate h4 mb-1]") as $element) {
		$url = $base.$element->find('a',0)->href;	

		//check current
		$key = array_search($url, $rowmovie);
		if ($key !== FALSE) {
			unset($rowmovie[$key]);
		}			
		//$result = $conn->query("SELECT * FROM movie WHERE url ='$url'");
		else {
			//check soon
			$keyy = array_search($url, $soonmovie);
			if ($keyy !== FALSE) {
				$conn->query("UPDATE movie SET type_id = 1 WHERE movie_id = '$keyy'");
				echo "change type ".$keyy."<br>";
				continue;
			}

			//check old
			$keyyy = array_search($url, $oldmovie);
			if ($keyyy !== FALSE) {
				$conn->query("UPDATE movie SET type_id = 1 WHERE movie_id = '$keyyy'");
				echo "Change old ".$keyyy."<br>";
				continue;
			}
			
			$html1 = file_get_html($url);

			$name_vi = $html1->find("h1[class=mb-0 text-truncate] a",0)->plaintext;
			$name_vi = trim($name_vi);

			$name_search = stripUnicode($name_vi);

			$txt = $html1->find("p[class=mb-0 text-muted text-truncate]",0)->plaintext;
			list($name_en, $gen) = explode(" - ", $txt);
			$name_en = trim($name_en);

			$genres = explode(", ", trim($gen));

			$poster = $html1->find("div[class=d-none d-sm-block col-2] img",0)->attr['data-src'];

			if ($desc = $html1->find("p[class=mb-3 text-justify]",0)) {
				$desc = $html1->find("p[class=mb-3 text-justify]",0)->plaintext;
			}
			else{
				$desc = '';
			}

			$str = $html1->find("div[class=col text-center text-sm-left]",0);			
			if ($str->find('a',0)) {
				$strdate = $html1->find("div[class=col text-center text-sm-left]",1)->find('span',1)->plaintext;;
			}
			else{
				$strdate = $str->find('span',1)->plaintext;
			}
			list($d, $m, $y) = explode("/", trim($strdate));
			$date = $y.'-'.$m.'-'.$d;

			$dur = ' ';
			if ($str->find('a',0)) {
				if ($html1->find("div[class=col text-center text-sm-left]",2)) {
					$dur = $html1->find("div[class=col text-center text-sm-left]",2)->find('span',1)->plaintext;
				}
			}
			else {
				if ($html1->find("div[class=col text-center text-sm-left]",1)) {
					$dur = $html1->find("div[class=col text-center text-sm-left]",1)->find('span',1)->plaintext;
				}
			}			
			list($duration, $phut) = explode(" ", $dur);
			$duration = (int) $duration;

			$rated = $html1->find("div[class=col text-center text-sm-left]",-1)->find('span',1)->plaintext;
			switch (trim($rated)) {
				case 'P':
					$rated_id = 1;
					break;
				case 'NC13':
					$rated_id = 2;
					break;
				case 'NC16':
					$rated_id = 3;
					break;
				case 'NC18':
					$rated_id = 4;
					break;
				default:
					$rated_id = 0;
					break;
			}

			if($html1->find("div[class=js-video youtube widescreen mb-4] iframe",0)){
				$trailer = $html1->find("div[class=js-video youtube widescreen mb-4] iframe",0)->src;
			}
			else{
				$trailer = '';
			}

			$type_id = 1;

			//insert movie
			$sql = "INSERT INTO movie (name_vi, name_en, poster, description, release_date, duration, rated_id, trailer, url, type_id, name_search) VALUES ('$name_vi', '$name_en', '$poster', '$desc', '$date', '$duration', '$rated_id', '$trailer', '$url', '$type_id', '$name_search')";
			if ($conn->query($sql) === TRUE){
				echo "New movie: ".$name_vi."<br>";
			}
			else{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$moviesql = $conn->query("SELECT movie_id FROM movie WHERE url = '$url'");
			$row = mysqli_fetch_assoc($moviesql);
			$movie_id = $row['movie_id'];

			if($html1->find("p[class=mb-2]",1)){
				//insert actor
				foreach($html1->find("p[class=mb-2]",0)->find('span a') as $element){
					$actor = $element->plaintext;
					$rows = $conn->query("SELECT actor_id FROM actor WHERE name = '$actor'");
					if(mysqli_num_rows($rows) == 0){
						$conn->query("INSERT INTO actor (name) VALUES ('$actor')");
						$actorsql = $conn->query("SELECT actor_id FROM actor WHERE name = '$actor'");
						$rowactor = mysqli_fetch_assoc($actorsql);
						$actor_id = $rowactor['actor_id'];
						$conn->query("INSERT INTO movie_actor (movie_id, actor_id) VALUES ('$movie_id', '$actor_id')");
					}
					else{
						$rowactor = mysqli_fetch_assoc($rows);
						$actor_id = $rowactor['actor_id'];
						$conn->query("INSERT INTO movie_actor (movie_id, actor_id) VALUES ('$movie_id', '$actor_id')");
					}
				}

				//insert director			
				foreach($html1->find("p[class=mb-2]",1)->find('span a') as $element){
					$director = $element->plaintext;
					$rows = $conn->query("SELECT director_id FROM director WHERE name = '$director'");
					if(mysqli_num_rows($rows) == 0){
						$conn->query("INSERT INTO director (name) VALUES ('$director')");
						$directorsql = $conn->query("SELECT director_id FROM director WHERE name = '$director'");
						$rowdirector = mysqli_fetch_assoc($directorsql);
						$director_id = $rowdirector['director_id'];
						$conn->query("INSERT INTO movie_director (movie_id, director_id) VALUES ('$movie_id', '$director_id')");
					}
					else{
						$rowdirector = mysqli_fetch_assoc($rows);
						$director_id = $rowdirector['director_id'];
						$conn->query("INSERT INTO movie_director (movie_id, director_id) VALUES ('$movie_id', '$director_id')");
					}
				}
			}
			
			//insert genre
			foreach ($genres as $genre) {
				$rows = $conn->query("SELECT genre_id FROM genre WHERE name = '$genre'");
				if(mysqli_num_rows($rows) != 0){
					$rowgenre = mysqli_fetch_assoc($rows);
					$genre_id = $rowgenre['genre_id'];
					$conn->query("INSERT INTO movie_genre (movie_id, genre_id) VALUES ('$movie_id', '$genre_id')");
				}	
			}
		}
	}

	//update type of old movie
	if(count($rowmovie) > 0){
		foreach ($rowmovie as $key => $value) {
			$conn->query("UPDATE movie SET type_id = 2 WHERE movie_id = '$key'");
			echo "Updated type_id ".$key."<br>";
		}
	}

	$conn->close();
?>