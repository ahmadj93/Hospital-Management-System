<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
include("connection.php");
$data = file_get_contents("php://input");

// Decode JSON data
$json_data = json_decode($data);

$name = $json_data->name;
$email = $json_data->email;
$type=$json_data->type;
$birth =  $json_data->birth ;
$password = $json_data->password;
$query =$mysqli->prepare('insert into persons (name,email,type,birth,password) values(?,?,?,?,?)');
$query->bind_param('sssss', $name,$email,$type,$birth,$password);
$query->execute();

if ($query->affected_rows > 0) {
    // Row was successfully added
    $response["status"] = "true";
    $response["message"] = "New row added successfully";
    echo json_encode($response);

} else {
    // Row was not added
    $response["status"] = "false";
    $response["message"] = "Failed to add a new row".$query->error;;
    echo json_encode($response);
}
?>