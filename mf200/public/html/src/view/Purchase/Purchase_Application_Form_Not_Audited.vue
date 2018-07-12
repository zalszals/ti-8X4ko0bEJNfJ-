<!--申请采购单 不通过-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">申请采购单 | 采购申请单详情</h4>
            </div>
            <div class="case">
                <router-link v-if="list.status == 1 || list.status == 3" :to="{path:'Purchase_Application_Form_Details_Not_Through_Edit',query:{pcs_id:this.$route.query.pcs_id}}"><button  class="button or">编辑</button></router-link>
                <button v-if="list.status == 1 || list.status == 3" @click="del(list.pcs_id)" class="button or">删除</button>
                <button v-if="list.status == 2" @click="draw(list.pcs_id)" class="button or">制定订单</button>
                <button v-if="list.status == 2" @click="back(list.pcs_id)" class="button or">退回</button>
                <button @click="$router.back(-1)" class="button or">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
        <h3>{{list.pcs_no}}</h3>
       <ul>
           <li>
               <p>申请人 ： {{list.worker_name}}</p>
               <p></p>
           </li>
           <li>
               <p>申请部门 : {{list.group_name}}</p>
               <p>申请时间 ： {{list.add_time}}</p>
           </li>
           <li>
               <p v-if="list.beizhu">备注 : {{list.beizhu}}</p><p v-else>备注 : ————</p>
               <p></p>
           </li>
           <li>
               <p v-if="list.check_name">审核人 ： {{list.check_name}}</p> <p v-else>审核人 ： ————</p>
               <p v-if="list.check_time">审核时间 ： {{list.check_time}}</p> <p v-else>审核时间 ： ————</p>
           </li>
           <li v-if="list.status == 3">
               <p>不通过原因 ： {{list.reason}}</p>
           </li>
           <li>
                <p v-if="list.status == 1">单据状态 ： 未审核</p>
                <p v-else-if="list.status == 3">单据状态 ： 未通过</p>
                <p v-else-if="list.status == 2">单据状态 ： 已审核</p>
                <p v-else-if="list.status == 4">单据状态 ： 已制单</p>
           </li>
       </ul>
        </div>
        <div class="block" v-for="(item,index) in data" :key="index">
                <ul>                 
                    <li>
                        <p>物料分类 ：{{item.cat_name}}</p>
                    </li>                    
                    <li>
                        <p>物料名称 ：{{item.m_name}}</p>
                    </li>                
                    <li>
                        <p>物料编号 ： {{item.m_no}}</p>
                    </li>                      
                     <li>
                        <p>物料规格 ： {{item.m_desc}}</p>
                    </li>
                    <li>
                        <p>
                            申请数量 ： {{item.num}}  {{item.unit}}
                        </p>
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
    #Application_Form_main_{
        margin-left: 50px;
    }
   #from h3{
        color: #F4A356;
        margin-top: 50px;
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
        width: 320px;
        height: 180px;
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
        #from li{
        overflow: hidden;
    }
   #from li p{
       width: 400px;
        float: left;
    }
</style>
<script>
    export default {
		data() {
			return{
                list:[],
                data:[],
                item:[]
			}	
        },
        mounted:function(){
            var pcs_id = this.$route.query.pcs_id;
			this.getlist(pcs_id);
        },
        methods: {
            getlist(pcs_id){
               	var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Apply/apply_list";
                jsonData.pcs_id = pcs_id;
                sendData.data = jsonData;
				var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.list = re.list;
					this.data = re.data;
                }            
            },
            del: function(pcs_id) {
				var val = layer.confirm("确认删除", {
						btn: ["确认", "取消"],
						title: [""]
					},function(){
						var sendData = {};
						var jsonData = {};
						sendData.url = "/index.php/pc/Apply/apply_del";
						jsonData.pcs_id = pcs_id;
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
            draw(pcs_id){
                this.$router.push({path: 'Purchase_Order_Not_Audited_Draw', query: { pcs_id:pcs_id }});
            },
            back(pcs_id){
                var val = layer.confirm("确认退回未审核状态？", {
                    btn: ["确认", "取消"],
                    title: [""]
                },function(){
                    var sendData = {};
                    var jsonData = {};
                    sendData.url = "/index.php/pc/Apply/apply_back";
                    jsonData.pcs_id = pcs_id;
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
            }
        }

    }
</script>
