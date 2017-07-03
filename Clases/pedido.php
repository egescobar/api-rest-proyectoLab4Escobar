<?php

class pedido
{
	public $id_pedido;
 	public $tipo_pedido;
  	public $descripcion;
    public $sucursal;
    
  	
public static function TraerTodosLosPedidos()
{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from pedido");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "pedido");		

}


public static function insertar($tipo_pedido,$descripcion,$sucursal)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedido (tipo_pedido,descripcion,sucursal)values(:tipo_pedido,:descripcion,:sucursal)");
				$consulta->bindValue(':tipo_pedido',$tipo_pedido, PDO::PARAM_STR);
				$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
                $consulta->bindValue(':sucursal',$sucursal, PDO::PARAM_STR);
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();

}

public static function actualizar($id_pedido,$tipo_pedido,$descripcion,$sucursal)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("update pedido set tipo_pedido=:tipo_pedido, direccion=:direccion
                 ,sucursal:sucursal where id_pedido=:id_pedido");
				$consulta->bindValue(':id_pedido',$id_pedido, PDO::PARAM_INT);
				$consulta->bindValue(':tipo_pedido',$tipo_pedido, PDO::PARAM_STR);
				$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
                $consulta->bindValue(':sucursal',$sucursal, PDO::PARAM_STR);
				$consulta->execute();
				return $consulta;
}



public static function Borrar($id_pedido)
{

$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("delete from pedido where id_pedido=:id_pedido");
				$consulta->bindValue(':id_pedido',$id_pedido, PDO::PARAM_INT);
				$consulta->execute();
				return $consulta->rowCount();

}

}
?>