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
	
	//ask for latest data for a single row
	$mysql = new mysqli("localhost",$db_username, $db_password,"webpr2016_marvin");
	
	//maybe user wants to update data after clicking the button
	if(isset($_GET["to"]) && isset($_GET["message"]) && isset($_GET["from"])){
		
		echo "User modified data, tries to save";
		
		//should be validation?
		
		$stmt = $mysql->prepare("UPDATE messages_sample SET recipient=?, message=?, sender=? WHERE id=?");
		
		echo $mysql->error;
		
		$stmt->bind_param("sssi", $_GET["to"], $_GET["message"], $_GET["from"], $_GET["edit"]);
		
		if($stmt->execute()){
				
				echo "saved successfully"; 
				
				//option one - redirect
				
				header("Location: table.php");
				exit();
				
				//option two - update variables
				
				//$id = $_GET["edit"];
				//$recipient = $_GET["to"];
				//$message = $_GET["message"];
				//$sender = $_GET["from"];
				
				
				}else{
					echo $stmt->error;
			}
	}else{
		
		//user did not click any buttons yet,
			//give user latest data from db
	$stmt = $mysql->prepare("SELECT id, recipient, message, sender, created FROM messages_sample WHERE id=?");
	
	echo $mysql->error;
	
	//replace the ? mark
	$stmt->bind_param("i",$_GET["edit"]);
	
	//bind result data
	$stmt->bind_result($id, $recipient, $message, $sender, $created);
	
	$stmt->execute();
	
	//we have only 1 row of data
	if($stmt->fetch()){
	
		//we had data
	echo $id." ".$recipient." ".$message." ".$sender;
	
	}else{
		
		//smth went wrong
		echo $stmt->error;
	}
		
	}
	
	
?>
<br>
<h2> First application </h2>
<br>
<a href="table.php">table</a>

<form method="get">

<input hidden name="edit" value="<?=$id;?>"><br><br>

<label for="message"> Message:*</label><br>
<input type="text" name="message" value="<?php echo $message; ?>"><br>
<label for="to"> To:*</label><br>
<input type="text" name="to" value="<?php echo $recipient; ?>"><br>
<label for="from"> From:*</label><br>
<input type="from" name="from" value="<?php echo $sender; ?>"><br>
<input type="submit" value="Save to DB"> 

	

</form>

