<?php

include('../common.php');
if($_SESSION['islogin'] != 'yes' && $_SESSION['peranan'] != 'pegawai')
		header( 'Location: ../logout.php' ) ;
		
if(isset($_GET['id'])){
	$id = mysql_real_escape_string($_GET['id']);
	$subid = "";
	if(isset($_GET['subid'])){
		$subid = mysql_real_escape_string($_GET['subid']);
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
		$contentvalue = $contentvalue.'{"optionValue": '.$i['id'].',"optionSelected": "'.$selected.'", "optionDisplay": "'.$i['nama'].'"},';
	}
	$contentvalue = substr($contentvalue,0,-1); 
	echo $initvalue.$contentvalue.']';											
}

?>
