<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: http://localhost:8080");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");

$data = json_decode(file_get_contents("php://input"),true);
$announcement = $data['body'];
$servername = "localhost"; $username = "jimmy"; $password = "121192";
$dbname = "impetus_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn || !$announcement) {
    die("Connection failed: " . mysqli_connect_error()); 

}
else{
    $sql = "UPDATE announcement SET text='{$announcement}';";
    $res = mysqli_query($conn,$sql);
    
    if($res){
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
} 
mysqli_close($conn);




?>

