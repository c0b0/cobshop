<?php 
require_once 'includes/init.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="images/iconos/fav.icon" type="image/x-icon" rel="shortcut icon" />
<title>CobShop</title>
</head>
<body>


<div id="contenedor"><!-- Contenedor -->

		
		<a href="index.php?content=home"><div id="header"><!-- Header -->

		</div></a><!-- Fin de Header -->

		<div id="barra">
			
			<?php include 'content/barra.php'; ?>
						
		</div>


		<div id="nav"><!-- Menú de navegación -->

			<?php include 'content/menu_nav.php';?>
			
			

			
			
			<div id="rrss">
				
				<a href="https://www.facebook.com/groups/252040451853849"><img class="noShadow" alt="#" src="images/iconos/facebook.png"></a>
				<a href="https://twitter.com/Cobo_Morera"><img class="noShadow" alt="#" src="images/iconos/twitter.png"></a>
			
			</div>
			
			
			<div id="twitter">
			           
          
			</div>
			
			
			
			
		</div><!-- Fin de Menú de navegación -->
		



		<div id="contenido"><!-- Contenido principal -->
			<!-- poner aquí para ver las variables globales -->

			<!-- fin de la zona para ver las variables -->		
			<div id="mensaje"><?php echo $message; ?></div>
			<?php loadContent();?>
			
		
					
		</div><!-- Fin de Contenido principal -->
		

		
</div><!-- Fin del Contenedor -->
</body>
</html>
