<?php
//数据库连接
function db($query) {
	$dbms = 'mysql';
	$host = "localhost";
	$port = "3306";
	$dbname = "weixin_ydka";
	$user = "root";
	$pass = "root";
	$dsn = "$dbms:host=$host;port=$port;dbname=$dbname";
	try {
		$pdo = new PDO ( $dsn, $user, $pass );
		$pdo->exec ( "SET CHARACTER SET utf8" );
	} catch ( PDOException $e ) {
	}
	$result = $pdo->prepare ( $query );
	$result->execute ();
	$pdores = $result->fetchAll ( PDO::FETCH_ASSOC );
	return $pdores;
}
?>