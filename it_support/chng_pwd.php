<?php
session_start();
include 'db_config.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Change Password</title>
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
.container.center_div{
	margin:auto;
	width:60%;
}
</style>
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="15" style="overflow-y:scroll">
<?php
$pwd1Err=$pwdc1Err=$pwd2Err="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(!empty($_POST['pwd1']))
	{
		$sql="select password from admin_login where username='".$_SESSION['username']."'";
		$query=mysqli_query($conn,$sql);
		foreach($query as $tb)
		{
			if($_POST['pwd1']==$tb['password'])
		{
			if(!empty($_POST['pwdc1']))
		{
			if($_POST['pwd1'] != $_POST['pwdc1'])
			{
				$pwdc1Err="Password does not match";
				$_SESSION['pwdc1Err']="Password does not match";
				session_write_close();
                header('location:chng_pwd.php');
                exit;
			}
		}
		}
		else{
		     $pwd1Err="Wrong password";
             $_SESSION['pwd1Err']="Wrong password";
				session_write_close();
                header('location:chng_pwd.php');
                exit;			 
		}	
		}
	}
	if(!empty($_POST['pwd2']))
	{
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $_POST['pwd2'])) 
		{
		   $pwd2Err="Password must be 8 to 12 characters long and must contain atleast one letter,one number and can contain special characters.";
           $_SESSION['pwd2Err']="Password must be 8 to 12 characters long and must contain atleast one letter,one number and can contain special characters.";
		   session_write_close();
           header('location:chng_pwd.php');
           exit;
        }
	}
	if(($pwd1Err=="")&&($pwdc1Err=="")&&($pwd2Err==""))
	{
	try{
	if(isset($_POST['submit']))
	{
    $sql="update admin_login set password='".$_POST['pwd2']."' where username='".$_SESSION['username']."'";
    $query=mysqli_query($conn,$sql);    
    if($query){
        $_SESSION['successmessage']="Password changed successfully";
		session_write_close();
         header('location:chng_pwd.php');
         exit;
    }else if(!$query){
         $_SESSION['warningmessage']="Failed to change password";
		 session_write_close();
         header('location:chng_pwd.php');
    exit;
    }
	}
    
} catch (Exception $ex) {
    $_SESSION['errormessage']=$ex->getMessage();
	session_write_close();
    header('Location:chng_pwd.php');
    exit;
}
	}
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
<li><a href="#">Profile Settings</a></li>
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
<li><a href="user_details.php" style="color:#990026"><strong>USER DETAILS</strong></a></li>
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
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading" style="font-family:georgia;color:black;background-color: #ffec80;"><div class="text-center"><strong>CHANGE PASSWORD</strong></div></div>
<div class="panel-body" style="max-height:300px;overflow-y:scroll;">
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
<form role="form" method="POST" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
<div class="container center_div2">
<div class="form-group">
<label for="pwd1">OLD PASSWORD</label>
<input type="password" name="pwd1" id="pwd1" class="form-control" placeholder="Old Password" required="required">
<?php if(isset($_SESSION['pwd1Err'])){ ?>
<span class="error">*<?php echo $_SESSION['pwd1Err']; unset($_SESSION['pwd1Err']); ?></span>
<?php } ?>
</div>
<div class="form-group">
<label for="pwdc1">CONFIRM PASSWORD</label>
<input type="password" name="pwdc1" id="pwdc1" class="form-control" placeholder="Confirm Password" required="required">
<?php if(isset($_SESSION['pwdc1Err'])){ ?>
<span class="error">*<?php echo $_SESSION['pwdc1Err']; unset($_SESSION['pwdc1Err']); ?></span>
<?php } ?>
</div>
<div class="form-group">
<label for="pwd2">NEW PASSWORD</label>
<input type="password" name="pwd2" id="pwd2" class="form-control" placeholder="New Password" required="required">
<?php if(isset($_SESSION['pwd2Err'])){ ?>
<span class="error">*<?php echo $_SESSION['pwd2Err']; unset($_SESSION['pwd2Err']); ?></span>
<?php } ?>
</div>
<div class="form-group">
<button type="submit" name="submit" class="btn btn-success" >SUBMIT</button>   
<button type="reset" name="reset" class="btn btn-success middle" >RESET</button>   
</div>
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
</body>
</html>