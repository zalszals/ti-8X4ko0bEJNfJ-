<!--采购退料单 订单详情 生产应收单-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>采购退料单 | 订单详情 | 生成应收单</h4>
            </div>
            <div class="case">

                <button @click="ap()">完成</button>
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
                    <p>供应商 <input type="text" class="input" v-bind:value="data.supply_name"></p>
                </li>                             <li>
                   <p>备注 <input type="text" class="input" id="beizhu" placeholder="请输入备注"></p>
                </li>
				<li>
					<p>总金额 ：<font id="zje">0.00</font> 元</p>
					<p>总数量 ：<font id="zsl">0.0</font></p>
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
                    <p>计价数量 ：<input type="text" :id="'num'+index" @input="input()" v-bind:value="item.num">{{item.unit}}</p>
                </li>                              
                <li>
                    <p>单价 ：<font :id="'dj'+index">{{item.price}}</font> 元</p>
                </li>
                <li>
                	<p>金额 ：<font :id="'je'+index">{{item.m_sum}}</font> 元</p></p>
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
                    var num = 0;
                    var sum = 0;
                    for(var i = 0;i<this.info.length;i++){
                        num += this.info[i]['num']*1;
                        sum += this.info[i]['m_sum']*1;
                    }
                    $('#zsl').text(num);
                    $('#zje').text(sum);
                }            
            },
            input(){
                var num = 0;
                var sum = 0;
                for(var i=0;i<this.info.length;i++){
                    if(!isNaN($('#num'+i).val())){
                        $('#je'+i).text($('#num'+i).val()*$('#dj'+i).text());
                        num +=  $('#num'+i).val()* 1;
                        sum +=  $('#je'+i).text()* 1;
                    }
                }
                $('#zsl').text(num);
                $('#zje').text(sum); 
            },
            ap(){
                if(!$('#date').val()){
                    layer.msg('请选择日期');return;
                }
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Order/order_pay";
                jsonData.add_time = $('#date').val();
                jsonData.supply_id = this.data.supply_id;
                jsonData.style = 2;
                jsonData.order_id = this.$route.query.order_id;
                jsonData.num = $('#zsl').text();
                jsonData.sum = $('#zje').text();
                jsonData.beizhu = $('#beizhu').val();
                var m_id = '';
                var m_num = '';
                var price = '';
                var m_sum = '';
                for(var i = 0;i<this.info.length;i++){
                    if($('#num'+i).val()){
                        if(isNaN($('#num'+i).val())){
                            layer.msg('计价数量必须为数字');return;
                        }
                        m_id += this.info[i]['m_id']+',';
                        m_num += $('#num'+i).val()+',';
                        m_sum += $('#je'+i).text()+',';
                        price += $('#dj'+i).text()+',';
                    }   
                }
                m_sum = m_sum.substring(0, m_sum.length - 1);
                m_id  = m_id.substring(0, m_id.length - 1);
                m_num = m_num.substring(0, m_num.length - 1);
                price = price.substring(0, price.length - 1);
                jsonData.m_id = m_id;
                jsonData.m_num = m_num;
                jsonData.m_sum = m_sum;
                jsonData.price = price;
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    layer.msg(re.msg,{time: 1000},function(){
                        window.location.href = '#/router_main_Purchase_System/Purchase_Return_From_Not_Through_Details?order_id='+jsonData.order_id;
                    });					
                }else{
                    layer.msg(re.msg);
                }
            }
        }

    }
</script>
