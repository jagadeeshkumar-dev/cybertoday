<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

if (isset($_POST["Submit"])) {
$Name=mysqli_real_escape_string($conn,$_POST["Name"]);
$Email=mysqli_real_escape_string($conn,$_POST["Email"]);
$Comment=mysqli_real_escape_string($conn,$_POST["Comment"]);
//.......-----------------------------------------
date_default_timezone_set("Asia/Karachi");
  $CurrentTime=time();
   $DateTime=strftime("%B-%d-%Y %H:%M",$CurrentTime);
 $DateTime;
$PostId=$_GET["id"];


//----------------------------------------------------------

 if (empty($Name)||empty($Email)||empty($Comment)) {

     $_SESSION["ErrorMessage"]="All Feilds Must br Filled";
      

 }elseif(strlen($Comment)>200) {

     $_SESSION["ErrorMessage"]="Only 200 characters are allowed";
     

 }else{

  global $conn;
  $PostIDFromURL=$_GET["id"];
  $query= "INSERT INTO comments VALUES(NULL,'$DateTime','$Name','$Email','$Comment','OFF','$PostIDFromURL')";
  $execute=mysqli_query($conn,$query);
 

  if ($execute) {
    
       Redirect_to("FullPost.php?id={$PostId}");
  }else{
       
     Redirect_to("FullPost.php?id={$PostId}");
  }
 
 

}
 }
 
 

?>


<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="css/mainstyles.css">

	<title>Home Page</title>


</head>
<body></div>
   <div class="logo-wrap">
				<div class="container">
		<div class="row justify-content-between align-items-center">
		<div class="col-lg-4 col-md-4 col-sm-12 logo-left no-padding">
		<a href="index.html">
	<img style="margin-left: 10px;margin-top: 10px;" class="img-fluid" src="img/brand.png" width="400";height="40">
					</a>
		</div>
	<div class="col-lg-8 col-md-8 col-sm-12 logo-right no-padding ads-banner">
			<img class="img-fluid" src="img/banner-ad.jpg" alt="">
				</div>
			</div>
				</div>
			</div>
	



  
	
  <nav  class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
  
  <button style="float: right;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <div class="container">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link active" href="index.php?page=1"><img src="img/home.png" style="padding-right: 2px;">Home</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="#"><img src="img/topics.png" style="padding-right: 2px;">Courses</a>
      </li> 
      <!--Dropdown-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="img/topics.png" style="padding-right: 2px;">
          Topics
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#"><img src="img/android.png" style="padding-right: 2px;">App Development</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><img src="img/hacker.png" style="padding-right: 2px;">Hacking</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><img src="img/code.png" style="padding-right: 2px;">Web Development</a>
        </div>
      </li>
      <!--Dropdown-->  
      <li class="nav-item">
        <a class="nav-link" href="#"><img src="img/app.png" style="padding-right: 2px;">Apps</a>
      </li>  
      <li class="nav-item">
        <a class="nav-link" href="#">Categories</a>
      </li>
         
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>    
    </ul>
    


    </div>
    

        
    </div>
     
  </div>  
