<?php
/**
* CLASE PARA TRABAJAR CON LAS MARCAS
*/
class Compras
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

	public static function ReporteDespachosOrderId(){
		try {
			$db=Db::getConnect();

			$select=$db->query("SELECT * FROM ordenescompra WHERE estado_orden<>'0' order by id DESC");
	    	$camposs=$select->fetchAll();
	    	$campos = new Compras('',$camposs);
			return $campos;
		}
		catch(PDOException $e) {
			echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
		}
	}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function todosrecibirinsumos(){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT *,A.id as cotizacionid, B.id as ordenid FROM cotizaciones_item as A, ordenescompra as B WHERE A.estado_cotizacion='2' and A.ordencompra_num=B.id  and B.estado_orden<>'0' and B.fecha_reporte BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE()  order by B.fecha_reporte desc");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function todositemproveedor($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT *,A.id as cotizacionid, B.id as ordenid FROM cotizaciones_item as A, ordenescompra as B WHERE A.estado_cotizacion='2' and A.ordencompra_num=B.id  and B.estado_orden<>'0' and A.proveedor_id_proveedor='".$id."' order by B.fecha_reporte desc");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfechacargarinsumos($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT *,A.id as cotizacionid, B.id as ordenid FROM cotizaciones_item as A, ordenescompra as B WHERE estado_cotizacion='2' and B.fecha_reporte >='".$FechaStart."' and B.fecha_reporte <='".$FechaEnd."' and A.ordencompra_num=B.id  and B.estado_orden<>'0' order by B.fecha_reporte desc");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfechacargarinsumospro($FechaStart,$FechaEnd,$id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT *,A.id as cotizacionid, B.id as ordenid FROM cotizaciones_item as A, ordenescompra as B WHERE estado_cotizacion='2' and B.fecha_reporte >='".$FechaStart."' and B.fecha_reporte <='".$FechaEnd."' and A.ordencompra_num=B.id  and B.estado_orden<>'0' and A.proveedor_id_proveedor='".$id."' and  order by B.fecha_reporte desc");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porproveedorcargarinsumos($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM cotizaciones_item as A, ordenescompra as B WHERE estado_cotizacion='2' and B.proveedor_id_proveedor='".$id."' and A.ordencompra_num=B.id  and B.estado_orden<>'0' order by B.fecha_reporte desc");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfechacompraproyecto($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT DISTINCT(A.proyecto_id_proyecto) AS proyecto FROM ordenescompra as C, cotizaciones_item as B, requisiciones as A WHERE C.fecha_reporte >='".$FechaStart."' and C.fecha_reporte <='".$FechaEnd."' AND C.estado_orden<>'0' AND A.id=B.requisicion_id AND C.id=B.ordencompra_num AND  B.estado_cotizacion='02'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfechacomprarubro($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT DISTINCT(rubro_id) AS rubro FROM ordenescompra WHERE fecha_reporte >='".$FechaStart."' and fecha_reporte <='".$FechaEnd."' AND estado_orden<>'0'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfechacompracategoria($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT DISTINCT(D.categoriainsumo_id) AS categoria FROM ordenescompra as C, cotizaciones_item as B, requisiciones as A , insumos AS D WHERE C.fecha_reporte >='".$FechaStart."' and C.fecha_reporte <='".$FechaEnd."' AND C.estado_orden<>'0' AND A.id=B.requisicion_id AND C.id=B.ordencompra_num AND  B.estado_cotizacion='02' AND B.insumo_id_insumo=D.id_insumo");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function todos(){
	try {
		$db=Db::getConnect();
		$sql="SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0' and compra_de='Insumos' and id_factura_compra='0' and fecha_reporte BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() order by fecha_reporte DESC";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function todospormes(){
	try {
		$db=Db::getConnect();
		$sql="SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0'  order by fecha_reporte DESC";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function todosfacturapormes(){
	try {
		$db=Db::getConnect();
		$sql="SELECT * FROM facturas_compras_total WHERE factura_publicada='1'  order by id DESC";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}





/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function detallefacturacompra($id){
	try {
		$db=Db::getConnect();
		$sql="SELECT * FROM facturas_compras_total WHERE id='".$id."' and factura_publicada<>'0'";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function todosporproveedor($id){
	try {
		$db=Db::getConnect();
		$sql="SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0' and proveedor_id_proveedor='".$id."' order by fecha_reporte DESC";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function detallepagos($id){
	try {
		$db=Db::getConnect();
		$sql="SELECT * FROM detalle_pagos_ordenescompra WHERE estado_pago='1' and compra_id='".$id."' order by fecha_registro DESC";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function cxpusuario($id){
	try {
		$db=Db::getConnect();
		$sql="SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0' and compra_de='Cxp' and usuario_creador='".$id."' order by fecha_reporte DESC";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function recibiroc(){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM ordenescompra WHERE estado_orden<>'0' and compra_de='Insumos' and fecha_reporte BETWEEN DATE_SUB(CURDATE(), INTERVAL 60 DAY) AND CURDATE() order by fecha_reporte DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function todosocservicios(){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0' and compra_de='Servicios' and fecha_reporte and id_factura_compra='0' BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() order by fecha_reporte DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function todosoccuentasxpagar(){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0' and compra_de='cxp' and fecha_reporte and id_factura_compra='0' BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() order by fecha_reporte DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function todosocequipos(){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0'  and compra_de='Equipos' and fecha_reporte and id_factura_compra='0' BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND CURDATE() order by fecha_reporte DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function verdetalle($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT A.id, A.proveedor_id_proveedor, A.cotizacion, A.medio_pago, A.item_id, A.valor_cot, A.requisicion_id, A.marca_temporal, A.usuario_creador, A.estado_cotizacion, A.ordencompra_num, B.insumo_id_insumo,B.cantidad,A.cantidadcot,A.vr_unitario,B.servicio_id_servicio, B.fecha_reporte,A.iva,A.valor_iva FROM cotizaciones_item as A, requisiciones_items as B WHERE A.ordencompra_num='".$id."' and A.item_id=B.id order by id DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function detalleocfacturacion($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT A.id, A.proveedor_id_proveedor, A.cotizacion, A.medio_pago, A.item_id, A.valor_cot, A.requisicion_id, A.marca_temporal, A.usuario_creador, A.estado_cotizacion, A.ordencompra_num, B.insumo_id_insumo,B.cantidad,A.cantidadcot,A.vr_unitario,B.servicio_id_servicio, B.fecha_reporte,A.iva,A.valor_iva,A.imagen FROM cotizaciones_item as A, requisiciones_items as B WHERE A.ordencompra_num='".$id."' and A.item_id=B.id and estado_cotizacion='2' order by id DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FECHAS	  **
********************************************************/
public static function detalleocfacturaciondescartada($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT A.id, A.proveedor_id_proveedor, A.cotizacion, A.medio_pago, A.item_id, A.valor_cot, A.requisicion_id, A.marca_temporal, A.usuario_creador, A.estado_cotizacion, A.ordencompra_num, B.insumo_id_insumo,B.cantidad,A.cantidadcot,A.vr_unitario,B.servicio_id_servicio, B.fecha_reporte,A.iva,A.valor_iva FROM cotizaciones_item as A, requisiciones_items as B WHERE A.ordencompra_num='".$id."' and A.item_id=B.id and estado_cotizacion='3' order by id DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}




/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfecha($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM ordenescompra WHERE estado_orden<>'0'and id_factura_compra='0' and fecha_reporte >='".$FechaStart."' and fecha_reporte <='".$FechaEnd."' and compra_de='insumos' order by fecha_reporte DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfechaall($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0' and fecha_reporte >='".$FechaStart."' and fecha_reporte <='".$FechaEnd."' order by fecha_reporte DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfechafacturaall($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM facturas_compras_total WHERE factura_publicada='1' and fecha_reporte >='".$FechaStart."' and fecha_reporte <='".$FechaEnd."' order by fecha_reporte DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}



/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfechaservicios($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();
		$sql="SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0' and fecha_reporte >='".$FechaStart."' and fecha_reporte <='".$FechaEnd."' and compra_de='servicios'  order by fecha_reporte DESC";
		$select=$db->query($sql);
		//echo($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfechaequipos($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0' and fecha_reporte >='".$FechaStart."' and fecha_reporte <='".$FechaEnd."' and compra_de='Equipos'  order by fecha_reporte DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS POR RANGO DE FECHA	  **
********************************************************/
public static function porfechacuentasporpagar($FechaStart,$FechaEnd){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT * FROM ordenescompra WHERE estado_orden<>'0' and id_factura_compra='0' and fecha_reporte >='".$FechaStart."' and fecha_reporte <='".$FechaEnd."' and compra_de='CxP'  order by fecha_reporte DESC");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/***************************************************************
*** FUNCION PARA GUARDAR **
INSERT INTO ordenescompra(id, imagen, fecha_reporte, valor_total, valor_retenciones, estado_orden, proveedor_id_proveedor, medio_pago, observaciones, marca_temporal, usuario_creador)
***************************************************************/
public static function guardar($campos,$imagen){
	try {
		$db=Db::getConnect();
		$campostraidos = $campos->getCampos();
		extract($campostraidos);

		$insert=$db->prepare('INSERT INTO ordenescompra VALUES (NULL,:imagen,:fecha_reporte,:valor_total,:valor_retenciones,:valor_iva,:estado_orden,:proveedor_id_proveedor,:medio_pago,:observaciones,:marca_temporal,:usuario_creador,:rubro_id,:subrubro_id,:vencimiento,:factura)');

		$V1=str_replace(".","",$valor_total);
		$V2=str_replace(" ", "", $V1);
		$valor_final=str_replace("$", "", $V2);
		$valornumero=(int) $valor_final;

		$V11=str_replace(".","",$valor_retenciones);
		$V21=str_replace(" ", "", $V11);
		$valor_final1=str_replace("$", "", $V21);
		$valornumero1=(int) $valor_final1;

		$valor_iva=0;

		$t = strtotime($fecha_reporte);
		$nuevafecha=date('y-m-d',$t);

		
		$insert->bindValue('imagen',utf8_encode($imagen));
		$insert->bindValue('fecha_reporte',utf8_encode($nuevafecha));
		$insert->bindValue('valor_total',utf8_encode($valornumero));
		$insert->bindValue('valor_retenciones',utf8_encode($valornumero1));
		$insert->bindValue('valor_iva',utf8_encode($valor_iva));
		$insert->bindValue('estado_orden',utf8_encode($estado_orden));
		$insert->bindValue('proveedor_id_proveedor',utf8_encode($proveedor_id_proveedor));
		$insert->bindValue('medio_pago',utf8_encode($medio_pago));
		$insert->bindValue('observaciones',utf8_encode($observaciones));
		$insert->bindValue('marca_temporal',utf8_encode($marca_temporal));
		$insert->bindValue('usuario_creador',utf8_encode($usuario_creador));
		$insert->bindValue('rubro_id',utf8_encode($rubro_id));
		$insert->bindValue('subrubro_id',utf8_encode($subrubro_id));
		$insert->bindValue('vencimiento',utf8_encode($vencimiento));
		$insert->bindValue('factura',utf8_encode($factura));
		$insert->execute();
		
		return true;
	}
	catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
** FUNCION PARA ELIINAR POR ID  **
***************************************************************/
public static function eliminarpor($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("UPDATE ordenescompra SET estado_orden='0' WHERE id='".$id."'");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
** FUNCION PARA ELIINAR POR ID  **
***************************************************************/
public static function descartarpor($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("UPDATE cotizaciones_item SET estado_cotizacion='3' WHERE id='".$id."'");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
** FUNCION PARA ELIINAR POR ID  **
***************************************************************/
public static function descartarinversapor($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("UPDATE cotizaciones_item SET estado_cotizacion='2' WHERE id='".$id."'");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
** FUNCION PARA ELIINAR POR ID  **
***************************************************************/
public static function cargarentradainventario($cotizacion_item_id, $oc_id, $insumo_id,$servicio_id, $cantidad, $entrada_id, $fecha_registro, $estado_detalle_entrada, $marca_temporal, $creado_por, $entrada_por){
	try {

		$t = strtotime($fecha_registro);
		$nuevafecha=date('y-m-d',$t);
		$db=Db::getConnect();

		$select=$db->query("INSERT INTO detalle_entrada_ins (cotizacion_item_id, oc_id, insumo_id, servicio_id, cantidad, entrada_id, fecha_registro, estado_detalle_entrada, marca_temporal, creado_por, entrada_por) VALUES ('".$cotizacion_item_id."','".$oc_id."','".$insumo_id."','".$servicio_id."','".$cantidad."','".$entrada_id."','".$nuevafecha."','".$estado_detalle_entrada."','".$marca_temporal."','".$creado_por."','".$entrada_por."')");

		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
** ACTUALIZAR ESTADO DE LA RQ ITEM  **
***************************************************************/

 public static function actualizarestadoItemsOC($idtem, $estado)
    {
        try
        {
            $db = DB::getConnect();

            $select = $db->query("UPDATE requisiciones_items SET estado_item='" . $estado . "' WHERE id='".$idtem."'");

        } catch (PDOException $e) {
            echo '{"error en obtener la pagina":{"text":' . $e->getMessage() . '}}';
        }
    }


/***************************************************************
** FUNCION PARA ELIINAR POR ID  **
***************************************************************/
public static function eliminarpagotem($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("DELETE FROM detalle_pagos_ordenescompra  WHERE compra_id='".$id."' and estado_pago='0'");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FILTRADOS POR ID  **
***************************************************************/
public static function editarpor($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("SELECT * FROM ordenescompra WHERE id='".$id."' and estado_orden<>'0'");
		$camposs=$select->fetchAll();
		$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
** FUNCION PARA MOSTRAR TODOS LOS CAMPOS DE FILTRADOS POR ID  **
***************************************************************/
public static function editardetallecotizacion($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("SELECT * FROM cotizaciones_item WHERE id='".$id."'");
		$camposs=$select->fetchAll();
		$campos = new Compras('',$camposs);
		return $campos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/********************************************************************
*** FUNCION PARA MODIFICAR REPORTE DE EQUIPO ****
* id, imagen, fecha_reporte, valor_total, valor_retenciones, estado_orden, proveedor_id_proveedor, medio_pago, observaciones, marca_temporal, usuario_creador
********************************************************************/
public static function actualizar($id,$campos,$imagen){
	try {
		$db=Db::getConnect();
		$campostraidos = $campos->getCampos();
		extract($campostraidos);


		$update=$db->prepare('UPDATE ordenescompra SET
								imagen=:imagen,
								imagen_cot=:imagen_cot,
								fecha_reporte=:fecha_reporte,
								valor_total=:valor_total,
								valor_retenciones=:valor_retenciones,
								valor_iva=:valor_iva,
								estado_orden=:estado_orden,
								proveedor_id_proveedor=:proveedor_id_proveedor,
								medio_pago=:medio_pago,
								observaciones=:observaciones,
								marca_temporal=:marca_temporal,
								usuario_creador=:usuario_creador,
								rubro_id=:rubro_id,
								subrubro_id=:subrubro_id,
								vencimiento=:vencimiento,
								factura=:factura,
								compra_de=:compra_de
								WHERE id=:id');
		
		$V1=str_replace(".","",$valor_total);
		$V2=str_replace(" ", "", $V1);
		$valor_final=str_replace("$", "", $V2);
		$valornumero=(int) $valor_final;

		$V11=str_replace(".","",$valor_retenciones);
		$V21=str_replace(" ", "", $V11);
		$valor_final1=str_replace("$", "", $V21);
		$valornumero1=(int) $valor_final1;

		$t = strtotime($fecha_reporte);
		$nuevafecha=date('y-m-d',$t);



		$update->bindValue('imagen',utf8_encode($imagen));
		$update->bindValue('imagen_cot',utf8_encode($imagen_cot));
		$update->bindValue('fecha_reporte',utf8_encode($nuevafecha));
		$update->bindValue('valor_total',utf8_encode($valornumero));
		$update->bindValue('valor_retenciones',utf8_encode($valornumero1));
		$update->bindValue('valor_iva',utf8_encode($valor_iva));
		$update->bindValue('estado_orden',utf8_encode($estado_orden));
		$update->bindValue('proveedor_id_proveedor',utf8_encode($proveedor_id_proveedor));
		$update->bindValue('medio_pago',utf8_encode($medio_pago));
		$update->bindValue('observaciones',utf8_encode($observaciones));
		$update->bindValue('marca_temporal',utf8_encode($marca_temporal));
		$update->bindValue('usuario_creador',utf8_encode($usuario_creador));
		$update->bindValue('rubro_id',utf8_encode($rubro_id));
		$update->bindValue('subrubro_id',utf8_encode($subrubro_id));
		$update->bindValue('vencimiento',utf8_encode($vencimiento));
		$update->bindValue('factura',utf8_encode($factura));
		$update->bindValue('compra_de',utf8_encode($compra_de));
		$update->bindValue('id',utf8_encode($id));

		$update->execute();
		return true;
	}
	catch(PDOException $e) {
		echo '{"error al guardar la configuración ":{"text":'. $e->getMessage() .'}}';
	}
}


/********************************************************************
*** FUNCION PARA MODIFICAR REPORTE DE EQUIPO ****
* id, imagen, fecha_reporte, valor_total, valor_retenciones, estado_orden, proveedor_id_proveedor, medio_pago, observaciones, marca_temporal, usuario_creador
********************************************************************/
public static function actualizardetallecot($id,$campos){
	try {
		$db=Db::getConnect();
		$campostraidos = $campos->getCampos();
		extract($campostraidos);

		$update=$db->prepare('UPDATE cotizaciones_item SET
								valor_cot=:valor_cot,
								cantidadcot=:cantidadcot,
								vr_unitario=:vr_unitario
								WHERE id=:id');
	

		$V11=str_replace(".","",$vr_unitario);
		$V21=str_replace(" ", "", $V11);
		$valor_final1=str_replace("$", "", $V21);
		$valornumero1=(int) $valor_final1;

		$valornumero=$valornumero1*$cantidadcot;

		$update->bindValue('valor_cot',utf8_encode($valornumero));
		$update->bindValue('cantidadcot',utf8_encode($cantidadcot));
		$update->bindValue('vr_unitario',utf8_encode($valornumero1));
		$update->bindValue('id',utf8_encode($id));

		$update->execute();
		return true;
	}
	catch(PDOException $e) {
		echo '{"error al guardar la configuración ":{"text":'. $e->getMessage() .'}}';
	}
}




/***************************************************************
*** FUNCION PARA GUARDAR INGRESO DE PAGO DE ORDEN DE COMPRA **** 
***************************************************************/
public static function actualizarpago($id,$imagen,$valor_total,$valor_retenciones,$valor_iva,$estado_orden,$rubro_id,$subrubro_id){

		$V1=str_replace(".","",$valor_total);
		$V2=str_replace(" ", "", $V1);
		$valor_final=str_replace("$", "", $V2);
		$valornumero=(int) $valor_final;

		$V11=str_replace(".","",$valor_retenciones);
		$V21=str_replace(" ", "", $V11);
		$valor_final1=str_replace("$", "", $V21);
		$valornumero1=(int) $valor_final1;

		$V12=str_replace(".","",$valor_iva);
		$V22=str_replace(" ", "", $V12);
		$valor_final2=str_replace("$", "", $V22);
		$valornumero2=(int) $valor_final2;


	try {
		$db=Db::getConnect();

		
	$select=$db->query("UPDATE ordenescompra SET imagen='".$imagen."', valor_total='".$valor_final."',valor_retenciones='".$valor_final1."', valor_iva='".$valor_final2."',estado_orden='".$estado_orden."', rubro_id='".$rubro_id."', subrubro_id='".$subrubro_id."' WHERE id='".$id."' ");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/***************************************************************
*** FUNCION PARA GUARDAR INGRESO DE PAGO DE ORDEN DE COMPRA CREDITO**** 
***************************************************************/
public static function actualizarpagocredito($ordenid,$imagen,$estado_orden,$rubro_id,$subrubro_id,$factura){
	try {
		$db=Db::getConnect();

			$select=$db->query("UPDATE ordenescompra SET imagen='".$imagen."',estado_orden='".$estado_orden."', rubro_id='".$rubro_id."', subrubro_id='".$subrubro_id."',factura='".$factura."' WHERE id='".$ordenid."' ");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
*** FUNCION PARA GUARDAR INGRESO DE PAGO DE ORDEN DE COMPRA CREDITO**** 
***************************************************************/
public static function actualizarivaitem($ordenid,$ivasel,$valorivafinal){
	try {
		$db=Db::getConnect();
			$sql="UPDATE cotizaciones_item SET iva='".$ivasel."',valor_iva='".$valorivafinal."' WHERE id='".$ordenid."'";
			$select=$db->query($sql);
			//echo($sql);
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function consultarsubtotalpor($id){
	try {
		$db=Db::getConnect();
		$sql="SELECT valor_cot FROM cotizaciones_item WHERE id='".$id."'";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['valor_cot'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}



/***************************************************************
*** FUNCION PARA GUARDAR INGRESO DE PAGO DE ORDEN DE COMPRA CREDITO**** 
***************************************************************/
public static function actualizarpagoabonos($ordenunica,$fecha_reporte,$estado_egreso,$ultimoegreso){
	try {
		$db=Db::getConnect();

			$select=$db->query("UPDATE detalle_pagos_ordenescompra SET egreso_id='".$ultimoegreso."',estado_pago='".$estado_egreso."', fecha_registro='".$fecha_reporte."' WHERE compra_id='".$ordenunica."' and estado_pago='0'");
			
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


		


/***************************************************************
*** FUNCION PARA GUARDAR INGRESO DE PAGO DE ORDEN DE COMPRA **** 
***************************************************************/
public static function guardarfactura($facturanum,$fecha_reporte,$valor_total,$valor_retenciones,$valor_iva,$marca_temporal,$creado_por,$estado_factura,$factura_publicada,$proveedor){

	$V1=str_replace(".","",$valor_total);
		$V2=str_replace(" ", "", $V1);
		$valor_final=str_replace("$", "", $V2);
		$valornumero=(int) $valor_final;

		$V11=str_replace(".","",$valor_retenciones);
		$V21=str_replace(" ", "", $V11);
		$valor_final1=str_replace("$", "", $V21);
		$valornumero1=(int) $valor_final1;

		$V12=str_replace(".","",$valor_iva);
		$V22=str_replace(" ", "", $V12);
		$valor_final2=str_replace("$", "", $V22);
		$valornumero2=(int) $valor_final2;

	$t = strtotime($fecha_reporte);
		$nuevafecha=date('y-m-d',$t);

	try {
		$db=Db::getConnect();

		
	$select=$db->query("INSERT INTO facturas_compras (proveedor_id_proveedor,facturanum,fecha_reporte, valor_total, valor_ret, valor_iva, marca_temporal, creado_por, estado_factura, factura_publicada) VALUES ('".$proveedor."','".$facturanum."','".utf8_encode($fecha_reporte)."','".utf8_encode($valor_final)."','".utf8_encode($valor_final1)."','".utf8_encode($valor_final2)."','".utf8_encode($marca_temporal)."','".$creado_por."','".utf8_encode($estado_factura)."','".utf8_encode($factura_publicada)."')");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}
/***************************************************************
*** FUNCION PARA GUARDAR INGRESO DE PAGO DE ORDEN DE COMPRA **** 
***************************************************************/
public static function guardaregresoOrdenCompra($cuenta_id_cuenta,$imagen,$tipo_egreso,$proveedor,$beneficiario,$id_rubro,$id_subrubro,$egreso_en,$valor_egreso,$observaciones,$estado_egreso,$egreso_publicado,$marca_temporal,$fecha_egreso,$creado_por,$relacion_id_relacion){

	$V1=str_replace(".","",$valor_egreso);
		$V2=str_replace(" ", "", $V1);
		$valor_final=str_replace("$", "", $V2);
		$valornumero=(int) $valor_final;

	$t = strtotime($fecha_egreso);
		$nuevafecha=date('y-m-d',$t);

	try {
		$db=Db::getConnect();

		
	$select=$db->query("INSERT INTO egresos_cuenta (cuenta_id_cuenta,imagen,tipo_egreso,proveedor_id_proveedor,beneficiario,id_rubro,id_subrubro,egreso_en,valor_egreso,observaciones,estado_egreso,egreso_publicado,marca_temporal,fecha_egreso,creado_por,relacion_id_relacion) VALUES ('".utf8_encode($cuenta_id_cuenta)."','".utf8_encode($imagen)."','".utf8_encode($tipo_egreso)."','".$proveedor."','".utf8_encode($beneficiario)."','".utf8_encode($id_rubro)."','".$id_subrubro."','".utf8_encode($egreso_en)."','".utf8_encode($valor_final)."','".utf8_encode($observaciones)."','".utf8_encode($estado_egreso)."','".utf8_encode($egreso_publicado)."','".utf8_encode($marca_temporal)."','".utf8_encode($nuevafecha)."','".utf8_encode($creado_por)."','".$relacion_id_relacion."')");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/***************************************************************
*** FUNCION PARA GUARDAR FACTURA COMPRAS **** 
* id, imagen, proveedor_id_proveedor, facturanum, fecha_reporte, valor_subtotal, porcentaje_ret, valor_ret, porcentaje_ret2, valor_ret2, valor_iva, valor_descuentos, observaciones, rubro_id, subrubro_id, marca_temporal, creado_por, estado_factura, factura_publicada
***************************************************************/
public static function guardardatosfacturacompra($imagen, $proveedor_id_proveedor, $facturanum, $fecha_reporte, $valor_subtotal, $base_uno,$idretencion1,$porcentaje_ret, $retefuente1, $base_dos,$idretencion2,$porcentaje_ret2, $retefuente2, $valor_iva, $valor_descuentos, $observaciones, $rubro_id, $subrubro_id, $marca_temporal, $creado_por, $estado_factura, $factura_publicada){

	$V1=str_replace(".","",$valor_descuentos);
		$V2=str_replace(" ", "", $V1);
		$valor_final=str_replace("$", "", $V2);
		$valornumero=(int) $valor_final;

	$R1=str_replace(".","",$retefuente1);
		$R2=str_replace(" ", "", $R1);
		$valor_final=str_replace("$", "", $R2);
		$valornumeroR=(int) $valor_final;


	$RA1=str_replace(".","",$retefuente2);
		$RA2=str_replace(" ", "", $RA1);
		$valor_final=str_replace("$", "", $RA2);
		$valornumeroRA=(int) $valor_final;

	$IVA1=str_replace(".","",$valor_iva);
		$IVA2=str_replace(" ", "", $IVA1);
		$valor_final=str_replace("$", "", $IVA2);
		$valornumeroIVA=(int) $valor_final;

	 $totalpago = ($valor_subtotal+$valornumeroIVA)-$valornumeroR-$valornumeroRA-$valornumero;


	try {
		$db=Db::getConnect();
		
	$select=$db->query("INSERT INTO facturas_compras_total(imagen, proveedor_id_proveedor, facturanum, fecha_reporte, valor_subtotal,base_uno,retefuente_id_retefuente1, porcentaje_ret, valor_ret,base_dos,retefuente_id_retefuente2, porcentaje_ret2, valor_ret2, valor_iva, valor_descuentos,total_pago, observaciones, rubro_id, subrubro_id, marca_temporal, creado_por, estado_factura, factura_publicada) VALUES ('".utf8_encode($imagen)."','".utf8_encode($proveedor_id_proveedor)."','".utf8_encode($facturanum)."','".$fecha_reporte."','".utf8_encode($valor_subtotal)."',".utf8_encode($base_uno).",".utf8_encode($idretencion1).",'".utf8_encode($porcentaje_ret)."','".$valornumeroR."',".utf8_encode($base_dos).",".utf8_encode($idretencion2).",'".utf8_encode($porcentaje_ret2)."','".utf8_encode($valornumeroRA)."','".utf8_encode($valornumeroIVA)."','".utf8_encode($valornumero)."','".utf8_encode($totalpago)."','".utf8_encode($observaciones)."','".utf8_encode($rubro_id)."','".utf8_encode($subrubro_id)."','".utf8_encode($marca_temporal)."','".$creado_por."','".$estado_factura."','".$factura_publicada."')");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/***************************************************************
 *** FUNCION PARA GUARDAR **
 ***************************************************************/
    public static function actualizarocfacturacompra($items,$ultimafactura)
    {
        try {
            $db       = Db::getConnect();
            $dbselect = Db::getConnect();
            //$campostraidos = $campos->getCampos();
            $items = explode(",", $items);
            foreach ($items as $key => $despachounico) {
                $update = $db->prepare('UPDATE ordenescompra SET
                                id_factura_compra=:id_factura_compra
                                WHERE id=:despachounico');
                $update->bindValue('id_factura_compra', utf8_encode($ultimafactura));
                $update->bindValue('despachounico', utf8_encode($despachounico));
                $update->execute();
            }
            return $ultimafactura;
        } catch (PDOException $e) {
            echo '{"error al guardar la configuraciónes ":{"text":' . $e->getMessage() . '}}';
        }
    }

/***************************************************************
 *** FUNCION PARA GUARDAR **
 ***************************************************************/
    public static function actualizaritemfacturacompra($items,$ultimafactura)
    {
        try {
            $db       = Db::getConnect();
            $dbselect = Db::getConnect();
            //$campostraidos = $campos->getCampos();
            $items = explode(",", $items);
            foreach ($items as $key => $despachounico) {
                $update = $db->prepare('UPDATE cotizaciones_item SET
                                id_factura=:id_factura
                                WHERE id=:despachounico');
                $update->bindValue('id_factura', utf8_encode($ultimafactura));
                $update->bindValue('despachounico', utf8_encode($despachounico));
                $update->execute();
            }
            return $ultimafactura;
        } catch (PDOException $e) {
            echo '{"error al guardar la configuraciónes ":{"text":' . $e->getMessage() . '}}';
        }
    }
/***************************************************************
*** FUNCION PARA GUARDAR INGRESO DE PAGO DE ORDEN DE COMPRA **** 
***************************************************************/
public static function pagotemporal($id,$valor,$fecha_registro,$estado_pago,$creado_por,$marca_temporal){

	$V1=str_replace(".","",$valor);
		$V2=str_replace(" ", "", $V1);
		$valor_final=str_replace("$", "", $V2);
		$valornumero=(int) $valor_final;

	try {
		$db=Db::getConnect();

	$select=$db->query("INSERT INTO detalle_pagos_ordenescompra (compra_id,valor,fecha_registro,estado_pago,creado_por,marca_temporal) VALUES ('".utf8_encode($id)."','".utf8_encode($valor_final)."','".utf8_encode($fecha_registro)."','".utf8_encode($estado_pago)."','".utf8_encode($creado_por)."','".utf8_encode($marca_temporal)."')");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}





/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function sqlvalor($id){
	try {
		$db=Db::getConnect();
		$sql="SELECT valor_total FROM ordenescompra WHERE id='".$id."'";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['valor_total'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function sqlfecha($id){
	try {
		$db=Db::getConnect();
		$sql="SELECT fecha_reporte FROM ordenescompra WHERE id='".$id."'";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['fecha_reporte'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function sqlretencion($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT valor_retenciones FROM ordenescompra WHERE id='".$id."'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['valor_retenciones'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function sqliva($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT valor_iva FROM ordenescompra WHERE id='".$id."'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['valor_iva'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function sqlproveedor($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT proveedor_id_proveedor FROM ordenescompra WHERE id='".$id."'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['proveedor_id_proveedor'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function sqlabonos($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT IFNULL(sum(valor),0) as Abonos FROM detalle_pagos_ordenescompra WHERE compra_id='".$id."' and estado_pago='1'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['Abonos'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function sqlabonostemporal($id,$fecha_registro){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT IFNULL(sum(valor),0) as Abonos FROM detalle_pagos_ordenescompra WHERE compra_id='".$id."' and estado_pago='0' and fecha_registro='".$fecha_registro."'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['Abonos'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA OBTENER LA LISTA DE ABONOS	  **
********************************************************/
public static function obtenerListaAbonos($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("SELECT * FROM detalle_pagos_ordenescompra WHERE compra_id='".$id."' and estado_pago='1'");
    	$campos=$select->fetchAll();
		$camposs = new Compras('',$campos);
		$campostraidos = $camposs->getCampos();
		return $campostraidos;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR EL NOMBRE DEL PRODUCTO **
********************************************************/
public static function obtenerUltimosEgreso($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT id_egreso_cuenta FROM egresos_cuenta WHERE cuenta_id_cuenta='".$id."'  order by id_egreso_cuenta desc limit 1");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['id_egreso_cuenta'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR EL NOMBRE DEL PRODUCTO **
********************************************************/
public static function obtenerUltimafacturacompra($id){
	try {
		$db=Db::getConnect();
		$sql = "SELECT id FROM facturas_compras_total WHERE proveedor_id_proveedor='".$id."' and factura_publicada='1' order by id desc limit 1";
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['id'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR EL NOMBRE DEL EQUIPO **
********************************************************/
public static function obteneridproveedorcompra($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("SELECT proveedor_id_proveedor FROM ordenescompra WHERE id='".$id."'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['proveedor_id_proveedor'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR EL NOMBRE DEL EQUIPO **
********************************************************/
public static function obtenervalorcotizado($insumo_id,$cotizacion_item_id,$idproveedor,$estado){
	try {
		$db=Db::getConnect();
		$sql="SELECT vr_unitario FROM cotizaciones_item WHERE insumo_id_insumo='".$insumo_id."' and id='".$cotizacion_item_id."' and proveedor_id_proveedor='".$idproveedor."' and estado_cotizacion='".$estado."'";
		//echo($sql);
		$select=$db->query($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['vr_unitario'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function sqlvalortotalordencompra($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT IFNULL(sum(valor_cot),0) as total FROM cotizaciones_item WHERE ordencompra_num='".$id."'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['total'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
*** FUNCION PARA GUARDAR INGRESO DE PAGO DE ORDEN DE COMPRA **** 
***************************************************************/
public static function actualizarvalorfinal($id,$valornuevo){
	try {
		$db=Db::getConnect();

	$select=$db->query("UPDATE ordenescompra SET valor_total='".$valornuevo."' WHERE id='".$id."'");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/***************************************************************
*** FUNCION PARA GUARDAR INGRESO DE PAGO DE ORDEN DE COMPRA **** 
***************************************************************/
public static function log($usuario_creador, $logdetalle,$modulo){

	try {
		$db=Db::getConnect();

date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');


	$select=$db->query("INSERT INTO log_usuarios (usuario_creador,marca_temporal,log_detalle,log_modulo) VALUES ('".utf8_encode($usuario_creador)."','".utf8_encode($TiempoActual)."','".utf8_encode($logdetalle)."','".utf8_encode($modulo)."')");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function contadoritemscotizacion($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT count(id) as total FROM cotizaciones_item WHERE ordencompra_num='".$id."' and estado_cotizacion='2'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['total'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/***************************************************************
** FUNCION PARA ELIINAR POR ID  **
***************************************************************/
public static function RetornarItemcotizado($id){
	try {
		$db=Db::getConnect();
		$select=$db->query("UPDATE cotizaciones_item SET ordencompra_num='0', estado_cotizacion='1'  WHERE id='".$id."'");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function cantidadcargada($ordencompra_num,$insumo_id_insumo){
	try {
		$db=Db::getConnect();
		$sql="SELECT IFNULL(sum(cantidad),0) as total FROM detalle_entrada_ins WHERE  oc_id='".$ordencompra_num."' and insumo_id='".$insumo_id_insumo."' and estado_detalle_entrada='1'";
		$select=$db->query($sql);
		//echo($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['total'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function cantidadcargadaser($ordencompra_num,$servicio_id_servicio){
	try {
		$db=Db::getConnect();
		$sql="SELECT IFNULL(sum(cantidad),0) as total FROM detalle_entrada_ins WHERE  oc_id='".$ordencompra_num."' and servicio_id='".$servicio_id_servicio."' and estado_detalle_entrada='1'";
		$select=$db->query($sql);
		//echo($sql);
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['total'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function comprasporproveedor($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT IFNULL(sum((valor_total-valor_retenciones)+valor_iva),0) as totales FROM ordenescompra WHERE proveedor_id_proveedor='".$id."' and estado_orden<>'0'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['totales'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function sumavaloresrelacion($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT IFNULL(sum(valor_egreso),0) as total FROM egresos_cuenta WHERE relacion_id_relacion='".$id."'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['total'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}


/***************************************************************
** FUNCION PARA ELIINAR POR ID  **
***************************************************************/
public static function 	Actualizarlopagado($valor,$relacion){
	try {
		$db=Db::getConnect();
		$select=$db->query("UPDATE detalle_pagos_proyectados SET valor_pagado='".$valor."' WHERE id='".$relacion."'");
		if ($select){
			return true;
			}else{return false;}
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function ordenesasociadasafactura($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT id FROM ordenescompra WHERE id_factura_compra='".$id."'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $mar.$marca['id'].",";
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}

/*******************************************************
** FUNCION PARA MOSTRAR  **
********************************************************/
public static function sqlabonosfactura($id){
	try {
		$db=Db::getConnect();

		$select=$db->query("SELECT IFNULL(sum(valor),0) as Abonos FROM detalle_pagos_ordenescompra WHERE factura_id_factura='".$id."' and estado_pago='1'");
    	$camposs=$select->fetchAll();
    	$campos = new Compras('',$camposs);
    	$marcas = $campos->getCampos();
		foreach($marcas as $marca){
			$mar = $marca['Abonos'];
		}
		return $mar;
	}
	catch(PDOException $e) {
		echo '{"error en obtener la pagina":{"text":'. $e->getMessage() .'}}';
	}
}






}

?>
