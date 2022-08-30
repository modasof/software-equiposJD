<?php
/**
* CLASE PARA TRABAJAR CON LAS MARCAS
*/
class Novedades
{
    private $id;
    private $campos; //devuelve todos los campos de la tabla


	function __construct($id,$campos)
	{
        $this->setId($id);
        $this->setCampos($campos);
	}

	/************************************************************************************
	** FUNCIONES PARA ESTABLECER Y OBTENER LAS VARIABLES DE LA TABLA       ***
	/***********************************************************************************/
	//ESTABLECER Y OBTENER ID
	public function getId(){
		return $this->id;
	}
	public function setId($id){ //Establece el nuevo valor del campo
		$this->id = $id;
	}

	//ESTABLECER Y OBTENER LOS CAMPOS
	public function getCampos(){
		return $this->campos;
	}
	public function setCampos($campos){ //Establece el nuevo valor del campo
		$this->campos = $campos;
	}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE TESTIMONIOS	  **
********************************************************/
public static function obtenerPagina(){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM novedades WHERE novedad_publicado='1'");
    	$camposs=$select->fetchAll();
    	$campos = new Novedades('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function ReporteNovedadesporfecha($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM novedades WHERE novedad_publicado='1' and estado_novedad='1' and fecha_novedad >='".$FechaStart."' and fecha_novedad <='".$FechaEnd."' order by fecha_novedad DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Novedades('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FILTRADOS POR ID  **
***************************************************************/
public static function obtenerPaginaPor($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("SELECT * FROM novedades WHERE id='".$id."' and novedad_publicado='1'");
		$camposs=$select->fetchAll();
		$campos = new Novedades('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/***************************************************************
** FUNCION PARA ELIINAR POR ID  **
***************************************************************/
public static function eliminarPor($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("UPDATE novedades SET novedad_publicado='0' WHERE id='".$id."'");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/********************************************************************
*** FUNCION PARA MODIFICAR ****
id_funcionario, imagen, nombre_funcionario, fecha_ingreso, fecha_salida, tipo_contrato, cargo_id_cargo, observaciones, creado_por, marca_temporal, funcionario_publicado, estado_funcionario
********************************************************************/
public static function actualizar($id,$campos,$imagen){
	try {
		$db=Db::getConnect();
		$campostraidos = $campos->getCampos();
		extract($campostraidos);

		$update=$db->prepare('UPDATE novedades SET
								reportado_por=:reportado_por,
								tipo_novedad=:tipo_novedad,
								fecha_novedad=:fecha_novedad,
								imagen=:imagen,
								observaciones=:observaciones
								WHERE id=:id');

		$t = strtotime($fecha_novedad);
		$nuevafecha=date('y-m-d',$t);

		$update->bindValue('reportado_por',utf8_encode($reportado_por));
		$update->bindValue('tipo_novedad',utf8_encode($tipo_novedad));
		$update->bindValue('fecha_novedad',utf8_encode($nuevafecha));
		$update->bindValue('imagen',utf8_encode($imagen));
		$update->bindValue('observaciones',utf8_encode($observaciones));
		$update->bindValue('id',utf8_encode($id));
		$update->execute();
		return true;
	}
	catch(PDOException $e) {
		echo '{"error al guardar la configuración ":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
*** FUNCION PARA GUARDAR **
id_funcionario, imagen, nombre_funcionario, fecha_ingreso, fecha_salida, tipo_contrato, cargo_id_cargo, observaciones, creado_por, marca_temporal, funcionario_publicado, estado_funcionario
***************************************************************/
public static function guardar($campos,$imagen){
	try {
		$db=Db::getConnect();
		$campostraidos = $campos->getCampos();
		extract($campostraidos);
		$consulta="INSERT INTO funcionarios VALUES (NULL,:imagen, :documento,:nombre_funcionario, :fecha_ingreso,:fecha_salida, :tipo_contrato, :cargo_id_cargo, :observaciones, :creado_por, :marca_temporal, :funcionario_publicado, :estado_funcionario)";
		$insert=$db->prepare($consulta);

		$t = strtotime($fecha_ingreso);
		$nuevafecha=date('y-m-d',$t);
		

		$insert->bindValue('imagen',utf8_encode($imagen));
		$insert->bindValue('documento',utf8_encode($documento));
		$insert->bindValue('nombre_funcionario',utf8_encode($nombre_funcionario));
		$insert->bindValue('fecha_ingreso',utf8_encode($nuevafecha));
		$insert->bindValue('fecha_salida',utf8_encode($fecha_salida));
		$insert->bindValue('tipo_contrato',utf8_encode($tipo_contrato));
		$insert->bindValue('cargo_id_cargo',utf8_encode($cargo_id_cargo));
		$insert->bindValue('observaciones',utf8_encode($observaciones));
		$insert->bindValue('creado_por',utf8_encode($creado_por));
		$insert->bindValue('marca_temporal',utf8_encode($marca_temporal));
		$insert->bindValue('funcionario_publicado',utf8_encode($funcionario_publicado));
		$insert->bindValue('estado_funcionario',utf8_encode($estado_funcionario));
		$insert->execute();

		return true;
	}
	catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

}

?>
