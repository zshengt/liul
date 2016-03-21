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

    <title>众生堂</title>
</head>
<body style="background-color:#EEE;">
    <div class="catalog">
        <div class="logo">
            <img src="/Public<?php echo ($user["headimg"]); ?>">
            <span><?php echo ($user["name"]); ?>
            <a href="<?php echo U('Index/index');?>" style="font-size:16px;">众生堂首页</a>  
            </span>        
        </div>
        <div class="area">  
            <div style="float:right;width:350px;margin-right:135px;">
                <div style="float:right;">
                    |<a href="<?php echo U('Admin/Public/login');?>" style="font-size:16px;">登录</a>
                    <br/>
                    |<a href="<?php echo U('Admin/Public/register');?>" style="font-size:16px;">注册</a>
                </div>
                <ul class="nav nav-pills">
                    <?php if(is_array($firstcategorys)): $i = 0; $__LIST__ = $firstcategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li role="presentation" class='<?php if(($cid == $vo['id']) or ($secondcategorys[0]['cid'] == $vo['id'])): ?>active<?php else: endif; ?>'><a href="<?php echo U('Article/query', array('cid'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">

<div class="panel panel-default left">
  <div class="panel-heading">
    话题
  </div>
  <div ms-controller="artilist" class="panel-body">
    <div class="row">
      <div class="col-xs-12">
        <!-- <div class="input-group">
          <input type="text" class="form-control" placeholder="查询相关文章">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">查询</button>
          </span>
        </div> --><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <div class="calendar">
      <div class="dateTitle"></div>
      <div>
        <table>
          <tr class="dtr"><td class="dtd">日</td><td>一</td><td>二</td><td>三</td><td>四</td><td>五</td><td>六</td></tr>
          <tbody class="tb">
          </tbody>
        </table>
      </div>
    </div>
    <ul>
      <?php if(is_array($secondcategorys)): $i = 0; $__LIST__ = $secondcategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><li class="list-group-item">
          <a class="aitem <?php if($cate['id']==$cid) echo 'active';?>" href="<?php echo U('Article/query', array('cid'=>$cate['id']));?>"><?php echo ($cate["name"]); ?></a><span class="badge"><?php echo ($cate["amount"]); ?></span>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
</div>


<div class="panel panel-default right">
  <div class="panel-body" style="width:100%; margin: auto 0px;">
    <ul>
      <?php if(is_array($articles)): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><li class="artlist">
          <a href="<?php echo U('Article/get', array('id'=>$art['id']));?>"><?php echo ($art["title"]); ?></a>
          <div style="float:right;margin-right:40px;">
            <span class="time"><?php echo (date('Y-m-d h:m:s',$art['createtime'])); ?></span>
            <span class="badge"><?php echo ($art["like"]); ?></span>
          </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul> 
    <nav>
      <ul class="pagination pagearea">
        <li class='<?php if($page == 1): ?>disabled<?php else: endif; ?>'>
          <a href="<?php echo U('Article/query', array('cid'=>$category['cid'], 'page'=>$page-1<1?1:$page-1));?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php $__FOR_START_2486__=1;$__FOR_END_2486__=$totalpage+1;for($i=$__FOR_START_2486__;$i < $__FOR_END_2486__;$i+=1){ ?><li class='<?php if($page == $i): ?>active<?php else: endif; ?>' >
            <a href="<?php echo U('Article/query', array('cid'=>$category['cid'], 'page'=>$i));?>">
              <?php echo ($i); ?>
            </a>
          </li><?php } ?>
        <li class='<?php if($page == $totalpage): ?>disabled<?php else: endif; ?>' id="next">
          <a href="<?php echo U('Article/query', array('cid'=>$category['cid'], 'page'=>$page+1>$totalpage?$page:$page+1));?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
    <input class="page" id="page1" type="hidden" value="<?php echo ($page); ?>">
    <input class="totalpage" id="totalpage1" type="hidden" value="<?php echo ($totalpage); ?>">
  </div>
</div>
    </div>
</body>
</html>
<script src="/Public/js/myjs/article.js"></script>
<script src="/Public/js/myjs/date.js?"></script>