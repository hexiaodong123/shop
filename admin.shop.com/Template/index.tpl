<extend name="Common:index"/>
<block name="display">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <?php foreach($fields as $field):
                    if($field['field']!=='id'){
                       $name=$field['field'];
                       $comment=strpos($field['comment'],'@')?strstr($field['comment'],'@',true):$field['comment'];
                       if($name=='name'){
                          echo "<th><input type='checkbox' id='head'/> {\$meta_name}名称</th>\r\n";
                        }else{
                        echo "<th>$comment</th>\r\n";
                        }
                    }
                endforeach;
                echo "<th>操作</th>\r\n";
                ?>
            </tr>
            <volist name="rows" id="row">
                <tr align="center">
                    <td><input type="checkbox" class="supplier" name="id[]" value="{$row.id}"/> {$row.name} </td>
                    <td>{$row.intro}</td>
                    <td>{$row.sort}</td>
                    <td><a class="ajax-get" onclick="window.event.returnValue=false" href="{:U('change',array('id'=>$row['id'],'status'=>1-$row['status']))}"><img src=__IMG__/{$row.status}.gif></a></td>
                    <td>
                        <a href="{:U('add',array('id'=>$row['id']))}" >编辑</a>
                        <a class="ajax-get" href="{:U('remove',array('id'=>$row['id']))}" onclick="window.event.returnValue=false">删除</a>
                    </td>
                </tr>
            </volist>


        </table>
        <!-- 分页开始 -->
        <div class="digg">
            {$page_html}
        </div>

        <!-- 分页结束 -->
    </div>


</block>
