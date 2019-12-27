<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

if (isset($_POST["Submit"])) {
$category=mysqli_real_escape_string($conn,$_POST["Category"]);

date_default_timezone_set("Asia/Karachi");
  $CurrentTime=time();
   $DateTime=strftime("%B-%d-%Y %H:%M",$CurrentTime);
 $DateTime;
 $Admin="Jagadeesh Kumar";


 if (empty($category)) {

     $_SESSION["ErrorMessage"]="All must be filled";
      Redirect_to("Categories.php");

 }elseif(strlen($category)>99) {

     $_SESSION["ErrorMessage"]="tooo long name";
      Redirect_to("Categories.php");
 }

 else{

  global $conn;
  $query= "INSERT INTO category VALUES(NULL,'$DateTime','$category','$Admin')";
  $execute=mysqli_query($conn,$query);

  if ($execute) {

      Redirect_to("Categories.php");
  }else{
      Redirect_to("Categories.php");

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
            <li><a href="AddNewPost.php">
                <span class="glyphicon glyphicon-list-alt" ></span>&nbsp;Add New Post</a>
              </li>
            <li class="active"><a href="Categories.php">
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
            <h1>Manage Categories</h1>
            <div ><?php echo Message(); 
             echo SuccessMessage();
             ?></div>
           

            <div>
              
              <form class="form" action="Categories.php" method="POST">
                <fieldset>
                  <div class="form-group">
                   <label for="categoryname"><span class="FieldInfo">Name:</span></label>
                  <input class="form-control"type="text" name="Category" id="categoryname" placeholder="Name">

                </div>
                <br>
                <input class="btn btn-success btn-block" type="submit" name="Submit" >
                </fieldset>
                <br>

              </form>
            </div>
            

          <div class="table-responsive" >
            <table class="table table-striped table-hover table-bordered" >
              <tr>
                 <th>S.no</th>
                 <th>Date/Time</th>
                 <th>Category Name</th>
                 <th>Creator Name</th>
                 <th>Actions</th>


              </tr>

          <?php
          global $conn;
          
          $viewquery="SELECT * FROM category ORDER BY datetime desc";
          $execute=mysqli_query($conn,$viewquery);
          $srno=0;

         while ($DataRows=mysqli_fetch_array($execute)) {
              $Id=$DataRows["id"];
              $DateTime=$DataRows["datetime"];
              $CategoryName=$DataRows["name"];
              $CreatorName=$DataRows["creatorname"];
              $srno++;
         


          ?>
          <tr>
            <td><?php echo $srno; ?></td>
            <td><?php echo $DateTime; ?></td>
            <td><?php echo $CategoryName; ?></td>
            <td><?php echo $CreatorName; ?></td>
            <td><a href="DeleteCategory.php?id=<?php echo $Id;?>">
              <span class="btn btn-danger">Delete</span>
            </a></td>

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