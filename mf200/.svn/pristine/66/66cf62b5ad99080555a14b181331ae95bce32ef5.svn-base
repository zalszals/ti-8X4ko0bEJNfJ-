<!--采购订单 订单详情 入库详情-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">采购订单 | 订单详情 | 入库详情</h4>
            </div>
            <div class="case">
                <button class="button or" @click="$router.back(-1)">返回</button>
            </div>
        </div>
    </div>
   <div>
   	    <table>
        <tr>
            <th>物料</th>
            <th>数量</th>
            <th>单位</th>
            <th>状态</th>
        </tr>
        <tr class="color" v-for='(item,index) in data' :key="index">
        <td>{{item.m_name}}</td>
        <td>{{item.num}}</td>
        <td>{{item.unit}}</td>
        <td>{{item.status_name}}</td>
        </tr>                
    </table>
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
		margin-left: 1%;
		margin-right: 10%;
	}
	table{
		margin-top: 30px;
		width: 1400px;
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
                item:[]
			}	
        },
        mounted:function(){
			var order_id = this.$route.params.order_id;
			var insert_time = this.$route.params.insert_time;
			this.getlist(order_id,insert_time);
        },
        methods: {
            getlist(order_id,insert_time){
               	var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Order/ruku_detail";
				jsonData.order_id = order_id;
				jsonData.insert_time = insert_time;
                sendData.data = jsonData;
				var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.data = re.data;
                }            
            }
        }
    }
</script>

