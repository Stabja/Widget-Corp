<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php

    if(isset($_GET["subject"])){
		$current_subject = get_subject_by_id($_GET["subject"]);
		if(!$current_subject){
			redirect_to("manage_content.php");
		}
	}
	
	$id = $current_subject["id"];
	$query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
	$result = mysqli_query($connection, $query);
	
	if($result){
		$_SESSION["message"] = "Subject Deleted.";
		redirect_to("manage_content.php");
	}else{
		$_SESSION["message"] = "Subject Deletion Failed.";
		redirect_to("new_subject.php");	
	}

?>