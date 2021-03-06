<?php
session_start();
include 'db_config.php'; 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Complain Reports</title>
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
.fisrt{
	background-color:blue;
}
.second{
	background-color:#00e639;
}
@media print {
    .control-group {
      display: table;
    }
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
<li><a href="user_complain.php" style="color:#990026"><strong>USER COMPLAIN</strong></a></li>
<li><a href="#" style="color:#990026"><strong>COMPLAIN REPORTS</strong></a></li>
</ul>
</li>
</ul>
</nav>
<div class="col-sm-10">
<div class="panel panel-default">
<div class="panel-heading" style="font-family:georgia;color:black;background-color:#ffec80;"><div class="text-center"><strong>COMPLAIN REPORTS</strong></div></div>
<div class="panel-body" style="max-height:450px;overflow-y:scroll;">
<form class="form-inline" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="container center_div2">
<div class="form-group">
<label for="from_date">FROM DATE:</label>
<input type="date" class="form-control" id="from_date" name="from_date" required="required">
</div>
<div class="form-group">
<label for="to_date">TO DATE:</label>
<input type="date" class="form-control" id="to_date" name="to_date" required="required">
</div>
<div class="form-group">
<button type="submit" name="submit" class="btn btn-success">FIND</button>   
</div>
<br><br>
<button class="btn btn-success pull-right" id="print_me" >PRINT</button>   
</div>
</form>
<br><br>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th class="text-center">ID</th>
<th class="text-center">DEPARTMENT</th>
<th class="text-center">USERNAME</th>
<th class="text-center">COMPLAIN TYPE</th>
<th class="text-center">DESCRIPTION</th>
<th class="text-center">FORWARD TO</th>
<th class="text-center">COMPLAIN DATE</th>
<th class="text-center">COMPLAIN TIME</th>
<th class="text-center">RESOLVE DATE</th>
<th class="text-center">RESOLVE TIME</th>
<th class="text-center">STATUS</th>
</tr>
</thead>
<tbody>
<?php
if(isset($_POST['submit']))
{
	$sql="select * from add_complain inner join dept_details on add_complain.dept_id=dept_details.dept_id inner join emp_details on add_complain.emp_id=emp_details.emp_id inner join complain_type on add_complain.type_id=complain_type.type_id inner join complain_desc on add_complain.desc_id=complain_desc.desc_id inner join it_details on add_complain.it_id=it_details.it_id where add_complain.complain_date >= '".$_POST['from_date']."' and add_complain.complain_date <= '".$_POST['to_date']."'";
	$query=mysqli_query($conn,$sql);
	date_default_timezone_set("Asia/Kolkata");
	foreach($query as $tb){
?>		
<tr>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>" >
<?php echo $tb['complain_id']; ?></td>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>">
<?php echo $tb['dept_name']; ?></td>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>">
<?php echo $tb['emp_name']; ?></td>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>">
<?php echo $tb['type_name']; ?></td>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>">
<?php echo $tb['desc_name']; ?></td>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>">
<?php echo $tb['it_name']; ?></td>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>">
<?php echo date("d/m/Y", strtotime($tb['complain_date'])); ?></td>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>"><?php echo date("h:i:s A", strtotime($tb['complain_time'])); ?></td>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>"><?php if($tb['resolve_date']!=""){
echo date("d/m/Y", strtotime($tb['resolve_date']));
}
else
{
echo " ";
}	
?></td>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>"><?php if($tb['resolve_time']!=""){
echo date("h:i:s A", strtotime($tb['resolve_time']));
}
else
{
echo " ";
}	
?></td>
<td class="text-center" style="<?php if($tb['complain_status']=="Pending"){?> background-color:lightblue; <?php } else {?> background-color:lightgreen;<?php }?>"><?php echo $tb['complain_status']; ?></td>
</tr>
<?php }}?>
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
$(document).ready(function(){
	$("#print_me").click(function(){
         window.print();
	});
});
</script>
</body>
</html>