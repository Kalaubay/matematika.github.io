<?php

	try {
		$pdo = new PDO("mysql:host=localhost;dbname=blog;", "root", "");
	}catch(PDOException $ex){
		echo $ex->getMessage();
	}

	function registerUser($email, $password, $name, $phone, $role='user', $cours='not-cours',$age='-', $adres='-'){

		global $pdo;
		$queryObj = $pdo->prepare("insert into users(email, password, name, role, cours, phone, age, adres) values(:ue, :up, :un, :ur, :ucours, :uphone, :uage, :uadres)");

		try {
			$queryObj->execute([
				'ue' => $email,
				'up' => $password,
				'un' => $name,
				'ur' => $role,
				'ucours' => $cours,
				'uphone' => $phone,
				'uage' => $age,
				'uadres' => $adres,
			]);
		}catch(PDOException $ex){
			echo $ex->getMessage();
			return false;
		}
		return true;
	}

	function loginUser($email, $password){
		global $pdo;
		$queryObj = $pdo->prepare("select * from users where email = :uemail and password = :upassword");

		$queryObj->execute([
			'uemail' => $email,
			'upassword' => $password
		]);

		$user = $queryObj->fetch(PDO::FETCH_ASSOC);
		return $user;

	}

	function getCategories(){
		global $pdo;
		$queryObj = $pdo->query("select * from categories");
		$categories = $queryObj->fetchAll(PDO::FETCH_ASSOC);
		return $categories;
	}

	function createPost($title, $content, $category_id, $user_id , $video, $test , $c_work ,$status='draft', $image='no-img.jpg'){

		global $pdo;
		$queryObj = $pdo->prepare("insert into posts(title, content, category_id, user_id, video, test, c_work ,status, image, created_at) values(:ptt, :pcn, :pci, :pui,:pvd, :tst, :cts, :pst, :pim, :pca)");

		date_default_timezone_set('Asia/Almaty');

		try {
			$queryObj->execute([
				'ptt' => $title,
				'pcn' => $content,
				'pci' => $category_id,
				'pui' => $user_id,
				'pvd' => $video,
				'tst' => $test,
				'cts' => $c_work,
				'pst' => $status,
				'pim' => $image,
				'pca' => date("Y-m-d H:i:s", time())
			]);
		}catch(PDOException $ex){
			echo $ex->getMessage();
			return false;
		}
		return true;
	}

	function getPosts($catId = null){
		global $pdo;

		if($catId){
			$queryObj = $pdo->prepare("select posts.*, users.name from posts left join users on posts.user_id=users.id where posts.category_id = ?");
			$queryObj->execute([$catId]);
		}
		else{
			$queryObj = $pdo->query("select posts.*, users.name from posts left join users on posts.user_id=users.id");
		}

		
		$posts = $queryObj->fetchAll(PDO::FETCH_ASSOC);
		return $posts;
	}

	function searchPosts($search){
		global $pdo;

		if($search){
			$queryObj = $pdo->prepare("select * from posts where title like :search OR content like :search");
			$queryObj->execute(['search' => '%'.$search.'%']);
		}
		else{
			$queryObj = $pdo->query("select * from posts");
		}

		
		$posts = $queryObj->fetchAll(PDO::FETCH_ASSOC);
		return $posts;
	}

	function getOnePost($postId){
		global $pdo;

		$queryObj = $pdo->prepare("select * from posts where id = ?");
		$queryObj->execute([$postId]);


		
		$post = $queryObj->fetch(PDO::FETCH_ASSOC);
		return $post;
	}

	function editPost($id, $title, $content, $category_id, $status='draft', $image='no-img.jpg'){
    global $pdo;
    $queryObj = $pdo->prepare("UPDATE posts SET title=:ptt, content=:pcn, category_id=:pci, status=:pst, image=:pim WHERE id=:pid");

    try {
        $queryObj->execute([
            'pid' => $id,
            'ptt' => $title,
            'pcn' => $content,
            'pci' => $category_id,
            'pst' => $status,
            'pim' => $image,
        ]);
    } catch(PDOException $ex){
        echo $ex->getMessage();
        return false;
    }
    return true;
}


	function editProfile($id, $name, $phone, $age, $adres) {
	global $pdo;

	$queryObj = $pdo->prepare("UPDATE users SET name=:name, phone=:phone, age=:age, adres=:adres WHERE id=:pid");

	try {
	    $queryObj->execute([
	        'pid' => $id,
	        'name' => $name,
	        'phone' => $phone,
	        'age' => $age,
	        'adres' => $adres
	    ]);
	} catch (PDOException $ex) {
	    echo $ex->getMessage();
	    return false;
	}
	return true;
}



	function deletePost($postId){
		global $pdo;

		$queryObj = $pdo->prepare("delete from posts where id = ?");
		$result = $queryObj->execute([$postId]);

		return $result;
	}

	// function ratePost($user_id, $post_id, $rating){
	// 	global $pdo;
	// 	$queryObj = $pdo->prepare("select * from user_post where uid=:uid and pid=:pid");

	// 	try {
	// 		$queryObj->execute([
	// 			'uid' => $user_id,
	// 			'pid' => $post_id,
	// 		]);
	// 	}catch(PDOException $ex){
	// 		echo $ex->getMessage();
	// 		return false;
	// 	}

	// 	$result = $queryObj->fetch(PDO::FETCH_ASSOC);

	// 	if($result){
	// 		$queryObj = $pdo->prepare("update user_post SET rating=:rating where uid=:uid and pid=:pid");
	// 	}
	// 	else{
	// 		$queryObj = $pdo->prepare("insert into user_post(uid, pid, rating) values(:uid, :pid, :rating)");
	// 	}

	// 	try {
	// 		$queryObj->execute([
	// 			'uid' => $user_id,
	// 			'pid' => $post_id,
	// 			'rating' => $rating,
	// 		]);
	// 	}catch(PDOException $ex){
	// 		echo $ex->getMessage();
	// 		return false;
	// 	}
	// 	return true;
	// }

	// function getRating($post_id){
	// 	global $pdo;
	// 	$queryObj = $pdo->prepare("select avg(rating) as rating from user_post where pid=:pid");

	// 	try {
	// 		$queryObj->execute([
	// 			'pid' => $post_id,
	// 		]);
	// 	}catch(PDOException $ex){
	// 		echo $ex->getMessage();
	// 		return false;
	// 	}
	// 	$result = $queryObj->fetch(PDO::FETCH_ASSOC);
	// 	return $result;
	// }

	
	function homeTask($homeTask){
		global $pdo;
		$queryObj = $pdo->prepare("insert into home_task(homeTask, created_at) values (:hwt, :crta)");
		date_default_timezone_set('Asia/Almaty');
		try{
			$queryObj->execute([
				'hwt' => $homeTask,
				'crta' => date("Y-m-d H:i:s", time()),
			]);
		}catch(PDOException $ex){
			echo $ex->getMessage();
			return false;
		}
		return true;
	}



	function students() {
	    global $pdo;
	    
	    // Сұрауды дайындау
	    $queryObj = $pdo->prepare("SELECT * FROM users WHERE role = :role");
	    
	    // Параметрді байлау (рөлді 'user' деп орнату)
	    $role = 'user';
	    $queryObj->bindParam(':role', $role);
	    
	    // Сұрауды орындау
	    $queryObj->execute();
	    
	    // Нәтижелерді алу
	    $users = $queryObj->fetchAll(PDO::FETCH_ASSOC);
	    
	    return $users;
	}

	function removeCourse($id, $cours) {
    global $pdo;

    $queryObj = $pdo->prepare("UPDATE users SET cours = :ucours WHERE id = :uid");
    try {
        $queryObj->execute([
            'uid' => $id,      
            'ucours' => $cours 
        ]);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }
    return true;
}

function getUserById($id) {
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $query->execute(['id' => $id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}


	


?>