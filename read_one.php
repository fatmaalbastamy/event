<?php
// Read one record based on given record ID
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/event.php';
include_once 'objects/category.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$event = new event($db);
$category = new Category($db);
 
// set ID property of event to be read
$event->id = $id;
 
// read the details of event to be read
$event->readOne();
$page_title = "Read One Event";
//include header file
include_once "layout_header.php";
 
// read events button
// HTML table for displaying a event details
echo "<table class='table table-hover table-responsive table-bordered'>";
 
    echo "<tr>";
        echo "<td>Name</td>";
        echo "<td>{$event->name}</td>";
    echo "</tr>";
    echo "<tr>";
        echo "<td>location</td>";
        echo "<td>&#36;{$event->location}</td>";
    echo "</tr>";
    echo "<tr>";
        echo "<td>details</td>";
        echo "<td>{$event->details}</td>";
    echo "</tr>";
 echo "<tr>";
        echo "<td>start_date</td>";
        echo "<td>{$event->start_date}</td>";
    echo "</tr>";
 echo "<tr>";
        echo "<td>end_date</td>";
        echo "<td>{$event->end_date}</td>";
    echo "</tr>";
 echo "<tr>";
    echo "<td>Image</td>";
    echo "<td>";
        echo $event->image ? "<img src='uploads/{$event->image}' style='width:300px;' />" : "No image found.";
    echo "</td>";

    echo "<tr>";
        echo "<td>Category</td>";
        echo "<td>";
            // display category name
            $category->id=$event->category_id;
            $category->readName();
            echo $category->name;
        echo "</td>";
    echo "</tr>";
 
echo "</table>";
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read events";
    echo "</a>";
echo "</div>";
 
// set footer
include_once "layout_footer.php";
?>