<?php
//記入例；以下は  から で挟まれるPHP領域に記載すること。
	//4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
		
	$dsn = 'データベース名';
	$user = 'ユーザ名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$name = '山田太郎';
	$comment = '頑張った'; //好きな名前、好きな言葉は自分で決めること
	$sql -> execute();
	
	$sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$name = '山田太郎';
	$comment = 'お疲れ様'; //好きな名前、好きな言葉は自分で決めること
	$sql -> execute();

	//bindParamの引数名（:name など）はテーブルのカラム名に併せるとミスが少なくなります。最適なものを適宜決めよう。
	 ?>