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
    <title>注册</title>
</head>
<body>
    <form id="form_register" style="width:300px;margin:100px auto;" class="form-horizontal" method="post" action="<?php echo U('Public/register');?>">
      <div class="form-group">
        <label for="email">邮箱</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="password">密码</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="repassword">确认密码</label>
        <input type="password" name="repassword" class="form-control" id="repassword" placeholder="Confirm Password">
      </div>
      <div class="form-group">
        <label for="username">用户名</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="username">
      </div>
      <div class="form-group">
        <label for="verify">验证码</label>
        <div class="form-inline">
          <div class="col-md-6" style="padding-left:0px;">
          <input type="password" class="form-control" style="width:155px;" name="verify" id="captcha">
          </div>
          <img src="<?php echo U('public/verify');?>" style="border-radius:4px;" alt="" id="verify">
          <!-- <a href="javascript:;" id="reloadVerify" title="换一张">换一张？</a> -->
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-default">注册</button>
      </div>
    </form>
</body>
<script  src="/Public/js/jquery-migrate.js"></script>
<script  src="/Public/js/jquery.validate.js"></script>
<script type="text/javascript">

  jQuery.validator.addMethod("stringCheck", function(value, element) {       
         return this.optional(element) || /^[a-zA-Z0-9\u4e00-\u9fa5-_]+$/.test(value);       
  }, "只能包含中文、英文、数字、下划线等字符");   

  $("#form_register").validate({
    rules: {
        email: {
            required: true,
            email: true,
            remote: {
                url: '<?php echo U("public/checkEmail");?>',
                type: 'post',
                dataType: "json",
                data: {
                    email: function() {
                        return $('#email').val();
                    }
                },
                dataFilter: function(data, type) {
                    if (data) {
                        return false;
                    } else {
                        return true;
                    }

                }
            }
        },
        username: {
            required: true,
            stringCheck: true,
            rangelength: [2, 10],
            remote: {
                url: '<?php echo U("public/checkName");?>',
                type: 'post',
                dataType: "json",
                data: {
                    username: function() {
                        return $('#username').val();
                    }
                },
                dataFilter: function(data) {
                    if (data == true) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        },
        password: "required",
        repassword: {
            required: true,
            equalTo: "#password"
        },
        verify: {
            required: true,
            remote: {
                url: "<?php echo U('public/checkVerify');?>",
                type: 'post',
                dataType: "json",
                data: {
                    captcha: function() {
                        return $('#captcha').val();
                    }
                },
                dataFilter: function(data, type) {
                    if (data) {
                        return true;
                    } else {
                        return false;
                    }

                }
            }
        }
    },
    messages: {
        email: {
            required: "邮箱不能为空",
            email: "邮箱格式不正确",
            remote: "邮箱已经存在"
        },
        username: {
            required: "用户名不能为空",
            rangelength: "用户名不能少于两个字",
            stringCheck: "只能包含中文、英文、数字、下划线等字符",
            remote: "用户名已存在"
        },
        password: {
            required: "密码不能为空"
        },
        repassword: {
            required: "确认密码不能为空"
        },
        verify: {
            required: "验证码不能为空",
            remote: "验证码错误"
        }
    },
    submitHandler: function(form) {
        form.submit();
    }
  });
  $('#verify').click(function(){
      var captchaUrl = "<?php echo U('public/verify');?>?t=";
      $(this).attr('src', captchaUrl + Math.random());
  });
</script>
</html>