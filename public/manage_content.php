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
		$current_page = get_page_by_id($selected_page_id);
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
			<br />
			<a href="new_subject.php">+ Add a subject</a>
		</div>
		<div id="page">
		    <?php echo message(); ?>
		    <?php if($selected_subject_id) { ?>
			<h2> Manage Subject</h2>
			Menu name: <?php echo $current_subject["menu_name"]; ?>
			<br />
			Position: <?php echo $current_subject["position"]; ?>
			<br />
			Visible: <?php echo $current_subject["visible"]; ?>
			<br />
			<br />
			<a href="edit_subject.php?subject=<?php echo $current_subject["id"]; ?>">Edit Subject</a>
			<br />
			<br />
			<a href="new_page.php?subject=<?php echo $current_subject["id"]; ?>">New Page</a>
			
			<?php } elseif($selected_page_id){ ?>
			<h2>Manage Page</h2>
			<?php $current_page = get_page_by_id($selected_page_id); ?>
			Menu name: <?php echo $current_page["menu_name"]; ?><br />
			<br />
			<a href="edit_page.php?page=<?php echo $current_page["id"]; ?>">Edit Page</a>
			<?php } else { ?>
			    Please select a subject or a page.
			<?php }?>
		</div>
	</div>
	
	<?php
	    mysqli_free_result($result);
	?>
	
<?php include("../includes/footer.php"); ?>