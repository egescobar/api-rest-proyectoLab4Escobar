<?php

class encuesta
{
	public $id_encuesta;
 	public $como_nos_conocio;
  	public $motivos_que_nos_contrato;
    public $servicio_que_contrato;
    public $atencion_del_personal;
    public $mejoramiento_servicio;
    public $comentarios;
    
  	
public static function TraerTodasLasEncuestas()
{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from encuesta");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "encuesta");		

}


public static function insertar($como_nos_conocio,$motivos_que_nos_contrato,$servicio_que_contrato,$atencion_del_personal,$mejoramiento_servicio,$comentarios)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into encuesta (como_nos_conocio,motivos_que_nos_contrato,servicio_que_contrato,atencion_del_personal,mejoramiento_servicio,comentarios)values(:como_nos_conocio,:motivos_que_nos_contrato,:servicio_que_contrato,:atencion_del_personal,:mejoramiento_servicio,:comentarios)");
				$consulta->bindValue(':como_nos_conocio',$como_nos_conocio, PDO::PARAM_STR);
				$consulta->bindValue(':motivos_que_nos_contrato',$motivos_que_nos_contrato, PDO::PARAM_STR);
                $consulta->bindValue(':servicio_que_contrato',$servicio_que_contrato, PDO::PARAM_STR);
                $consulta->bindValue(':atencion_del_personal',$atencion_del_personal, PDO::PARAM_STR);
				$consulta->bindValue(':mejoramiento_servicio',$mejoramiento_servicio, PDO::PARAM_STR);
                $consulta->bindValue(':comentarios',$comentarios, PDO::PARAM_STR);
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();

}

public static function actualizar($id_encuesta,$como_nos_conocio,$motivos_que_nos_contrato,$servicio_que_contrato,$atencion_del_personal,$mejoramiento_servicio,$comentarios)
{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("update encuesta set como_nos_conocio=:como_nos_conocio, motivos_que_nos_contrato=:motivos_que_nos_contrato
                 ,servicio_que_contrato=:servicio_que_contrato,atencion_del_personal=:atencion_del_personal,mejoramiento_servicio=:mejoramiento_servicio,comentarios=:comentarios where id_encuesta=:id_encuesta");
				$consulta->bindValue(':id_encuesta',$id_encuesta, PDO::PARAM_INT);
				$consulta->bindValue(':como_nos_conocio',$como_nos_conocio, PDO::PARAM_STR);
				$consulta->bindValue(':motivos_que_nos_contrato',$motivos_que_nos_contrato, PDO::PARAM_STR);
                $consulta->bindValue(':servicio_que_contrato',$servicio_que_contrato, PDO::PARAM_STR);
                 $consulta->bindValue(':atencion_del_personal',$atencion_del_personal, PDO::PARAM_STR);
                $consulta->bindValue(':mejoramiento_servicio',$mejoramiento_servicio, PDO::PARAM_STR);
                $consulta->bindValue(':comentarios',$comentarios, PDO::PARAM_STR);
				$consulta->execute();
				return $consulta;
}



public static function Borrar($id_encuesta)
{

$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("delete from encuesta where id_encuesta=:id_encuesta");
				$consulta->bindValue(':id_encuesta',$id_encuesta, PDO::PARAM_INT);
				$consulta->execute();
				return $consulta->rowCount();

}

}
?>