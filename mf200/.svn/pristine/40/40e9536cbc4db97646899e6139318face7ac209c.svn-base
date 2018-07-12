<template>
<div id="Application_Form_main_">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4 class="tit">员工考勤</h4>
			</div>
			<div class="case">
				<select id="select">
  					<option value="1">本月</option>
  					<option value="2">上月</option>
				</select>
				<div class="calendarWarp" style="">
					<input type="text" name="date" class='ECalendar' id="ECalendar_case1" placeholder="请选择开始时间"/>
				</div>至
				<div class="calendarWarp" style="">
					<input type="text" name="date" class='ECalendar' id="ECalendar_case2" placeholder="请选择结束时间"/>
				</div>
				<input id="name" type="text" class="ECalendar calendarWarp" placeholder="请输入员工姓名"/>
				<input id="group" type="text" class="ECalendar calendarWarp" placeholder="请输入部门姓名"/>
				<input id="role" type="text" class="ECalendar calendarWarp" placeholder="请输入职务姓名"/>
				<button @click="search()">搜索</button>
				<button @click="set()">设置</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main_">
	<div id="Application_Form_main_top">
            <div v-for="(item,index) in data" :key="index" @click="detail(item.worker_id)" id='inin'>
                <table>
                    <tr>
                        <td class="tdimgjpg">
							<h4>{{item.worker_name}}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>部门:&nbsp;{{item.group_name}}</p>
                        </td>
                        <td>
                            <p>职务:&nbsp;{{item.role_name}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>迟到:&nbsp;{{item.cd_num}}</p>
                        </td>
                        <td>
                            <p>早退:&nbsp;{{item.zt_num}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>未签到:&nbsp;{{item.wqd_num}}</p>
                        </td>
                        <td>
                            <p>未签退:&nbsp;{{item.wqt_num}}</p>
                        </td>
                    </tr>
                                        <tr>
                        <td>
                            <p>请假:&nbsp;{{item.qj_num}}</p>
                        </td>
                        <td>
                            <p>外勤:&nbsp;{{item.wq_num}}</p>
                        </td>
                    </tr>
                                        <tr>
                        <td>
                            <p>加班:&nbsp;{{item.jb_num}}</p>
                        </td>
                        <td>
                            <p>调休:&nbsp;{{item.tx_num}}</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getlist(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
			</ul>
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
/*		float: right;*/
		margin-top: -30px;
		margin-left: 250px;
		position: relative;
	}

	td {
		padding: 20px;
		padding-right: 30px;
		padding-bottom: 5px;
		padding-top: 5px;
		width: 175px;
	}
	div img{
		position: relative;
		left: 110px;
		bottom: 15px;
	}
	td p{
		margin-right: 30px;
	}
	#Application_Form_main_top {
		margin-left: 90px;
	}

	#Application_Form_main_bottom {
		margin-left: 90px;
	}

	#Application_Form_main_top table {
		margin: 20px;
	}

	#Application_Form_main_bottom table {
		margin: 20px;
		width: 300px;
	}

	#Application_Form_main_top {
		overflow: hidden;
	}

	#Application_Form_main_bottom {
		overflow: hidden;
	}

	#Application_Form_main_top div {
		float: left;
		border-style: solid;
		border-width: 2px;
		border-color: #EAEEF1;
		border-radius: 10px;
		background-color: white;
		margin: 35px;
	}

	#Application_Form_main_bottom div {
		float: left;
		border-style: solid;
		border-width: 2px;
		border-color: #EAEEF1;
		background-color: white;
		border-radius: 10px;
		margin: 25px;
		width: 400px;
		height: 300px;
	}

	.Application_Form_main_but {
		border: 0;
		background-color: #B3C57C;
		padding-left: 15px;
		padding-right: 15px;
		padding-top: 2px;
		padding-bottom: 2px;
		color: white;
		border-radius: 5px;
	}

	#page {
		position: relative;
		left: 600px;
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
                start:'',
                end:'',
                type:'',
			}
        },
        mounted:function(){
            this.getlist(1);
        },
        methods: {
            getlist(page){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/WorkerRecord/record_list";
                jsonData.page = page;
                jsonData.class_type = 1;
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
                sendData.url = "/index.php/pc/WorkerRecord/record_list";
                jsonData.page = 1;
                jsonData.class_type = 1;
                jsonData.worker_name = $('#name').val();
                jsonData.role_name = $('#role').val();
                jsonData.group_name = $('#group').val();
                jsonData.start_time = $('#ECalendar_case1').val();
                jsonData.end_time = $('#ECalendar_case2').val();
                jsonData.type = $('#select').val();
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
					this.data = re.data;
					this.pages = re.total.pages;
                    this.page = re.total.page;
                    this.start = $('#ECalendar_case1').val();
                    this.end = $('#ECalendar_case2').val();
                    this.type = $('#select').val();
				}else{
                    layer.msg(re.msg); 
                }
            },
            detail(worker_id){
                var start = this.start;
                var end = this.end;
                var type = this.type;
                this.$router.push({name: 'Persponnel_Details', params: { worker_id:worker_id,start:start,end:end,type:type }});
            },
            set(){
               this.$router.push({name: 'Persponnel_Set'});
            }
        }
	}

</script>
