<?php
    require('api.php');
    $ruta = new ruta();
    $request = $_SERVER['REQUEST_METHOD'];
    $error = false;
    
    if($request != "GET") {
        $data = array(
            'Remedy' => 'Set request method to post'
        );
        $status = 401;
        $status_message = 'NAH 401';
        $ruta->response($status, $status_message, json_encode($data));
    }

    if(!isset($_GET['data'])) {
        $data = array(
            "Remedy" => 'Pass a valid data'
        );
        $status = 501;
        $status_message = 'NAH 501';
        $ruta->response($status, $status_message, json_encode($data));
    }

    $object = $_GET['data'] ?? "Not defined";
    $arrayOne = json_decode($_GET['data']); // Decode Json Data to give us an  stdClass Object Array

    /* Get Length of Array */
    $arrayOneCount = count((array)$arrayOne);
    if($arrayOneCount != 12) {
        $data = array(
            "Remedy" => 'You have not provided right Value'
        );
        $status = 501;
        $status_message = 'NAH 501';
        $ruta->response($status, $status_message, json_encode($data));
    }

    $arrayTwoCount = count((array)$arrayOne->{'verify'});
    if($arrayTwoCount != 2) {
        $data = array(
            "Remedy" => 'Verification token is not complete'
        );
        $status = 501;
        $status_message = 'NAH 501';
        $ruta->response($status, $status_message, json_encode($data));
    }

    $token = $arrayOne->{'verify'}->{'token'};
    $action = $arrayOne->{'verify'}->{'action'};
    
    if($token != $ruta->token) {
        $data = array(
            'Remedy' => 'Verification token is wrong'
        );
        $status = 401;
        $status_message = 'Unauthorized Access';
        $ruta->response($status, $status_message, json_encode($data));
    }

    if($action != "register") {
        $data = array(
            'Remedy' => 'You are probally making a wrong request'
        );
        $status = 401;
        $status_message = 'NAH 401';
        $ruta->response($status, $status_message, json_encode($data));
    }
    
    // Removing Verify Key
    unset($arrayOne->{'verify'});

    if($ruta->register($arrayOne) != true) {
        $data = array(
            'Remedy' => 'Verification token is wrong'
        );
        $status = 401;
        $status_message = 'Unauthorized Access';
        $ruta->response($status, $status_message, json_encode($data));
    }  else {     
        $data = array(
            'Remedy' => 'You have registered successfully'
        );
        $status = 401;
        $status_message = 'Unauthorized Access';
        $ruta->response($status, $status_message, json_encode($data));
    }
?>