<?php
session_start();
include 'db_config.php';
try{
	if(isset($_POST['submit']))
	{
	$sql="update emp_details set dept_id='".$_POST['dept_id']."', emp_name='".$_POST['emp_name']."',system_ip='".$_POST['system_ip']."',system_name='".$_POST['system_name']."',mob_no='".$_POST['mob_no']."',email='".$_POST['email']."' where emp_id='".$_POST['emp_id']."'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		$_SESSION['update_success']="Record updated successfully";
	session_write_close();
		header("location:user_details.php");
		exit;
	}
	else if(!$query)
	{
		$_SESSION['update_failed']="Failed to update record";
	session_write_close();
		header("location:user_details.php");
		exit;
	}
	}
	
} catch (Exception $ex) {
    $_SESSION['errormessge']=$ex->getMessage();
	session_write_close();
    header('location:user_details.php');
    exit;
}

?>