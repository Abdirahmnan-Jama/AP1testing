<?php

require "connection.php";

header("content-type: application/json");

header("access-control-allow-origin");


$select = mysqli_query($conn, "select * from users");

$mahdi = [];

while($row= mysqli_fetch_assoc($select)){
    $mahdi[] = $row;
}
echo json_encode([
"status" => true, 
"data"=> $mahdi]);