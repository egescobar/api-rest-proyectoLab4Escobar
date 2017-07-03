<?php
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
?>