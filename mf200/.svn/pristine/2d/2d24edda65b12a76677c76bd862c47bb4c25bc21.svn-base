
/**
 * 监听窗口改变
 */
$(window).resize(function () {
    //initW();
});
/**
 * 初始化页面宽度
 */
function initW(){
    var w;
    w = $('body').width();
	//alert(w);
    $('#left-box').width(w - 435);
}

/**
 * 模拟include
 */
function do_include(){
    $('include').each(function(){
        var obj = $(this);
        var url = obj.attr('src');
        $.get(url,function(html){
            obj.append(html);
        })
    })
}


/**
 * 获取接口信息
 */
function getFaceInfo(sendData){
  var resultJsonData,token;
  
  if(window.localStorage){
    // alert('This browser supports localStorage');
  }else{
    alert('您的浏览器不支持本系统，请更换谷歌浏览器');
    return;
  }
  
  token = localStorage.getItem("dangan_token") ? localStorage.getItem("dangan_token") : '7v64u0m1s541ifjh8726qu22f3'; 
  // token = localStorage.getItem("dangan_token");
  console.log(token);
  $.ajax({
    url: 'http://27.221.53.90:881/face.php?token='+token,
    data: sendData,
    async: false,
    dataType: 'json',
    success: function(re){
      if(re.status==1){
        resultJsonData = re.data;
      }
      if(re.status == -1){
        parent.location.href = '/login';  
      }         
    },
    error: function(){
      layer.msg('网络延迟，请稍后再试！');
    }
  })
  return resultJsonData;
}

/**
 * 获取接口信息
 */
function getLoginInfo(sendData){
  var resultJsonData;
  if(window.localStorage){
    // alert('This browser supports localStorage');
  }else{
    alert('您的浏览器不支持本系统，请更换谷歌浏览器');
    return;
  }
  $.ajax({
    url: 'http://27.221.53.90:881/face.php?token=111',
    data: sendData,
    async: false,
    dataType: 'json',
    success: function(re){
		resultJsonData = re;
    },
    error: function(){
		resultJsonData = '';
		layer.msg('网络延迟，请稍后再试！');
    }
  })
  return resultJsonData;
}