</nav>
<br>



        <div class="container">
          <div class="row"><!--row-->
            <div class="col-sm-9"><!--Main blog area-->
              <h2>More About the Post</h2>
               <div ><?php echo Message(); 
             echo SuccessMessage();
             ?></div>
             <?php 
              global $conn;
                if(isset($_POST['Searchbutton'])){

                $Search=$_POST["Search"];
                
                $Viewquery="SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%' ";
             
              }else{  

                      $PostIDFromURL=$_GET["id"];
              $Viewquery="SELECT * FROM admin_panel WHERE id='$PostIDFromURL'
               ORDER BY datetime desc"; }
                     
              $Execute=mysqli_query($conn,$Viewquery);

              if($Execute=== FALSE) { 
               die(mysql_error()); // TODO: better error handling
                   }

              while ($DataRows=mysqli_fetch_array($Execute)) {


              	  $PostId=$DataRows["id"];
              	  $DateTime=$DataRows["datetime"];
              	  $Title=$DataRows["title"];
              	  $Category=$DataRows["category"];
              	  $Admin=$DataRows["author"];
              	  $Image=$DataRows["image"];
              	  $Post=$DataRows["post"];



           
              


             ?>
             <div style="padding: 5px;" class="blogpost thumbnail">
             	<img  class="img-responsive img-rounded" style="width: 100%;"src="upload/<?php echo $Image;?>" >
               </div>
             	<div style="padding: 5px;" class="caption">
             		
             		<h2 style="background-color:  #F2F3F4 ;" id="heading"><?php echo htmlentities($Title);?></h2>
             		<p class="description" ><img src="img/content.png"><?php echo htmlentities($Category);?>  
                <img src="img/term-loan.png"><?php echo htmlentities($DateTime);?></p>
             		<p style="background-color: #ECF0F1" class="post" style="font-size: 100px;"><?php

                    

             		 echo $Post; ?></p>
             	</div>
             	
            
              <br>

         <?php } ?>
         <br>

                <hr>
                <h3>Comments</h3>


                <?php 
                global $conn;
                $PostIDFromURL=$_GET["id"];
                $query="SELECT * FROM comments WHERE admin_panel_id='$PostIDFromURL' AND status='ON'";

                $exec=mysqli_query($conn,$query);
                while ($DataRows=mysqli_fetch_array($exec)) {
                  $commentdate=$DataRows["datetime"];
                  $commentername=$DataRows["name"];
                  $comment=$DataRows["comment"];
                 
                


                ?>
                
                <div>
                  <img class="pull-left" src="img/comment.png" width="100px"; height="110px";>
                  <div style="margin-left: 100px;background-color: #fbf2fd;margin-top: -100px;padding-bottom: -10px;">

                  <p style="font-weight: bold;margin-left: 5px; "><?php echo $commentername; ?></p>
                  <p style="font-size: 10px;"><?php echo $commentdate; ?></p>
                  <p><?php echo $comment; ?></p>
                  </div></div>
                

             <?php } ?>


           <div>
              <h3>Share your Opinion on this Post:</h3>

              <form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
                <fieldset>
                  <div class="form-group">
                   <label for="title"><span class="FieldInfo">Name:</span></label>
                  <input class="form-control"type="text" name="Name" id="Name" placeholder="Enter Name">

                </div>

                <div class="form-group">
                   <label for="title"><span class="FieldInfo">Email:</span></label>
                  <input class="form-control"type="text" name="Email" id="Email" placeholder="Enter Email">

                </div>

               
                 <div class="form-group">
                   <label for="commentarea"><span class="FieldInfo">Comment:</span></label>
                   <textarea class="form-control" name="Comment" id="commentarea" placeholder="Enter Your Comment"></textarea>


                <br>
                <input class="btn btn-success btn-primary" type="submit" name="Submit" >
                </fieldset>
                <br>

              </form>
            </div>
            
                   
                 
               
                </div><!--Main area ending-->

  <div style="padding: 10px;
  "class="col-sm-3">
    <br><br>
          
         <form action="test.php" method="post">
     <div class="form-group">
     <label>Search in Blog</label>
    <input  class="form-control" name="Search"><br>
     <button  name="Searchbutton" class="btn btn-primary">Search</button>
  </div>

</form>
      <br>
      <div class="panel">
                    <div style="background-color: #009999;" class="panel-heading">
                      
                      <h2 style="font-weight: bold;padding: 2px;text-align: center;" class="panel-title">Categories</h2>
                    </div>
                    <div class="panel-body">
                      
                      <?php 

                      global $conn;
                      $ViewQuery="SELECT* FROM category ORDER BY datetime desc";
                      $exec=mysqli_query($conn,$ViewQuery);
                      while ($DataRows=mysqli_fetch_array( $exec)) {
                           $Id=$DataRows['id'];
                           $Category=$DataRows['name'];

                           ?>

                          <a href="index.php?category=<?php echo $Category; ?> " style="text-decoration: none;color: black;">
                            <h4 style="text-align: left;background-color: #ABEBC6;padding: 2px;padding-left: 2px;"><?php echo $Category; ?></h4>
                          </a> 
                      <?php } ?>

                    

                    </div>
                    <div style="height: 2px;background-color:#009999; " class="panel-footer">
                      
                    </div>


                  </div>
                  <br>

                  <!-- end of category -->

                   <div class="panel">
                    <div style="background-color: #009999;" class="panel-heading">

                      
                      <h2 style="font-weight: bold;padding: 2px;text-align: center;" class="panel-title">Recent Posts</h2>
                    </div>
                    <div style="border: 2px solid #009999;" class="panel-body">
                      <?php 
                      global $conn;
                      $Viewquery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";
                      $exec=mysqli_query($conn,$Viewquery);
                      while ($DataRows=mysqli_fetch_array( $exec)) {
                           $Id=$DataRows['id'];
                           $Title=$DataRows['title'];
                           $DateTime=$DataRows['datetime'];
                           $Image=$DataRows['image'];
                           if(strlen($DateTime)>17){$DateTime=substr($DateTime,0,17);}
                            if(strlen($Title)>35){$Title=substr($Title,0,35);}

                      ?>
                      <div style="padding: 1px;">
                        <div style="width: 90px; height: 80px;padding: 5px; background-color: #F4F6F7 ;">
                        <img class="pull-left" style=""src="upload/<?php echo htmlentities($Image);?>" width=90; height=70;></div>

                        <div style="margin-left: 100px;margin-top: -70px;">
                        <p style="font-size: 15px;"><?php echo htmlentities($Title); ?></p>
                        <p style="font-size: 11px;margin-top: -10px;"><img src="img/term-loan.png"><?php echo
                        htmlentities($DateTime);?></p>
                        </div>

                      </div>

                     <div style="height: 1px;background-color: #009999;padding-bottom: 1px;margin-top: 5px; "></div>
                      

                    <?php } ?>

                    
                    </div>
                  

                  </div>
                     
      
        </div>

                	

                </div>
            </div></div>






         
         <div id="footer" >

      <p>Developed By |K.Jagadeesh Kumar|--All Rights Reserved.</p>

     </div>




</body>
</html>