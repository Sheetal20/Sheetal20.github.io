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
<link href="bootstrap/css/dept.css" rel="stylesheet">
</head>
<body>
<div class="row">
<div class="container-fluid">
<nav class="col-sm-3" id="myScrollspy">
<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">
<li class="dropdown">
<a class="dropdown-toggle" id="1" href="#">MANAGE USERS<span class="caret"></span></a>
<ul id="1-1" style="list-style-type:none">
<li><a href="dept.php">DEPARTMENT DETAILS</a></li>
<li><a href="user_details.php">USER DETAILS</a></li>
<li><a href="it_details.php">IT TEAM</a></li>
<li><a href="complain_type.php">COMPLAIN TYPE DETAILS</a></li>
<li><a href="complain_desc.php">COMPLAIN DESCRIPTION</a></li>
</ul>
</li>
<li >
<a class="dropdown-toggle" data-toggle="dropdown" id="2" href="#">MANAGE COMPLAIN<span class="caret"></span></a>
<ul id="2-1" style="list-style-type:none">
<li><a class="active" href="user_complain.php">USER COMPLAIN</a></li>
<li><a href="#">COMPLAIN REPORTS</a></li>
</ul>
</li>
</ul>
</nav>
<div class="col-sm-9">
<div class="panel panel-primary">
<div class="panel-heading"><div class="text-center">ADD COMPLAIN</div></div>
<div class="panel-body" style="max-height:10;overflow-y:scroll;">
<div class="row">
<div class="col-lg-12">
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
			url:"update_user_fetch.php",
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
			url:"update_email_fetch.php",
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
			url:"update_desc_fetch.php",
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




