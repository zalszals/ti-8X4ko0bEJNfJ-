<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>预警列表</h4>
            </div>
            <div class="case">
            <select id="cate_id">
				<option>请选择搜索分类</option>
				<option v-for="item in get_materiel_cat"v-bind:value="item.cat_id">{{item.cat_name}}</option>
			</select>
            <select id="search_type">
				<option>请选择搜索类型</option>
				<option value="m.m_name">物料名</option>
				<option value="crop.cat_name">品种</option>
			</select>
			<input type="text" class="ECalendar calendarWarp" id="keywords" />
                <button v-on:click="getlists()">筛选</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="Application_Form_main_top">

                <div v-for="item in lists">
                <table>
                    <tr>
                        <td>
                            <p>类别</p>
                        </td>
                        <td>
                            <p><input type="text"disabled v-bind:value="item.cat_name" id=""></p>
                        </td>
                        <td>
                            <p><button  @click="changeDiv(item.materiel_id)">申请采购</button></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>物品编号：</p>
                        </td>
                        <td>
                          <p><input type="text"disabled v-bind:value="item.materiel_no" id=""></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>物料名称</p>
                        </td>
                        <td>
                             <p><input type="text"disabled v-bind:value="item.materiel_name" id=""></p>
                        </td>
                    </tr>
                                        <tr>
                        <td>
                            <p>规格：</p>
                        </td>
                        <td>
                            <p><input type="text"disabled v-bind:value="item.materiel_desc" id=""></p>
                        </td>
                    </tr>
                                        <tr>
                        <td>
                            <p>库存数量：</p>
                        </td>
                        <td>
                            <p><input type="text"disabled v-bind:value="item.num" id=""></p>
                        </td>
                    </tr>
                                        <tr>
                        <td>
                            <p>预警值：</p>
                        </td>
                        <td>
                            <p><input type="text" id="warning_num" v-bind:value="item.warning_num" ></p>
                        </td>
                        <td>
                        	<button   @click="changeInfo(item.materiel_id)">修改</button>
                        </td>
                    </tr>
                                        <tr>
                        <td>
                            <p>采购车：</p>
                        </td>
                        <td>
                           <p><input type="text"disabled v-bind:value="item.request_num" id=""></p>
                        </td>
                    </tr>
                                        <tr>
                        <td>
                            <p>采购待审核：</p>
                        </td>
                        <td>
                           <p><input type="text"disabled v-bind:value="item.buy_num_end" id=""></p>
                        </td>
                    </tr>
                                                            <tr>
                        <td>
                            <p>采购中：</p>
                        </td>
                        <td>
                             <p><input type="text"disabled v-bind:value="item.buy_num_start" id=""></p>
                        </td>
                    </tr>
                </table>
            </div>
			
			
			
        </div>
		
		    <div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getlists(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
			</ul>
			
		
		</div>
		<div id="showDiv" style="display:none">
		<input type="text" id="cainum">
		<input type="hidden" id="change_id">
		<button @click="changeType()">通过</button>
		<button>取消</button>
		</div>
		
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
			materiel_list:[]
			};
		},
		mounted:function(){
			this.getlists()
	 	},

		methods:{
			changeDiv: function(id) {
				$('#showDiv').show();
				$('#change_id').val(id);
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
			getlists:function(page){
                var search_type = $("#search_type option:selected").attr("value");
                var cat_id = $("#cate_id option:selected").attr("value");
                var keywords = $("#keywords").val();
				var type = 2;
				var sendData = {
					url: "index.php/depot/Deprot/pc_stock_num",
					data: {
					    search_type: search_type,
					    keywords: keywords,
					    type: type,
					    cat_id: cat_id,
						page:page
		 
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

	button {
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

	td {
		padding: 20px;
		padding-right: 30px;
		padding-bottom: 5px;
		padding-top: 5px;
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
		margin: 35px;
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
		select {
		border-style: solid;
		border-width: 0.8px;
		border-color: #EAEEF1;
		padding-left: 5px;
		padding-right: 60px;
		padding-bottom: 5px;
		padding-top: 5px;
		border-radius: 5px;
		margin-right: 10px;
		margin-left: 30px;
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

</style>
 
