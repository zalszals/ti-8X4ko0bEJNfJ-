<template>
<div id="Application_Form_main_">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4>职务管理&nbsp;|&nbsp;编辑职务权限</h4>
			</div>
			<div class="case">
				<button @click="do_edit()">完成</button>
				<button @click="$router.back(-1)">返回</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main__">
<div>
	部门<select id="groupselect" @change="change" v-model="selected">
			<option v-for="(item,index) in group" :key="index" v-bind:value="item.group_id">{{item.group_name}}</option>
		</select>
</div>
<div>
	职务<input type="text" id="zw" v-bind:value="role.role_name">
</div>
<div>
	
	<p>权限 请勾选该职务需要添加的权限</p>
</div>
<div id="qx">
			<div>
				<p>管理权限</p>
				<div v-for="(item,index) in menu" :key="index">
					<p><input :id = "'gl'+item.node_id" type="checkbox" name="menu" v-bind:value="item.node_id" @change="check(item.node_id)" v-if="judge(item.node_id)" checked/><input :id = "'gl'+item.node_id" type="checkbox" name="menu" v-bind:value="item.node_id" @change="check(item.node_id)" v-else/>{{item.title}}</p>
					<div><p v-for="(item1,index1) in item.child" :key="index1"><input :id = "'gl'+item1.node_id" type="checkbox" name="child" v-bind:value="item1.node_id" @change="checkchild(item.node_id,item1.node_id)" v-if="judge(item1.node_id)" checked/><input :id = "'gl'+item1.node_id" type="checkbox" name="child" v-bind:value="item1.node_id" @change="checkchild(item.node_id,item1.node_id)" v-else/>{{item1.title}}</p></div>
				</div>
			</div>
			<div>
				<p>基础权限</p>
				<div v-for="(item,index) in common" :key="index">
					<p><input :id = "'gl'+item.node_id" type="checkbox" name="common" v-bind:value="item.node_id" @change="checkt(item.node_id)" v-if="judge(item.node_id)" checked/><input :id = "'gl'+item.node_id" type="checkbox" name="common" v-bind:value="item.node_id" @change="checkt(item.node_id)" v-else/>{{item.title}}</p>
					<div><p v-for="(item1,index1) in item.child" :key="index1"><input :id = "'gl'+item1.node_id" type="checkbox" name="child" v-bind:value="item1.node_id" @change="checkchildt(item.node_id,item1.node_id)" v-if="judge(item1.node_id)" checked/><input :id = "'gl'+item1.node_id" type="checkbox" name="child" v-bind:value="item1.node_id" @change="checkchildt(item.node_id,item1.node_id)" v-else/>{{item1.title}}</p></div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<style scoped>
	* {

		margin: 0;
		padding: 0;
		font-family: "微软雅黑";
		font-weight: 500;
	}

	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: 20px;
		margin-bottom: 30px;
	}

	#Application_Form_main__ div {
		margin-left: 50px;
		/*		margin-top: 60px;*/
	}

	#Application_Form_Date_ {
		overflow: hidden;
	}
	input {
		border-style: solid;
		border-width: 0.8px;
		border-color: #EAEEF1;
		padding-left: 5px;
/*		padding-right: 10px;*/
		padding-bottom: 5px;
		padding-top: 5px;
		border-radius: 5px;
		margin-right: 10px;
		margin-left: 30px;
		margin-top: 30px;
		margin-bottom: 20px;
	}
	
	#Application_Form_Date_ button {
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 2px;
		padding-bottom: 2px;
		color: white;
		border: 0;
		border-radius: 5px;
		background-color: #F4A356;
	}

	#w_Warehouse {
		float: left;
		font-size: 15px;
		font-weight: bold !important;
		padding-top: 30px;
		margin-left: 30px;
	}

	select {
		border-style: solid;
		border-width: 0.8px;
		border-color: #EAEEF1;
		padding-left: 5px;
		padding-right: 60px;
		padding-bottom: 5px;
		padding-top: 5px;
		border-radius: 5px;
		margin-right: 10px;
		margin-left: 30px;
	}

	#Application_Form_main_ {
		overflow: hidden;
	}

	#Application_Form_main_ {
		overflow: hidden;
	}

	.case {
		float: right;
		padding-top: 30px;
	}
