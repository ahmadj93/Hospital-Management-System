<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

include("connection.php");

$data = file_get_contents("php://input");

// Decode JSON data
$json_data = json_decode($data);

$email = $json_data->email;
$password = $json_data->password;

$query=$mysqli->prepare('select id,name,type,password from perons where email=?');
$query->bind_param('s',$email);
$query->execute();
$query->store_result(); //transfer the result set from the last query
// to the client and store it locally, allowing you to fetch rows from the result set.
$num_rows=$query->num_rows; //retrieve the number of rows in a result set after executing a SELECT query
$query->bind_result($id,$name,$type,$hashed_password);
$query->fetch();

$response=[];
if($num_rows=== 0){
    $response['status']= 'user not found';
    echo json_encode($response);
} else {
    if($password==$hashed_password){
        $response['status']= 'logged in';
        $response['id']=$id;
        $response['name']=$name;
        $response['type']=$type;
        echo json_encode($response);
    } else {
        $response['status']="msh password 8alat";
        echo json_encode($response);
    }
};