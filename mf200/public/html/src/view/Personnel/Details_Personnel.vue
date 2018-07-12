<template>
<div id="Application_Form_main_">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4>人员管理&nbsp;|&nbsp;详情</h4>
			</div>
			<div class="case">
				<button @click="$router.back(-1)">返回</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main_">
	<h3>{{workerlist.worker_name}}</h3>
	<p>工号:&nbsp;{{workerlist.worker_no}}</p>
	<p v-if="workerlist.sex == 0">性别:&nbsp;女</p><p v-if="workerlist.sex == 1">性别:&nbsp;男</p>
	<p>民族:&nbsp;{{workerlist.nation}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年龄:&nbsp;{{workerlist.age}}岁&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;出生年月:{{workerlist.birth_date}}</p>
	<p v-if="workerlist.group_id == 1">部门:&nbsp;{{workerlist.group_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;职务:&nbsp;{{workerlist.role_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上级:&nbsp;--</p>
	<p v-if="workerlist.group_id != 1">部门:&nbsp;{{workerlist.group_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;职务:&nbsp;{{workerlist.role_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上级:&nbsp;{{workerlist.fathergroupname}}-{{workerlist.fathername}}</p>	
	<p>工资:&nbsp;{{workerlist.price}}</p>
	<p>手机号:&nbsp;{{workerlist.phone}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;身份证号:&nbsp;{{workerlist.sfz}}</p>
	<p>办卡银行:&nbsp;{{workerlist.bank}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;银行卡号:&nbsp;{{workerlist.bank_account}}</p>
	<p>家庭住址:&nbsp;{{workerlist.address}}</p>
	<p>入职日期:&nbsp;{{workerlist.entry_date}}</p>
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
	#Application_Form_head_{
		border-bottom:  2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: 20px;
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

	.case {
		float: right;
		padding-top: 30px;
	}
	h3{
		color: orange;
		margin-top: 20px;
		margin-bottom: 30px;
		margin-left: 80px;
	}
	p{
		margin-left: 80px;
		margin-bottom: 40px;
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
                workerlist:[],
				item:[],
				worker_id:''
			}
		},
		mounted:function(){
			var worker_id = this.$route.query.worker_id;
            this.detail(worker_id);
		},
		methods: {
			detail(worker_id){
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Worker/detail";
				sendData.data = jsonData;
				jsonData.worker_id = worker_id;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.workerlist = re.data;
				}
			}
		}
	}

</script>
