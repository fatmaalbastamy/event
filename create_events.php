<?php
// set page headers
// Get a Database Connection
include_once 'config/database.php';
include_once 'objects/event.php';
include_once 'objects/category.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$event = new event($db);
$category = new Category($db);
//header
include_once "layout_header.php";
 
// Create a "Read Events" Button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>List Events</a>";
echo "</div>";
 

 // Display data from the database
if($_POST){
 
    // set event property values
    $event->name = $_POST['name'];
    $event->location = $_POST['location'];
    $event->details = $_POST['details'];
    $event->start_date = $_POST['start_date'];
	$event->end_date = $_POST['end_date'];
	$image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
$event->image = $image;
	

 
    // create the event
    if($event->create()){
        echo "<div class='alert alert-success'>event was created.</div>";
		// try to upload the submitted file
// uploadPhoto() method will return an error message, if any.
echo $event->uploadPhoto();
    }
    
 
    // if unable to create the event, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create event.</div>";
    }
}
?>
<!-- form create event -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data"> 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Location</td>
            <td><input type='text' name='location' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>details</td>
            <td><textarea name='details' class='form-control'></textarea></td>
        </tr>
 <tr>
            <td>Start_date</td>
	             <td><input type='text' name='start_date' class='form-control' /></td>
        </tr>
		<tr>
            <td>End_date</td>
			            <td><input type='text' name='end_date' class='form-control' /></td>
        </tr>
		<tr>
    <td>image</td>
    <td><input type="file" name="image" /></td>
</tr>
        <tr>
            <td>Category</td>
            <td>
				<?php
// read the event categories from the database
$stmt = $category->read();
 
// put them in a select drop-down
echo "<select class='form-control' name='category_id'>";
    echo "<option>Select category...</option>";
 
    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row_category);
        echo "<option value='{$id}'>{$name}</option>";
    }
 
echo "</select>";
?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 
// footer
include_once "layout_footer.php";
?>