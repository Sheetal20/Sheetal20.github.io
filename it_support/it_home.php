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
<title>IT Team Home</title>
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
<li><a href="#"><strong><em>HOME</em></strong></a></li>
</ul>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
<li class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="admin3.jpg" class="img-circle">
<strong><em>Hello <?php echo $_SESSION['username']; ?></em></strong><span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a href="chng_pwd_it.php">Change Password</a></li>
<li><a href="edit_it.php">Edit Profile</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</li>
</ul>
</div>
</div>
</nav>
<br><br><br><br><br>
<div class="row">
<div class="col-sm-1">
</div>
<div class="col-sm-10">
<div class="panel panel-default">
<div class="panel-heading" style="font-family:georgia;color:black;background-color:#ffec80;"><div class="text-center"><strong>COMPLAIN DETAILS</strong></div></div>
<div class="panel-body" style="max-height:300px;overflow-y:scroll;">
<div class="container center_div2">
<div class="row">
<div class="col-lg-11">
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
<br><br>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th class="text-center">DEPARTMENT</th>
<th class="text-center">USERNAME</th>
<th class="text-center">COMPLAIN TYPE</th>
<th class="text-center">DESCRIPTION</th>
<th class="text-center">COMPLAIN DATE</th>
<th class="text-center">COMPLAIN TIME</th>
<th class="text-center">RESOLVE DATE</th>
<th class="text-center">RESOLVE TIME</th>
<th class="text-center">STATUS</th>
<th class="text-center">UPDATE</th>
</tr>
</thead>
<tbody>
<?php
	$sql="select * from add_complain inner join dept_details on add_complain.dept_id=dept_details.dept_id inner join emp_details on add_complain.emp_id=emp_details.emp_id inner join complain_type on add_complain.type_id=complain_type.type_id inner join complain_desc on add_complain.desc_id=complain_desc.desc_id inner join it_details on add_complain.it_id=it_details.it_id where it_details.user_name='".$_SESSION['username']."'";
	$query=mysqli_query($conn,$sql);
	date_default_timezone_set("Asia/Kolkata");
	foreach($query as $tb){
?>		
<tr>
<td class="text-center" ><?php echo $tb['dept_name']; ?></td>
<td class="text-center" ><?php echo $tb['emp_name']; ?></td>
<td class="text-center" ><?php echo $tb['type_name']; ?></td>
<td class="text-center" ><?php echo $tb['desc_name']; ?></td>
<td class="text-center" ><?php echo date("d/m/Y", strtotime($tb['complain_date'])); ?></td>
<td class="text-center" ><?php echo date("h:i:s A", strtotime($tb['complain_time'])); ?></td>
<td class="text-center" ><?php if($tb['resolve_date']!=""){
echo date("d/m/Y", strtotime($tb['resolve_date']));
}
else
{
echo " ";
}	
?></td>
<td class="text-center" ><?php if($tb['resolve_time']!=""){
echo date("h:i:s A", strtotime($tb['resolve_time']));
}
else
{
echo " ";
}	
?></td>
<td class="text-center" ><?php echo $tb['complain_status']; ?></td>
<?php if($tb['complain_status']=="Pending"){
?>	
<td><a class="btn btn-success" href="update.php?id=<?php echo $tb['complain_id']; ?>">UPDATE</a></td>
<?php }
else {?>
<td><button class="btn btn-success" disabled="disabled" >UPDATE</button></td>
<?php }?>
</tr>

<?php }?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div class="col-sm-1">
</div>
</div>
<script src="bootstrap/js/jQuery.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
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