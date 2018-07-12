/**
 * 监听窗口改变
 */
$(window).resize(function () {
    initW();
});

/**
 * 初始化页面宽度
 */
function initW(){
    var w;
    w = $('body').width();	
    $('#left-box').width(w - 415);
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
 * 获取地址栏参数
 */
function I(name) {
  var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
  var r = window.location.href.substr(1).match(reg);
  if (r != null) return unescape(r[2]); return null;
}

/**
 * 基础设置->分类设置（专用函数）
 */
function CommonCheckBoxClick(obj){  
  $(obj).parent('li').find('input').click();  
}

/**
 * 获取接口信息
 */
function getFaceInfo(sendData){
  var resultJsonData,token,phone;
  
  if(window.localStorage){
	// alert('This browser supports localStorage');
  }else{
	alert('您的浏览器不支持本系统，请更换谷歌浏览器');
	return;
  } 

  token = localStorage.getItem("mf_token");   
  phone = localStorage.getItem("mf_account");

  //token = 'r8g0gnrhe4rerfrkieg4s0svc0';   
  //phone = '18600975888';
  
  console.log('phone:'+phone);
  console.log('token:'+token);  
  sendData.data.token = token;
  sendData.data.phone = sendData.data.phone ? sendData.data.phone : phone;
  //console.log(sendData.data);return;
  $.ajax({
    url: 'http://27.221.53.90:881/face.php?token='+token,
    data: sendData,
    async: false,
    type: 'post',
    dataType: 'json',
    success: function(re){      
      if(re.status > -1){
        resultJsonData = re;        
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
 * 返回上一页
 */
function go_back(){
	self.location = document.referrer;
}