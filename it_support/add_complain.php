<?php
session_start();
include 'db_config.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Add Complain</title>
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
<ul class="nav navbar-nav">
<li><a href="admin_home.php"><strong><em>HOME</em></strong></a></li>
</ul>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
<li class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-family:georgia"><img src="admin3.jpg" class="img-circle"><strong><em>ADMIN</em></strong><span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a href="chng_pwd.php">Profile Settings</a></li>
<li><a href="logout.php">Logout</a></li>
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
<div class="panel-heading" style="font-family:georgia;color:black;background-color:#ffec80;"><div class="text-center"><strong>ADD COMPLAIN</strong></div></div>
<div class="panel-body" style="max-height:450px;overflow-y:scroll;">
<div class="row">
<div class="col-lg-12">
<?php if(isset($_SESSION['chckmessage'])){ ?>
<div class="alert bg-warning" >
<?php echo $_SESSION['chckmessage']; unset($_SESSION['chckmessage']); ?> 
<a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
</div>
<?php } ?>
<?php if(isset($_SESSION['successmessage'])){ ?>
<div class="alert bg-warning" >
<?php echo $_SESSION['successmessage']; unset($_SESSION['successmessage']); ?> 
<a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
</div>
<?php } ?>
<?php if(isset($_SESSION['warningmessage'])){ ?>
<div class="alert bg-warning" >
<?php echo $_SESSION['warningmessage'];unset($_SESSION['warningmessage']); ?> 
<a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
</div>
<?php } ?>
<?php if(isset($_SESSION['errormessage'])){ ?>
<div class="alert bg-danger" >
<?php echo $_SESSION['errormessage']; unset($_SESSION['errormessage']); ?>
<a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
</div>
<?php } ?>
</div>
</div>
<div id="wrapper">
<form role="form" method="POST" action="insert_complain.php">
<div class="container center_div1">
<div class="form-group">
<label for="dept_name">DEPARTMENT</label>
<select class="form-control" id="dept_id" name="dept_id" required="required">
<option value="">Select Department</option>
<?php
	$output='';
	$sql="select * from dept_details";
    $result=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($result))
	{
		$output .='<option value="'.$row['dept_id'].'">'.$row['dept_name'].'</option>';
	}
	echo $output;
?>
</select>
</div>
<div class="form-group">
<label for="emp_id">USERNAME</label>
<select class="form-control" id="emp_id" name="emp_id" required="required" >
<option value="">Select Username</option>
</select>
</div>
<div class="form-group">
<label for="email">EMAIL ID</label>
<select class="form-control" id="email" name="email" required="required">
<option value="">Select Email ID</option>
</select>
</div>
<div class="form-group">
<label for="type_name">COMPLAIN TYPE</label>
<select class="form-control" id="type_id" name="type_id" required="required">
<option value="">Select Complain Type</option>
<?php
	$output='';
	$sql="select * from complain_type";
    $result=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($result))
	{
		$output .='<option value="'.$row['type_id'].'">'.$row['type_name'].'</option>';
	}
	echo $output;
?>
</select>
</div>
<div class="form-group">
<label for="desc_name">COMPLAIN DESCRIPTION</label>
<select class="form-control" id="desc_id" name="desc_id" required="required">
<option value="">Select Complain Description</option>
</select>
</div>
<div class="form-group">
<label for="it_name">FORWARD COMPLAIN TO</label>
<select class="form-control" id="it_id" name="it_id" required="required">
<option value="">Select IT Team</option>
<?php
	$output='';
	$sql="select * from it_details";
    $result=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($result))
	{
		$output .='<option value="'.$row['it_id'].'">'.$row['it_name'].'</option>';
	}
	echo $output;
?>
</select>
</div>
<br><br>
<div class="form-group">
<button type="submit" name="submit" class="btn btn-success">SUBMIT</button>   
<button type="reset" value="RESET" class="btn btn-danger pull-right">RESET</button>
</div>
</div>
</form>
</div>
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




