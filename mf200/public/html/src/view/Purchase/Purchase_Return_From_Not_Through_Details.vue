<!--采购退料单 未通过  详情-->

<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">采购退料单 | 采购退料单详情</h4>
            </div>
            <div class="case">
                <button  @click="edit(arr.order_id)" v-if="arr.status != 2" class="button or">编辑</button>
                <button  @click="del(arr.order_id)" v-if="arr.status != 2"  class="button or">删除</button>
                <button v-if="arr.status == 2 && arr.mode == 2"  class="button or"@click="ar(arr.order_id)">生成应收单</button>
                <button @click="back(arr.order_id)" v-if="arr.status == 2"  class="button or">退回</button>
                <button @click="$router.back(-1)" class="button or">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
           <h3>{{arr.order_sn}}</h3>
            <ul>
                <li>
                    <p>供应商 ： {{arr.supply_name}}</p>
                    <p></p>
                </li>
                                <li>
                    <p>总数量 ： {{arr.num}}</p>
                    <p>总金额 ：{{arr.sum}} 元</p>
                </li>
                                <li>
                    <p v-if="arr.mode == 1">退料方式 ：退料换料</p>
                    <p v-if="arr.mode == 2">退料方式 ：退料退款</p>
                    <p v-if="arr.mode == 3">退料方式 ：仅退料</p>
                    <p>退料原因 ： {{arr.cause}}</p>
                </li>
                <li>
                    <p>退料时间 ： {{arr.add_time}}</p>
                    <p v-if="arr.check_worker_name">审核人 ：{{arr.check_worker_name}}</p><p v-else>审核人 ： —— ——</p>
                </li>
                <li>
                    <p v-if="arr.check_time">审核日期 ：{{arr.check_time}}</p><p v-else>审核日期 ： —— ——</p>
                    <p v-if="arr.status == 3 && arr.reason">不通过原因：{{arr.reason}}</p><p v-if="arr.status == 3 && arr.reason == ''">不通过原因：—— ——</p>
                </li>
                <li>
                    <p v-if="arr.status == 1">单据状态 ：未审核</p>
                    <p v-if="arr.status == 2">单据状态 ：已审核</p>
                    <p v-if="arr.status == 3">单据状态 ：未通过</p>
                    <p v-if="arr.next_f == 2">已制单据 ：应收单</p>
                    <p v-else>已制单据 ：—— ——</p>
                </li>
                                <li>
                    <p v-if="arr.beizhu">备注 ：{{arr.beizhu}}</p><p v-else>备注 ：—— ——</p>
                    <p></p>
                </li>
            </ul>
        </div>
        <div class="block" v-for="(item,index) in data" :key="index">

            <ul>
                <li>
                    <p>物料名称 ：{{item.m_name}}</p>
                </li>
                <li>
                    <p>退料数量 ：{{item.num}} {{item.unit}}</p>
                </li>
                <li>
                    <p>单价 ： {{item.price}} 元</p>
                </li>                
                   <li>
                    <p>金额 ： {{item.m_sum}} 元</p>
                </li>
            </ul>
        </div>
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
        margin-left: 50px;
    }

    .ora {
        color: #F4A356;
        margin-top: 35px;
    }

    #from p {
        margin-top: 30px;
    }

    .block {
        float: left;
        margin-top: 30px;
        margin-right: 10px;
        background-color: white;
        border-style: solid;
        border-width: 2px;
        border-color: #EAEEF1;
        border-radius: 5px;
        margin-left: 30px;
        width: 260px;
        height: 140px;
    }
    h3{
        margin-top: 30px;
        color:  #F4A356;
    }
    .block li {
        margin-left: 30px;
    }

    .block li p {
        margin-top: 10px;
    }
    #from li{
        overflow: hidden;
    }
   #from li p{
       width: 400px;
        float: left;
    }
    .block li h3 {
        margin-top: 20px;
        margin-bottom: 20px;
    }

</style>
<script>
export default {
		data() {
			return{
                data:[],
                list:[],
                info:[],
                arr:[],
                item:[]
			}	
        },
        mounted:function(){
            var order_id = this.$route.query.order_id;
			this.getlist(order_id);
        },
        methods: {
            getlist(order_id){
               	var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Order/order_detail";
                jsonData.order_id = order_id;
                sendData.data = jsonData;
				var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.list = re.list;
                    this.data = re.data;
                    this.arr = re.arr;
                    this.info = re.info;
                }            
            },
            del: function(order_id) {
				var val = layer.confirm("确认删除", {
						btn: ["确认", "取消"],
						title: [""]
					},function(){
						var sendData = {};
						var jsonData = {};
						sendData.url = "/index.php/pc/Order/order_del";
                        jsonData.style = 2;
                        jsonData.order_id = order_id;
						sendData.data = jsonData;
						var re = getFaceInfo(sendData);
						if(re.status == 1){
							layer.msg(re.msg,{time: 1000},function(){
								history.back(-1);
							});					
						}else{
							layer.msg(re.msg);
						}	
					},function(){
						layer.close(val);
                    })
            },
            back:function(order_id){
                var val = layer.confirm("确认退回未审核状态？", {
						btn: ["确认", "取消"],
						title: [""]
					},function(){
						var sendData = {};
						var jsonData = {};
						sendData.url = "/index.php/pc/Order/order_back";
                        jsonData.style = 2;
                        jsonData.order_id = order_id;
						sendData.data = jsonData;
						var re = getFaceInfo(sendData);
						if(re.status == 1){
							layer.msg(re.msg,{time: 1000},function(){
								history.back(-1);
							});					
						}else{
							layer.msg(re.msg);
						}	
					},function(){
						layer.close(val);
                    })
            },
            edit(order_id){
                this.$router.push({path: 'Purchase_Return_From_Not_Through_Details_Edit', query: { order_id:order_id }});
            },
            ar(order_id){
                this.$router.push({path: 'Purchase_Order_Audited_Details_Payable_', query: { order_id:order_id }});
            }
        }

    }
</script>
