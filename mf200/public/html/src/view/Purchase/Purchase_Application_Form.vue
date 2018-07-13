<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">申请采购单</h4>
            </div>
            <div class="case">
                <select id="selected" @change="change()" class="select">
                    <option value ="1">待审核</option>
                    <option value ="2">已审核</option>
                    <option value ="3">不通过</option>
                </select>
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case1" placeholder="请输入开始时间"/>
                </div>至
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input' id="ECalendar_case2" placeholder="请输入结束时间"/>
                </div>
                <input type="text" name="date" class='ECalendar input' placeholder="请输入申请单编号" id="no" />
                <input type="text" name="date" class='ECalendar input' placeholder="请输入申请人名称" id="name" />
                <button @click="getlist(1)" class="button or">筛选</button>
                <button @click="add()" class="button or">添加</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <router-link :to="{path:'Purchase_Application_Form_Not_Audited',query:{pcs_id:item.pcs_id}}" v-for="(item,index) in list" :key="index" >
            <div>
                <ul>
                    <li>
                        <h3 class="tit">{{item.pcs_no}}</h3>
                    </li>                   
                    <li>
                        <p>申请人 ：{{item.worker_name}}</p>
                    </li>                    
                    <li>
                        <p>申请时间 ：{{item.add_time}}</p>
                    </li>                                     
                     <li v-if="item.status == 1">
                       <button @click.stop.prevent="check(item.pcs_id)" class="div_button or">通过</button>
                       <button @click.stop.prevent="checkno(item.pcs_id)" class="div_button or">不通过</button>
                    </li>
                    <li v-else>
                        <p>审核时间 ：{{item.check_time}}</p>
                    </li>
                    <li v-if="item.status == 3">
                        <p>不通过原因 ：{{item.reason}}</p>
                    </li>
                    <li v-if="item.status == 2 || item.status == 4">
                        <p><span v-if="item.status == 2" class="sp_style">已审核</span><span v-else class="sp_style_two">已制单</span></p>
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
        height: 200px;
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
<style>
    .line {margin-top:30px;font-size:18px;font-weight:bold}
    .line-input {margin-top:40px;height:30px;width:250px}
    .sp_style {margin-top: 30px;padding-left: 20px;padding-right: 20px;padding-top: 5px; padding-bottom: 5px;color: white;border: 0;border-radius: 5px;background-color: #B0C777;margin-right: 40px}
    .sp_style_two {margin-top: 30px;padding-left: 20px;padding-right: 20px;padding-top: 5px; padding-bottom: 5px;color: white;border: 0;border-radius: 5px;background-color: #F4A356;margin-right: 40px}
    body .myclass {border-radius:10px;text-align:center}
    body .myclass .layui-layer-btn{height:80px}
    body .myclass .layui-layer-btn {text-align:center}
    body .myclass .layui-layer-btn .layui-layer-btn0 {background-color:#F4A356;border:1px solid #fff;padding:0px 28px;border-radius:15px;margin-right:20px}
    body .myclass .layui-layer-btn .layui-layer-btn1 {border:1px solid #f1f1f1;padding:0px 28px;border-radius:15px}
</style>
<script>
    export default {
		data() {
			return{
				list:[],
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
                sendData.url = "/index.php/pc/Apply/apply";
                jsonData.page = page;
                jsonData.type = $('#selected').val();
                jsonData.start = $('#ECalendar_case1').val();
                jsonData.end = $('#ECalendar_case2').val();
                jsonData.worker_name = $('#name').val();
                jsonData.sn = $('#no').val();
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.list = re.data;
					this.pages = re.total.pages;
					this.page = re.total.page;
                }else{
                    layer.msg(re.msg);
                }
            },
            change(){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Apply/apply";
                jsonData.page = 1;
                jsonData.type = $('#selected').val();
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.list = re.data;
					this.pages = re.total.pages;
					this.page = re.total.page;
                }else{
                    layer.msg(re.msg);
                }
            },
            check: function(pcs_id) {
				var val = layer.confirm("确认通过吗？", {
						btn: ["确认", "取消"],
						title: [""]
					},function(){
						var sendData = {};
						var jsonData = {};
						sendData.url = "/index.php/pc/Apply/apply_check";
                        jsonData.pcs_id = pcs_id;
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
