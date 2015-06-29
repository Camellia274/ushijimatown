<html>
<head>
<title>うしぢまタウン</title>
</head>
<body>

<?php
session_start();

if (!isset($_SESSION['username'])){
	print "<form action=\"\" method=\"post\">
			<input type=\"submit\" value=\"ログイン\">
			</form>";
	print "<form action=\"\" method=\"post\">
			<input type=\"submit\" value=\"新規登録\">
			</form>";
}
elseif (isset($_SESSION['username'])){
	print $_SESSION['username'];
	print "さん";
	print "<form action=\"\" method=\"post\">
			<input type=\"submit\" value=\"ログアウト\">
			</form>";
}

?>



</body>
</html>