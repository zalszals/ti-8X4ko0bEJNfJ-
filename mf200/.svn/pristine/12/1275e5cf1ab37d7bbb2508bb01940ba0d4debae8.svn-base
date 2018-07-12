<template>
	<div id="left-box">
		<!-- 头部标题 开始 -->
		
		<div class="main-left-m-top">
			<div class="main-left-m-top-left">
				<H4 style="font-weight:bold; margin-top:14px;">工序管理</H4>
			</div>
			<div class="main-left-m-top-right">
				<span style="background-color:#b0c777; cursor:pointer" onclick="go_back(-1)">返 回</span>
				<!--<a href="#">保&nbsp;&nbsp;存</a>-->
			</div><div style="clear:both"></div>
		</div>
		<!-- 头部标题 结束 -->
		<!-- 内容部分 开始-->
		<ul class="neirong-box mt30 bgc-1" style="background-color:#fff;">
			<li>
				<div class="fiveyejiaoa">
					<input type="text" name="gongxu"  style="text-indent:0.5em; width:180px; line-height:32px;display:inline-block;" placeholder="请输入工序名称"/>   
				</div>
				<div class="fiveyejiaoa">
					<input type="text" name="danwei" style="text-indent:0.5em; width:180px; line-height:32px;display:inline-block;" placeholder="请输入对应的单位"/>
				</div>
				<span style="padding:5px 10px; cursor:pointer; display:inline-block; background-color:#f2a553; border-radius: 3px; color: #fff; font-size: 14px;" v-on:click="savegx">+ 添 加</span>
			</li>

			<li class="mt10 clear">
				<p class="f12 fc-4">
					若添加多个单位，请用"," (逗号)隔开
				</p>
				<hr class="mt5 mb45"/>
				<div style=" width:100%; height:auto;">
					<p>已添加的工序
						<span class="main-left-m-center-cate-span" id="centercatespan">
							<img id="mypicchange"  src="/lib/img/public/cropmode/z-add-edit-fff.jpg" />
						</span>

						<span class="main-left-m-center-cate-span" id="centercatespana" style="display:none; cursor:pointer;" v-on:click="gedit(gid)">
							<img id="mypicchange"  src="/lib/img/public/cropmode/z-add-edit.jpg" />
						</span>

					</p>
					
				</div>
				<ul class="zb skill2 mb30">

					<li v-for="item in glist" class="ski2 text-center" @click="showkk(item.skill_id)" v-bind:id="'listli'+item.skill_id">
						<span class="sk1 hidden" style="cursor:pointer;" v-on:click="del(item.skill_id)">×</span>
						<span class="sk2" id="gx">{{ item.skill_name }}</span>
						<p class="ski-borer hidden"></p>
					</li>
					<!--
					<li class="ski2 text-center" @click="showkk($event.currentTarget)" >
						<span class="sk1 hidden" v-on:click="del">×</span>
						<span class="sk2" id="gx">打扫卫生</span>
						<p class="ski-borer hidden"></p>
					</li>
					-->
				</ul>
				<!-- 这是工序单位 -->
				<p class="fc-4 f12 hidden">已选中工序所对应的单位</p>
				<div class="zb dwill2 hidden" >
					<div class="dwi2 text-center">
						<span class="dw2" v-for="item in glist" v-if="item.skill_id==gid" >单位：{{item.unit_str}}</span>
					</div>	
				</div>
				
			</li>
			
		</ul>
		<!-- 内容部分 结束-->
		<!-- 添加 编辑弹窗-->
		<div id="editForm" style="background-color:#e5f2f5;width:610px;height:312px;border-radius:5px; overflow:hidden; display:none" v-for="(item,index) in glist" v-if="item.skill_id==gid">
			<div style=" width:600px; height:260px; margin:5px; background-color:#fff;" >
				<div style=" height:60px;"></div>
				<div style=" width:400px; height:160px; margin:0 auto;" > 
					<p>工序名称<input type="text" name="editgongxu"  style="width:260px; text-indent:0.5em; line-height:32px; margin-left:15px;" v-bind:value="item.skill_name" /></p>
					<p>对应单位<input type="text" name="editdanwei"  style="width:260px; text-indent:0.5em; line-height:32px; margin-left:15px; margin-top:30px;" v-bind:value="item.unit_str" /></p>
					<p style="font-size:12px; color:#999; text-indent:6.5em; line-height:30px;">若添加多个单位，请用“,”逗号隔开</p>
				</div>
			</div>
			<div class="layer-add-form-bottom">

				<span style="padding:10px 12px; font-weight:bold; float:left;display:inline;">编辑工序</span>
				<span v-on:click="doEdit(gid,index)" style="padding:10px 12px; float:right;display:inline;font-weight:bold;color:#f2a652;cursor:pointer;"><img src="/../lib/img/public/cropmode/litterdh.jpg" style="margin-right:6px;">保存</span>
				
			</div>
		</div>
		<!-- 添加 编辑弹窗-->
	</div>
