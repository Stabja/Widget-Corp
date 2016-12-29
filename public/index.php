<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php find_selected_page(); ?>

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
    $query = "SELECT * FROM subjects WHERE visible = 1 ";
	$query .= "ORDER BY position ASC";
	$result = mysqli_query($connection, $query);
	if(!$result){
		die("Database query failed.");
	}
?>

	<div id="main">
	    <div id="navigation">
		    <?php echo navigation($selected_subject_id, $selected_page_id); ?>
		</div>
		<div id="page">
			<h2> Manage Subject</h2>
			Menu name: <?php echo $current_subject["menu_name"]; ?>
			<br />
		</div>
	</div>
	
	<?php
	    mysqli_free_result($result);
	?>
	
<?php include("../includes/footer.php"); ?>