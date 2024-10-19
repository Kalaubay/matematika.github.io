<?php session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$homeTask = $_POST['homeTask'] ?? '';

	$errors = [];

	if(empty($homeTask)){
		$errors['homeTask'] = 'Home task is empty';
	}

	if($errors){
			$_SESSION['status'] = 'error';
        	$_SESSION['errors'] = $errors;
        	header('Location:index.php');
		}
		else {
			require_once 'common/connect.php';
			$user = homeTask($homeTask);
	        	if($user['role'] == 'user')
	        		header('Location:index.php');
	        	else{
	        		header('Location:indexAdmin.php');
	        	}
		}


}

 ?>