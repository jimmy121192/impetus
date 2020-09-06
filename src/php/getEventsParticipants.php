<?php
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");
header("Access-Control-Allow-Credentials: true");

$servername = "localhost"; $username = "jimmy"; $password = "121192";

$dbname = "impetus_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); 

}
else{


    $sql = "SELECT users.user_id, users.firstname, events.name, events.event_id, users_events.status FROM users_events LEFT JOIN users ON users.user_id = users_events.user_id LEFT JOIN events ON events.event_id = users_events.event_id ORDER BY events.event_id;";

    $res = mysqli_query($conn,$sql);

    $row = mysqli_fetch_all($res, MYSQLI_ASSOC);

    echo json_encode($row);
} 
mysqli_close($conn);

?>