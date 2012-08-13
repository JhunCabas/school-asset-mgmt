<?php #script mysql_connect.php
/* This file contains the database access information.
This file also establishes a connection to MtSQL and selects the database
*/
//set the database access information as constants
define ('DB_USER','root'); //change username to your pc user
define ('DB_PASSWORD','');
define ('DB_HOST','localhost');
define ('DB_NAME','sekolah');
//make the connection and then select the database
$dbc = mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) OR
die ('Could not connect to MySQL: '. mysql_error());
mysql_select_db (DB_NAME) OR
die ('Could not connect the database: ' . mysql_error());

/*
$sql = "SHOW TABLES FROM ".DB_NAME;
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    echo "Table: {$row[0]}\n";
}

mysql_free_result($result);
*/
?>