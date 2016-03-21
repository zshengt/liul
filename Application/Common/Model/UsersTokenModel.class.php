<?php
namespace Common\Model;
use Think\Model;
class UsersTokenModel extends Model{

    function sendUserToken($email, $uid, $name, $type){
        $Usertoken = M('users_token');
        $token = sha1(uniqid(mt_rand(), true));
        if($type == 1){
            $url = "http://".$_SERVER['HTTP_HOST'].U( 'public/active', array( 'token'=>$token ));
            $subject = '欢迎来到'.C('web_name');
            $body    = '<strong>欢迎来到'.C('web_name').'</strong><a href="' .$url. '">确认链接</a>';
        }
        $condition   = array('uid'=>$uid, 'type'=>$type);
        $token_count = $Usertoken->where($condition)->count();
        if ($token_count >0 ) {
            //更新
            $Usertoken->where($condition)->save(array('token'=>$token, 'status'=>0));
        } else {
            //创建
            $Usertoken->add( array(
                'uid'  => $uid,
                'token'=> $token,
                'type' => $type,
                'createtime' =>time()
            ) );
        }
        $result = send_email($email, $name, $subject, $body);
        return $result;
    }

    function getUser($uid){
        $User = M('Users');
        $query = $User->field('headimg')->where("id=$uid")->select();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
}