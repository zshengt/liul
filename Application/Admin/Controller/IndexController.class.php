<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {

    public function index(){
        $this->assign("active", "arti_edit");
        $articles = D('Article')->getList(array(),1,9999999,'');
        $this->assign("articles", $articles);
        $this->display();
    }

}