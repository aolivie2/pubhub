<!--
Hana Glasser and Abby Olivier
CS304 Final Project - PubHub
events.php

This is the PubHub Events page.
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
          <h1>Events</h1>
          <p class="lead"> Come join us at the pub for reading period! Order a beer and get a study session in. </p> 
          
        </div>
        <div class="col-lg-6" >
          <span style="float: left; margin-right: 15px;">
            <img src="photos/rp.jpg" >
          </span>
          
        </div>
      </div>
    </div>
  </div>

  <?php include_once('footer.php'); ?>
  
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script src="bootswatch.js"></script>

</body>
</html>
