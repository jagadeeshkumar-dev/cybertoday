<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
  if(isset($_GET["id"])){

$IdFromURL=$_GET["id"];
global $conn;
$Query="UPDATE comments SET status='OFF' WHERE id ='$IdFromURL' ";
$exec=mysqli_query($conn,$Query);

if ($exec) {
    
       Redirect_to("comments.php");
  }else{
   
     Redirect_to("comments.php");
  }

}


?>