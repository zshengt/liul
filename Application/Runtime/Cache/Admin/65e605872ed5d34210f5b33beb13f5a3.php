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
    <div style="border-bottom:1px solid #eee;height:30px;">
      用户详情
    </div>
    <div style="margin-top:10px;">
        <form id="user-save" action="<?php echo U('User/save');?>" method="post" class="form-horizontal">
            <div class="form-group form-inline">
                <div class="col-md-8">
                    <span>
                        用户名:
                    </span>
                    <input type="text" id="name" name="name" class="form-control" 
                    style="width:50%;" value="<?php echo ($user['name']); ?>" placeholder="添加用户名">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary" id="save">保存</button>
                </div>
            </div> 
        </form>  
    </div>

    <script type="text/javascript">
       /* $('#user-save').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo U('User/save');?>",
                data: $("#talk-add").serialize(),
                success: function(data){
                    if (data.status == 0) {
                        alert(data.info);
                        return  false;
                    } else {
                        window.location.href = data.url;
                    }
                }
            });
        });*/
    </script>
</section>