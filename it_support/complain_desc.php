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
<title>Complain Description</title>
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
		$chck= mysqli_query($conn,"select * from complain_desc where type_id='".$_POST['type_id']."' and desc_name='".$_POST['desc_name']."' limit 1");
    if(mysqli_fetch_row($chck)) {
        $_SESSION['chckmessage']="This complain description already exists for this complain type.";
			session_write_close();
		    header('location:complain_desc.php');
    exit;
      }
	  else{
    $sql="insert into complain_desc(desc_name,type_id) values ('".$_POST['desc_name']."','".$_POST['type_id']."')";
    $query=mysqli_query($conn,$sql);    
    if($query){
        $_SESSION['successmessage']="Record inserted successfully";
		session_write_close();
         header('location:complain_desc.php');
         exit;
    }else if(!$query){
         $_SESSION['warningmessage']="Failed to insert record";
		 session_write_close();
         header('location:complain_desc.php');
    exit;
    }
	}
    }
} catch (Exception $ex) {
    $_SESSION['errormessage']=$ex->getMessage();
	session_write_close();
    header('location:complain_desc.php');
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
<li><a href="#" style="color:#990026"><strong>COMPLAIN DESCRIPTION</strong></a></li>
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
<div class="panel-heading" style="font-family:georgia;color:black;background-color:#ffec80;"><div class="text-center"><strong>COMPLAIN DESCRIPTION</strong></div></div>
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
<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="container center_div1">
<div class="form-group">
<label for="type_name">SELECT COMPLAIN TYPE</label>
<select class="form-control" id="type_id" name="type_id" required="required">
<option value="">Select</option>
<?php
$sql="select * from complain_type";
$query=mysqli_query($conn,$sql);
foreach ($query as $data){
?>
<option value="<?php echo $data['type_id']; ?>"><?php echo $data['type_name']; ?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label for="desc_name">ENTER COMPLAIN DESCRIPTION</label>
<textarea class="form-control" rows="4" id="desc_name" name="desc_name" required="required"></textarea>
</div>
<div class="form-group">
<button type="submit" name="submit" class="btn btn-success">ADD</button>   
<button type="reset" value="RESET" class="btn btn-danger pull-right">RESET</button>
</div>
</div>
</form>
<br>
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
<br>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th class="text-center">COMPLAIN TYPE</th>
<th class="text-center">COMPLAIN DESCRIPTION</th>
<th class="text-center">EDIT</th>
<th class="text-center">DELETE</th>
</tr>
</thead>
<tbody>
<?php
$sql="select * from complain_desc inner join complain_type on complain_desc.type_id=complain_type.type_id";
$query=mysqli_query($conn,$sql);
foreach ($query as $tb){
?>
<tr>
<td class="text-center" ><?php echo $tb['type_name']; ?></td>
<td class="text-center" ><?php echo $tb['desc_name']; ?></td>
<td><button class="btn btn-success" data-toggle="modal" data-target="#editModal<?php echo $tb['desc_id']; ?>">Edit</button></td>
<td><a class="btn btn-danger" href="delete_desc.php?id=<?php echo $tb['desc_id']; ?>">Delete</a></td>
</tr>

<div class="modal fade" id="editModal<?php echo $tb['desc_id']; ?>" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form class="form-inline" role="form" method="post" action="update_desc.php">
<div class="container center_div">
<?php
$sql1="select * from complain_desc inner join complain_type on complain_desc.type_id=complain_type.type_id where desc_id ='".$tb['desc_id']."'";
$query1=mysqli_query($conn,$sql1);
foreach ($query1 as $dm){
?>
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
<label for="desc_name">DESCRIPTION NAME</label>
<input type="text" class="form-control" name="desc_name" id="desc_name" value="<?php echo $dm['desc_name'];?>" required="required"/>
</div>
<input type="hidden" name="desc_id" value="<?php echo $dm['desc_id'];?>">
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