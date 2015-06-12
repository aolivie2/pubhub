 <!--
  Hana Glasser and Abby Olivier
  CS304 Final Project - PubHub
  staffmanage.php

  This page allows managers to add and delete staff members.
-->
<?php 
session_start(); /// initialize session 
include("passwords.php"); 
ensure_logged_in(); /// function checks if visitor is logged. 
ensure_manager(); //makes sure a manager is logged on
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
          <h1>Staff Management</h1>
          <p class="lead"> 


            <fieldset>
              <legend>Add or Delete a staff member.</legend>

              <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                <p>What is the new staff member's name?
                  <input type="text" name="person" length="100"></p>

                  <p>What is the new staff member's Wellesley username?
                    <input type="text" name="wellesleyUser" length="100"></p>

                    <p>What is the new staff member's PubHub password?
                      <input type="text" name="password" length="100"></p>

                      <p>Are they a manager?
                        <br>
                        <input type="radio" name="manager_status" value="1">Yes
                        <br>
                        <input type="radio" name="manager_status" value ="0"> No
                        <br><br>
                        <input class="btn btn-primary btn-xs" type="submit" name="Create" value="Create">
                      </p>
                    </form>

                  </fieldset>


                  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <p>What is the Wellesley username of the person you want to delete?
                      <input type="text" name="wellesleyUser2" length="100">
                      <br>
                      <input class="btn btn-primary btn-xs" type="submit" name="Delete" value="Delete"></p>
                    </form>

                  </div>
                  <div class="col-lg-6" > 
                  </div>

                  <?php             
// The following loads the Pear MDB2 class and our functions
                  include("functions.php"); 

                  if (isset($_REQUEST['Create'])) {
                   $person = $_REQUEST['person'];
                   $wellesleyUser = $_REQUEST['wellesleyUser'];
                   $pass = $_REQUEST['password'];
                   $manager_status = $_REQUEST['manager_status'];

                   $sql = "INSERT INTO staff(staff_name,username,password,manager_status) VALUES (?,?,?,?)";

                   prepared_statement($dbh,$sql,array($person,$wellesleyUser,$pass,$manager_status));
                   echo '<p class="lead">';
                   echo "<p>New staff employee $person was added!</p>";
                   echo "</p>";
                 }


                 if (isset($_REQUEST['Delete'])) {
                   $wellesleyUser2 = $_REQUEST['wellesleyUser2'];

                   $sql = "DELETE FROM staff WHERE username=?";

                   prepared_statement($dbh,$sql,$wellesleyUser2); 
                   echo '<p class="lead">';
                   echo "<p>Staff employee $wellesleyUser2 was deleted!</p>";
                   echo "</p>";  
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
