<?php
session_start();
include 'db_config.php';
try{
	if(isset($_POST['submit']))
	{
	$sql="update it_details set it_name='".$_POST['it_name']."',user_name='".$_POST['user_name']."',password='".$_POST['password']."',mob_no='".$_POST['mob_no']."',email='".$_POST['email']."' where it_id='".$_POST['it_id']."'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		$_SESSION['update_success']="Record updated successfully";
	session_write_close();
		header("location:it_details.php");
		exit;
	}
	else if(!$query)
	{
		$_SESSION['update_failed']="Failed to update record";
	session_write_close();
		header("location:it_details.php");
		exit;
	}
	}
	
} catch (Exception $ex) {
    $_SESSION['errormessge']=$ex->getMessage();
	session_write_close();
    header('location:it_details.php');
    exit;
}
?>