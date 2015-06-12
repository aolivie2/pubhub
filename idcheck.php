
<!--
Hana Glasser and Abby Olivier
CS304 Final Project - PubHub
idcheck.php

This page allows staff to validate student birthdates(if they are over 21) by searching with their bnumber in the database.
-->
<?php 
session_start(); /// initialize session 
include("passwords.php"); 
ensure_logged_in(); /// function checks if visitor is logged. 
//If user is not logged the user is redirected to login.php page  
?> 

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
          <h1>Fake ID Verification</h1>
          <p class="lead"> 

            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

              <div class="form-group" style="width:400px;">
                <label for="inputEmail" class="col-lg-5 control-label">Enter a student's b-number:</label>
                <div class="col-lg-6">
                  <input type="text" class="form-control" name="number" placeholder="Bnumber"><br>
                  <input class="btn btn-default" type="submit" name="Verify" value="Verify"><br><br><br>
                </div>
              </div>

            </form>
          </p> 
        </div>

        <div class="col-lg-6" >
          <span style="float: left; margin-right: 15px;">
          </span>   
        </div>


        <?php 
        include("functions.php"); 

//LOADING THE DATA into the Students table for fake id checks
        $sql1 = "LOAD DATA LOCAL INFILE 'ids.txt' INTO TABLE students FIELDS terminated by ',' LINES terminated by '\n' ";
        query($dbh,$sql1);

        if (isset($_REQUEST['Verify'])){

          $sql = "SELECT studentname,birth FROM students WHERE bnumber= ?";
          $data = $_REQUEST['number'];
          $resultset= prepared_query($dbh,$sql,$data);
          $num_rows = $resultset->numRows();

          if ($num_rows==0) {

            echo '<div class="col-lg-6" >';
            echo '<p class="lead">'; 
            echo "That student was not found."; 
            echo '</p>';
            echo '</div>';
          }

          echo "<ul>\n";
          while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {
           $studentname = $row['studentname'];
           $birth = $row['birth'];

           echo '<div class="col-lg-6" >';
           echo '<p style="width:400px;" class="lead">';
           echo "$studentname was born on $birth.";
           echo '</p>';
           echo '</div>';
         }
         echo "</ul>\n";
       }
       ?>

     </div>
   </div>
 </div>


 <?php include_once('footer.php'); ?>

 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
 <script src="bootstrap.min.js"></script>
 <script src="bootswatch.js"></script>

</body>
</html>
