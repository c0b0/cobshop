<?php 
/**
 * login.php
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

<form action="index.php?content=login" method="post" name="login" id="login" enctype="multipart/form-data">
	
	<table id="formulario">
		<tr>
			<td>Email</td>
			<td><input type="text" name="email" id="email" value="" autofocus/></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" id="password" value=""/></td>
		</tr>
		<tr>
			<td style="font-size: 0.8em;"><a href="index.php?content=recuperar_password">He olvidado mi password</a></td>
		</tr>
	</table>
	
<?php 
//creo un token
$salt = 'SomeSalt';
$token = sha1(mt_rand(1, 1000000) . $salt);
$_SESSION['token'] = $token;
?>


<input type="hidden" name="token" value='<?php echo $token; ?>' />
<input type="submit" name="login" value="Log In" />
<input type="hidden" name="task" value="usuario.login" />
<a class="btnCancel" href="index.php?content=home">Cancelar</a>
</form>
