<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>




<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="css/mainstyles.css">

  <title>Home Page</title>
  <style type="text/css">
    .pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
  margin: 0 4px;
}

.pagination a.active {
  background-color: #17a2b8;
  color: white;
  border: 1px solid #17a2b8;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
  </style>


</head>
<body>
   <div class="logo-wrap">
        <div class="container">
    <div class="row justify-content-between align-items-center">
    <div class="col-lg-4 col-md-4 col-sm-12 logo-left no-padding">
    <a href="index.php">
  <img style="margin-left: -10px;margin-top: 10px;" class="img-fluid" src="img/brand.png" width="400";height="40">
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
        <a class="nav-link" href="#">About</a>
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



        <div id="content" class="container">
          <div  class="row"><!--row-->
            
            <div  class="col-sm-9"><!--Main blog area-->
              <h2>Latest Posts</h2>
             <?php 
              global $conn;
              if(isset($_POST['Searchbutton'])){

                $Search=$_POST["Search"];
                
                $Viewquery="SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%' ";
             
              }
              //Query foer category display.
              elseif(isset($_GET["category"])){
                $Category=$_GET["category"];
                $Viewquery="SELECT * FROM admin_panel WHERE category='$Category' ORDER BY datetime desc"; 

              }


              //pagenation query

              elseif(isset($_GET["page"])){


                $Page=$_GET["page"];

                if ($Page==0||$Page<1) {
                  $Showpostfrom=0;

                 
                }else{

                $Showpostfrom=($Page*5)-5;

                
                $Viewquery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT $Showpostfrom,5"; 
              }

              }


              else{  

              $Viewquery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,8"; }
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
             <div class="row">
             <div id="postimage"class=" col-sm-5 thumbnail">
              <img  class="img-responsive img-rounded" style="width: 100%;height: 100%;" src="upload/<?php echo $Image;?>" >
                 </div>
              <div id="postcontent" class=" col-sm-7 caption">
                
                <h2 id="postheading"><?php echo htmlentities($Title);?></h2>
                <p id="details" ><img src="img/content.png"> <?php echo htmlentities($Category);?>
                <img src="img/term-loan.png"><?php echo htmlentities($DateTime);?></p>
                <p id="post"><?php

                     if (strlen($Post)>20) {$Post=substr($Post,0,200).'....';
                      
                     }

                 echo $Post; ?></p>
                  <a id="readmore" href="FullPost.php?id=<?php echo $PostId;?>"><span class="btn btn-info">Read More &rsaquo; </span></a>
              </div>
             
             </div>
              <hr>
         <?php }?>
                 <!-- pagination -------------------------------> 

         <div class="pagination">

          <?php
          if(isset($Page)) {
          if($Page>1){
            ?>

             <a href="index.php?page=<?php echo $Page-1 ?>">&laquo;</a>
                  <?php } 
                }

                  ?>
                  

              <?php 
              global $conn;
              $Querypagination="SELECT COUNT(*) FROM admin_panel";
              $exec=mysqli_query($conn,$Querypagination);
              $Rowpagination=mysqli_fetch_array($exec);
              $TotalPosts=array_shift($Rowpagination);
              //echo $TotalPosts;
              $postperpage=$TotalPosts/5;

              $postperpage=ceil($postperpage);
              

             for($i=1;$i<=$postperpage;$i++)
             {

              if(isset($Page)){

              if($i==$Page){


              ?>

              <a class="active" href="index.php?page=<?php echo $i;?>"><?php echo $i; ?></a>
                     
                     
                   <?php 

                 } else { ?>

               <a href="index.php?page=<?php echo $i;?>"><?php echo $i; ?></a>
                <?php

                   }
            }

                   } ?>



                     <?php
                 if(isset($Page)) {

               if($Page+1<=$postperpage){

                 ?>

             <a href="index.php?page=<?php echo $Page+1 ?>">&raquo;</a>
                  <?php } 
                }

                  ?>

                  </div>
               
            


                   
                 
               
                </div><!--Main area ending-->

                
 <div class="col-sm-3" >
  <br>
  <br>
  <form action="index.php" method="post">
     <div class="form-group">
     <label>Search in Blog</label>
    <input  class="form-control" name="Search"><br>
     <button  name="Searchbutton" class="btn btn-primary">Search</button>
  </div>

</form>
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

                     <div style="height: 1px;background-color: #009999; "></div>
                      

                    <?php } ?>

                    
                    </div>
                    <div class="panel-footer">
                      
                    </div>


                  </div>
                     
    
                </div>
            </div></div>
         
         <div id="footer">
      <p>Developed By |K.Jagadeesh Kumar|--All Rights Reserved.</p>


     </div>




</body>
</html>