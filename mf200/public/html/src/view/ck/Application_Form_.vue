<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4  class="tit">预申请列表</h4>
            </div>
            <div class="case">
                <div class="calendarWarp" style="">
					日期
                    <input type="text" name="date" class='ECalendar input'id="ECalendar_case1"  />
                </div>至
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case2" />
                </div>
               	<select class="vuesela select ppp" name="addcat_id">
							<option value="">请选择</option>
							<option value="果蔬">果蔬</option>							
							<option v-for="item in get_materiel_cat" v-bind:value="item.cat_id">{{ item.cat_name }}</option>
				</select>
                <input type="text" class="ECalendar calendarWarp input" id="keywords" />
                <button v-on:click="getlists()" class="button or ppp" >筛选</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
    <table align="center">
        <tr>
			<th  class="ppp">时间</th>
			<th  class="ppp">类别</th>
			<th  class="ppp">名称</th>
            <th  class="ppp">采购数量</th>
			<th  class="ppp">单位</th>
            <th  class="ppp">来源</th>
            <th  class="ppp">审核</th>
        </tr>
        <tr class="color" v-for="item in lists" v-on:click="clickLi(item.materiel_id)" v-bind:id='"cateulli"+item.materiel_id'>
			<td class="ppp">{{item.new_time}}</td>
			<td class="ppp">{{item.cat_name}}</td>
			<td class="ppp">{{item.materiel_name}}</td>
			<td class="ppp">{{item.request_num}}</td>
			<td class="ppp">{{item.unit}}</td>
			<td  class="ppp">{{item.come}}</td>
			<td class="ppp"> <button  v-on:click="checkstatus(item.cg_id)" class="Application_Form_main_but">审核</button></td>
        </tr>        
    </table>
			<div id="page_new" class="paing">
				<ul class="pages" v-if="pages > 1">
					<li @click="getlists(truepage-1)">上一页</li> 
					<template  v-for="(item,index) in pages" >
<!--					<li v-if="item==3">...</li>-->
					<li  @click="getlists(item)" :key="index"  :class="item>truepage+5?'ovvvv':''" v-if="item>=truepage-5">{{item}}</li>
					</template>
					<li>...</li>
					<li @click="getlists(truepage+1)">下一页</li>
				</ul>
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
				get_materiel_cat: [],
				page: '',
				truepage: 1

			};
		},
		mounted: function() {
			this.getlists(this.truepage);
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
			});				
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});
		},

		methods: {
			getlists: function(page, status) {
				this.truepage = page;
				var addcat_id = $("select[name='addcat_id']").val();
				var start_time = $("#ECalendar_case1").val();
				var end_time = $("#ECalendar_case2").val();
				var keywords = $("#keywords").val();
				var sendData = {
					url: "index.php/depot/Deprot/kc_applycg",
					data: {
						cat_id: addcat_id,
						page: page,
						keywords: keywords,
						start_time: start_time,
						end_time: end_time,
						pc_from: 2
					}
				};
				var re = getFaceInfo(sendData);
				//console.log(re);
				this.lists = re.data.page_list.list;
				this.pages = re.data.last_page;
				this.get_materiel_cat = re.data.get_materiel_cat;
				this.page = re.data.page;
			},
			checkstatus: function(cg_id){
				layer.confirm('确定审核通过吗？', {btn: ['确定','取消']}, function(){
					do_check(cg_id);
				});
			},	
			do_check: function(cg_id) {

				var sendData = {
					url: "index.php/depot/Deprot/check_materiel",
					data: {
						info_str: cg_id
					}
				};
				var re = getFaceInfo(sendData);
				//console.log(re);
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

</style>
