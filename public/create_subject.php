<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    if(isset($_POST["submit"])){
		
		//Process the form
		$menu_name = $_POST["menu_name"];
		$position = $_POST["position"];
		$visible = $_POST["visible"];
		
		//Escape all strings
		$menu_name = mysqli_real_escape_string($connection, $menu_name);
		
		//Perform database query
		$query = "INSERT INTO subjects (menu_name, position, visible)";
		$query .= "VALUES ( '{$menu_name}', '{$position}', '{$visible}' )";
		$result = mysqli_query($connection, $query);
		
		if($result){
			$_SESSION["message"] = "Subject created.";
			redirect_to("manage_content.php");
		}else{
			$_SESSION["message"] = "Subject creation failed.";
		    redirect_to("new_subject.php");	
		}
		
	}else{
		redirect_to("new_subject.php");
	}
	
?>

<?php
    if(isset($connection)){
		mysqli_close($connection);
	}
?>