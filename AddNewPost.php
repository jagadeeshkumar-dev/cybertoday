<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if (isset($_POST["Submit"])) {
$Title=mysqli_real_escape_string($conn,$_POST["Title"]);
$Category=mysqli_real_escape_string($conn,$_POST["Category"]);
$Post=mysqli_real_escape_string($conn,$_POST["Post"]);
//.......-----------------------------------------
date_default_timezone_set("Asia/Karachi");
  $CurrentTime=time();
   $DateTime=strftime("%B-%d-%Y %H:%M",$CurrentTime);
 $DateTime;

 $Admin=$_SESSION['username'];

 $Image=$_FILES["Image"]['name'];
 $Target="upload/".basename($_FILES["Image"]['name']);
//----------------------------------------------------------

 if (empty($Title)) {

     $_SESSION["ErrorMessage"]="Title can't be empty";
      Redirect_to("AddNewPost.php");

 }elseif(strlen($Title)<2) {

     $_SESSION["ErrorMessage"]="Too Short";
      Redirect_to("AddNewPost.php");
 }

 else{

  global $conn;
  $query= "INSERT INTO admin_panel VALUES(NULL,'$DateTime','$Title','$Category','$Admin','$Image','$Post')";
  $execute=mysqli_query($conn,$query);
  move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

  if ($execute) {

     
      Redirect_to("AddNewPost.php");
  }else{

      Redirect_to("AddNewPost.php");

  }
 



 }
 
 
}
?>
<?php

if(isset($_SESSION['username']))

{ 
  ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
     <link rel="stylesheet" href="css/adminstyles.css">
    <title></title>

    <style type="text/css">
      .FieldInfo{
          color: #673ab7;
          font-family: Bitter,Georgia,"Times New Roman",Times,serif;
          font-size: 1.2em;

      }


    </style> 
  </head>
  <body style="font-size: 1.3em;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
            <h2>Cyber Today Admin Panel</h2>
         </div>

        <div class="col-sm-2">
          
         <br>
          <ul id="sidemenu" class="nav nav-pills nav-stacked">
            <li><a href="DashBoard.php">
              <span class="glyphicon glyphicon-th" ></span> &nbsp; DashBoard</a>
            </li>
            <li class="active"><a href="AddNewPost.php">
                <span class="glyphicon glyphicon-list-alt" ></span>&nbsp;Add New Post</a>
              </li>
            <li ><a href="Categories.php">
                <span class="glyphicon glyphicon-tags" ></span>&nbsp;Categories</a>
              </li>

            <li><a href="Admins.php">
                <span class="glyphicon glyphicon-user" ></span>&nbsp;Manage Admins</a>
              </li>
            <li><a href="Comments.php">
                <span class="glyphicon glyphicon-comment" ></span>&nbsp;Comments</a>
              </li>
            <li><a href="#">
                <span class="glyphicon glyphicon-equalizer" ></span>&nbsp;Live Blog</a>
              </li>
            <li><a href="Logout.php">
                <span class="glyphicon glyphicon-log-out" ></span>&nbsp;Logout</a>
              </li>

          </ul>

        </div>  <!--Ending of side area-->

          <div class="col-sm-10">
            <h1>Add New Post</h1>
            <div ><?php echo Message(); 
             echo SuccessMessage();
             ?></div>
           

            <div>
              
              <form class="form" action="AddNewPost.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                  <div class="form-group">
                   <label for="title"><span class="FieldInfo">Title:</span></label>
                  <input class="form-control"type="text" name="Title" id="title" placeholder="Title">

                </div>

                <div class="form-group">
                   <label for="title"><span class="FieldInfo">Category:</span></label>
                   <select class="form-control" id="categoryselect" name="Category" >
                   <?php
                 global $conn;
          
                  $viewquery="SELECT * FROM category ORDER BY datetime desc";
                   $execute=mysqli_query($conn,$viewquery);
                  

                 while ($DataRows=mysqli_fetch_array($execute)) {
                  $Id=$DataRows["id"];
                    
                  $CategoryName=$DataRows["name"];
        
                     ?>

                     <option><?php echo $CategoryName; ?> </option>
                   <?php }?>


                 </select> </div> 
                 <div class="form-group">
                   <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
                   <input type="File" class="form-control" name="Image" id="imageselect">
                 </div>
                 <div class="form-group">
                   <label for="postarea"><span class="FieldInfo">Post:</span></label>
                   <textarea class="form-control" name="Post" id="postarea"></textarea>


                <br>
                <input class="btn btn-success btn-block" type="submit" name="Submit" >
                </fieldset>
                <br>

              </form>
            </div>
            


          
          






          </div>





         </div><!--Ending of main area-->

       </div><!--Ending row-->

     </div><!--Ending of container-->
     <div style="align-items: botom;" id="footer">
      <p>Developed By |K.Jagadeesh Kumar|--All Rights Reserved.</p>

     </div>


     <script>
                        CKEDITOR.replace( 'postarea' );
                </script>
  </body>
</html> 
<?php
}
else{
 header("Location: logintopost.php");
}
?>