<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

//LISTA TODOS LOS USUARIOS
$app->get('/listado/usuarios', function (Request $request, Response $response) {
    include "clases/usuarios.php";
    $usuarios=usuario::TraerTodosLosUsuarios();
    //return $usuarios;
    $response->write(json_encode($usuarios));
});

//INSERTA EL USUARIO
$app->post('/usuarios', function (Request $request, Response $response) {
    include "clases/usuarios.php";
    

    $objDatos = $request->getParsedBody();
    $nombre = $objDatos['nombre'];
    $clave = $objDatos['clave'];
    $mail = $objDatos['mail'];


    Usuario::insertarUsuario($nombre,$clave,$mail);
    //return $usuarios;
    $response->write(json_encode("se inserto con exito el usuario: " .$nombre));
});


//ELIMINAR El USUARIO
$app->delete('/deleteUsuarios', function (Request $request, Response $response) {
    include "clases/usuarios.php";
    
    $objDatos = $request->getParsedBody();
    $id = $objDatos['id'];

    Usuario::BorrarUsuario($id);
    //return $usuarios;
    $response->write(json_encode("se elimino con exito el usuario: " .$id));
});


//MODIFICA El USUARIO
$app->put('/updateUsuarios', function (Request $request, Response $response) {
    include "clases/usuarios.php";
    
     $objDatos = $request->getParsedBody();
     $id = $objDatos['id'];
    $nombre = $objDatos['nombre'];
    $clave = $objDatos['clave'];
    $mail = $objDatos['mail'];


    Usuario::actualizarUsuario($id,$nombre,$clave,$mail);
    //return $usuarios;
    $response->write(json_encode("se modifico con exito el usuario: " .$nombre));
    //$response->write(json_encode($objDatos));
});

$app->run();
