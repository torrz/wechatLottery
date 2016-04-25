<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _initialize(){
        layout(false);//活动页面不需要应用模板
    }
    public function index(){
        session('eventid',$_GET['eventid']);
        if(isset($_GET['eventid'])&&$_GET['eventid']!=''){
            $AppId=M('event')->where('eventid='.session('eventid'))->getField('eventOfficialAccountId');
            session('appid',$AppId);
            $locaurl="http://".$_SERVER['HTTP_HOST']."/Home/Index/eventCode";
            $urls="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$AppId."&redirect_uri=".$locaurl."&response_type=code&scope=snsapi_base#wechat_redirect";
            header("Location:".$urls);
        }else{
            $this->display('index');
        }
    }

    public function eventCode(){
        $tools=new \Wechat\tools();
        $wechat['AppId']=session('appid');
        $wechat['AppSecret']=M('officialaccounts')->where('AppID="'.$wechat['AppId'].'"')->getField('appsecret');
        if(isset($_GET['code']) && $_GET['code']!=''){
            $wechat['wxcode']=$_GET['code'];
            $getucodeurl="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$wechat['AppId']."&secret=".$wechat['AppSecret']."&code=".$wechat['wxcode']."&grant_type=authorization_code";
            $getucodejson=json_decode($tools->http_curl_get($getucodeurl,true));
            //openid
            $user['openid']=$getucodejson->openid;
            //openid放进session
            session('openid',$user['openid']);
            $wxlintoken=$getucodejson->access_token;
            //查看code表是否存在抽奖信息
            $codeModel=M('code');
            $checkIsHasCode=$codeModel->where('referee1="'.$user['openid'].'" OR referee2="'.$user['openid'].'"')->find();
            if(isset($checkIsHasCode) && $checkIsHasCode!=''){
                $url="http://".$_SERVER['HTTP_HOST']."/Home/Index/lotteryPage";
                header("Location:".$url);
            }else{
                //没有则新增信息
            }
        }

    }

    public function lotteryPage()
    {
        //获取必要的信息
        $eventid = session('eventid');
        $openid = session('openid');
        $appid = session('appid');
        $event = M('event')->where('eventId=' . $eventid)->find();
        $codeModel = M('code');
        $users = M('users');
        $user1 = $users->where('openid="' . $openid . '" AND appid = "' . $appid . '"')->find();
        $codes = $codeModel->where(('referee1="' . $openid . '" AND eventId = ' . $eventid) . " OR " . ('referee2="' . $openid . '" AND eventId = ' . $eventid))->select();
        foreach ($codes as &$code) {
            if ($code['referee1'] == $openid) {
                $code['referee1'] = $user1;
                $user1['phone'] = $code['refereephone1'];
                $code['referee1']['team'] = 0;
                if (isset($code['referee2']) && $code['referee2'] != '') {
                    $user2 = $users->where('openid="' . $code['referee2'] . '" AND appid= "' . $appid . '"')->find();
                    $code['referee2'] = $user2;
                    $code['referee2']['none'] = 0;
                } else {
                    $code['referee2']['none'] = 1;
                }
            }
            if ($code['referee2'] == $openid) {
                $code['referee2'] = $user1;
                $user1['phone'] = $code['refereephone1'];
                $code['referee2']['none'] = 0;
                $user2 = $users->where('openid="' . $code['referee1'] . '" AND appid= "' . $appid . '"')->find();
                if (isset($user2) && $user2 != '') {
                    $code['referee1'] = $user2;
                    $code['referee1']['team'] = 0;
                } else {
                    $code['referee1']['team'] = 1;
                }
            }
        }
        $this->assign('codes',$codes);
        $this->assign('user',$user1);
        $this->display('lotteryPage');
    }
}