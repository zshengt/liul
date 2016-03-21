<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {

    public function checkEmail(){
        $email = I("post.email", "", "");
        $User = D('Users');
        $user = $User->isEmailExists($email);
        if($user){
            echo true;
        }else{
            echo false;
        }
    }

    public function checkName(){
        $name = I("post.username", "", "");
        $User = D('Users');
        $user = $User->isUserExists($name);
        if($user){
            echo true;
        }else{
            echo false;
        }
    }

    public function register(){
        if(IS_POST){
            $email = I("post.email", "", "");
            $name = I("post.username", "", "");
            $password = I("post.password", "", "");
            $User = D('Users');
            $uid = $User->insertUser(array("email"=>$email, "name"=>$name, "password"=>$password));
            if($uid){
                $result = D( 'UsersToken' )->sendUserToken( $email, $uid, $name, 1);
                if ( $result ) {
                    $this->redirect('public/active', array('uid'=>$uid));
                } else {
                    $this->error( '注册失败' );
                }
            }else{
                $this->error('注册失败');
            }
        }else{
            $this->display();
        }
    }

    public function active(){
        $token = I('get.token','','');
        if(!empty($token)){
            $data = array(
                "token"=>$token,
                "type"=>1,
            );
            $result = D('UsersToken')->where($data)->find();
            if(!empty($result)){
                if($result['status'] == 0){
                    $this->error('该链接已经失效', U('public/register'));
                }else{
                    D('Users')->where(array('uid'=>$result['uid']))->setField('is_active', 1);
                    D('UsersToken')->where($data)->setField('status', 0);
                    $user= D('Users')->where(array('id'=>$result['uid']))->find();
                    D('Users')->autoLogin($user);
                    $this->success( '注册激活成功', U( 'Article/query' ) );
                }
            }else{
                $this->error( '你想访问的页面不存在', U( 'Public/register' ) );
            }
        }else{
            //$this->error( '你想访问的页面不存在', U( 'Public/register' ) );
            $this->display();
        }
    }

    public function login(){
        if(IS_POST){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $User = D('Users');
            $user = $User->login($email, $password);
            if($user){
                if(session('fromurl')){
                    redirect(session('fromurl'));
                }else{
                    $this->success('登录成功', U("Article/query"));
                }
            }else{
                $this->error( $User->getError() );
            }
        }else{
            //显示登录
            if(session("uid")){
                //跳转后台
                $this->redirect('Article/query');
            }
            $this->display();
        }
    }

    public function verify(){
        $config =    array(
            'fontSize'    =>    14,
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
            'imageW'      =>    165,
            'imageH'      =>    34,
        );
        $verify = new \Think\Verify( $config );
        $verify->entry();
    }

    public function checkVerify(){
        $code = I("post.captcha", '', '');
        $id = I("post.id", '', '');
        $verify = new \Think\Verify();
        $bool = $verify->check($code, $id);
        echo $bool;
    }

    public function logout(){
        if ( session('uid') ) {
            session( 'uid', null );
            $this->success( '退出成功！', U( 'login' ) );
        } else {
            $this->redirect( 'login' );
        }
    }

    /*public function active(){
        $this->display();
    }*/
}