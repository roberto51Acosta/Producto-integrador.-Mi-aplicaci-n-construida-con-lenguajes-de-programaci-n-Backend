<?php
include_once 'config/Database.php';
include_once 'class/usuario.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($user->loggedIn()) {
	header("Location: Mgaleria.php");
}

$loginMessage = '';
if (!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
	$user->email = $_POST["email"];
	$user->password = $_POST["password"];
	if ($user->login()) {
		header("Location: Mgaleria.php");
	} else {
		$loginMessage = 'Información incorrecta.';
	}
}
?>
<title>Galería</title>
<div class="container">
	<h2>Sistema de Galería Dinámica</h2>
	<br>
	<br>
		<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
			<fieldset>
				<legend>Ingresa tus credenciales</legend>
				<?php if ($loginMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>
				<?php } ?>
				<div class="form-group">
					<label for="name">Correo</label>
					<input type="text" name="email" placeholder="Tu correo" required class="form-control" />
				</div>
				<div class="form-group">
					<label for="name">Contraseña</label>
					<input type="password" name="password" placeholder="Tu contraseña" required class="form-control" />
				</div>
				<div class="form-group">
					<input type="submit" name="login" value="Acceder" class="btn btn-primary" />
				</div>
			</fieldset>
		</form>
</div>