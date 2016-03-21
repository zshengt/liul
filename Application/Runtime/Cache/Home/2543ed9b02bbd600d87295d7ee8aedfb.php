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
  <div class="panel-body" style="border-bottom: 1px solid #EAEAEA;">
    <div class="panel-body title">
        <span><?php echo ($art["title"]); ?></span>
        <div class="info">
            <span><?php echo (date('Y-m-d h:m:s',$art["createtime"])); ?></span>
        </div>  
    </div>
    <div class="panel-body" >
     <?php echo ($art["content"]); ?>
    </div>
    <div>
      <span style="float:right;margin-right:20px;margin-bottom:20xpx;">
        <a href="<?php echo U('Article/query', array('cid'=>$cid));?>">返回列表</a>
      </span>
    </div>
    <div style="">
      <ul>
        <?php if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><li class="media">
            <a href="#" class="pull-left">
               <img src="/Public/<?php echo ($comment["headimg"]); ?>" class="talk-avatar middle">
            </a>
            <div class="media-body">                          
                <h4 class="media-heading" style="margin-top:5px;">
                    <span class="username"><a href="/index.php?m=user&amp;a=index&amp;uid=7"><?php echo ($comment["name"]); ?></a></span>
                    <small class="timeago" original-title="2015年12月10日 15:20:16">
                      <?php echo (friendlyDate($comment["createtime"])); ?>
                    </small>
                </h4>
                <div class="content">
                    <?php echo ($comment["content"]); ?>                                
                </div>
            </div>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <div style="margin-top:10px;margin-bottom:10px;">
        <div class="comment">
          <div class="form-group" style="width:auto;margin-right:30px;">
            <textarea id="comment" class="form-control" name="content" rows="5"></textarea>
          </div>
          <input type="hidden" name="tid" value="<?php echo ($art['id']); ?>" id="aid">
          <button type="submit" class="btn btn-primary" id="create">创建</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(function(){
      $("#create").click(function(){
        var content = $.trim($("#comment").val());
        var aid = $("#aid").val();
        if(content == ''){
          alert("内容不能为空");
          return false;
        }
        $.ajax({
          url: "<?php echo U('comment/add');?>",
          type: 'POST',
          dataType: 'json',
          data: {aid: aid, content: content},
          success :function(data) {
            if(data.status == 1){
              window.location.href = "<?php echo U('Article/get', array('id'=>$art['id']));?>";
            }else if(data.status == 0){
              window.location.href = "<?php echo U('Admin/Public/login');?>";
            }
          }
        });
      });
    })
  </script>
    </div>
</body>
</html>
<script src="/Public/js/myjs/article.js"></script>
<script src="/Public/js/myjs/date.js?"></script>