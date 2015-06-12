      <!--
      Hana Glasser and Abby Olivier
      CS304 Final Project - PubHub
      weekendshifts.php

      This page allows staff to specify their work availability for the coming weekend. 
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
              <h1>Weekend Shift Availability</h1>
            </div>

            <div class="col-lg-6" style="width:400px;">
              <fieldset>
                <legend></legend>

                <p><em>Please check the box next to the shifts that you are able to work. 
                  If you are not able to work the shift, do not select anything.</em></p>

                  <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group">
                      <p>
                        <input type = "checkbox" name ="earlyFriday" value ="">Early Friday Shift
                        <br>
                        <input type = "checkbox" name ="lateFriday" value =""> Late Friday Shift
                        <br>
                        <input type = "checkbox" name ="earlySaturday" value =""> Early Saturday Shift
                        <br>
                        <input type = "checkbox" name ="lateSaturday" value ="">Late Saturday Shift
                        <br>
                      </p>
                      <p><input class="btn btn-primary btn-xs" type="submit" name="Submit" value="submit"></p>
                    </div>
                  </form>
                </fieldset>
              </div>


              <div class="col-lg-6" > 
                <form name="searchShift" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                  <p>Select a weekend shift to view this week's staff availability.</p>
                  <select name="shift">
                    <option value="choose">Please select an option</option>
                    <option value="early_friday">Early Friday Shift</option>
                    <option value="late_friday">Late Friday Shift</option>
                    <option value="early_saturday">Early Saturday Shift</option>
                    <option value="late_saturday">Late Saturday Shift</option>
                  </select>
                  
                  <input class="btn btn-primary btn-xs" type="submit" name="Search1" value="search">
                </form>
              </div>
              <div class="col-lg-6" > 
              </div>

              <?php
       include("functions.php");   //allows access to dbh and all other functions needed for this page

    //Adding info to the weekend table after pushing the submit button
       if (isset($_REQUEST['Submit'])) {  

       $staffID = getStaffID($_SESSION["logged"], $dbh); //session variable stores username, we want ID number

       $time = date('Y-m-d'); 

       $earlyFriday = getCheckbox("earlyFriday");
       $lateFriday = getCheckbox("lateFriday");
       $earlySaturday = getCheckbox("earlySaturday");
       $lateSaturday = getCheckbox("lateSaturday");

       if(userAdded($staffID, $dbh) == false){   // if the user ID is not already in the table we will insert it

        $sql = "INSERT into weekend (wid, early_friday, late_friday, early_saturday, late_saturday, last_update) values (?,?,?,?,?,?)";
        prepared_statement($dbh,$sql,array($staffID,$earlyFriday,$lateFriday,$earlySaturday,$lateSaturday,$time));
      }else{ //if the user ID is already in table, we will update it

        $sql = "UPDATE weekend SET early_friday=?, late_friday=?, early_saturday=?, late_saturday=?, last_update=? WHERE wid=?";
        prepared_statement($dbh,$sql,array($earlyFriday,$lateFriday,$earlySaturday,$lateSaturday,$time,$staffID));
      }

      $name = getStaffName($staffID,$dbh);
      echo '<p class="lead">';
      echo  "<br><br>Thank you $name for submitting your weekly shift availability!";
      echo  '</p>';
    }
        //The series of if statements below display which staff members are available to work, depending on which shift was specified from the 
        //drop-down menu in the second form. 

        if (isset($_REQUEST['Search1'])){  // If a user clicks the search button
          $wid = $_REQUEST['shift'];

      /////////////STAFF MEMBERS WHO CAN WORK EARLY FRIDAY///////////////
          if ($wid=='early_friday') { 
            $sql = "SELECT wid,early_friday from weekend;";
            $resultset= query($dbh,$sql);
            $num_rows = $resultset->numRows();
            $count=0;

            while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {
             $wid = $row['wid'];
             $early_friday = $row['early_friday'];
             
             if ($early_friday == 1) {
              $count=1;                         //the count tells us at least one person can work if it's 1
              $name = getStaffName($wid, $dbh);
              echo '<br><p class="lead">';
              echo "$name <br>";
              echo '</p>';
            } 
          }
          
          if ($count == 0){   //the count is never changed, thus no one can work
            echo '<p class="lead">';
            echo "<br>No one can work during this shift.";
            echo '</p>';
          }
        }

         ////////////STAFF MEMBERS WHO CAN WORK LATE FRIDAY//////////////
        if ($wid=='late_friday') {
          $sql = "SELECT wid,late_friday from weekend;";
          $resultset= query($dbh,$sql);
          $num_rows = $resultset->numRows();
          $count=0;

          while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {
           $wid = $row['wid'];
           $late_friday = $row['late_friday'];
           
           if ($late_friday == 1) {
            $name = getStaffName($wid, $dbh);
            $count=1;
            echo '<br><p class="lead">';
            echo "$name <br>";
            echo '</p>';
          } 
        }

        if ($count ==0){
          echo '<p class="lead">';
          echo "<br>No one can work during this shift.";
          echo '</p>';
        }
      }

           ///////////////STAFF MEMBERS WHO CAN WORK LATE SATURDAY////////////
      if ($wid=='late_saturday') {
        $sql = "SELECT wid,late_saturday from weekend;";
        $resultset= query($dbh,$sql);
        $num_rows = $resultset->numRows();
        $count=0;

        while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {
         $wid = $row['wid'];
         $late_saturday = $row['late_saturday'];

         if ($late_saturday == 1) {
          $name = getStaffName($wid, $dbh);
          $count=1;
          echo '<br><p class="lead">';
          echo "$name <br>";
          echo '</p>';
        } 
      }

      if ($count ==0){
        echo '<p class="lead">';
        echo "<br>No one can work during this shift.";
        echo '</p>';
      }
    }

           /////////////STAFF MEMBERS WHO CAN WORK EARLY SATURDAY///////////////
    if ($wid=='early_saturday') {
      $sql = "SELECT wid,early_saturday from weekend;";
      $resultset= query($dbh,$sql);
      $num_rows = $resultset->numRows();
      $count = 0;

      while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {
       $wid = $row['wid'];
       $early_saturday = $row['early_saturday'];

       if ($early_saturday == 1) {
        $name = getStaffName($wid, $dbh);
        $count=1;
        echo '<br><p class="lead">';
        echo "$name <br> ";
        echo '</p>';
      } 
    }

    if ($count ==0){
      echo '<p class="lead">';
      echo "<br>No one can work during this shift.";
      echo '</p>';
    }
  }
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
