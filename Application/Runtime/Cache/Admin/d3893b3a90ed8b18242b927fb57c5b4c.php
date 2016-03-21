<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-cmn-Hans">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="/Public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/css/mycss.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="/Public/js/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="/Public/js/bootstrap.min.js"></script>
    <script src="/Public/js/bootstrap.min.js"></script>

    <title>众生堂</title>
</head>
<body class="adbody">
    <div class="container-fluid back">
        <div class="topcontent">
            <div class="logoarea">
                <img src="/Public<?php echo session('headimg'); ?>" style="height:60px;">
            </div>
            <div class="topmenu">
                <a class="navhead" href="<?php echo U('Home/Index/index');?>" target="view_window">首页</a>
                <!-- <a class="navhead"><img src="/Public/img/music.png" style=""></a> -->
                <a class="navhead" href="<?php echo U('public/logout');?>">
                    退出
                </a>
            </div>
        </div>
    </div>
    <div class="maincontain">
        <div class="leftnav">
    <dl>
        <dt>话题管理</dt>
        <dd><a class="aitem <?php if($active=='cate_query') echo 'active';?>"
         href="<?php echo U('Category/query');?>">话题列表</a></dd>
    </dl>
    <dl>
        <dt>文章管理</dt>
        <dd><a class="aitem <?php if($active=='arti_query') echo 'active';?>"
         href="<?php echo U('Article/query');?>">文章列表</a></dd>
        <dd><a class="aitem <?php if($active=='arti_edit') echo 'active';?>"
         href="<?php echo U('Article/add');?>">文章编辑</a></dd>
    </dl>
    <dl>
        <dt>用户管理</dt>
        <dd><a class="aitem" href="<?php echo U('User/index');?>">用户信息</a></dd>
    </dl>
</div>


<section>
    <table class="table">
        <tbody>
            <tr>
                <th>ID</th>
                <th>title</th>
                <th>cid</th>
                <th>like</th>
                <th>updatetime</th>
                <th>createtime</th>
                <th>operation</th>
            </tr>
        </tbody>
        <?php if(is_array($articles['list'])): foreach($articles['list'] as $key=>$article): ?><tr>
                <td><?php echo ($article["id"]); ?></td><td><?php echo ($article["title"]); ?></td><td><?php echo ($article["cid"]); ?></td><td><?php echo ($article["like"]); ?></td><td><?php echo friendlyDate($article['updatetime']);?></td><td><?php echo friendlyDate($article['createtime']);?></td><td><a href="<?php echo U('Article/edit', array('id'=>$article['id']));?>"><img style="width:20px;height:20px;margin-top:-5px;" src="/Public/img/edit.png"/></a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?php echo U('article/delete', array('id'=>$article['id']));?>"><img style="width:18px;height:18px;margin-top:-5px;" src="/Public/img/del.png"/></a>
                </td>
            </tr><?php endforeach; endif; ?>
    </table> 
</section>