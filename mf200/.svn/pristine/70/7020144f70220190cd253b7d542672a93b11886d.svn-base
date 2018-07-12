<!--采购入库单 未审核 详情-->
<!--采购退料单 未通过  详情-->

<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">采购退料单 | 退料订单详情</h4>
            </div>
            <div class="case">
                <button @click="$router.back(-1)" class="button or">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
           <h3>{{info.sn}}</h3>
            <ul>
                <li>
                    <p>申请人 ： {{info.worker_name}}</p>
                    <p></p>
                </li>
                                <li>
                    <p>申请部门 ： {{info.group_name}}</p>
                    <p>供应商 ： {{info.supply_name}}</p>
                </li>
                                <li>
                    <p>入库数量 ： {{info.sum}}</p>
                    <p>申请时间 ： {{info.add_time}}</p>
                </li>
                                <li>
                    <p v-if="info.bz">备注 ： {{info.bz}}</p><p v-else>备注 ： —— ——</p>
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
                <tr v-for="(item,index) in data" :key="index">
                    <td>{{item.insert_sn}}</td>
                    <td>{{item.m_name}}</td>
                    <td>{{item.m_desc}}</td>
                    <td>{{item.num}}</td>
                    <td>{{item.ck_name}}</td>
                </tr>
            </table>
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
<script>
export default {
		data() {
			return{
                data:[],
                info:[],
                item:[]
			}	
		},

		mounted:function(){
            var id = this.$route.query.order_id;
            var time = this.$route.query.insert_time;
            this.getlist(id,time);
        },
        methods: {
            getlist(id,time){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Order/ruku_detail";
                jsonData.order_id = id;
                jsonData.insert_time = time;
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.data = re.data;
                    this.info = re.info;
                }else{
                    layer.msg(re.msg);
                }
            }
        }
}
</script>
