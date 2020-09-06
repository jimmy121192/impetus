<?php
// session_start(); 
// $poster=(isset($_SESSION["username"]))?$_SESSION["username"]:'';


// echo $poster;


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");


$data = json_decode(file_get_contents("php://input"),true);
$post = $data['post'];

$tag = json_encode($post['tagsArray']);

$servername = "localhost"; $username = "jimmy"; $password = "121192"; $dbname = "impetus_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn || !$post) {
    die("Connection failed: " . mysqli_connect_error()); 

}
else{
    $pst = new DateTimeZone('America/Los_Angeles');
    $current = new DateTime('',$pst); // first argument uses strtotime parsing
    $date = $current->format('Y-m-d'); 
    $time = $current->format('H:i:s'); 

    $sql = "INSERT INTO posts (title,poster,tags,body,date,time) VALUES ('{$post["title"]}','{$post["name"]}','{$tag}','{$post["body"]}','{$date}','{$time}')";
    $res = mysqli_query($conn,$sql);


    if($res){
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }

} 
mysqli_close($conn);
?>