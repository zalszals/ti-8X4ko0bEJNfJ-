<template>
  <!-- 左侧区域 开始 -->
	<div id="left-box">
		<div class = "zkuang1" style="border-bottom:1px solid #e8e8e8;">
			<div class="zo" style="margin-top:14px;">
				<div class="zkuang1_0"><h4 style="font-weight:bold;">种植模式管理</h4></div>
				
			</div>
			<div class="zo2">
				<span class ="newbutton" style="cursor:pointer;" id="add" v-on:click="addmode">+ 添加种植模式</span>
			</div>
		</div>
		<div class="s1"></div>
		<Div style="height:30px;"></div>
		<!-- 表格 -->
		<div class="zbcolor">
			<table class="table table-striped table-hover">
				<tr>
					<th>序号</th>
					<th style="text-align:left">种植模式名称</th>
					<th>编辑</th>
					<th>删除</th>
				</tr>
				<tr v-for="(item,num) in typelist" :key="num" :style="{background:num%2? '#f9f9f9':'' }" :id="'newiu'+item.mode_id" >
					<td>{{item.mode_id}}</td>
					<td style="text-align:left">{{item.mode_name}}</td>
					<td>
						<span style="cursor:pointer" v-on:click='edit(item.mode_id,num)'><i class="icon-edit" aria-hidden="true"></i></span>
					</td>
					<td>
						<span style="cursor:pointer" v-on:click='del(item.mode_id)'><i class="icon-trash" aria-hidden="true"></i></span>
					</td>
				</tr>
				
			</table>
		</div>
		<!--添加和编辑 弹窗-->
		<div id="addForm" style="display:none; overflow:hidden;">
			<div class="edit100">
				<div class="editmain">
					<input type="text"  name="addmodename" placeholder="请输入种植模式" class="centerinput" >
				</div>
			</div>
			<div class="layer-add-form-bottom">
				<span style="padding:10px 12px; cursor:pointer; color:#666; float:left;display:inline;">添加种植模式</span>
				<span v-on:click="doadd" style="padding:10px 12px; cursor:pointer; float:right;display:inline;font-weight:bold;color:#f2a652;">
					<img src="/lib/img/public/cropmode/litterdh.jpg" style="margin-right:6px;">完成
				</span>
			</div>
		</div>

		<div id="editForm" style="display:none; overflow:hidden;">
			<div class="edit100">
				<div class="editmain" v-for="(itema,index) in typelist" :key="index" v-if="itema.mode_id==modeid">
					<input type="text"  v-bind:id='"modenamea"+itema.mode_id' v-bind:value="itema.mode_name" class="centerinput" >
				</div>
			</div>
			<div class="layer-add-form-bottom">
				<span style="padding:10px 12px; cursor:pointer; color:#666; float:left;display:inline;">编辑种植模式</span>
				<span v-on:click="editmodename(modeid)" style="padding:10px 12px; cursor:pointer; float:right;display:inline;font-weight:bold;color:#f2a652;">
					<img src="/lib/img/public/cropmode/litterdh.jpg" style="margin-right:6px;">完成
				</span>
			</div>
		</div>
		<!--添加和编辑 弹窗-->
	</div>
	<!-- 左侧区域 结束 -->
