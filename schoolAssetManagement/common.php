<?php
session_start();
header('Cache-control: private'); // IE 6 FIX
include_once('mysql_connect.php');
include_once('functions.php');
include_once('database.php');
$db = new Database();

define ("ROOTURL", (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'] : "http://".$_SERVER['SERVER_NAME']);
define ("INFOEMAIL","info-gmi@sekolah.com");
define ("NAMEEMAIL","Admin Sistem Pengurusan Sekolah");
//define ("PASSWORD_PENGGUNA_SEMENTARA", strtoupper(Random2(6,1)));
define ("PASSWORD_PENGGUNA_SEMENTARA", "123456");

?>