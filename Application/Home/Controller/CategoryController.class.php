<?php
namespace Home\Controller;
use Think\Controller;
class CategoryController extends Controller {

    public function query(){
        //目录
        $categorys = D('category')->getList(array("cid"=>$_GET['cid']));
        //文章列表
        if(!isset($_GET['page'])){
            $_GET['page'] = 1;
        }
        $pagecount = 5;
        $articles = D('Article')->getList(array("cid"=>$_GET['id']), $_GET['page'], $pagecount);
        $this->assign("cid", $_GET['cid']);
        $this->assign("categorys", $categorys);
        $this->assign("articles", $articles["list"]);
        $this->assign("totalcount", $articles["totalcount"]);
        $this->assign("totalpage", intval(ceil($articles["totalcount"]/$pagecount)));
        $this->assign("page", $_GET['page']);
        $this->display('./index');
    }

    public function get(){

        $categorys = D('category')->getList(array("id"=>$_GET['cid']));
        //文章列表
        $articles = D('Article')->get(array("id"=>$_GET['id']));

        $this->assign("cid", $categorys[0]['cid']);//存储父目录id

        $categorys = D('category')->getList(array("cid"=>$categorys[0]['cid']));
        $this->assign("categorys", $categorys);
        $this->assign("art", $articles[0]); //右边文章内容
        $this->display('./article');
    }

}