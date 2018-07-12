<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">采购报表</h4>
            </div>
            <div class="case">
                 <div class="calendarWarp">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case1" />
                </div>至
                <div class="calendarWarp">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case2" />
                </div>
				 <input type="text" name="date" class='ECalendar input' placeholder="请输入物料分类名称" id="cat" />
				 <input type="text" name="date" class='ECalendar input' placeholder="请输入物料名称" id="mat" />
				 <input type="text" name="date" class='ECalendar input' placeholder="请输入采购员名称" id="worker" />
				 <input type="text" name="date" class='ECalendar input' placeholder="请输入供应商名称" id="supply" />
                <button class="button or" @click="search()">搜索</button>
                <button class="button or">设为首页</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
	<div class="flll">
	<p>订单数量 ： {{sum.snum}}</p>
    <p>订单金额 ： {{sum.ssum}} 元</p>
    <p>退料数量 ： {{sum.sb_num}}</p>
	</div>
   <div >
   	<p>退料金额 ：{{sum.sb_sum}} 元</p>
    <p>入库数量 ：{{sum.sr_num}}</p>
    <p>入库金额 ：{{sum.sr_sum}} 元</p>
   </div>
   <div>
   	    <table>
        <tr>
            <th>供应商名称</th>
            <th>物料</th>
            <th>物料分类</th>
            <th>物料规格</th>
            <th>单位</th>
            <th>平均价</th>
            <th>订单数量</th>
            <th>订单金额</th>
            <th>退料数量</th>
            <th>退料金额</th>
            <th>入库数量</th>
            <th>入库金额</th>
        </tr>
        <tr class="color" v-for="(item,index) in data" :key="index">
        <td>{{item.supply_name}}</td>
        <td>{{item.m_name}}</td>
        <td>{{item.cat_name}}</td>
        <td>{{item.m_desc}}</td>
        <td>{{item.unit}}</td>
        <td>{{item.price}} 元</td>
        <td>{{item.num}}</td>
        <td>{{item.sum}} 元</td>
        <td>{{item.b_num}}</td>
        <td>{{item.b_sum}} 元</td>
        <td>{{item.r_num}}</td>
        <td>{{item.r_sum}} 元</td>
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
</template>
<style scoped>

	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: -110px;
		height: 80px;
	}
	#Application_Form_main_{
		overflow: hidden;
	}
	.flll{
		float: left;
		width: 600px;
	}
    td table{
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
		margin-top: -30px;
	}

	#Application_Form_main_ {
		margin-top: 30px;
		font-weight: 500;
		margin-left: 1%;
		margin-right: 10%;
	}
	table{
		margin-top: 30px;
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
    .w_color{
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
    td table tr td{
        width: 1900px;
        
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
<script>
 export default {
		data() {
			return{
				data:[],
				sum:[],
                item:[],
                pages:'',
                page:''
			}	
		},

		mounted:function(){
			this.getlist(1);
        },
        methods: {
            getlist(page){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/order/order_form";
                jsonData.page = page;
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
					this.data = re.data;
					this.sum = re.zs;
					this.pages = re.total.pages;
					this.page = re.total.page;
                }else{
                    layer.msg(re.msg);
                }
            },
            search(){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Order/order_form";
                jsonData.page = 1;
                jsonData.cat_name = $('#cat').val();
                jsonData.m_name = $('#mat').val();
                jsonData.start = $('#ECalendar_case1').val();
                jsonData.end = $('#ECalendar_case2').val();
                jsonData.worker_name = $('#worker').val();
				jsonData.supply_name = $('#supply').val();
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
					this.data = re.data;
					this.sum = re.zs;
					this.pages = re.total.pages;
					this.page = re.total.page;
                }else{
                    layer.msg(re.msg);
                }
            }
        }
    }
</script>

