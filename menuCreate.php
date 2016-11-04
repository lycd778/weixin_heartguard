<?php
require_once 'accesstoken.php';
header ( 'Content-Type: text/html; charset=UTF-8' );
$ACC_TOKEN = getaccessToken ();
$data = '{
 "button":[
 {
       "name":"帮助",
       "sub_button":[
        {
          "type":"click",
           "name":"随咨询",
           "key":"szx"
        },
		{
           "type":"click",
           "name":"绑定手机",
           "key":"bdsj"
        },
        {
           "type":"click",
           "name":"答量表",
           "key":"dlb"
        },
        {
           "type":"view",
           "name":"看文章",
           "url":"http://mp.weixin.qq.com/mp/getmasssendmsg?__biz=MzI4NTM4Mjk3Mg==#wechat_webview_type=1&wechat_redirect"
        }]
  },
  {
       "name":"查看",
       "sub_button":[
        {
           "type":"click",
           "name":"查医院",
           "key":"cyy"
        },
        {
           "type":"click",
           "name":"查药",
           "key":"cy"
        },
		  {
           "type":"click",
           "name":"居家计划",
           "key":"jjjh"
        },
        {
           "type":"click",
           "name":"我的报告",
           "key":"wdbg"
        }]
   },
   {
       "name":"产品",
         "sub_button":[
        {
           "type":"click",
           "name":"看我们",
           "key":"kwm"
        },
        {
           "type":"click",
           "name":"观产品",
           "key":"gcp"
        }
		,
        {
           "type":"click",
           "name":"下APP",
           "key":"xapp"
        },
        {
           "type":"view",
           "name":"购产品",	   
           "url":"http://mp.weixin.qq.com/bizmall/mallshelf?id=&t=mall/list&biz=MzI4NTM4Mjk3Mg==&shelf_id=1&showwxpaytitle=1#wechat_redirect"
        }]
   }
		]}';

$ch = curl_init ();
curl_setopt ( $ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $ACC_TOKEN );
curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)' );
curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
curl_setopt ( $ch, CURLOPT_AUTOREFERER, 1 );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
$tmpInfo = curl_exec ( $ch );
curl_close ( $ch );
$menu = json_decode ( $tmpInfo, false );
if ($menu->errcode == "0") {
	echo "菜单创建成功";
} else {
	echo "菜单创建失败";
}
?>