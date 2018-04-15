<?php

// Configure Pagination Variables
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 2;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// Retrieve Records from the Database
include_once 'config/database.php';
include_once 'objects/event.php';
include_once 'objects/category.php';
 
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
 
$event = new event($db);
$category = new Category($db);
 
// query events
$stmt = $event->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
//include header 
include_once "layout_header.php";
 
// contents will be here
?>
<nav class="navbar navbar-findcond navbar-fixed-top">
    <div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Events</a>
		</div>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="index.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Home </a>
				</li>
			</ul>
			<form class="navbar-form navbar-right search-form" role="search">
				<?php
				echo "<form role='search' action='search.php'>";
     echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input  type='text' class='form-control' placeholder='Type event name or description...' name='s' id='srch-term' required {$search_value} style='
    width: 200px;
'/>";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
				
echo "</form>";?>
				<!-- Create event button-->
 <a href='create_events.php' class='btn btn-default pull-right'style="
    margin-top: 8px;
">Create event</a>
            </form>
		</div>
	</div>
</nav>
<!--
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <form method="post" style="padding: 18px;margin-top: -18px;">
                                 <fieldset  class="search">
                                            <label for="disabledTextInput"> بحث</label> <br>
                                            <select name="search">
                                                  <option selected="" value="1">name</option>
                                                  <option value="2">location</option>
                                                  <option value="3">start_date </option>
                                                  <option value="4">end_date</option>
                                                  <option value="5">details </option>
                                                  <option value="6">image</option>
                                                 
                                            </select>
                        </div>
                    </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                            <label>القيمه</label> <br>
                                            <input type="text" name ="enter"> 
                                            <button type="submit" name="strbnt" class="btn btn-primary">Ok </button>
                                      </div>
                                   </div>
                               </fieldset>
                            </form>

                <div class="col-md-12">
                    <div class="panel panel-default1">
                               <?php 
/*
                                   if (isset($_POST['strbnt']))
                                   {
                                   
                                       if($_POST['search']=="1"){
                                                   $sql= "SELECT * FROM `events` WHERE name LIKE '%".$_POST['enter']."%' ";
                                       }
                                   
                                elseif($_POST['search']=="2")
                                {
                                            $sql= "SELECT * FROM `events` WHERE location LIKE '%".$_POST['enter']."%' ";
                                
                                }
                                elseif($_POST['search']=="3")
                                {
                                            $sql= "SELECT * FROM `events` WHERE start_date LIKE '%".$_POST['enter']."%' ";
                                
                                }
                                elseif($_POST['search']=="4")
                                {
                                            $sql= "SELECT * FROM `events` WHERE end_date LIKE '%".$_POST['enter']."%' ";
                                
                                }
                                elseif($_POST['search']=="5")
                                {
                                            $sql= "SELECT * FROM `events` WHERE details LIKE '%".$_POST['enter']."%' ";
                                
                                }
                                elseif($_POST['search']=="6")
                                {
                                            $sql= "SELECT * FROM `events` WHERE image LIKE '%".$_POST['enter']."%' ";
                                
                                }
                               }*/
                               
                                ?>
                 
-->

		<h2>List of Events</h2>
				

<?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);

?>
<div class="container">
	<div class="row">
				 <div class="col-sm-12 col-md-6 col-lg-3 mt-6">

                <div class="card card-inverse card-info">
					                    <img class="card-img-top" src="<?php echo $row["image"] ; ?>">

                    <div class="card-block">
                        <h4 class="card-title"><?php echo $row["name"] ; ?></h4>
						<h3 class="card-title"><?php echo $row["location"] ; ?></h3>
							 						 <h3 class="card-title"><span><?php echo $row["start_date"] ; ?></span>  <span><?php echo $row["end_date"] ; ?></span></h3>
                        <div class="card-text">
                            <?php echo $row["details"] ; ?>
                        </div>
                    </div>
					
         <div class="card-footer">
<?php
			// read event button
echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>";
    echo "<span class='glyphicon glyphicon-list'></span> Read";
echo "</a>";
 
// edit event button
echo "<a href='update_event.php?id={$id}' class='btn btn-info left-margin'>";
    echo "<span class='glyphicon glyphicon-edit'></span> Edit";
echo "</a>";
 
// delete event button
echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
    echo "<span class='glyphicon glyphicon-remove'></span> Delete";
echo "</a>";
			?>

                    </div>
      </div>                
                </div>
		
		</div>
</div>
<?php 
		}
		
		
		
		
// the page where this paging is used
$page_url = "index.php?";
 
// count all events in the database to calculate total pages
//show  pagination buttons under our records list
$total_rows = $event->countAll();
 
// paging buttons here
include_once 'paging.php';
?>
<script src='//evention-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>

 <?php
// set page footer
include_once "layout_footer.php";
?>
