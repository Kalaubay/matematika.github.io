<?php

	session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = $_POST['name'] ?? '';
		$phone = $_POST['phone'] ?? '';
		$email = $_POST['email'] ?? '';
		$password = $_POST['password'] ?? '';
		$confirm_password = $_POST['confirm_password'] ?? '';

		$errors = [];

		if(empty($name)){
			$errors['name'] = 'Name is empty';
		}

		if(empty($phone)){
			$errors['phone'] = 'Phone is empty';
		} elseif(strlen($phone) < 11 || strlen($phone) > 12){
			$errors['phone'] = 'Invalid phone format';
		}

		if(empty($email)){
			$errors['email'] = 'Email is empty';
		}
		else{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  				$errors['email'] = "Invalid email format";
		}

		if(empty($password)){
			$errors['password'] = 'Password is empty';
		}
		else{
			if(strlen($password) < 6){
				$errors['password'] = 'Password length should be at least 6 symbols';
			}
		}

		if(empty($confirm_password)){
			$errors['confirm_password'] = 'Password is empty';
		}
		else{
			if(strlen($confirm_password) < 6){
				$errors['confirm_password'] = 'Password length should be at least 6 symbols';
			}
		}

		if($confirm_password != $password){
			$errors['confirm_password'] = 'Passwords does not match';
		}

		

		if($errors){
			$_SESSION['status'] = 'error';
        	$_SESSION['errors'] = $errors;
        	header('Location:registerForm.php');
		}
		else {
			require_once 'common/connect.php';
			$result = registerUser($email, $password, $name, $phone);

			if($result){
				$_SESSION['status'] = 'success';
	        	$_SESSION['message'] = 'You have registered';
	        	header('Location:loginForm.php');
			}
			else{
				$_SESSION['status'] = 'error';
	        	$_SESSION['errors'] = ['email' => 'This email is in use'];
	        	header('Location:registerForm.php');
			}
		}
	}

?>