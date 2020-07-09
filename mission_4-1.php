<?php	
	//記入例；以下は <?php から  で挟まれるPHP領域に記載すること。
	//4-2以降でも毎回接続は必要。
	//$dsnの式の中にスペースを入れないこと！

	/

	// DB接続設定
	
	$dsn = 'データベース名';
	$user = 'ユーザ名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>