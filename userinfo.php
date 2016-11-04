<?php
// 获取用户信息并保存
require_once 'accesstoken.php';
require_once 'db.php';
function selectuserinfo($userObj)
{
    $OPENID = $userObj->FromUserName;
    $query = "select * from weixinuser where openid = '" . $OPENID . "'";
    $pdores = db($query);
    if (count($pdores) == 0 || empty ($pdores [0] ['nickname'])) {
        $ACC_TOKEN = getaccessToken();
        $USERINFO_URL = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $ACC_TOKEN . "&openid=" . $OPENID;
        $res = getJson($USERINFO_URL);
        if (count($pdores) == 0) {
            $query = "INSERT INTO weixinuser VALUES ('" . $res ['openid'] . "', '" . $res ['nickname'] . "', '" . $res ['sex'] . "', '" . $res ['province'] . "', '" . $res ['city'] . "', '" . $res ['country'] . "','','','','','','')";
        } else {
            $query = "UPDATE weixinuser SET nickname = '" . $res ['nickname'] . "', sex = '" . $res ['sex'] . "', province = '" . $res ['province'] . "', city = '" . $res ['city'] . "', country = '" . $res ['country'] . "' where openid = '" . $res ['openid'] . "'";
        }
        db($query);
    } else {
        $res = $pdores [0];
    }

    return $res ['openid'];
}

function selectphone($userObj)
{
    $OPENID = $userObj->FromUserName;
    $query = "select * from weixinuser where openid = '" . $OPENID . "'";
    $pdores = db($query);
    if (count($pdores) == 0 || empty ($pdores [0] ['nickname'])) {
        $ACC_TOKEN = getaccessToken();
        $USERINFO_URL = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $ACC_TOKEN . "&openid=" . $OPENID;
        $res = getJson($USERINFO_URL);
        if (count($pdores) == 0) {
            $query = "INSERT INTO weixinuser VALUES ('" . $res ['openid'] . "', '" . $res ['nickname'] . "', '" . $res ['sex'] . "', '" . $res ['province'] . "', '" . $res ['city'] . "', '" . $res ['country'] . "','','','','','','')";
        } else {
            $query = "UPDATE weixinuser SET nickname = '" . $res ['nickname'] . "', sex = '" . $res ['sex'] . "', province = '" . $res ['province'] . "', city = '" . $res ['city'] . "', country = '" . $res ['country'] . "' where openid = '" . $res ['openid'] . "'";
        }
        db($query);
    } else {
        $res = $pdores [0];
    }
    return $res ['phone'];
}

function updateuserinfo($userObj, $k, $v)
{
    $OPENID = $userObj->FromUserName;
    $query = "UPDATE weixinuser SET " . $k . " = '" . $v . "'where openid = '" . $OPENID . "'";
    db($query);
}

function isbd($userObj)
{
    $OPENID = $userObj->FromUserName;
    $query = "select * from weixinuser where openid = '" . $OPENID . "'";
    $pdores = db($query);
    if (count($pdores) == 0 || empty ($pdores [0] ['phone'])) {
        return false;
    } else {
        return true;
    }
}

function updateinfo($userObj, $v1, $v2, $v3, $v4, $v5)
{
    $OPENID = $userObj->FromUserName;
    $query = "UPDATE weixinuser SET h_c = '" . $v1 . "',h_n = '" . $v2 . "',q2 = '" . $v3 . "',q3 = '" . $v4 . "',q4 = '" . $v5 . "'where openid = '" . $OPENID . "'";
    db($query);
    return $query;
}

?>