<!--
Hana Glasser and Abby Olivier
CS304 Final Project - PubHub
spacemanagement.php

This form is used to keep a record of completed chores at closing. It is only accessible to managers. 
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
  <link rel="stylesheet" type="text/css" href="datepicker/css/datepicker.css">
</head>

<body>

  <?php include_once('nav.php'); ?>

  <div class="container">
    <div class="page-header" id="banner" style="width:500px;">

      <h1>Closing Checklist</h1>

      <div class="col-lg-6" style="width:500px;">

        <!--CLOSING TASKLIST FORM-->
        <form style="width:500px;" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

          <p> Please select today's date:
            <input type="text" name ="date" value="" data-date-format="yyyy-mm-dd" class="datepicker" ></p>

            <p>How much money did we open with?
              <input type="text" name="start_money" length="30"></p>

              <p>How much money did we close with?
                <input type="text" name="end_money" length="30"></p>

                <p>What is the cooler temperature?
                  <input type="text" name="cooler" length="30"></p>

                  <p>What is the dishwasher pH?
                    <input type="text" name="pH" length="30"></p>

                    <table><br>
                      <tr>
                        <td><input type = "checkbox" name ="chalkboard" value ="true"> Chalkboard put away</td>
                        <td><input type = "checkbox" name ="dishes" value =""> Dishes washed</td>
                        <td><input type = "checkbox" name ="safe" value =""> Money put in safe</td>
                      </tr>

                      <tr>
                        <td><input type = "checkbox" name ="sound_system" value =""> Sound system off</td>
                        <td><input type = "checkbox" name ="co2" value =""> C02 turned off</td>
                        <td><input type = "checkbox" name ="dishwasher" value =""> Dishwasher empty</td>
                      </tr>

                      <tr>
                        <td><input type = "checkbox" name ="surfaces" value =""> Surfaces wiped</td>
                        <td><input type = "checkbox" name ="furniture" value =""> Furniture stacked</td>
                        <td><input type = "checkbox" name ="sinks" value =""> Sinks drained</td>

                      </tr>
                      <tr>
                        <td><input type = "checkbox" name ="soda_dispenser" value =""> Soda dispenser rinsed out</td>
                        <td><input type = "checkbox" name ="bottles" value =""> Beer bottles taken to cage</td>
                        <td><input type = "checkbox" name ="recycle" value =""> Wine bottles recycled</td>

                      </tr>

                      <td><input type = "checkbox" name ="locks" value =""> Coolers & tower locked</td>
                      <td><input type = "checkbox" name ="lights" value =""> Lights turned off</td>

                    </table>

                    <p><input class="btn btn-primary btn-xs" name ="submit" type="submit" value="submit"></p>

                  </form>
                </div>
              </div>

              <div class="col-lg-6" style="width:500px;">

                <!--FORM TO DISPLAY A PARTICULAR NIGHT'S RESULTS-->
                <form style="width:500px;" name="searchShifts" method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                  <p>Please select a date to search for a specific night's task results.
                    <input type="text" value="" name="searchdate" data-date-format="yyyy-mm-dd" class="datepicker2"></p>
                    
                    <p><input class="btn btn-primary btn-xs" name ="search" type="submit" value="search"></p>

                  </form>
                </div>


                <?php 
                include("functions.php"); 

 //The below inserts the user's form data into the database
                if (isset($_REQUEST['submit'])) {

                 $cid = getStaffID($_SESSION["logged"], $dbh);

                 $datedata= $_REQUEST['date'];
                 $start_money= $_REQUEST['start_money'];
                 $end_money= $_REQUEST['end_money'];
                 $cooler= $_REQUEST['cooler'];
                 $pH= $_REQUEST['pH'];
                 $chalkboard = getCheckbox("chalkboard");
                 $dishes = getCheckbox("dishes");
                 $safe= getCheckbox("safe");
                 $sound_system= getCheckbox("sound_system");
                 $co2= getCheckbox("co2");
                 $dishwasher= getCheckbox("dishwasher");
                 $surfaces= getCheckbox("surfaces");
                 $furniture= getCheckbox("furniture");
                 $sinks= getCheckbox("sinks");
                 $soda_dispenser= getCheckbox("soda_dispenser");
                 $bottles= getCheckbox("bottles");
                 $recycle= getCheckbox("recycle");
                 $locks= getCheckbox("locks");
                 $lights= getCheckbox("lights");

                 $name=getStaffName($cid, $dbh);

                 if(userAddedClosing($datedata, $dbh) == false){
                  $sql = "INSERT into closing (cid, shiftdate, start_money, end_money, cooler, pH, chalkboard, dishes, safe, sound_system, co2, dishwasher, surfaces, furniture, sinks, soda_dispenser, bottles, recycle, locks, lights) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                  prepared_statement($dbh,$sql,array($cid,$datedata,$start_money,$end_money,$cooler,$pH,$chalkboard,$dishes,$safe,$sound_system,$co2,$dishwasher,$surfaces,$furniture,$sinks,$soda_dispenser,$bottles,$recycle,$locks,$lights));
                }else{
                  $sql = "UPDATE closing SET cid=?, start_money=?, end_money=?, cooler=?, pH=?, chalkboard=?, dishes=?, safe=?, sound_system=?, co2=?,dishwasher=?, surfaces=?, furniture=?, sinks=?, soda_dispenser=?,bottles=?,recycle=?,locks=?,lights=? WHERE shiftdate=? ";
                  prepared_statement($dbh,$sql,array($cid,$start_money,$end_money,$cooler,$pH,$chalkboard,$dishes,$safe,$sound_system,$co2,$dishwasher,$surfaces,$furniture,$sinks,$soda_dispenser,$bottles,$recycle,$locks,$lights,$datedata));
                }

                echo '<p class="lead">';
                echo "<br>Thank you, $name. Your inputs for $datedata have been recorded.";
                echo "</p>";
              }

