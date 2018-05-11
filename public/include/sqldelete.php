<?php

include_once __DIR__.'/../../src/sqlqueries/sqlquery.php';
include_once __DIR__.'/../../src/config/db.php';

if (isset($_POST['submit'])){
  if (isset($_POST['table'])){
    $table = $_POST['table'];  //get Table names
    if (isset($_POST['P_OID'])){
      $id = $_POST['P_OID'];

      $object = new sqlquery;
      $return = $object->deleteRow($table,$id); //delete row with $id from $table

      header("Location: ../sqlinterface.php?table=".$table."&deletereturn=".$return);
    }else{
      $returnstring = "FAIL : PLEASE SET P_OID!";
      header("Location: ../sqlinterface.php?table=".$table."&deletereturn=".$returnstring);
    }
  }else{
    header("Location: ../sqlinterface.php?deletereturn=fail");
  }
}
 ?>
