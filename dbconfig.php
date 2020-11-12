<?php

// Connect to the database

/*
$hostname = "localhost";
$username = "dlargent";
$password = "asdfjkl";
$db = "workouts";
*/

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
$dbconnect=mysqli_connect($server,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}


?>
