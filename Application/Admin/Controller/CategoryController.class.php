<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller {

    public function query(){
        //categorys
        $categorys = D('Category')->getList(array("uid"=>session('uid')));

        //put value
        $this->assign("categorys", $categorys);
        $this->assign("active", "cate_query");

        //show view
        $this->display();
    }

    public function edit(){
        //categorys
        $id = I('get.id', '', '');
        $category = D('Category')->get(array("uid"=>session('uid'), "id"=>$id));
        //当为一级目录时,前台不予显示下拉框
        if($category[0]['cid'] != 0){
            $categorys = D('Category')->get(array("uid"=>session('uid'), "cid"=>0));
            
            //put value
            $this->assign("categorys", $categorys);
        }

        $this->assign("active", "cate_edit");
        $this->assign("category", $category[0]);

        //show view
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $cid = I('post.cid', '', '');
            $name = I('post.title', '', '');
            $query = D('Category')->add(array("cid"=>$cid, "name"=>$name, "uid"=>session('uid')));
            if($query){
                $this->success("添加目录成功", U('category/query'));
            }else{
                $this->error("添加目录失败");
            }
        }else{
            //categorys
            $categorys = D('Category')->getList(array("uid"=>session('uid'), "cid"=>0));

            //put view
            $this->assign("categorys", $categorys);

            $this->display();  
        }
    }

    public function update(){
        $id = I('post.id', '', '');
        $cid = I('post.cid', '', '');
        $name = I('post.title', '', '');
        $query = D('Category')->update($id, array("name"=>$name, "cid"=>$cid, "updatetime"=>time()));
        if($query){
            $this->success("修改目录成功", U('category/query'));
        }else{
            $this->error("修改目录失败");
        }
    }

    public function delete(){
        $id = I('get.id', '', '');
        
        $query = D('Category')->delete($id);
        if($query){
            $this->success("删除目录成功", U('category/query'));
        }else{
            $this->error("删除目录失败");
        }
    }
}