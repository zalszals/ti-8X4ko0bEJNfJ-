var app_name = $('#auto_jump').attr('app_name');
$(document).ready(function(){	
	$.ajax({
		url:app_name+'/index.php/Home/Login/get_menu_id',
		dataType:'json',
		success:function(re){			
			if(re.status==1){
				var other_obj = window.parent.parent.document.getElementById("menu_1").contentWindow.document.getElementById('title_'+re.menu_id);
				$(other_obj).click();
				//$("#顶级框架的id",top.window.document)
				
			}
			if(re.status==99){
				var other_obj = window.parent.parent.document.getElementById("menu_1").contentWindow.document.getElementById('head_box');
				$(other_obj).find('.jump_url').each(function(){
					if(this.href.indexOf(re.menu_url)>-1){
						$(this).parent('dd').click();
					}
				});
			}
		}
	})
	
	
	//查询任务管理里面的我的任务条数
	function get_mytask_count(){
		$.getJSON(app_name+"/index.php/Home/msg/get_task_info",function(json){
		  if(json.status){
				var msg_num=json.my_count;
				if(msg_num>99){
					msg_num='...';
				}
				if(json.my_count>0){
					$("#rwgl").html(msg_num).show();			
				}				
			}
		})		
	}
	setInterval(function() {get_mytask_count(); }, 30000); 
});
