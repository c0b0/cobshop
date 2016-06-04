<?php 
/**
 * recuperar_password.php
 *
 * pagina para mostrar el formulario para hacer login
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>


<?php 
$email = isset($_POST['email']) ? $email = $_POST['email'] : $email = '';
$password = isset($_POST['password']) ? $password = $_POST['password'] : $password= '';
?>

<form action="index.php?content=recuperar_password" method="post" name="login" id="passRecover" enctype="multipart/form-data">
	
	<table id="formulario">
		<tr>
			<td>Introduzca su dirección de correo electrónico</td>
			<td><input type="text" name="email" id="email" value="" autofocus required/></td>
		</tr>

	</table>
	
<?php 
//creo un token
$salt = 'SomeSalt';
$token = sha1(mt_rand(1, 1000000) . $salt);
$_SESSION['token'] = $token;
?>


<input type="hidden" name="token" value='<?php echo $token; ?>' />
<input type="submit" name="enviar" value="Enviar" />
<input type="hidden" name="task" value="resetea.password" />
<a class="btnCancel" href="index.php?content=home">Cancelar</a>
</form>
