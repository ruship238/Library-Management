<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['view']))
{
$type=$_POST['type'];
if($type=="userwise"){
	header('location:Clientreport.php');
  }
if($type=="overdue"){
	header('location:overduereport.php');
  }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Add Categories</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>

    <div class="content-wrapper">
         <div class="container">
         <div class="row pad-botm">
            <div class="heading-line" style="width:90%; padding: 5px 30px 10px 30px; margin-left:20px;">
                <h4 class="header-line ">Report Issues</h4>
                
                            </div>

        </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading" style=" background-color:#FE46A8;">
                           <h2 style="  color: white; font-size: 40px;">Reports</h2>
                        </div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Report Type</label>
<select name="type" class="form-control">
<option value="">Select</option>
<option value="userwise">User-Wise</option>
<option value="overdue">Over-Due</option>
</select>
</div>
<button type="submit" name="view" class="btn btn-info" style="width:100px">View</button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
                <!---Footer-->
<footer class="text-center text-white foot">
  <h3 style="color:white">
    <center><strong>
      PrimaThink : Library Management System </strong>
    </center>
  </h3>
  
  <div id="contact" >Contact Our Toll Free Number : 180X 40XX 30XX for more Information. </div> 

  <!-- Copyright-->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2021 Copyright:
    <a class="text-white" style="color:white;text-decoration" href="https://primathink.com/">PrimaThink (All Rights Reserved)  </a>
  </div>
</footer>
</body>
</html>
<?php } ?>