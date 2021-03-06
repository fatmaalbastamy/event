<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/event.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare event object
$event = new event($db);
 
// set ID property of event to be edited
$event->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of event to be edited
$event->readOne();
 
// create array
$event_arr = array(
	"id" => $id,
    "name" => $name,
    "details" => $details,
   "location" => $location,
   "start_date" => $start_date,
 "end_date" => $end_date,
     "image" => $image,
            "category_id" => $category_id,
            "category_name" => $category_name
   
 
);
 
// make it json format
print_r(json_encode($event_arr));
?>