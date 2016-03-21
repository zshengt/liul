<?php
namespace Home\Model;
use Think\Model;
class CategoryModel extends Model{

    function getList($search = array(), $page=1, $pagecount=5){
        $category = M("Category");
        $query = $category->where($search)->order('amount DESC')->select();
        return $query;
    }

    function get($search = array()){
        $category = M("Category");
        $query = $category->where($search)->select();
        return $query;
    }   
}