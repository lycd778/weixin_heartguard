<?php
require_once 'db.php';
function getaccessToken() {
	$appid = "wxfb3801993da030d8";
	$appsecret = "876c2adcaf2acba2a042121f0925b137";

// 	$appid="wx352cffa65a97393f";
// 	$appsecret="5d04b083bee539ccc8dae792668178bf";
	$time = time ();
	$query = "select * from accesstoken where appid = '" . $appid . "'";
	$pdores = db ( $query );
	if (count ( $pdores ) == 0 || ($pdores [0] ['time'] + 7000 < $time)) {
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
		$res = getJson ( $url );
		$access_token = $res ['access_token'];
		if (count ( $pdores ) == 0) {
			$query = "INSERT INTO accesstoken VALUES ('" . $appid . "', '" . $access_token . "', '" . $time . "')";
		} else {
			$query = "UPDATE accesstoken SET access_token = '" . $access_token . "'where openid = '" . $appid . "'";
		}
		db ( $query );
	} else {
		$access_token = $pdores [0] ['access_token'];
	}
	return $access_token;
}
function getJson($url) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$output = curl_exec ( $ch );
	curl_close ( $ch );
	return json_decode ( $output, true );
}
?>