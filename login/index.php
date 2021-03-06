<?php
require_once '../includes/classes.php';
	
$userSession = new UserSession();
$errorLogin='';

if(isset($_SESSION['user'])){
    header('location: ../dashboard');
}else if(isset($_POST['user']) && isset($_POST['password'])) {
    $username = $_POST['user'];
    $password = md5($_POST['password']);
    $id=User::exists($username,$password);
    
    if($id){
    	$_SESSION['user'] = $id;
    	header('location: ../dashboard');
    }else{
    	$errorLogin='Nombre de usuario o contraseña incorrecto';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | Awesome Tourney</title>
	<link rel="shortcut icon" href="../images/favicon.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/login.css">
</head>

<body class="d-flex flex-column h-100 bg-<?php if($dark) echo 'dark'; else echo 'light';?>">
	<?php include '../fragments/menu.php'; ?>
	<div class="container">
		<div class="row">
			<div class="slider col-lg-8">
				<img id="slider-img" src="../images/slider-image1.png">
			</div>

			<div class="col-lg-4">
				<div class="aside-login">
					<h3 class="login-title">Iniciar sesión</h3>
					<?php echo $errorLogin;?>
					<form method="POST">
						<div class="login-fields">
							<div class="form-group">
								<label for="input-user">Nombre de usuario</label>
							    <input type="text" class="form-control" id="input-user" placeholder="Nombre de usuario" required maxlength="48" name="user">
							</div>

							<div class="form-group">
								<label for="input-password">Contraseña</label>
							    <input type="password" class="form-control" id="input-password" placeholder="Contraseña" required maxlength="32" minlength="8" name="password">
							</div>
						</div>

						<div class="login-button">
							<button id="login-button" class="btn btn-block btn-outline-primary" onclick="login()">
								<div class="img-button">
									<img src="../images/Icon awesome-play.png">
									<span class="text-button">Ingresar</span>
								</div>
							</button>
						</div>
					</form>
					<div class="recover-password">
						<a href="#">¿Has olvidado tu contraseña?</a>
					</div>

					<div class="signin-button">
						<button type="button" class="btn btn-block btn-outline-secondary" data-toggle="modal" data-target="#modal-signin">¡Crear una cuenta!</button>
					</div>		
				</div>
			</div>
		</div>
	</div>
	<div id="modal-signin" class="modal fade bd-example-modal-lg">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content bg-<?php if($dark) echo 'dark'; else echo 'light';?>">
				<div class="modal-header">
	        		<h5 class="modal-title" id="exampleModalLabel">Registrarse</h5>

	        		<button type="button" class="close" data-dismiss="modal">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
      			</div>

      			<div class="modal-body">
      				<form method="POST" action="insert_person.php">
      					<div class="form-group">
      						<label for="input-nickname">Nickname*</label>
      						<input class="form-control" placeholder="Nickname" type="text" name="nickname" id="input-nickname" required>
      					</div>
						
						<div class="form-group">
      						<label for="input-email">Email*</label>
      						<input class="form-control" placeholder="Email" type="text" name="email" id="input-email" required>
      					</div>

      					<div class="form-row">
      						<div class="form-group col-md-6">
      							<label for="input-password">Contraseña*</label>
      							<input class="form-control" placeholder="Contraseña" type="password" name="password" id="input-password" minlength="8" required>
      						</div>

      						<div class="form-group col-md-6">
      							<label for="input-rpassword">Repetir contraseña*</label>
      							<input class="form-control" placeholder="Repetir contraseña" type="password" name="rpassword" id="input-rpassword" required>
      						</div>
      					</div>

      					<div class="form-row" hidden>
      						<div class="form-group col-md-6">
      							<label for="input-names">Nombres</label>
      							<input class="form-control" placeholder="Nombres" type="text" name="names" id="input-names">
      						</div>

      						<div class="form-group col-md-6">
      							<label for="input-lnames">Apellidos</label>
      							<input class="form-control" placeholder="Apellidos" type="text" name="lnames" id="input-lnames">
      						</div>
      					</div>

      					<div class="form-group" hidden>
      						<label for="input-phone">Teléfono</label>
      						<input class="form-control" placeholder="Nombres" type="text" name="phone" id="input-phone">
      					</div>

      					<div class="form-group">
      						<div class="form-check">
      							<input class="form-check-input" type="checkbox" id="gridCheck" required>
      							<label class="form-check-label" for="gridCheck">
      								Acepto los <a href="/terms">terminos y condiciones de <strong>Awesome Tourney</strong></a>
      							</label>
      						</div>
      					</div>

      					<button class="btn btn-block btn-primary">Registrarse</button>
      				</form>
      			</div>
			</div>
		</div>
	</div>

	<?php include '../fragments/footer.php'; ?>

	<script type="text/javascript" src="/assets/js/dynamic.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script type="text/javascript" src="/assets/js/loginScript.js"></script>
</body>
</html>