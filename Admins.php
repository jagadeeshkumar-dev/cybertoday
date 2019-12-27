<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if (isset($_POST["Submit"])) {
$username=mysqli_real_escape_string($conn,$_POST["username"]);
$password=mysqli_real_escape_string($conn,$_POST["password"]);
$cnfpassword=mysqli_real_escape_string($conn,$_POST["cnfpassword"]);

date_default_timezone_set("Asia/Karachi");
  $CurrentTime=time();
   $DateTime=strftime("%B-%d-%Y %H:%M",$CurrentTime);
 $DateTime;
 $Admin="Jagadeesh Kumar";


 if (empty($username)||empty($password) ||empty($cnfpassword)) {

     $_SESSION["ErrorMessage"]="All must be filled";
      Redirect_to("Admins.php");

 }elseif(strlen($password)<4) {

     $_SESSION["ErrorMessage"]="Atleast more than 4  characters";
      Redirect_to("Admins.php");
 }elseif(strlen($password!=$cnfpassword))  {

     $_SESSION["ErrorMessage"]="both are must be same";
     Redirect_to("Admins.php");
 }

 else{

  global $conn;
  $query= "INSERT INTO registration VALUES(NULL,'$DateTime','$username','$password','$Admin')";
  $execute=mysqli_query($conn,$query);

  if ($execute) {

     
     Redirect_to("Admins.php");
  }else{
 
      Redirect_to("Admins.php");
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
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
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
   <body style="background-color: #668db1;font-size: 1.5em;">
    <div class="container-fluid">
      <div class="row">

       <div class="col-sm-12">
            <h2><img src="img/brand.png">Admin Controll</h2>
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

            <li ><a href="Categories.php">
                <span class="glyphicon glyphicon-tags" ></span>&nbsp;Categories</a>
              </li>

            <li class="active"><a href="Admins.php">
                <span class="glyphicon glyphicon-user" ></span>&nbsp;Manage Admins</a>
              </li>
            <li><a href="comments.php">
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
            <h1>Manage Admins</h1>
            <div ><?php echo Message(); 
             echo SuccessMessage();
             ?></div>
           

            <div>
              
              <form class="form" action="Admins.php" method="POST">
                <fieldset>
                  <div class="form-group">
                   <label for="username"><span class="FieldInfo">User Name:</span></label>
                  <input class="form-control"type="text" name="username" id="username" placeholder="Name">

                </div>
                <div class="form-group">
                   <label for="categoryname"><span class="FieldInfo">Password:</span></label>
                  <input class="form-control" type="password" name="password" id="password" placeholder="password">

                </div>
                <div class="form-group">
                   <label for="categoryname"><span class="FieldInfo">Re-enter Password:</span></label>
                  <input class="form-control"type="password" name="cnfpassword" id="cnfpassword" placeholder="conform-password">

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
                 <th>Admin Name</th>
                 <th>Added By</th>
                 <th>Action</th>


              </tr>

          <?php
          global $conn;
          
          $viewquery="SELECT * FROM registration ORDER BY datetime desc";
          $execute=mysqli_query($conn,$viewquery);
          $srno=0;

         while ($DataRows=mysqli_fetch_array($execute)) {
              $Id=$DataRows["id"];
              $DateTime=$DataRows["datetime"];
              $User_Name=$DataRows["username"];
              $Added_By=$DataRows["addedby"];
              $srno++;
         


          ?>
          <tr>
            <td><?php echo $srno; ?></td>
            <td><?php echo $DateTime; ?></td>
            <td><?php echo $User_Name; ?></td>
            <td><?php echo $Added_By; ?></td>
            <td><a href="DeleteAdmin.php?id=<?php echo $Id;?>">
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