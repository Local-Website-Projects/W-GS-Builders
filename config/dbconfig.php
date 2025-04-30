<?php
/*$db_host = 'localhost';
$db_user = 'urkcljxtkiggh';
$db_password = '*b^y1kb2@~cb';
$db_name = 'db4ohifjhz1poc';*/
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'gs_builders';
$con = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if ($con) {
	//echo 'Connection Successfull';
} else {
	//echo "Connection Error";
}
