<?php
namespace Common\Model;
use Think\Model;
class ArticleModel extends Model{

	function getList($search=array(), $page=1, $pagecount=5, $returncount=false){
		$Article = M('Article');
        if($returncount == true){
            $query = $Article->field('count(id) as totalcount')->where($search)->select();
            return $query[0]["totalcount"];
        }else{
            $query = $Article->where($search)->order('`createtime` desc')->limit(($page-1)*$pagecount,$page*$pagecount)->select();  
        }
        $data["list"] = $query;
        $data["totalcount"] = $this->getList($search, $page, $pagecount, true);
        return $data;
	}

    function get($search = array()){
        $Article = M('Article');
        $query = $Article->where($search)->select();  
        return $query;
    }

    function update($id, $field = array()){
        $Article = M('Article');
        $query = $Article->where(array("id"=>$id, "uid"=>session('uid')))->save($field);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function add($data = array()){
        $Article = M('Article');
        $query = $Article->add($data);
        //echo $this->getLastSql();
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function delete($id){
        $article = M('Article');
        $query = $article->where(array("id"=>$id, "uid"=>session('uid')))->delete();
        if($query){
            return true;
        }else{
            return false;
        }
    }
}