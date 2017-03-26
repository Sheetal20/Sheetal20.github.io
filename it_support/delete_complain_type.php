<?php
session_start();
include 'db_config.php';
try{
	$sql="delete from complain_type where type_id='".$_GET['id']."'";
	$query=mysqli_query($conn,$sql);
	if($query){
		$_SESSION['delete_success']="Record deleted successfully";
	session_write_close();
		header("location:complain_type.php");
		exit;
	}
	else if(!$query){
		$_SESSION['delete_failed']="Failed to delete record";
	session_write_close();
		header("location:complain_type.php");
		exit;
	}
	
} catch (Exception $ex) {
    $_SESSION['errormessage']=$ex->getMessage();
	session_write_close();
    header('location:complain_type.php');
    exit;
}

?>