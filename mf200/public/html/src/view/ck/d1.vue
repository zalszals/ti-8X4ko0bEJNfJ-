<template>
	<div id="d1">
		<h2>请假申请单</h2>
		<button @click="add()">完成</button>
		<button @click="$router.back(-1)">返回</button>
		<span>
			<nav>申请人 ： {{worker.worker_name}}</nav>
			<nav>部门 ： {{worker.group_name}}</nav>
			<nav>日期 ： {{worker.add_time}}</nav>
		</span>
		<p>请假类别 
		<select name="" id="select">
			<option value="0">事假</option>
			<option value="1">病假</option>
			<option value="2">调休</option>
			<option value="3">年假</option>
			<option value="4">婚假</option>
			<option value="5">产假</option>
			<option value="6">丧假</option>
			<option value="7">其他</option>						
		</select></p>
		<p>请假原因 <input type="text" placeholder="请输入请假原因" id="reason"></p>
		<p>请假时间</p>
		<span>
			<nav>开始时间<input type="text" placeholder="请选择请假开始时间" id="ECalendar_case1"></nav>
			<nav>结束时间<input type="text" placeholder="请选择请假结束时间" id="ECalendar_case2"></nav>
		</span>
		<p>请假天数<input type="text" id="day" placeholder="请输入请假天数"></p>
		<p>审批人 <select name="" id="check">
			<option v-for="(item,index) in data.worker_1" :key="index" :value="item.worker_id">{{item.worker_name}}</option>
		</select></p>
	</div>
</template>
<script>
export default {
		data() {
			return {
				data:[],
				worker:[],
				item:[]
			}
		},
		mounted:function(){
			this.getlist();
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
				,type: 'datetime'
			});				
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
				,type: 'datetime'
			});
        },
		methods: {
			getlist(){
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Leave/leave_worker";
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.data = re.data;
					this.worker = re.worker;
				}else{
					layer.msg(re.msg);
				}
			},
			add(){
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Leave/leave_add";
				jsonData.worker_id = this.worker.worker_id;
				jsonData.check_worker_1 = $('#check').val();
				jsonData.check_worker_2 = '';
				jsonData.reason = $('#reason').val();
				jsonData.day = $('#day').val();
				jsonData.s_time = $('#ECalendar_case1').val();
				jsonData.e_time = $('#ECalendar_case2').val();
				jsonData.style = $('#select').val();
				jsonData.add_time = this.worker.add_time;
				if (!$('#select').val() && $('#select').val()!= 0) {
					layer.msg('请选择请假类别');
					return;
				}
				if (!$('#reason').val()) {
					layer.msg('请输入请假原因');
					return;
				}
				if (!$('#ECalendar_case1').val()) {
					layer.msg('请选择请假开始时间');
					return;
				}
				if (!$('#ECalendar_case2').val()) {
					layer.msg('请选择请假结束时间');
					return;
				}
				if (!$('#day').val()) {
					layer.msg('请输入请假天数');
					return;
				}
				if (isNaN($('#day').val())) {
					layer.msg('请假天数必须为数字');
					return;
				}
				if (!$('#check').val()) {
					layer.msg('请选择审核人');
					return;
				}
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					layer.msg(re.msg,{time: 1000},function(){
						history.back(-1);
					});
				}else{
					layer.msg(re.msg);
				}	
			}	
		}
			
	}

</script>

