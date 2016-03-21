<?php
namespace Common\Model;
use Think\Model;
class UsersModel extends Model{

    function login($email, $password, $admin=false){
        $User = M('Users');
        $query = $User->where(array("email"=>$email, "password"=>sha1($password)))->select();
        if($query){
            $auth = array(
                "id" => $query['id'],
                "email" => $query['email']
            );
            session('user_auth', $auth);
            //跳转后台
            session( 'uid', $query[0]['id'] );
            session( 'headimg', $query[0]['headimg'] );
            return $query;
        }else{
            $this->error = '用户名或密码错误';
            return false;
        }
    }

    public function isEmailExists($email) {
        $user = $this->where( array( 'email'=>$email ) )->find();
        if ( $user ) {
            return  true;
        }else {
            return  false;
        }
    }

    public function isUserExists($name) {
        $user = $this->where( array( 'name'=>$name ) )->find();
        if ( $user ) {
            return  true;
        }else {
            return  false;
        }
    }

    public function insertUser($user){
        foreach ($user as $key => $value) {
            if($key == "password"){
                $user[$key] = sha1($value);
            }
        }
        //此处给他随机安排图片
        $user['headimg'] = "/img/headimg/".mt_rand(1,26).".png";
        $User = M('Users');
        $query = $User->add($user);
        if($query){
            return $query;
        }else{
            return false;
        }
    }

    public function autoLogin($user){
        $auth = array(
            "id" => $user['id'],
            "email" => $user['email']
        );
        session('user_auth', $auth);
        //跳转后台
        session( 'uid', $user['id'] );
        session( 'headimg', $user['headimg'] );
    }
    
    function getUser($uid){
        $User = M('Users');
        $query = $User->where("id=$uid")->select();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
}