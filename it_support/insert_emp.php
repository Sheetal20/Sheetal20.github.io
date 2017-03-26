<?php
session_start();
include 'db_config.php';
try{
	if(isset($_POST['submit']))
	{
	$chck= mysqli_query($conn,"select * from emp_details where emp_name='".$_POST['emp_name']."' and mob_no='".$_POST['mob_no']."' limit 1");
    if(mysqli_fetch_row($chck)) {
        $_SESSION['chckmessage']="This employee already exists.";
			session_write_close();
		    header('location:emp_reg.php');
    exit;
      }
	 else{ 
    $sql="insert into emp_details (emp_name,dept_id,system_ip,system_name,mob_no,email) values ('".$_POST[emp_name]."','".$_POST[dept_id]."','".$_POST[system_ip]."','".$_POST[system_name]."','".$_POST[mob_no]."','".$_POST[email]."')";
    $query=mysqli_query($conn,$sql);    
    if($query){
        $_SESSION['successmessage']="Record inserted successfully";
		session_write_close();
         header('location:emp_reg.php');
         exit;
    }else if(!$query){
         $_SESSION['warningmessage']="Failed to insert record";
		 session_write_close();
         header('location:emp_reg.php');
    exit;
    }
	}
	}
    
} catch (Exception $ex) {
    $_SESSION['errormessage']=$ex->getMessage();
	session_write_close();
    header('Location:emp_reg.php');
    exit;
}
?>