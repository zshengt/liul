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
    <div class="container-fluid back">
        <div class="topcontent">
            <div class="logoarea">
                <img src="/Public<?php echo session('headimg'); ?>" style="height:60px;">
            </div>
            <div class="topmenu">
                <a class="navhead"><img src="/Public/img/video.png" style=""></a>
                <a class="navhead"><img src="/Public/img/music.png" style=""></a>
                <a class="navhead" href="<?php echo U('public/logout');?>">
                    <img src="/Public/img/exit.png" style="">
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
        <dd><a class="aitem" href="#">用户信息</a></dd>
    </dl>
</div>


<section>
    <form id="talk-edit" action="" method="post" class="form-horizontal">
        <div class="form-group">
            <div class="col-md-4">
                <select name="cid" id="cid" class="form-control">
                    <option value="">选择分类</option>
                    <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($article['cid'] == $vo['id']): ?>selected="selected"<?php endif; ?> ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="col-md-6">
                <input type="text" id="title" name="title" class="form-control" value="<?php echo ($article["title"]); ?>" placeholder="标题">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <script type="text/plain" id="editor" style="width:660px;height:350px;"></script>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <input  type="hidden" name="aid"  value="<?php echo ($article["id"]); ?>">
                <button type="submit" class="btn btn-primary" id="create">更新</button>
            </div>
        </div> 
    </form>   
</section>
<link href="/Public/js/editor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script src="/Public/js/editor/umeditor.config.js"></script>
<script src="/Public/js/editor/umeditor.min.js"></script>
<script src="/Public/js/editor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    $(function() {
        var um = UM.getEditor('editor', {
            toolbar: ['bold italic underline insertorderedlist insertunorderedlist  image '],
            UEDITOR_HOME_URL: "/Public/js/editor/",
            imageUrl: "<?php echo U('Article/upload');?>",
            imagePath: "/Public/upload/attach/",

            autoClearinitialContent: true,
            wordCount: false,
            elementPathEnabled: false,
            autoFloatEnabled: false,

            textarea: 'content'
        });
        um.setContent('<?php echo ($article["content"]); ?>');

        $('#talk-edit').on('submit', function(e) {
            e.preventDefault();
            var cid     =  $('#cid').val();
            var title =  $.trim($('#title').val());
            if (cid =='') {
                alert('分类不能为空');
                return false;
            }
            if (title == '') {
                alert('标题不能为空');
                return false;
            }
            if (um.hasContents() == false) {
                alert('内容不能为空');
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo U('article/update');?>",
                data: $("#talk-edit").serialize(),
                success: function(data){
                    if (data.status == 0) {
                        alert(data.info);
                        return  false;
                    } else {
                        window.location.href = data.url;
                    }
                }
            });
        });
    });
</script>