<?php
	header('content-type:text/html;chartset=utf-8');
	$username = $_POST['username'];
	$password = $_POST['password'];

	try {
		$pdo = new PDO('mysql:host=localhost,dbname=test', 'root', '123456');

		$sql = "SELECT * FROM user WHERE username=:username AND password=:password";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(":username" => $username , ":password" => $password));
		echo $stmt->rowCount();
		
		//bindParam
		$sql = "DELETE FROM user WHERE id < :id";
		$pdo->prepare($sql);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$id = 10;
		$stmt->execute();
		echo $stmt->rowCount();

		// bindValue
		

		


		// ?号占位符
		// $sql = "SELECT * FROM user WHERE username=? AND password=?";
		// $stmt = $pdo->prepare($sql);
		// $stmt->execute(array($username, $password));
		// echo $stmt->rowCount();

	} catch (PDOException $e) {
		echo $e->getMessage();
	}

?>