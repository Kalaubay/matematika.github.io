<?php require_once 'common/inhead.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>it-stadu</title>
	<link rel="stylesheet" href="">
	<style>
		.header{
			display: flex;
			justify-content: space-around;
		}
		.bttn {
			display: flex;
			justify-content: space-between;
		}
		.number > a {
			border-radius: 18px;
		}

		.loginForm > a {
			border-radius: 18px;
		}
	</style>
</head>
<body class="container" >
	<div class="header mt-4">
		<div class="logo">
			<h3>
				It-stadu
			</h3>
		</div>
		<div class="bttn">
			<div class="number">
				<a class="btn btn-primary mx-4" href="">8(707)767-9751</a>
			</div>
			<div class="div loginForm">
				<a class="btn btn-success" href="loginForm.php">Порталға кіру</a>
			</div>
		</div>
	</div>
	<hr>
</body>
</html>