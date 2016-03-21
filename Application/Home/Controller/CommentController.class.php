<?php
namespace Home\Controller;
use Think\Controller;
class CommentController extends Controller {

    public function add(){
        if (!session('uid')) {
            $json = array("status"=>0);
            session('fromurl', $_SERVER['HTTP_REFERER']);
            $this->ajaxReturn($json);
        }
        $aid = I('post.aid', '', 'intval');
        $content = I('post.content', '', ''); 
        $data = array("aid"=>$aid,"uid"=>session('uid'),"createtime"=>time(),"updatetime"=>time(),"content"=>$content);
        $query = D('Comment')->add($data);
        $json = array("status"=>1);
        $this->ajaxReturn($json);
    }
}