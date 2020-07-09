<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-4.php</title>
</head>
<body>
 
    <?php

 $filename="Mission_3-4.txt" ;
   //保存先のファイル名を$filenameに代入
$edit_name="";
$edit_coment="";
$edit_number="";
 if(isset($_POST["approve"]))//isset関数…変数に値がセットされていて、かつNULLでない
  {   
      
      $yourname=$_POST["yourname"];//名前
       $comment=$_POST["comment"];//コメント
       $date=date("Y/m/d H:i:s");
       $approve=$_POST["approve"];
       $fp=fopen($filename,"a");
       $num=count(file($filename));//ファイルのデータの行数を数えて$numに代入
       $num++;   //投稿番号を取得
          //（投稿番号）＜＞(名前）＜＞（コメント）＜＞(投稿された時間）をファイルに書き込む
       if(!empty($yourname).($comment)){
            //もし入力内容が空白でない場合には以下を実行  
    
         fwrite($fp,$num."<>".$yourname."<>".$comment."<>".$date."\n");
       }


        //$filearr=file($filename);
        //配列の内容を出力。filearrで指定した配列に関してループ処理を行う。
        //各反復において現在の要素の値が＄value(一つ一つの番地のデータを処理）に代入され、内部配列ポインタが一つ前に進められる。
         //foreach($filearr as $value){
        //　　配列　　　　行
       //$valueを＜＞で分割
      //  $getdate=explode("<>",$value);
    $edit_name="";
    $edit_coment="";
    $edit_number="";
     fclose($fp);
    
       //}
    }elseif(isset($_POST["delete"])){
     $delete=$_POST["deleteNo"];

    $filearr=file($filename);
        //配列の内容を出力。filearrで指定した配列に関してループ処理を行う。
       //各反復において現在の要素の値が＄value(一つ一つの番地のデータを処理）に代入され、内部配列ポインタが一つ前に進められる。

       $fp=fopen($filename,"w");
  
      foreach($filearr as $value)
      {
             //　　配列　　　　行
             //$valueを＜＞で分割
         $getdate=explode("<>",$value);
         echo $delete."<br>";
         echo $getdate[0]."<br>";
    
         if($delete!=$getdate[0]){
          fwrite($fp,$getdate[0]."<>".$getdate[1]."<>".$getdate[2]."<>".$getdate[3]."\n");
          echo "保存しました"."<br>";
         }
          
      }
         //fclose($fp);
    
   }elseif(isset($_POST["editor"])){

      $edit=$_POST["editNo"];
    
      $filearr=file($filename);
      $getdate=explode("<>",$value);

    foreach($filearr as $value)
    {

      if($getdate[0]==$edit)//投稿番号と編集番号の一致
      {
       
     $edit_name=$getdate[1];
  $edit_coment=$getdate[2];
      $edit_number=$getdate[0];
        
    } 
  }
   }
?>


   <form action="" method="POST">
   
    <div class="item">
    <label for="rendou">名前:</label>
     <input type="text" name="number" value="<?php echo $edit_number; ?>"><br>
        <input id="rendou" type="text" name="yourname" placeholder="伊豆田理奈" value="<?php echo $edit_name; ?>>
  
    </div>
    
    <div class="item">
    <label for="comment">コメント:</label>
        <textarea id="comment"  name="comment" placeholder="ここには自由にコメントを記入してください" value="<?php echo $edit_coment; ?>"></textarea> 
    </div>
    
    <div class="btn-area">
    <input type="submit"  name="approve" value="送信">
    </div>
     
     <div class="item">
         <input type="text" name="deleteNo" placeholder="削除対象番号">
     </div>
     
     <div class="btn-area">
         <input type="submit" name="delete" value="削除">
     </div>
     
     
      <div class="item">
         <input type="edit" name="editNo" placeholder="編集対象番号">
     </div>
     
     <div class="btn-area">
         <input type="submit" name="editor" value="編集">
     </div>
    

     </form>

</body>
</html>