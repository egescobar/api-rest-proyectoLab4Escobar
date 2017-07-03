<?php

class producto
{
	public $id_producto;
 	public $tipo_producto;
  	public $direccion;
  	public $descripcion;
	public $moneda;
    public $precio;
    public $es_oferta;
    public $imagen;
    public $sucursal;
    
	private function __construct()
    {

	}

/*public static function Actualizar($id_producto,$tipo_producto,$direccion,$descripcion,$moneda,$precio,$es_oferta,$imagen,$sucursal)
{
	
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("update producto set 
				tipo_producto=:tipo_producto, 
				direccion=:direccion, 
				descripcion=:descripcion,
				moneda=:moneda,
				 precio=:precio,
				 es_oferta:es_oferta,
				 imagen:imagen,
				 sucursal:sucursal 
				 where id_producto=:id_producto");
				$consulta->bindValue(':id_producto',$id_producto, PDO::PARAM_INT);
				$consulta->bindValue(':tipo_producto',$tipo_producto, PDO::PARAM_STR);
				$consulta->bindValue(':direccion',$direccion, PDO::PARAM_STR);
				$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
				$consulta->bindValue(':moneda',$moneda, PDO::PARAM_STR);
				$consulta->bindValue(':precio',$precio, PDO::PARAM_STR);
                $consulta->bindValue(':es_oferta',$es_oferta, PDO::PARAM_STR);
                $consulta->bindValue(':imagen',$imagen, PDO::PARAM_STR);
                $consulta->bindValue(':sucursal',$sucursal, PDO::PARAM_STR);
				$consulta->execute();
				return $consulta;
	
}*/

public static function Modificar($id_producto,$precio)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("update producto set 
				precio=:precio where id_producto=:id_producto");
				$consulta->bindValue(':id_producto',$id_producto, PDO::PARAM_INT);
				$consulta->bindValue(':precio',$precio, PDO::PARAM_STR);
				$consulta->execute();
				return $consulta;
}





public static function TraerTodosLosProductos()
{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		

}


public static function insertar($tipo_producto,$direccion,$descripcion,$moneda,$precio,$es_oferta,$imagen,$sucursal)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (tipo_producto,direccion,descripcion,moneda,precio,es_oferta,imagen,sucursal)values(:tipo_producto,:direccion,:descripcion,:moneda,:precio,:es_oferta,:imagen,:sucursal)");
				$consulta->bindValue(':tipo_producto',$tipo_producto, PDO::PARAM_STR);
				$consulta->bindValue(':direccion',$direccion, PDO::PARAM_STR);
				$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
				$consulta->bindValue(':moneda',$moneda, PDO::PARAM_STR);
				$consulta->bindValue(':precio',$precio, PDO::PARAM_STR);
                $consulta->bindValue(':es_oferta',$es_oferta, PDO::PARAM_STR);
                $consulta->bindValue(':imagen',$imagen, PDO::PARAM_STR);
                $consulta->bindValue(':sucursal',$sucursal, PDO::PARAM_STR);
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();

}





public static function Borrar($id_producto)
{

$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("delete from producto where id_producto=:id_producto");
				$consulta->bindValue(':id_producto',$id_producto, PDO::PARAM_INT);
				$consulta->execute();
				return $consulta->rowCount();

}

}
?>