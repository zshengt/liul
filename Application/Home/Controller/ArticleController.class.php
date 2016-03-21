<?php
namespace Home\Controller;
use Think\Controller;
class ArticleController extends Controller {

    public function query(){

    	//判断cid是一级目录还是二级目录
    	$query = D('category')->get(array("id"=>$_GET['cid'], "cid"=>0));
    	if($query){//一级目录
    		//左部目录
			$secondcategorys = D('category')->getList(array("cid"=>$_GET['cid']));
			//从左部目录获取uid,得到头部目录
    		$firstcategorys = D('category')->getList(array("cid"=>0, "uid"=>$query[0]['uid']));
    		
			//用户头像
			$user = D('Users')->getUser($query[0]['uid']);
    		//文章列表
			/*if(!isset($_GET['page'])){
				$_GET['page'] = 1;
			}
			$pagecount = 5;
			$articles = D('Article')->getList(array("cid"=>$_GET['cid']), $_GET['page'], $pagecount);*/
    	}else{//二级目录
    		//取父目录
    		$cate = D('category')->get(array("id"=>$_GET['cid']));
    		//左部目录
			$secondcategorys = D('category')->getList(array("cid"=>$cate[0]['cid']));
			//从左部目录获取uid,得到头部目录
    		$firstcategorys = D('category')->getList(array("cid"=>0, "uid"=>$cate[0]['uid']));

    		//用户头像
			$user = D('Users')->getUser($cate[0]['uid']);

			//文章列表
			if(!isset($_GET['page'])){
				$_GET['page'] = 1;
			}
			$pagecount = 5;
			$articles = D('Article')->getList(array("cid"=>$_GET['cid']), $_GET['page'], $pagecount);
    	}
		//var_dump($user);
		$this->assign("cid", $_GET['cid']);
		$this->assign("headimg", $user[0]['headimg']);
		//var_dump($user);
		$this->assign("firstcategorys", $firstcategorys);
		$this->assign("secondcategorys", $secondcategorys);
		$this->assign("articles", $articles["list"]);
		$this->assign("category", array("id"=>$_GET['id'], "cid"=>$_GET['cid']));
		$this->assign("totalcount", $articles["totalcount"]);
		$this->assign("totalpage", intval(ceil($articles["totalcount"]/$pagecount)));
		$this->assign("page", $_GET['page']);
        $this->display();
	}

	public function get(){
		//文章列表
		$articles = D('Article')->get(array("id"=>$_GET['id']));

		//头部目录
		$firstcategorys = D('category')->getList(array("cid"=>0, "uid"=>$articles[0]['uid']));

		//左部目录
		$secondcategorys = D('category')->getList(array("id"=>$articles[0]['cid']));

		//用户头像
		$user = D('Users')->getUser($articles[0]['uid']);

		//用户评论列表
		$comments = D('Comment')->getList(array("aid"=>$_GET['id']));
		//$this->assign("uid", $articles[0]['uid']);
		//$this->assign("cid", $secondcategorys[0]['cid']);//存储父目录id
		$this->assign("cid", $articles[0]['cid']);
		$this->assign("user", $user[0]);
		$this->assign("comments", $comments);
		$this->assign("firstcategorys", $firstcategorys);
		$this->assign("secondcategorys", $secondcategorys);
		$this->assign("art", $articles[0]); //右边文章内容
    	$this->display();
	}
}