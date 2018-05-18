<?php

  include_once __DIR__.'/sqlquery.php';
  include_once __DIR__.'/sqlquery2.php';

  class functionclass {

    // getLargeLoadCarrierID from grai
    public function getLargeLoadCarrierID_grai($grai){

      $object = new sqlquery2;

      // get LADEHILFSMITTEL_P_OID
      $table = 'LADEHILFSMITTEL';
      $column = 'LADEHILFSMITTEL_P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai;

      if ($object->checkifinTable($table,$index,$search) == false){
        echo '{"grai" : '.json_encode('grai not in Table '.$table).'}';
        exit;
      }

      $return = $object->SelectFromDB($table,$column,$index,$search);
      if ($return == null){
        return $grai;
      } else {

        // get last LADEHILFSMITTEL_P_OID
        $c = 0;
        do {
          $table = 'LADEHILFSMITTEL';
          $column = 'LADEHILFSMITTEL_P_OID';
          $index = 'P_OID';
          $search = $return;

          $return = $object->SelectFromDB($table,$column,$index,$search);
          //print_r($return);
          $c++;

        } while ($return != null && $c<5);

        //get P_GRAI_ID from last LADEHILFSMITTEL
        $table = 'LADEHILFSMITTEL';
        $column = 'P_GRAI_ID';
        $index = 'P_OID';
        $search = $search;

        $return = $object->SelectFromDB($table,$column,$index,$search);

        return $return;
      }
    }

    // getLargeLoadCarrierID from sgtin
    public function getLargeLoadCarrierID_sgtin($sgtin){

      $object = new sqlquery2;
      // get WARE_P_OID
      $table = 'ARTIKEL';
      $column = 'WARE_P_OID';
      $index = 'P_SGTIN_ID';
      $search = $sgtin;

      if ($object->checkifinTable($table,$index,$search) == false){
        echo '{"grai" : '.json_encode('sgtin not in Table '.$table).'}';
        exit;
      }

      $return = $object->SelectFromDB($table,$column,$index,$search);
      //print_r($return);

      // get LADEHILFSMITTEL_P_OID
      $table = 'WARE';
      $column = 'LADEHILFSMITTEL_P_OID';
      $index = 'P_OID';
      $search = $return;

      $return = $object->SelectFromDB($table,$column,$index,$search);

      // get last LADEHILFSMITTEL_P_OID
      $c = 0;
      do {
        $table = 'LADEHILFSMITTEL';
        $column = 'LADEHILFSMITTEL_P_OID';
        $index = 'P_OID';
        $search = $return;

        $return = $object->SelectFromDB($table,$column,$index,$search);
        //print_r($return);
        $c++;

      } while ($return != null && $c<5);

      //get P_GRAI_ID from last LADEHILFSMITTEL
      $table = 'LADEHILFSMITTEL';
      $column = 'P_GRAI_ID';
      $index = 'P_OID';
      $search = $search;

      $return = $object->SelectFromDB($table,$column,$index,$search);

      return $return;

    }

    // storeTo
    public function storeTo($grai,$sgln){

      $object = new sqlquery2;

      // check if grai is in table
      $table = 'LADEHILFSMITTEL';
      $index = 'P_GRAI_ID';
      $search = $grai;

      if ($object->checkifinTable($table,$index,$search) == false){
        echo '{'.json_encode('grai not in Table '.$table).'}';
        return;
        exit;
      }

      // check if sgln is in table
      $table = 'STELLPLATZ';
      $index = 'P_SGLN_ID';
      $search = $sgln;

      if ($object->checkifinTable($table,$index,$search) == false){
        echo '{'.json_encode('sgln not in Table '.$table).'}';
        return;
        exit;
      }

      // check if grai is not linked to STELLPLATZ
      //$table = 'LADEHILFSMITTEL';
      //$column = 'STELLPLATZ_P_OID';
      //$index = 'P_GRAI_ID';
      //$search = $grai;

      //$return = $object->SelectFromDB($table,$column,$index,$search);

      //if ($return != null){
      //  echo '{"grai" : '.json_encode('grai linked to '.$column.' with P_OID :'.$return).'}';
      //  return;
      //  exit;
      //}

      // check if sgln is emty

      $table = 'STELLPLATZ';
      $column = 'P_STATUS';
      $index = 'P_SGLN_ID';
      $search = $sgln;

      $return = $object->SelectFromDB($table,$column,$index,$search);

      if ($return == 'BESETZT'){
        echo '{"return" : '.json_encode('sgln is '.$return).'}';
        return;
        exit;
      } else {
        // if not emty set grai to sgln

        //get P_OID from LADEHILFSMITTEL
        $table = 'LADEHILFSMITTEL';
        $column = 'P_OID';
        $index = 'P_GRAI_ID';
        $search = $grai;

        $return1 = $object->SelectFromDB($table,$column,$index,$search);

        //get P_OID from STELLPLATZ
        $table = 'STELLPLATZ';
        $column = 'P_OID';
        $index = 'P_SGLN_ID';
        $search = $sgln;

        $return2 = $object->SelectFromDB($table,$column,$index,$search);

        //get TRANSPORTAUFTRAGP_OID  LADEHILFSMITTEL
        $table = 'LADEHILFSMITTEL';
        $column = 'TRANSPORTAUFTRAG_P_OID';
        $index = 'P_GRAI_ID';
        $search = $grai;

        $TRANSPORTAUFTRAG_P_OID = $object->SelectFromDB($table,$column,$index,$search);

        //set DATA array for Update
        $table = 'LADEHILFSMITTEL';
        $data = array('P_OID' => $return1,'STELLPLATZ_P_OID' => $return2,'TRANSPORTAUFTRAG_P_OID' => null);

        // Update P_OID (from LADEHILFSMITTEL) with P_STELLPLATZ_P_OID
        $object2 = new sqlquery;
        $return = $object2->updateTable($table,$data);

        if ($return != 'success'){
          return $return;
          exit;
        }
        // Update P_STATUS (from STELLPLATZ)
        $table = 'STELLPLATZ';
        $data = array('P_OID' => $return2,'P_STATUS' => 'BESETZT');

        $return = $object2->updateTable($table,$data);
        if ($return != 'success'){
          return $return;
          exit;
        }

        // nur updaten wenn transportauftrag vorhanden, wenn nicht auch ok
        if ($TRANSPORTAUFTRAG_P_OID != null){
          // Update P_STATUS (from TRANSPORTAUFTRAG)
          $table = 'TRANSPORTAUFTRAG';
          $data = array('P_OID' => $TRANSPORTAUFTRAG_P_OID,'P_STATUS' => 'FINISHED');

          $return = $object2->updateTable($table,$data);
        }

        return $return;
      }
    }

    // removeFrom
    public function removeFrom($grai,$sgln){

      $object = new sqlquery2;

      // check if grai is in table
      $table = 'LADEHILFSMITTEL';
      $index = 'P_GRAI_ID';
      $search = $grai;

      if ($object->checkifinTable($table,$index,$search) == false){
        echo '{'.json_encode('grai not in Table '.$table).'}';
        return;
        exit;
      }

      // check if sgln is in table
      $table = 'STELLPLATZ';
      $index = 'P_SGLN_ID';
      $search = $sgln;

      if ($object->checkifinTable($table,$index,$search) == false){
        echo '{'.json_encode('sgln '.$sgln.' not in Table '.$table).'}';
        return;
        exit;
      }
      //get P_OID from LADEHILFSMITTEL
      $table = 'LADEHILFSMITTEL';
      $column = 'P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai;

      $return1 = $object->SelectFromDB($table,$column,$index,$search);

      //get P_OID from STELLPLATZ
      $table = 'STELLPLATZ';
      $column = 'P_OID';
      $index = 'P_SGLN_ID';
      $search = $sgln;

      $return2 = $object->SelectFromDB($table,$column,$index,$search);

      //set DATA array for Update
      $table = 'LADEHILFSMITTEL';
      $data = array('P_OID' => $return1, 'STELLPLATZ_P_OID' => NULL);

      // Update P_OID (from LADEHILFSMITTEL) with P_STELLPLATZ_P_OID = NULL
      $object2 = new sqlquery;
      $return = $object2->updateTable($table,$data);

      if($return != 'success'){
        return $return;
        exit;
      }

      $table = 'STELLPLATZ';
      $data = array('P_OID' => $return2, 'P_STATUS' => 'FREI');
      // Update P_STATUS (from STELLPLATZ) with 'P_STATUS' => 'FREI'
      $return = $object2->updateTable($table,$data);

      if($return != 'success'){
        return $return;
        exit;
      }

      //get TRANSPORTAUFTRAG_P_OID from LADEHILFSMITTEL

      $table = 'LADEHILFSMITTEL';
      $column = 'TRANSPORTAUFTRAG_P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai;

      $TRANSPORTAUFTRAG_P_OID = $object->SelectFromDB($table,$column,$index,$search);

      if ($TRANSPORTAUFTRAG_P_OID != null){
        $table = 'TRANSPORTAUFTRAG';
        $data = array('P_OID' => $TRANSPORTAUFTRAG_P_OID, 'P_STATUS' => 'in progress');
        // Update P_STATUS (from TRANSPORTAUFTRAG) with 'P_STATUS' => 'FREI'
        $return = $object2->updateTable($table,$data);
      }


      return $return;

    }

    //grai getTrailerAtLoadingLocation(sgln locationID)
    public function getTrailerAtLoadingLocation($sgln){

      $object = new sqlquery2;

      //get P_OID from STELLPLATZ
      $table = 'STELLPLATZ';
      $column = 'P_OID';
      $index = 'P_SGLN_ID';
      $search = $sgln;

      $P_OID = $object->SelectFromDB($table,$column,$index,$search);

      if($P_OID == null){
        return null;
        exit;
      }

      //get P_GRAI_ID from ANHAENGER
      $table = 'ANHAENGER';
      $column = 'P_GRAI_ID';
      $index = 'STELLPLATZ_P_OID';
      $search = $P_OID;

      $return = $object->SelectFromDB($table,$column,$index,$search);

      return $return;
    }

    // get TrailerID from grai
    public function getTrailerID_grai($grai){

      $LADEHILFSMITTEL_grai = $this->getLargeLoadCarrierID_grai($grai);

      //get P_OID from last LADEHILFSMITTEL
      $table = 'LADEHILFSMITTEL';
      $column = 'ANHAENGER_P_OID';
      $index = 'P_GRAI_ID';
      $search = $LADEHILFSMITTEL_grai;

      $object = new sqlquery2;

      $ANHAENGER_P_OID = $object->SelectFromDB($table,$column,$index,$search);

      if ($ANHAENGER_P_OID == null)
      {
        return 'LADEHILFSMITTEL not on ANHAENGER';
      } else {

        $table = 'ANHAENGER';
        $column = 'P_GRAI_ID';
        $index = 'P_OID';
        $search = $ANHAENGER_P_OID;

        $return = $object->SelectFromDB($table,$column,$index,$search);

        return $return;
      }
    }

    // get TrailerID from sgtin
    public function getTrailerID_sgtin($sgtin){

      $LADEHILFSMITTEL_grai = $this->getLargeLoadCarrierID_sgtin($sgtin);

      $return = $this->getTrailerID_grai($LADEHILFSMITTEL_grai);

      return $return;

    }

    // get TrainID from grai
    public function getTuggerTrain_grai($grai){

      //get FLURFOERDERMITTEL P_OID
      $table = 'ANHAENGER';
      $column = 'FLURFOERDERMITTEL_P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai;

      $object = new sqlquery2;

      $FLURFOERDERMITTEL_P_OID = $object->SelectFromDB($table,$column,$index,$search);

      if ($FLURFOERDERMITTEL_P_OID == null)
      {
        return 'ANHAENGER not linked to FLURFOERDERMITTEL';
      } else {

        $table = 'FLURFOERDERMITTEL';
        $column = 'P_GIAI_ID';
        $index = 'P_OID';
        $search = $FLURFOERDERMITTEL_P_OID;

        $return = $object->SelectFromDB($table,$column,$index,$search);

        return $return;
      }
    }

    // void reportTuggerTrainDeparture(giai trainID)
    public function reportTuggerTrainDeparture($giai) {
      //get FLURFOERDERMITTEL P_OID
      $table = 'FLURFOERDERMITTEL';
      $column = 'P_OID';
      $index = 'P_GIAI_ID';
      $search = $giai;

      $object = new sqlquery2;
      $object2 = new sqlquery;

      $P_OID = $object->SelectFromDB($table,$column,$index,$search);

      if ($P_OID == null){
        return 'giai not in Table FLURFOERDERMITTEL';
        exit;
      }



      //get ANHAENGER P_OID
      $table = 'ANHAENGER';
      $column = 'P_OID';
      $index = 'FLURFOERDERMITTEL_P_OID';
      $search = $P_OID;


      $P_OIDs = $object->SelectFromDBALL($table,$column,$index,$search);

      if ($P_OIDs == null){
        return 'ANHAENGER not linked to FLURFOERDERMITTEL';
        exit;
      }

      //print_r($P_OIDs);



      foreach ($P_OIDs as $P_OID => $value) {

        // update Anhänger
        $data = array('P_OID' => $value, 'STELLPLATZ_P_OID' => NULL);
        $return = $object2->updateTable($table,$data);

        // Stellplatz Lagerhilfsmittel löschen
        //get P_OID from LADEHILFSMITTEL
        $table = 'LADEHILFSMITTEL';
        $column = 'P_OID';
        $index = 'ANHAENGER_P_OID';
        $search = $value;

        $return1 = $object->SelectFromDB($table,$column,$index,$search);

        if ($return1 != NULL){
          //set DATA array for Update
          $table = 'LADEHILFSMITTEL';
          $data = array('P_OID' => $return1, 'STELLPLATZ_P_OID' => NULL);

          // Update P_OID (from LADEHILFSMITTEL) with P_STELLPLATZ_P_OID = NULL
          $return = $object2->updateTable($table,$data);

          if($return != 'success'){
            return $return;
            exit;
          }
        }
        echo '{"return" : '.json_encode($return).'}';
      }
      return 'overallsuccess';
    }

    // bool receivedGoods(grai largeLoadCarrierID)
    public function receivedGoods($grai){

      //create Transprotauftrag and set emty STELLPLATZ = RESERVIERT

      //find free storage Place which is not in Loading_Area
      // check if sgln is emty

      $object = new sqlquery2;

      $P_OID = $object->getemtyStoragePlace();

      // for chaos input to Storage
      $count = count($P_OID);
      $randomnum = rand(0,$count-1);

      //get sgln number of
      $table = 'STELLPLATZ';
      $column = 'P_SGLN_ID';
      $index = 'P_OID';
      $search = $P_OID[$randomnum];

      $P_SGLN_ID = $object->SelectFromDB($table,$column,$index,$search);

      // Daten vorbereiten
      $Quelle = 'extern';
      $Ziel = $P_SGLN_ID;
      $Status = 'in progress';
      $FLURFOERDERMITTEL_P_OID = null;
      $STETIG_FOERDERER_P_OID = null;
      $LOGISTIKZENTRUM_P_OID = null;

      $TRANSPORTAUFTRAG_P_OID = $object->createTransportauftrag($Quelle,$Ziel,$Status,$FLURFOERDERMITTEL_P_OID,$STETIG_FOERDERER_P_OID,$LOGISTIKZENTRUM_P_OID);

      if(is_numeric($TRANSPORTAUFTRAG_P_OID) == false){
        return $TRANSPORTAUFTRAG_P_OID;
        exit;
      }

      // reserve STELLPLATZ
      $table = 'STELLPLATZ';
      $data = array ('P_OID' => $P_OID[$randomnum], 'P_STATUS' => 'RESERVIERT');

      $object2 = new sqlquery;
      $return = $object2->updateTable($table,$data);

      // get Transportauftrag P_OID
      //$table = 'TRANSPORTAUFTRAG';
      //$column = 'P_OID';
      //$index = 'P_ZIEL';
      //$search = $Ziel;

      //$TRANSPORTAUFTRAG_P_OID = $object->SelectFromDB($table,$column,$index,$search);

      // get LADEHILFSMITTEL P_OID
      $table = 'LADEHILFSMITTEL';
      $column = 'P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai;

      $P_OID = $object->SelectFromDB($table,$column,$index,$search);

      // PUT P_OID in LADEHILFSMITTEL
      $table = 'LADEHILFSMITTEL';
      $data = array ('P_OID' => $P_OID, 'TRANSPORTAUFTRAG_P_OID' => $TRANSPORTAUFTRAG_P_OID);

      $object2 = new sqlquery;
      $return = $object2->updateTable($table,$data);

      return $return;

      //echo json_encode($return);
    }

    // loadTo
    public function loadTo($grai,$grai2){

      $object = new sqlquery2;

      // check if grai is in table
      $table = 'LADEHILFSMITTEL';
      $index = 'P_GRAI_ID';
      $search = $grai;

      if ($object->checkifinTable($table,$index,$search) == false){
        echo '{'.json_encode('grai not in Table '.$table).'}';
        exit;
      }

      // check if grai is in table
      $table = 'ANHAENGER';
      $index = 'P_GRAI_ID';
      $search = $grai2;

      if ($object->checkifinTable($table,$index,$search) == false){
        echo '{'.json_encode('grai not in Table '.$table).'}';
        exit;
      }

      //get P_OID from LADEHILFSMITTEL
      $table = 'LADEHILFSMITTEL';
      $column = 'P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai;

      $return1 = $object->SelectFromDB($table,$column,$index,$search);

      //get P_OID from STELLPLATZ
      $table = 'ANHAENGER';
      $column = 'P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai2;

      $return2 = $object->SelectFromDB($table,$column,$index,$search);

      //get TRANSPORTAUFTRAGP_OID  LADEHILFSMITTEL
      $table = 'LADEHILFSMITTEL';
      $column = 'TRANSPORTAUFTRAG_P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai;

      $TRANSPORTAUFTRAG_P_OID = $object->SelectFromDB($table,$column,$index,$search);

      //get Stellplatz_ziel
      $table = 'TRANSPORTAUFTRAG';
      $column = 'P_ZIEL';
      $index = 'P_OID';
      $search = $TRANSPORTAUFTRAG_P_OID;

      $STELLPLATZ_P_OID = $object->SelectFromDB($table,$column,$index,$search);

      //set DATA array for Update
      $table = 'LADEHILFSMITTEL';
      $data = array('P_OID' => $return1,'ANHAENGER_P_OID' => $return2,'TRANSPORTAUFTRAG_P_OID' => null, 'STELLPLATZ_P_OID' => $STELLPLATZ_P_OID);

      // Update P_OID (from LADEHILFSMITTEL) with ANHAENGER_P_OID
      $object2 = new sqlquery;
      $return = $object2->updateTable($table,$data);

      if ($return != 'success'){
        return $return;
        exit;
      }

      // nur updaten wenn transportauftrag vorhanden, wenn nicht auch ok
      if ($TRANSPORTAUFTRAG_P_OID != null){
        // Update P_STATUS (from TRANSPORTAUFTRAG)
        $table = 'TRANSPORTAUFTRAG';
        $data = array('P_OID' => $TRANSPORTAUFTRAG_P_OID,'P_STATUS' => 'FINISHED');

        $return = $object2->updateTable($table,$data);
      }

      return $return;

    }

    // bool outgoingGoods(grai largeLoadCarrierID)
    public function outgoingGoods($grai){

      $object = new sqlquery2;
      $object2 = new sqlquery;

      //get P_OID from LADEHILFSMITTEL
      $table = 'LADEHILFSMITTEL';
      $column = 'P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai;

      $P_OIDs_LADEHILFSMITTEL = array();

      $P_OID_LADEHILFSMITTEL = $object->SelectFromDB($table,$column,$index,$search);

      array_push($P_OIDs_LADEHILFSMITTEL,$P_OID_LADEHILFSMITTEL);

      //get smalles LADEHILFSMITTEL
      $c = 1;
      do {
        $table = 'LADEHILFSMITTEL';
        $column = 'P_OID';
        $index = 'LADEHILFSMITTEL_P_OID';
        $search = $P_OID_LADEHILFSMITTEL;

        $P_OID_LADEHILFSMITTEL = $object->SelectFromDB($table,$column,$index,$search);

        if ($P_OID_LADEHILFSMITTEL != null){
          array_push($P_OIDs_LADEHILFSMITTEL,$P_OID_LADEHILFSMITTEL);
        }
        //print_r($return);
        $c++;

      } while ($P_OID_LADEHILFSMITTEL != null && $c<5);

      $P_OIDs_LADEHILFSMITTEL = array_reverse($P_OIDs_LADEHILFSMITTEL);

      foreach ($P_OIDs_LADEHILFSMITTEL as $P_OID_LADEHILFSMITTEL => $value) {
        //get WARE_P_OID from LADEHILFSMITTEL
        $table = 'WARE';
        $column = 'P_OID';
        $index = 'LADEHILFSMITTEL_P_OID';
        $search = $value;

        $WARE_P_OIDs = $object->SelectFromDBALL($table,$column,$index,$search);
        //echo '$WARE_P_OIDs: ';
        //print_r($WARE_P_OIDs);

        foreach ($WARE_P_OIDs as $WARE_P_OID => $value2) {

          // get P_OID from ARTIKEL
          $table = 'ARTIKEL';
          $column = 'P_OID';
          $index = 'WARE_P_OID';
          $search = $value2;

          $P_OID_ARTIKEL = $object->SelectFromDB($table,$column,$index,$search);

          if ($P_OID_ARTIKEL != null){
            //update ARTIKEL
            $table = 'ARTIKEL';
            $data = array('P_OID' => $P_OID_ARTIKEL, 'WARE_P_OID' => null);
            $return = $object2->updateTable($table,$data);
          }
          //delete Ware Row
          $table = 'WARE';
          $return = $object2->deleteRow($table,$value2);
          //echo 'delete WARE_P_OID '.$value2.'<br>';
          if ($return != 'success'){
            return $return;
            exit;
          }
        }

        //get TRANSPORTAUFTRAGP_OID  LADEHILFSMITTEL
        $table = 'LADEHILFSMITTEL';
        $column = 'TRANSPORTAUFTRAG_P_OID';
        $index = 'P_OID';
        $search = $value;

        $TRANSPORTAUFTRAG_P_OID = $object->SelectFromDB($table,$column,$index,$search);

        // nur updaten wenn transportauftrag vorhanden, wenn nicht auch ok
        if ($TRANSPORTAUFTRAG_P_OID != null){
          // Update P_STATUS (from TRANSPORTAUFTRAG)
          $table = 'TRANSPORTAUFTRAG';
          $data = array('P_OID' => $TRANSPORTAUFTRAG_P_OID,'P_STATUS' => 'FINISHED');

          $return = $object2->updateTable($table,$data);
        }

        //delete LADEHILFSMITTEL row
        $table = 'LADEHILFSMITTEL';
        //echo 'delete LADEHILFSMITTEL_P_OID '.$value.'<br>';
        $return = $object2->deleteRow($table,$value);
      }
      return $return;
    }

    // bool requestStorage(grai largeLoadCarrierID)
    public function requestStorage($grai){

      //create Transprotauftrag and set emty STELLPLATZ = RESERVIERT

      //find free storage Place which is not in Loading_Area
      // check if sgln is emty

      $object = new sqlquery2;

      $P_OID = $object->getemtyStoragePlace();

      // for chaos input to Storage
      $count = count($P_OID);
      $randomnum = rand(0,$count-1);

      //get sgln number of
      $table = 'STELLPLATZ';
      $column = 'P_SGLN_ID';
      $index = 'P_OID';
      $search = $P_OID[$randomnum];

      $P_SGLN_ID = $object->SelectFromDB($table,$column,$index,$search);

      // Daten vorbereiten
      $Quelle = 'STETIG_FOERDERER';
      $Ziel = $P_SGLN_ID;
      $Status = 'in progress';
      $FLURFOERDERMITTEL_P_OID = null;
      $STETIG_FOERDERER_P_OID = null;
      $LOGISTIKZENTRUM_P_OID = null;

      $TRANSPORTAUFTRAG_P_OID = $object->createTransportauftrag($Quelle,$Ziel,$Status,$FLURFOERDERMITTEL_P_OID,$STETIG_FOERDERER_P_OID,$LOGISTIKZENTRUM_P_OID);

      if(is_numeric($TRANSPORTAUFTRAG_P_OID) == false){
        return $TRANSPORTAUFTRAG_P_OID;
        exit;
      }

      // reserve STELLPLATZ
      $table = 'STELLPLATZ';
      $data = array ('P_OID' => $P_OID[$randomnum], 'P_STATUS' => 'RESERVIERT');

      $object2 = new sqlquery;
      $return = $object2->updateTable($table,$data);

      // get Transportauftrag P_OID
      //$table = 'TRANSPORTAUFTRAG';
      //$column = 'P_OID';
      //$index = 'P_ZIEL';
      //$search = $Ziel;

      //$TRANSPORTAUFTRAG_P_OID = $object->SelectFromDB($table,$column,$index,$search);

      // get LADEHILFSMITTEL P_OID
      $table = 'LADEHILFSMITTEL';
      $column = 'P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai;

      $P_OID = $object->SelectFromDB($table,$column,$index,$search);

      // PUT P_OID in LADEHILFSMITTEL
      $table = 'LADEHILFSMITTEL';
      $data = array ('P_OID' => $P_OID, 'TRANSPORTAUFTRAG_P_OID' => $TRANSPORTAUFTRAG_P_OID);

      $object2 = new sqlquery;
      $return = $object2->updateTable($table,$data);

      return $return;

      //echo json_encode($return);
    }

    // bool requestTransport(grai largeLoadCarrierID)
    public function requestTransport($grai){

      //create Transprotauftrag and set emty STELLPLATZ = RESERVIERT

      //find free storage Place which is not in Loading_Area
      // check if sgln is emty

      $object = new sqlquery2;

      $P_OID = $object->getemtyStoragePlace();

      // for chaos input to Storage
      $count = count($P_OID);
      $randomnum = rand(0,$count-1);

      //get sgln number of
      $table = 'STELLPLATZ';
      $column = 'P_SGLN_ID';
      $index = 'P_OID';
      $search = $P_OID[$randomnum];

      $P_SGLN_ID = $object->SelectFromDB($table,$column,$index,$search);

      // Daten vorbereiten
      $Quelle = 'Stellplatz';
      $Ziel = $P_SGLN_ID;
      $Status = 'in progress';
      $FLURFOERDERMITTEL_P_OID = null;
      $STETIG_FOERDERER_P_OID = null;
      $LOGISTIKZENTRUM_P_OID = null;

      $TRANSPORTAUFTRAG_P_OID = $object->createTransportauftrag($Quelle,$Ziel,$Status,$FLURFOERDERMITTEL_P_OID,$STETIG_FOERDERER_P_OID,$LOGISTIKZENTRUM_P_OID);

      if(is_numeric($TRANSPORTAUFTRAG_P_OID) == false){
        return $TRANSPORTAUFTRAG_P_OID;
        exit;
      }

      // reserve STELLPLATZ
      $table = 'STELLPLATZ';
      $data = array ('P_OID' => $P_OID[$randomnum], 'P_STATUS' => 'RESERVIERT');

      $object2 = new sqlquery;
      $return = $object2->updateTable($table,$data);

      // get Transportauftrag P_OID
      //$table = 'TRANSPORTAUFTRAG';
      //$column = 'P_OID';
      //$index = 'P_ZIEL';
      //$search = $Ziel;

      //$TRANSPORTAUFTRAG_P_OID = $object->SelectFromDB($table,$column,$index,$search);

      // get LADEHILFSMITTEL P_OID
      $table = 'LADEHILFSMITTEL';
      $column = 'P_OID';
      $index = 'P_GRAI_ID';
      $search = $grai;

      $P_OID = $object->SelectFromDB($table,$column,$index,$search);

      // PUT P_OID in LADEHILFSMITTEL
      $table = 'LADEHILFSMITTEL';
      $data = array ('P_OID' => $P_OID, 'TRANSPORTAUFTRAG_P_OID' => $TRANSPORTAUFTRAG_P_OID);

      $object2 = new sqlquery;
      $return = $object2->updateTable($table,$data);

      return $return;

      //echo json_encode($return);
    }

    // void requestTuggerTrainLoading(giai trainID)
    public function requestTuggerTrainLoading($giai){

      $object = new sqlquery2;

      //get FLURFOERDERMITTEL P_OID
      $table = 'FLURFOERDERMITTEL';
      $column = 'P_OID';
      $index = 'P_GIAI_ID';
      $search = $giai;

      $FLURFOERDERMITTEL_P_OID = $object->SelectFromDB($table,$column,$index,$search);

      //get ANHAENGER P_OID
      $table = 'ANHAENGER';
      $column = 'P_OID';
      $index = 'FLURFOERDERMITTEL_P_OID';
      $search = $FLURFOERDERMITTEL_P_OID;

      $ANHAENGER_P_OID = $object->SelectFromDBALL($table,$column,$index,$search);

      $count = count($ANHAENGER_P_OID);

      $Ladehilfsmittel = $object->getallLadehilfmittelinStellplatzandnotTransportauftrag();


      if($Ladehilfsmittel == null){
        return 'no LADEHILFSMITTEL usable';
        exit;
      }

      shuffle($Ladehilfsmittel);

      $c = 0;
      foreach ($Ladehilfsmittel as $Ladehilfsmittelchen => $value) {
        //get ANHAENGER grai
        $table = 'ANHAENGER';
        $column = 'P_GRAI_ID';
        $index = 'P_OID';
        $search = $ANHAENGER_P_OID[$c];

        $P_ZIEL = $object->SelectFromDB($table,$column,$index,$search);

        // get STELLPLATZ from LADEHILFSMITTEL
        $table = 'LADEHILFSMITTEL';
        $column = 'STELLPLATZ_P_OID';
        $index = 'P_OID';
        $search = $value;

        $STELLPLATZ_P_OID = $object->SelectFromDB($table,$column,$index,$search);

        // get P_SGLN_ID from STELLPLATZ
        $table = 'STELLPLATZ';
        $column = 'P_SGLN_ID';
        $index = 'P_OID';
        $search = $STELLPLATZ_P_OID;

        $P_QUELLE = $object->SelectFromDB($table,$column,$index,$search);

        // Daten vorbereiten
        $Status = 'in progress';
        $FLURFOERDERMITTEL_P_OID = null;
        $STETIG_FOERDERER_P_OID = null;
        $LOGISTIKZENTRUM_P_OID = null;

        $TRANSPORTAUFTRAG_P_OID = $object->createTransportauftrag($P_QUELLE,$P_ZIEL,$Status,$FLURFOERDERMITTEL_P_OID,$STETIG_FOERDERER_P_OID,$LOGISTIKZENTRUM_P_OID);

        if(is_numeric($TRANSPORTAUFTRAG_P_OID) == false){
          return $TRANSPORTAUFTRAG_P_OID;
          exit;
        }
        // get Transportauftrag P_OID
        //$table = 'TRANSPORTAUFTRAG';
        //$column = 'P_OID';
        //$index = 'P_ZIEL';
        //$search = $P_ZIEL;

        //$TRANSPORTAUFTRAG_P_OID = $object->SelectFromDB($table,$column,$index,$search);

        // PUT P_OID in LADEHILFSMITTEL
        $table = 'LADEHILFSMITTEL';
        $data = array ('P_OID' => $value, 'TRANSPORTAUFTRAG_P_OID' => $TRANSPORTAUFTRAG_P_OID);

        $object2 = new sqlquery;
        $return = $object2->updateTable($table,$data);

        $c++;

        if($c>=$count){
          return $return;
          exit;
        }

      }
    }

    // bool Storageblocked(sgln)
    public function Storageblocked($sgln){

      $object = new sqlquery2;

      // check if sgln is emty
      $table = 'STELLPLATZ';
      $column = 'P_STATUS';
      $index = 'P_SGLN_ID';
      $search = $sgln;

      $return = $object->SelectFromDB($table,$column,$index,$search);

      if ($return == 'BESETZT'){
        $return = "true";
        return $return;
        exit;
      } else {
        $return = "false";
        return $return;
        exit;
      }
    }

    // type TagIDType(id)
    public function TagIDType($id){

      $object = new sqlquery2;

      // check if id in artikel
      $table = 'ARTIKEL';
      $index = 'P_SGTIN_ID';
      $search = $id;

      if($object->checkifinTable($table,$index,$search) == true){
        $return = "artikel";
        return $return;
        exit;
      }

      // check if id in FLURFOERDERMITTEL
      $table = 'FLURFOERDERMITTEL';
      $index = 'P_GIAI_ID';
      $search = $id;

      if($object->checkifinTable($table,$index,$search) == true){
        $return = "fluerfoerdermittel";
        return $return;
        exit;
      }

      // check if id in stellpaltz
      $table = 'STELLPLATZ';
      $index = 'P_SGLN_ID';
      $search = $id;

      if($object->checkifinTable($table,$index,$search) == true){
        $return = "stellplatz";
        return $return;
        exit;
      }

      //check if id in ANHAENGER
      $table = 'ANHAENGER';
      $index = 'P_GRAI_ID';
      $search = $id;

      if($object->checkifinTable($table,$index,$search) == true){
        $return = "anhaenger";
        return $return;
        exit;
      }

      //check if id in ANHAENGER
      $table = 'LADEHILFSMITTEL';
      $index = 'P_GRAI_ID';
      $search = $id;

      if($object->checkifinTable($table,$index,$search) == false){
        $return = "error not in db";
        return $return;
        exit;

      } else {

        $table = 'LADEHILFSMITTEL';
        $column = 'LADEHILFSMITTELTYP_P_OID';
        $index = 'P_GRAI_ID';
        $search = $id;

        $LADEHILFSMITTELTYP_P_OID = $object->SelectFromDB($table,$column,$index,$search);

        if ($LADEHILFSMITTELTYP_P_OID == null){
          $return = "Ladehilfsmittel not linked to Type";
          return $return;
          exit;
        }

        $table = 'LADEHILFSMITTELTYP';
        $column = 'P_BEZEICHNUNG';
        $index = 'P_OID';
        $search = $LADEHILFSMITTELTYP_P_OID;

        $return = $object->SelectFromDB($table,$column,$index,$search);
        return $return;

      }

    }

    // boolen reportTuggerTrainDelivery(giai trainID)
    public function reportTuggerTrainDelivery($giai){

      //get FLURFOERDERMITTEL P_OID
      $table = 'FLURFOERDERMITTEL';
      $column = 'P_OID';
      $index = 'P_GIAI_ID';
      $search = $giai;

      $object = new sqlquery2;
      $object2 = new sqlquery;

      $P_OID = $object->SelectFromDB($table,$column,$index,$search);

      if ($P_OID == null){
        return 'giai not in Table FLURFOERDERMITTEL';
        exit;
      }

      //get  P_OID
      $table = 'TRANSPORTAUFTRAG';
      $column = 'P_OID';
      $index = 'FLURFOERDERMITTEL_P_OID';
      $search = $P_OID;


      $P_OIDs = $object->SelectFromDBALL($table,$column,$index,$search);

      if ($P_OIDs == null){
        return 'No TRANSPORTAUFTRAG in Table';
        exit;
      }

      //print_r($P_OIDs);

      foreach ($P_OIDs as $P_OID => $value) {

        $table = 'TRANSPORTAUFTRAG';
        $data = array('P_OID' => $value,'P_STATUS' => 'FINISHED');

        $return = $object2->updateTable($table,$data);

      }
      return "success";
    }



}






 ?>
