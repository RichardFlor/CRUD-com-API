<?php
    require_once("vendor/autoload.php");

    $app = new \Slim\App();

    $app ->get ('/estados', function($request, $response, $args){
        return $response ->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write('{"message":"Listar Estados"}');
    });
$app->run();

   
?>