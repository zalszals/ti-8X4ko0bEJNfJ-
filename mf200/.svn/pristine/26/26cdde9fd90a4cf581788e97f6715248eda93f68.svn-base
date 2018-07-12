<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4  class="tit">收支明细</h4>
            </div>
            <div class="case">
                <select class="vuesela select ppp" name="addcat_id"  id="type" @change="getlists()">
					<option value="2" selected="selected">已付</option>
                    <option value="1">已收</option>
				</select>
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input'id="ECalendar_case1"  />
                </div>至
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case2" />
                </div>
                <button v-on:click="getlists()" class="button or ppp" >搜索</button>
                <button v-on:click="getlists()" class="button or ppp" >设为首页</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
    <table>
        <tr>
            <th  class="ppp">收支类型</th>
            <th  class="ppp">订单来源</th>
            <th  class="ppp">公司名称</th>
            <th  class="ppp">付款方式</th>
            <th  class="ppp">收/支(元)</th>
            <th  class="ppp">收/支日期</th>
        </tr>
        <tr class="color" v-for="item in lists">
        <td  class="ppp">{{item.type}}</td>
        <td class="ppp">{{item.origin}}</td>
        <td class="ppp">{{item.company}}</td>
        <td class="ppp">{{item.way}}</td>
        <td class="ppp">{{item.money}}</td>
        <td class="ppp">{{item.add_time}}</td>
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
			this.getlists();
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
			});				
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});
	 	},

		methods:{
 
			getlists:function(page){
				var type = $("#type option:selected").attr("value");
		 
			 
				var start_time = $("#ECalendar_case1").val();
				var end_time = $("#ECalendar_case2").val();
				var company = $("#company").val();
 
				var sendData = {
					url: "index.php/finance/Account/pc_account_balance",
					data: {
					
					 style:1,
					 type:type,
				 
					 start:start_time,
					 end:end_time,
					page:page,
					company:company,
					pc_form:2
					}
				};
				var re = getFaceInfo(sendData);
				this.lists = re.data;
 
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

</style>
