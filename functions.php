<!--
Hana Glasser and Abby Olivier
CS304 Final Project - PubHub
functions.php

File of functions referenced throughout our project site
-->

<?php 
require_once("MDB2.php");
require_once("/home/cs304/public_html/php/MDB2-functions.php");

// The following defines the data source name (username, password,
 // host and database).

require_once('hglasser-dsn.inc');

 // The following connects to the database, returning a database handle (dbh)

$dbh = db_connect($hglasser_dsn);




/* getCheckbox()

This function checks if a checkbox is checked
and if it is returns 1 (true). Otherwise it returns 0 (false)*/

function getCheckbox($name)
{
 if(isset($_REQUEST[$name])){
  return 1;
} else {
  return 0;
}
}


/* getCompletion()

This function converts a 1 or a 0 within the 
database to String complete or incomplete 
for display to the user */

  function getCompletion($variable)
{
 if($variable==1){
  $data = "complete";
  return $data;
} else {
  $data = "incomplete";
  return $data;
}
}


/* userAdded()

This function checks if a user (according to their id) 
already has a section in the weekend table */

function userAdded($id,$dbh)
{
  $query = "SELECT 1 FROM weekend WHERE wid='$id' LIMIT 1";
  if (@mysql_num_rows(mysql_query($query))!=1) {
   return false;
 } else {
   return true;
 }
 
}

/* userAddedClosing()

This function checks if a user (according to their id) 
already has a section in the Closing table */

function userAddedClosing($date,$dbh)    
{
  $query = "SELECT 1 FROM closing WHERE shiftdate='$date' LIMIT 1";
  if (@mysql_num_rows(mysql_query($query))!=1) {
   return false;
 } else {
   return true;
 }
 
}
/* getStaffName()

This function returns a staff member's 
name given a staffID */


function getStaffName($id,$dbh)
{
 $sql = "SELECT staff_name from staff where staffID=?";
 $data = $id;
 $resultset= prepared_query($dbh,$sql,$data);
 while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {
   $name = $row['staff_name'];
   return $name;
 }
}

/* getStaffID())

This function returns a staff member's 
ID given a username */ 

function getStaffID($username,$dbh)
{
 $sql = "SELECT staffID from staff where username=?";
 $data = $username;
 $resultset= prepared_query($dbh,$sql,$data);
 while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {
   $id = $row['staffID'];
   return $id;
 }
}