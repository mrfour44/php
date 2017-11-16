<?php
	$pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
	// 当sql语句错误
	$sql = 'DELETE FROM user WHERE id = 1';

	$res = $pdo->exec($sql);
	if ($res === false) {
		// 错误码 SQLSTATE的值
		echo $pdo->errorCode();
		echo "<br />";
		// 错误信息 return Array 0=>SQLSTATE 1=>CODE 2=>INFO
		print_r($pdo->errorInfo());
	}
?>