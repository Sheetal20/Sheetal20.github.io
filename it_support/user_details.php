<?php
session_start();
?>
<!doctype html>
<?php
include 'db_config.php';
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>User Details</title>
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
<li><a href="#" style="color:#990026" class="active" ><strong>USER DETAILS</strong></a></li>
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
<div class="panel-heading" style="font-family:georgia;color:black;background-color: #ffec80;"><div class="text-center"><strong>USER DETAILS</strong></div></div>
<div class="panel-body" style="max-height:500px;overflow-y:scroll;">
<form role="form" action="emp_reg.php">
<button type="submit" class="btn btn-warning pull-right"><span class="glyphicon glyphicon-plus"></span>ADD EMPLOYEE</button>
</form>
<div class="row">
<div class="col-lg-12">
<?php if(isset($_SESSION['update_success'])){ ?>
<div class="alert bg-warning" >
<?php echo $_SESSION['update_success']; unset($_SESSION['update_success']); ?> 
<a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
</div>
<?php } ?>
<?php if(isset($_SESSION['update_failed'])){ ?>
<div class="alert bg-warning" >
<?php echo $_SESSION['update_failed'];unset($_SESSION['update_failed']); ?> 
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
<div class="row">
<div class="col-lg-12">
<?php if(isset($_SESSION['delete_success'])){ ?>
<div class="alert bg-warning" >
<?php echo $_SESSION['delete_success']; unset($_SESSION['delete_success']); ?> 
<a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
</div>
<?php } ?>
<?php if(isset($_SESSION['delete_failed'])){ ?>
<div class="alert bg-warning" >
<?php echo $_SESSION['delete_failed'];unset($_SESSION['delete_failed']); ?> 
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
<br><br>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th class="text-center">DEPARTMENT</th>
<th class="text-center">USERNAME</th>
<th class="text-center">SYSTEM NAME</th>
<th class="text-center">SYSTEM IP</th>
<th class="text-center">MOBILE NO.</th>
<th class="text-center">EMAIL ID</th>
<th class="text-center">EDIT</th>
<th class="text-center">DELETE</th>
</tr>
</thead>
<tbody >
<?php
$sql="select * from emp_details inner join dept_details on emp_details.dept_id=dept_details.dept_id";
$query=mysqli_query($conn,$sql);
foreach ($query as $tb){
?>
<tr>
<td><?php echo $tb['dept_name']; ?></td>
<td><?php echo $tb['emp_name']; ?></td>
<td><?php echo $tb['system_name']; ?></td>
<td><?php echo $tb['system_ip']; ?></td>
<td><?php echo $tb['mob_no']; ?></td>
<td><?php echo $tb['email']; ?></td>
<td><button class="btn btn-success" data-toggle="modal" data-target="#editModal<?php echo $tb['emp_id']; ?>">Edit</button></td>
<td><a class="btn btn-danger" href="delete_emp.php?id=<?php echo $tb['emp_id']; ?>">Delete</a></td>
</tr>

<div class="modal fade" id="editModal<?php echo $tb['emp_id']; ?>" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form class="form-inline" role="form" method="post" action="update_emp.php">
<div class="container center_div">
<?php
$sql1="select * from emp_details inner join dept_details on emp_details.dept_id=dept_details.dept_id where emp_id ='".$tb['emp_id']."'";
$query1=mysqli_query($conn,$sql1);
foreach ($query1 as $dm){
?>
<div class="form-group">
<label for="dept_name">SELECT DEPARTMENT</label>
<select name="dept_id" id="dept_id" class="form-control">
<option value="">Select</option>
<?php
$sql2="select * from dept_details";
$query2=mysqli_query($conn,$sql2);
foreach ($query2 as $data){
?>
<option <?php echo ($data['dept_id']==$dm['dept_id']?'selected="selected"' : '') ?> value="<?php echo $data['dept_id']; ?>"><?php echo $data['dept_name']; ?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label for="emp_name">EMPLOYEE NAME</label>
<input type="text" class="form-control" name="emp_name" id="emp_name" value="<?php echo $dm['emp_name'];?>" required="required"/>
</div>
<div class="form-group">
<label for="system_ip">EMPLOYEE SYSTEM IP ADDRESS</label>
<input type="text" class="form-control" name="system_ip" id="system_ip" value="<?php echo $dm['system_ip'];?>" required="required"/>
</div>
<div class="form-group">
<label for="system_name">SYSTEM NAME</label>
<input type="text" class="form-control" name="system_name" id="system_name" value="<?php echo $dm['system_name'];?>" required="required"/>
</div>
<div class="form-group">
<label for="mob_no">MOBILE NO.</label>
<input type="text" class="form-control" name="mob_no" pattern="^[789]\d{9}$" id="mob_no" value="<?php echo $dm['mob_no'];?>" required="required"/>
</div>
<div class="form-group">
<label for="email">EMAIL ID</label>
<input type="email" class="form-control" name="email" id="email" value="<?php echo $dm['email'];?>" required="required"/>
</div>
<input type="hidden" name="emp_id" value="<?php echo $dm['emp_id'];?>">
<button type="submit" class="btn btn-info" name="submit" >UPDATE</button>
<?php }?>
</div>
</form>
</div>
</div>
</div>
</div>
<?php } ?>
</tbody>
</table>
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
</body>
</html>