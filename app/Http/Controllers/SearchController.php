<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Review;

class SearchController extends Controller
{
	function stripUnicode($str){
        if (!$str) return false;
        $unicode = array(
          'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|&#225;|&#224;|&#227;|&#193;|&#192;|&#195;',
          'd'=>'đ|Đ|&#273;|&#272;',
          'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|&#233;|&#232;|&#200;|&#201;',
          'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị|&#237;|&#236;|&#297;|&#296;',
          'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|&#243;|&#242;|&#245;|&#211;|&#210;|&#213;',
          'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|&#250;|&#249;|&#361;|&#360;|&#217;|&#218;',
          'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ|&#253;|&#221;'   
        );
        foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        return $str;
    }

    public function showResult(Request $rq){
    	$keysearch = $rq->keysearch;
    	$result = 1;
    	if(strlen($keysearch) > 1){
    		$movies = Movie::where('name_vi','like','%'.$keysearch.'%')->orwhere('name_en','like','%'.$keysearch.'%')->take(10)->get();
    		if(count($movies) < 10){
    			$key = $this->stripUnicode($keysearch);
    			$movies = Movie::where('name_search','like','%'.$key.'%')->orwhere('name_en','like','%'.$keysearch.'%')->get();
    		}
    		if(count($movies) == 0){
    			$result = 0;
    		}
    	}
    	else{
    		$result = 0;
    	}    	
    	return view('pages.search', compact('movies', 'keysearch', 'result'));
    }
}
