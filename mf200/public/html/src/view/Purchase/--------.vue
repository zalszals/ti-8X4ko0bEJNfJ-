<!--申请采购单 不通过-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>申请采购单 | 采购申请单详情</h4>
            </div>
            <div class="case">
                <router-link to="Purchase_Application_Form_Details_Not_Through_Edit"><button>编辑</button></router-link>
                <button>删除</button>
                <button>返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
        <h3>SG20180528002</h3>
<!--
        <p>申请人&nbsp;&nbsp;：&nbsp;&nbsp;董事长</p>
        <p>申请部门&nbsp;&nbsp;：&nbsp;&nbsp;老板&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;申请时间&nbsp;&nbsp;：&nbsp;&nbsp;2018-05-28</p>
        <p>备注&nbsp;&nbsp;：&nbsp;&nbsp;————</p>
        <p>审核人&nbsp;&nbsp;：&nbsp;&nbsp;董事长&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;审核时间&nbsp;&nbsp;：&nbsp;&nbsp;2018-05-26&nbsp;&nbsp;11:38</p>
        <p>不通过原因&nbsp;&nbsp;：&nbsp;&nbsp;66</p>
        <p>单据状态&nbsp;&nbsp;：&nbsp;&nbsp;未通过</p>
-->
       <ul>
           <li>
               <p>申请人 ： 董事长</p>
               <p></p>
           </li>
           <li>
               <p>申请部门 : 老板</p>
               <p>申请时间 ： 2018-05-28</p>
           </li>
           <li>
               <p>备注 : ----------</p>
               <p></p>
           </li>
           <li>
               <p>审核人 ： 董事长</p>
               <p>审核时间 ： 2018-05-26 11:38</p>
           </li>
           <li>
               <p>不通过原因 ： 66</p>
           </li>
           <li>
               <p>单据状态 ： 未通过</p>
           </li>
       </ul>
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
                            申请数量 ：200kg
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
        #from li{
        overflow: hidden;
    }
   #from li p{
       width: 400px;
        float: left;
    }
</style>
