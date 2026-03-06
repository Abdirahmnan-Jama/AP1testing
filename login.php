<?php


include 'conn.php';
$raw = file_get_contents("php://input"); // waxan kuso akhriyaynaa datada Rawga ah

$data = json_decode($raw, true); // waxaan xogtii u bedelaynaa php array ahaan

$username = $data['username'] ?? "";
$password = $data['password']?? "";

if($username == ''  || $password == ""){

echo json_encode([

"error"=>"username and password cant be empty"
]);

exit;
}


$query = mysqli_query($conn, "select * from users where username = '$username'");

if($query->num_rows > 0){
$row = mysqli_fetch_assoc($query);



if($password == $row['password']){

$header = base64_encode(json_encode([
"alg"=>"HS256",
"typ"=> "JWT"
]));

$header = rtrim(strtr($header, '+/','-_'), "=");


$payload = base64_encode(json_encode([
"uid" => $row['userid'],
"username" => $row['username'],
"role" => $row['role'],

"iat"=> time(),
"exptime"=> time()+60000

]));

$payload = rtrim(strtr($payload, '+/', '-_'), '=');

$secret = "abdikarim";

$signiture = hash_hmac(
    "sha256", 
    "$header.$payload", 
    $secret, 
    true
);
$signiture = rtrim(strtr(base64_encode($signiture), '+/', '-_'), '=');


$jwt = "$header.$payload.$signiture";

echo  json_encode([
 "token" => $jwt
]);



}

else{
echo json_encode([
    "error" => "incorrect password"]);

}

}

else{
    echo json_encode([
    "error" => "incorrect username"]);
}


?>