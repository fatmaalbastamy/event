<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/event.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare event object
$event = new event($db);
 
// get id of event to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of event to be edited
$event->id = $data->id;
 
// set event property values
$event->name = $data->name;
$event->price = $data->price;
$event->description = $data->description;
$event->category_id = $data->category_id;
 
// update the event
if($event->update()){
    echo '{';
        echo '"message": "event was updated."';
    echo '}';
}
 
// if unable to update the event, tell the user
else{
    echo '{';
        echo '"message": "Unable to update event."';
    echo '}';
}
?>