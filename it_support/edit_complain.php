<?php
session_start();
include 'db_config.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Edit Complain</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap/css/login1.css" rel="stylesheet">
</head>
<style>
body{
	background-image:url("bckg1.jpg");
}
.img-circle{
	height:20px;
	width:auto;
}
.navbar-inverse .navbar-nav > li > a {
  color:white;
}
.navbar-inverse .navbar-nav > li > a:hover,
.navbar-inverse .navbar-nav > li > a:focus {
  color:blue;
  background-color: transparent;
}
</style>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="15" style="overflow-y:scroll">
<?php
try{
	if(isset($_POST['submit']))
	{
	$sql="update add_complain set dept_id='".$_POST['dept_id']."', emp_id='".$_POST['emp_id']."',type_id='".$_POST['type_id']."',desc_id='".$_POST['desc_id']."',email='".$_POST['email']."',it_id='".$_POST['it_id']."' where complain_id='".$_POST['complain_id']."'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		$_SESSION['update_success']="Record updated successfully";
	session_write_close();
		header("location:user_complain.php");
		exit;
	}
	else if(!$query)
	{
		$_SESSION['update_failed']="Failed to update record";
	session_write_close();
		header("location:user_complain.php");
		exit;
	}
	}
	
} catch (Exception $ex) {
    $_SESSION['errormessge']=$ex->getMessage();
	session_write_close();
    header('location:user_complain.php');
    exit;
}