</style>
<style>
	.pageButton {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		background-color: white;
		margin-left: 5px;
		margin-top: 5px;
	}

	.prePage {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		background-color: white;
		margin-left: 5px;
		margin-top: 5px;
	}

	.nextPage {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		background-color: white;
		margin-left: 5px;
		margin-top: 5px;
	}

</style>
<script>
	export default {
		data() {
			return {
                group:[],
				item:[],
				item1:[],
				role:[],
				menu:[],
				common:[],
				selected:'',
				checkbox:[]
			}
		},
		mounted:function(){
			var role_id = this.$route.query.role_id;
			this.edit(role_id);
		},
		methods: {
			edit(role_id){
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Role/edit";
				jsonData.role_id = role_id;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.group = re.data;
					this.role = re.role;
					this.menu = re.menu;
					this.common = re.common;
					this.selected = re.role.group_id;
					var arr = new Array();
					arr = re.role.node_str.split(',');
					this.checkbox = arr;
				}
			},
			change(){
				var group_id = $('#groupselect').val();
				if(group_id == 0){
					$("#qx").hide();
				}else{
					$("#qx").show();
				}
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Role/change";
				jsonData.group_id = group_id;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.menu = re.data;
					this.common = re.common;
				}else{
					layer.msg(re.msg);
				}
			},
			check(index){
				if($('#gl'+index).prop('checked')){
					$('#gl'+index).parent().next().find('input').each(function(i,val){
						val.checked = true;
					});
				}else{
					$('#gl'+index).parent().next().find('input').each(function(i,val){
						val.checked = false;
					});
				}
			},
			checkchild(index,node_id){
				var el = 1;
				if($('#gl'+node_id).prop('checked')){
					$('#gl'+index).prop('checked',true);
				}else{
					$('#gl'+node_id).parent().siblings().find('input').each(function(i,val){
						if(val.checked){
							el = 1;
							return false;
						}else{
							el = 0;
						}
					});
					if(!el){
						$('#gl'+index).prop('checked',false);
					}
				}
			},
			checkt(index){
				if($('#gl'+index).prop('checked')){
					$('#gl'+index).parent().next().find('input').each(function(i,val){
						val.checked = true;
					});
				}else{
					$('#gl'+index).parent().next().find('input').each(function(i,val){
						val.checked = false;
					});
				}
			},
			checkchildt(index,node_id){
				var el = 1;
				if($('#gl'+node_id).prop('checked')){
					$('#gl'+index).prop('checked',true);
				}else{
					$('#gl'+node_id).parent().siblings().find('input').each(function(i,val){
						if(val.checked){
							el = 1;
							return false;
						}else{
							el = 0;
						}
					});
					if(!el){
						$('#gl'+index).prop('checked',false);
					}
				}
			},
			do_edit(){
				var role_id = this.$route.query.role_id;
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Role/editsave";
				jsonData.role_id = role_id;
				jsonData.role_name = $("#zw").val();
				var node = new Array();
				$("#qx input:checked").each(function(i,val){
					node[i] = val.value; 
				});
				var node1 = node.sort(function(a,b){return a - b;});
				var node2 = node1.join(',');
				jsonData.node_str = node2;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					layer.msg(re.msg,{time: 1500},function(){
							window.location.href = '#/Job_Mangement';
					});
				}else{
					layer.msg(re.msg);
				}
			},
			judge(node_id){
				if($.inArray(node_id+"",this.checkbox) != -1){
					return true;
				}else{
					return false;
				}
			}
		}
	}
	
</script>
