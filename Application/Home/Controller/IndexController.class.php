<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _initialize(){
        require THINK_PATH.'Library/Wechat/tools.class.php';
        layout(false);//活动页面不需要应用模板
    }
    public function index(){
        $locaurl="../Index/eventCode";
        $sysconfig['cappid']="wxe0658bc951f80a26";
        $urls="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$sysconfig['cappid']."&redirect_uri=".$locaurl."&response_type=code&scope=snsapi_base#wechat_redirect";
        header("Location:".$urls);
//        $this->display('index');
    }

    public function eventCode(){

        $tools=new tools();
        $sysconfig['cappid']="wxe0658bc951f80a26";
        $sysconfig['cappsecret']="";

        if(isset($_GET['code']) && $_GET['code']!=''){
            $WXCODE=$_GET['code'];
            $getucodeurl="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$sysconfig['cappid']."&secret=".$sysconfig['cappsecret']."&code=".$WXCODE."&grant_type=authorization_code";
            $getucodejson=json_decode($tools->http_curl_get($getucodeurl,true));
            $ucode=$getucodejson->openid;
            $wxlintoken=$getucodejson->access_token;
        }

        $Event = M("event");
        $data = $Event->select();
        $this->assign("event",$data);
//        Dump($data);
        $this->display('eventCode');
    }
}