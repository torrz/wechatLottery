<?php
/**
 * Created by PhpStorm.
 * User: hemecity-W
 * Date: 2016/4/21
 * Time: 8:57
 */
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function _initialize(){
        $value = session('user');
        if(session('?user')){
        }
        else{
            $this->error("请先登录","../Login/index",1);
        }
    }
    //退出登录
    public  function exitHeme(){
        session('[destroy]');
        redirect("../Login/index", 0, '');
    }
    //总览 显示全部精选
    public function overview(){
        $Event = M("event");
        $List=$Event->limit(10)->select();
        $Code = M("code");
        $wechat = M("officialaccounts");
        $zero1=date("Y-m-d H:i:s");
        for($i=0;$i<count($List);$i++){
            $zero2=$List[$i]['eventstarttime'];
            $zero3=$List[$i]['eventendtime'];
            if($zero1<=$zero3&&$zero1>=$zero2){
                $List[$i]['status']="success";
            }
            else if($zero1<$zero2){
                $List[$i]['status']="active";
            }
            else if($zero1>$zero3){
                $List[$i]['status']="info";
            }
            $count = $Code->where('eventid="'.$List[$i]['eventid'].'"')->count();
            $wechatname = $wechat->where('appid="'.$List[$i]['eventofficialaccountid'].'"')->getField('wechatname');
            $List[$i]['wechatname']=$wechatname;
            $List[$i]['count']=$count;
        }
//        echo $zero1;
//        var_dump($List);
        $this->assign('events',$List);
        $this->display('overview');
    }

    //精选详细
    public function eventDetail(){
        $id=I('id');
        $Events = M("event");
        $event=$Events->where('eventid="'.$id.'"')->find();
        $officialaccounts = M("officialaccounts");
        $wechat=$officialaccounts->where('Appid="'.$event['eventofficialaccountid'].'"')->getField('appid,wechatname,wechatid');
//        var_dump($wechat[$event['eventofficialaccountid']]);
        $this->assign('wechat',$wechat[$event['eventofficialaccountid']]);
        $this->assign('event',$event);
        $this->display('eventDetail');
    }

    //精选修改
    public function edit(){
        $id=I('get.id');
        $Event = M('event');
        $Event->create();
        $Event->where('eventId='.$id)->save();
        $this->success('修改成功','../Admin/eventDetail?id='.$id);
    }
    //活动抽象用户列表
    public function codeIndex(){
        $id=I('get.id');
        $eventtitle1=I('get.eventtitle1');
        $eventtitle2=I('get.eventtitle2');
        $Code = M('code');
        $List=$Code->where('eventId="'.$id.'"')->order('lotterycode')->select();
        $this->assign('eventtitle1',$eventtitle1);
        $this->assign('eventtitle2',$eventtitle2);
        $this->assign('codes',$List);
        $this->display('codeIndex');
    }

    //精选创建表单
    public function addEventIndex(){
        $wechats = M("officialaccounts")->getField('appid,wechatname,wechatid');
        $this->assign('wechats',$wechats);
        $this->display('addEvent');
    }

    //创建精选
    public function addEvent(){
        $Event = M('event');
        $data=$_POST;
//        var_dump($data);
        $Event->add($_POST);
        $this->success('创建成功','../Admin/overview');
    }

    //删除精选
    public function delEvent(){
        $id=I('get.id');
        $Event = M('event');
        $Event->where('eventId='.$id)->delete();
        $this->success('删除成功','../Admin/overview');
    }

    //配置微信公众号页面
    public function addWechatIndex(){
        $officialaccounts = M('officialaccounts');
        $wechats=$officialaccounts->select();
        $Event=M('event');
        $zero1=date("Y-m-d H:i:s");
        for($i=0;$i<count($wechats);$i++){
            $vos=$Event->where('eventOfficialAccountId="'.$wechats[$i]['appid'].'"')->select();
            foreach($vos as $vo){
                if($vo['eventendtime']>$zero1){
                    $wechats[$i]['status']='success';
                    break;
                }
                else{
                    $wechats[$i]['status']='info';
                }
            }
        }
//        var_dump($wechats);
        $this->assign('wechats',$wechats);
        $this->display('addWechat');
    }
    //添加微信公众号
    public function addWechat(){
        $officialaccounts = M('officialaccounts');
        $data=$_POST;
//        var_dump($data);
        $officialaccounts->add($_POST);
        $this->success('创建成功','../Admin/addWechatIndex');
    }
    //删除微信公众号
    public function delWechat(){
        $id=I('get.id');
        $officialaccounts = M('officialaccounts');
        $officialaccounts->where('AppID='."'".$id."'")->delete();
        $this->success('删除成功','../Admin/addWechatIndex');
    }
}