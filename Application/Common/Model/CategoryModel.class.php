<?php
namespace Common\Model;
use Think\Model;
class CategoryModel extends Model{

    function getList($search = array(), $page=1, $pagecount=5){
        $category = M("Category");
        $query = $category->where($search)->order('amount DESC')->select();
        return $query;
    }

    function get($search = array()){
        $Category = M('Category');
        $query = $Category->where($search)->select();  
        return $query;
    }

    function getCountCategory($search = array()){
        $category = M("Category");
        $categoryCount = $category->where($search)->count('id');
        return $categoryCount;
    }

    function add($data = array()){
        $flag = 0;
        foreach ($data as $key => $val) {
            if($key == "cid"&& $val == 0){
                $count = $this->getCountCategory(array("cid"=>0, "uid"=>session('uid')));
                if($count > 2){ //一级目录不可超过三个
                    $flag = 1;
                }
            }
        }
        if($flag){
            return false;
        }
        $category = M("Category");
        $query = $category->add($data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function update($id, $field = array()){
        $category = M('Category');
        $query = $category->where(array("id"=>$id, "uid"=>session('uid')))->save($field);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function delete($id){
        $category = M('Category');
        $query = $category->where(array("id"=>$id, "uid"=>session('uid')))->delete();
        if($query){
            return true;
        }else{
            return false;
        }
    }
}