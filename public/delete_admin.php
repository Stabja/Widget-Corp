<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    $admin = find_admin_by_id($_GET["id"]);
	if(!$admin){
		redirect_to("manage_admins.php");
	}
	
	$id = $admin["id"];
	$query = "DELETE FROM admins WHERE id = {$id}";
	$result = mysqli_query($connection, $query);
	
	if($result){
		$_SESSION["message"] = "Admin Deleted.";
		redirect_to("manage_admins.php");
	}else{
		$_SESSION["message"] = "Admin deletion failed.";
		redirect_to("manage_admins.php");
	}
	
?>