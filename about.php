<!--
Hana Glasser and Abby Olivier
CS304 Final Project - PubHub
about.php

This is the PubHub about page.
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

          <h1 id="type">About Punch's Alley</h1>
          <div class="col-lg-6">
           <span style="float: right; margin-right: 15px;">
             <p> <img src="photos/board.jpg"></p>
           </span>
         </div>
         
         <p class="lead" style="width: 400px;"> Punch's Alley is a student-run pub on the bottom floor of the Lulu Chow Wang campus center. 
          We host a variety of student events for campus organizations, a weekly dance party, and off-campus 
          visitors and performers. Our hours are Monday-Wednesday from 7PM-12AM, Thursday from 4:30PM-1AM, 
          and Friday and Saturday from 8PM-1AM. </p>

          <p class="lead">We hope you stop by. </p>
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
