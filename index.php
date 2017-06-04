<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
include "clases/AccesoDatos.php";
use \Firebase\JWT\JWT;

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

//LISTA TODOS LOS USUARIOS
$app->get('/usuarios', function (Request $request, Response $response) {
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
    $rol = $objDatos['rol'];
    $sucursal = $objDatos['sucursal'];


    Usuario::Insertar($nombre,$clave,$mail,$rol,$sucursal);
    //return $usuarios;
    $response->write(json_encode("se inserto con exito el usuario: " .$nombre));
});


//ELIMINAR El USUARIO
$app->delete('/usuarios', function (Request $request, Response $response) {
    include "clases/usuarios.php";
    
    $objDatos = $request->getParsedBody();
    $id = $objDatos['id'];

    Usuario::Borrar($id);
    //return $usuarios;
    $response->write(json_encode("se elimino con exito el usuario: " .$id));
});


//MODIFICA El USUARIO
$app->put('/usuarios', function (Request $request, Response $response) {
    include "clases/usuarios.php";
    
     $objDatos = $request->getParsedBody();
     $id = $objDatos['id'];
    $nombre = $objDatos['nombre'];
    $clave = $objDatos['clave'];
    $mail = $objDatos['mail'];
    $rol = $objDatos['rol'];
    $sucursal = $objDatos['sucursal'];


    Usuario::Actualizar($nombre,$clave,$mail,$rol,$sucursal);
    //return $usuarios;
    $response->write(json_encode("se modifico con exito el usuario: " .$nombre));
    //$response->write(json_encode($objDatos));
});

$app->post('/login', function (Request $request, Response $response) {
    include "clases/usuarios.php";
    include "clases/roles.php";
    
$key = "key_inmobiliaria";

 $objDatos = $request->getParsedBody();
     $mail = $objDatos['mail'];
    $clave = $objDatos['clave'];
$token = Usuario::traerUnUsuario($mail,$clave);

$rol = rol::TraerUnRol($token->rol);

$jwt = JWT::encode($token, $key);
$tok['token'] = $jwt;

$jwt = JWT::encode($rol,$key);
$tok['rol'] = $jwt;

return json_encode($tok);
});


$app->get('/login/{token}', function (Request $request, Response $response) {
    $token = $request->getAttribute('token');
    $key = "key_inmobiliaria";

JWT::$leeway = 60; // $leeway in seconds
$decoded = JWT::decode($token, $key, array('HS256'));
return json_encode($decoded);
});


$app->run();
