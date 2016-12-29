<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    if(isset($_GET["subject"])){
		$selected_subject_id = $_GET["subject"];
		$current_subject = get_subject_by_id($selected_subject_id);
		$selected_page_id = null;
	}
	elseif(isset($_GET["page"])){
		$selected_subject_id = null;
		$selected_page_id = $_GET["page"];
	}
	else{
		$selected_subject_id = null;
		$selected_page_id = null;
	}
?>

<?php
    if(isset($_POST["submit"])){
		//Process the form
		$id = (int)$current_subject["id"];
		$menu_name = $_POST["menu_name"];
		$position = (int)$_POST["position"];
		$visible = (int)$_POST["visible"];
		
		//Escape all strings
		$menu_name = mysqli_real_escape_string($connection, $menu_name);
		
		//Perform database query
		$query = "UPDATE subjects SET";
		$query .= " menu_name = '{$menu_name}', position = {$position}, visible = {$visible}";
		$query .= " WHERE id = {$id}";
		$result = mysqli_query($connection, $query);
		
		if($result){
			$_SESSION["message"] = "Subject Updated.";
			redirect_to("manage_content.php");
		}else{
			$_SESSION["message"] = "Subject Updation Failed.";
		    redirect_to("new_subject.php");	
		}
	}/*else{
		redirect_to("new_subject.php");
	}*/
?>

<?php include("../includes/header.php"); ?>

<?php
    if(!$current_subject){
		redirect_to("manage_content.php");
	}
?>

<div id="main">
	<div id="navigation">
		<?php echo navigation($selected_subject_id, $selected_page_id); ?>
    </div>
	<div id="page">
		<h2>Edit Subject: <?php echo $current_subject["menu_name"]; ?></h2>
		<form action="edit_subject.php?subject=<?php echo $current_subject["id"]; ?>" method="post">
		    <p>Subject name:
			    <input type="text" name="menu_name" value="<?php echo $current_subject["menu_name"]; ?>" />
			</p>
			<p>Position:
			    <select name="position">
					<?php
					    $subject_set = get_all_subjects();
					    $subject_count = mysqli_num_rows($subject_set);
					    for($count=1; $count <= ($subject_count + 1); $count++){
							echo "<option value=\"{$count}\"";
							if($current_subject["position"] == $count){
								echo "selected";
							}
							echo ">{$count}</option>";
						}
					?>
				</select>
			</p>
			<p>Visible:
			    <input type="radio" name="visible" value="0" 
				<?php 
				    if($current_subject["visible"] == 0){
					    echo "checked";
				    }
                ?>					/> No
				<input type="radio" name="visible" value="1"
                <?php 
				    if($current_subject["visible"] == 1){
					    echo "checked";
				    }
                ?>				/> Yes
			</p>
			<input type="submit" name="submit" value="Update Subject" />
		</form>
		<br />
		<a href="manage_content.php">Cancel</a>
		&nbsp;
		&nbsp;
		<a href="delete_subject.php?subject=<?php echo $current_subject["id"] ?>">Delete Subject</a>
	</div>
</div>
	
<?php include("../includes/footer.php"); ?>