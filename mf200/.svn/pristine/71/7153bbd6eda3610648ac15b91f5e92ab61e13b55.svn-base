<template>
<div id="left-box">	
	<!--grow_list k-->
	<div style=" width: 100%; height: 100%;">
		<div class="main-left-m-top">
			<div class="main-left-m-top-left">
				<H4 style="font-weight:bold; margin-top:14px;">种植区域管理</H4>
			</div>
			<div class="main-left-m-top-right">
				<span class="main-left-m-top-right-areaspan" style="cursor:pointer" v-on:click="addgrow" >+&nbsp;添加种植环境</span>
			</div><div style="clear:both"></div>
		</div>
	
	<div class="main-left-m-center-area">		
		<ul id="myTab" class="nav nav-tabs" style=" height:42px; ">
		   <li class="new-area-li-span-f growarea"  v-for="(itemtype,key) in typelist" :key="key" v-bind:id="'newnew'+itemtype.id" style="cursor:pointer;height:42px;" v-on:click="chooseid(itemtype.id)">
					<span class="main-left-m-center-area-dela hidden" v-bind:id='"arealispandel"+itemtype.id' v-on:click="thisDeltype(itemtype.id)" style="border:none; cursor:pointer">
						×
						<!--<img src="/lib/img/public/cropmode/add-new-del.png" style="margin-top:-10px; width:10px;padding:0;">-->
					</span>
						<a class="typelistspan" v-bind:href='"#"+itemtype.id' style="cursor:pointer" data-toggle="tab">
						<input type="text" readonly="readonly" style="width:74px; text-align:center; cursor:pointer; background:none; padding:0; margin:0;z-index:19; border:none;" v-bind:id='"newzinput"+itemtype.id'  v-bind:value="itemtype.type_name" >
						</a>
			 </li>

		</ul>
		<div id="myTabContent" class="tab-content" style="height:100%; background-color:#fff; line-height:35px; ">
			
			<div class="new-grow-area" style="display:flex;">
				<div id="add-new-grow-area" style="position:absolute; width:100%; right:0; top:0; display:flex;">

					<div style=" height:24px; line-height:24px; width:100%; text-align:right; border-bottom:1px solid #f5f9fa;display:flex; display:none; padding-right:10px;" id="rewre">
						<span class="f16" id="h4id" style="font-size:13px; font-weight:normal; height:24px; line-height:24px; color:#666; display:inline-block;">点击右侧按钮可修改当前区域名称</span>
						&nbsp;&nbsp;
						<span class="main-left-m-center-area-spana" id="addcentercatespan" style="cursor:pointer;display:inline-block;">
							<img id="addmypicchange" style="width:16px; height:16px;" src="/lib/img/public/cropmode/z-add-edit.jpg" />
						</span>
						<div id="displayspan" style="display:none; float:right;  height:22px; width:200px;">
                			<span class="rewrespan" role="button" style="background-color:#b0c777;cursor:pointer;" v-on:click="unlinka(typeid)">取&nbsp;&nbsp;消</span>
							<span class="rewrespana" style="cursor:pointer" v-on:click="savearea(typeid)">保&nbsp;&nbsp;存</span>
            			</div>

					</div>
				
				</div>
				<input type="text" class="form-control" style="width:15%; margin-left:30px;"  name="addareaname" placeholder="请输入名称" >&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" class="form-control" style="width:15%;"  name="addareanum" placeholder="请输入实际种植面积" >&nbsp;&nbsp;
				<label class="control-label" for="input01" >㎡</label>
				<div class="new-grow-area-span" style="line-height:32px; height:32px; cursor:pointer" @click="addarea">+ 添加</div>
			</div>
		   <div class="tab-pane fade in active" v-bind:id="typeid" >
		   		<h4 style=" height:50px; line-height:50px; padding-right:14px;" >
					<span class="main-left-m-center-area-span" id="centercatespan" ><img id="mypicchange" src="/lib/img/public/cropmode/z-add-edit-fff.jpg"  />
						<div id="abcad" style="display:none;">
							<span style="cursor:pointer" v-on:click="areaedit(edit_id)">保&nbsp;&nbsp;存</span>
							<span v-on:click="unlink(edit_id)" style="background-color:#b0c777;cursor:pointer;">取&nbsp;&nbsp;消</span>
						</div>
					</span>
				  </h4>
				
			  <ul class="main-left-m-center-area-ul" v-for="(iftype,index) in arealist" :key="index"  v-if="iftype.id==typeid">
					<li class="cursor" @click="clickLi(areaitem.area_id)" :id="'cateulli'+areaitem.area_id" v-for="(areaitem,k) in iftype.child" :key="k">
						<span class="main-left-m-center-area-del hidden" v-bind:id='"cateullispan"+areaitem.area_id' style="cursor:pointer;" v-on:click='thisDel(areaitem.area_id)'>x</span>
						<input type="text" readonly="readonly" v-bind:name='"areaeditname"+areaitem.area_id' v-bind:id='"cateulliinput"+areaitem.area_id' v-bind:value="areaitem.area_name" style="display:block; margin:5px 0;">
						<input type="text" readonly="readonly" v-bind:name='"areaeditarea"+areaitem.area_id' v-bind:id='"cateulliinputa"+areaitem.area_id' v-bind:value="areaitem.area_num"><label class="control-label" for="input01">㎡</label>
					</li>
				</ul>
			
		   </div>

		   <div class="tab-pane fade" id="newz">
			 自定义页面的内容
		   </div>
		</div>
			<div style="clear:both"></div>
	</div>
	<div style="clear:both"></div>
	</div>
	<!--添加种植类型-->
	<div id="addtypenamea" style="width:410px; height:210px; display:none; overflow:hidden;">
		<div class="layer-add-form-a">
				<input type="text" class="form-control" style="width:100%;" name="adtypename" placeholder="请输入种植环境">
		</div>

		<div class="layer-add-form-bottom">
			<span style="padding:10px 12px; float:left;display:inline;">添加种植环境</span>
			<span v-on:click="addtypename" style="padding:10px 12px; float:right;display:inline;font-weight:bold;color:#f2a652; cursor:pointer">
				<img src="/lib/img/public/cropmode/litterdh.jpg" style="margin-right:6px;">完成
		  </span>
		</div>
	</div>
	<!--添加种植类型-->
