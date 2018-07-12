<!--采购入库单 未审核 详情-->
<!--采购退料单 未通过  详情-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>采购退料单 | 采购退料单详情</h4>
            </div>
            <div class="case">
                <button>返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
           <h3>CG20180526004</h3>
            <ul>
                <li>
                    <p>申请人 ： 董事长</p>
                    <p></p>
                </li>
                                <li>
                    <p>申请部门 ： 老板</p>
                    <p>供应商 ： 江苏绿港</p>
                </li>
                                <li>
                    <p>入库数量 ： zz</p>
                    <p>退料时间 ： zz</p>
                </li>
                                <li>
                    <p>备注 ： —— ——</p>
                </li>
            </ul>
        </div>
        <div class="block">
            <table>
                <tr>
                    <th>入库编号</th>
                    <th>物料名称</th>
                    <th>物料规格</th>
                    <th>入库数量</th>
                    <th>仓库</th>
                </tr>
                <tr>
                    <td>20111111</td>
                    <td>埃及一级果</td>
                    <td>一级果</td>
                    <td>3</td>
                    <td>原材料库</td>
                </tr>
            </table>
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
    table{
        margin-top: 30px;
        background-color: white;
    }
    h3{
        margin-top: 30px;
        color: #F4A356;
    }
    th{
        border: 0;
        border-style: solid;
        border-bottom-width: 1px;
        border-color: #EAEEF1;
        padding: 5px;
        border-radius: 5px;
        margin-right: 10px;
        width: 200px;
        text-align: center;
        padding-top: 20px;
        padding-bottom: 20px;
        font-weight: 900;
    }
    tr{
                border: 0;
        border-style: solid;
        border-bottom-width: 1px;
        border-color: #EAEEF1;
        padding: 5px;
        border-radius: 5px;
        margin-right: 10px;
        width: 200px;
        text-align: center;
        height: 50px;
    }
</style>
