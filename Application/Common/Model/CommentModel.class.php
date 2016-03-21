<?php
namespace Common\Model;
use Think\Model;
class CommentModel extends Model{

    function getList($search=array()){
        $Comment = M('Comment');
        $query = $Comment->field('users.name, users.headimg, comment.content, comment.createtime')
            ->join('users on users.id = comment.uid')
            ->where($search)
            ->order('`createtime` asc')
            ->select();  
        return $query;
    }

    function add($data = array()){
        $Comment = M('Comment');
        $query = $Comment->add($data);
        return $query;
    }
}