<?php 

/**
 * Conexión a la base de datos 
 */
class conexion extends PDO
{

	private $hostBd ='localhost';
	private $nombreBd ='u732693446_equipos';
	private $usuariotBd ='u732693446_equipos';
	private $passwordBd ='Teksystem@80761478';

	public function __construct()
	{
		try {

			parent::__construct('mysql:host='.$this->hostBd.';dbname='.$this->nombreBd.';charset=utf8',$this->usuariotBd,$this->passwordBd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			
		} catch (PDOException $e) {
			echo 'Error:'.$e->getMessage();
		}
		
	}
}

 ?>