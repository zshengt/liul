<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller {

    public function query(){
        //article
        $articles = D('Article')->getList(array("uid"=>session('uid')));

        //put value
        $this->assign("articles", $articles);
        $this->assign("active", "arti_query");

        //show view
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $cid      = I( 'post.cid', 0 , 'intval' );
            $title  = I( 'post.title', '', '' );
            $content  = I( 'post.content', '', '' );

            empty( $cid ) &&  $this->error( '分类不能为空' );
            empty( $title ) && $this->error( '标题不能为空' );
            empty( $content ) && $this->error( '内容不能为空' );

            $time = time();

            $query = D('Article')->add(array("cid"=>$cid, "title"=>$title,
             "content"=>$content, "createtime"=>$time, "updatetime"=>$time, "uid"=>session('uid')));
            if($query){
                $this->success('创建成功', U('article/query'));
            }else{
                $this->error('创建文章失败');
            }
        }else{
            //category cid != 0
            $category = D('Category')->getList(array("cid"=>array('neq','0'), "uid"=>session('uid')));

            $this->assign("category", $category);
            $this->assign("active", "arti_edit");
            $this->display();
        }
    }

    public function edit(){
        //article
        $id = I('get.id', 0, 'intval');
        $article = D('Article')->get(array("id"=>$id));

        //category cid != 0, uid = session('uid')
        $category = D('Category')->getList(array("cid"=>array('neq','0'), "uid"=>session('uid')));

        //put value
        $this->assign("category", $category);
        $this->assign("article", $article[0]);
        $this->assign("active", "arti_edit");
        
        //show view
        $this->display('');
    }

    public function update(){
        $aid      = I( 'post.aid', 0, 'intval' );
        $cid      = I( 'post.cid', 0 , 'intval' );
        $title  = I( 'post.title', '', '' );
        $content  = I( 'post.content', '', '' );

        empty( $aid ) &&  $this->error( '文章ID不能为空' );
        empty( $cid ) &&  $this->error( '分类不能为空' );
        empty( $title ) && $this->error( '标题不能为空' );
        empty( $content ) && $this->error( '内容不能为空' );

        $query = D('Article')->update($aid, array("cid"=>$cid, "title"=>$title, "content"=>$content,
         "updatetime"=>time()));

        if($query){
            $this->success('修改成功', U('article/edit', array('id' => $aid))); 
        }else{
            $this->error('修改话题失败');
        }
    }

    public function delete() {

        $id = I('get.id', '', '');
        $query = D('Article')->delete($id);
        if($query){
            $this->success('删除成功', U('article/query'));
        }else{
            $this->error('删除文章失败');
        }
    }

    public function upload() {

        import( 'ORG.Net.UploadFile' );
        $uploader = new \UploadFile();
        $uploader->allowExts  = array( 'jpg', 'gif', 'png', 'jpeg' );
        $uploader->autoSub =true ;
        $uploader->hashLevel = 3;
        $uploader->thumb = true;
        $uploader->thumbPrefix = '';
        $uploader->thumbSuffix = '_thumb';
        $uploader->thumbMaxWidth = '600';
        $uploader->thumbMaxHeight = '600';
        $uploader->thumbType = '0';
        $uploader->savePath = 'Public/upload/attach/';
        $uploader->saveRule = uniqid;
        if ( $uploader->upload() ) {
            $info =  $uploader->getUploadFileInfo();
            $thumbImage =  explode( '.', $info[0]['savename'] );
            $url   = $thumbImage[0] .'_thumb.' .$thumbImage[1];
            echo json_encode( array(
                    'url'=>$url,
                    'title'=>htmlspecialchars( $_POST['pictitle'], ENT_QUOTES ),
                    'original'=>$info[0]['name'],
                    'state'=>'SUCCESS'
                ) );
        }else {
            echo json_encode( array(
                    'state'=>$uploader->getErrorMsg()
                ) );
        }
    }

}