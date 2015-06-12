<!--
Hana Glasser and Abby Olivier
CS304 Final Project - PubHub
passwords.php


-->

<?php 
require_once("MDB2.php");
require_once("/home/cs304/public_html/php/MDB2-functions.php");

// The following defines the data source name (username, password,
 // host and database).

require_once('hglasser-dsn.inc');

 // The following connects to the database, returning a database handle (dbh)

$dbh = db_connect($hglasser_dsn);

$sql= mysql_query("SELECT username, password FROM staff"); 
$info = mysql_fetch_array( $sql ); 
$user = $info['username']; 
$pass = $info['password'];
$USERS[$user] = $pass;


while($info = mysql_fetch_array( $sql )) 
{ 
   $user = $info['username']; 
   $pass = $info['password'];

   $USERS[$user] = $pass;

} 


// This function returns true/false depending on whether someone is logged in
function check_logged_in() { 
   global $USERS; 
   if (isset($_SESSION["logged"]) && array_key_exists($_SESSION["logged"],$USERS)) { 
       return true;
   } else {
       return false;
   }
}


// This function limits page access to Punch's Alley staff only
function ensure_logged_in() { 
   global $_SESSION, $USERS; 
     if (!array_key_exists($_SESSION["logged"],$USERS)) { //If an approved user is not logged in
          header("Location: staff.php"); //redirect to login page
          die();
      } 
  }

//This function limits page access to managers-only
  function ensure_manager() { 
    global $dbh;
     $sql = "SELECT manager_status from staff where username = ?"; //queries manager status of logged-in user
     $data = $_SESSION["logged"];
     $resultset= prepared_query($dbh,$sql,$data);
     
     while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {
       $status = $row['manager_status'];

     if ($status==0) { //if user is not a manager...
          header("Location: manager.php"); //redirect to manager-only error message
          
      } 
  }
}


?>