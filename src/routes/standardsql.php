<?php

/*
This file is for routing the sql queries.
*/

include_once __DIR__.'/../sqlqueries/sqlquery.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//$app = new \Slim\App;

//get all table names
$app->get('/restapi/allTables', function(Request $request, Response $response){

    $object = new sqlquery;
    $return = $object->allTables();

    echo json_encode($return);

});

// get all Columnnames from table
$app->get('/restapi/allColumn/{table}', function(Request $request, Response $response){
    $table = $request->getAttribute('table');

    $object = new sqlquery;
    $return = $object->allColumn($table);
    echo json_encode($return);

});

// get all data from table
$app->get('/restapi/table/{table}', function(Request $request, Response $response){
    $table = $request->getAttribute('table');
    //echo $table;
    $object = new sqlquery;
    $return = $object->allRowsofTableREST($table);

    echo json_encode($return);

});

// insert new data into table
$app->post('/restapi/insert/{table}', function(Request $request, Response $response){
    $table = $request->getAttribute('table');
    //echo $table;

    $object = new sqlquery;

    $columnnames = $object->allColumn($table); //get all column names of $table
    $data = array();  // init $data array

    foreach ($columnnames as $columnname) {
      if($columnname == 'P_OID' || $columnname =='P_ZEITSTEMPEL' || $columnname == 'P_ANLAGE_DATUM' || $columnname == 'P_LETZTE_AENDERUNG' ){
        // add columnnames and values to $data array
        $newdata = array($columnname => null);
        $data = array_merge($data,$newdata);
      } else {
        $newdata = array($columnname => $request->getParam($columnname));
        $data = array_merge($data,$newdata);
      }
    }

    //print_r($data);

    $return = $object->insertintoTable($table,$data);

    echo json_encode($return);

});

// update data in table
$app->put('/restapi/update/{table}', function(Request $request, Response $response){
    $table = $request->getAttribute('table');
    //echo $table;

    $object = new sqlquery;
    $columnnames = $object->allColumn($table); //get all column names of $table
    $data = array();  // init $data array

    foreach ($columnnames as $columnname) {
      if($columnname =='P_ZEITSTEMPEL' || $columnname == 'P_ANLAGE_DATUM' || $columnname == 'P_LETZTE_AENDERUNG' ){
        // add columnnames and values to $data array
        $newdata = array($columnname => null);
        $data = array_merge($data,$newdata);
      } elseif($request->getParam($columnname) != null) {
        $newdata = array($columnname => $request->getParam($columnname));
        $data = array_merge($data,$newdata);
      }
    }
    //print_r($data);
    $return = $object->updateTable($table,$data); //insert $data into $table
    echo json_encode($return);

});

// delete a Row from table
$app->delete('/restapi/delete/{table}/{P_OID}', function(Request $request, Response $response){
    $table = $request->getAttribute('table');
    $id = $request->getAttribute('P_OID');
    //echo $table;

    $object = new sqlquery;
    $return = $object->deleteRow($table,$id); //delete row with $id from $table

    echo json_encode($return);

});
