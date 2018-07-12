<template>
<div id="Application_Form_main__">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4  class="tit">出入库明细</h4>
			</div>
			<div class="case">
				<select class="select" @change="getlist(1,2)" id="select">
					<option value ="1">出库明细</option>
					<option value ="2">入库明细</option>
				</select>
				<div class="calendarWarp" style="">
					<input type="text" name="date" class='ECalendar input' id="ECalendar_case1"/>
				</div>至
				<div class="calendarWarp" style="">
					<input type="text" name="date" class='ECalendar input' id="ECalendar_case2"/>
				</div>
				<input type="text" name="date" class='ECalendar input' placeholder="请输入关键字" id="keywords" />
				<button class="button or" @click="getlist(1,1)">搜索</button>
				<button class="button or">设为首页</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main_">
		<table align="center">
			<tr>
				<th>类型</th>
				<th>日期</th>
				<th>类别</th>
				<th>名称</th>
				<th>规格</th>
				<th>出库数量</th>
			</tr>
			<tr class="color" v-for="(item,index) in data" :key="index">
				<td>{{item.type_name}}</td>
				<td>{{item.add_time}}</td>
				<td>{{item.cat_id}}</td>
				<td>{{item.cat_child_id}}</td>
				<td>{{item.materiel_desc}}</td>
				<td>{{item.num}} {{item.unit}}</td>
			</tr>
		</table>
	</div>
	<div id="page_new" class="paing">
		<ul class="pages" v-if="pages > 1">
			<li @click="getlist(item,1)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
		</ul>
	</div>
</div>
</template>

<script>
	export default {
		data() {
			return {

			}
		},
		mounted:function(){			
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
			});
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});
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
/*		margin-left: 5%;*/
/*		margin-right: 15%;*/
	}
	table{
		text-align: 
	}	
	table * {
		padding-top: 2px;
		padding-bottom: 2px;
		text-align: center;
	}

	th {
		background-color: white;
		width: 230px;
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

	.color {
		background-color: white !important;
	}

	.color:nth-child(2n) {

		background-color: #F9F9F9 !important;
	}

	td table tr td {
		width: 1900px;
	}

	.pages li {
		padding: 5px;
		background-color: white;
		float: left;
	}
	#page_new{
		margin-top: 10px;
		margin-left: 40%;
	}

</style>
<script>
	export default {
		data() {
			return {
				data:[],
				item:[],
				pages:''
			}
		},
		mounted:function(){
			this.getlist(1,1);
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
			});				
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});
        },
		methods: {
			getlist(page,style){
				var sendData = {};
				var jsonData = {};
				if($('#select').val()== 1){
					sendData.url = "/index.php/pc/Deprot/ck_lingliaolist";
					jsonData.page = page;
					jsonData.type = '';
					jsonData.status = 4;
					if(style == 1){
						if($('#ECalendar_case1').val()){
							jsonData.start_time = $('#ECalendar_case1').val();
						}
						if($('#ECalendar_case2').val()){
							jsonData.end_time = $('#ECalendar_case2').val();
						}
						if($('#keywords').val()){
							jsonData.keywords= $('#keywords').val();
						}
					}
					sendData.data = jsonData;
					var re = getFaceInfo(sendData);
					if(re.status == 1){
						for(var i=0;i<re.data.length;i++){
							switch(re.data[i].type){
								case 1:re.data[i].type_name = '生产计划领料';break;
								case 2:re.data[i].type_name = '生产领料';break;
								case 3:re.data[i].type_name = '育苗计划领料';break;
								case 4:re.data[i].type_name = '育苗领料';break;
								case 5:re.data[i].type_name = '销售领料';break;
								case 6:re.data[i].type_name = '销售开单';break;
								case 7:re.data[i].type_name = '采购领料';break;
								case 8:re.data[i].type_name = '财务领料';break;
								case 9:re.data[i].type_name = '人事领料';break;
								case 10:re.data[i].type_name = '仓库领料';break;
								case 11:re.data[i].type_name = '报废出库';break;
								case 12:re.data[i].type_name = '盘亏出库';break;
								case 13:re.data[i].type_name = '其他出库';break;
							}
						}
						this.data = re.data;
						this.pages = re.pages;
					}else{
						layer.msg(re.msg);
					}
				}else{
					sendData.url = "/index.php/pc/Deprot/ck_insertlist";
					jsonData.page = page;
					jsonData.type = '';
					jsonData.status = 4;
					if(style == 1){
						if($('#ECalendar_case1').val()){
							jsonData.start_time = $('#ECalendar_case1').val();
						}
						if($('#ECalendar_case2').val()){
							jsonData.end_time = $('#ECalendar_case2').val();
						}
						if($('#keywords').val()){
							jsonData.keywords= $('#keywords').val();
						}
					}
					sendData.data = jsonData;
					var re = getFaceInfo(sendData);
					if(re.status == 1){
						for(var i=0;i<re.data.length;i++){
							switch(re.data[i].type){
								case 14:re.data[i].type_name = '生产退料';break;
								case 15:re.data[i].type_name = '育苗退料';break;
								case 16:re.data[i].type_name = '采购入库';break;
								case 17:re.data[i].type_name = '盘盈入库';break;
								case 18:re.data[i].type_name = '其他入库';break;
								case 19:re.data[i].type_name = '果蔬入库';break;
								case 20:re.data[i].type_name = '育苗入库';break;
							}
						}
						this.data = re.data;
						this.pages = re.pages;
					}else{
						layer.msg(re.msg);
					}
				}
			}
		}
			
	}
</script>

