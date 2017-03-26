<?php
$user='root';
$pass='';
$db_name='myproject';
$host='localhost';

$conn=mysqli_connect($host,$user,$pass,$db_name);
if(!$conn)
{
	die('Could not connect: '.mysqli_error($conn));
}
?>