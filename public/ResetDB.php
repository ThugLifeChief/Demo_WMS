<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Demo WMS Reset DB</title>
  </head>
  <body>


<?php

include_once '../src/sqlqueries/sqlquery.php';
include_once '../src/config/db.php';

include_once 'include/sqlinsert.php';
include_once 'include/reset.php';
?>

   <h1>Here you can reset the Database</h1>
   <h3>Reset Database</h3>
   <form action="include/reset.php" method="get">
     <button type="submit" name="submit">Reset Database</button>
   </form>

   <?php
       if(isset($_GET['resetreturn'])){
         echo "<p>".$_GET['resetreturn']."</p>";
       }
    ?>
    <h3>Insert Demo Data</h3>
    <form action="include/insertdemodata.php" method="get">
      <button type="submit" name="submit">Insert Demodata</button>
    </form>

    <?php
        if(isset($_GET['demodatareturn'])){
          echo "<p>".$_GET['demodatareturn']."</p>";
        }
     ?>

     <h1>Here you can reset the Database for the IntelliREAD Demo</h1>
     <h3>Reset Database for IntelliREAD</h3>
     <form action="include/resettoIntelli.php" method="get">
       <button type="submit" name="submit">Reset Database</button>
     </form>

     <?php
         if(isset($_GET['resetintellireturn'])){
           echo "<p>".$_GET['resetintellireturn']."</p>";
         }
      ?>
   </body>
   </html>
