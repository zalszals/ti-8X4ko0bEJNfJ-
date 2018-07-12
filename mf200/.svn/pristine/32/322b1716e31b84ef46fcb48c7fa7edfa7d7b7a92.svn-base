<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">库存管理</h4>
            </div>
            <div class="case">
 
				<div class="case">
				<select id="type" class="select">
					<option value="1" selected="selected">全部列表</option>
					<option value="2">预警列表</option>
				</select>
				<select id="cate_id" class="select">
					<option>全部分类</option>
					<option value="果蔬">果蔬</option>					
					<option v-for="item in get_materiel_cat"v-bind:value="item.cat_id">{{item.cat_name}}</option>
				</select>
				<select id="search_type" class="select">
					<option>请选择搜索类型</option>
					<option value="m.m_name">物料名</option>					
				</select>
				<input type="text" class="ECalendar calendarWarp input" id="keywords" />
					<button v-on:click="getlists()" class="button or">搜索</button>
				</div>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
    <table  align="center">
        <tr>
            <th>申请采购</th>
            <th>类别</th>
            <th>物品编号</th>
            <th>物料名称</th>
            <th>规格</th>
            <th>库存数量</th>
            <th>预警值</th>
            <th>采购车</th>
            <th>采购待审核</th>
            <th>采购中</th>
        </tr>
        <tr class="color" v-for="item in lists">
		   <button  @click="changeDiv(item.materiel_id)" class="button or mat">申请采购</button>
			<td>{{item.cat_name}}</td>
			<td>{{item.materiel_no}}</td>
			<td>{{item.materiel_name}}</td>
			<td>{{item.materiel_desc}}</td>
			<td>{{item.num}}&nbsp;{{item.unit}}</td>
			<td class="ppp"><input type="text" id="warning_num" v-bind:value="item.warning_num" class="input"><button   @click="changeInfo(item.materiel_id)" class="button or">修改</button></td>
			<td>{{item.request_num}}</td>
			<td>{{item.buy_num_end}}</td>
			<td>{{item.buy_num_start}}</td>
        </tr>        
    </table>
</div>

		
		<div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getlists(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
			</ul>
		</div>
		<div id="showDiv" style="display:none">
		<input type="text" id="cainum" class="input">
		<input type="hidden" id="change_id" class="input">
		<button @click="changeType()" class="button or">通过</button>
		<button class="button or">取消</button>
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
				materiel_list: []
			};
		},
		mounted: function() {
			this.getlists()
		},

		methods: {
			changeDiv: function(id) {
				$('#change_id').val(id);
				var SS = layer.open({
					type: 1,
					title: false,
					closeBtn: 0,
					shadeClose: true,
					skin: 'yourclass',
					content: $('#showDiv').html()
				});

			},
			changeType: function() {


				var request_num = $("#cainum").val();
				var materiel_id = $("#change_id").val();
				var sendData = {
					url: "index.php/depot/Deprot/add_caigou",
					data: {
						request_num: request_num,
						materiel_id: materiel_id,


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
			getlists: function(page) {
				var search_type = $("#search_type option:selected").attr("value");
				var cat_id = $("#cate_id option:selected").attr("value");
				var type = $("#type option:selected").attr("value");
				var keywords = $("#keywords").val();

				var sendData = {
					url: "index.php/depot/Deprot/pc_stock_num",
					data: {
						search_type: search_type,
						keywords: keywords,
						type: type,
						cat_id: cat_id,
						page: page
					}
				};
				var re = getFaceInfo(sendData);
				this.get_materiel_cat = re.data.get_materiel_cat;
				this.lists = re.data.list;
				this.pages = re.data.last_page;

				this.page = re.data.page;
				this.materiel_list = re.data.materiel_list;

			},
			changeInfo: function(id) {

				var id = id;
				var num = $("#warning_num").val();

				var sendData = {
					url: "index.php/depot/Deprot/save_stock_num",
					data: {

						num: num,
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


		}
	}

</script>


<style scoped>
	.mat {
		margin-top: 15px;
	}

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
		margin-top: -15px;
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

	.ppp {
		text-align: center;
	}

	.ppp * {}

	.ppp input {
		width: 60px;
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

</style>
