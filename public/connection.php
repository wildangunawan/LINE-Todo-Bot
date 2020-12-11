<?php

$db_url = "103.129.220.6";
$db_user = "wildanw1_line";
$db_pwd = "i?Q?_6EO^{!R";
$db_name = "wildanw1_line";

$conn = mysqli_connect($db_url, $db_user, $db_pwd, $db_name);

if (!$conn){
	die("Error when initializing connection with the database");
}

?>
