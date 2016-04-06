namespace Admin\Model;


class <?php echo $controller_name;?>Model extends BaseModel
{
    protected $_validate=array(
    <?php foreach($fields as $field):
            $name=$field['field'];
            if($name!=='id'){
                  $comment=$field["comment"];
                  if($field['null']=='NO'){
                     echo "array('$name','require','$comment 不能为空'),\r\n";
                  }
                  if($field['key']=='UNI'){
                   echo "array('$name','','$comment 已经存在','','unique',''),\r\n";
                  }
            }

    endforeach;?>
    );
}