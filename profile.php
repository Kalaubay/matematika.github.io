<?php
session_start();

	require_once 'common/checkAuth.php';

$user = $_SESSION['user'];
?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile page</title>

	<?php require_once 'common/inhead.php'; ?>
	<?php require_once 'common/connect.php'; ?>
	

	<style>
		body {
			margin-bottom: 100px;
		}
		.big-block > .block {
			margin: 0 auto;
		}
		.big-block > .title {
			margin: 0 auto;
		}
		.title {
			width: 600px;
			border: 1px solid #D3D3D3;
			box-shadow: 10px 10px 10px 10px #aaaaaa;
			border-radius: 10px 10px 0 0;
			background-color: #fff;
			text-align: center;
		}
		.block {
			width: 600px;
			border: 1px solid #D3D3D3;
			box-shadow: 10px 10px 10px 10px #aaaaaa;
			border-radius: 0 0 10px 10px;
			background-color: #fff;
		}
		.kyrs {
			color: #808080	;
			text-align: center;
			margin: 0;
			padding: 0;
		}
		.inf {
			display: flex;
			justify-content: space-between;
		}
	</style>

</head>
<body>
	 <?php
	    $userRole = $_SESSION['user']['role'];

	    if ($userRole == 'admin') {
	        require_once 'common/navAdmin.php';
	    } else {
	        require_once 'common/nav.php'; 
	    }
	?>
	<div class="container big-block">
		<div class="title mt-5">
			<?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'successEditProfile'): ?>
    				<div class="success">
        				<?= htmlspecialchars($_SESSION['message']); ?> 
    				</div>
    				<?php endif; ?>
			<h3 class="mt-3"> 
				About me
			</h3>
		</div>
		<div class="block">
			<div class="info-user mb-5" style="text-align: center; width: 400px; margin: 0 auto;">
				<h1 class="name mt-5">
					<?=$user['name']?>
				</h1>
				<div class="hard-work">
					<p class="kyrs">
						Курс:
					</p>
					<h5>
						<?=$user['cours']?>
					</h5>
				</div>
				<hr>
				<div class="inf">
					<p>Role</p>
					<h5><?=$user['role']?></h5>
				</div>
				<div class="inf">
					<p>email</p>
					<h5><?=$user['email']?></h5>
				</div>
				<div class="inf">
					<p>phone</p>
					<h5><?=$user['phone']?></h5>
				</div>
				<div class="inf">
					<p>age</p>
					<h5><?=$user['age']?></h5>
				</div>
				<div class="inf">
					<p>adres</p>
					<h5><?=$user['adres']?></h5>
				</div>
				<div class="edit">
					<form action="editProfile.php" method="post" class="text-center">
						<button class="btn btn-secondary my-5">
							Edit profil
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<?php

	unset($_SESSION['status']);
	unset($_SESSION['errors']);
	unset($_SESSION['message']);

	?>
</body>
</html>	