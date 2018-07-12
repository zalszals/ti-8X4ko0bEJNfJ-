<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">下单列表</font>

            <span class="h4span-r" style="background-color:#b0c777;" v-on:click="dosousuo()">搜 索</span>
            
            
            <span class="h4span-ra" >
                <select class="selclass" name="" id="">
                    <option value="">请选择下拉模式</option>
                </select>
            </span>

            <span class="h4span-ra">
                <input class="selclass" id="theman" value="请输入客户名称" type="text">
            </span>
            <span class="h4span-ra">
                <input class="selclass" id="thesale" value="请输入商品名称" type="text">
            </span>
            <span class="h4span-ra">
                <select class="selclass" id="selid">
                    <option value="">待审批</option>
                    <option value="">历史审批</option>
                </select>
            </span>
           
        </h4>
        </div>
        
        <div class="checklist-center">
            <ul>
                <li v-for="ilist in info">
                    <a v-on:href="'/sell/check_details?id='+ilist.order_id">
                    <h4>模式一：<font v-if="ilist.is_have==1">现有库存销售</font><font v-else>预生产库存销售</font></h4>
                    <p>销售日期：{{ilist.start_time}}</p>
                    <p>公司名称：{{ilist.company_name}}</p>
                    <p>商品：爱吉301，爱吉302</p>
                    <p><span style="display:inline-block; width:180px;">总量：1000 Kg</span> <span>总额：2000 元</span></p>
                    <p>发货日期：{{ ilist.end_time }}</p>
                    <span class="checklist-centerspan" v-if="check_status==0">待审核</span>
                    <span class="checklist-centerspan" v-else-if="check_status==1">审核通过</span>
                    <span class="checklist-centerspan" v-else>拒绝</span>
                    </a>
                </li>
            </ul>
            
        </div>
       


       

    </div>
</div>
</template>

<script>
export default {
data(){
    return {
        info:[],
    }
},
mounted:function(){
    this.getinfo();
},
methods:{
    getinfo:function(){

        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/sell/Sell/order_listwait";
        jsonData.type=1;
        jsonData.order_type=5;
        jsonData.check_status=1;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.info = re.data;
        //console.log(this.info);
    },

    dosousuo(){

        //$("#selid").val();
        //$("#thesale").val();
        //$("#theman").val();

        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/sell/Sell/order_listwait";
        jsonData.type=$("#selid").val();
        //jsonData.company_name=;
        jsonData.order_type=5;
        jsonData.check_status=1;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.info = re.data;
    },
}

}
</script>

<style lang="less" scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top: 10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.h4span-ra{ float: right; margin-top: 10px; display: inline; color:#fff; font-size: 16px; font-weight: normal; border-radius:3px; margin-left: 16px;  }
.selclass{ height: 36px; border-radius:3px; border: 1px solid #d0dadc; color: #aaa; width: 160px; padding: 0px 10px;}

.checklist-center{ width: 100%; height: auto; }
.checklist-center li{ width: 430px; position: relative; height: 294px; float: left; display: inline; background-color: #fff; border-radius:5px; margin-left: 32px; margin-top: 30px; border: 1px solid #e8e8e8; box-shadow:0 0 10px #eee;  }
.checklist-center li h4{ margin:40px 40px 30px 40px; font-weight: bold; color: #333;}
.checklist-center li p{ margin-bottom: 14px; color: #333; font-size: 16px; margin-left: 40px; }
.checklist-centerspan{ position: absolute; right:20px; color:#fff; top:20px;background-color:#b0c777; border-radius:3px; padding:7px 15px; }
</style>