</template>
<script>
  export default {
	data() {
		return {
			gid:"",
			glist:[]
		};
	},
	mounted: function() {//页面加载完成后掉用的函数
		this.resetWidth();
		this.getlist();
	},
	methods: {
		
		showkk:function(id) {
			this.gid=id;
			
			$('.ski-borer').addClass('hidden');
			$('.sk1').addClass('hidden');
			
			$("#centercatespan").attr("style","display:none");
			$("#centercatespana").attr("style","display:block;cursor:pointer;");
			
			$("#listli"+id).find('p').removeClass('hidden');
			$("#listli"+id).find('.sk1').removeClass('hidden');			
			$('.f12').removeClass('hidden');
			$('.dwill2').removeClass('hidden');



		},
		del: function(id) {
			layer.confirm('是否删除当前工序',{btn:['确定','取消']},function(){ 

				var sendData = {};
				var jsonData = {};
				sendData.url ="index.php/baseset/Skill/del";
				jsonData.skill_id=id;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
        		if(re.status==1){
							layer.msg(re.msg,{time:1500},function(){
								$("#listli"+id).remove();
								$('.dwill2').addClass('hidden');
								$("#centercatespana").attr("style","display:none");
								$("#centercatespan").attr("style","display:block");
							});
				}else{
							layer.msg(re.msg);
			    }
				/*
				sendData.url ="27.221.53.90:880/index.php/baseset/Skill/del";
				jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
				jsonData.phone = "18114158894";
				jsonData.skill_id=id;
				sendData.data = jsonData;
				$.ajax({
					url:"http://dangan.chinalvgang.com/pass.php",
					data:sendData,
					dataType:"Json",
					success:function(re){	
						if(re.status==1){
							layer.msg(re.msg,{time:1500},function(){
								$("#listli"+id).remove();
								$('.dwill2').addClass('hidden');
							});
						}else{
							layer.msg(re.msg);
						}
					}.bind(this)
				})	*/

			});
		},
		resetWidth: function(){
			$('.sk2').each(function(){
				var sk2 = $(this).text();
				var len = sk2.length;
				var w = len * 20 + 20 ;
				var lef = len*9;
				$(this).parent('li').css('width',w);
				$(this).parent('li').find('p').css('width',w);
				$(this).parent('li').children('.sk1').css('left',lef);
			});
		},
		
		// 工序列表
		getlist(){
		
			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/Skill/skill_list";
			//默认的group_id =2 需要修改
			jsonData.group_id =2;
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
        	this.glist = re.data;

			/*
			sendData.url ="27.221.53.90:880/index.php/baseset/Skill/skill_list";
			jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
			jsonData.phone = "18114158894";

			jsonData.group_id =2;
			sendData.data = jsonData;
			//var abcd=getFaceInfo(sendData);
		    //console.log(abcd);
			$.ajax({
				url:"http://dangan.chinalvgang.com/face.php",
				data:sendData,
				dataType:"Json",
				success:function(re){	
					this.glist=re.data;
				}.bind(this)
			})*/
				
		},

		savegx(){
			var that =this;
			//添加工序
			var ngongxu=$("input[name='gongxu']").val();
			//console.log(ngongxu);
			if(ngongxu==''){
				layer.msg("请输入工序名称");return;
			}
			var ndanwei=$("input[name='danwei']").val();
			if(ndanwei==''){
				layer.msg("请输入对应的单位");return;
			}
			//console.log(ndanwei);
			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/Skill/pc_add";
			jsonData.group_id=2;
			jsonData.skill_name=ngongxu;
			jsonData.unit_str=ndanwei;
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
			
			if(re.status==1){
				layer.msg(re.msg,{time:1000},function(){
					 var sendData = {};
					 var jsonData = {};
					 sendData.url ="index.php/baseset/Skill/skill_list";
					 jsonData.group_id =2;
					 sendData.data = jsonData;
					 var re = getFaceInfo(sendData);
					 that.glist = re.data;
				});
			}else{
				layer.msg(re.msg);return;
			}

		},

		gedit(getid){
		  //编辑
		  layer.open({
          type: 1,
          title: false,
          area: ["610px", "312px"],
          closeBtn: 1,
          shadeClose: false,
          skin: "layer-add-form",
          content: $("#editForm")
		  });
		},

		doEdit(geiid,key){
			
			//接口中 工序名称和 工序单位是分开编辑的
			var aeditgx=$("input[name='editgongxu']").val();
			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/Skill/pc_edit";
			jsonData.skill_id= geiid;
			jsonData.skill_name= aeditgx;
			console.log(geiid);
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
			//this.getzhz = re.data;
			var a=0;
			if(re.status==1){
				a=1;
				this.$set(this.glist[key], `skill_name`, aeditgx);
				
			}else{

				layer.msg(re.msg);
			}
			
			if(geiid){
				var vm=this;
				var aeditdw=$("input[name='editdanwei']").val();
				var sendData = {};
				var jsonData = {};
				sendData.url ="index.php/baseset/Skill/pc_unit_edit";
				jsonData.skill_id= geiid;
				jsonData.unit_str= aeditdw;

				sendData.data = jsonData;
				var res = getFaceInfo(sendData);
				var b=0;
        		if(res.status==1){
					b=1;
					vm.$set(vm.glist[key], `unit_str`, aeditdw)
				
				}
			}
			
			if(a==0&&b==0){
			 	layer.msg("存在相同工序名称");
			}else{
				 layer.msg("编辑成功");
				 window.location.reload();
			}

		},

		dogoback(){
			this.$router.back(-1);
		},

	}
  }
