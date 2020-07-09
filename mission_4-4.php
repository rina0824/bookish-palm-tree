<?php 
	//4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
	
	$dsn = 'データベース名';
	$user = 'ユーザ名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$sql ='SHOW CREATE TABLE tbtest';
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[1];
	}
	echo "<hr>";
	?>