?>
<nav class="navbar navbar-inverse navbar-fixed-top" style="border-radius:0px">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#"><img src="logo3.png" height="100%" width="auto" class="img-circle"></a>
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
<li class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-family:georgia"><img src="admin3.jpg" class="img-circle"><strong><em>ADMIN</em></strong><span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a href="chng_pwd.php">Profile Settings</a></li>
<li><a href="#">Logout</a></li>
</ul>
</li>
</ul>
</div>
</div>
</nav>
<div class="row" style="padding-top:80px">
<div class="container-fluid">
<nav class="col-sm-2" id="myScrollspy">
<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">
<li class="dropdown">
<a class="dropdown-toggle" id="1" href="#" style="color:#990026"><strong>MANAGE USERS</strong><span class="caret"></span></a>
<ul id="1-1" style="list-style-type:none">
<li><a href="dept.php" style="color:#990026"><strong>DEPARTMENT DETAILS</strong></a></li>
<li><a href="user_details.php" style="color:#990026" class="active" ><strong>USER DETAILS</strong></a></li>
<li><a href="it_details.php" style="color:#990026"><strong>IT TEAM</strong></a></li>
<li><a href="complain_type.php" style="color:#990026"><strong>COMPLAIN TYPE DETAILS</strong></a></li>
<li><a href="complain_desc.php" style="color:#990026"><strong>COMPLAIN DESCRIPTION</strong></a></li>
</ul>
</li>
<li class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" id="2" href="#" style="color:#990026"><strong>MANAGE COMPLAIN</strong><span class="caret"></span></a>
<ul id="2-1" style="list-style-type:none">
<li><a class="active" href="user_complain.php" style="color:#990026"><strong>USER COMPLAIN</strong></a></li>
<li><a href="complain_report.php" style="color:#990026"><strong>COMPLAIN REPORTS</strong></a></li>
</ul>
</li>
</ul>
</nav>
<div class="col-sm-10">
<div class="panel panel-default">
<div class="panel-heading" style="font-family:georgia;color:black;background-color:#ffec80;"><div class="text-center"><strong>EDIT COMPLAIN</strong></div></div>
<div class="panel-body" style="max-height:300px;overflow-y:scroll;">
<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="container center_div">
<?php
$sql1="select * from add_complain inner join dept_details on add_complain.dept_id=dept_details.dept_id inner join emp_details on add_complain.emp_id=emp_details.emp_id inner join complain_type on add_complain.type_id=complain_type.type_id inner join complain_desc on add_complain.desc_id=complain_desc.desc_id inner join it_details on add_complain.it_id=it_details.it_id where complain_id='".$_GET['id']."'";
$query1=mysqli_query($conn,$sql1);
foreach ($query1 as $dm){
?>
<div class="form-group">
<label for="dept_name">DEPARTMENT</label>
<select name="dept_id" id="dept_id" class="form-control">
<option value="">Select</option>
<?php
$sql5="select * from dept_details";
$query5=mysqli_query($conn,$sql5);
foreach ($query5 as $data5){
?>
<option <?php echo ($data5['dept_id']==$dm['dept_id']?'selected="selected"' : '') ?> value="<?php echo $data5['dept_id']; ?>"><?php echo $data5['dept_name']; ?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label for="emp_name">USERNAME</label>
<select name="emp_id" id="emp_id" class="form-control">
<option value="">Select</option>
<?php
$sql6="select * from emp_details";
$query6=mysqli_query($conn,$sql6);
foreach ($query6 as $data6){
?>
<option <?php echo ($data6['emp_id']==$dm['emp_id']?'selected="selected"' : '') ?> value="<?php echo $data6['emp_id']; ?>"><?php echo $data6['emp_name']; ?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label for="email">EMAIL ID</label>
<select name="email" id="email" class="form-control">
<option value="">Select</option>
<?php
$sql7="select * from emp_details";
$query7=mysqli_query($conn,$sql7);
foreach ($query7 as $data7){
?>
<option <?php echo ($data7['email']==$dm['email']?'selected="selected"' : '') ?> value="<?php echo $data7['email']; ?>"><?php echo $data7['email']; ?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label for="type_name">SELECT COMPLAIN TYPE</label>
<select name="type_id" id="type_id" class="form-control">
<option value="">Select</option>
<?php
$sql2="select * from complain_type";
$query2=mysqli_query($conn,$sql2);
foreach ($query2 as $data){
?>
<option <?php echo ($data['type_id']==$dm['type_id']?'selected="selected"' : '') ?> value="<?php echo $data['type_id']; ?>"><?php echo $data['type_name']; ?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label for="desc_name">COMPLAIN DESCRIPTION</label>
<select class="form-control" id="desc_id" name="desc_id" required="required">
<option value="">Select Complain Description</option>
<?php
$sql4="select * from complain_desc";
$query4=mysqli_query($conn,$sql4);
foreach ($query4 as $data1){
?>
<option <?php echo ($data1['desc_id']==$dm['desc_id']?'selected="selected"' : '') ?> value="<?php echo $data1['desc_id']; ?>"><?php echo $data1['desc_name']; ?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label for="it_name">FORWARD TO</label>
<select name="it_id" id="it_id" class="form-control">
<option value="">Select</option>
<?php
$sql3="select * from it_details";
$query3=mysqli_query($conn,$sql3);
foreach ($query3 as $dt){
?>
<option <?php echo ($dt['it_id']==$dm['it_id']?'selected="selected"' : '') ?> value="<?php echo $dt['it_id']; ?>"><?php echo $dt['it_name']; ?></option>
<?php } ?>
</select>
</div>
<input type="hidden" name="complain_id" value="<?php echo $dm['complain_id'];?>">
<button type="submit" class="btn btn-info" name="submit" >UPDATE</button>
<?php }?>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<script src="bootstrap/js/jQuery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script> 
$(document).ready(function(){
	$("#1-1").hide();
	$("#2-1").hide();
});
$(document).ready(function(){
    $("#1").click(function(){
        $("#1-1").slideToggle("slow");
		$("#2-1").slideUp("slow");
    });
});
$(document).ready(function(){
    $("#2").click(function(){
        $("#2-1").slideToggle("slow");
		$("#1-1").slideUp("slow");
    });
});
</script>
<script>
$(document).ready(function(){
	$('#dept_id').change(function(){
		var dept=$(this).val();
		$.ajax({
			url:"user_fetch.php",
			method:"POST",
			data:{deptId:dept},
			dataType:"text",
			success:function(data)
			{
				$('#emp_id').html(data);
			}
		});
	});
	$('#emp_id').change(function(){
		var emp=$(this).val();
		$.ajax({
			url:"email_fetch.php",
			method:"POST",
			data:{userId:emp},
			dataType:"text",
			success:function(data)
			{
				$('#email').html(data);
			}
		});
	});
});
</script>
<script>
$(document).ready(function(){
	$('#type_id').change(function(){
		var type=$(this).val();
		$.ajax({
			url:"desc_fetch.php",
			method:"POST",
			data:{typeId:type},
			dataType:"text",
			success:function(data)
			{
				$('#desc_id').html(data);
			}
		});
	});
});
</script>
</body>
</html>