<?php

include('../common.php');
if($_SESSION['islogin'] != 'yes' && $_SESSION['peranan'] != 'pegawai')
		header( 'Location: ../logout.php' ) ;
		
if(isset($_GET['id'])){
	$catID = explode("-", mysql_real_escape_string($_GET['id']));
    $id = $catID[0];
	
	$subid = "";
	if(isset($_GET['subid'])){
		$catSubID = explode("-", mysql_real_escape_string($_GET['subid']));
		$subid = $catSubID[0];
	}
	
	$qList= "select * from kategori where parent_id = '$id' ";
	$rList = $db->sql_fetch($qList);

	$initvalue="[";
	$contentvalue="";
	foreach ($rList as $i) {
		$selected ="";
		if($subid != "" && $subid != null && $i['id']==$subid){
			$selected ="SELECTED";
		}
		$contentvalue = $contentvalue.'{"optionValue": "'.$i['id'].'-'.$i['kod'].'","optionSelected": "'.$selected.'", "optionDisplay": "'.$i['kod'].' - '.$i['nama'].'"},';
	}
	$contentvalue = substr($contentvalue,0,-1); 
	echo $initvalue.$contentvalue.']';											
}

?>
