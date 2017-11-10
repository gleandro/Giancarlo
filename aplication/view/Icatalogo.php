<?php 
class Icatalogo extends Catalogo{

	private $k = 1;
	private $_archivo = "productos.php";
	
	
	public function __construct(){
     
	}

	function listado(&$rows){

		$content = $this->Contenido();	
		

		$cats    = $content[0];
		$prods   = $content[1];
		$desde   = $content[2];
		$hasta   = $content[3];
		$pag     = $content[4];
               

		$x = 0;		

		//suma de productos y categorias
		$rows = sizeof($cats) + sizeof($prods);

		//saco en cuantas paginas salen de la cantidad de actegorias, segun items por pagina
		$pagscat = ceil(sizeof($cats) / $this->_items_x_pagina);	

		//primer registro de categoria 
		$preg_cats = ($pag - 1) * $this->_items_x_pagina ;

		//si la pagina actual es menor o igual a las paginas de la categoria 
		if($pag <= $pagscat){	
			$y = 0;		
		}else{		
			$cat_rest = sizeof($cats) - $preg_cats;				
			$pagsprod = ceil(sizeof($prods) / $this->_items_x_pagina);	
			$preg_prods = ($pag-1)* $this->_items_x_pagina;
			$y = $cat_rest - ($cat_rest + $cat_rest);	
		}

		//si existe un array de items en categorias o productos 

		if(is_array($cats) || is_array($prods)){

			// cuadno hay categorias que pinte categorias 
			if(is_array($cats) && count($cats)>0){
				
				if( isset($_GET['cat']) && !empty($_GET['cat']) ){
					// Tiene productos la categoria
					// Si la categoria tiene productos entoncs es una marca
					
					$catt = new Categoria($_GET['cat']);
					$catp = new Categoria($catt->__get('_parent'));
					$catr = new Categoria($catp->__get('_id'));

					if( $catr->__get('_parent') == '' ){
						$id_article = 'productos';
							$articlei= '<article class="producto rollover">';									
							$articlef= "</article>";
					}else{
						$id_article = 'categorias';	
							$articlei= '<article class="categoria rollover">';									
							$articlef= "</article>";
					}

				}else{
					$id_article = 'categorias';
						$articlei= '<article class="categoria rollover">';									
						$articlef= "</article>";
				}

				?>

                <section id="<?php echo $id_article; ?>">
                    <?php					
                        for($c = $desde; $c < $hasta; $c++){ 								
							if($c < sizeof($cats)){ 									
								echo $articlei;
									echo $this->categoria($cats[$c]['id']); 
								echo $articlef;
							}
							$x++;	
                        }
                    ?>
                </section>
				<?php
			}
			
			// cuadno hay productos que pinte productos 
			if(is_array($prods) && count($prods)>0 ){
			$categoria = new Categoria($_GET['cat']);
			?>
			<div id="detalle-left">
				<figure>
					<?php if($categoria->__get('_imgdetalle') == "detalle_" || $categoria->__get('_imgdetalle') == "" ){ ?>
	            		<img src="aplication/webroot/imgs/imagen_nodisponible.jpg" alt="">
	                <?php }else{?>
		            	<img src="<?php echo _catalogo_.$categoria->__get("_imgdetalle") ?>" />
	                <?php }?>
				</figure>
			</div>   
            <div id="detalle-descripcion">
				<?php
					for($c = $desde; $c < $hasta; $c++){ 				 
						if(isset($prods[$y]['id'])) {
							echo $this->producto($prods[$y]['id']);	
							$y++;
						}     
						$x++;				
					}
				?>
            </div>

			
			<?php						
			}

		}
		//echo $this->k++;
	}	

	function cuerpo(){
	?>
		<?php

		if(isset($_GET['prod']) && !empty($_GET['prod'])){				

			$this->detalle($_GET['prod']);

		}else{ 

			$rows = 0; 					
			$this->listado($rows); 
			
			$pagina = $_GET['pag'] - 1;
			?>			
			
			<div class="clear"></div>
            <input type="hidden" id="total_v" value="<?php //echo $rows ?>" />
            <input type="hidden" id="desde_v" value="<?php //echo (($pagina * 2) +1) ?>" />
            <input type="hidden" id="total_page" value="<?php //echo ($pagina * 2) ?>" />
        	
			<?php			
			if($rows > $this->_items_x_pagina){ $this->paginado($rows); } 
		} ?>

		<?php 

	}

 	function producto($id){
		$producto = new Producto($id);	
		?>	
            <article class="descripcion">
            		<h3><?php echo $producto->__get('_nombre'); ?></h3>
            		<div><?php echo $producto->__get('_descripcion'); ?></div>
            </article>

        <?php
	
	}

	function categoria($id){ 
		$categoria = new Categoria($id);		
		$catp = new Categoria($categoria->__get('_parent'));	
		?>	
			<figure>
				<a href="productos.php?cat=<?php echo $id; ?>">
					<?php if($categoria->__get('_thumb') == "thumb_" || $categoria->__get('_thumb') == ""){ ?>
	            		<img src="aplication/webroot/imgs/imagen_nodisponible_small.jpg" alt="">
	                <?php }else{?>
	                	<img src="<?php echo _catalogo_.$categoria->__get('_thumb')?>" alt="">
	                <?php }?>
				</a>
				<figcaption>
					<a href="productos.php?cat=<?php echo $id; ?>"><span><?php echo $categoria->__get('_nombre'); ?></span></a>
				</figcaption>
			</figure>
		<?php
    }

	
	
	function paginado($rows){
		
		$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;  
		$url = basename($_SERVER['PHP_SELF'])."?";
		$url .= isset($_GET['cat']) ? "cat=".$_GET['cat']."&" : "";
		$url .= isset($_GET['q']) ? "q=".$_GET['q']."&" : "";
		$url .= isset($_GET['promociones']) ? "promociones&" : "";
		$url .= "pag=";	?>
		<div id="paginacion" align="right"><?php echo paginar_catalogo($pag, $rows, $this->_items_x_pagina, $url);?></div>
		<?php	
		
	}

	function navegacion(){  

		$navegador = new NavegadorFront();
		$idp = isset($_GET['prod']) ? $_GET['prod'] : 0;
		$idc = isset($_GET['cat'])  ? $_GET['cat']  : 0;
		$id_actual = $idp > 0 ? $idp : $idc;
		$navegador->bucleCatTrail($idc, $idp);		
		return  $navegador->display($id_actual);

	}	
	
	function categoryActual(){  

		$navegador = new NavegadorFront();
		$idp = isset($_GET['j']) ? $_GET['j'] : 0;
		$idc = isset($_GET['cat'])  ? $_GET['cat']  : 0;
		$id_actual = $idp > 0 ? $idp : $idc;
		$navegador->bucleCatTrail($idc, $idp);		
		return  $navegador->dislplayCategoria();

	}



} ?>