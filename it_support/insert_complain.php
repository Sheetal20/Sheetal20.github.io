<?php
session_start();
include 'db_config.php';
try{
	if(isset($_POST['submit']))
	{
		$chck= mysqli_query($conn,"select * from add_complain where emp_id='".$_POST['emp_id']."' and type_id='".$_POST['type_id']."' and desc_id='".$_POST['desc_id']."' limit 1");
    if(mysqli_fetch_row($chck)) {
        $_SESSION['chckmessage']="This complain already exists.";
			session_write_close();
		    header('location:add_complain.php');
    exit;
      }
	  else{
    $sql="insert into add_complain (dept_id,emp_id,email,type_id,desc_id,it_id) values ('".$_POST['dept_id']."','".$_POST['emp_id']."','".$_POST['email']."','".$_POST['type_id']."','".$_POST['desc_id']."','".$_POST['it_id']."')";
    $query=mysqli_query($conn,$sql);    
    if($query){
        $_SESSION['successmessage']="Record inserted successfully";
		session_write_close();
         header('location:add_complain.php');
         exit;
    }else if(!$query){
         $_SESSION['warningmessage']="Failed to insert record";
		 session_write_close();
         header('location:add_complain.php');
    exit;
    }
	}
    }
} catch (Exception $ex) {
    $_SESSION['errormessage']=$ex->getMessage();
	session_write_close();
    header('location:add_complain.php');
    exit;
}
?>