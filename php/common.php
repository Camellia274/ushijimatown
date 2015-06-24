<?php
//ログイン
function login(){
	// mysqliクラスのオブジェクトを作成
	$mysqli = new mysqli('localhost', 'root', 'root', 'ushijimatown');
	if ($mysqli->connect_error) {
		echo $mysqli->connect_error;
		exit();
	} else {
		$mysqli->set_charset("utf8");
	}

	// ここにDB処理いろいろ書く
	$sql = "SELECT email_address, password, name FROM member WHERE email_address=? AND password=?";
	if ($stmt = $mysqli->prepare($sql)) {
		// 条件値をSQLにバインドする
		$email_address = $_POST['useremail'];
		$password = $_POST['userpassword'];
		$stmt->bind_param("ss", $email_address, $password);

		// 実行
		$stmt->execute();

		// 取得結果を変数にバインドする
		$stmt->bind_result($email_address, $password, $name);
		while ($stmt->fetch()) {
			//echo "名前=$name<br>メールアドレス=$email_address<br>パスワード=$password";
			$_SESSION["username"] = $name;
		}
		$stmt->close();
	}
	// DB接続を閉じる
	$mysqli->close();
}
?>