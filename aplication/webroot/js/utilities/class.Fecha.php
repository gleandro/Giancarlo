<?php

class Fecha{
	
	var $date; 	
	
	function Fecha($date){
		
	}
	
	static public function formatoDate($comodin,$fecha){
		$nfecha=explode($comodin,$fecha);
		$dia=$nfecha[0];
		$mes=$nfecha[1];
		$a�o=$nfecha[2];
		$ufecha=$a�o."-".$mes."-".$dia;
		return $ufecha;
	}

	function formatoSlash($comodin,$fecha){
		$nfecha=explode($comodin,$fecha);
		$dia=$nfecha[2];
		$mes=$nfecha[1];
		$a�o=$nfecha[0];
		$ufecha=$dia."/".$mes."/".$a�o;
		return $ufecha;
	}
}

 ?>