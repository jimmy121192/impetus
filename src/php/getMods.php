<?php
//header("Access-Control-Allow-Origin: *");
//header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Origin: https://impetus.netlify.app');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");
header("Access-Control-Allow-Credentials: true");

$servername = "us-cdbr-east-02.cleardb.com"; $username = "ba6e0ff00803b6"; $password = "7da5be5a";

$dbname = "heroku_b8290af623dd61c";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); 

}
else{

    

    $sql = "SELECT users.user_id, users.type, users.firstname,users.lastname,users.email FROM users WHERE users.type = 'Admin' OR users.type = 'Moderator';";

    $res = mysqli_query($conn,$sql);

    $row = mysqli_fetch_all($res, MYSQLI_ASSOC);

    echo json_encode($row);
} 
mysqli_close($conn);




?>