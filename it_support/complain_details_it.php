<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Complain Details</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap/css/dept.css" rel="stylesheet">
</head>
<body>
<div class="row">
<div class="container-fluid">
<nav class="col-sm-2" id="myScrollspy">
<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">
<li class="dropdown">
<a class="dropdown-toggle" id="1" href="#">MANAGE USERS<span class="caret"></span></a>
<ul id="1-1" style="list-style-type:none">
<li><a href="#">DEPARTMENT DETAILS</a></li>
<li><a href="#">USER DETAILS</a></li>
<li><a href="#">IT TEAM</a></li>
<li><a href="#">COMPLAIN TYPE DETAILS</a></li>
<li><a href="#">COMPLAIN DESCRIPTION</a></li>
</ul>
</li>
<li >
<a class="dropdown-toggle" data-toggle="dropdown" id="2" href="#">MANAGE COMPLAIN<span class="caret"></span></a>
<ul id="2-1" style="list-style-type:none">
<li><a class="active" href="#">USER COMPLAIN</a></li>
<li><a href="#">COMPLAIN REPORTS</a></li>
</ul>
</li>
</ul>
</nav>
<div class="col-sm-10">
<div class="panel panel-primary">
<div class="panel-heading"><div class="text-center">COMPLAIN DETAILS</div></div>
<div class="panel-body" style="max-height:10;overflow-y:scroll;">
<form class="form-inline" role="form">
<div class="container center_div2">
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
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
<th class="text-center">UPDATE</th>
</tr>
</thead>
</table>
<br>
<form role="form">
<button type="submit" class="btn btn-warning pull-right" name="update">UPDATE STATUS</button>
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
</body>
</html>