<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>


<?php
function Redirect_to($New_Location){
   header("Location:".$New_Location);
  exit;
}



 ?>
