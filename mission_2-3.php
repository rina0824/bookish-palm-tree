<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-2.php</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="name">
        <input type="submit" name="submit" value="コメント">
        
    </form>
    
    <?php

$name=$_POST["name"];
$filename="mission_2-3.txt";
$fp = fopen($filename,"a");


if($_POST["name"]!=null){ 
if($name=="完了！"){

echo "おめでとう<br>";
fwrite($fp,$line.$_POST["name"].PHP_EOL);
    fclose($filename);
}
elseif($name!="完了！"){

    echo "$name<br>";

}
 fclose($fp);
 }
 ?>
</body>