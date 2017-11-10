<?php 
include("inc.aplication_top.php");
include(_includes_."inc.header.php");
$secciones = new Secciones();
?>
<body>
    
<div id="window">
    
  <header>
     <?php include(_includes_."inc.top.php"); ?>
  </header>
    
  <?php if ($_SESSION['usuario']==TRUE){
  	$secciones->home();
  }else{
  	$secciones->login();
  }
  ?>

    
  <footer>
     <?php include(_includes_."inc.bottom.php"); ?>	 
  </footer> 
    
</div>
    
</body>
</html>
<?php include("inc.aplication_bottom.php");?>