<?php
class usuario
{
	public $id;
 	public $nombre;
  	public $clave;
  	public $mail;
	public $rol;
	public $sucursal;

private function __construct()
    {

	}

public static function TraerTodosLosUsuarios()
{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		

}
public static function Insertar($nombre,$clave,$mail,$rol,$sucursal)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,clave,mail,rol,sucursal)values(:nombre,:clave,:mail,:rol,:sucursal)");
				$consulta->bindValue(':nombre',$nombre, PDO::PARAM_STR);
				$consulta->bindValue(':clave',$clave, PDO::PARAM_STR);
				$consulta->bindValue(':mail',$mail, PDO::PARAM_STR);
				$consulta->bindValue(':rol',$rol, PDO::PARAM_STR);
				$consulta->bindValue(':sucursal',$sucursal, PDO::PARAM_STR);
$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();

}

public static function traerUnUsuario($mail,$clave)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where mail=:mail and clave=:clave");
				$consulta->bindValue(':clave',$clave, PDO::PARAM_STR);
				$consulta->bindValue(':mail',$mail, PDO::PARAM_STR);
				$consulta->execute();
				$usuconsulta= $consulta->fetchObject('usuario');
				return $usuconsulta;
				

}

public static function Actualizar($id,$nombre,$clave,$mail,$rol,$sucursal)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("update usuario set 
				nombre=:nombre, 
				clave=:clave, 
				mail=:mail,
				rol=:rol,
				sucursal=:sucursal where id=:id");
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);
				$consulta->bindValue(':nombre',$nombre, PDO::PARAM_STR);
				$consulta->bindValue(':clave',$clave, PDO::PARAM_STR);
				$consulta->bindValue(':mail',$mail, PDO::PARAM_STR);
				$consulta->bindValue(':rol',$rol, PDO::PARAM_STR);
				$consulta->bindValue(':sucursal',$sucursal, PDO::PARAM_STR);
				$consulta->execute();
				return $consulta;
}



public static function Borrar($id)
{

$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("delete from usuario where id=:id ");
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);
				$consulta->execute();
				return $consulta->rowCount();

}

}
?>