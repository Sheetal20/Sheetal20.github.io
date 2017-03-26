<?php
session_start();
include 'db_config.php';
$output='';
	$sql="select * from emp_details where emp_id='".$_POST['userId']."'";
    $result=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($result))
	{
		$output .='<option value="'.$row['email'].'">'.$row['email'].'</option>';
	}
	echo $output;
?>