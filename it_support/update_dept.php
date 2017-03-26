<?php
session_start();
include 'db_config.php';
try{
	if(isset($_POST['submit']))
	{
    $dept_name=$_POST['dept_name'];
	$sql="update dept_details set dept_name='".$dept_name."' where dept_id='".$_POST['dept_id']."'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		$_SESSION['update_success']="Record updated successfully";
	session_write_close();
		header("location:dept.php");
		exit;
	}
	else if(!$query)
	{
		$_SESSION['update_failed']="Failed to update record";
	session_write_close();
		header("location:dept.php");
		exit;
	}
	}
	
} catch (Exception $ex) {
    $_SESSION['errormessge']=$ex->getMessage();
	session_write_close();
    header('location:dept.php');
    exit;
}

?>