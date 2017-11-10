<?php 
class Upload{

	public function upload_imagen($nombre, $temp, $destino, $tarchivo, $tamano ){		
		$extencion = ext($nombre);		
		if( (($extencion != "jpg") && ($extencion != "jpeg") && ($extencion != "png") )){
			return -1;
		}else if($tamano > 2500000){
			return -2;
		}else if(move_uploaded_file($temp,$destino.$nombre))	
			return true;
		else
			return false;
		
					
		//move_uploaded_file($temp,$destino.$nombre);	
	}
	
	public function upload_file($nombre, $temp, $destino, $tarchivo, $tamano){
		$extencion = ext($nombre);
		if($tamano > 2500000){
				echo "<div id=error>La extensión o el tamaño ".$tamano * 1024 ." del archivo no valida.</div>"; 
		}else if(($extencion == "pdf") || ($extencion == "doc") || ($extencion == "docx") ||  ($extencion == "jpeg") ||  ($extencion == "jpg") || ($extencion == "xlsx") || ($extencion == "xls")){
				
			if(move_uploaded_file($temp,$destino.$nombre)){	
				return true;	
															
			}else{
				return false;
				
			}	
					
		}
		
		else{
			echo "<div id=error>La extensión no es valida ( Solo se permiten archivos PDF, Word, JPG   )</div>"; 
		}			
	}	
}
?>