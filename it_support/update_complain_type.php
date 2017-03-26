<?php
session_start();
include 'db_config.php';
try{
	if(isset($_POST['submit']))
	{
    $type_name=$_POST['type_name'];
	$sql="update complain_type set type_name='".$type_name."' where type_id='".$_POST['type_id']."'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		$_SESSION['update_success']="Record updated successfully";
	session_write_close();
		header("location:complain_type.php");
		exit;
	}
	else if(!$query)
	{
		$_SESSION['update_failed']="Failed to update record";
	session_write_close();
		header("location:complain_type.php");
		exit;
	}
	}
	
} catch (Exception $ex) {
    $_SESSION['errormessge']=$ex->getMessage();
	session_write_close();
    header('location:complain_type.php');
    exit;
}

?>