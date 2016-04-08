$(function() {
    $(".ajax-post").click(function () {
      var type=$(this).prop('type');
      if(type=="submit"){
        var form = $(this).closest('form');
        var url = form.attr('action');
        var data = form.serialize();
      }else if(type=="button"){
        var url=$(this).attr('url');
        var data=$('.supplier:checked').serialize();
      }

      $.ajax({
        type: "post",
        url: url,
        data: data,
        async: false,
        success: showAjaxLayer //这里是回调函数
      });
    });


    $(".ajax-get").click(function () {
      var url = $(this).attr('href');
      $.ajax({
        type: "get",
        url: url,
        async: false,
        success: showAjaxLayer
      });
    });
});



function showAjaxLayer(msg){
  //console.debug(msg);
  if(msg.status==1){
    layer.open({
      content: msg.info,
      scrollbar: false,
      icon:1,
      time:2000,
      end:function(){
        location.href=msg.url;
      }
    });
  }else{
    layer.open({
      content:msg.info,
      scrollbar:false,
      icon:2,
      time:2000
    });
  }
}