</div>
</template>				
		
<script>
export default {
	data (){
		return {
			arealist:[],
			typelist:[],
			typeid:0,
			edit_id:""
		}
	},
	mounted:function(){
		this.getlista();		
	},
	//获取种植类型的数据 list
	methods:{		
		getlista:function() {
			var sendData={};
			var jsonData={};			
			sendData.url="index.php/baseset/GrowType/lists";
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
			this.typelist = re.data;
		},
	
		chooseid: function(chooseid){
			this.typeid=chooseid;
			
			//种植区域列表
			var sendData={};
			var jsonData={};
			sendData.url="index.php/baseset/grow_area/lists";
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
      this.arealist = re.data;
		
			$("#arealispandel"+chooseid).removeClass('hidden');
			$("#newnew"+chooseid).siblings().find('.main-left-m-center-area-dela').addClass('hidden');


			var n = (document.getElementById("rewre").style.display = "block");
			document.getElementById("addmypicchange").onclick = function() {
			var m = (document.getElementById("newzinput"+chooseid).style.border ="1px solid #d7dfe2");

			var mz = (document.getElementById("newzinput"+chooseid).readOnly = false);	
				
			var ma = (document.getElementById("h4id").style.display ="none");
			var mb = (document.getElementById("addmypicchange").style.display ="none");
			var mc = (document.getElementById("displayspan").style.display ="block");

			//var p = (document.getElementById("rewre").innerHTML ='<a href="#" role="button" style="background-color:#b0c777; margin-left:8px;">取&nbsp;&nbsp;消</a><a v-on:click="hhaha" role="button" >保&nbsp;&nbsp;存</a>');
			
			};
		},
		addgrow: function() {
			layer.open({
				type: 1,
				title: false,
				area: ["410px", "210px"],
				closeBtn: 1,
				shadeClose: false,
				skin: "layer-add-form",
				content:$("#addtypenamea"),
			});
		},
		addtypename: function(){
      var that=this;
			var adtypename = $("input[name='adtypename']").val();
			if(adtypename==''){
				layer.msg("请输入种植环境");return;
			}
			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/grow_type/add";
			jsonData.type_name = adtypename;
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
      		if(re.status==1){
						layer.msg(re.msg,{time:1500},function(){
							that.typelist.push({type_name:adtypename});
							window.location.reload();
						})
			}else{
				layer.msg(re.msg);
			}
		},

		//种植类型id 是必填项 ？  
		addarea: function(){
			var that=this;
			var addareaname = $("input[name='addareaname']").val();
			if(!this.typeid){
				layer.msg("请选择种植环境");return;
			}
			if(addareaname==''){
				layer.msg("请输入名称");return;
			}

			var addareanum = $("input[name='addareanum']").val();
			if(addareanum==''){
				layer.msg("请输入实际种植面积");return;
			}

			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/grow_area/add";
			jsonData.area_name=addareaname;
			jsonData.area_num=addareanum;
			jsonData.g_type_id=this.typeid; // php端未做控制 为必填
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
			if (re.status == 1) {				
				layer.msg(re.msg, { time: 1000 },function(){					
					var sendData={};
					var jsonData={};
					sendData.url="index.php/baseset/grow_area/lists";
					sendData.data=jsonData;
					var re = getFaceInfo(sendData);
					that.arealist = re.data;
				});
			}else{
				layer.msg(re.msg, { time: 1000 },function(){
				});
			}
		},
		savearea(sid) {
			var that=this;
			var newaereaid=sid;
			var newinputarea = $("#newzinput"+sid).val();
			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/grow_type/edit";
			jsonData.type_id = newaereaid;
			jsonData.type_name = newinputarea;
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
      if (re.status == 1) {
						layer.msg(re.msg, { time: 1000 }, function(){
							//that.arealist.push({type_id:newaereaid,type_name:newinputarea}); // js样式 
							//window.location.reload();
						});
					} else {
						layer.msg(re.msg, { time: 1000 }, function(){
							window.location.reload();
						});
				}
		},
		clickLi(cid) {
			this.edit_id = cid;
			//jquery 点击出现 ‘删除’ 修复
			//var a = (document.getElementById("cateulli"+cid).style.cssText ="box-shadow:0px 0px 1px #999");
			$("#cateulli"+cid).addClass('act');
			$("#cateulli"+cid).siblings().removeClass('act');
			
			//var b = (document.getElementById("cateullispan"+cid).style.display = "inline");
			$("#cateullispan"+cid).removeClass('hidden');
			$("#cateulli"+cid).siblings().find('.main-left-m-center-area-del').addClass('hidden');

			var c = (document.getElementById("mypicchange").src =
				"/lib/img/public/cropmode/z-add-edit.jpg");
			var m = (document.getElementById("mypicchange").style.cursor= "pointer");

			document.getElementById("mypicchange").onclick = function() {
				var d = (document.getElementById("cateulliinput"+cid).style.border =
				"1px solid #d7dfe2");
				var f = (document.getElementById("cateulliinputa"+cid).style.border =
				"1px solid #d7dfe2");

				var dz = (document.getElementById("cateulliinput"+cid).readOnly = false);
				var fz = (document.getElementById("cateulliinputa"+cid).readOnly = false);

				
				var k = (document.getElementById("mypicchange").style.display ="none");
				var e = (document.getElementById("abcad").style.display = "inline");
			};
		},
		thisDel(aid) {
			layer.confirm("您确定要删除这条数据吗？",{btn: ["确定", "取消"]}
				,function() {
					var sendData = {};
					var jsonData = {};
					sendData.url ="index.php/baseset/grow_area/del";
					jsonData.area_id = aid;
					sendData.data = jsonData;
					var re = getFaceInfo(sendData);
					if (re.status == 1) {
						layer.msg(re.msg, { time: 2000 },function(){
								//页面删除							
								$('#cateulli'+aid).animate({opacity:"0"},300,'linear',function(){
									$('#cateulli'+aid).remove();	
									var e = (document.getElementById("abcad").style.display = "none");
									var k = (document.getElementById("mypicchange").style.display ="inline-block");
									var c = (document.getElementById("mypicchange").src ="/lib/img/public/cropmode/z-add-edit-fff.jpg");
									
								});
							});
					} else {
						layer.msg(re.msg, { time: 2000 }, { icon: 5 });
					}
				}
			);
		},
		thisDeltype(did) {
		layer.confirm(
			"您确定要删除这条数据吗？",
			{
			btn: ["确定", "取消"] //按钮
			},
			function() {
			
				var sendData = {};
				var jsonData = {};
				sendData.url ="index.php/baseset/grow_type/del";
				jsonData.type_id = did;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
        	if (re.status == 1) {
						
				layer.msg(re.msg, { time: 1500 }, function(){
					$("#newnew"+did).remove();
					
				});
			} else {
				layer.msg(re.msg, { time: 1500 }, { icon: 5 });
			}
			}
		);
		},
		areaedit(arid){
			var areaname = $("#cateulliinput"+arid).val();
			var areaarea = $("#cateulliinputa"+arid).val();
			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/grow_area/edit";
			jsonData.area_id = arid;
			jsonData.area_name=areaname;
			jsonData.area_num=areaarea;
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
      		if (re.status == 1) {		
				layer.msg(re.msg, { time: 1000 }, function(){
					window.location.reload();
				});
			} else {
				layer.msg(re.msg, { time: 1000 }, function(){
					window.location.reload();	
				});
			} 
		},

		unlinka(nnid){
			var m = (document.getElementById("newzinput"+nnid).style.border ="0px solid #d7dfe2");
			var ma = (document.getElementById("h4id").style.display ="inline");
			var mb = (document.getElementById("addmypicchange").style.display ="inline");
			var mc = (document.getElementById("displayspan").style.display ="none");	
			var mz = (document.getElementById("newzinput"+nnid).readOnly = true);	
		},
		
		unlink(thisid){
			//$("#addmypicchange").unbind();
				var d = (document.getElementById("cateulliinput"+thisid).style.border =
				"0px solid #d7dfe2");
				var f = (document.getElementById("cateulliinputa"+thisid).style.border =
				"0px solid #d7dfe2");
				var k = (document.getElementById("mypicchange").style.display ="inline-block");
				var e = (document.getElementById("abcad").style.display = "none");
				var dz = (document.getElementById("cateulliinput"+thisid).readOnly = true);
				var fz = (document.getElementById("cateulliinputa"+thisid).readOnly = true);
		},
		

	}
}
</script>
		
