<?php
	//4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
	$dsn = 'データベース名';
	$user = 'ユーザ名';
	$password = 'パスワード名';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$sql = "CREATE TABLE IF NOT EXISTS tbtest"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT"
	.");";
	$stmt = $pdo->query($sql);
	
	/*このデータベースサーバに、データを登録するための「テーブル」を作成します。
ここでテーブル名は「tbtest」として、そこに登録できる項目（カラム）は
id ・自動で登録されていうナンバリング。
name ・名前を入れる。文字列、半角英数で32文字。
comment ・コメントを入れる。文字列、長めの文章も入る。
とします。
※データベースは作成済みのため、作成するのはテーブルだけでよい。*/

	
	?>