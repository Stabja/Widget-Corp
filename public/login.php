<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    if(isset($_POST["submit"])){
		$username = $_POST["username"];
		$hashed_password = $_POST["password"];
		
		$query = "SELECT * FROM admins ";
		$query .= "WHERE username = '{$username}' AND hashed_password = '{$hashed_password}'";
		$result = mysqli_query($connection, $query);
		$check = mysqli_fetch_array($result);
		
		if(isset($check)){
		    $_SESSION["message"] = "Login Successful";
		    redirect_to("admin.php");
	    }else{
		    $_SESSION["message"] = "Invalid username or password";
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
	  <?php echo message(); ?>
	  <h2>Login</h2>
	  <form action="login.php" method="post">
	    <p>Username:
	      <input type="text" name="username" value="" />
	    </p>
	    <p>Password:
	      <input type="password" name="password" value="" />
	    </p>
	    <input type="submit" name="submit" value="Login" />
	  </form>
	</div>
</div>

<?php include("../includes/footer.php"); ?>