<style scoped>
	.act{ box-shadow:0px 0px 2px #ccc; }
.main-left-m-top {
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
}
.main-left-m-top-left {
  width: 60%;
  height: auto;
  float: left;
  display: inline;
}
.main-left-m-top-right {
  width: 40%;
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
.main-left-m-center {
  width: 100%;
  height: 80%;
  margin: 30px 0;
  background-color: #fff;
  padding: 10px 0;
  box-shadow: 0 0 2px #ddd;
}
.main-left-m-center table {
  width: 100%;
  height: auto;
}
.main-left-m-center table tr th {
  padding: 12px 26px;
  font-weight: bold;
  color: #333;
  border-bottom: 1px solid #ddd;
  font-size: 14px;
}
.main-left-m-center table tr td {
  padding: 12px 26px;
  font-weight: normal;
  color: #333;
  font-size: 13px;
}
.new-css-ad {
  border-right: 1px solid #eeeeee;
  vertical-align: middle !important;
}
table tr th,
td {
  text-align: center;
}

/**materiel_cate_mode**/
.h4span {
  font-weight: normal;
  font-size: 14px;
}
.main-left-m-top-right a {
  padding: 7px 20px;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  float: right;
  display: inline;
  margin-top: 12px;
  margin-left: 18px;
}
.main-left-m-center-top-add {
  padding: 7px 20px;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  margin-left: 18px;
}

.main-left-m-center-area {
  width: 100%;
  height: auto;
  margin: 20px 0;
  padding: 10px 0; background-color: #fff;
}
.new-grow-area {
  width: 100%;
  padding: 30px 0px 20px 0;
  height: auto;
  border-bottom: 1px solid #f5f9fa;
  position: relative;
}

.new-grow-area-span {
  padding: 0px 16px;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  display: inline;
  margin-left: 18px;
}

.main-left-m-center-area-span {
  width: 30%;
  height: 40px;
  line-height: 40px;
  float: right;
  display: inline;
  text-align: right;
}
.main-left-m-center-area-spana {
  width: 12px;
  height: 12px;
  float: right;
  display: inline;
  text-align: right;
}

.main-left-m-center-area-span span {
  padding: 7px 20px;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  margin-left: 18px;
  margin-top: 0px;
}
.main-left-m-center-area-ul {
  width: 100%;
  height: auto;
  padding: 0px 46px 10px 26px;
  display: block;
  margin-left: -20px;
}
.main-left-m-center-area-ul li {
  width: auto;
  height: auto;
  padding: 10px 15px;
  line-height: 22px;
  background-color: #f5f9fa;
  display: inline-block;
  font-size: 14px;
  margin-left: 18px;
  margin-top: 30px;
  color: #444;
  border-radius: 3px;
  position: relative;
}
.main-left-m-center-area-ul li input {
  width: 90px;
  height: 22px;
  line-height: 22px;
  text-align: center;
  border: none;
  background: none;
}
.main-left-m-center-area-del {
 
  position: absolute;
  right: 6px;
  top: 1px;
  z-index: 20;
}
.main-left-m-center-area-dela {
 
  position: absolute;
  right: 6px;
  top: 1px;
	height:12px;
  z-index: 20;border:none;
}
.main-left-m-top-right-areaspan {
  padding: 7px 20px;
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
#displayspan span {
  padding: 1px 14px;
  height: 20px;
  line-height: 20px;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  font-size: 9px;
  font-weight: bold;
  float: right;
  display: inline-block;
  margin-top: 2px;
	margin-right: 6px;
}

/***materiel_list k***/

.layer-add-form {
  width: 410px;
  height: 210px;
  background-color: #f5f9fa;
}
.layer-add-form-a {
  width: 400;
  height: 160px;
  padding: 55px 50px 55px 50px;
  margin: 5px;
  border-radius: 5px;
  background-color: #fff;
}
.a1input {
  display: flex;
  padding: 16px 0;
}
.layer-add-form-bottom {
  width: 100%;
  position: absolute;
  bottom: 0px;
}

/***materiel_list o***/

.new-area-li-span-f {
  position: relative;
}

.typelistspan{
		margin-right: 2px;
    
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
    position: relative;
    display: block;
    height: 42px;
		
}

.nav-tabs>li.active>span, .nav-tabs>li.active>span:focus, .nav-tabs>li.active>span:hover {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}

.f16{ font-size:12px;}
</style>