</template>
<script>
export default {
	data(){
		return{
			typelist:[],
			modeid:"",
			abkey:""
		}
	},
	mounted:function(){
		this.gettypelist()
	},
	methods:{
		gettypelist:function(){
			var sendData={};
			var jsonData={};
			sendData.url="index.php/baseset/grow/lists";
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
			this.typelist = re.data;
		},
		addmode(){
			layer.open({
				type: 1,
				title: false,
				area: ["410px", "200px"],
				closeBtn: 1,
				shadeClose: false,
				skin: "layer-add-form",
				content:$("#addForm")
			});	
		},
	    doadd(){
			var that=this;
			var addmodename=$("input[name='addmodename']").val();
			if(!addmodename){
				layer.msg('请输入种植模式');
				return;
			}
			var sendData={};
			var jsonData={};
			sendData.url="index.php/baseset/grow/add";
			jsonData.mode_name=addmodename;
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
			if(re.status==1){
				layer.msg(re.msg,{time:1500},function(){
					//that.typelist.push({mode_name:addmodename});    无法获得 序号 因此使用刷新
					var sendData={};
					var jsonData={};
					sendData.url="index.php/baseset/grow/lists";
					sendData.data=jsonData;
					var re = getFaceInfo(sendData);
					that.typelist = re.data;
				});
			}else{
				layer.msg(re.msg);
			}				
		},
		edit(editid,akey){
			this.modeid=editid;
			this.abkey=akey;
			layer.open({
				type: 1,
				title: false,
				area: ["410px", "200px"],
				closeBtn: 1,
				shadeClose: false,
				skin: "layer-add-form",
				content:$("#editForm"),
			});
		},		
		editmodename(saveid){
			var key=this.abkey;
			var that=this;			
			var modename=$("#modenamea"+saveid).val();
			if(!modename){
				layer.msg('请输入种植模式');return;
			}
			var sendData={};
			var jsonData={};
			sendData.url="index.php/baseset/grow/edit";
			jsonData.mode_name=modename;
			jsonData.mode_id=saveid;
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
			if(re.status==1){
				layer.msg(re.msg,{time:1500},function(){
					that.$set(that.typelist[key], `mode_name`, modename);
				});
			}else{
				layer.msg(re.msg);
			}			
		},
		del(mid) {
			layer.confirm(
				"您确定要删除这条数据吗？",{btn: ["确定", "取消"]},
				function() {
					var sendData = {};
					var jsonData = {};
					sendData.url ="index.php/baseset/grow/del";
					jsonData.mode_id = mid;
					sendData.data = jsonData;
					var re = getFaceInfo(sendData);
        			if (re.status == 1) {
							// location.href =location.href;
							layer.msg(re.msg, { time: 2000 },function(){
								$("#newiu"+mid).remove();
							});
					} else {
							layer.msg(re.msg, { time: 2000 }, { icon: 5 });
					}					
				}
			);
		},
		closeW(){
			var index = parent.layer.getFrameIndex(window.name);
			parent.layer.close();
		}
	}
}
</script>

<style scoped>
	.zkuang1{width:100%; height:70px; }
	.zkuang1_0{font-size:16px;width:100%;}
	.zkuang1_1{font-size:14px;width:100%; line-height:20px;}
	.zo{width:89%;float:left; }
	.zo2{font-size:16px;width:11%;height:25%;float:left; margin-top:0px; }
	.s1{ border-top:0px solid #C5C5C5; float:left;width:100%;height:2px;}
	.le{padding-left:20px}
	.icon-edit{font-size:16px}
	.icon-trash{font-size:16px}
	
	.zbcolor{ width:100%; height:auto;  background-color:#fff; padding-bottom:300px; box-shadow: 0 0 2px #ddd;}
	.zbcolor table{ width:100%; height:auto; }
	.zbcolor table tr th{ padding:16px 30px; font-weight:bold; color:#333; border-bottom:1px solid #ddd; font-size:14px; text-align:center;border-top: 0px;background-color:#fff}
	.zbcolor table tr td{padding:16px 30px; font-weight:normal; color:#333;  font-size:14px; text-align:center;border-top: 0px}
	.table-striped{border:none}
	.bian{border-bottom:1px solid #ddd;}

	/**弹窗**/
	.edit100{
		width:100%;
		height:200px;
		background-color:#e5f2f5;
		padding:5px;
		border-radius:8px;
	}

	.editmain{
		height:160px;
		width:400px;
		background-color:#fff;
		border-radius:8px;
		text-align:center;
	}

	.layer-add-form-bottom {
		width: 100%;
		position: absolute;
		bottom: 0px;
	}
	.centerinput{
		 width:300px;
		 height:36px;
		 line-height:36px;
		 color:#888;
		 margin-top:50px;
		 text-align:left;
		 text-indent:0.5em;
	}
	.newbutton{
	  padding: 7px 24px;
      background-color: #f2a553;
      border-radius: 3px;
      color: #fff;
      font-size: 14px;
      font-weight: bold;
	  display: inline;
      float: right;      
      margin-top: 8px;	  
	}	
</style>