<?php
namespace Home\Controller;
use Think\Controller;
    class LoginController extends Controller {
    public function _initialize(){
        layout(false);//登陆页面不需要应用模板
    }
    public function index(){
        $this->display('login');
    }
        public function login(){
            $admin=M(admin);
            $userName=$_POST['userName'];
            $password=$_POST['password'];
            if($userName&&$password){
                $user=$admin->where('adminName="'.$userName.'"')->find();
                if($user){
                    if($user['adminpassword']==$password){
                        session('user',$userName);
                        $this->success('登陆成功','../Admin/overview');
                    }else{
                        $this->error("密码错误！");
                    }
                }else{
                    $this->error('账号不存在!');
                }
            }else{
                $this->error("请输入账号或密码！");
            }
        }
    }