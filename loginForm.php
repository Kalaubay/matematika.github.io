<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login form page</title>
	<?php require_once 'common/inhead.php'; ?>
	<style>
		body {
			background-color: rgba(0, 0, 0, 0.03);
		}
		a {
			text-decoration: none;
			color: black;
		}
		.big-container{
			display: flex;

		}
		.login-control {
			margin-top: 60px;
			width: 50%;
		}
		.welcome-page {
			margin-top: 80px;
		}
		.text-page {
			justify-content: center;
			align-items: center;
		}
		.phone-photo > img {
			width: 200px
		}
		/*.txt-page {
			display: flex;
			justify-content: space-between;
		}*/
		.cont {
			display: flex;
			align-items: center;
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
	<div class="big-container">
		<div class="login-control">
			<div class="">
				<div class="row justify-content-center">
					<div class="col-md-7">
						<div class="card mt-4">
							<?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'success'): ?>
								<div class="success text-center">
									<?= $_SESSION['message'] ?>
								</div>
							<?php endif; ?>

							<?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'mainError'): ?>
								<div class="mainError text-center mb-2">
									<?= $_SESSION['message'] ?>
									<i class="fa-regular fa-circle-xmark" onclick="this.parentElement.remove()"></i>
								</div>
							<?php endif; ?>

							<form action="login.php" method="POST">
								<h3 class="text-center pt-4">Cайтқа кіру</h3>
								<div class="field-group mt-4 text-center p-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" name="email" id="email" class="form-control">
									<?php if($hasErrors && isset($_SESSION['errors']['email'])): ?>
										<p class="inputError"><?= $_SESSION['errors']['email'] ?></p>
									<?php endif; ?>
								</div>
								<div class="field-group text-center p-3">
									<label for="password" class="form-label">Password</label>
									<input type="password" name="password" id="password" class="form-control">
									<?php if($hasErrors && isset($_SESSION['errors']['password'])): ?>
										<p class="inputError"><?= $_SESSION['errors']['password'] ?></p>
									<?php endif; ?>
								</div>
								<div class="text-center my-4">    
		                            <button type="submit" class="btn btn-primary py-1 px-5">Кіру</button>
		                        </div>
							</form>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-7">
						<div class="card my-4">
		                    <div class="card-body text-center">
		                        <a href="registerForm.php" class="btn btn-success py-1 px-5">Тіркелу</a>
		                        <p class="mt-2">Тіркеліп, сіз Page ID-дың барлық мүмкіндігіне қол жеткізесіз.</p>
		                    </div>
		                </div>
					</div>
				</div>
			</div>
		</div>
		<div class="welcome-page">
			<div class="row justify-content-center">
				<div class="col-md-11">
					<div class="txt-page card p-5">
						<div class="cont">
							<div class="text">
								<a href="">
									<h3>Сайт туралы</h3>
									<p>барлық ақпаратты осы жерден <br> ала аласыз...</p>
								</a>
							</div>
							<div class="phone-photo">
								<img src="images/images.png" alt="">
							</div>
						</div>
					</div>
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