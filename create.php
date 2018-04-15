<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate event object
include_once '../objects/event.php';
 
$database = new Database();
$db = $database->getConnection();
 
$event = new event($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set event property values
$event->name = $data->name;
$event->location = $data->location;
$event->details = $data->details;
$event->start_date = $data->start_date;

$event->end_date = $data->end_date;
$event->image = $data->image;

$event->category_id = $data->category_id;
$event->created = date('Y-m-d H:i:s');
 
// create the event
if($event->create()){
    echo '{';
        echo '"message": "event was created."';
    echo '}';
}
 
// if unable to create the event, tell the user
else{
    echo '{';
        echo '"message": "Unable to create event."';
    echo '}';
}
?>