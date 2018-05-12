<?php
include_once __DIR__.'/../../src/sqlqueries/sqlquery.php';
include_once __DIR__.'/../../src/config/db.php';

if (isset($_GET['submit'])){

  $object = new sqlquery;
  //$return = "true";
  $return = $object->insertdemodata();

  header("Location: ../ResetDB.php?demodatareturn=".$return);
}
 ?>
