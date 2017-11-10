<?php
if(basename($_SERVER['PHP_SELF'])=="conexion.php")exit;
class Conexion{
	
	static $link	= 	0;
	var $host ;	
	var $user ;
	var $psw  ;
	var $db   ;

	public function Conexion($host, $user, $psw, $db){
		$this->host=	$host;
		$this->user=	$user;
		$this->psw	=	$psw;
		$this->db	=	$db;	
	
		self::$link = @mysqli_connect($this->host, $this->user, $this->psw, $this->db) or die(mysql_error() ."<div class='error_data'>error al conectarse al servidor</div>");
		if(!self::$link) {
			die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		}
		mysqli_query(self::$link,"SET NAMES 'utf8'");
		return self::$link;
	}
	public static function getInstance(){
		return self::$link;
	}
}
?>