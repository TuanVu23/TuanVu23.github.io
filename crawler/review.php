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

	//chuyen ve khong dau
	function stripUnicode($str){
        if (!$str) return false;
        $unicode = array(
          'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|&#225;|&#224;|&#227;|&#193;|&#192;|&#195;',
          'd'=>'đ|Đ|&#273;|&#272;',
          'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|&#233;|&#232;|&#200;|&#201;',
          'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị|&#237;|&#236;|&#297;|&#296;',
          'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|&#243;|&#242;|&#245;|&#211;|&#210;|&#213;',
          'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|&#250;|&#249;|&#361;|&#360;|&#217;|&#218;',
          'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ|&#253;|&#221;',
          ''=>'\!|\?|\.'
        );
        foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        return $str;
    }

	//get movie_name
	  //chuan bi sua (khi co task -> lay phim dang chieu)
    $movie_name = $conn->query("SELECT movie_id, name_vi, name_en FROM movie WHERE type_id = 1");
	//$movie_name = $conn->query("SELECT movie_id, name_vi, name_en FROM movie");
	$movie = array();
	while ($row = mysqli_fetch_assoc($movie_name)) {
		$key = $row['movie_id'];
		$movie[$key]['vi'] = $row['name_vi'];
		$movie[$key]['en'] = $row['name_en'];
 	}

	//khenphim.com
	  //get current review (check duplicate)
 	$review_url = $conn->query("SELECT url FROM review WHERE source_id = 1 ORDER BY time DESC LIMIT 12");
	$review1 = array();
	$i = 0;
	while ($row = mysqli_fetch_assoc($review_url)) {
		$review1[$i] = $row['url'];
		$i++;
	}

	$html = file_get_html("https://khenphim.com/review-phim/");

	foreach ($html->find("article[class=item-list tie_thumb]") as $element) {
		//break;
		$url = $element->find("h2 a",0)->href;

		if (in_array($url, $review1)) continue;

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
		$html1 = new simple_html_dom();
		// Load HTML from a string
		$html1->load($str);

		if (!empty($html1)) {
			$title = $element->find("h2 a",0)->plaintext;

			$head = $html1->find("div[class=entry] h2",0)->plaintext;
			$header = $head;
			if (strlen($head) < 60) {
				$header = $html1->find("div[class=entry] p[style=text-align: justify;]",0)->plaintext;
			}

			$movie_id = -1;
			foreach ($movie as $key => $value) {
				$array = explode(': ', $value['vi']);
				if (strpos($title, $value['vi']) !== false || (!empty($value['en']) && (strpos($header, $value['en']) !== false || strpos($title, $value['en']) !== false)) || (count($array) > 1 && (strpos($title, $array[0]) !== false || strpos($title, $array[1]) !== false))) {
					$movie_id = $key;
					break;
				}
			}
			if ($movie_id == -1) continue;

			$image = $element->find("div[class=post-thumbnail] a img",0)->attr['data-lazy-src'];

			$strtime = $element->find("span[class=tie-date]",0)->plaintext;
			list($d, $m, $y) = explode("/", trim($strtime));
			$time = $y.'-'.$m.'-'.$d;		

			$source_id = 1;

			$sql = "INSERT INTO review (movie_id, url, image, time, title, header, source_id) VALUES ('$movie_id', '$url', '$image', '$time', '$title', '$header', '$source_id')";
			if ($conn->query($sql) === TRUE) {
				echo "New review: ".$title."<br>";
			}

			$reviewsql = $conn->query("SELECT review_id FROM review WHERE url = '$url'");
			$row = mysqli_fetch_assoc($reviewsql);
			$review_id = $row['review_id'];

			//review_content
			$txt = $html1->find("div[class=entry]",0)->find("p[style=text-align: justify;], figure[class=wp-caption aligncenter]");
			if (strlen($head < 60)) {
				unset($txt[0]);
			}	
			foreach ($txt as $tag) {
				$content = $tag->plaintext;
				$class = 'p';
				if ($tag->find('img',0)) {
					$content = $tag->find('a',0)->href;
					$class = 'img';
				}
				$conn->query("INSERT INTO review_content (review_id, content, class) VALUES ('$review_id', '$content', '$class')");
			}

			//rating
			if ($html1->find("div[class=review-wu-grade-content] span",0)) {
				$point = $html1->find("div[class=review-wu-grade-content] span",0)->plaintext;
				$conn->query("INSERT INTO rating (movie_id, source_id, point) VALUES ('$movie_id', '$source_id', '$point')");
			}
			elseif ($html1->find("div[class=review-final-score] h3",0)) {
				$point = $html1->find("div[class=review-final-score] h3",0)->plaintext;
				$conn->query("INSERT INTO rating (movie_id, source_id, point) VALUES ('$movie_id', '$source_id', '$point')");
			}
			else continue;
		}
	}

	//rapchieuphim.com
	  //get current review (check duplicate)
 	$review_url = $conn->query("SELECT url FROM review WHERE source_id = 2 ORDER BY time DESC LIMIT 10");
	$review2 = array();
	$i = 0;
	while ($row = mysqli_fetch_assoc($review_url)) {
		$review2[$i] = $row['url'];
		$i++;
	}

	$html = file_get_html("https://rapchieuphim.com");
	$list = $html->find("div[class=col-md-8 col-sm-8 col-xs-12 list-post]",0);
	
	foreach ($list->find("div[class=post-item]") as $element) {
		//break;
		$url = $element->find("div[class=post-thumbnail] a",0)->href;

		if (in_array($url, $review2)) continue;

		$title = trim($element->find("div[class=post-detail] h3 a",0)->plaintext);

		$image = $element->find("div[class=post-thumbnail] a img",0)->src;

		$html1 = file_get_html($url);

		$header = $html1->find("div[class=post-content] p[style=text-align: justify;]",0)->plaintext;

		$movie_id = -1;
		foreach ($movie as $key => $value) {
			$array = explode(': ', strtolower(stripUnicode($value['vi'])));
			$tle = strtolower(stripUnicode($title));
			if (strpos($tle, strtolower(stripUnicode($value['vi']))) !== false || (!empty($value['en']) && strpos($header, $value['en']) !== false) || (count($array) > 1 && (strpos($tle, $array[0]) !== false || strpos($tle, $array[1]) !== false))) {
				$movie_id = $key;
				break;
			}			
		}
		if ($movie_id == -1) continue;

		$datetime = $html1->find("div[class=post-meta] a",0)->plaintext;
		list($h, $strtime) = explode(" ", $datetime);
		list($d, $m, $y) = explode("/", trim($strtime));
		$time = $y.'-'.$m.'-'.$d;

		$source_id = 2;

		$sql = "INSERT INTO review (movie_id, url, image, time, title, header, source_id) VALUES ('$movie_id', '$url', '$image', '$time', '$title', '$header', '$source_id')";
		if ($conn->query($sql) === TRUE){
			echo "New review: ".$title."<br>";
		}		

		$reviewsql = $conn->query("SELECT review_id FROM review WHERE url = '$url'");
		$row = mysqli_fetch_assoc($reviewsql);
		$review_id = $row['review_id'];

		//review_content
		$txt = $html1->find("div[class=post-content]",0)->find("p, h3");
		unset($txt[0]);
		foreach ($txt as $tag) {
			$content = $tag->plaintext;
			$class = 'p';
			if ($tag->find('img',0)) {
				$content = $tag->find('img',0)->src;
				$class = 'img';
			}
			if ($tag->tag == 'h3') {
				$class = 'h';
			}			
			if (empty(html_entity_decode(str_replace("&nbsp;", "", htmlentities($content, null, 'utf-8'))))) {
				continue;
			}
			$conn->query("INSERT INTO review_content (review_id, content, class) VALUES ('$review_id', '$content', '$class')");
		}

		//rating
		if ($element->find("div[class=progress total]",0)) {
			$point = $element->find("div[class=progress total] span[class=score]",0)->plaintext;
			$conn->query("INSERT INTO rating (movie_id, source_id, point) VALUES ('$movie_id', '$source_id', '$point')");
		} 
	}

	//moveek.com (loi font)
	  //get current review (check duplicate)
 	$review_url = $conn->query("SELECT url FROM review WHERE source_id = 3 ORDER BY time DESC LIMIT 20");
	$review3 = array();
	$i = 0;
	while ($row = mysqli_fetch_assoc($review_url)) {
		$review3[$i] = $row['url'];
		$i++;
	}

	$html = file_get_html("https://moveek.com/danh-gia-phim/");

	foreach ($html->find("div[class=article] div[class=row]") as $element) {
		//break;
		$url = "https://moveek.com".$element->find("div[class=col-sm-4 col-12] a",0)->href;

		if (in_array($url, $review3)) continue;

		$title = $element->find("div[class=col] h4 a",0)->plaintext;

		$movie_id = -1;
		foreach ($movie as $key => $value) {
			if (strpos($title, $value['vi']) !== false) {
				$movie_id = $key;
				break;
			}			
		}
		if ($movie_id == -1) continue;

		$image = $element->find("div[class=col-sm-4 col-12] a img",0)->attr['data-src'];

		$strtime = $element->find("div[class=col] p time",0)->datetime;
		$time = date("Y-m-d", strtotime($strtime));

		$header = trim($element->find("div[class=col] p",1)->plaintext);

		$source_id = 3;

		$sql = "INSERT INTO review (movie_id, url, image, time, title, header, source_id) VALUES ('$movie_id', '$url', '$image', '$time', '$title', '$header', '$source_id')";
		if ($conn->query($sql) === TRUE){
			echo "New review: ".$title."<br>";
		}

		$reviewsql = $conn->query("SELECT review_id FROM review WHERE url = '$url'");
		$row = mysqli_fetch_assoc($reviewsql);
		$review_id = $row['review_id'];

		//review_content
		$html1 = file_get_html($url);

		$txt = $html1->find("div[class=post-content]",0)->find("p, div[class=post-media-image], h2");

		foreach ($txt as $tag) {
			if (!empty($tag->prev_sibling()) && $tag->prev_sibling()->tag == 'h4') {
				continue;
			}
			$text = $tag->plaintext;
			if ($text === '&nbsp;') {
				continue;
			}
      		$content = html_entity_decode($text);
			$class = 'p';
			if ($tag->find('img',0)) {
				$content = $tag->find('img',0)->src;
				$class = 'img';
			}
			if ($tag->tag == 'h2') {
				$class = 'h';
			}
			$conn->query("INSERT INTO review_content (review_id, content, class) VALUES ('$review_id', '$content', '$class')");
		}
	}

	//touchcinema.com (loi font)
	  //get current review (check duplicate)
 	$review_url = $conn->query("SELECT url FROM review WHERE source_id = 4 ORDER BY time DESC LIMIT 12");
	$review4 = array();
	$i = 0;
	while ($row = mysqli_fetch_assoc($review_url)) {
		$review4[$i] = $row['url'];
		$i++;
	}

	$html = file_get_html("https://touchcinema.com/danh-gia-phim");

	foreach ($html->find("div[class=post-item]") as $element) {
		//break;
		$url = $element->find("div[class=post-thumbnail] a",0)->href;

		if (in_array($url, $review4)) continue;

		$title = $element->find("div[class=post-detail] h3 a",0)->plaintext;

		$movie_id = -1;
		foreach ($movie as $key => $value) {
			$array = explode(': ', strtolower(stripUnicode($value['vi'])));
			$tle = strtolower(stripUnicode($title));
			if (strpos($tle, strtolower(stripUnicode($value['vi']))) !== false || (!empty($value['en']) && strpos($title, $value['en']) !== false) || (count($array) > 1 && (strpos($tle, $array[0]) !== false || strpos($tle, $array[1]) !== false))) {
				$movie_id = $key;
				break;
			}			
		}
		if ($movie_id == -1) continue;

		$image = $element->find("div[class=post-thumbnail] a img",0)->src;

		$html1 = file_get_html($url);

		$strtime = $html1->find("div[class=post-meta] a",0)->plaintext;
		list($d, $m, $y) = explode("/", trim($strtime));
		$time = $y.'-'.$m.'-'.$d;

		$head = $html1->find("div[class=post-content] p[style=text-align: justify;]",0)->plaintext;
		$header = html_entity_decode($head);

		$source_id = 4;

		$sql = "INSERT INTO review (movie_id, url, image, time, title, header, source_id) VALUES ('$movie_id', '$url', '$image', '$time', '$title', '$header', '$source_id')";
		if ($conn->query($sql) === TRUE){
			echo "New review: ".$title."<br>";
		}

		$reviewsql = $conn->query("SELECT review_id FROM review WHERE url = '$url'");
		$row = mysqli_fetch_assoc($reviewsql);
		$review_id = $row['review_id'];

		//review_content
		$txt = $html1->find("div[class=post-content]",0)->find("p, h3");
		unset($txt[0]);

		foreach ($txt as $tag) {
			$text = $tag->plaintext;
      		if ($text === '&nbsp;') {
        		continue;
      		}
      		$content = html_entity_decode($text);
			$class = 'p';
			if ($tag->find('img',0)) {
				$content = "https://touchcinema.com".$tag->find('img',0)->src;
				$class = 'img';
			}
			if ($tag->tag == 'h3') {
				$class = 'h';
			}
			$conn->query("INSERT INTO review_content (review_id, content, class) VALUES ('$review_id', '$content', '$class')");
		}
	}

	//ghienreview.com
	  //get current review (check duplicate)
 	$review_url = $conn->query("SELECT url FROM review WHERE source_id = 5 ORDER BY time DESC LIMIT 10");
	$review5 = array();
	$i = 0;
	while ($row = mysqli_fetch_assoc($review_url)) {
		$review5[$i] = $row['url'];
		$i++;
	}
	$html = file_get_html("https://ghienreview.com/review-phim/phim-hay-trong-thang/");

	foreach ($html->find("div[class=progression-studios-default-blog-overlay]") as $element) {
		//break;
		$url = $element->find('a',0)->href;

		if (in_array($url, $review5)) continue;

		$title = $element->find('h2',0)->plaintext;

		$movie_id = -1;
		foreach ($movie as $key => $value) {
			$array = explode(': ', strtolower(stripUnicode($value['vi'])));
			$tle = strtolower(stripUnicode($title));
			if ((!empty($value['en']) && strpos($tle, strtolower($value['en'])) !== false) || strpos($tle, strtolower(stripUnicode($value['vi']))) !== false || (count($array) > 1 && (strpos($tle, $array[0]) !== false || strpos($tle, $array[1]) !== false))) {
				$movie_id = $key;
				break;
			}
		}
		if ($movie_id == -1) continue;

		$strimage = $element->find('a div',0)->style;
		list($a, $image) = explode("'", $strimage);

		$time = date('Y-m-d');

		$html1 = file_get_html($url);
		if ($html1->find("div[class=progression-blog-single-content] blockquote",0)) {
			$html1->find("div[class=progression-blog-single-content] blockquote",0)->outertext = '';
		}
		$html1->find("div[class=sharedaddy sd-sharing-enabled]",0)->outertext = '';
		$html1->load($html1 ->save());

		$header = $html1->find("div[class=progression-blog-single-content] p",1)->plaintext;

		$source_id = 5;

		$sql = "INSERT INTO review (movie_id, url, image, time, title, header, source_id) VALUES ('$movie_id', '$url', '$image', '$time', '$title', '$header', '$source_id')";
		if ($conn->query($sql) === TRUE){
			echo "New review: ".$title."<br>";
		}

		$reviewsql = $conn->query("SELECT review_id FROM review WHERE url = '$url'");
		$row = mysqli_fetch_assoc($reviewsql);
		$review_id = $row['review_id'];

		//review_content
		$txt = $html1->find("div[class=progression-blog-single-content]",0)->find("p, li");
		unset($txt[1]);

		foreach ($txt as $tag) {
			$content = trim($tag->plaintext);
			$class = 'p';
			if ($tag->find('img',0)) {
				$content = $tag->find('img',0)->src;
				$class = 'img';
			}
			if (empty($content)) {
				continue;
			}
			$conn->query("INSERT INTO review_content (review_id, content, class) VALUES ('$review_id', '$content', '$class')");
		}

		//rating
		if ($element->find("div[class=progression-blog-review-index-total]",0)) {
			$point = $element->find("div[class=progression-blog-review-index-total]",0)->plaintext;
			$conn->query("INSERT INTO rating (movie_id, source_id, point) VALUES ('$movie_id', '$source_id', '$point')");
		}
	}

	//gocdienanh.com
  	$html = file_get_html("https://www.gocdienanh.com/review-phim/");

  	for ($i=0; $i < 13; $i++) {
	    //break;
	    $element = $html->find("div[class=td-module-thumb]",$i);
	    $url = $element->find('a',0)->href;

	    $html1 = file_get_html($url);	    

	    if ($html1->find("div[class=td-review-final-score]",0)) {    	
	    	$title = $html1->find("h1[class=entry-title]",0)->plaintext;

		    $movie_id = -1;
		    foreach ($movie as $key => $value) {
		    	$array = explode(': ', strtolower(stripUnicode($value['vi'])));
				$tle = strtolower(stripUnicode($title));
		    	if (strpos($title, $value['vi']) !== false || (!empty($value['en']) && strpos($title, strtolower($value['en'])) !== false) || strpos($tle, strtolower(stripUnicode($value['vi']))) !== false || (count($array) > 1 && (strpos($tle, $array[0]) !== false || strpos($tle, $array[1]) !== false))) {
					$movie_id = $key;
					break;
				}	
		    }
		    if ($movie_id == -1) continue;	    

		    $sql = $conn->query("SELECT * FROM rating WHERE movie_id = '$movie_id' AND source_id = 7");

		    if (mysqli_num_rows($sql) == 0) {
		    	$point = $html1->find("div[class=td-review-final-score]",0)->plaintext;
		    	$source_id = 7;
	    		$conn->query("INSERT INTO rating (movie_id, source_id, point) VALUES ('$movie_id', '$source_id', '$point')");
	    		echo "insert rating ".$url."<br>";
	    	}
	    }	    
	}

	$conn->close();
?>