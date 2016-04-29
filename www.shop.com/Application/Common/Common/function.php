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

function login($data=null){
    if($data==null){
        return session('userinfo');
    }else{
        session('userinfo',$data);
        return true;
    }
}

function is_login(){
    return login()==null?false:true;
}