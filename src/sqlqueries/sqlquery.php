<?php

include_once __DIR__.'/sqlfiles/db_setup_tables.php';
include_once __DIR__.'/sqlfiles/DemoData.php';
include_once __DIR__.'/../config/db.php';


class sqlquery {

  //Search for all Table names
  public function allTables() {

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = "SELECT table_name FROM information_schema.tables where table_schema='".$db->dbname."';";

      //Connect
      $db = $db->connect();

      //get Data
      $stmt = $db->query($sql);
      $return = NULL;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $return[] = $row['table_name'];
      }

      return $return;
      $db = null;

    } catch (PDOException $e) {
        //return '{"error": {"text":'.$e->getMessage().'}';
        return '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
    }

  }

  //Search for all Column names of Table $table
  public function allColumn($table) {

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema='".$db->dbname."' AND table_name='".$table."';";

      //Connect
      $db = $db->connect();

      //get Data
      $stmt = $db->query($sql);
      $return = NULL;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $return[] = $row['COLUMN_NAME'];
      }

      return $return;
      $db = null;

    } catch (PDOException $e) {
        //return '{"error": {"text":'.$e->getMessage().'}';
        return '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
    }

  }

  //Search for the content of the whole table
  public function allRowsofTable($table) {

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = "SELECT * FROM ".$table.";";

      //Connect
      $db = $db->connect();

      //get Data
      $stmt = $db->query($sql);
      $content = null;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $content[] = $row;
      }

      return $content;
      $db = null;

    } catch (PDOException $e) {
        //return '{"error": {"text":'.$e->getMessage().'}';
        return '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
    }

  }

  //Search for the content of the whole table (for REST API)
  public function allRowsofTableREST($table) {

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = "SELECT * FROM ".$table.";";

      //Connect
      $db = $db->connect();

      //get Data
      $stmt = $db->query($sql);
      $content = null;
      $content =$stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      return $content;


    } catch (PDOException $e) {
        //echo '{"error": {"text":'.$e->getMessage().'}';
        $string = $e->getMessage();
        $errorarry = array("error" => array("text" => $string));
        //print_r($errorarry);
        return $errorarry;
        //return '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
    }

  }

  // Insert data into Table
  public function insertintoTable($table,$data) {


    $table = strtolower($table);
    // test of table exist in db
    $alltables = $this->allTables();
    //print_r($alltables);
    if (!in_array($table,$alltables)) {
      return 'Table not in db';
    } else {

      try{

        //get DB object
        $db = new db();

        //set SQL Query

        //designe sql query like:
        // $sql = "INSERT INTO costumers (first_name,last_name,phone,email,address,city,state) VALUES
        //(:first_name,:last_name,:phone,:email,:address,:city,:state)";

        //count variable needed to leave last "," in sql query
        $count = 1;

        $sql = "INSERT INTO ".$table. "(";

        foreach ($data as $column => $value) {
          $sql .= $column;
          if($count != count($data)){
            $sql .=',';
          }
          $count++;
        }

        $sql .=") VALUES (";

        $count = 1;
        foreach ($data as $column => $value) {
          if($column == 'P_OID'){
            $sql .= 'NULL';
          } elseif ($column =='P_ZEITSTEMPEL' || $column == 'P_ANLAGE_DATUM' || $column == 'P_LETZTE_AENDERUNG' ){
            $sql .= 'CURRENT_DATE()';
          } else {
            $sql .=':';
            $sql .= $column;
          }
          if($count != count($data)){
            $sql .=',';
          }
          $count++;
        }

        $sql .= ");";

        //Connect to db
        $db = $db->connect();

        //Prepare sql query
        $stmt = $db->prepare($sql);

        // bind Params
        foreach ($data as $column => &$value) {
          if($column != 'P_OID' && $column !='P_ZEITSTEMPEL' && $column != 'P_ANLAGE_DATUM' && $column != 'P_LETZTE_AENDERUNG' ){
            $param = ':'.$column;
            //echo $param.' '.$value."<br>";
            $stmt->bindParam($param,$value);
          }
        }

        //print_r($stmt);
        //excecute
        $stmt->execute();

        return 'success';

      } catch (PDOException $e) {
          //return '{"error": {"text":'.$e->getMessage().'}';
          return '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
      }
    }
  }

  // Update data in Table
  public function updateTable($table,$data) {

    //$table to lowercase
    $table = strtolower($table);

    // test of table exist in db
    $alltables = $this->allTables();
    //print_r($alltables);
    if (!in_array($table,$alltables)) {
      return 'Table not in db';
    } else {

      try{

        //get DB object
        $db = new db();

        //set SQL Query

        //designe sql query like:
        // $sql = "INSERT INTO costumers (first_name,last_name,phone,email,address,city,state) VALUES
        //(:first_name,:last_name,:phone,:email,:address,:city,:state)";

        //count variable needed to leave last "," in sql query
        $count = 1;

        $sql = "UPDATE ".$table. " SET ";


        foreach ($data as $column => $value) {
          if($column == 'P_OID' || $column == 'P_ANLAGE_DATUM'){
            // do not update
          } elseif ($column =='P_ZEITSTEMPEL' || $column == 'P_LETZTE_AENDERUNG' ){
            $sql .= $column;
            $sql .='=';
            $sql .= 'CURRENT_DATE()';
            if($count != count($data)){
              $sql .=', ';
            }
          } else {
            $sql .= $column;
            $sql .='=';
            $sql .= ':'.$column;
            if($count != count($data)){
              $sql .=', ';
            }
          }
          $count++;
        }

        $sql .= " WHERE P_OID = ".$data['P_OID'];

        //Connect to db
        $db = $db->connect();

        //Prepare sql query
        $stmt = $db->prepare($sql);

        // bind Params
        foreach ($data as $column => &$value) {
          if($column != 'P_OID' && $column !='P_ZEITSTEMPEL' && $column != 'P_ANLAGE_DATUM' && $column != 'P_LETZTE_AENDERUNG' ){
            $param = ':'.$column;
            //echo $param.' '.$value."<br>";
            $stmt->bindParam($param,$value);
          }
        }

        //print_r($stmt);
        //excecute
        $stmt->execute();

        return 'success';

      } catch (PDOException $e) {
          //return '{"error": {"text":'.$e->getMessage().'}';
          return '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
      }
    }
  }

  // Delet a Row from Table
  public function deleteRow($table,$id){

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = "DELETE FROM ".$table." WHERE ".$table.".P_OID = ".$id ;

      //Connect
      $db = $db->connect();

      //delete Data
      $stmt = $db->prepare($sql);

      //execute
      $stmt->execute();
      $db = null;

      return 'success';

    } catch (PDOException $e) {
        //return '{"error": {"text":'.$e->getMessage().'}';
        return '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
    }
  }

  // Create DB
  public function createDB(){

    try{

      $db_setup = new db_setup();

      //get DB object
      $db = new db();

      //create db
      $return = $db->create($db_setup->db_setup_string);

      return $return;

    } catch (PDOException $e) {
        //return '{"error": {"text":'.$e->getMessage().'}';
        return '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
    }
  }

  // resetDB
  public function resetDB(){

    try{

      //get DB object
      $db = new db();

      //set SQL Query
      $sql = "DROP DATABASE ".$db->dbname;
      //echo $sql;

      //Connect
      $db = $db->connect();

      //delete Data
      $stmt = $db->prepare($sql);

      //execute
      $stmt->execute();
      $db = null;

    } catch (PDOException $e) {
        //return '{"error": {"text":'.$e->getMessage().'}';
        return '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
    }

    $return = $this->createDB();

    return $return;

  }

  public function insertdemodata(){



    $demodata = new DemoData();

    for ($i=0; $i < 13; $i++) {
      try{

        //get DB object
        $db = new db();
        //set SQL Query
        $sql = $demodata->data[$i];
        //echo $sql;

        //Connect
        $db = $db->connect();

        //delete Data
        $stmt = $db->prepare($sql);

        //execute
        $stmt->execute();
        $db = null;


      } catch (PDOException $e) {
          echo '{"error": {"text":'.$e->getMessage().'}';
          return '<p>Error SQL Query in sqlquery.php: '.$e->getMessage().'</p>';
          exit;
      }
    }
    return 'success';

  }

}
 ?>
