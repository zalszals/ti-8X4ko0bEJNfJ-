<template>
<div id="Application_Form_main_">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4>人员管理&nbsp;|&nbsp;编辑</h4>
			</div>
			<div class="case">
				<button @click="do_edit()">完成</button>
				<button @click="$router.back(-1)">返回</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main_">
		<ul>
			<li class="right_">
				<p>部门<select id="groupselect" @change="change" v-model="selected">
  <option v-for="(item,index) in group" :key="index" v-bind:value="item.group_id">{{item.group_name}}</option>
</select></p>
			</li>
			<li class="right_" id="workername">
				<p>姓名 <input type="text" v-bind:value="worker.worker_name"></p>
			</li>
			<li class="right_">
				<p>性别 <input name="userid" type="radio" value="1" id="inx" v-model="sex"/>男<input name="userid" type="radio" value="0" id="inx2" v-model="sex"/>女</p>
			</li>
			<li class="right_" id="nation">
				<p>民族 <input type="text" v-bind:value="worker.nation"></p>
			</li>
			<li class="right_" id="price">
				<p>工资 <input type="text" v-bind:value="worker.price"></p>
			</li>
			<li class="right_">
				<p>职务<select id="role" v-model="roleselected">		
			<option v-for="(item,index) in role" :key="index" v-bind:value="item.role_id">{{item.role_name}}</option>		
</select></p>
			</li>
			<li class="right_" id="p">
			<p>上级 <select id="father" v-model="fatherselected">
				<option v-for="(item,index) in father" :key="index" v-bind:value="item.worker_id">{{item.role_name}} {{item.worker_name}}</option>
			</select></p>
			</li>
			<li>
				<p id="sfz">身份证号 <input type="text" v-bind:value="worker.sfz"></p>
			</li>
			<li>
				<p id="bank">办卡银行 <input type="text" v-bind:value="worker.bank"></p>
			</li>
			<li>
				<p id="address">家庭住址 <input type="text" v-bind:value="worker.address"></p>
			</li>
			<li id="csny">出生年月
				<div class="calendarWarp" style="">
					<input type="text" name="date" class='ECalendar' id="ECalendar_case1" v-bind:value="worker.birth_date"/>
				</div>
			</li>
		</ul>
		<ul>
			<li id="ipone_">手机号<input type="text" v-bind:value="worker.phone"></li>
			<li id="account">银行卡号<input type="text" v-bind:value="worker.bank_account"></li>
			<li id="date">入职日期<input type="text" v-bind:value="worker.entry_date"></li>
		</ul>
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

	input {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		padding: 5px;
		border-radius: 5px;
		margin-right: 10px;
	}
	select{
		border-style: solid;
		border-width: 0.8px;
		border-color: #EAEEF1;
		padding-left: 5px;
		padding-right: 70px;
		padding-bottom: 5px;
		padding-top: 5px;
		border-radius: 5px;
		margin-right: 10px;
		margin-left: 5px;
		margin-bottom: 10px;
	}
	#Application_Form_Date_ {
		overflow: hidden;
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

	#Application_Form_main_ {
		overflow: hidden;
	}

	#Application_Form_main_ ul {
		text-align: center;
		float: left;
		margin-top: 30px;
		margin-left: 100px;
	}

	#Application_Form_main_ ul li {
		margin-right: 30px;
		margin-top: 30px;
		margin-bottom: 30px;
	}

	#Application_Form_main_ ul li p {}

	.case {
		float: right;
		padding-top: 30px;
	}

	.right_ {
		margin-left: 30px;
	}

	#csny {
		margin-top: 900px;
	}

	#ipone_ {
		margin-left: 20px;
	}

	#page {
		margin-left: 50%;
	}
	#inx{
		margin-left: 50px;
	}
	#inx2{
		margin-left: 50px;
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
				role:[],
				worker:[],
				father:[],
				worker_id:'',
				selected:'',
				roleselected:'',
				fatherselected:'',
				sex:[]
			}
		},
		mounted:function(){
			var worker_id = this.$route.query.worker_id;
			this.edit(worker_id);
		},
		methods: {
			edit(worker_id){
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Worker/edit";
				jsonData.worker_id = worker_id;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					if(re.data.group_id == 1){
						$("#p").hide();
					}
					this.group = re.group;
					this.role = re.role;
					this.father = re.father;
					this.worker = re.data;
					this.selected = re.data.group_id;
					this.sex = re.data.sex;
					this.roleselected = re.data.role_id;
					this.fatherselected = re.data.pid;
				}
			},
			change(){
				var group_id = $('#groupselect').val();
				if(group_id == 1){
					$("#p").hide();
					$("#p p").hide();
					$("#p select").show();
				}else{
					$("#p").show();
					$("#p p").show();
					$("#p select").show();
				}
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Worker/rf";
				jsonData.group_id = group_id;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.role = re.data;
					this.father = re.father;
				}else{
					layer.msg(re.msg);
				}
			},
			do_edit(){
				var group_id = $('#groupselect').val();
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Worker/workeredit_do";
				jsonData.worker_id = this.$route.query.worker_id;
				jsonData.group_id = group_id;
				jsonData.worker_name = $("#workername input").val();
				jsonData.sex = $("input[name='userid']").val();
				jsonData.nation = $("#nation input").val();
				jsonData.price = $("#price input").val();
				jsonData.sfz = $("#sfz input").val();
				jsonData.bank = $("#bank input").val();
				jsonData.bank_account = $("#account input").val();
				jsonData.address = $("#address input").val();
				jsonData.birth_date = $("#csny input").val();
				jsonData.tel = $("#ipone_ input").val();
				jsonData.entry_date = $("#date input").val();
				jsonData.role_id = $("#role").val();
				jsonData.pid = $("#father").val();
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					layer.msg(re.msg,{time: 1500},function(){
							window.location.href = '#/router_main_Personnel_System/Personnel_Management';
					});
				}else{
					layer.msg(re.msg);
				}
			}
		}
	}

</script>
