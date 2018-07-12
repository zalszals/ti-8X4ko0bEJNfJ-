//radio_init();
//checkbox_init()
/**
 * 获取ajax数据
 */
function getAjaxData(){
	var jsonData = {};	
	var tmpArray = new Array;
	//计算出页面有多少个数组
	$('[name^="ajaxArray_"]').each(function(i){
		var k = this.name.slice(10);
		if(tmpArray.indexOf(k) == -1){
			tmpArray[i] = k;	
		}		 
	});	
	//获取每一个数组的值
	for(var i = 0; i < tmpArray.length; i++){
		var tempjson = {};			
		$('[name="ajaxArray_'+tmpArray[i]+'"]').each(function(j){			
			tempjson[j] = this.value;
		})		 
		jsonData[tmpArray[i]] = tempjson;
	}
	//获取一般的值
	$('[name^="ajax_"]').each(function(){
		var k = this.name.slice(5);		
		if($(this).attr('display')!='none'){
			//alert(k+'='+this.value);
			jsonData[k] = this.value;
		}			
	});
	//返回json数组
	return jsonData;
}

/**
 * 获取ajax_son数据
 */
function getAjaxData_son(){
	var jsonData = {};	
	var tmpArray = new Array;
	//计算出页面有多少个数组
	$('[name^="ajaxArraySon_"]').each(function(i){
		var k = this.name.slice(13);
		if(tmpArray.indexOf(k) == -1){
			tmpArray[i] = k;	
		}		 
	});	
	//获取每一个数组的值
	for(var i = 0; i < tmpArray.length; i++){
		var tempjson = {};			
		$('[name="ajaxArraySon_'+tmpArray[i]+'"]').each(function(j){			
			tempjson[j] = this.value;
		})		 
		jsonData[tmpArray[i]] = tempjson;
	}
	//获取一般的值
	$('[name^="ajax_"]').each(function(){
		var k = this.name.slice(5);
		jsonData[k] = this.value;	
	});
	//返回json数组
	return jsonData;
}

/**
 * 初始化radio
 */
function radio_init(){
	//设置初始状态	
	$('[type="radio"]').each(function(){
		if(this.checked){
			this.name = this.name.indexOf('ajax_') < 0 ? 'ajax_'+this.name : this.name;
		}
	})
	
	//添加click事件
	$('[type="radio"]').click(function(){		
		var key = this.name.indexOf('ajax_') < 0 ? this.name : this.name.slice(5);
		$('[name="ajax_'+key+'"]').attr('name',key);
		$('[name="'+key+'"]').attr('checked',false);
		this.name = 'ajax_' + key;
		this.checked = true;
	})	
}

/**
 * 初始化checkbox
 */
function checkbox_init(){
	//设置初始状态	
	$('[type="checkbox"]').each(function(){
		if(this.checked){
			this.name = this.name.indexOf('ajaxArray_') < 0 ? 'ajaxArray_'+this.name : this.name;
		}
	})
	
	//添加click事件
	$('[type="checkbox"]').click(function(){		
		var key = this.name.indexOf('ajaxArray_') < 0 ? this.name : this.name.slice(10);
		if(this.checked){
			this.name = this.name.indexOf('ajaxArray_') < 0 ? 'ajaxArray_'+this.name : this.name;
		}else{
			this.name = key;
		}		
	})	
}

/**
 * 初始化checkbox
 */
function checkbox_son_init(){
	//设置初始状态	
	$('[class="checkbox_son"]').each(function(){
		if(this.checked){
			this.name = this.name.indexOf('ajaxArraySon_') < 0 ? 'ajaxArraySon_'+this.name : this.name;
		}
	})
	
	//添加click事件
	$('[class="checkbox_son"]').click(function(){		
		var key = this.name.indexOf('ajaxArraySon_') < 0 ? this.name : this.name.slice(13);
		if(this.checked){
			this.name = this.name.indexOf('ajaxArraySon_') < 0 ? 'ajaxArraySon_'+this.name : this.name;
		}else{
			this.name = key;
		}		
	})	
}

/**
 * 获取json的长度
 */
function getJsonLength(jsonData){
	var jsonLength = 0;
	for(var i in jsonData){
		jsonLength++;
	}
	return jsonLength;
}