<?php
require_once 'accesstoken.php';
// 菜单点击事件
function response_click($userObj, $EventKey)
{
    switch ($EventKey) {
        case "szx" :
            $text = '{
           "touser":"' . $userObj->FromUserName . '",
           "msgtype":"text",
           "text":
            {
             "content":"请回复您想咨询的问题，我们会在第一时间给您回复。"
            }
          }';
            $access_token = getaccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=" . $access_token;
            $result = https_post($url, $text);
            var_dump($result);


            $resultStr = transmitService($userObj);
            break;
        case "bdsj" :
//            $newsContent = "请输入相关信息，以绑定心脏卫士，按照下列格式回复：
//            绑定+姓名+手机号。
//           （例如：绑定+张三+156XXXXXXXX）
//            请确保信息完整有效。";
//            $resultStr = response_text($userObj, $newsContent);
//            $data = '{
//
//							"openid":"' . selectuserinfo ( $userObj ) . '",
//							"birthday":"20' . date ( "y-m-d", time () ) . 'T00:00:00",
//							}';
//
//             http_post_data ("http://123.57.143.76:9000", $data );
            echo "<form style='display:none;' id='form1' name='form1' method='post' action='http://123.57.143.76:9000'>
              <input id='openid' type='text' name='openid' value=' . selectuserinfo ( $userObj ) .'>
              <input id='birthday' type='text' name='birthday' value='20" . date('y-m-d', time()) . "T00:00:00'>
              </form>
               <script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";

            $openid=selectuserinfo ( $userObj );
            $birthday="20' . date ( \"y-m-d\", time () ) . 'T00:00:00";

            $newsContent = "<a href=\"http://weixinh5.xzkf365.com:9000/?openid='$openid' &birthday='$birthday'\">绑定手机</a>";
            $resultStr = response_text($userObj, $newsContent);

            break;
        case "dlb" :
            $phone = selectphone($userObj);
            $final_phone = empty($phone) ? '1564545454' : $phone;
            $menu = json_decode(http_get_data("http://123.57.143.76:8010/api/html5HealthReport?userid=" . $final_phone . "&password=123456"), false);
            $newsContent = array();
            switch ($menu->status) {
                case "100" :
                    $url = $menu->results;
                    $newsContent [] = array(
                        'Title' => '抑郁自评量表，测健康！',
                        'Description' => '',
                        'PicUrl' => 'https://mmbiz.qlogo.cn/mmbiz/WqpSdibDCBRlh0psgFIno8bkYiaWDzricwd7AuicMPHo9F7ZjiaexCf8yO9kHHFS54z2YKicqkblhMD8YpGQmSUQl6sw/0?wx_fmt=jpeg',
                        'Url' => $url
                    );
                    break;
                case "101":
                    $newsContent [] = array(
                        'Title' => '抑郁自评量表，测健康！',
                        'Description' => '提示：需先绑定手机！',
                        'PicUrl' => 'https://mmbiz.qlogo.cn/mmbiz/WqpSdibDCBRlh0psgFIno8bkYiaWDzricwd7AuicMPHo9F7ZjiaexCf8yO9kHHFS54z2YKicqkblhMD8YpGQmSUQl6sw/0?wx_fmt=jpeg',
                        'Url' => 'http://h5app.xzkf365.com/CSS/Account/login_mobile'
                    );
                    break;

            }
            $resultStr = response_image($userObj, $newsContent);
            break;
        case "cyy" :
            $newsContent = "<a href=\"https://www.hqms.org.cn/usp/roster/index.jsp\">点击进入，查询医院</a>";
            $resultStr = response_text($userObj, $newsContent);
            break;
        case "cy" :
            $newsContent = array();
            $newsContent [] = array(
                'Title' => '药物指导手册',
                'Description' => '',
                'PicUrl' => 'https://mmbiz.qlogo.cn/mmbiz_png/vPSSXd5FvYViahHMbnaa0kykc3khP0hH4Oqaicz299XWajLhjTao7MpIEzrWTt3eY7DEx24ichbQ2lIh45BZibKtLw/0?wx_fmt=png',
                'Url' => 'http://mp.weixin.qq.com/s?__biz=MzI4NTM4Mjk3Mg==&mid=2247483696&idx=1&sn=f8c66fd8e0ec325fcc13e4256ceabcff&chksm=ebec4163dc9bc87591459ae2bff5d60553708c0002d52630f543e0a03985e8af05beefa747d9&scene=0#wechat_redirect'
            );
            $resultStr = response_image($userObj, $newsContent);
            break;
        case "wdbg" :
            $newsContent = "待开发";
            $resultStr = response_text($userObj, $newsContent);
            break;
        case "kwm" :
            $newsContent = array();
            $newsContent [] = array(
                'Title' => '合泰-心脏卫士',
                'Description' => '',
                'PicUrl' => 'https://mmbiz.qlogo.cn/mmbiz/WqpSdibDCBRkvgUTUH0TPP7XMFLDwNSeKsYAl5aNl3WouqXg82go5qF8Thib7cia0eq0nnL55OJHic9RjibTz0HuADQ/0?wx_fmt=jpeg',
                'Url' => 'www.halents.com'
            );
            $resultStr = response_image($userObj, $newsContent);
            break;
        case "gcp" :
            $newsContent = array();
            $newsContent [] = array(
                'Title' => '产品介绍  ',
                'Description' => 'Halents H1 mini 健康手环',
                'PicUrl' => 'https://mmbiz.qlogo.cn/mmbiz_jpg/vPSSXd5FvYV2iaZ2AZXE15Uqw2kWIib4hboxflibG8jzxdVDTia6zONzJEwJDz7S7Sib5ibta1j0nERAQyuibE4aiaXMmg/0?wx_fmt=jpeg',
                'Url' => 'http://mp.weixin.qq.com/s?__biz=MzI4NTM4Mjk3Mg==&mid=2247483730&idx=1&sn=9c44e031e6bcf0894454726172903aaa&chksm=ebec4101dc9bc81750564e3948b597edf8395a6efac2520c7e98ed9c312f3d37c856c27996f5&mpshare=1&scene=23&srcid=1012KjJSUawFTEdO7c2ksShF#rd'
            );
            $resultStr = response_image($userObj, $newsContent);
            break;
        case "xapp" :
            $newsContent = "<a href=\"http://app.qq.com/#id=detail&appid=1102255388\">下载心脏卫士APP</a>";
            $resultStr = response_text($userObj, $newsContent);
            break;
        case "zxbm" :
            $data = '{
							"openid":"' . selectuserinfo($userObj) . '",
							"birthday":"20' . date("y-m-d", time()) . 'T00:00:00",
							}';
            $menu = json_decode(http_post_data("http://123.57.143.76:9000/", $data), false);
            $newsContent = "请输入相关信息，按照下列格式回复：
