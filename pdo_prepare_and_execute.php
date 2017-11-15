<?php
	$pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
	
	$sql = 'SELECT * FROM user WHERE username = "krislam"';

	// 通过预处理的方法来查询  prepare 和 execute
	/*
	 * prepare() 准备执行的SQL语句 返回PDOStatement对象
	 * execute() 执行一条预处理的语句 -->是PDOStatement对象的方法
	 */
	$stmt = $pdo->prepare($sql);
	var_dump($stmt);

	$res = $stmt->execute();
	var_dump($res);
	if ($res) {
		通过PDOStatement对象的fetch()方法得到一条记录
		$row = $stmt->fetch();
		print_r($row);
		// PDO::FETCH_ASSOC 返回的是一个关联数组 默认是PDO::FETCH_BOTH 返回关联+索引 PDO::FETCH_OBJ返回是一个对象
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			print_r($row);
		}
	}

	// 通过PDOStatement对象的fetchAll()方法得到一条记录
	// $stmt->setFetchMode(PDO::FETCH_ASSOC); 为语句设置返回的模式
	// $stmt->fetchAll();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	print_r($rows);
?>