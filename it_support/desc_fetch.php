<?php
session_start();
include 'db_config.php';
$output='';
	$sql="select * from complain_desc where type_id='".$_POST['typeId']."'";
    $result=mysqli_query($conn,$sql);
	$output='<option value="">Select Complain Description</option>';
	while($row=mysqli_fetch_array($result))
	{
		$output .='<option value="'.$row['desc_id'].'">'.$row['desc_name'].'</option>';
	}
	echo $output;
?>