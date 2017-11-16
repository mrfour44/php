<?php
	header('content-type:text/html;charset=utf-8');
	try {
		$pdo = new PDO('mysql:host=locathost;dbname=test', 'root', '123456');
		$sql = "SELECT username,password,email FROM user";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		echo '结果集的列数一共有:'.$stmt->columnCount();
		echo '<hr />';
		// 返回结果集中的一列元数据
		print_r($stmt->getColumnMeta(0));

		// 打印一条预处理的语句
		// $stmt->debugDumpParam();

		$stmt->bindColumn(1,$username);
		$stmt->bindColumn(2,$password);
		$stmt->bindColumn(3,$email);
		while($stmt->fetch(PDO::FETCH_BOUND)) {
			echo '用户名:'.$username.'-密码:'.$password.'-邮箱:'.$email.'<hr />';
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>