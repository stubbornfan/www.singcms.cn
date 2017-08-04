<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

    public function index(){
        if(session('adminUser')){
            $this->redirect('/admin.php?m=admin&c=index');
        }

    	return $this->display();
    }

    //登陆校验
    public function check(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if( !trim( $username ) ){
            show(0,'用户名不能为空哦~');
        }
        if( !trim( $password ) ){
            show(0,'密码不能为空哦~');
        }

        $ret = D("Admin")->getAdminByUsername($username);
        if( !$ret ){
            return show(0,'该用户不存在！');
        }

        if( $ret['password'] != getMd5Password( $password )){
            return show(0,' 密码错误~！');
        }

        session('adminUser',$ret);
        return show(1,'登陆成功');

    }

    //退出登录
    public function loginout(){
        session('adminUser',null);
        $this->redirect('/admin.php?m=admin&c=login');


    }






}