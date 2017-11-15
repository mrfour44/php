<?php
	try {
		$pdo = new PDO('mysql:localhost;dbname=learn_PDO','root', 'root');
		// exec(); 执行一条sql语句并返回其受影响的记录条数
		// exec() 对于select语句没有左右
		$sql = <<<EOF
			CREATE TABLE IF NOT EXISTS user(
				id INT UNSIGNED AUTO_INCREMENT KEY,
				username VARCHAR(20) NOT NULL UNIQUE,
				password CHAR(32) NOT NULL,
				email VARCHAR(30) NOT NULL
			);			
EOF;
		$res = $pdo->exec($sql);
		var_dump($res);

		// 插入一条记录
		$sql = 'INSERT user(username,password,email) VALUES("krislam", "'.md5('kris')'.", "magiczi@qq.com")';
		
		// echo($sql);
		$res = $pdo->exec($sql);
		// $pdo->lastInsertId(); -->得到新插入记录的id号

		// 更新 
		$sql = 'UPDATE user SET suername = "imooc" WHERE id = 1';
		$res = $pdo->exec($sql);
		// 删除
		$sql = 'DELETE FROM user WHERE id = 1';
		var_dump($res);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>