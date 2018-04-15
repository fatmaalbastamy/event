<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once 'config/database.php';
    include_once 'objects/event.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare event object
    $event = new event($db);
     
    // set event id to be deleted
    $event->id = $_POST['object_id'];
     
    // delete the event
    if($event->delete()){
        echo "Object was deleted.";
    }
     
    // if unable to delete the event
    else{
        echo "Unable to delete object.";
    }
}
?>