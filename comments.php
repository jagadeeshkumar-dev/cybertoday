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
     <link rel="stylesheet" href="css/adminstyles.css">
    <title>Comments</title>
  </head>
   <body style="background-color: #668db1;font-size: 1.5em;">
    <div class="container-fluid">
      <div class="row">
         
         <div class="col-sm-12">
           <h2>Cyber Today Admin Panel</h2>
         </div>
        <div class="col-sm-2">
          <br>

          <ul id="sidemenu" class="nav nav-pills nav-stacked">
            <li  ><a href="DashBoard.php" style="color: black;">
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
            <li class="active"><a href="comments.php"style="color: black;">
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
          

            <h1>Un_Approved Comments</h1>
            
       <div class="table-responsive">
         
          <table class="table table-striped table-hover">
            
            <tr>    

                  <th>No.</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Comment</th>
                  <th>Action</th>
                  <th>Delete</th>
                  
                  <th>Details</th>
                  
              </tr>

          


      <?php

        global $conn;
         $Viewquery="SELECT * FROM comments WHERE status ='OFF'"; 
              $Execute=mysqli_query($conn,$Viewquery);
              $SrNo=0;
        while ($DataRows=mysqli_fetch_array($Execute)) {


                 $CommentId=$DataRows['id'];
                  $DatetimeofComment=$DataRows['datetime'];
                  $PersonName=$DataRows["name"];

                  $PersonComment=$DataRows['comment'];
                  
                  $CommentPostId=$DataRows['admin_panel_id'];
                  $SrNo++;
                  if (strlen($PersonComment)>15) 
                  { 
                    $PersonComment=substr($PersonComment,0,15).'....';
                  }
                 if (strlen($PersonName)>10) 
                  { 
                    $PersonName=substr($PersonName,0,10).'....';
                  }
                  ?> 

                <tr>
                  
                  <td><?php echo $SrNo;?></td>
                  <td style="font-weight: bold;"><?php echo $PersonName;?></td>
                  <td><?php echo $DatetimeofComment;?></td>
                  <td><?php echo $PersonComment;?></td>
                  <td><a href="Approve.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a></td>
                  <td><a href="#"><span class="btn btn-danger">Delete</span></a></td>
                   <td><a href="FullPost.php?id=<?php echo $CommentPostId; ?>" target ="_blank">
                    <span class="btn btn-primary">Preview</span></a></td>
                  </tr>


        <?php } ?>
     
</table>

       </div>


        <h1>Approved Comments</h1>
            
       <div class="table-responsive">
         
          <table class="table table-striped table-hover">
            
            <tr>    

                  <th>No.</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Comment</th>
                  <th>Action</th>
                  <th>Delete</th>
                  
                  <th>Details</th>
                  
              </tr>

          


      <?php

        global $conn;
         $Viewquery="SELECT * FROM comments WHERE status ='ON'"; 
              $Execute=mysqli_query($conn,$Viewquery);
              $SrNo=0;
        while ($DataRows=mysqli_fetch_array($Execute)) {


                 $CommentId=$DataRows['id'];
                  $DatetimeofComment=$DataRows['datetime'];
                  $PersonName=$DataRows["name"];
                  
                  $PersonComment=$DataRows['comment'];
                  
                  $CommentPostId=$DataRows['admin_panel_id'];
                  $SrNo++;
                  if (strlen($PersonComment)>15) 
                  { 
                    $PersonComment=substr($PersonComment,0,15).'....';
                  }
                 if (strlen($PersonName)>10) 
                  { 
                    $PersonName=substr($PersonName,0,10).'....';
                  }
                 
                  ?> 

                <tr>
                  
                  <td><?php echo $SrNo;?></td>
                  <td style="font-weight: bold;"><?php echo $PersonName;?></td>
                  <td><?php echo $DatetimeofComment;?></td>
                  <td><?php echo $PersonComment;?></td>
                  <td><a href="UnApprove.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">UnApprove</span></a></td>
                  <td><a href="DeleteComment.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
                   <td><a href="FullPost.php?id=<?php echo $CommentPostId; ?>">
                    <span class="btn btn-primary">Preview</span></a></td>
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