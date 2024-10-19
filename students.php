<?php

session_start();

require_once 'common/checkAdmin.php'; 
require_once 'common/connect.php'; 

// Студенттерді алу
$students = students();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Students</title>
	<?php require_once 'common/inhead.php'; ?>
	<style>
	 	.information {
	 		display: flex;
	 		justify-content: space-between;
	 	}
	 	.remove-course {
	 		display: flex;
	 		justify-content: end;
	 	}
	</style>
</head>
<body>
	<?php require_once 'common/navAdmin.php' ?>

	<?php
	$hasErrors = false; 
	if(isset($_SESSION['status']) && $_SESSION['status'] == 'error')
		$hasErrors = true;
	?>

	<div class="container mt-5">
		<div class="remove-course">
			<form action="removeCourse.php" method="post">
				<?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'successs'): ?>
    				<div class="success">
        				<?= htmlspecialchars($_SESSION['message']); ?> 
    				</div>
    				<?php endif; ?>
    
				<div class="remove_id_user">
					<label class="form-label" for="">ID</label>
					<input class="form-control" type="number" name="remove_id_user" id="remove_id_user" class="remove_id_user">
					<?php if($hasErrors && isset($_SESSION['errors']['remove_id_user'])): ?>
						<p class="inputError"><?= $_SESSION['errors']['remove_id_user'] ?></p>
					<?php endif; ?>
				</div>
				<div class="remove_course_user">
					<label class="form-label" for="">Course</label>
					<input class="form-control" type="text" name="remove_course_user" id="remove_course_user" class="remove_course_user">
					<?php if($hasErrors && isset($_SESSION['errors']['remove_course_user'])): ?>
						<p class="inputError"><?= $_SESSION['errors']['remove_course_user'] ?></p>
					<?php endif; ?>
				</div>
					<button type="submit" class="btn btn-success mt-4 px-3"> Save </button>
			</form>
		</div>
		<div class="title">
			<h3>
				Студенттер
			</h3>
		</div>
		<div class="block">
			<div class="information">
				<div class="user-id">
					<h4>ID</h4>
				</div>
				<div class="user-name">
					<h4>Name</h4>
				</div>
				<div class="user-email">
					<h4>Email</h4>
				</div>
				<div class="user-role">
					<h4>Course</h4>
				</div>
				<div class="user-phone">
					<h4>Phone</h4>
				</div>

			</div>
			<hr>
			<?php foreach($students as $user): ?>
			<div class="information">
				<div class="user-id">
					<p><?= htmlspecialchars($user['id']); ?></p>
				</div>
				<div class="user-name">
					<p><?= htmlspecialchars($user['name']); ?></p>
				</div>
				<div class="user-email">
					<p><?= htmlspecialchars($user['email']); ?></p>
				</div>
				<div class="user-role">
					<p><?= htmlspecialchars($user['cours']); ?></p>
				</div>
				<div class="user-phone">
					<p><?= htmlspecialchars($user['phone']); ?></p>
				</div>
			</div>
			<hr>
			<?php endforeach; ?>
		</div>
	</div>



	<?php

	unset($_SESSION['status']);
	unset($_SESSION['errors']);
	unset($_SESSION['message']);

	?>

</body>
</html>
