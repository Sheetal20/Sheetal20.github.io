<?php 
session_start();
include 'course_db_config.php';
?>
<html lang="en">
 <head>
<title>Course Management</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap/css/login1.css" rel="stylesheet">
</head>
<div class="back">
<div class="container">
<h1 style="text-align: center; font-family: impact; color: #ccddff;height:10%"> COURSE MANAGEMENT </h1>
<h3 style="text-align: right;color: #ccddff;"><a href="logout.php">Logout</a></h3> 
</div></div>
<div class="clear"></div>
<div class="col-lg-3" style="background-color: #050a15; height: 100%">
<ul class="list-group" style="background-color: #050a15;margin-top: 10%">
<li class="list-group-item side"><a href="#"><?php echo "<span style='color: #ccddff;font-size: 20px'>HELLO ADMIN"; "</span>"?></a></li>
</ul>
</div>
<div style="margin-left:27%">
<div class="table-responsive" style="margin-top:5%">
<table class="table table-bordered">
<thead>
<tr>
<th class="text-center">NAME</th>
<th class="text-center">REGISTRATION NO.</th>
<th class="text-center">EMAIL ID</th>
<th class="text-center">EDIT</th>
<th class="text-center">DELETE</th>
</tr>
</thead>
<tbody>
<?php
$sql="select * from u_details";
$query=mysqli_query($conn,$sql);
foreach ($query as $tb){
?>
<tr>
<td class="text-center" ><?php echo $tb['name']; ?></td>
<td class="text-center" ><?php echo $tb['uid']; ?></td>
<td class="text-center" ><?php echo $tb['mid']; ?></td>
<td class="text-center" ><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
<td class="text-center" ><a class="btn btn-danger" href="#">Delete</a></td>
</tr>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </div>
</div>
<?php } ?>
</tbody>
</table>
</div>
<div class="table-responsive" style="margin-top:5%">
<table class="table table-bordered">
<thead>
<tr>
<th class="text-center">NAME</th>
<th class="text-center">UNIQUE ID NO.</th>
<th class="text-center">EMAIL ID</th>
<th class="text-center">EDIT</th>
<th class="text-center">DELETE</th>
</tr>
</thead>
</table>
</div>
</div>
<script src="bootstrap/js/jQuery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</html>