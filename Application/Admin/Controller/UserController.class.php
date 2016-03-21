<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {

    public function index(){
        //users
        $user = D('Users')->where()->find();
        unset($users['password']);
        unset($users['is_active']);
        //put value
        $this->assign("user", $user);
        $this->assign("active", "arti_query");

        //show view
        $this->display();
    }

    public function save(){
        $uid = session('uid');
        $name = I('post.name','','');
        $data = array('name'=>$name);
        $query = D('Users')->where("id=$uid")->data($data)->save();
        if($query){
            $this->success('保存成功', U('User/index'));
        }else{
            $this->error('保存失败');
        }
    }
}