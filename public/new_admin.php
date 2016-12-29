<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    if(isset($_POST["submit"])){
		$required_fields = array("username", "password");
		
		$fields_with_max_lengths = array("username" => 30);
		
		$username = $_POST["username"];
		$hashed_password = $_POST["password"];
		
		$query = "INSERT INTO admins (username, hashed_password)";
		$query .= "VALUES('{$username}', '{$hashed_password}')";
		$result = mysqli_query($connection, $query);
		
		if($result){
		    $_SESSION["message"] = "Admin Created.";
		    redirect_to("manage_admins.php");
	    }else{
		    $_SESSION["message"] = "Admin Creation Failed.";
	    }
	}
?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/header.php"); ?>
<div id="main">
    <div id="navigation">
	  &nbsp;
	</div>
	<div id="page">
	  <h2>Create Admin</h2>
	  <form action="new_admin.php" method="post">
	    <p>Username:
	      <input type="text" name="username" value="" />
	    </p>
	    <p>Password:
	      <input type="password" name="password" value="" />
	    </p>
	    <input type="submit" name="submit" value="Create Admin" />
	  </form>
	  <br />
	  <a href="manage_admins.php">Cancel</a>
	</div>
</div>

<?php include("../includes/footer.php"); ?>