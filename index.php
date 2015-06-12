<!--
Hana Glasser and Abby Olivier
CS304 Final Project - PubHub
index.html

This is the PubHub homepage.
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PubHub</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.css" media="screen">
  <link rel="stylesheet" href="bootswatch.min.css">


</head>
<body>

  <?php include_once('nav.php'); ?>

  <div class="container"> 

    <div class="page-header" id="banner">
      <div class="row"> 
        <div class="col-lg-6">
         <div class="row"> 
          <h1>Punch's Alley</h1>
          <p class="lead">The Wellesley Pub</p>
          
          <span style="float: right; margin-right: 15px;">
            <img src="photos/pub.jpg" >
          </span>   
          
        </div>
      </div>
    </div>
  </div>

  <?php include_once('footer.php'); ?>
  
  <script src="jquery-1.10.2.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script src="bootswatch.js"></script>

</body>
</html>