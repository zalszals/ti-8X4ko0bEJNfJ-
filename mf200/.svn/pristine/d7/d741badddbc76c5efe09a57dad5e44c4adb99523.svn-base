<template>
	<div id="d2">
		<h2>加班申请单</h2>
		<button @click="add()">完成</button>
		<button @click="$router.back(-1)">返回</button>
		<span>
			<nav>申请人 ： {{worker.worker_name}}</nav>
			<nav>部门 ： {{worker.group_name}}</nav>
			<nav>日期 ： {{worker.add_time}}</nav>
		</span>
		<p>加班原因 <input type="text" id="reason" placeholder="请输入加班原因"></p>
		<p>加班时间</p>
		<span>
			<nav>开始时间<input type="text" placeholder="请选择加班开始时间" id="ECalendar_case1"></nav>
			<nav>结束时间<input type="text" placeholder="请选择请假结束时间" id="ECalendar_case2"></nav>
		</span>
		<p>加班天数<input type="text" id="day" placeholder="请输入加班天数"></p>
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
				sendData.url = "/index.php/pc/Leave/over_add";
				jsonData.worker_id = this.worker.worker_id;
				jsonData.check_worker_1 = $('#check').val();
				jsonData.check_worker_2 = '';
				jsonData.reason = $('#reason').val();
				jsonData.day = $('#day').val();
				jsonData.s_time = $('#ECalendar_case1').val();
				jsonData.e_time = $('#ECalendar_case2').val();
				jsonData.add_time = this.worker.add_time;
				if (!$('#reason').val()) {
					layer.msg('请输入加班原因');
					return;
				}
				if (!$('#ECalendar_case1').val()) {
					layer.msg('请选择加班开始时间');
					return;
				}
				if (!$('#ECalendar_case2').val()) {
					layer.msg('请选择加班结束时间');
					return;
				}
				if (!$('#day').val()) {
					layer.msg('请输入加班天数');
					return;
				}
				if (isNaN($('#day').val())) {
					layer.msg('加班天数必须为数字');
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
