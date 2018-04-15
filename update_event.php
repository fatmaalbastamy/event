<?php
 // get ID of the event to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/event.php';
include_once 'objects/category.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$event= new event($db);
$category = new Category($db);
 
// set ID property of event to be edited
$event->id = $id;
 
// read the details of event to be edited
$event->readOne();
 
?>
<!-- 'update event' form will be here -->
<!-- post code will be here -->
<?php 
// Code When Form was Submitted
if($_POST){
 
    // set event property values
    $event->name = $_POST['name'];
    $event->location = $_POST['location'];
	    $event->details = $_POST['details'];

    $event->start_date = $_POST['start_date'];
	    $event->end_date = $_POST['end_date'];
    $event->image = $_POST['image'];
    

    $event->category_id = $_POST['category_id'];
 
    // update the event
    if($event->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "event was updated.";
        echo "</div>";
    }
 
    // if unable to update the event, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update event.";
        echo "</div>";
    }
}
?>
 <!-- table for edit event-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $event->name; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Location</td>
            <td><input type='text' name='location' value='<?php echo $event->location; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Details</td>
            <td><textarea name='details' class='form-control'><?php echo $event->details; ?></textarea></td>
        </tr>
		
		 <tr>
            <td>Start_Date</td>
            <td><input type='text' name='start_date' value='<?php echo $event->start_date; ?>' class='form-control' /></td>
        </tr>
		 <tr>
            <td>End_date</td>
            <td><input type='text' name='end_date' value='<?php echo $event->end_date; ?>' class='form-control' /></td>
        </tr>
		 <tr>
            <td> Image</td>
            <td><input type='text' name='image' value='<?php echo $event->image; ?>' class='form-control' /></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <!-- categories select drop-down will be here -->
				<?php
$stmt = $category->read();
 
// put them in a select drop-down
echo "<select class='form-control' name='category_id'>";
 
    echo "<option>Please select...</option>";
    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row_category);
 
        // current category of the event must be selected
        if($event->category_id==$id){
            echo "<option value='$id' selected>";
        }else{
            echo "<option value='$id'>";
        }
 
        echo "$name</option>";
    }
echo "</select>";
?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
// iclude header
$page_title = "Update Event";
include_once "layout_header.php";
 
// read event
 echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read events</a>";
echo "</div>";
// set page footer
include_once "layout_footer.php";
?>