<!--采购订单 未审核 详情-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>采购订单 | 订单详情</h4>
            </div>
            <div class="case">
                <button v-if="arr.status != 2" @click="edit(arr.order_id)">编辑</button>
                <button v-if="arr.status != 2" @click="del(arr.order_id)">删除</button>
                <button v-if="arr.status == 2" @click="rk(arr.order_id)">采购入库</button>
                <button v-if="arr.status == 2" @click="tl(arr.order_id)">采购退料</button>
                <button v-if="arr.status == 2" @click="ap(arr.order_id)">生成应付单</button>
                <button v-if="arr.status == 2" @click="back(arr.order_id)">退回</button>
                <button @click="$router.back(-1)">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
           <h3>{{arr.order_sn}}</h3>
            <ul>
                <li>
                    <p>采购人 ：{{arr.worker_name}}</p>
                    <p></p>
                </li>
                                <li>
                    <p>采购部门 ：{{arr.group_name}}</p>
                    <p>供应商 ： {{arr.supply_name}}</p>
                </li>
                                <li>
                    <p>总数量 ： {{arr.num}}</p>
                    <p>总金额 ： {{arr.sum}} 元</p>
                </li>
                                <li>
                    <p>采购时间 ： {{arr.add_time}}</p>
                    <p v-if="arr.check_worker_name">审核人 ： {{arr.check_worker_name}}</p><p v-else>审核人 ： —— ——</p>
                </li>
                                <li>
                    <p v-if="arr.check_time">审核日期 ： {{arr.check_time}}</p><p v-else>审核日期 ： —— ——</p>
                    <p v-if="arr.reason && arr.status == 3">不通过原因：{{arr.reason}}</p><p v-else-if = "arr.status == 3 && arr.reason == ''">不通过原因 ： —— ——</p>
                </li>
                                <li>
                    <p v-if="arr.status == 1">单据状态 ： 未审核</p>
                     <p v-else-if="arr.status == 2">单据状态 ： 已审核</p>
                      <p v-else>单据状态 ： 未通过</p>
                    <p>已制单据 ：<font v-if="arr.next == 2"> 采购入库单 </font><font v-if="arr.next_t == 2"> 应付单 </font><font v-if="arr.next_s == 2"> 采购退料单 </font><font v-else>  —— —— </font></p>
                </li>
                                <li>
                    <p v-if="arr.beizhu">备注 ： {{arr.beizhu}}</p><p v-else>备注 ： —— ——</p>
                    <p></p>
                </li>
            </ul>
        </div>
        <div>
            <p class="ora">订单信息</p>
        </div>
        <div class="block" v-for="(item,index) in data" :key="index">

            <ul>
                <li>
                    <p>物料名称 ：{{item.m_name}}</p>
                </li>
                <li>
                    <p>采购数量 ：{{item.num}} {{item.unit}}</p>
                </li>
                <li>
                    <p>单价 ：{{item.price}} 元</p>
                </li>
                <li>
                    <p>金额 ：{{item.m_sum}} 元</p>
                </li>
            </ul>
        </div>
        <div class="clear">
            <p class="ora">退料信息</p>
            <div>
                <p v-for="(item,index) in list" :key="index">{{item.add_time}} &nbsp;&nbsp; {{item.num}} &nbsp;&nbsp; {{item.status}} &nbsp;&nbsp; <a class="c" @click="tldl(item.order_id)">详情</a></p>
            </div>
        </div>
        <div>
            <p class="ora">入库信息</p>
             <div>
                <p v-for="(item,index) in info" :key="index">{{item.add_time}} &nbsp;&nbsp; {{item.num}} &nbsp;&nbsp; {{item.status}} &nbsp;&nbsp; <a class="c" @click="rkdl(item.order_id,item.insert_time)">详情</a></p>
            </div>
        </div>
    </div>
</div>
</template>
<style scoped>
    * {
        margin: 0;
        padding: 0;
        font-family: "微软雅黑";
        font-weight: 500;
        /*        text-align: center;*/
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
        width: 60px;
    }

    #Application_Form_Date_ button {
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
        width: 320px;
        height: 180px;
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
        display:inline-block;
    }
    .block li h3 {
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .clear {clear:both;}
    .c{color:blue}
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
            edit(order_id){
                this.$router.push({path: 'Purchase_Order_Not_Audited_Details_Edit', query: { order_id:order_id }});
            },
            rk(order_id){
                this.$router.push({path: 'Purchase_Order_Audited_Details_In', query: { order_id:order_id }});
            },
            tl(order_id){
                this.$router.push({path: 'Purchase_Order_Audited_Details_exit', query: { order_id:order_id }});
            },
            ap(order_id){
                this.$router.push({path: 'Purchase_Order_Audited_Details_payable', query: { order_id:order_id }});
            },
            del: function(order_id) {
				var val = layer.confirm("确认删除", {
						btn: ["确认", "取消"],
						title: [""]
					},function(){
						var sendData = {};
						var jsonData = {};
						sendData.url = "/index.php/pc/Order/order_del";
                        jsonData.style = 1;
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
            back(order_id){
                var val = layer.confirm("确认退回未审核状态？", {
                    btn: ["确认", "取消"],
                    title: [""]
                },function(){
                    var sendData = {};
                    var jsonData = {};
                    sendData.url = "/index.php/pc/Order/order_back";
                    jsonData.style = 1;
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
            rkdl(order_id,insert_time){
                this.$router.push({name: 'Purchase_Order_Audited_Details_In_Details', params: { order_id:order_id ,insert_time:insert_time}});
            },
            tldl(order_id){
                this.$router.push({name: 'Purchase_Order_Audited_Details_In_Details_', params: { order_id:order_id}});
            }
        }

    }
</script>
