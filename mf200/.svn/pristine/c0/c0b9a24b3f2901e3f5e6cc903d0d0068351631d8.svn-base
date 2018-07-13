<!--采购入库单-->
<!--采购退料单-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">采购入库单</h4>
            </div>
            <div class="case">
                <select id="select" @change="change()" class="select">
                    <option value ="1">待审核</option>
                    <option value ="2">待入库</option>
                    <option value ="3">已完成</option>
                </select>
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case1" placeholder="请输入开始时间"/>
                </div>至
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case2" placeholder="请输入结束时间"/>
                </div>
                <input type="text" name="worker" class='ECalendar input' placeholder="请输入申请人名称" id="worker"/>
                <input type="text" name="group" class='ECalendar input' placeholder="请输入申请部门名称" id="group"/>
                <input type="text" name="supply" class='ECalendar input' placeholder="请输入供应商名称" id="supply"/>
                <button @click="getlist(1)" class="button or">搜索</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <router-link  :to="{path:'Purchase_In_From_Not_Audited_Details',query:{order_id:item.order_id,insert_time:item.insert_time}}" v-for="(item,index) in data" :key="index">
            <div>
                <ul>
                    <li>
                        <h3 class="tit">{{item.order_sn}}</h3>
                    </li>                   
                    <li>
                        <p>申请人 ：{{item.worker_name}}</p>
                    </li>                    
                    <li>
                        <p>申请部门 ：{{item.group_name}}</p>
                    </li>                
                    <li>
                        <p>供应商 ：{{item.supply_name}}</p>
                    </li>                      
                     <li>
                        <p>入库数量 ：{{item.sum}}</p>
                    </li>                                      
                        <li>
                        <p>申请时间 ：{{item.add_time}}</p>
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
        float: right;
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
        height: 230px;
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
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 5px;
        padding-bottom: 5px;
        color: white;
        border: 0;
        border-radius: 5px;
        background-color: #F4A356;
        margin-right: 40px;
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
                sendData.url = "/index.php/pc/Order/ruku_list";
                jsonData.page = page;
                jsonData.type = $('#select').val();
                jsonData.start = $('#ECalendar_case1').val();
                jsonData.end = $('#ECalendar_case2').val();
                jsonData.supply_name = $('#supply').val();
                jsonData.worker_name = $('#worker').val();
                jsonData.group_name = $('#group').val();
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
                sendData.url = "/index.php/pc/Order/ruku_list";
                jsonData.page = 1;
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
            }
        }
}
</script>
