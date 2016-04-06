<?php

function error($model){
    $msg='<ul>';
    $errors=$model->getError();
    if(is_array($errors)){
        foreach($errors as $error ){
            $msg.="<li>".$error."</li>";
        }
    }else{
        $msg.="<li>".$errors."</li>";
    }
    $msg.="</ul>";
    return $msg;
}