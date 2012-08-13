<?php
// vim:ts=8 sw=2:et sta
//require_once('DB.php');
class Database {

  function sql_query($sql) 
  {
    $result= mysql_query($sql) or die(mysql_error());
	return $result;
  }

  function sql_list($sql) 
  {
    $result= mysql_query($sql) or die(mysql_error());
	$row =mysql_fetch_array($result);
	return $row;
  }

  function sql_fetch($sql) 
  {
    $result= mysql_query($sql) or die(mysql_error());
	$arr = array();
	while($row = mysql_fetch_array($result))
      array_push($arr, $row);
	  
     return $arr;
  }

  function sql_total($sql) 
  {
	  $result= mysql_query($sql) or die(mysql_error());
	  $row =mysql_fetch_array($result);
	  $num = $row[0];
      return $num;
  }

  function get_counter_barcode($year)
  {
	$db = new Database();
	$counter = 0;
	$qList= "select * from counter_barcode where year= $year ";
	$rList = $db->sql_list($qList);
	if($rList){
		$counter = $rList['counter']+1;
		$updateBar= "UPDATE  counter_barcode set counter=$counter where year= $year";
		$result = $db->sql_query($updateBar);
	}else{
		$createBar= "INSERT INTO counter_barcode(counter, year) VALUES (1,$year)";
		$result = $db->sql_query($createBar);
		$counter = 1;
	}
	return $counter;
  }
  

} // End class Core

?>
