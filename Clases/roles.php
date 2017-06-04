<?php

class rol
{
	public $id_rol;
 	public $descripcion;
  	public $crear_usuario;
  	public $crear_sucursal;
	public $modificar_producto;
    public $crear_producto;
    
  	private function __construct()
    {

	}
public static function TraerTodosLosUsuarios()
{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from rol");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "rol");		

}
public static function insertar($descripcion,$crear_usuario,$crear_sucursal,$modificar_producto,$crear_producto)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into rol (descripcion,crear_usuario,crear_sucursal,modificar_producto,crear_producto)values(:descripcion,:crear_usuario,:crear_sucursal,:modificar_producto,:crear_producto)");
				$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
				$consulta->bindValue(':crear_usuario',$crear_usuario, PDO::PARAM_STR);
				$consulta->bindValue(':crear_sucursal',$crear_sucursal, PDO::PARAM_STR);
				$consulta->bindValue(':modificar_producto',$modificar_productorol, PDO::PARAM_STR);
				$consulta->bindValue(':crear_producto',$crear_producto, PDO::PARAM_STR);
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();

}

public static function actualizar($descripcion,$crear_usuario,$crear_sucursal,$modificar_producto,$crear_producto)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("update rol set descripcion=:descripcion, crear_usuario=:crear_usuario, modificar_producto=:modificar_producto,crear_producto=:crear_producto,crear_sucursal=:crear_sucursal where id=:id");
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);
				$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
				$consulta->bindValue(':crear_usuario',$crear_usuario, PDO::PARAM_STR);
				$consulta->bindValue(':crear_sucursal',$crear_sucursal, PDO::PARAM_STR);
				$consulta->bindValue(':modificar_producto',$modificar_producto, PDO::PARAM_STR);
				$consulta->bindValue(':crear_producto',$crear_producto, PDO::PARAM_STR);
				$consulta->execute();
				return $consulta;
}



public static function borrar($id)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("delete from rol where id=:id ");
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);
				$consulta->execute();
				return $consulta->rowCount();

}
public static function TraerUnRol($id)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("select * from rol where id_rol=:id ");
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);
				$consulta->execute();			
				return  $consulta->fetchObject('rol');
}

}
?>