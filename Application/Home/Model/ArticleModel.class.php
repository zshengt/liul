<?php
namespace Home\Model;
use Think\Model;
class ArticleModel extends Model{

	function getList($search=array(), $page=1, $pagecount=5, $returncount=false){
		$Article = M('Article');
        if($returncount == true){
            $query = $Article->field('count(id) as totalcount')->where($search)->select();
            return $query[0]["totalcount"];
        }else{
            $query = $Article->where($search)->order('`like` desc')->limit(($page-1)*$pagecount,$page*$pagecount)->select();  
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
}