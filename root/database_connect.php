<?php
$ini = parse_ini_file('app.ini');
$mysqli = new mysqli($ini['db_host'],$ini['db_user'],$ini['db_pass'],$ini['db_name']);

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$mysqli -> set_charset("utf8");
