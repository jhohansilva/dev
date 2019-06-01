<?php
// Access control
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

// Libs
require_once './webservice/core/global.php';
require_once './webservice/core/lib/nusoap.php';

if (verificarTrans($_SERVER)) {
    // Config client
    $_WSDL = $_MAIN . "inc/webservice/server.php?wsdl";
    $client = new nusoap_client($_WSDL, true);
    $err = $client->getError();
    $method = $_SERVER['HTTP_METHOD'];

    if ($err) {
        print_r($err);
        exit();
    } else {
        try {
            switch ($method) {
                case 'request001':
                    $out = $client->call('consultarProducto_ind', $_POST);
                    break;
            }

            print_r($out); // Respuesta de salida

        } catch (Exception $e) {
            print_r('Error');
        }
    }
} else {
    echo 'Acceso denegado';
    // header('Location: http://google.com');
}

function verificarTrans($server){
    if (@isset($_SERVER['HTTP_METHOD'])
        && @isset($_SERVER['HTTP_ORIGIN'])
        && $server['HTTP_ORIGIN'] == "http://localhost") {
        return true;
    } else {
        return false;
    }
}
