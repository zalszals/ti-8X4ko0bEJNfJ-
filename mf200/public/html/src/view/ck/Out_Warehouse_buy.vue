<template>
<div id="Application_Form_main__">
    <div id="Application_Form_Date_">
		<div id="w_Warehouse">
			<h4 class="tit">销售出库</h4>
	
			<button v-on:click="getlists(1,1)" class="button or">待审核</button>
			<button v-on:click="getlists(1,2)" class="button or">未通过</button>
			<button v-on:click="getlists(1,3)" class="button or">待出库</button>
			<button v-on:click="getlists(1,4)" class="button or">已完成</button>
		</div>
		<div class="case">
			<div class="calendarWarp" style="">
				<input type="text" name="date" class='ECalendar input' id="ECalendar_case1" />
			</div>至
			<div class="calendarWarp" style="">
				<input type="text" name="date" class='ECalendar input' id="ECalendar_case2" />
			</div>
			
			<button v-on:click="getlists()" class="button or">查询</button>
		</div>
	</div>
    <div id="Application_Form_main_">
       <table  align="center">
		  <tr>
			<th>申请日期</th>
			<th>公司名称</th>
			<th>申请人</th>
			<th>物料名称</th>
			<th>数量</th>
			<th>审核状态</th>
			<th>审核原因</th>
			<!--<th>预计送达</th>
			<th>实际送达</th>
			--><th>要求时间</th>
			<th>详情</th>
		  </tr>
  
  <tr  v-for="item in lists" class="color">
    <td>{{item.add_time}}</td>
    <td>{{item.company_name}}</td>
    <td>{{item.apply_worker}}</td>
    <td>
		{{item.detail_name.slice(0,5)}}...&nbsp;<i class="fa fa-hand-pointer-o orange cursor" @click="showdetail(item.id,item.ling_detail)" aria-hidden="true"></i>	
	</td>
    <td>{{item.num}}</td>
	<td>{{item.status_name}}</td>
	<td>{{item.return_remarks}}</td>
	<!--
    <td>{{item.submit_time}}</td>
    <td>{{item.real_time}}</td>
    --><td>{{item.order_time}}</td>


	<td class="changeButton_new" style="">
	 <template v-if="item.status=='0'">
 <template v-if="shen_worker=='2'"><button class="button or" @click="showdetail(item.id,item.ling_detail)">审核</button>
  </template>
</template>
</td>


<template v-if="item.status=='1'">
 <template v-if="item.is_checked=='0'">
 <template v-if="bao_worker=='2'">
	<td class="changeButton_old" style="" ><a :href="'#/router_main_Inventory_System/Out_Warehouse_Details/'+item.sell_id+'/'+item.batch_id+'/'+item.id"><button>出库</button></a></td>
 </template>
</template>
</template>
</tr>
</table>
<div id="page_new" class="paing">
	<ul class="pages" v-if="pages > 1">
		<li @click="getlists(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
	</ul>


</div>
<div id="showDiv" style="display:none">
	<table>
		<tr>
			<th>物料名称</th>
			<th>数量</th>
		</tr>
		<tr v-for="(item,index) in ling_detail" :key="index">
			<td>{{item.cat_id}}</td>
			<td>{{item.m_num}}</td>
		</tr>
		<tr>
			<td></td>
			<td><button onclick="javascript:$('#change_id').click();" class="button or">通过</button></td>
		</tr>
	</table>
</div>
<input type="hidden" id="change_id" @click="changeType(1)" />
</div>
</div>
</template>
<script>
	export default {
		data() {
			return {
				ling_detail: [],
				lists: [],
				pages: [],
				get_materiel_cat: [],
				page: '',
				bao_worker: '',
				shen_worker: ''
			};
		},
		mounted: function() {
			this.getlists();
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
			});
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});
		},

		methods: {
			getlists: function(page, status) {

				var start_time = $("#ECalendar_case1").val();
				var end_time = $("#ECalendar_case2").val();
				var keywords = $("#keywords").val();
				var sendData = {
					url: "index.php/depot/Deprot/pc_ck_lingliaolist",
					data: {

						type: 5,
						status: status,
						page: page,
						keywords: keywords,
						start_time: start_time,
						end_time: end_time,
						pc_from: 2
					}
				};
				var re = getFaceInfo(sendData);
				this.lists = re.data.list;
				this.pages = re.data.pages;
				this.page = re.data.page;
				this.bao_worker = re.bao_worker;
				this.shen_worker = re.shen_worker;
			},
			changeInfo: function(id) {
				//$('#showDiv').show();
				$('#change_id').val(id);
			},
			changeType: function(type) {
				var type = 1;
				var reply = '同意';
				var id = $("#change_id").val();
				var sendData = {
					url: "index.php/depot/Deprot/ck_lingliaoinsert",
					data: {
						type: type,
						reply: reply,
						id: id
					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
					// location.href =location.href;
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				} else {
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				}
			},
			outInfo: function(id) {


				var id = id;
				var sendData = {
					url: "index.php/depot/Deprot/ck_lingliaoinsert_end",
					data: {
						id: id,

					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
					// location.href =location.href;
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						//  window.location.reload();
					});
				} else {
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						// window.location.reload();
					});
				}
			},
			showdetail: function(sell_id, json) {
				this.ling_detail = json;
				$('#change_id').val(sell_id);
				setTimeout(function() {
					layer.open({
						type: 1,
						title: '销售出库详情', //样式类名
						closeBtn: 1, //不显示关闭按钮
						anim: 2,
						shadeClose: true, //开启遮罩关闭
						content: $('#showDiv').html()
					});
				}, 100);
			},

		}
	}

</script>
<style scoped>
	#Application_Form_Date_ {}

	.orange {
		color: orange;
	}

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

	.pages li {
		padding: 5px;
		background-color: white;
		float: left;
	}

	#page_new {
		margin-top: 10px;
		margin-left: 40%;
	}

</style>
