<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    $admin = find_admin_by_id($_GET["id"]);
	if(!$admin){
		redirect_to("manage_admins.php");
	}
?>

<?php
    if(isset($_POST["submit"])){
		$id = $admin["id"];
		$username = $_POST["username"];
		$hashed_password = $_POST["password"];
		
		$query = "UPDATE admins SET ";
		$query .= "username = '{$username}', ";
		$query .= "hashed_password = '{$hashed_password}' ";
		$query .= "WHERE id = {$id} ";
		$result = mysqli_query($connection, $query);
		
		if($result){
		    $_SESSION["message"] = "Admin Updated.";
		    redirect_to("manage_admins.php");
	    }else{
		    $_SESSION["message"] = "Admin update failed.";
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
	  <h2>Edit Admin: <?php echo htmlentities($admin["username"]) ?></h2>
	  <form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
	    <p>Username:
	      <input type="text" name="username" value="<?php echo htmlentities($admin["username"]); ?>" />
	    </p>
	    <p>Password:
	      <input type="password" name="password" value="" />
	    </p>
	    <input type="submit" name="submit" value="Edit Admin" />
	  </form>
	  <br />
	  <a href="manage_admins.php">Cancel</a>
	</div>
</div>

<?php include("../includes/footer.php"); ?>