
<?php

header("content-type: application/json");
header("access-control-allow-origin");

require "connection.php";

$username = $_GET["username"];
$password = $_GET["password"];
$rule = $_GET["role"];

$add = mysqli_query($conn, "insert into users (username,password,role)values('$username', '$password', '$role')");

echo json_encode([
    "status" => true 
]);