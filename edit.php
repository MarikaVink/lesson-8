<?php

	//required another php file
	require_once("../../config.php");

	//the variable doe not exist in the URL
	if(!isset($_GET["edit"])){
		
		//redirect user_error
		echo "redirect";
		
		header("Location: table.php");
		exit();//don't execute further
		}else{
			echo "User want to edit row:".$_GET["edit"];
		}
	
	
	
?>

<h2> First application </h2>
<br>
<a href="table.php">table</a>

<form method="get">
<label for="message"> Message:*</label><br>
<input type="text" name="message"><br>
<label for="to"> To:*</label><br>
<input type="text" name="to"><br>
<label for="from"> From:*</label><br>
<input type="from" name="from"><br>
<input type="submit" value="Save to DB"> 

	

</form>

