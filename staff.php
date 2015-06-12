<!--
Hana Glasser and Abby Olivier
CS304 Final Project - PubHub
staff.php

This is the PubHub staff login page.
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
        <div class="col-lg-6" >
          <span style="float: left; margin-right: 15px;">
          </span> 
        </div>


        <?php 

error_reporting(0); // put this error to not show errors on the page (if a user logins in with a wrong username etc)
session_start(); 
include("passwords.php"); 
if (isset($_REQUEST['login'])) {
     if ($USERS[$_REQUEST["username"]]==$_REQUEST["password"]) { /// check if submitted username and password exist in $USERS array 
      $_SESSION["logged"]=$_REQUEST["username"]; 

    } else { 
      echo '<br><p>Incorrect username/password. Please, try again.<br></p>'; 
    }; 
  }; 

  if (isset($_REQUEST['logout'])) {
    $_SESSION["logged"] = "";
    session_destroy();

  }

  if (check_logged_in() ) { // if the user is logged in, don't show full form, just logout button
  
  echo '<div class="col-lg-6">';
  echo   "<h1>Staff Login</h1>";
  echo "<form class='form-signin' role='form' name='ac' action='".$_SERVER['PHP_SELF']."' method='post'>";
  echo "<fieldset>";
     echo   '<input class="btn btn-default" type="submit" name="logout" value="Logout"><br>'; //logout button
     echo "</fieldset></form></p></div>";

     echo "<em>You are logged in.</em>";    //// if user is logged show a message

} else { //// if not logged show login form 
 echo '<div class="col-lg-6">';
 echo   "<h1>Staff Login</h1>";
 echo '<p style="float:right; width:400px" class="lead">'; 

 echo "<form class='form-signin' role='form' name='ac' action='".$_SERVER['PHP_SELF']."' method='post'>";
 echo "<fieldset>";
 echo  '<div class="form-group">';
 echo '   <div class="col-lg-2">';
 echo  '<input type="username" name="username" class="form-control" placeholder="Wellesley Username" required autofocus> <br>';
 echo  '<input type="password" name="password" class="form-control" placeholder="Password" required>';

 echo  '<br> <input class="btn btn-default" type="submit" name="login" value="Login">';
 echo   '<input class="btn btn-default" type="submit" name="logout" value="Logout">';
 echo   "</div>";
 echo "</div>"; 
 echo "</fieldset></form></p></div>";
 
 echo "<em>You are not logged in.</em>";
}; 
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
