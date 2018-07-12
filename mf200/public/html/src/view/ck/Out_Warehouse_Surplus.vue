<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">盘亏出库</h4>
                <!--
				<button v-on:click="getlists(1,1)" class="button or">待审核</button>
                <button v-on:click="getlists(1,3)" class="button or">待出库</button>
                <button v-on:click="getlists(1,4)" class="button or">已完成</button>
				-->
			</div>
            <div class="case">
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case1" />
                </div>至
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case2" />
                </div>
				 <input type="text" name="date" class='ECalendar input' placeholder="请输入关键字" id="keywords" />
                <button v-on:click="getlists()" class="button or">筛选</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
      <table align="center">
		  <tr>
			<th>操作人</th>		 
			<th>出库日期</th>
			<th>类别</th>
			<th>名称</th>
			<th>规格</th>
			<th>出库数量</th>			
		  </tr>
		  <tr v-for="item in lists" class="color">
			<td>{{item.apply_worker}}</td>		 
			<td>{{item.add_time}}</td>
			<td>{{item.cat_id}}</td>
			<td>{{item.cat_child_name}}</td>
			<td>{{item.materiel_desc}}</td>
			<td>{{item.num}}</td>		
		  </tr>
	</table>
 
         <div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getlists(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
			</ul>
			
		
		</div>
		<div id="showDiv" style="display:none">
		<input type="text" id="reply" class="input">
		<input type="hidden" id="change_id" class="input">
		<button @click="changeType(1)" class="button or">通过</button>
		<button @click="changeType(2)" class="button or">拒绝</button>
		</div>
		<input type="hidden" id="HideStatus" class="input">
</div>
</div>
</template>
<script>
	export default {
		data() {
			return {

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


				var check_status = $('#HideStatus').val();

				if (status) {
					$('#HideStatus').val(status);
				} else {
					status = check_status;
				}
				if (status == '2') {
					$('.changeButton_new').hide();
					$('.changeButton_old').show();
				} else if (status == '3') {
					$('.changeButton_new').hide();
					$('.changeButton_old').hide();
				} else {
					$('.changeButton_new').show();
					$('.changeButton_old').hide();
				}



				var start_time = $("#ECalendar_case1").val();
				var end_time = $("#ECalendar_case2").val();
				var keywords = $("#keywords").val();
				var sendData = {
					url: "index.php/depot/Deprot/pc_ck_lingliaolist",
					data: {
						type: 12,
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
				$('#showDiv').show();
				$('#change_id').val(id);
			},
			changeType: function(type) {

				var type = type;
				var reply = $("#reply").val();
				var id = $("#change_id").val();
				var sendData = {
					url: "index.php/depot/Deprot/ck_lingliaoinsert",
					data: {
						type: type,
						reply: reply,
						id: id,

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

</style>
