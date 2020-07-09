<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1.php</title>
</head>
<body>
 
<?php

	// DB接続設定
	
    $dsn = 'データベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    //データにアクセスするためのテーブル作成
    $sql = "CREATE TABLE IF NOT EXISTS tbtest1"
	." ("
	."id INT AUTO_INCREMENT PRIMARY KEY,"//id ・自動で登録されているナンバリング。
	."name char(32),"//name ・名前を入れる。文字列、半角英数で32文字。
	."comment TEXT,"//comment ・コメントを入れる。文字列、長めの文章も入る。
  ."date char(32),"
  ."password char(32)"
  .");";
  
  $stmt = $pdo->query($sql);//実行

 $edit_name="";
 $edit_comment="";
 $edit_number="";
$edit_password="";
 
   //保存先のファイル名を$filenameに代入
 if(isset($_POST["approve"]))//isset関数…変数に値がセットされていて、かつNULLでない
  {
   $yourname=$_POST["yourname"];//名前
   $comment=$_POST["comment"];//コメント
   $date=date("Y/m/d H:i:s");
   $password01=$_POST["password01"];
  
    if($_POST["number"] ==null){

       if(!empty($yourname).($comment).($password01)){


       $stmt = $pdo -> prepare("INSERT INTO tbtest1 (name, comment,date,password) VALUES (:name, :comment,:date,:password)");
	$stmt -> bindParam(':name', $yourname, PDO::PARAM_STR);
  $stmt-> bindParam(':comment', $comment, PDO::PARAM_STR);
  $stmt-> bindParam(':date', $date, PDO::PARAM_STR);
  $stmt-> bindParam(':password', $password01, PDO::PARAM_STR);
		$stmt -> execute();
  
    $sql = 'SELECT * FROM tbtest1';
	$stmt = $pdo->query($sql);//リクエストする
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['date'].',';
		echo $row['password'].'<br>';
	echo "<hr>";//表示
  }
   }
    }else//編集の場合
    {
      $over_write_no=$_POST["number"];//編集行番号（エントリー番号）を読み取る
      
      $sql = 'UPDATE tbtest1 SET name=:name,comment=:comment,date=:date WHERE id=:id AND password=:password';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':name', $yourname, PDO::PARAM_STR);
      $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
      $stmt->bindParam(':date', $date, PDO::PARAM_STR);
      $stmt->bindParam(':password', $password01, PDO::PARAM_STR);
      $stmt->bindParam(':id', $over_write_no, PDO::PARAM_INT);
	    $stmt->execute();//実行
        //続けて、4-6の SELECTで表示させる機能 も記述し、表示もさせる。
        //※ データベース接続は上記で行っている状態なので、その部分は不要
       
  $sql = 'SELECT * FROM tbtest1';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();//中に入ってるものをすべて見る
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['date'].',';
		echo $row['password'].'<br>';
	echo "<hr>";//表示
  }
  
    }
    $edit_name="";
    $edit_comment="";
    $edit_number="";
    $edit_password="";
     

    }elseif(isset($_POST["delete"])){
    
     $delete=$_POST["deleteNo"];
     $password02=$_POST["password02"];  
        //配列の内容を出力。filearrで指定した配列に関してループ処理を行う。
       //各反復において現在の要素の値が＄value(一つ一つの番地のデータを処理）に代入され、内部配列ポインタが一つ前に進められる。
       $sql = 'DELETE FROM tbtest1 WHERE id=:id AND password=:password';
       $stmt = $pdo->prepare($sql);
       $stmt->bindParam(':id', $delete, PDO::PARAM_INT);
       $stmt->bindParam(':password', $password02, PDO::PARAM_STR);
       $stmt->execute();
      
       $sql = 'SELECT * FROM tbtest1';
       $stmt = $pdo->query($sql);
       $results = $stmt->fetchAll();
       foreach ($results as $row){
         //$rowの中にはテーブルのカラム名が入る
         echo $row['id'].',';
         echo $row['name'].',';
         echo $row['comment'].',';
         echo $row['date'].',';
         echo $row['password'].'<br>';
       echo "<hr>";//表示
       }
   
        
    
   }elseif(isset($_POST["editor"])){

      $edit=$_POST["editNo"];
      $password03=$_POST["password03"];
    
      $sql = 'SELECT * FROM tbtest1  WHERE id=:id AND password=:password';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':id', $edit, PDO::PARAM_INT);
      $stmt->bindParam(':password', $password03, PDO::PARAM_STR);
      $stmt->execute();
      
      $results = $stmt->fetchAll();//実行結果を検索
      foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo $row['date'].',';
        echo $row['password'].'<br>';
      echo "<hr>";//表示
      
         $edit_number=$row['id'];        
//  echo $edit_number;
         $edit_name=$row['name'];
  //echo $edit_name;
         $edit_comment=$row['comment'];
  //echo $edit_comment;
         $edit_password=$row['password'];
    }    
   
    
  }
 
?>
<form action="" method="POST">
   <div class="item">
       <input type="text" name="number" value="<?php echo $edit_number; ?>"><br><br>
       <label for="rendou">名前:</label>
           <input id="rendou" type="text" name="yourname" placeholder="山田太郎" value="<?php echo $edit_name; ?>">
    </div><br>
    <div class="item" >
      <label for="comment">コメント:</label>
        <textarea id="comment"  name="comment" placeholder="ここには自由にコメントを記入してください" rows="8" cols="40" style="vertical-align:middle;"><?php echo $edit_comment; ?></textarea> 
    <!--行数　row 文字数　cols cssコード：style=""　vertical-align 縦方向のそろえ方　middle　位置-->
    </div><br>
    <div class="item" >
   <input type="text" name="password01" placeholder="パスワード" value="<?php echo $edit_password; ?>">
   </div><br>
    <div class="btn-area">
    <input type="submit" name="approve" value="送信">
 </div><br><br>
 <div class="item" >
   <input   type="text" name="password02"  placeholder="パスワード">
 </div><br>
     <div class="item">
    <input type="text" name="deleteNo" placeholder="削除対象番号">
  </div>
  <div class="btn-area">
    <input type="submit" name="delete" value="削除">
  </div><br><br>
  <div class="item" >
    <input type="text" name="password03" placeholder="パスワード">
  </div><br>
  <div class="item">
    <input type="edit" name="editNo" placeholder="編集対象番号">
  </div>
  <div class="btn-area">
    <input type="submit" name="editor" value="編集">
  </div>
   </form>
</body>
</html>