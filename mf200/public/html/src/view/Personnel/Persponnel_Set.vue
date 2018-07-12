<template>
<div id="Application_Form_main_">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4>员工考勤&nbsp;|&nbsp;设置</h4>
			</div>
			<div class="case">
				<button @click="add()">完成</button>
				<button @click="$router.back(-1)">返回</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main__">
		<div>
			部门<select id="groupselect" @change="change()">
			<option v-for="(item,index) in group" :key="index" v-bind:value="item.group_id">{{item.group_name}}</option>
		</select>
		</div>
		<div clclass="qiandao">
			签到时间<input id="start" type="text" v-bind:value="data.start">
		</div>
		<div claclass="qiandao">
			签退时间<input id="end" type="text" v-bind:value="data.end">
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
		margin-bottom: 60px;
	}

	#Application_Form_main__ div {
		margin-left: 150px;
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
		margin-bottom: 40px;
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
<script>
	export default {
		data() {
			return {
				data:[],
				group:[],
				item:[],
			}
        },
        mounted:function(){
            this.getlist();
		},
		methods: {
			getlist(){
				var sendData = {};
                var jsonData = {};
				sendData.url = "/index.php/pc/WorkerRecord/time_list";
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.data = re.data;
					this.group = re.group;
				}
			},
			change(){
				var sendData = {};
                var jsonData = {};
				var group_id = $('#groupselect').val();
				sendData.url = "/index.php/pc/WorkerRecord/time_list";
				jsonData.group_id = group_id;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.data = re.data;
					this.group = re.group;
				}
			},
			add(){
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/WorkerRecord/add_time";
				jsonData.group_id = $('#groupselect').val();
				jsonData.start = $('#start').val();
				jsonData.end = $('#end').val();
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					layer.msg(re.msg,{time: 1500},function(){
							window.location.reload();
					});	
				}else{
					layer.msg(re.msg);
				}
			}
		}
	}

</script>
