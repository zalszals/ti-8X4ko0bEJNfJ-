<!--采购订单-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">采购订单</h4>
            </div>
            <div class="case">
                <select id="select" @change="change()" class="select"> 
                    <option value ="1">待审核</option>
                    <option value ="2">已审核</option>
                </select>
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case1" placeholder="请输入开始时间"/>
                </div>至
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case2" placeholder="请输入结束时间"/>
                </div>
                <input type="text" name="date" class='ECalendar input' placeholder="请输入采购编号" id="no"/>
                <input type="text" name="date" class='ECalendar input' placeholder="请输入采购人"  id="name"/>
                <input type="text" name="date" class='ECalendar input' placeholder="请输入采购部门" id="group"/>
                <input type="text" name="date" class='ECalendar input' placeholder="请输入供应商"  id="supply"/>
                <button @click="search()" class="button or">搜索</button>
                <router-link to="Purchase_Order_Not_Audited_Add"><button class="button or">添加</button></router-link>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <router-link :to="{path:'Purchase_Order_Not_Audited_Details',query:{order_id:item.order_id}}" v-for="(item,index) in data" :key="index">
            <div>
                <ul>
                    <li>
                        <h3 class="tit">{{item.order_sn}}</h3>
                    </li>                   
                    <li>
                        <p>申请人 ：{{item.worker_name}}</p>
                    </li>                    
                    <li>
                        <p>采购部门 ：{{item.group_name}}</p>
                    </li>                
                    <li>
                        <p>供应商 ：{{item.supply_name}}</p>
                    </li>                      
                     <li>
                        <p>采购数量 ：{{item.num}}</p>
                    </li>                     
                    <li>
                        <p>采购金额 ：{{item.sum}} 元</p>
                    </li>                 
                    <li>
                        <p>采购时间 ：{{item.add_time}}</p>
                    </li>                    
                    <li v-if="item.status == 1">
                        <button @click.stop.prevent="check(item.order_id)" class="button or">通过</button>
                    </li>
                </ul>
            </div>
        </router-link>
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
/*		margin-left: 200px;*/
         /* float: right;  */
        margin-top: -30px;
    }
    #Application_Form_main_{
        overflow: hidden;
    }
    #Application_Form_main_ div {
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
        height: 320px;
    }

    .case select {
        border-style: solid;
        border-width: 1px;
        border-color: #EAEEF1;
        padding: 5px;
        border-radius: 5px;
        margin-right: 10px;
    }

    li button {
        margin-top: 20px;
    }
    li{
        margin-left: 30px;
    }
    li p{
        margin-top: 10px;
    }
    li h3{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    ul{
    }
</style>
<script>
    export default {
		data() {
			return{
                data:[],
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
                sendData.url = "/index.php/pc/Order/order_list";
                jsonData.page = page;
                jsonData.style = 1;
                jsonData.type = $('#select').val();
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.data = re.data;
					this.pages = re.total.pages;
					this.page = re.total.page;
                }else{
                    layer.msg(re.msg);
                }
            },
            change(){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Order/order_list";
                jsonData.page = 1;
                jsonData.style = 1;
                jsonData.type = $('#select').val();
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.data = re.data;
					this.pages = re.total.pages;
					this.page = re.total.page;
                }else{
                    layer.msg(re.msg);
                }
            },
            search(){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Order/order_list";
                jsonData.page = 1;
                jsonData.style = 1;
                jsonData.type = $('#select').val();
                jsonData.sn = $('#no').val();
                jsonData.start = $('#ECalendar_case1').val();
                jsonData.end = $('#ECalendar_case2').val();
                jsonData.worker_name = $('#name').val();
                jsonData.group_name = $('#group').val();
                jsonData.supply_name = $('#supply').val();
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.data = re.data;
					this.pages = re.total.pages;
					this.page = re.total.page;
                }else{
                    layer.msg(re.msg);
                }
            },
            check: function(order_id) {
				var val = layer.confirm("确认通过吗？", {
						btn: ["确认", "取消"],
						title: [""]
					},function(){
						var sendData = {};
						var jsonData = {};
						sendData.url = "/index.php/pc/Order/order_check";
                        jsonData.order_id = order_id;
                        jsonData.type = 1;
						sendData.data = jsonData;
						var re = getFaceInfo(sendData);
						if(re.status == 1){
							layer.msg(re.msg,{time: 1000},function(){
								window.location.reload();
							});					
						}else{
							layer.msg(re.msg);
						}	
					},function(){
						layer.close(val);
					})
            },
            checkno: function(pcs_id) {
                layer.open({
                    type: 1,
                    title: false,
                    closeBtn: 0,
                    btn: ['保存','取消'],
                    shadeClose: true,
                    skin: 'myclass',
                    area: ['350px', '250px'],
                    content: "<div><p class='line'>原&nbsp;&nbsp;因</p><p><input type='text' name='reason' id='reason' class='line-input' placeholder='请输入审核不通过原因'></p></div>",
                    yes:function(index, layero){
                        var sendData = {};
						var jsonData = {};
						sendData.url = "/index.php/pc/Apply/apply_check";
                        jsonData.pcs_id = pcs_id;
                        jsonData.type = 2;
                        jsonData.reason = $('#reason').val();
						sendData.data = jsonData;
						var re = getFaceInfo(sendData);
						if(re.status == 1){
							layer.msg(re.msg,{time: 1000},function(){
								window.location.reload();
							});					
						}else{
							layer.msg(re.msg);
						}	
                    }
                });
            },
            add(){
                window.location.href = '#/router_main_Purchase_System/Purchase_Application_Form_Not_Audited_Add';
            }
        }
    }
</script>
