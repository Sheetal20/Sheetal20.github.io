<?php
session_start();
include 'db_config.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>IT_Team Registration</title>
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
$userErr=$passErr=$cpassErr="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(!empty($_POST['user_name']))
	{
		if(!preg_match('/\d/', $_POST['user_name'])) 
		{
		   $userErr="Username must contain atleast one number";
           $_SESSION['userErr']="Username must contain atleast one number";
		   session_write_close();
           header('location:it_reg.php');
           exit;
        }
	}
	if(!empty($_POST['password']))
	{
		$password=$_POST['password'];
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) 
		{
		   $passErr="Password must be 8 to 12 characters long and must contain atleast one letter,one number and can contain special characters.";
           $_SESSION['passErr']="Password must be 8 to 12 characters long and must contain atleast one letter,one number and can contain special characters.";
		   session_write_close();
           header('location:it_reg.php');
           exit;
        }
		if(!empty($_POST['confirm_password']))
		{
			if($password != $_POST['confirm_password'])
			{
				$cpassErr="Password does not match";
				$_SESSION['cpassErr']="Password does not match";
				session_write_close();
                header('location:it_reg.php');
                exit;
			}
		}
	}
	if(($passErr=="")&&($cpassErr=="")&&($userErr==""))
	{
	try{
	if(isset($_POST['submit']))
	{
	$chck= mysqli_query($conn,"select * from it_details where user_name='".$_POST['user_name']."' limit 1");
    if(mysqli_fetch_row($chck)) {
        $_SESSION['chckmessage']="This employee already exists.";
			session_write_close();
		    header('location:it_reg.php');
    exit;
      }
	  else{
    $sql="insert into it_details (it_name,user_name,mob_no,email,password) values ('".$_POST['it_name']."','".$_POST['user_name']."','".$_POST['mob_no']."','".$_POST['email']."','".$_POST['password']."')";
    $query=mysqli_query($conn,$sql);    
    if($query){
        $_SESSION['successmessage']="Record inserted successfully";
		session_write_close();
         header('location:it_reg.php');
         exit;
    }else if(!$query){
         $_SESSION['warningmessage']="Failed to insert record";
		 session_write_close();
         header('location:it_reg.php');
    exit;
    }
	}
	}
    
} catch (Exception $ex) {
    $_SESSION['errormessage']=$ex->getMessage();
	session_write_close();
    header('Location:it_reg.php');
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
<div class="panel-heading" style="font-family:georgia;color:black;background-color:#ffec80;"><div class="text-center"><strong>IT TEAM REGISTRATION</strong></div></div>
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
<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="container center_div1">
<div class="form-group">
<label for="it_name">EMPLOYEE NAME</label>
<input type="text" class="form-control" name="it_name" id="it_name" placeholder="Employee Name" required="required"/>
</div>
<div class="form-group">
<label for="user_name">USERNAME</label>
<input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" required="required"/>
<?php if(isset($_SESSION['userErr'])){ ?>
<span class="error">*<?php echo $_SESSION['userErr']; unset($_SESSION['userErr']); ?></span>
<?php } ?>
</div>
<div class="form-group">
<label for="mob_no">MOBILE NO</label>
<input type="text" class="form-control" name="mob_no" id="mob_no" pattern="^[789]\d{9}$" placeholder="Mobile No." required="required"/>
</div>
<div class="form-group">
<label for="email">EMAIL ID</label>
<input type="email" class="form-control" name="email" id="email"  placeholder="Email Id" required="required"/>
</div>
<div class="form-group">
<label for="password">PASSWORD</label>
<input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required"/>
<?php if(isset($_SESSION['passErr'])){ ?>
<span class="error">*<?php echo $_SESSION['passErr']; unset($_SESSION['passErr']); ?></span>
<?php } ?>
</div>
<div class="form-group">
<label for="confirm_password">CONFIRM PASSWORD</label>
<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required="required"/>
<?php if(isset($_SESSION['cpassErr'])){ ?>
<span class="error">*<?php echo $_SESSION['cpassErr']; unset($_SESSION['cpassErr']); ?></span>
<?php } ?>
</div>
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