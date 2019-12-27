<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
  if(isset($_GET["id"])){

$IdFromURL=$_GET["id"];
global $conn;
 $Del="DELETE FROM registration WHERE id='$IdFromURL'";
$exec=mysqli_query($conn,$Del);

if ($exec) {
 
       Redirect_to("Admins.php");
  }else{
      
     Redirect_to("Admins.php");
  }

}


?>