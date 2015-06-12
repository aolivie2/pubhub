<!--
Hana Glasser and Abby Olivier
CS304 Final Project - PubHub
manager.php

This page appears when a non-manager attempts to access manager-only pages.
-->

<!doctype html>

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
          <h1>Sorry, Manager access only!</h1>    
        </div>
        <div class="col-lg-6" >    
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
