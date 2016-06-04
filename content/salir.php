<?php 
/**
 *	salir.php
 *
 *	al loguear, guardo diferentes variables en
 *	el array de $_SESSIÓN
 * 	aquí simplemente libero esas variables
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>


<?php
$url = pillaURL();
unset($_SESSION['id_usuario']);
unset($_SESSION['user']);
unset($_SESSION['email']);
unset($_SESSION['nivel']);
unset($_SESSION['token']);


header("location: index.php?content=home");
