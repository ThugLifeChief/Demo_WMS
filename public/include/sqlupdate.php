<?php

include_once __DIR__.'/../../src/sqlqueries/sqlquery.php';
include_once __DIR__.'/../../src/config/db.php';

if (isset($_POST['submit'])){
  if (isset($_POST['table'])){
    $table = $_POST['table'];  //get Table names
    if (isset($_POST['P_OID'])){
      $object = new sqlquery;
      $columnnames = $object->allColumn($table); //get all column names of $table
      $data = array();  // init $data array

      foreach ($columnnames as $columnname) {
        if($columnname =='P_ZEITSTEMPEL' || $columnname == 'P_ANLAGE_DATUM' || $columnname == 'P_LETZTE_AENDERUNG' ){
          // add columnnames and values to $data array
          $newdata = array($columnname => null);
          $data = array_merge($data,$newdata);
        } elseif($_POST[$columnname] == 'NULL') {
          $newdata = array($columnname => null);
          $data = array_merge($data,$newdata);
        } elseif($_POST[$columnname] != null) {
          $newdata = array($columnname => $_POST[$columnname]);
          $data = array_merge($data,$newdata);
        }
      }
      //print_r($data);
      $return = $object->updateTable($table,$data); //update $data into $table
      header("Location: ../sqlinterface.php?table=".$table."&updatereturn=".$return);
    }else{
      $returnstring = "FAIL : PLEASE SET P_OID!";
      header("Location: ../sqlinterface.php?table=".$table."&updatereturn=".$returnstring);
    }
  }else{
    header("Location: ../sqlinterface.php?updatereturn=fail");
  }
}
 ?>
