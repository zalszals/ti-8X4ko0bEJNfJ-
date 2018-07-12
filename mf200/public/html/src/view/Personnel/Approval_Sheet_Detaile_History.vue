<template>
<div id="Application_Form_main_">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4>审批单&nbsp;|&nbsp;详情</h4>
			</div>
			<div class="case">
				<button @click="check(data.b_id)" v-if="worker == data.check_worker_1">审核</button>
				<button @click="$router.back(-1)">返回</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main_">
		<p style="color:orange;">申请人&nbsp;:&nbsp;&nbsp;{{data.worker_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;部门&nbsp;:&nbsp;&nbsp;{{data.group_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;申请时间&nbsp;:&nbsp;&nbsp;{{data.add_time}}</p>		
		<p v-if="data.type == 3">出差事项&nbsp;:&nbsp;&nbsp;{{data.reason}}</p>
		<p v-if="data.type == 3">出差地点&nbsp;:&nbsp;&nbsp;{{data.address}}</p>
		<p v-if="data.type == 3">出差时间&nbsp;:&nbsp;&nbsp;{{data.s_time}}&nbsp;至&nbsp;&nbsp;{{data.e_time}}</p>
		<p v-if="data.type == 3">费用预估&nbsp;:&nbsp;&nbsp;{{data.money}}</p>
		<p v-if="data.type == 0">请假类别&nbsp;:&nbsp;&nbsp;{{data.style_name}}</p>
		<p v-if="data.type == 0">请假原因&nbsp;:&nbsp;&nbsp;{{data.reason}}</p>
		<p v-if="data.type == 0">请假时间&nbsp;:&nbsp;&nbsp;{{data.s_time}}&nbsp;至&nbsp;&nbsp;{{data.e_time}}</p>
		<p v-if="data.type == 0">请假天数&nbsp;:&nbsp;&nbsp;{{data.day}}</p>
		<p v-if="data.type == 1">加班原因&nbsp;:&nbsp;&nbsp;{{data.reason}}</p>
		<p v-if="data.type == 1">加班时间&nbsp;:&nbsp;&nbsp;{{data.s_time}}&nbsp;至&nbsp;&nbsp;{{data.e_time}}</p>
		<p v-if="data.type == 1">加班天数&nbsp;:&nbsp;&nbsp;{{data.day}}</p>
		<p v-if="data.type == 2">调休原因&nbsp;:&nbsp;&nbsp;{{data.reason}}</p>
		<p v-if="data.type == 2">加班时间&nbsp;:&nbsp;&nbsp;{{data.time_1}}&nbsp;至&nbsp;&nbsp;{{data.time_2}}</p>
		<p v-if="data.type == 2">调休时间&nbsp;:&nbsp;&nbsp;{{data.s_time}}&nbsp;至&nbsp;&nbsp;{{data.e_time}}</p>
		<p v-if="data.status > 0">审核人&nbsp;:&nbsp;&nbsp;{{data.check_name_1}}</p>
		<p v-if="data.status == 1">审核意见&nbsp;:&nbsp;&nbsp;同意</p>
		<p v-if="data.status == 3">审核意见&nbsp;:&nbsp;&nbsp;不同意</p>
		<p v-if="data.status > 0">审核时间&nbsp;:&nbsp;&nbsp;{{data.check_time_1}}</p>
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

	#Application_Form_main_ div div {
		text-align: center;
	}

	#Application_Form_main_ div div button {
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 2px;
		padding-bottom: 2px;
		color: white;
		border: 0;
		border-radius: 5px;
		background-color: #F4A356;
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
		margin-top: 40px;
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
				item:[],
				worker:''
			}
		},
		mounted:function(){
			var b_id = this.$route.query.b_id;
            this.detail(b_id);
		},
		methods: {
			detail(b_id){
				var sendData = {};
                var jsonData = {};
				sendData.url = "/index.php/pc/Leave/regroup_list";
				jsonData.b_id = b_id;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
                if(re.status == 1){
					this.data = re.data;
					this.worker = re.worker;
                }
			},
			check(b_id){
				var val = layer.confirm("确认审核？", {
                    btn: ["通过", "不通过"],
                    title: [""]
                },function(){
                   	var sendData = {};
					var jsonData = {};
					sendData.url = "/index.php/pc/Leave/leave_check";
					jsonData.b_id = b_id;
					jsonData.type = 1;
					sendData.data = jsonData;
					var re = getFaceInfo(sendData);
					if(re.status == 1){
						layer.msg(re.msg,{time: 1000},function(){
							history.back(-1);
						});
					}else{
                        layer.msg(re.msg);
                    }
            	},function(){
                    var sendData = {};
					var jsonData = {};
					sendData.url = "/index.php/pc/Leave/leave_check";
					jsonData.b_id = b_id;
					jsonData.type = 2;
					sendData.data = jsonData;
					var re = getFaceInfo(sendData);
					if(re.status == 1){
						layer.msg(re.msg,{time: 1000},function(){
							history.back(-1);
						});
					}else{
                        layer.msg(re.msg);
                    }
                })	
			}
		}	
	}

</script>
