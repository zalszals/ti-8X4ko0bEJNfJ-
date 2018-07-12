
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
 * 设置leftbox的高度
 */
function resetLeftH(){
  var leftH = $(window).height() - 70;  
  $('#leftbox').height(leftH);
  //$('#left-menu').height(leftH-30);
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
 * 基础设置->分类设置->多选框变单选框（专用函数）
 */
function selectThis(obj){    
  $('.selectOne').each(function(){
    if(obj !== this){
      this.checked = false;
    }
  })
  if(obj.checked){
    var jsonData = {};
    jsonData.pid = obj.value;
    var sendData = {};
    sendData.data = jsonData;
    sendData.url = 'index.php/baseset/ArchivesClass/get_son';
	var re = getFaceInfo(sendData);
	if (re) {
	  addSonClass(obj.value, re);
	}
    /* $.ajax({
      url: 'http://dangan.chinalvgang.com/face.php',
      data: sendData,
      dataType: 'json',
      success: function (re) {
        if (re.status) {
          addSonClass(obj.value, re.data);
        }
      },
      error: function () {
        console.log('没有子类');
      }
    }) */
  }else{
    $('#class_ul_'+obj.value).empty();
  }
}
/**
 * 基础设置->分类设置（专用函数）
 */
function CommonCheckBoxClick(obj){  
  $(obj).parent('li').find('input').click();  
}
/**
 * 添加子分类
 */
function addSonClass(id, data){
  var str, className;
  $('#class_ul_' + id).empty();
  $(data).each(function () {
    className = 'pl' + (this.level - 1);
    str = '';
    str += '<li class="' + className + '">';
    str += '<input type="checkbox" class="check-box-son-one selectOne cursor" onclick="selectThis(this)" value="' + this.a_class_id + '"/>';
    str += '<span class="box-son-text cursor" onclick="CommonCheckBoxClick(this)"><i class="fa fa-angle-right"></i></span>';
    str += '<span class="box-son-text cursor" onclick="CommonCheckBoxClick(this)">' + this.a_class_name + '</span>';
    str += '</li>' + '<ul id="class_ul_' + this.a_class_id + '"></ul>';
    $('#class_ul_' + id).append(str);
  })
}
/**
 * 获取子类(左侧导航专用)
 */
function getSon(obj,id,level){
  parent.main.location.href = '/#/useraction/catalog/'+id;	
  var jsonData = {};
  var tag;
  jsonData.pid = id;
  var sendData = {};
  sendData.data = jsonData;
  sendData.url = 'index.php/baseset/ArchivesClass/get_son';
  tag = $(obj).parent().find('input').val() == 1 ? 0 : 1;
  $(obj).parent().find('input').val(tag);  
  if (!tag) {    
    $('#ul_son_' + id).empty();
    /* var len = $(obj).parent().parent().children().length - 2;
    $(obj).parent().parent().children().last().height(len * 34 + 24); */
    var tempObj = {};
    tempObj.obj = obj;
    tempObj.h = -10;
    for (var i = 1; i <= level; i++) {
      obj = resetLeftLine(obj);
    }
    resetLeftH();
    return;
  }
  var re = getFaceInfo(sendData);
  if (re) {
    addSon(obj, re, id, level);
  }
  /* $.ajax({
    url: 'http://dangan.chinalvgang.com/face.php',
    data: sendData,
    dataType: 'json',
    success: function (re) {
      if (re.status) {
        addSon(obj, re.data, id, level);
      }
    },
    error: function () {
      console.log('没有子类');
    }
  }) */
}

/**
 * 添加dom节点
 */
function addSon(obj, jsonData, id, level){
  var str, className, i;
  i = -1;
  $('#ul_son_' + id).empty();
  // return;
  $(jsonData).each(function () {
    className = 'margin_' + (this.level - 1);
    str = '';
    str += '<li class="' + className + ' cursor">';
    str += '—<i class="icon-folder-close-alt"></i>';
    str += '<span class="fifth" onclick="getSon(this,' + this.a_class_id + ',' + this.level + ')">' + this.a_class_name + '</span>';
    str += '<input type="hidden" value="0" />';
    str += '<ul class="relative" id="ul_son_'+ this.a_class_id+'"></ul>';
    str += '</li>';
    i++;
    $('#ul_son_' + id).append(str);
  })
  str = '<li class="left-line"></li>';
  $('#ul_son_' + id).append(str);
  
  var h = 34 * i + 24;
  
  if(level == 1){
	$(obj).parent().find('.left-line').height(h);  
  }else{
	$(obj).parent().find('.left-line').css('left',20).height(h);  
  } 
     
  for(var i = 1;i<=level;i++){
    obj = resetLeftLine(obj);
  }
  resetLeftH();  
}

/**
 * 修正leftline的高度
 */
function resetLeftLine(obj){
  var children_num = $(obj).parent().parent().children().length - 1;
  // alert('爸爸下面有孩子数: '+children_num);
  if(children_num == 1 ){
    return $(obj).parent().parent().parent().find('span')[0];
  }
  var len = $(obj).parent().parent().find('.fifth').length;    
  var len = len - 1;
  var ph = len * 34 + 24 //+ h + 10;
  $(obj).parent().siblings().last().height(ph);
  return $(obj).parent().parent().parent().find('span')[0];
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

  //token = localStorage.getItem("mf_token") ? localStorage.getItem("mf_token") : '5b6q6k5ot3b3ao8t9hmsfu61u5';   
  //phone = localStorage.getItem("mf_account") ? localStorage.getItem("mf_account") : '18114158893';


 
  token = localStorage.getItem("mf_token") ? localStorage.getItem("mf_token") : '6b559o6fuhh1o2nvttgj0ov003';   
  phone = localStorage.getItem("mf_account") ? localStorage.getItem("mf_account") : '18114158893';
 
 

  
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
