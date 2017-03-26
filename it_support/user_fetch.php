<?php
session_start();
include 'db_config.php';
$output='';
	$sql="select * from emp_details where dept_id='".$_POST['deptId']."' order by emp_name";
    $result=mysqli_query($conn,$sql);
	$output='<option value="">Select Username</option>';
	while($row=mysqli_fetch_array($result))
	{
		$output .='<option value="'.$row['emp_id'].'">'.$row['emp_name'].'</option>';
	}
	echo $output;
?>