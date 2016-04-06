<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - <?php echo ($meta_name); ?>列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/Admin/css/page.css" rel="stylesheet" type="text/css" />
     
</head>
<body>

    <h1>
        <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
        <span id="search_id" class="action-span1"> - <?php echo ($meta_name); ?> </span>
        <div style="clear:both"></div>
    </h1>


<!-- 商品列表 -->

    
    <div class="form-div">
        <form method="post" action="<?php echo U('index');?>">
            控制器名:<input type="text" name="controller_name"/>&nbsp;
            <input type="submit" value="生成代码"/>
        </form>
    </div>

<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/layer-v2.1/layer/layer.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/common.js"></script>

<script type="text/javascript">
    $(function(){
       $("#head").click(function(){
           $(".supplier").prop('checked',$(this).prop('checked'));
       });
        $(".supplier").click(function(){
            var length;
            length=$(".supplier:checked").length;
            if(length==4){
                $("#head").prop('checked',true);
            }else{
                $("#head").prop('checked',false);
            }
        });

    });

</script>
</body>
</html>