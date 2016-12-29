<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>

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

<div id="main">
	<div id="navigation">
		<?php echo navigation($selected_subject_id, $selected_page_id); ?>
    </div>
	<div id="page">
	    <?php echo message(); ?>
		<h2>Create Subject</h2>
		<form action="create_subject.php" method="post">
		    <p>Subject name:
			    <input type="text" name="menu_name" value="" />
			</p>
			<p>Position:
			    <select name="position">
					<?php
					    $subject_set = get_all_subjects();
					    $subject_count = mysqli_num_rows($subject_set);
					    for($count=1; $count <= ($subject_count + 1); $count++){
							echo "<option value=\"{$count}\">{$count}</option>";
						}
					?>
				</select>
			</p>
			<p>Visible:
			    <input type="radio" name="visible" value="0" /> No
				<input type="radio" name="visible" value="1" /> Yes
			</p>
			<input type="submit" name="submit" value="Create Subject" />
		</form>
		<br />
		<a href="manage_content.php">Cancel</a>
	</div>
</div>
	
<?php include("../includes/footer.php"); ?>