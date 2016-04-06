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
        <span class="action-span"><a href="<?php echo U('add');?>">添加<?php echo ($meta_name); ?></a></span>
        <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
        <span id="search_id" class="action-span1"> - <?php echo ($meta_name); ?>列表 </span>
        <div style="clear:both"></div>
    </h1>


    <div class="form-div">
        <form action="<?php echo U('index');?>" name="searchForm" method="get">
            <img src="http://admin.shop.com/Public/Admin/image/icon_search.gif" width="26" height="22" border="0" alt="search" />
            <!-- 关键字 -->
            关键字 <input type="text" name="keyword" size="15" />
            <input type="submit" value=" 搜索 " class="button" />
        </form>
    </div>

<!-- 商品列表 -->

    <input type="button" value="删除" url="<?php echo U('remove');?>" class="ajax-post"/> &nbsp;
    <input type="button" value="显示" url="<?php echo U('change',array('status'=>1));?>" class="ajax-post" /> &nbsp;
    <input type="button" value="隐藏" url="<?php echo U('change',array('status'=>0));?>" class="ajax-post"/>

    
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th><input type='checkbox' id='head'/> <?php echo ($meta_name); ?>名称</th>
                <th>品牌网址</th>
                <th>品牌LOGO</th>
                <th>排序</th>
                <th>品牌简介</th>
                <th>是否显示</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr align="center">
                    <td><input type="checkbox" class="supplier" name="id[]" value="<?php echo ($row["id"]); ?>"/> <?php echo ($row["name"]); ?> </td>
                    <td><?php echo ($row["url"]); ?></td>
                    <td><?php echo ($row["logo"]); ?></td>
                    <td><?php echo ($row["sort"]); ?></td>
                    <td><?php echo ($row["intro"]); ?></td>
                    <td><a class="ajax-get" onclick="window.event.returnValue=false" href="<?php echo U('change',array('id'=>$row['id'],'status'=>1-$row['status']));?>"><img src=http://admin.shop.com/Public/Admin/image/<?php echo ($row["status"]); ?>.gif></a></td>
                    <td>
                        <a href="<?php echo U('add',array('id'=>$row['id']));?>" >编辑</a>
                        <a class="ajax-get" href="<?php echo U('remove',array('id'=>$row['id']));?>" onclick="window.event.returnValue=false">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>


        </table>
        <!-- 分页开始 -->
        <div class="digg">
            <?php echo ($page_html); ?>
        </div>

        <!-- 分页结束 -->
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