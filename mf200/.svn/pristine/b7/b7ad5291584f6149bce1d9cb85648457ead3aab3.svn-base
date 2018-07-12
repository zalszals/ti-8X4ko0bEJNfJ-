<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>审批单</h4>
            </div>       
            <div class="">
				<select id="select" @change="change()"> 
				  <option value="1">待审批</option>
				  <option value="2">已审批</option>
				</select>
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar' id="ECalendar_case1" placeholder="请选择开始日期"/>
                </div>至
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar' id="ECalendar_case2" placeholder="请选择结束日期"/>
                </div>
                <input id="name" type="text" class="ECalendar calendarWarp" placeholder="请输入员工姓名"/>
                <select id="selected"> 
				  <option value="0">请选择单据类型</option>
				  <option value="1">请假</option>
				  <option value="2">加班</option>
				  <option value="3">调休</option>
				  <option value="4">出差</option>
				</select>
                <button @click="search()">筛选</button>
				<button @click="jq()">请假</button>
                <button @click="jb()">加班</button>
                <button @click="tx()">调休</button>
                <button @click="cc()">出差</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
       <div v-for="(item,index) in data" :key="index" @click="detail(item.b_id)">
			<nobr class="left_no">{{item.worker_name}}</nobr>
			<nobr class="left_no">{{item.tyle_name}}</nobr>
			<nobr class="right_no">{{item.add_time}}</nobr>
       </div>	    
    </div>
	<div id="page_new" class="paing">
		<ul class="pages" v-if="pages > 1">
			<li @click="getlist(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
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

	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: -110px;
		height: 80px;
	}

	input {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		padding: 5px;
		border-radius: 5px;
		margin-right: 10px;
	}

	#Application_Form_Date_ {}

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
		/*        float: left;*/
		font-size: 15px;
		font-weight: bold !important;
		padding-top: 30px;
		margin-left: 30px;
		margin-right: 300px;
	}

	.case {
		float: right;
		margin-top: -30px;
	}

	select {
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

	#Application_Form_main_ div {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		border-radius: 5px;
		width: 1000px;
		background-color: white;
		height: 60px;
		margin-left: 80px;
		margin-top: 30px;
		font-size: 20px;
		text-align: center;
		line-height: 60px;
		overflow: hidden;
	}
	.right_no{
		float: right;
		margin-right: 40px;
	}
	.left_no{
		float: left;
		margin-left: 80px;
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
	#page_new {
		margin-top: 40px;
		position: relative;
		left: 30%;
	}
	.pages {
		overflow: hidden;
	}

	.pages li {
		border-style: solid;
		border-width: 1.8px;
		border-color: #EAEEF1;
		border-radius: 5px;
		padding: 5px;
		background-color: white;
		float: left;
	}

</style>
<script>
	export default {
		data() {
			return {
				data:[],
				item:[],
				pages:'',
				page:'',
			}
		},
		mounted:function(){
			this.getlist(1);
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
			});				
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});
        },
		methods: {
			getlist(page){
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Leave/regroup";
				jsonData.page = page;
				jsonData.class_type = 2;
				jsonData.type = $('#select').val();;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.data = re.data;
					this.pages = re.total.pages;
					this.page = re.total.page;
				}else{
					layer.msg(re.msg);
				}
			},
			search(){
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Leave/regroup";
				jsonData.page = 1;
				jsonData.class_type = 2;
				jsonData.type = $('#select').val();
				jsonData.start = $('#ECalendar_case1').val();
				jsonData.end = $('#ECalendar_case2').val();
				jsonData.worker_name = $('#name').val();
				jsonData.style = $('#selected').val();
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.data = re.data;
					this.pages = re.total.pages;
					this.page = re.total.page;
				}else{
					layer.msg(re.msg);
				}
			},
			detail(b_id){
				this.$router.push({name: 'Approval_Sheet_Detaile_History', query: { b_id:b_id }});
			},
			change(){
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Leave/regroup";
				jsonData.page = 1;
				jsonData.class_type = 1;
				jsonData.type = $('#select').val();
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.data = re.data;
					this.pages = re.total.pages;
					this.page = re.total.page;
				}else{
					layer.msg(re.msg);
				}
			},
			jq(){
				window.location.href="#/router_main_Inventory_System/d1";
			},
			jb(){
				window.location.href="#/router_main_Inventory_System/d2";
			},
			tx(){
				window.location.href="#/router_main_Inventory_System/d3";
			},
			cc(){
				window.location.href="#/router_main_Inventory_System/d4";
			}		
		}
			
	}

</script>
