<template>
<div id="Application_Form_main_">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4>职务管理&nbsp;|&nbsp;添加职务</h4>
			</div>
			<div class="case">
				<button @click="save()">添加</button>
				<button @click="$router.back(-1)">返回</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main__">
		<div>
			部门<select id="groupselect" @change="change">
			<option value="-1">请选择部门</option>
			<option value="1">高级管理</option>
			<option v-for="(item,index) in group" :key="index" v-bind:value="item.group_id">{{item.group_name}}</option>
		</select>
		</div>
		<div clclass="qiandao">
			职务<input type="text" id="zw">
		</div>
		<div>		
			<p >权限 请勾选该职务需要添加的权限</p>
		</div>
		<div style="margin-top:30px;" id="qx">
			<div class="clear mb30 dabox" v-for="(row,index) in node_tree" :key="index">
				<p class="border-b">
					<input class="check_box margin-F check-all" type="checkbox" name="p" v-bind:value="row.node_id" @click="checkAll($event.target)"/>
					{{row.title}}					
				</p>
				<div class="left w300 box_2" v-for="(item,index) in row.child" :key="index">
					<p>
						<input class="check_box check_2" :id = "'gl'+index" type="checkbox" name="p" v-bind:value="item.node_id" @click="check($event.target)"/>
						{{item.title}}
					</p>
					<div style="margin-left:30px;">
						<p v-for="(item,index1) in item.child" :key="index1">
							<input class="check_box check_3" :id = "'ch'+item.node_id" type="checkbox" name="p" v-bind:value="item.node_id" @click="checkchild($event.target)"/>
							{{item.title}}
						</p>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
</template>

<script>
	export default {
		data() {
			return{
				group_id:-1,
				group:[],
				item:[],
				menu:[],
				common:[],
				node_tree:[]
			}	
		},
		mounted:function(){
			this.add();
			this.initPage();			
		},
		methods: {
			initPage(){
				var sendData = {};
				var jsonData = {};
				if(this.group_id == -1){
					return;
				}
				jsonData.group_id = this.group_id;
				sendData.url = "/index.php/pc/Role/all_list";
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);				
				if(re.status == 1){					
					this.node_tree = re.data;
					$("#qx").show();
				}	
			},
			checkAll(obj){				
				$(obj).parent().parent().find('input').each(function(){
					this.checked = obj.checked
				})
				
			},
			add(){
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Role/add";
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					//$("#qx").hide();
					this.group = re.group;
				}
			},
			change(){
				var group_id = $('#groupselect').val();
				this.group_id = group_id;
				this.initPage();
				$('input').each(function(){
					this.checked = false;
				})
			},
			check(index){
				var tag = 0;
				if(index.checked){					
					$(index).parents('.dabox').find('.check-all').each(function(){
						this.checked = true;
					})										
				}else{						
					$(index).parents('.dabox').find('.check_2').each(function(){
						if(this.checked){
							tag = 1;return;								
						};
					})					
					if(!tag){
						$(index).parents('div').find('.check-all').each(function(){
							this.checked = false;
						})
					}
				}
			},
			checkchild(obj){
				var tag;
				if(obj.checked){
					$(obj).parents('.dabox').find('.check-all').each(function(){
						this.checked = true;
					})
					$(obj).parents('.box_2').find('.check_2').each(function(){
						this.checked = true;
					})
				}else{					
					var dabox_checked = $(obj).parents('.dabox').find('.check-all').attr('checked');					
					
					/* if(!L3){
						$(obj).parents('.dabox').find('.check_2').each(function(){
							this.checked = false;
						})
					}
					if(L1 < 2 && dabox_checked){
						$(obj).parents('.dabox').find('.check-all').each(function(){
							this.checked = false;
						})
						$(obj).parents('.dabox').find('.check_2').each(function(){
							this.checked = false;
						})
					} */	
				}
			},			
			save(){
				var group_id = $('#groupselect').val();
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Role/save";
				jsonData.group_id = group_id;
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
						window.location.href = '/#/router_main_Personnel_System/Job_Mangement';
					});
				}else{
					layer.msg(re.msg);
				}
			}
		}
	}
</script>

<style scoped>
	* {

		margin: 0;
		padding: 0;
		font-family: "微软雅黑";
		font-weight: 500;
	}
	.margin-F{margin-left:-30px;}
	.mb30{margin-bottom: 30px;}
	.border-b{border-bottom:1px solid #666;line-height: 35px;}
	.check_box{
		width:18px;height:18px;
	}
	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: 20px;
		margin-bottom: 60px;
	}

	#Application_Form_main__ div {
		/* margin-left: 150px; */
		/*		margin-top: 60px;*/
	}

	#Application_Form_Date_ {
		overflow: hidden;
	}

	input {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		padding: 5px;
		border-radius: 5px;
		margin-right: 10px;
		margin-top: 30px;
		margin-left: 30px;
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

	.case {
		float: right;
		padding-top: 30px;
	}

	h3 {
		color: orange;
		margin-top: 20px;
		margin-bottom: 30px;
		margin-left: 80px;
	}

	p {
		margin-left: 80px;
		/* margin-bottom: 40px; */
	}

	.qiandao {
		height: 500px;
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
