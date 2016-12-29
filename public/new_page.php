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
    if(!$current_subject["id"]){
		redirect_to("manage_content.php");
	}
?>

<?php
    if(isset($_POST["submit"])){
		$subid = $current_subject["id"];
        $menuname = $_POST["menu_name"];
	    $position = (int)$_POST["position"];
	    $visible = (int)$_POST["visible"];
	    $content = $_POST["content"];
	
	    $query = "INSERT INTO pages(subject_id, menu_name, position, visible, content)";
	    $query .= "VALUES ( {$subid}, '{$menuname}', {$position}, {$visible}, '{$content}' )";
	    $result = mysqli_query($connection, $query);
	
	    if($result){
		    $_SESSION["message"] = "Page Created.";
		    redirect_to("manage_content.php");
	    }else{
		    $_SESSION["message"] = "Page Creation Failed.";
	    }
		
	}
    
	
?>

<?php include("../includes/header.php"); ?>

<div id="main">
	<div id="navigation">
		<?php echo navigation($selected_subject_id, $selected_page_id); ?>
	</div>
	<div id="page">
	    <h2>Create Page</h2>
		<form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="post" >
	        <p>Menu name:
			    <input type="text" name="menu_name" value="" />
			</p>
			<p>Position:
			    <select name="position">
				<?php
				    $page_set = get_pages_for_subject($current_subject["id"]);
					$page_count = mysqli_num_rows($page_set);
					for($count = 1; $count <= ($page_count + 1); $count++){
						echo "<option value=\"{$count}\">{$count}</option>";
					}
				?>
				</select>
			</p>
			<p>Visible:
			    <input type="radio" name="visible" value="0" /> No
				&nbsp;
				<input type="radio" name="visible" value="1" /> Yes
			</p>
			<p>Content:<br />
			    <textarea name="content" rows="20" cols="80"></textarea>
			</p>
			<input type="submit" name="submit" value="Create Page" />
		</form>
		<br />
		<a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]); ?>">Cancel</a>
	</div>
</div>

<?php include("../includes/footer.php"); ?>
					
					