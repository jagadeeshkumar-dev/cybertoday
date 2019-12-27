<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
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
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="css/adminstyles.css">
    <title></title>
  </head>
  <body style="background-color: #668db1;font-size: 1.5em;">
    <div class="container-fluid">
      <div class="row">
         
         <div style="background-color: #fff;" class="col-sm-12">
           <h2><img src="img/brand.png"> |Admin Panel</h2>
         </div>
        <div class="col-sm-2">
           
          <br>

          <ul id="sidemenu" class="nav nav-pills nav-stacked">
            <li  class="active"><a href="DashBoard.php" style="color: black;">
              <span class="glyphicon glyphicon-th" ></span> &nbsp; DashBoard</a>
            </li>
            <li><a href="AddNewPost.php"style="color: black;">
                <span class="glyphicon glyphicon-list-alt" ></span>&nbsp;Add New Post</a>
              </li>
            <li ><a href="Categories.php" style="color: black;">
                <span class="glyphicon glyphicon-tags" ></span>&nbsp;Categories</a>
              </li>

            <li><a href="Admins.php"style="color: black;">
                <span class="glyphicon glyphicon-user" ></span>&nbsp;Manage Admins</a>
              </li>
            <li><a href="Comments.php"style="color: black;">
                <span class="glyphicon glyphicon-comment" ></span>&nbsp;Comments</a>
              </li>
            <li><a href="#"style="color: black;">
                <span class="glyphicon glyphicon-equalizer" ></span>&nbsp;Live Blog</a>
              </li>
            <li><a href="Logout.php"style="color: black;">
                <span class="glyphicon glyphicon-log-out" ></span>&nbsp;Logout</a>
              </li>

          </ul>

        </div>  <!--Ending of side area-->
         
          <div class="col-sm-10" style="background-color: #fff4f4;">
          

            <h1>Admin DashBoard</h1>
             <div ><?php echo Message(); 
             echo SuccessMessage();
             ?></div>
            
       <div class="table-responsive">
         
          <table class="table table-striped table-hover">
            
            <tr>    

                  <th>No</th>
                  <th>Post Title</th>
                  <th>Date&Time</th>
                  <th>Author</th>
                  <th>Category</th>
                  <th>Banner</th>
                  <th>Comments</th>
                  <th>Action</th>
                  <th>Details</th>
              </tr>

          


      <?php

        global $conn;
         $Viewquery="SELECT * FROM admin_panel ORDER BY datetime desc"; 
              $Execute=mysqli_query($conn,$Viewquery);
              
        while ($DataRows=mysqli_fetch_array($Execute)) {


                   $Id=$DataRows["id"];
                  $Datetime=$DataRows["datetime"];
                  $Title=$DataRows["title"];
                  $Category=$DataRows["category"];
                  $Admin=$DataRows["author"];
                  $Image=$DataRows["image"];
                  $Post=$DataRows["post"];
                  
                  ?> 

                <tr>
                  

                  <td><?php echo $Id; ?></td>
                  
                  <td style="color: #00000 ;"><?php 
                  if (strlen($Title)>20){$Title=substr($Title,0,20);} 
                    
                  

                  echo  $Title; ?></td>
                  <td><?php echo  $Datetime; ?></td>
                 
                  <td><?php echo $Admin; ?></td>
                   <td><?php echo $Category; ?></td>
                  <td><img src="upload/<?php echo $Image; ?>" width="150px";height="50px";></td>
                  <td>Processing</td>
                  <td>

                    <a href="Editpost.php?Edit=<?php echo $Id;?>">
                      <span class="btn btn-warning">
                    Edit</span></a>
                    <a href="Deletepost.php?Delete=<?php echo $Id;?>">   <span class="btn btn-danger ">
                    Delete</span></a>
                  </td>
                  <td><a href="FullPost.php?id=<?php echo $Id;?>" target="_blank" >
                    
                  <span class="btn btn-primary">Preview</span></a> </td>
                </tr>


        <?php } ?>
     
</table>

       </div>


         </div><!--Ending of main area-->

       </div><!--Ending row-->

     </div><!--Ending of container-->
     <div style="align-items: botom;" id="footer">
      <p>Developed By |K.Jagadeesh Kumar|--All Rights Reserved.</p>

     </div>
  </body>
</html>

<?php
}
else{
 header("Location: logintopost.php");
}
?>
