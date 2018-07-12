<!--申请采购单 待审核 编辑-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>申请采购单 | 采购申请单详情 | 编辑采购申请表</h4>
            </div>
            <div class="case">
                
                <button>完成</button>
                <button @click="$router.back(-1)">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
        <p>申请人&nbsp;&nbsp;：&nbsp;&nbsp;{{list.worker_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;部门&nbsp;&nbsp;：&nbsp;&nbsp;{{list.group_name}}</p>
        <p>日期&nbsp;&nbsp;：&nbsp;&nbsp;<input type="text" id="date" value="list.add_time"></p>
        <p>备注&nbsp;&nbsp;：&nbsp;&nbsp;<input type="text" value="list.beizhu"></p>
        </div>
        <div>
            <p class="ora">添加物料</p>
            <p><button>添加</button></p>
        </div>
        <div class="block">

                <ul>                 
                    <li>
                        <p>物料分类 ：番茄 埃及赔礼</p>
                    </li>                    
                    <li>
                        <p>物料名称 ：埃及赔礼二极管</p>
                    </li>                
                    <li>
                        <p>物料编号 ： FQ002-1</p>
                    </li>                      
                     <li>
                        <p>物料规格 ：二极管</p>
                    </li>
                    <li>
                        <p>
                            申请数量 ：<input type="text"> kg
                        </p>
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
    p button{
        margin-top: 30px;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 2px;
        padding-bottom: 2px;
        color: white;
        border: 0;
        border-radius: 5px;
        background-color: #F4A356;
    }
</style>
<script>
    export default {
        data() {
            return {
                data:[],
                list:[],
                mate:[],
                wuliao:[],
                close_: 1000,
                id: 1,
                lists: []
            }
        },
        mounted:function(){
			this.edit();
        },
        methods: {
            edit(){
               	var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Apply/apply_list";
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
                    this.data = re.data;
                    this.list = re.list;
				} 
            },
        }
    }
</script>