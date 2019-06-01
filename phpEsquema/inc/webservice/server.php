<?php
require_once 'core/global.php';
require_once 'core/lib/nusoap.php';
require_once 'views/productos.view.php';

$server = new nusoap_server();

$namespace = $_MAIN . 'inc/webservice/server.php';
$urn = 'urn:shop';

$server->configureWSDL('shopService', $urn);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'ArrayOfString',
    'complexType',
    'array',
    'sequence',
    '',
    array(
      'itemName' => array(
        'name' => 'itemName', 
        'type' => 'xsd:string',
        'minOccurs' => '0', 
        'maxOccurs' => 'unbounded'
      )
    )
  );

$server->register('consultarProducto_ind',
    ['item' => 'xsd:string'],
    // ['data' => 'tns:ArrayOfString'],
    ['data' => 'xsd:string'],
    $urn,
    $urn . '#consultarProducto_ind'
);

$server->service(file_get_contents("php://input"));
