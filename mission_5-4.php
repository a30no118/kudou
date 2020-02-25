<?php
//data-base-name
$dsn='データベース名t';
//user-name
$user='ユーザー名';
//password
$password='パスワード';
//studennt of TECH-BASE
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

 $sql = "CREATE TABLE IF NOT EXISTS tbtest1"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
	."date char(32),"
	."pass char(32)"
	.");";
 $stmt = $pdo->query($sql);
 ?>
<?php
//data-base-name
$dsn='データベース名t';
//user-name
$user='ユーザー名';
//password
$password='パスワード';
//studennt of TECH-BASE
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

if(!empty($_POST["name"] )&&!empty($_POST["comment"])) {
    $pass = "pass";
  if(empty($_POST["edit"])&& $_POST["pass"]==$pass ){//新規投稿
	
$sql = $pdo -> prepare("INSERT INTO tbtest1 (name, comment,date,pass) VALUES (:name, :comment, :date, :pass)");

	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$sql -> bindParam(':date', $date, PDO::PARAM_STR);
	$sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
	$name = $_POST["name"];
    $comment = $_POST["comment"];
    $date=date("Y/m/d H:i:s");
	$pass = $_POST["pass"];
	$sql -> execute();	 

    }else{ //新規じゃなくて、編集
    $edi_id = $_POST["num"];
    	$id = $edi_id;
    	$name = $_POST["name"];
    	$comment = $_POST["comment"];
    	$pass = $_POST["pass"];
   		$sql = 'update tbtest1 set name=:name,comment=:comment where id=:id';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
}
} else{
			$error="入力してください";
}
$pass3 = "pass";
if(!empty($_POST["edit"]) && $pass3===$_POST["pass3"]){//編集選択
    $edit = $_POST["edit"];
	$pass3=$_POST["pass3"];
    $sql = 'SELECT * FROM tbtest1';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
   		 if($row['id']===$edit){
   		$edi_id = $row['id'];
  		$name = $row['name'];
		$comment = $row['comment'];
		$date=$row['date'];
		$pass =$row['pass'];
		
  }
 }
} else {
        		$name = "お名前";
        		$comment = "コメント";
      }
      
$pass2="pass";
if(!empty($_POST["delete"])&& $pass2 === $_POST["pass2"]){//削除機能
$pass2=$_POST["pass2"];
    $id = $_POST["delete"];
	$sql = 'delete from tbtest1 where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
}else{
      $delete_error =  "削除したい番号を入力してください。";
      }   
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;  charset="UFT-8" />
<title>投稿フォーム</title>
</head>
<body>
<h1>投稿フォーム</h1>

パスワードは"pass"に固定して設定しています。<br>

【投稿フォーム】<br>
<form action = "mission_5-4.php" method = "post">
名　　前<input type="text" name="name" value = "<?php if(!empty($_POST["edit"])){echo $name; }?> " > <br/>
コメント<input type = "text" name ="comment"value = "<?php if(!empty($_POST["edit"])){ echo $comment; }?> "  > <br>
<input type = "hidden" name ="num" value = "<?php echo $edi_id; ?>" >
パスワード　<input type = "text" name = "pass">
<input type ="submit" value="送信"> <br><br>
</form>

【削除フォーム】<br>
<form action = "mission_5-4.php" method = "post">
削除対象番号<input type = "text" name = "delete"><br>
パスワード　<input type = "text" name = "pass2">
<input type="submit" value = "削除"><br><br>
</form>

【編集フォーム】<br>
<form action = "mission_5-4.php" method = "post" >
編集対象番号<input type = "text" name = "edit"><br>
パスワード　<input type = "text" name = "pass3">
<input type = "submit" value = "編集"><br><br>
</form>

</body>
</html> 
<br>

<?php
//data-base-name
$dsn='データベース名t';
//user-name
$user='ユーザー名';
//password
$password='パスワード';
//studennt of TECH-BASE
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$sql = 'SELECT * FROM tbtest1';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		echo $row['id'] . ' ';
		echo $row['name'] . ' ';
		echo $row['comment'] . ' ';
		echo $row['date'] . '<br>';
	echo "<hr>";
	}
?>