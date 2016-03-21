<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {

    /**
    * 后台控制器初始化
    */
    protected function _initialize(){
        
        if (!session('uid')) {
            $this->redirect('Public/login');
        }

    }
}