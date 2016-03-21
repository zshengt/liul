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

    <title>登录</title>
</head>
<body class="adbody">
    <ul style="text-align:center;">
        <?php if(is_array($articles['list'])): $i = 0; $__LIST__ = $articles['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><li>
                <a href="http://www.liul.com/Home/Article/get/uid/<?php echo ($article["uid"]); ?>/cid/<?php echo ($article["cid"]); ?>/id/<?php echo ($article["id"]); ?>"> <?php echo ($article["title"]); ?>
                </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</body>