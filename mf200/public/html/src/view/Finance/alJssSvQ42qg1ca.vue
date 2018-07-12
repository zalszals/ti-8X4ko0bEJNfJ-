<template>
	<div id="Application_Form_main__">
		<div id="Application_Form_head_">
			<div id="Application_Form_Date_">
				<div id="w_Warehouse">
					<h4 class="tit">收支明细</h4>
				</div>
				<div class="case">
					<div class="calendarWarp" style="">
						<input type="text" name="date" class='ECalendar input' id="ECalendar_case1" />
					</div>至
					<div class="calendarWarp" style="">
						<input type="text" name="date" class='ECalendar input' id="ECalendar_case2" />
					</div>
					<span class="h4span-ra">
						<select class="selclass select" name="" id="type">
							<option value="1" selected>应付</option>
							<option value="2">应收</option>
						</select>
					</span>
					<button @click="getlists()" class="button or">查询</button>
				</div>
			</div>
		</div>
		<div id="Application_Form_main_">
		<table>
				<tr>
					<th>收支类型</th>			
					<th>订单来源</th>
					<th>公司名称</th>
					<th>付款方式</th>
					<th>收支（元）</th>
					<th>收支日期</th>
				</tr>
				<tr class="color" v-for="item in get_materiel_cat">
					<td>{{item.type}}</td>			
					<td>{{item.origin}}</td>
					<td>{{item.company}}</td>
					<td>{{item.way}}</td>
					<td>{{item.money}}</td>
					<td>{{item.add_time}}</td>
				</tr>
			</table> 
		</div>
	</div>		
</template>
<script>
	export default {
		data() {
			return {

			lists: [],
			pages: [],
            get_materiel_cat:[],
            page:'',
			};
		},
		mounted:function(){
			this.getlists()
	 	},

		methods:{
 
			getlists:function(page){
				var type = $("#type option:selected").attr("value");
		 
			 
				var start_time = $("#ECalendar_case1").val();
				var end_time = $("#ECalendar_case2").val();
		 
 
				var sendData = {
					url: "index.php/finance/Account/account_balance",
					data: {
					 type:type,
					 start:start_time,
					 end:end_time,
					}
				};
				var re = getFaceInfo(sendData);
				this.get_materiel_cat = re.data;
 
   			},

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

	td {
		height: 50px;
	}

	.color {
		background-color: white;
	}

	.color:nth-child(2n) {

		background-color: #F9F9F9;
	}

	table button {
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 2px;
		padding-bottom: 2px;
		color: white;
		border: 0;
		border-radius: 5px;
		background-color: #F2A553;
	}

	.pages li {
		padding: 5px;
		background-color: white;
		float: left;
	}

</style>