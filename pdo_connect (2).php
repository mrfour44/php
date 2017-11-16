<?php
header('content-type:text/html;chartset=utf-8');
	try {
		$dsn = "mysql:host=localhost;dbname=test";
		$username = "root";
		$password = "123456";
		$pdo = new PDO($dsn, $username, $password);
		var_dump($pdo);
		// 得到PDO连接数据库的属性
		var_dump($pdo->getAttribute(PDO::ATTR_AUTOCOMMIT));
		var_dump($pdo->getAttribute(PDO::ATTR_ERRMODE));
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>