<?php

include_once __DIR__.'/../../src/sqlqueries/sqlquery.php';
include_once __DIR__.'/../../src/config/db.php';

if (isset($_GET['submit'])){

  $object = new sqlquery;
  //$return = "true";
  $return = $object->resetDBIntelli();

  header("Location: ../ResetDB.php?resetintellireturn=".$return);
}
 ?>
