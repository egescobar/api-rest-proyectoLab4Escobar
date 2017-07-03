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


    Usuario::Actualizar($id,$nombre,$clave,$mail,$rol,$sucursal);
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

$app->get('/sucursal', function (Request $request, Response $response) {
include "clases/sucursal.php";
    $sucursal=sucursal::TraerTodasLasSucursales();
    //return $usuarios;
    $response->write(json_encode($sucursal));
});


//******************METODOS DE PRODUCTO***************

//INSERTA PRODUCTO
$app->post('/producto', function (Request $request, Response $response) {
    include "clases/producto.php";
    
    $objDatos = $request->getParsedBody();
    $tipo_producto = $objDatos['tipo_producto'];
    $direccion = $objDatos['direccion'];
    $descripcion = $objDatos['descripcion'];
    $moneda = $objDatos['moneda'];
    $precio = $objDatos['precio'];
    $es_oferta = $objDatos['es_oferta'];
    $imagen = $objDatos['imagen'];
    $sucursal = $objDatos['sucursal'];


    producto::Insertar($tipo_producto,$direccion,$descripcion,$moneda,$precio,$es_oferta,$imagen,$sucursal);
    //return $usuarios;
    $response->write(json_encode("se inserto con exito el producto: " .$descripcion));
});

//CONSULTA PRODUCTO
$app->get('/producto', function (Request $request, Response $response) {
include "clases/producto.php";
    $producto=producto::TraerTodosLosProductos();
    //return $usuarios;
    $response->write(json_encode($producto));
});

//ELIMINA PRODUCTO
$app->delete('/producto', function (Request $request, Response $response) {
include "clases/producto.php";
    
    $objDatos = $request->getParsedBody();
    $id_producto = $objDatos['id_producto'];

    producto::Borrar($id_producto);
    //return $usuarios;
    $response->write(json_encode("se elimino con exito el usuario: " .$id_producto));
});

//MODIFICA PRODUCTO
$app->PUT('/producto', function (Request $request, Response $response) {
    include "clases/producto.php";
    
    $objDatos = $request->getParsedBody();
    
    $id_producto = $objDatos['id_producto'];
    $precio = $objDatos['precio'];
    
    producto::Modificar($id_producto,$precio);
    //producto::Modificar($id_producto,$precio);
    //return $usuarios;
   $response->write(json_encode("se modifico: " .$precio));
    //$response->write(json_encode($objDatos));
});


//*********************PARA PEDIDOS*********************

//LISTA TODOS LOS PEDIDOS
$app->get('/pedidos', function (Request $request, Response $response) {
    include "clases/pedido.php";
    $pedidos=pedido::TraerTodosLosPedidos();
    //return $usuarios;
    $response->write(json_encode($pedidos));
});

//INSERTA EL PEDIDO
$app->post('/pedidos', function (Request $request, Response $response) {
    include "clases/pedido.php";

    $objDatos = $request->getParsedBody();
    $tipo_pedido = $objDatos['tipo_pedido'];
    $descripcion = $objDatos['descripcion'];
    $sucursal = $objDatos['sucursal'];


    pedido::Insertar($tipo_pedido,$descripcion,$sucursal);
    //return $usuarios;
    $response->write(json_encode("se inserto con exito el pedido: " .$tipo_pedido));
});


//ELIMINAR El PEDIDO
$app->delete('/pedidos', function (Request $request, Response $response) {
    include "clases/pedido.php";
    
    $objDatos = $request->getParsedBody();
    $id_pedido = $objDatos['id_pedido'];

    pedido::Borrar($id_pedido);
    //return $usuarios;
    $response->write(json_encode("se elimino con exito el pedido: " .$id_pedido));
});


//MODIFICA El PEDIDO
$app->put('/pedidos', function (Request $request, Response $response) {
    include "clases/pedidos.php";
    
     $objDatos = $request->getParsedBody();
     $id_pedido = $objDatos['id_pedido'];
    $tipo_pedido = $objDatos['tipo_pedido'];
    $descripcion = $objDatos['descripcion'];
    $sucursal = $objDatos['sucursal'];

    pedido::Actualizar($tipo_pedido,$descripcion,$sucursal);
    //return $usuarios;
    $response->write(json_encode("se modifico con exito el pedido: " .$id_pedido));
    //$response->write(json_encode($objDatos));
});

//*********************ENCUESTA*********************
//INSERTA EL PEDIDO
$app->post('/encuesta', function (Request $request, Response $response) {
    include "clases/encuesta.php";

    $objDatos = $request->getParsedBody();
    $como_nos_conocio = $objDatos['como_nos_conocio'];
    $motivos_que_nos_contrato = $objDatos['motivos_que_nos_contrato'];
    $servicio_que_contrato = $objDatos['servicio_que_contrato'];
    $atencion_del_personal = $objDatos['atencion_del_personal'];
    $mejoramiento_servicio = $objDatos['mejoramiento_servicio'];
    $comentarios = $objDatos['comentarios'];


    encuesta::Insertar($como_nos_conocio,$motivos_que_nos_contrato,$servicio_que_contrato,$atencion_del_personal,$mejoramiento_servicio,$comentarios);
    //return $usuarios;
    $response->write(json_encode("se inserto con exito la encuesta: " .$servicio_que_contrato));
});

//LISTA TODAS LAS ENCUESTAS
$app->get('/encuesta', function (Request $request, Response $response) {
    include "clases/encuesta.php";
    $encuesta=encuesta::TraerTodasLasEncuestas();
    //return $usuarios;
    $response->write(json_encode($encuesta));
});

$app->run();
