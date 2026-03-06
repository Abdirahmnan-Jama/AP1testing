<?php

require "connection.php";

header("content-type: application/json");   
header("access-control-allow-origin: *");

$id = $_GET["userid"];

$delete = mysqli_query($conn, "delete from users where userid = '$id'");
echo json_encode([
    "status" => true
]);

