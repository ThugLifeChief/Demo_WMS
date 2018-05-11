<?php

include_once __DIR__.'/../../src/sqlqueries/sqlquery.php';
include_once __DIR__.'/../../src/config/db.php';

if (isset($_POST['submit'])){
  if (isset($_POST['table'])){
    $table = $_POST['table'];  //get Table names
    $object = new sqlquery;
    $columnnames = $object->allColumn($table); //get all column names of $table
    $data = array();  // init $data array

    foreach ($columnnames as $columnname) {
      if($columnname == 'P_OID' || $columnname =='P_ZEITSTEMPEL' || $columnname == 'P_ANLAGE_DATUM' || $columnname == 'P_LETZTE_AENDERUNG' ){
        // add columnnames and values to $data array
        $newdata = array($columnname => null);
        $data = array_merge($data,$newdata);
      } else {
        if($_POST[$columnname] != ""){
          $newdata = array($columnname => $_POST[$columnname]);
        } else {
          $newdata = array($columnname => null);
        }
        $data = array_merge($data,$newdata);
      }
    }
    //print_r($data);
    $return = $object->insertintoTable($table,$data); //insert $data into $table
    header("Location: ../sqlinterface.php?table=".$table."&insertreturn=".$return);

  }else{
    header("Location: ../sqlinterface.php?insertreturn=fail");
  }
}
 ?>
