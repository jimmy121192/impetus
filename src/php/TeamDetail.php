<?php
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");
header("Access-Control-Allow-Credentials: true");

$name = $_GET['name'];

$servername = "localhost"; $username = "jimmy"; $password = "121192";

$dbname = "impetus_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); 

}
else{
    $sql = "SELECT * FROM teams WHERE teamname = '{$name}';";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $sql2 = "SELECT username,score, rank,role FROM $name;";
    $res2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_all($res2, MYSQLI_ASSOC);

    $array = array();
    $array[] = $row;
    $array[] = $row2;

    echo json_encode($array);
} 
mysqli_close($conn);




?>