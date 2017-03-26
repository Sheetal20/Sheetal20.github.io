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
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap/css/login1.css" rel="stylesheet">
<title>LOGIN</title>
<style>
body{
	padding-top:70px;
}
.logo{
	font-size:200px;
}
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  .navbar-inverse .navbar-nav > li > a {
  color:#9d9d9d;
}
.navbar-inverse .navbar-nav > li > a:hover,
.navbar-inverse .navbar-nav > li > a:focus {
  color:#fff;
  background-color:transparent;
}
  </style>
</head>
<body id="mylogin" data-spy="scroll" data-target=".navbar" data-offset="60" >
<?php
try{
if(isset($_POST['submit']))
{
	if($_POST['username']=="admin")
	{
		$sql="select password from admin_login where username='".$_POST['username']."'";
		$query=mysqli_query($conn,$sql);
		foreach($query as $pd)
		{
			$password=$pd['password'];
		}
		if($password==$_POST['password'])
		{
			$_SESSION['username']=$_POST['username'];
			 session_write_close();
			header('location:admin_home.php');
			exit;
		}
		else{
		     $_SESSION['warningmessage']="Incorrect email id or password";
            session_write_close();
            header('location:login.php');
            exit;			
		}
	}
	else
	{
		$sql="select password from it_details where user_name='".$_POST['username']."'";
		$query=mysqli_query($conn,$sql);
		foreach($query as $pd)
		{
			$password=$pd['password'];
		}
		if($password==$_POST['password'])
		{
			$_SESSION['username']=$_POST['username'];
			 session_write_close();
			header('location:it_home.php');
			exit;
		}
		else{
		     $_SESSION['warningmessage']="Incorrect email id or password";
             session_write_close();	
             header('location:login.php');
            exit;			 
		}
	}
}
}
catch(Exception $ex){
	$_SESSION['errormessage']=$ex->getMessage();
	header('location:login.php');
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
<?php if(isset($_SESSION['username'])){ 
if($_SESSION['username']=="admin") { ?>
<li><a href="admin_home.php">HOME</a></li>
<?php } else { ?>
<li><a href="it_home.php">HOME</a></li>
<?php } } ?>
</ul>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
<?php if(isset($_SESSION['username'])){ ?>
<li><a href="#about" style="display:none">ABOUT</a></li>
<?php } else { ?>
<li><a href="#about" >ABOUT</a></li>
<?php } ?>
<li><a href="#login">LOGIN</a></li>
<li><a href="#contact">CONTACT US</a></li>
</ul>
</div>
</div>
</nav>
<div class="container-fluid">
<div class="jumbotron text-center">
<h1>BYTEPHASE<h1>
<p>WE BUILD DREAMS</p>
</div>
</div>
<div id="about" class="container-fluid">
<div id="myCarousel" class="carousel slide text-center" data-ride="carousel" >
<ol class="carousel-indicators">
<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<li data-target="#myCarousel" data-slide-to="1"></li>
<li data-target="#myCarousel" data-slide-to="2"></li>
<li data-target="#myCarousel" data-slide-to="3"></li>
</ol>
<div class="carousel-inner" role="listbox">
<div class="item active">
<img src="img1.jpg">
</div>
<div class="item">
<img src="img6.png">
</div>
<div class="item">
<img src="img3.jpg">
</div>
<div class="item">
<img src="img5.png">
</div>
</div>
 <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
</div>
<br><br>
<div id="login" class="container-fluid">
<div class="jumbotron text-center">
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8">
<div class="panel panel-danger">
<div class="panel-heading">
<h4>LOGIN TO CONTINUE<h4>
</div>
<div class="panel-body">
<div class="row">
<div class="col-lg-12">

<?php if(isset($_SESSION['warningmessage'])){ ?>
<div class="alert bg-warning" >
<?php echo $_SESSION['warningmessage']; unset($_SESSION['warningmessage']); ?> 
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
<div class="form-group">
<label for="username"><span class="glyphicon glyphicon-user"></span>USERNAME</label>
<input type="text" name="username" class="form-control" size="50" placeholder="Username" required="required">
</div>
<div class="form-group">
<label for="password"><span class="glyphicon glyphicon-eye-open"></span>PASSWORD</label>
<input type="password" name="password" class="form-control" size="50" placeholder="Password" required="required">
</div>
<div class="form-group">
<?php if(isset($_SESSION['username'])){ ?>
<button type="submit" name="submit" class="btn btn-success" disabled="disabled">LOGIN</button-->
<?php }
else { ?>
<button type="submit" name="submit" class="btn btn-success">LOGIN</button>
<?php }?>
</div>
</form>
</div>
<div class="panel-footer">
<p>Forgot Password?<a href="#contact">Contact Admin</a></p>
</div>
</div>
</div>
<div class="col-sm-2">
</div>
</div>
</div>
</div>
<div id="contact" class="container-fluid">
<div class="jumbotron">
<div class="row">
<div class="col-sm-4">
<span class="glyphicon glyphicon-globe logo"></span>
</div>
<div class="col-sm-8">
<h3>CONTACT US</h3>
<p><span class="glyphicon glyphicon-map-marker"></span>Bhubaneswar,INDIA</p>
<p><span class="glyphicon glyphicon-phone"></span>+91 234532562</p>
<p><span class="glyphicon glyphicon-envelope"></span>bytephase@gmail.com</p>
</div>
</div>
</div>
</div>
<script src="bootstrap/js/jQuery.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
</body>
</html>