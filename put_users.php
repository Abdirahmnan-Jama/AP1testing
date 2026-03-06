<?php

require "connection.php";

header("content-type: application/json");
header("access-control-allow-origin: *");

$id = $_GET["userid"];
$username = $_GET["username"];
$password = $_GET["password"];
$role = $_GET["role"];

$update = mysqli_query($conn, "UPDATE users SET username='$username', password='$password', role='$role' WHERE userid='$id'");

echo json_encode([
    "status" => true
]); 