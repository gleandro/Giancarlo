<?php 
class Catalogo{

	var $_items_x_pagina = 100;

	function __construct(){ }

	function Contenido(){

		if(!isset($_GET['pag'])){ $_GET['pag'] = 1; }
		$tampag = $this->_items_x_pagina;
		$reg1 	= ($_GET['pag']-1) * $tampag;
		$tmplweb= "index.php?cat=".$_GET['cat'];
		$del = $reg1 + 1;
		$hasta 	= $reg1 + $this->_items_x_pagina;

		//INICIALIZO VARIABLES DE SOPORTE

		$fromC  = "";
		$fromP  = "";
		$fromA  = "";
                $fromL  = "";
		$where = "";

		//verifico si ha sido una busqueda

		$filtroC = "";
		$filtroP = "";
		$filtroA = "";
                $filtroL = "";

		//verifico si hay filtro por categoria

		$cCat = "";
		$pCat = "";

		//armo los parametros para filtrar por defecto las ofertas si es que no hay VARIABLES GET		

		if(!isset($_GET['cat'])){
			$cCat  = " AND id_parent = '0' ";
			$sProd = " AND id_categoria = '0' ";
		}

		if(isset($_GET['cat'])){
			$sProd = " AND id_categoria = '".$_GET['cat']."' ";
			$sCat = " AND id_parent = '".$_GET['cat']."' ";
		}
		
		$sqlc = "SELECT id_categoria FROM categorias
				 WHERE id_categoria > '0' 
				 ".$cCat."
				 ".$sCat."				 
				 GROUP BY id_categoria
				 ORDER BY orden_categoria";
				
		$sqlp = "SELECT id_producto FROM productos
				 WHERE id_producto != 0
				 ".$sProd."
				 GROUP BY id_producto ORDER BY orden_producto";
				
	//echo $_GET['cat'];
	//echo $sqlc;
	
	//echo "<br>";
	//echo $sqlp;

		$queryc = new Consulta($sqlc);
		$queryp = new Consulta($sqlp);
		

		$numc = $queryc->NumeroRegistros();
		$nump = $queryp->NumeroRegistros();
		$row_res_pag = $numc + $nump  ;

		$cats = array();
		

		while($rowc = $queryc->VerRegistro()){
			$cats[] = array('id'=>$rowc['id_categoria']);
		}

	
		//$prods="";
		$prods = array();

		while($rowp = $queryp->VerRegistro()){
			$prods[] = array( 'id' =>	$rowp['id_producto']);

		}
		
	
		$content = array($cats, $prods, $reg1, $hasta, $_GET['pag']);
		return $content;
	}

}
?>