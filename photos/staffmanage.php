<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>PubHub</title>
  
  <link rel="stylesheet" href="pubhub.css" type="text/css" media="screen" />
 <link href='http://fonts.googleapis.com/css?family=Wire+One' rel='stylesheet' type='text/css'>

</head>

  <body>

<div id="header">
<P>Staff Management</p>
</div>

<div id="navbar">
 <nav>
        <ul>
            <li id="link1"><a href="index.html">home</a></li>
            <li id="link1"><a href="about.html">about us</a></li>
            <li id="link1"><a href="events.html">upcoming events</a></li> 

            <li id="link1"><a href="staff.html">staff only</a>   
            <ul>
               <li class="small"><a href="idcheck.html">Fake ID Check</a></li>  
                <li class="small"><a href="weekendshifts.html">Shift Scheduling</a></li>  
                 <li class="small"><a href="staffmanage.html">Staff Management</a></li>  
                  <li class="small"><a href="spacemanagement.php">Space Management</a></li>  
            </ul>  
            </li>     

        </ul>
    </nav>   
</div>
<div id="content">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<h1>Staff Management - Managers Only</h1> 

<p>Who is the new staff member?
<input type="text" name="staffID" length="100"">

<p>Are they a manager?
<input type="radio" name="manager_status" value="yes"> Yes
<br>
<input type="radio" name="manager_status" value ="false"> No

<p>What is their password?
<input type="text" name="end_money" length="30"">


<p><input type="submit" value="Submit">
</form>
</div>
</div>
 <?php
  
// The following loads the Pear MDB2 class and our functions
  
	require_once("MDB2.php");
 	require_once("/home/cs304/public_html/php/MDB2-functions.php");
  
// The following defines the data source name (username, password,
 // host and database).
 
	require_once('hglasser-dsn.inc');
  
 // The following connects to the database, returning a database handle (dbh)
 
 $dbh = db_connect($hglasser_dsn);
 
 $sql = "UPDATE closing SET cid=? WHERE shiftdate=?";
 $data = $_REQUEST['staffID'];
 echo $data;
 $data1= '2014-04-24';
 echo $data1;
 prepared_statement($dbh,$sql,$data,$data1);
  
 echo "<p> Your staff id has been recorded; thank you!\n";
?>
</div>
    <div id="footer">
    
    
            &copy; 2014 Abby Olivier & Hana Glasser
    </div>
  </body>







  

</html>