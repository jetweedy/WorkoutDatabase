<?php

// ---------------------------------------------------------------------------------
// https://devcenter.heroku.com/articles/cleardb#using-cleardb-with-php
// ---------------------------------------------------------------------------------
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
$conn = new mysqli($server, $username, $password, $db);
// ---------------------------------------------------------------------------------

// ---------------------------------------------------------------------------------
// Generate a table (if not already there)
// ---------------------------------------------------------------------------------
$sql = "CREATE TABLE IF NOT EXISTS users (id int not null auto_increment primary key, username varchar(200), password varchar(200), isadmin BOOLEAN, firstname varchar(200), lastname varchar(200), email varchar(200))";
$conn->query($sql);
$sql = "CREATE TABLE IF NOT EXISTS daily_workouts (id int not null auto_increment primary key, weekday varchar(200), hours varchar(200), details varchar(200))";
$conn->query($sql);
// ---------------------------------------------------------------------------------

?>
