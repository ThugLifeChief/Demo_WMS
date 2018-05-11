<?php

include_once __DIR__.'/sqlquery.php';

class sqlquery2 {

  public function SelectFromDB($table,$column,$index,$search) {

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = 'SELECT '.$column.' FROM '.$table.' WHERE '.$index.' = '.$search.';';


      //Connect
      $db = $db->connect();

      $stmt = $db->query($sql);

      $return = $stmt->fetch(PDO::FETCH_ASSOC);

      //print_r($return);
      $db = null;

      $return = $return[$column];


      return $return ;

    } catch (PDOException $e) {
        //echo '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
        return $e->getMessage();
    }
  }

  public function SelectFromDBALL($table,$column,$index,$search) {

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = 'SELECT '.$column.' FROM '.$table.' WHERE '.$index.' = '.$search.';';


      //Connect
      $db = $db->connect();

      $stmt = $db->query($sql);

      $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

      //print_r($result);
      $db = null;

      $return = array();

      foreach ($result as $row) {
        foreach($row as $column => $value){
          array_push($return,$value);
        }
      }
      //print_r($return);

      return $return ;

    } catch (PDOException $e) {
        //echo '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
        return $e->getMessage();
    }
  }

  public function checkifinTable($table,$index,$search) {

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = 'SELECT P_OID FROM '.$table.' WHERE '.$index.' = '.$search.';';

      //Connect
      $db = $db->connect();

      $stmt = $db->query($sql);


      $return = $stmt->fetch(PDO::FETCH_ASSOC);


      $db = null;

      if ($return != null ){
        $return = true;
      } else {
        $return = false;
      }

      return $return;

    } catch (PDOException $e) {
        //echo '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
        return $e->getMessage();
    }
  }

  public function getemtyStoragePlace(){
    //return emty STELLPLATZ P_OID where Loading_Area == NULL OR '';

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = "SELECT P_OID FROM STELLPLATZ WHERE (P_STATUS = 'FREI' OR P_STATUS is null) AND Loading_AREA_P_OID is null;";


      //Connect
      $db = $db->connect();

      $stmt = $db->query($sql);

      $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

      //print_r($result);
      $db = null;

      $return = array();

      foreach ($result as $row) {
        foreach($row as $column => $value){
          array_push($return,$value);
        }
      }
      //print_r($return);

      return $return ;

    } catch (PDOException $e) {
        //echo '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
        return $e->getMessage();
    }

  }

  public function createTransportauftrag($Quelle,$Ziel,$Status,$FLURFOERDERMITTEL_P_OID,$STETIG_FOERDERER_P_OID,$LOGISTIKZENTRUM_P_OID){

    $table = 'TRANSPORTAUFTRAG';
    $randomnum = rand(0,100000);
    $data = array('P_OID' => null,
                  'P_ZEITSTEMPEL' => null,
                  'P_ANLAGE_DATUM' => null,
                  'P_LETZTE_AENDERUNG' => null,
                  'P_TRANSPORTNUMMER' => $randomnum,
                  'P_QUELLE' => $Quelle,
                  'P_ZIEL' => $Ziel,
                  'P_STATUS' => $Status,
                  'FLURFOERDERMITTEL_P_OID' => $FLURFOERDERMITTEL_P_OID,
                  'STETIG_FOERDERER_P_OID' => $STETIG_FOERDERER_P_OID,
                  'LOGISTIKZENTRUM_P_OID' => $LOGISTIKZENTRUM_P_OID);

    $object = new sqlquery;
    $return = $object->insertintoTable($table,$data);

    if($return == 'success'){
      $return = $this->SelectFromDB($table,'P_OID','P_TRANSPORTNUMMER',$randomnum);
    }

    return $return;


  }

  public function getallLadehilfmittelinStellplatzandnotTransportauftrag(){

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = "SELECT P_OID FROM LADEHILFSMITTEL WHERE STELLPLATZ_P_OID is not null AND TRANSPORTAUFTRAG_P_OID is null;";

      //Connect
      $db = $db->connect();

      $stmt = $db->query($sql);

      $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

      //print_r($result);
      $db = null;

      $return = array();

      foreach ($result as $row) {
        foreach($row as $column => $value){
          array_push($return,$value);
        }
      }
      //print_r($return);

      return $return ;

    } catch (PDOException $e) {
        //echo '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
        return $e->getMessage();
    }

  }




}



 ?>
