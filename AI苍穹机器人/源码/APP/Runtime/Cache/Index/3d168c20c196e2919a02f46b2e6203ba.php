<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<!-- saved from url=(0048)https://robot.paif.shop/m/accountreg?navbar=true -->
<html class="pixel-ratio-3 retina android android-5 android-5-0 watch-active-state"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>会员注册</title>

    <link rel="stylesheet" href="/Public/dianyun/css/framework7.ios.min.css">
    <link rel="stylesheet" href="/Public/dianyun/css/app.css">
    <link rel="stylesheet" href="/Public/dianyun/css/iconfont.css">


  </head>
  <body class="framework7-root">
    <div class="panel-overlay"></div>
	<div class="panel panel-left panel-reveal layout-dark">	    
	</div>
	
    <div class="views">
      <div class="view view-main">
        <div class="pages">
          <link rel="stylesheet" href="/Public/dianyun/css/wxapp.css">
<style>
    .loginNav a {display: inline-block; font-size:16px; padding-bottom: 4px;}
    .loginNav a.active {font-size: 20px; border-bottom: solid 3px #fff;}
</style>
<div class="page">
    <div class="page-content">
        <div style="min-height:80px;"></div>
        <div class="center" style="height:80px;">
            <img src="/Public/dianyun/img/logo_b.png" style="width:auto;height:36px;">
        </div>
        
        <div class="row">
            <div class="col-100 center loginNav">
                <a href="<?php echo U('Index/Login/index');?>" class="external">登录</a>
                <a style="width:60px"></a>
                <a href="javascript:;" class="active">注册</a>
            </div>
        </div>
        
        <div style="height: 40px">&nbsp;</div>
        <div class="row">
            <div class="col-10"></div>
            <div class="col-80">
               <form action="" id="myform" method="post"style="margin-top:20px">
                    <div class="input-container">
                        <div class="input-control">
                            <i class="icon iconfont icon-mobile"></i>
                            <input class="inputfield" type="text" id="mobile" name="mobile" placeholder="手机号码" maxlength="11" value="">
                        </div>
                    </div>
                    <div class="input-container">
                        <div class="input-control">
                            <i class="icon iconfont icon-mima"></i>
                            <input class="inputfield" type="password" id="password" name="password" placeholder="登录密码" value="">
                        </div>
                    </div>

                    <div class="input-container">
                        <div class="input-control">
                            <i class="icon iconfont icon-tuijianren"></i>
                            <input class="inputfield" type="text" id="parent" name="parent" placeholder="推荐人编号" value="">
                        </div>
                    </div>

               <!--      <div class="input-container">
                        <div class="row">
                            <div class="col-60">
                                <div class="input-control">
                                    <i class="icon iconfont icon-yanzhengma"></i>
                                    <input class="inputfield" type="text" name="code"  id="code"  placeholder="短信验证码" value="">
                                </div>
                            </div>
                            <div class="col-40">
                                <span id="count_down" onClick="send_sms_reg_code()">
                                    <img src="/Public/dianyun/img/button-getsms.png" style="height:auto; width: 100%;">
                                </span>
                            </div>

                        </div>
                    </div> -->

                    <div class="center">
                        <div class="space-10"></div>
                        <a href="javascript:account_reg_commit();" class="btn_submit_my">
                            <img src="/Public/dianyun/img/button-reg.png" style="height:60px; width:auto; max-width: 100%;">
                        </a>
                    </div>
                </form>
            </div>
            <div class="col-10"></div>

        </div>
    </div>

    <div style="position: absolute; left:0px; top:0px; width:100%; height: 38px;z-index:10;">
        <div style="padding: 10px;">
            <a href="javascript:history.go(-1);" class="external"><i class="icon iconfont icon-angleleft"></i>返回</a>
        </div>
    </div>
</div>


        </div>
      </div> 
    </div> 
	<script src="/Public/js/jquery-1.11.3.min.js"></script>

    <script src="/Public/js/jquery-weui.min.js"></script>
    <script src="/Public/js/jquery-1.11.3.min.js"></script>
    <script src="/Public/js/jquery-weui.min.js"></script>

<script type="text/javascript">
	$(".btn_submit_my").click(function(){
		
			$.ajax({
				url:'<?php echo U("Index/Login/regSempost");?>',
				type:'POST',
				data:$("#myform").serialize(),
				dataType:'json',
				success:function(json){
						alert(json.info);
						if(json.result ==1){
							window.location.href='<?php echo U("Index/Login/index");?>';	
						}
				},
				error:function(){
						alert("网络故障");	
				}
			})
	})

</script>

    <script type="text/javascript">
        // 发送手机短信
        function send_sms_reg_code(){
            var mobile = $('#mobile').val();
            if(!checkMobile(mobile)){
                alert('请输入正确的手机号码');
                return;
            }
            var url = "/index.php/index/sem/send_edit_code/mobile/"+mobile;
            $.get(url,function(data){
                obj = $.parseJSON(data);
                if(obj.status == 1)
                {
                    $('#count_down').attr("disabled","disabled");
                    intAs = 60; // 手机短信超时时间
                    jsInnerTimeout('count_down',intAs);
                }
                alert(obj.msg);// alert(obj.msg);

            })
        }
   $('#count_down').removeAttr("disabled");
    //倒计时函数
    function jsInnerTimeout(id,intAs)
    {
        var codeObj=$("#"+id);
        intAs--;
        if(intAs<=-1)
        {
            codeObj.removeAttr("disabled");
            codeObj.text("获取验证码");
            return true;
        }

        codeObj.text(intAs+'秒');
        setTimeout("jsInnerTimeout('"+id+"',"+intAs+")",1000);
    };
function checkMobile(tel) {
    var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
    if (reg.test(tel)) {
        return true;
    }else{
        return false;
    };
}
</script>

</body></html>