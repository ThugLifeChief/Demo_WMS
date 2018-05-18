<?php

/*
This file is for routing the "function" queries.
*/

include_once __DIR__.'/../sqlqueries/sqlquery.php';
include_once __DIR__.'/../sqlqueries/sqlquery2.php';
include_once __DIR__.'/../sqlqueries/functionclass.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//$app = new \Slim\App;

// getLargeLoadCarrierID from sgtin
$app->get('/restapi/functions/getLargeLoadCarrierID/sgtin/{sgtin}', function(Request $request, Response $response){
    $sgtin = $request->getAttribute('sgtin');

    $object = new functionclass;
    $return = $object->getLargeLoadCarrierID_sgtin($sgtin);

    echo '{"grai" : '.json_encode($return).'}';
});

// getLargeLoadCarrierID from grai
$app->get('/restapi/functions/getLargeLoadCarrierID/grai/{grai}', function(Request $request, Response $response){
    $grai = $request->getAttribute('grai');

    $object = new functionclass;
    $return = $object->getLargeLoadCarrierID_grai($grai);

    echo '{"grai" : '.json_encode($return).'}';
});

// storeTo
$app->get('/restapi/functions/storeTo/grai/{grai}/sgln/{sgln}', function(Request $request, Response $response){
    $grai = $request->getAttribute('grai');
    $sgln = $request->getAttribute('sgln');

    $object = new functionclass;
    $return = $object->storeTo($grai,$sgln);

    echo '{"bool" : '.json_encode($return).'}';
});

// removeFrom
$app->get('/restapi/functions/removeFrom/grai/{grai}/sgln/{sgln}', function(Request $request, Response $response){
    $grai = $request->getAttribute('grai');
    $sgln = $request->getAttribute('sgln');

    $object = new functionclass;
    $return = $object->removeFrom($grai,$sgln);

    echo '{"bool" : '.json_encode($return).'}';
});

// bool receivedGoods(grai largeLoadCarrierID)
$app->get('/restapi/functions/receivedGoods/grai/{grai}', function(Request $request, Response $response){
    $grai = $request->getAttribute('grai');

    $object = new functionclass;
    $return = $object->receivedGoods($grai);

    echo '{"bool" : '.json_encode($return).'}';

});

// bool outgoingGoods(grai largeLoadCarrierID)
$app->get('/restapi/functions/outgoingGoods/grai/{grai}', function(Request $request, Response $response){
    $grai = $request->getAttribute('grai');

    $object = new functionclass;
    $return = $object->outgoingGoods($grai);

    echo '{"bool" : '.json_encode($return).'}';

});

// bool requestStorage(grai largeLoadCarrierID)
$app->get('/restapi/functions/requestStorage/grai/{grai}', function(Request $request, Response $response){
    $grai = $request->getAttribute('grai');

    $object = new functionclass;
    $return = $object->requestStorage($grai);

    echo '{"bool" : '.json_encode($return).'}';

});

// bool requestTransport(grai largeLoadCarrierID)
$app->get('/restapi/functions/requestTransport/grai/{grai}', function(Request $request, Response $response){
    $grai = $request->getAttribute('grai');

    $object = new functionclass;
    $return = $object->requestTransport($grai);

    echo '{"bool" : '.json_encode($return).'}';

});

//grai getTrailerAtLoadingLocation(sgln locationID)
$app->get('/restapi/functions/getTrailerAtLoadingLocation/sgln/{sgln}', function(Request $request, Response $response){
    $sgln = $request->getAttribute('sgln');

    $object = new functionclass;
    $return = $object->getTrailerAtLoadingLocation($sgln);

    echo '{"grai" : '.json_encode($return).'}';
});

// get TrailerID from sgtin
$app->get('/restapi/functions/getTrailerID/sgtin/{sgtin}', function(Request $request, Response $response){
    $sgtin = $request->getAttribute('sgtin');

    $object = new functionclass;
    $return = $object->getTrailerID_sgtin($sgtin);

    echo '{"grai" : '.json_encode($return).'}';

});

// get TrailerID from grai
$app->get('/restapi/functions/getTrailerID/grai/{grai}', function(Request $request, Response $response){
    $grai = $request->getAttribute('grai');

    $object = new functionclass;
    $return = $object->getTrailerID_grai($grai);

    echo '{"grai" : '.json_encode($return).'}';

});

// get TrainID from grai
$app->get('/restapi/functions/getTuggerTrain/grai/{grai}', function(Request $request, Response $response){
    $grai = $request->getAttribute('grai');

    $object = new functionclass;
    $return = $object->getTuggerTrain_grai($grai);

    echo '{"giai" : '.json_encode($return).'}';

});

// bool loadTo(grai largeLoadCarrierID, grai trailerID)
$app->get('/restapi/functions/loadTo/grai/{grai1}/grai/{grai2}', function(Request $request, Response $response){
    $grai1 = $request->getAttribute('grai1');
    $grai2 = $request->getAttribute('grai2');

    $object = new functionclass;
    $return = $object->loadTo($grai1,$grai2);

    echo '{"bool" : '.json_encode($return).'}';

});

// void reportTuggerTrainDeparture(giai trainID)
$app->get('/restapi/functions/reportTuggerTrainDeparture/giai/{giai}', function(Request $request, Response $response){
    $giai = $request->getAttribute('giai');

    $object = new functionclass;
    $return = $object->reportTuggerTrainDeparture($giai);

    echo '{"return" : '.json_encode($return).'}';

});

// void requestTuggerTrainLoading(giai trainID)
$app->get('/restapi/functions/requestTuggerTrainLoading/giai/{giai}', function(Request $request, Response $response){
    $giai = $request->getAttribute('giai');

    $object = new functionclass;
    $return = $object->requestTuggerTrainLoading($giai);

    echo '{"return" : '.json_encode($return).'}';

});

// bool Storageblocked(sgln)
$app->get('/restapi/functions/Storageblocked/sgln/{sgln}', function(Request $request, Response $response){
    $sgln = $request->getAttribute('sgln');

    $object = new functionclass;
    $return = $object->Storageblocked($sgln);

    echo '{"bool" : '.json_encode($return).'}';

});

// type TagIDType(id);
$app->get('/restapi/functions/TagIDType/id/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $object = new functionclass;
    $return = $object->TagIDType($id);

    echo '{"type" : '.json_encode($return).'}';

});

// boolen reportTuggerTrainDelivery(giai trainID)
$app->get('/restapi/functions/reportTuggerTrainDelivery/giai/{giai}', function(Request $request, Response $response){
    $giai = $request->getAttribute('giai');

    $object = new functionclass;
    $return = $object->reportTuggerTrainDelivery($giai);

    echo '{"bool" : '.json_encode($return).'}';

});
