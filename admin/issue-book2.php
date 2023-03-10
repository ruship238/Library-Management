<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['issue']))
{

$studentid=strtoupper($_POST['studentid']);
$bookid=$_POST['bookdetails'];
$sql="INSERT INTO  tblissuedbookdetails(StudentID,BookId) VALUES(:studentid,:bookid)";
$query = $dbh->prepare($sql);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();

$bookid=$_GET['ISBNNumber'];
$studentid=$_GET['StudentID'];
$sql="DELETE FROM tblrequestedbookdetails WHERE StudentID=:studentid and ISBNNumber=:bookid";
$query = $dbh->prepare($sql);
$query -> bindParam(':studentid',$studentid, PDO::PARAM_STR);
$query -> bindParam(':bookid',$bookid, PDO::PARAM_STR);
$query->execute();

$sql="update tblbooks set IssuedCopies=IssuedCopies+1 where ISBNNumber=:bookid";
$query = $dbh->prepare($sql);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Book issued successfully";
header('location:manage-issued-books.php');

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issue a new Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
         <div class="row pad-botm">
            <div class="heading-line" style="width:90%; padding: 5px 30px 10px 30px; margin-left:20px;">
                <h4 class="header-line ">Issue Book</h4>
                
                            </div>

        </div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
<div class="panel panel-info">
<div class="panel-heading" style=" background-color:#FE46A8;">
                           <h2 style="  color: white;">Issued Book Details</h2>
                        </div>
<div class="panel-body">





<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
<?php	
$bookid=$_GET['ISBNNumber'];
$stdid=$_GET['StudentID'];
?>										
<div class="form-group">
<label>Student id<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="studentid" id="studentid" value="<?php echo htmlentities($stdid);?>" onBlur="getstudent()" required />
</div>

<div class="form-group">
<span id="get_student_name" style="font-size:16px;"></span> 
</div>

<div class="form-group">
<label>BookID<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="booikid" id="bookid" value="<?php echo htmlentities($bookid);?>" onBlur="getbook()"  required="required" />
</div>

 <div class="form-group">
  Book Title<select  class="form-control" name="bookdetails" id="get_book_name" readonly> 
 </select>
 </div>
											
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book </button>

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
    ?? 2021 Copyright:
    <a class="text-white" style="color:white;text-decoration" href="https://primathink.com/">PrimaThink (All Rights Reserved)  </a>
  </div>
</footer>
</body>
</html>
<?php } ?>