</script>

<style scoped>
.zb{border:0px solid red;width:100%;float:left;line-height:20px;}
.ski-borer{position:absolute;top:0;left:0;width:120px;height:45px;border:1px solid #ccc;border-radius:5px;z-index:1}
.btn{padding: 4px 12px}
.border-bottom{border-bottom:1px solid #d0dadc;}
input{border-radius: 2px;height:30px;border-style:none;border:1px solid #d0dadc; }
.neirong-box{padding:50px;border-radius: 2px;box-shadow: 1px 1px 50px #eaeaea;}
.skill2 li{margin-right:15px;width:120px;background-color:#F3F9F9;height:45px;margin-top:40px;display:block;color:#666666;font-weight:600;float:left;border-radius:5px}
.sk1{font-size:12px;width:100%;position:absolute;top:-2px;left:43px;z-index:2}
.sk2{font-size:14px;line-height:45px;}
.ski2{position:relative;text-align:center;}
.hiddendd{background-color: #666666;}
.dw2{font-size:14px;line-height:45px;}
.dwi2{position:relative;text-align:center;}

.dwill2 div{margin-right:15px;width:120px;background-color:#F3F9F9;height:45px;display:block;color:#666666;font-weight:600;float:left;margin-top:15px;border-radius:5px}

.main-left-m-center-cate-span {
  width: 30%;
  height: 40px;
  line-height: 40px;
  float: right;
  display: inline;
  text-align: right;
}

.main-left-m-center-cate-span span {
  padding: 7px 20px;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  margin-left: 18px;
  margin-top: 0px;
}


.fiveyejiaoa{
  display: inline-block;
  margin-right: 10px;
  width:180px;
}
.main-left-m-top {
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
}
.main-left-m-top-left {
  width: 40%;
  height: auto;
  float: left;
  display: inline;
}
.main-left-m-top-right {
  width: 60%;
  height: auto;
  float: right;
  display: inline;
}
.main-left-m-top-right a {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-right a:visited {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-right a:hover {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-right span{
  padding: 6px 24px;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  float: right;
  display: inline;
  margin-top: 8px;
  margin-left: 18px;
}
</style>
