<?php
session_start();
include 'db_config.php';
try{
	if(isset($_POST['submit']))
	{
	$sql="update complain_desc set desc_name='".$_POST['desc_name']."',type_id='".$_POST['type_id']."' where desc_id='".$_POST['desc_id']."'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		$_SESSION['update_success']="Record updated successfully";
	session_write_close();
		header("location:complain_desc.php");
		exit;
	}
	else if(!$query)
	{
		$_SESSION['update_failed']="Failed to update record";
	session_write_close();
		header("location:complain_desc.php");
		exit;
	}
	}
	
} catch (Exception $ex) {
    $_SESSION['errormessge']=$ex->getMessage();
	session_write_close();
    header('location:complain_desc.php');
    exit;
}

?>