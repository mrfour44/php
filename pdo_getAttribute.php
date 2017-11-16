<?php
	try {
	// 创建pdo对象传入配置	
	$options = array(PDO::AUTOCOMMIT=>0,PDO::ERRMODE=>PDO::ERRMODE_EXCEPTION);

	$pdo = new PDO('mysql:host=localhost;dbname=test','root', '123456');
	$attrArr = array(
		'AUTOCOMMIT', 'ERRMODE', 'CASE', 'PERSISTENT', 'TIMEOUT', 'ORACLE_NULLS',
		'SERVER_INFO', 'SERVER_VERSION', 'CLIENT_VERSION', 'CONNECTION_STATUES'
	);
	foreach ($attrArr as $attr) {
		echo "PDO::ATTR_$attr: ";
		echo $pdo->getAttribute(constant("PDO::ATTR_$attr")),'<br />';
	}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>