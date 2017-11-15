<?php
	$pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
	// 查一条数据
	// $sql = 'SELECT * FROM user WHERE id = 1';
	// 查全部数据
	$sql = 'SELECT * FROM user';
	// $pdo->query($sql) 执行sql语句 返回PDOStatement对象
	$stmt = $pdo->query($sql);
	// 得到的stmt对象是一个二维数组 需要foreach得到里面的内容
	foreach ($stmt as $row) {
		print_r($row);
	}
?>