<?php
//header("Access-Control-Allow-Origin: *");
//header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Origin: https://impetus.netlify.app/');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");
header("Access-Control-Allow-Credentials: true");

$servername = "localhost"; $username = "ba6e0ff00803b6"; $password = "7da5be5a";
$dbname = "heroku_b8290af623dd61c";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$id = $_GET['id'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); 

}
else{
    $sql = "DELETE users, users_events FROM users LEFT JOIN users_events ON users.user_id = users_events.user_id WHERE users.user_id = $id;";
    $res = mysqli_query($conn,$sql);
} 
mysqli_close($conn);

?>