<?php
session_start();
include 'db_config.php';
try{

	$sql="update add_complain set complain_status='Resolved' , resolve_date=curdate() , resolve_time=curtime() where complain_id='".$_GET['id']."'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		$_SESSION['update_success']="Record updated successfully";
	session_write_close();
		header("location:it_home.php");
		exit;
	}
	else if(!$query)
	{
		$_SESSION['update_failed']="Failed to update record";
	session_write_close();
		header("location:it_home.php");
		exit;
	}
	
} catch (Exception $ex) {
    $_SESSION['errormessge']=$ex->getMessage();
	session_write_close();
    header('location:it_home.php');
    exit;
}

?>