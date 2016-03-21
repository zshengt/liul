<?php
namespace Admin\Model;
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
            return $query;
        }else{
            $this->error = '用户名或密码错误';
            return false;
        }
    }
}