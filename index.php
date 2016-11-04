<?php
require_once 'response.php';
define ( "TOKEN", "HeartGuard" );
$wechatObj = new wechatCallbackapiTest ();
if (isset ( $_GET ['echostr'] )) {
	$wechatObj->valid ();
} else {
	$wechatObj->responseMsg ();
}
class wechatCallbackapiTest {
	public function valid() {
		$echoStr = $_GET ["echostr"];
		if ($this->checkSignature ()) {
			header ( 'content-type:text' );
			echo $echoStr;
			exit ();
		}
	}
	private function checkSignature() {
		$signature = $_GET ["signature"];
		$timestamp = $_GET ["timestamp"];
		$nonce = $_GET ["nonce"];
		$token = TOKEN;
		$tmpArr = array (
				$token,
				$timestamp,
				$nonce 
		);
		sort ( $tmpArr, SORT_STRING );
		$tmpStr = implode ( $tmpArr );
		$tmpStr = sha1 ( $tmpStr );
		if ($tmpStr == $signature) {
			return true;
		} else {
			return false;
		}
	}
	public function responseMsg() {
		$postStr = $GLOBALS ["HTTP_RAW_POST_DATA"];
		if (! empty ( $postStr )) {
			$userObj = simplexml_load_string ( $postStr, 'SimpleXMLElement', LIBXML_NOCDATA );
			$RX_TYPE = trim ( $userObj->MsgType );
			$keyword = trim ( $userObj->Content );
			switch ($RX_TYPE) {
				case "text" :
					$resultStr = receiveText ( $userObj );
					break;
				case "event" :
					$resultStr = receiveEvent ( $userObj );
					selectuserinfo($userObj);
					break;
				default :
					$resultStr = "";
					break;
			}
			echo $resultStr;
		} else {
			echo "";
			exit ();
		}
	}
}
?>