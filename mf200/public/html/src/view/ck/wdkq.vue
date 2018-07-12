<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4  class="tit">我的考勤</h4>
            </div>
            <div class="case">
               <select class="vuesela select ppp" name="addcat_id" id="select">
					<option value="1">本月</option>
  					<option value="2">上月</option>			
				</select>
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input'id="ECalendar_case1" placeholder="请选择开始时间" />
                </div>至
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case2" placeholder="请选择结束时间"/>
                </div>
                <button v-on:click="search()" class="button or ppp" >筛选</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
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
			<div id="page_new" class="paing">
				<ul class="pages" v-if="pages > 1">
					<li @click="getlist(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
				</ul>
			</div>
    </div>
</div>
</template>
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
			};
		},
		mounted: function() {
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
                sendData.url = "/index.php/pc/WorkerRecord/record_list";
                jsonData.page = page;
                jsonData.class_type = 2;
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
                jsonData.class_type = 2;
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
            }
		}
	}

</script>
<style scoped>
	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: -110px;
		height: 80px;
	}

	td table {
		border-left-style: solid;
		border-left-width: 2px;
		border-bottom-style: solid;
		border-left-width: 2px;
		border-color: #EAEEF1;
		border-radius: 5px;
	}


	#w_Warehouse {
		font-size: 15px;
		font-weight: bold !important;
		padding-top: 30px;
		margin-left: 30px;
		margin-right: 300px;
		overflow: hidden;
	}

	#w_Warehouse * {
		float: left;
	}

	#w_Warehouse h4 {
		margin-right: 30px;
	}

	#w_Warehouse button {
		margin-right: 10px;
	}

	.case {
		float: right;
		margin-top: -30px;
	}

	#Application_Form_main_ {
		margin-top: 30px;
		font-weight: 500;
		margin-left: 5%;
		margin-right: 10%;
		overflow: hidden;
	}

	table * {
		padding-top: 2px;
		padding-bottom: 2px;
		text-align: center;
	}

	th {
		background-color: white;
		width: 200px;
		height: 50px;
		border-bottom-style: solid;
		border-bottom-width: 2px;
		border-bottom-color: #EAEEF1;
	}

	.w_color {
		background-color: white;
	}

	td {
		height: 50px;
		/*        background-color: white;*/
	}



	td table tr td {
		width: 1900px;
	}

	.pages li {
		padding: 5px;
		background-color: white;
		float: left;
	}

	#page_new {
		margin-top: 10px;
		margin-left: 40%;
	}
	#Application_Form_main_ div {
		float: left;
		border-style: solid;
		border-width: 2px;
		border-color: #EAEEF1;
		border-radius: 10px;
		background-color: white;
		margin: 35px;
	}
	#Application_Form_main_ table {
		margin: 20px;
	}
	td {
		padding: 20px;
		padding-right: 30px;
		padding-bottom: 5px;
		padding-top: 5px;
	}
	#page_new {
		margin-top: 40px;
		position: relative;
		left: 30%;
	}
</style>
