<?php
include "AccesoDatos.php";
class sucursal
{
	public $id_sucursal;
 	public $descripcion;
  	public $direccion;
  	public $cod_encargado;
	public $latitud;
    public $longitud;
    
  	
public static function TraerTodasLasSucursales()
{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from sucursal");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "sucursal");		

}
public static function insertar($descripcion,$direccion,$cod_encargado,$latitud,$longitud)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into sucursal (descripcion,direccion,cod_encargado,latitud,longitud)values(:descripcion,:direccion,:cod_encargado,:latitud,:longitud)");
				$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
				$consulta->bindValue(':direccion',$direccion, PDO::PARAM_STR);
				$consulta->bindValue(':cod_encargado',$cod_encargado, PDO::PARAM_STR);
				$consulta->bindValue(':latitud',$latitud, PDO::PARAM_STR);
				$consulta->bindValue(':longitud',$longitud, PDO::PARAM_STR);
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();

}

public static function actualizar($id,$descripcion,$direccion,$cod_encargado,$latitud,$longitud)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("update sucursal set descripcion=:descripcion, direccion=:direccion, cod_encargado=:cod_encargado ,latitud=:latitud,longitud=:longitud where id=:id");
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);
				$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
				$consulta->bindValue(':direccion',$direccion, PDO::PARAM_STR);
				$consulta->bindValue(':cod_encargado',$cod_encargado, PDO::PARAM_STR);
				$consulta->bindValue(':latitud',$latitud, PDO::PARAM_STR);
				$consulta->bindValue(':longitud',$longitud, PDO::PARAM_STR);
				$consulta->execute();
				return $consulta;
}



public static function Borrar($id)
{

$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("delete from sucursal where id=:id ");
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);
				$consulta->execute();
				return $consulta->rowCount();

}

}
?>