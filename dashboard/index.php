<?php 
require_once '../includes/classes.php';
$userSession = new UserSession();
$user = new User();

if(!isset($_SESSION['user'])){
    header('location: ../login');
}

$user->charge($_SESSION['user']);
?>
<!DOCTYPE html>
<html class="h-100">
<head>
	<title>Dashboard | Awesome Tourney</title>
	<link rel="shortcut icon" href="/images/favicon.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
</head>

<body class="d-flex flex-column h-100 bg-<?php if($dark) echo 'dark'; else echo 'light';?>">
	<?php include '../fragments/menu.php'; ?>
	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<label><h1>Torneos</h1></label>
			</div>

			<div class="col-lg-7">
				<div class="row">
					<div class="col-lg-4">
						<a href="/tourney?">
							<div class="card <?php if($dark) echo 'bg-dark text-white';?>">
								<div class="card-body">
									<img src="/images/tourney/default/prime.png" style="width: 100%; height: 80px;" alt="Alt de imagen">
								</div>
								<div class="card-footer">Titulo de prueba</div>
							</div>
						</a>
						<div class="col-lg-7 separator"></div>
					</div>
				</div>

				<div class="col-lg-7 separator"></div>
			</div>


			<div class="col-lg-5">
				<div class="card <?php if($dark) echo 'bg-dark text-white';?>">
					<div class="card-header">
						<strong>Tus torneos</strong>
					</div>

					<div class="card-body">
					<?php 
					if(count($user->getTournaments()) != 0): 
						$db=new Database();
						foreach ($user->getTournaments() as $tournament):?>
							<a class="btn <?php if($dark) echo 'btn-dark'; else echo 'btn-light';?> btn-block" href="/tourney?id=<?php echo $tournament->getId(); ?>">
								<?php echo $tournament->getName(); ?>
							</a>
					<?php 
						endforeach;
					else:
					?>
						No tienes torneos activos
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include '../fragments/footer.php'; ?>
	
	<script type="text/javascript" src="/assets/js/dynamic.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>