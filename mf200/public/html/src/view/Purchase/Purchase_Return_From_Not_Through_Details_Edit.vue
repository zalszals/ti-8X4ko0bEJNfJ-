<!--采购退料单 未通过  详情 编辑-->
<!--申请采购单 待审核 编辑-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">采购退料单 | 采购退料单详情 | 编辑采购退料单</h4>
            </div>
            <div class="case">
                
                <button @click="do_edit()" class="button or">完成</button>
                <button @click="$router.back(-1)" class="button or">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
        	<div>
        		<p>申请人</p>
        		<p>{{workers.worker_name}}</p>
        		<p>部门</p>
        		<p>{{workers.group_name}}</p>
        	</div>
        	<div>
        		<p>日期</p>
        		<p><input type="text" id="date" v-bind:value="data.add_time" class="input"></p>
        	</div>
        	<div>
        		<p>供应商</p>
        		<p><select id="supply" v-model="sup_selected" class="select">
  <option v-for="(item,index) in supply" :key="index" v-bind:value ="item.supply_id">{{item.supply_name}}</option>
</select></p>
        	</div>
        	<div>
        		<p>退料方式</p>
        		<p><select id="mode" v-model="mo_selected" class="select">
  <option value ="1">退料换料</option>
  <option value ="2">退料退款</option>
  <option value ="3">仅退料</option>
</select></p>
        	</div>
        	<div>
        		<p>退料原因</p>
        		<p><input type="text" v-bind:value="data.cause" id="cause" class="input"></p>
        	</div>
        	<div>
        		<p>备注</p>
        		<p><input type="text" v-bind:value="data.beizhu" id="beizhu"  class="input"></p>
        	</div>
        </div>
        <div>
            <p >总金额 ： <font id="zje">{{data.sum}}</font> 元</p>
            <p >总数量 ： <font id="zsl">{{data.num}}</font></p>
        </div>
        <div class="block" v-for="(item,index) in info" :key="index" >
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
                        <p>
                            申请数量 ：<input :id="'sl'+index" type="text" v-bind:value="item.num" @input="input(index)"  class="input"> {{item.unit}}
                        </p>
                    </li>
                    <li><p>单价 ： <font :id="'dj'+index">{{item.price}}</font> 元</p></li>
                    <li><p>金额 ： <font :id="'je'+index">{{item.m_sum}}</font> 元</p></li>
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
    #Application_Form_main_{
        margin-left: 50px;
    }
   .ora{
        color: #F4A356;
        margin-top: 35px;
    }
   #from p{
        margin-top: 30px;
    }
    .block{
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
    .block li{
        margin-left: 30px;
    }
   .block li p{
        margin-top: 10px;
    }
   .block li h3{
        margin-top: 20px;
        margin-bottom: 20px;
    }
		#from div {
		overflow: hidden;
	}
	#from div *{
		float: left;
	}
	p{
		width: 100px;
	}
	select{
		margin: 0;
	}
</style>
<script>
export default {
		data() {
			return{
                data:[],
                supply:[],
                info:[],
                item:[],
                workers:[],
                sup_selected:'',
                mo_selected:'',
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
                    this.supply = re.supply;
                    this.sup_selected = re.data.supply_id;
                    this.mo_selected = re.data.mode;
                }            
            },
            input(index){
                if(!isNaN($('#sl'+index).val())){
                    var je  = $('#dj'+index).text()*$('#sl'+index).val();
                    $('#je'+index).text(je.toFixed(2));
                    var num = 0;
                    var sum = 0;
                    for(var i=0;i<this.info.length;i++){
                       num =  num + $('#sl'+i).val() * 1;
                       sum =  sum + $('#je'+i).text() * 1;
                    }
                    $('#zje').text(sum);
                    $('#zsl').text(num);
                }
            },
            do_edit(){
                if(!$('#date').val()){
                    layer.msg('请选择日期');return;
                }
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Order/back_edit";
                jsonData.order_id = this.$route.query.order_id;
                jsonData.add_time = $('#date').val();
                jsonData.supply_id = $('#supply').val();
                jsonData.mode = $('#mode').val();
                jsonData.cause = $('#cause').val();                
                jsonData.num = $('#zsl').text();
                jsonData.sum = $('#zje').text();
                jsonData.beizhu = $('#beizhu').val();
                var od_id = '';
                var m_id = '';
                var m_num = '';
                var m_sum = '';
                var price = '';
                for(var i = 0;i<this.info.length;i++){
                    if(i == this.info.length-1){
                        od_id += this.info[i]['od_id'];
                        m_id += this.info[i]['m_id'];
                        m_num += $('#sl'+i).val();
                        m_sum += $('#je'+i).text();
                        price += $('#dj'+i).text();
                    }else{
                        od_id += this.info[i]['od_id']+',';
                        m_id += this.data.info[i]['m_id']+',';
                        m_num += $('#sl'+i).val()+',';
                        m_sum += $('#je'+i).text()+',';
                        price += $('#price'+i).text()+',';
                    }
                }
                jsonData.od_id = od_id;
                jsonData.m_id = m_id;
                jsonData.m_num = m_num;
                jsonData.m_sum = m_sum;
                jsonData.price = price;
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    layer.msg(re.msg,{time: 1000},function(){
                        window.location.href = '#/router_main_Purchase_System/Purchase_Return_From';
                    });					
                }else{
                    layer.msg(re.msg);
                }	 
            }
        }

    }
</script>
