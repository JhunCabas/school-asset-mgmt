<?php
	
	if (!function_exists('json_encode'))
	{
	  function json_encode($a=false)
	  {
		if (is_null($a)) return 'null';
		if ($a === false) return 'false';
		if ($a === true) return 'true';
		if (is_scalar($a))
		{
		  if (is_float($a))
		  {
			// Always use "." for floats.
			return floatval(str_replace(",", ".", strval($a)));
		  }

		  if (is_string($a))
		  {
			static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
			return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
		  }
		  else
			return $a;
		}
		$isList = true;
		for ($i = 0, reset($a); $i < count($a); $i++, next($a))
		{
		  if (key($a) !== $i)
		  {
			$isList = false;
			break;
		  }
		}
		$result = array();
		if ($isList)
		{
		  foreach ($a as $v) $result[] = json_encode($v);
		  return '[' . join(',', $result) . ']';
		}
		else
		{
		  foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
		  return '{' . join(',', $result) . '}';
		}
	  }
	}

	function changeDateBeginDay($date){
		if($date!=""){
			$dateArr=explode('-',$date);
						 $year=$dateArr[0];
						 $month=$dateArr[1];
						 $day=$dateArr[2];	
			$dayTemp = explode(" ",$day);
			return $date = $dayTemp[0].'/'.$month.'/'.$year;
		}else{
			return null;
		}
		
	}
	function changeDateBeginYear($date){
		if($date!=""){
			$dateArr1=explode('/',$date);
						 $year1=$dateArr1[2];
						 $month1=$dateArr1[1];
						 $day1=$dateArr1[0];

			return $year1.'-'.$month1.'-'.$day1;
		}else{
			return null;
		}
	}
	function alpha_numeric($str)
	{
		return ( ! preg_match("/^([-a-z0-9])+$/i", $str)) ? FALSE : TRUE;
	}

	function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}
	
	function get_ip()
	{
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else if (isset($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		else if (isset($_SERVER['HTTP_FROM']))
		{
			$ip = $_SERVER['HTTP_FROM'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
	function Random2($length=5,$type=1){
			$key = '';
			switch($type){
				case 2:
					$pattern = "abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz";
					break;
				case 3:
					$pattern = "12345678901234567890123456789012345678901234567890";
					break;
				default:
					$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
					break;
			}
			for($i=0;$i<$length;$i++){
				$key .= $pattern{rand(0,35)};
			}
		   return $key;
	}
	
	function createThumb($file_src,$file_new,$width) {
	  list($old_width,$old_height) = getimagesize($file_src);
	  $height = round($width/$old_width*$old_height);
	  $new_img = imagecreatetruecolor($width,$height);
	  $new_img_src = imagecreatefromjpeg($file_src);
	  imagecopyresampled($new_img,$new_img_src,0,0,0,0,$width,$height,
						$old_width,$old_height);
	  imagejpeg($new_img,$file_new);
	}
	
		
	function word_split($str,$words) {
		$arr = preg_split("/[\s]+/", $str,$words+1);
		$arr = array_slice($arr,0,$words);
		return join(' ',$arr);
	}

	function decode_entities($text, $exclude = array()) {
    static $table;
    // We store named entities in a table for quick processing.
		if (!isset($table)) {
      // Get all named HTML entities.
      $table = array_flip(get_html_translation_table(HTML_ENTITIES, $special));
      // PHP gives us ISO-8859-1 data, we need UTF-8.
      $table = array_map('utf8_encode', $table);
		}
    $text = strtr($text, array_diff($table, $exclude));

    // Any remaining entities are numerical. Use a regexp to replace them.
    return preg_replace('/&#(x?)([A-Za-z0-9]+);/e', '_decode_entities("$1", "$2", "$0", $exclude)', $text);
	}

	function valid_input_data($data) {
		if (is_array($data) || is_object($data)) {
			foreach ($data as $key => $value) {
				if (!valid_input_data($key) || !valid_input_data($value)) {
				  return FALSE;
				}
			}
		}
    else if (isset($data)) {
      $data = $this->decode_entities($data, array('<', '&', '"'));

      $match  = preg_match('/\Wjavascript\s*:/i', $data);
      $match += preg_match('/\Wexpression\s*\(/i', $data);
      $match += preg_match('/\Walert\s*\(/i', $data);
      $match += preg_match("/\W(dynsrc|datasrc|data|lowsrc|on[a-z]+)\s*=[^>]+?>/i", $data);
      $match += preg_match("/<\s*(applet|script|object|style|embed|form|blink|meta|html|frame|iframe|layer|ilayer|head|frameset|xml)/i", $data);
      if ($match) {
      return FALSE;
      }
    }
    return TRUE;
	}
	function curPageName() {
		return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	}
	function number_pad($number,$n) {
		return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
	}
?>