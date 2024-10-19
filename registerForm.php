<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register form page</title>
	<?php require_once 'common/inhead.php'; ?>
	<style>
		body {
			margin-top: 70px;
			background-color: rgba(0, 0, 0, 0.03);
		}
		.btn-reg {
			width: 100%;
		}
	</style>
	
</head>
<body>

	<?php session_start(); ?>

	<?php
	$hasErrors = false; 
	if(isset($_SESSION['status']) && $_SESSION['status'] == 'error')
		$hasErrors = true;
	?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card mt-3 p-3">
					<?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'success'): ?>
						<div class="success">
							<?= $_SESSION['message'] ?>
						</div>
					<?php endif; ?>

					<form action="register.php" method="POST" enctype="multipart/form-data">
						<div class="field-group mt-4">
							<label for="name" class="form-label">Name</label>
							<input type="text" name="name" id="name" class="form-control">
							<?php if($hasErrors && isset($_SESSION['errors']['name'])): ?>
								<p class="inputError"><?= $_SESSION['errors']['name'] ?></p>
							<?php endif; ?>
						</div>
						<div class="field-group">
							<label for="phone" class="form-label">Phone number</label>
							<input type="text" name="phone" id="phone" class="form-control">
							<?php if($hasErrors && isset($_SESSION['errors']['phone'])): ?>
								<p class="inputError"><?= $_SESSION['errors']['phone'] ?></p>
							<?php endif; ?>
						</div>
						<div class="field-group">
							<label for="email" class="form-label">Email</label>
							<input type="email" name="email" id="email" class="form-control">
							<?php if($hasErrors && isset($_SESSION['errors']['email'])): ?>
								<p class="inputError"><?= $_SESSION['errors']['email'] ?></p>
							<?php endif; ?>
						</div>
						<div class="field-group">
							<label for="password" class="form-label">Password</label>
							<input type="password" name="password" id="password" class="form-control">
							<?php if($hasErrors && isset($_SESSION['errors']['password'])): ?>
								<p class="inputError"><?= $_SESSION['errors']['password'] ?></p>
							<?php endif; ?>
						</div>
						<div class="field-group">
							<label for="confirm_password" class="form-label">Confirm password</label>
							<input type="password" name="confirm_password" id="confirm_password" class="form-control">
							<?php if($hasErrors && isset($_SESSION['errors']['confirm_password'])): ?>
								<p class="inputError"><?= $_SESSION['errors']['confirm_password'] ?></p>
							<?php endif; ?>
						</div>
						
						<button type="submit" class="btn btn-success register_btn btn-reg mt-4" >Register</button>
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