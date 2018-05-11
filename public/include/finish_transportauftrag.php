<?php

include_once __DIR__.'/../../src/sqlqueries/sqlquery.php';
include_once __DIR__.'/../../src/sqlqueries/sqlquery2.php';
include_once __DIR__.'/../../src/sqlqueries/functionclass.php';
include_once __DIR__.'/../../src/config/db.php';

if (isset($_POST['P_OID'])){
  $id = $_POST['P_OID'];


  $object = new sqlquery2;

  // get grai from LADEHILFSMITTEL
  $table = 'LADEHILFSMITTEL';
  $column = 'P_GRAI_ID';
  $index = 'TRANSPORTAUFTRAG_P_OID';
  $search = $id;

  $grai = $object->SelectFromDB($table,$column,$index,$search);

  // get P_ZIEL from TRANSPORTAUFTRAG
  $table = 'TRANSPORTAUFTRAG';
  $column = 'P_ZIEL';
  $index = 'P_OID';
  $search = $id;

  $P_ZIEL = $object->SelectFromDB($table,$column,$index,$search);

  // get P_QUELLE from TRANSPORTAUFTRAG
  $table = 'TRANSPORTAUFTRAG';
  $column = 'P_QUELLE';
  $index = 'P_OID';
  $search = $id;

  $P_QUELLE = $object->SelectFromDB($table,$column,$index,$search);

  if($P_ZIEL != null && $grai != null){
    $object3 = new functionclass;
    if($P_ZIEL == 'extern'){
      //delete from DB
      $return = $object3->outgoingGoods($grai);
    } else {

      if (is_numeric($P_QUELLE))
      {
        $return = $object3->removeFrom($grai,$P_QUELLE);
        print_r($return);
      }

      // try store to STELLPLATZ
      $return = $object3->storeTo($grai,$P_ZIEL);

      if($return != 'success'){
        // try store to ANHAENGER
        $return = $object3->loadTo($grai,$P_ZIEL);
      }

    }
  } else {
    // just finish TRANSPORTAUFTRAG
    $object2 = new sqlquery;
    $table = 'TRANSPORTAUFTRAG';
    $data = array('P_OID' => $id, 'P_STATUS' => 'FINISHED');
    $return = $object2->updateTable($table,$data);
  }

  header("Location: ../transportauftraege.php");

}
 ?>
