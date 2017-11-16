<?php
	try {
			$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '123456');
			$sql = "INSERT user(username,password,emali) VALUES(?,?,?)";
			$stmt = $pdo->prepare($sql); 
			$username = 'krislam';
			$password = 'krislam_12345';
			$stmt->bindValue(1,$username);
			$stme->bindValue(2,$password);
			$stmt->bindValue(3,'magiczi@qq.com');
			$stmt->execute();
			echo $stmt->rowCount();

			$username = 'krislam222';
			$password = 'krislam_12345222';
			// email 是固定的,就不用再绑定多一次了
			$stmt->bindValue(1,$username);
			$stme->bindValue(2,$password);
			$stmt->execute();
			echo $stmt->rowCount();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}	
?>