姓名+性别+手机号+身份证号码+寄送地址。
（例如：张三+男+156XXXXXXXX+32048219560956XXXX+详细地址）
请确保信息完整有效，客服专员后续会与您联系，核实要求，完成后发放手环。";
            $resultStr = response_text($userObj, $newsContent);
            break;

        case "jjjh" :
            $menu = json_decode(http_get_data("http://123.57.143.76:8010/api/qq/planlist?openid=" . $userObj->FromUserName), false);
            $newsContent = array();
            $newsContent [] = array(
                'Title' => '请先绑定手机，等待医生制定计划',
                'Description' => '',
                'PicUrl' => '',
                'Url' => ''
            );
            if ($menu->status = "100") {
                $temp = $menu->results;
                $temp = json_decode(json_encode($temp), true);
                //	$newsContent = array ();
                foreach ($temp as $item) {
                    $telephone = $item ['telephone'];
                    $username = $item ['username'];
                    $message = json_decode(json_encode($item ['getplans']), true);
                    $temp = "";
                    $newsContent [] = array(
                        'Title' => $username . '您好,您的居家计划:',
                        'Description' => '',
                        'PicUrl' => '',
                        'Url' => ''
                    );
                    $i = 0;
                    foreach ($message as $item) {
                        $planName = $item ['planName'];
                        $getday = $item ['getday'];
                        $Dotime = $item ['Dotime'];
                        $Type = $item ['Type'];
                        switch ($Type) {
                            case "1" :
                                $Type = "运动";
                                $doheartrate = $item ['doheartrate'];
                                if ($i == 0) {
                                    $i = 1;
                                    $temp = $temp . '类型:' . $Type . ' ' . "\n" . '名称:' . $planName . "\n" . '目标心率:' . $doheartrate . "\n" . '执行时间:' . $getday . ' ' . $Dotime;
                                } else {
                                    $temp = $temp . "\n" . "\n" . '类型:' . $Type . ' ' . "\n" . '名称:' . $planName . "\n" . '目标心率:' . $doheartrate . "\n" . '执行时间:' . $getday . ' ' . $Dotime;
                                }
                                break;
                            case "2" :
                                $Type = "用药";
                                if ($i == 0) {
                                    $i = 1;
                                    $temp = $temp . '类型:' . $Type . ' ' . "\n" . '名称:' . $planName . "\n" . '执行时间:' . $getday . ' ' . $Dotime;
                                } else {
                                    $temp = $temp . "\n" . "\n" . '类型:' . $Type . ' ' . "\n" . '名称:' . $planName . "\n" . '执行时间:' . $getday . ' ' . $Dotime;
                                }
                                break;
                        }
                    }
                    $newsContent [] = array(
                        'Title' => $temp,
                        'Description' => '',
                        'PicUrl' => '',
                        'Url' => ''
                    );
                }
            }
            $resultStr = response_image($userObj, $newsContent);
            //	}

            break;
    }
    return $resultStr;
}

function http_get_data($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $tmpInfo = curl_exec($ch);
    return $tmpInfo;
}

function https_post($url, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {

        return 'Error' . curl_errno($ch);
    }
    curl_close($ch);
    return $result;
}


function http_post($url, $data_string)
{
    $curl = curl_init();//初始化curl模块
    curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址
    curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);//是否自动显示返回的信息
    curl_setopt($curl, CURLOPT_POST, 1);//post方式提交
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);//要提交的信息
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//文件流输出
    curl_setopt($curl, CURLOPT_NOBODY, 1);//文件流输出
    $a = curl_exec($curl);//执行cURL
    curl_close($curl);//关闭cURL资源，并且释放系统资源
}

?>