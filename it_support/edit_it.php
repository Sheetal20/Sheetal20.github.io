<?php
session_start();
include 'db_config.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Edit Profile</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap/css/login1.css" rel="stylesheet">
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
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="15" style="overflow-y:scroll">
<?php
try{
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
	$sql="update it_details set it_name='".$_POST['it_name']."',user_name='".$_POST['user_name']."',mob_no='".$_POST['mob_no']."',email='".$_POST['email']."' where it_id='".$_POST['it_id']."'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		$_SESSION['username']=$_POST['user_name'];
		$_SESSION['update_success']="Record updated successfully";
	session_write_close();
		header("location:edit_it.php");
		exit;
	}
	else if(!$query)
	{
		$_SESSION['update_failed']="Failed to update record";
	session_write_close();
		header("location:edit_it.php");
		exit;
	}
	}
	
} catch (Exception $ex) {
    $_SESSION['errormessge']=$ex->getMessage();
	session_write_close();
    header('location:edit_it.php');
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
<li><a href="it_home.php"><strong><em>HOME</em></strong></a></li>
</ul>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
<li class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="admin3.jpg" class="img-circle">
<strong><em>Hello <?php echo $_SESSION['username']; ?></em></strong><span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a href="chng_pwd_it.php">Change Password</a></li>
<li><a href="#">Edit Profile</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</li>
</ul>
</div>
</div>
</nav>
<br><br><br><br><br>
<div class="row">
<div class="container-fluid">
<div class="col-sm-1">
</div>
<div class="col-sm-10">
<div class="panel panel-default">
<div class="panel-heading" style="font-family:georgia;color:black;background-color:#ffec80;"><div class="text-center"><strong>EDIT PROFILE</strong></div></div>
<div class="panel-body" style="max-height:300px;overflow-y:scroll;">
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
<form role="form" method="POST" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
<?php
$sql="select * from it_details where user_name='".$_SESSION['username']."'"; 
$query=mysqli_query($conn,$sql);
foreach($query as $tb){
?>
<div class="container center_div2">
<div class="form-group">
<label for="it_name">EMPLOYEE NAME</label>
<input type="text" name="it_name" id="it_name" class="form-control" value="<?php echo $tb['it_name'];?>" placeholder="Employee Name" required="required">
</div>
<div class="form-group">
<label for="user_name">USERNAME</label>
<input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $tb['user_name'];?>" placeholder="User Name" required="required">
</div>
<div class="form-group">
<label for="mob_no">MOBILE NO</label>
<input type="text" class="form-control" name="mob_no" id="mob_no" pattern="^[789]\d{9}$" value="<?php echo $tb['mob_no'];?>" placeholder="Mobile No." required="required"/>
</div>
<div class="form-group">
<label for="email">EMAIL ID</label>
<input type="email" class="form-control" name="email" id="email" value="<?php echo $tb['email'];?>" placeholder="Email Id" required="required">
</div>
<input type="hidden" name="it_id" id="it_id" value="<?php echo $tb['it_id'];?>">
<div class="form-group">
<button type="submit" name="submit" class="btn btn-success" >SUBMIT</button>   
<button type="reset" name="reset" class="btn btn-danger pull-right" >RESET</button>   
</div>
</div>
</form>
<?php }?>
</div>
</div>
</div>
</div>
<div class="col-sm-1">
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