//The below displays a particular night's checklist results to the user.
              if (isset($_REQUEST['search'])){
                $sql = "SELECT start_money,end_money,cooler,pH,chalkboard,dishes,safe,sound_system,co2,dishwasher,surfaces,furniture,sinks,soda_dispenser,bottles,recycle,locks,lights FROM closing WHERE shiftdate= ?";
                $data = $_REQUEST['searchdate'];
                $resultset= prepared_query($dbh,$sql,$data);
                $num_rows = $resultset->numRows();

    //If there was no entry for the selected date, an error message appears.
                if ($num_rows==0) {
                  echo '<p class="lead">';
                  echo "<br>No entry was found for that date.";
                  echo "</p>";
                }

                echo "<ul>";
                while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {

                 $start_money = $row['start_money'];
                 $end_money = $row['end_money'];
                 $cooler = $row['cooler'];
                 $pH = $row['pH'];
               $chalkboard = getCompletion($row['chalkboard']); //The getCompletetion method returns the word "complete" or "incomplete"
               $dishes = getCompletion($row['dishes']);
               $safe = getCompletion($row['safe']);
               $sound_system = getCompletion($row['sound_system']);
               $co2 = getCompletion($row['co2']);
               $dishwasher = getCompletion($row['dishwasher']);
               $surfaces = getCompletion($row['surfaces']);
               $furniture = getCompletion($row['furniture']);
               $sinks = getCompletion($row['sinks']);
               $soda_dispenser = getCompletion($row['soda_dispenser']);
               $bottles = getCompletion($row['bottles']);
               $recycle = getCompletion($row['recycle']);
               $locks = getCompletion($row['locks']);
               $lights = getCompletion($row['lights']);

               echo '<div class="col-lg-6">';
               echo '<div class="list-group">';
               echo '<p style="float: left;" class="list-group-item-text">';
               echo "<legend>Checklist for $data</legend>";
               echo "Opened with: $$start_money <br>";
               echo "Closed with: $$end_money<br><br>";
               echo "Cooler temperature:  $cooler <br> Dishwasher pH:  $pH <br> Chalkboard put away:  $chalkboard <br> Dishes washed:  $dishes <br> 
               Money moved to safe:  $safe <br> Sound system turned off: $sound_system <br> CO2 turned off: $co2 <br> 
               Dishwasher drained: $dishwasher <br> Surfaces wiped: $surfaces <br> Furniture stacked: $furniture <br> 
               Sinks drained: $sinks <br> Soda dispenser rinsed: $soda_dispenser <br> Bottles brought to cage: $bottles <br> 
               Wine bottles recycled: $recycle <br> Coolers and tower locked: $locks <br> Lights turned off: $lights <br>";
               echo '</p>';
               echo '</div>';
               echo '</div>';
               
             }
             echo "</ul>";
           }

           ?> 

         </div>

         <?php include_once('footer.php'); ?>

         <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> 
         <script src="bootstrap.min.js"></script>
         <script src="bootswatch.js"></script> 
         <script src="bootstrap-datepicker.js"></script>
         <script src="datepicker.css"></script>

         <script type="text/javascript">
         $('.datepicker2, .datepicker').datepicker({
          "setDate": new Date(),
          "autoclose": true
        });
         </script> 

       </body>
       </html>
