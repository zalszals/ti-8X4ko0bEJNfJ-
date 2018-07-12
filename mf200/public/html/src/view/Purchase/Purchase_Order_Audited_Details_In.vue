<!--采购订单 订单详情 采购入库-->
<!--采购订单 未审核 详情-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>采购订单 | 订单详情 | 采购入库</h4>
            </div>
            <div class="case">

                <button @click="rk()">完成</button>
                <button @click="$router.back(-1)">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
            <ul>
                <li>
                    <p>申请人 ：{{workers.worker_name}}</p>
                    <p>部门 ：{{workers.group_name}}</p>
                </li>
                <li>
                    <p>日期 <input type="text" class="input" value="2018-7-4" placeholder="请选择日期" id="date"></p>
                </li>
                <li>
                    <p>供应商 <font>{{data.supply_name}}</font></p>
                </li>
                <li>
                    <p>采购部门 <font>{{data.group_name}}</font></p>
                </li>
                <li>
                    <p>采购人 <font>{{data.worker_name}}</font></p>
                </li>      
                <li>
                   <p>备注 <input type="text" class="input" id="beizhu" placeholder="请输入备注"></p>
                </li>
				<li>
					<p>入库总数量 ：<font id="zsl">0.0</font></p>
				</li>
            </ul>
        </div>
        <div class="block" v-for='(item,index) in info' :key="index">
            <ul>
                <li>
                    <p>物料分类 ：{{item.cat_name}}</p>
                </li>
                <li>
                    <p>物料名称 ：{{item.m_name}}</p>
                </li>
                <li>
                    <p>物料编号 ：{{item.m_no}}</p>
                </li>
                <li>
                    <p>物料规格 ：{{item.m_desc}}</p>
                </li>
                <li>
                    <p>采购数量 ：{{item.num}} {{item.unit}}</p>
                </li> 
                <li>
                    <p>实际数量 ： <input type="text" class="input" :id="'num'+index" @input="input()">{{item.unit}}</p>
                </li>
            </ul>
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
        height: 250px;
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
                item:[],
                workers:[]
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
                sendData.url = "/index.php/pc/Order/edit";
                jsonData.order_id = order_id;
                sendData.data = jsonData;
				var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.info = re.info;
                    this.data = re.data;
                    this.workers = re.workers;
                }            
            },
            input(){
                var num = 0;
                for(var i=0;i<this.info.length;i++){
                    num =  num + $('#num'+i).val() * 1;
                }
                $('#zsl').text(num);
            },
            rk(){
                if(!$('#date').val()){
                    layer.msg('请选择日期');return;
                }
                var sendData = {};
                var jsonData = {}; 
                sendData.url = "/index.php/pc/Order/order_ruku";
                jsonData.order_id = this.$route.query.order_id;
                jsonData.add_time = $('#date').val();
                jsonData.beizhu = $('#beizhu').val();
                var od_id = '';
                var m_id = '';
                var num = '';
                for(var i = 0;i<this.info.length;i++){
                    if(isNaN($('#num'+i).val())){
                        layer.msg('实际数量必须为数字');return;
                    }
                    if($('#num'+i).val()){
                        od_id += this.info[i]['od_id']+',';
                        m_id += this.info[i]['m_id']+',';
                        num += $('#num'+i).val()+',';
                    }
                }
                od_id  = od_id.substring(0, od_id.length - 1);
                m_id  = m_id.substring(0, m_id.length - 1);
                num  = num.substring(0, num.length - 1);
                jsonData.od_id = od_id;
                jsonData.m_id = m_id;
                jsonData.num = num;
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    layer.msg(re.msg,{time: 1000},function(){
                        window.location.href = '#/router_main_Purchase_System/Purchase_Order_Not_Audited_Details?order_id='+jsonData.order_id;
                    });					
                }else{
                    layer.msg(re.msg);
                }	 
            }
        }
    }
</script>
