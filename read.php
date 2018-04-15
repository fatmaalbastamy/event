<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/event.php';
 
// instantiate database and event object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$event = new event($db);
 
// query events
$stmt = $event->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // events array
    $events_arr=array();
    $events_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $event_item=array(
            "id" => $id,
            "name" => $name,
            "details" => html_entity_decode($details),
            "location" => $location,
			            "start_date" => $start_date,

			            "end_date" => $end_date,
            "image" => image,
           


            "category_id" => $category_id,
            "category_name" => $category_name
        );
 
        array_push($events_arr["records"], $event_item);
    }
 
    echo json_encode($events_arr);
}
 
else{
    echo json_encode(
        array("message" => "No events found.")
    );
}
?>