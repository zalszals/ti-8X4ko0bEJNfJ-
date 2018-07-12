<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">订单列表&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;详情</span></font>

            <span class="h4span-r" style="background-color:#b0c777;">返 回</span>
            
        </h4>
        </div>
        <p style="height:50px;"></p>
        <div  class="sell_center">
            <h4 style="color:#f3a753; margin-bottom:20px;">订单信息 <span style="float:right; padding:5px 20px; border-radius:3px; color:#fff; font-size:15px; background-color:#f2a553;">待审核</span></h4>
            <p style="font-size:16px; line-height:30px;">模式一：<span>现有库存销售</span></p>
            <p style="font-size:16px; line-height:60px;">销售日期：<span>{{details.add_time}}</span></p>

            <p style=" width:70%; margin:20px 0; ">
                <table class="atable">
                    <tr>
                        <th>商品</th>
                        <th>数量（Kg）</th>
                        <th>单价</th>
                        <th>金额</th>
                    </tr>
                    <tr v-for="dlist in details.orinfo">
                        <td>{{dlist.cat_name}}</td>
                        <td>{{dlist.order_num}}</td>
                        <td>{{dlist.order_price}}</td>
                        <td>{{dlist.order_price*dlist.order_num}}</td>
                    </tr>
                    <!--<tr>
                        <td>爱吉301</td>
                        <td>1000</td>
                        <td>5</td>
                        <td>5000</td>
                    </tr>
                    -->
                </table>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="display:inline-block; width:200px;">总量：{{totil}} Kg</span>
                <span>总额：{{totila}} 元</span>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <label style="width:6px; color:red; font-size:15px; font-weight:normal;">*</label>
                <label style="width:150px;  font-weight:normal;">客户要求发货日期:</label>
                <label style="width:150px;  font-weight:normal;">{{details.start_time}}</label>
                
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">包装要求</h4>
                    <label style="width:150px;  font-weight:normal;">{{details.ask_info}}</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">物流及其他要求</h4>
                    <label style="width:150px;  font-weight:normal;">{{details.other_ask}}</label>
                </span>
            </p>

            <p style="margin-bottom:20px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">客户信息</h4>
                    <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">公司名称：</label>
                    <label style="width:150px; font-weight:normal;">{{details.company_name}}</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">联系人：</label>
                    <label style="width:150px; font-weight:normal;">{{details.customer_name}}</label>
                </span>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">公司地址：</label>
                    <label style="width:150px; font-weight:normal;">{{details.customer_address}}</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">手机号：</label>
                    <label style="width:150px; font-weight:normal;">{{details.customer_phone}}</label>
                </span>
            </p>
                
            <p style="margin-bottom:30px; font-size:16px;">
                <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal;">最低付款比例：</label>
                <input type="text" class="form-control" style="width:300px; display:inline-block;" value="请输入最低付款比例">
            </p>

            <p style="margin-bottom:50px;">
                <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal; ">审批意见：</label>
                <textarea type="text" style="width:400px; display:inline-block; vertical-align: top;" rows="3" class="form-control">请输入审批意见</textarea>
            </p>
			
            <p style="margin-bottom:30px; text-align:center;">
                <span class="yuspan">不通过</span>
                <span class="yuspan" style="background-color:#b0c777;">通过</span>
            </p>
        </div>


    </div>
</div>
</template>

<script>
export default {
data(){
    return {
        getid:'',
        details:[],
        totil:[],
        totila:[],

    }
},
mounted:function(){
    
    this.getid=this.$route.query.id;
    this.getdetails();

},
methods:{
    getdetails:function(){

        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/sell/Sell/order_infowait";
        jsonData.order_id=this.getid;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.details = re.data;
        var all = this.details.orinfo;
        var sum=0; var suma=0;
        for(var i=0;i<all.length;i++){
            sum += all[i]['order_num'];
            
            suma += all[i]['order_num']*all[i]['order_price'];
        }
        console.log(sum);
        console.log(suma);
        this.totil=sum;
        this.totila=suma;
        //console.log(this.details);
    }
},

}
</script>

<style lang="less" scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top: 10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.h4span-ra{ float: right; margin-top: 10px; display: inline; color:#fff; font-size: 16px; font-weight: normal; border-radius:3px; margin-left: 16px;  }
.selclass{ height: 36px; border-radius:3px; border: 1px solid #d0dadc; color: #aaa; width: 160px; padding: 0px 10px;}

.sell_center{ width: 90%; margin-left: 50px; height: auto;}
.sell_center ul li{ width: 100%; height: auto; }
.rightzhg{ line-height: 50px; color:#f3a753;}

table {
		width: 100%;
		border-collapse: collapse;
		margin: 0 auto;
		text-align: center;
	}

	.atable tr th {
		text-align: center;
        padding: 10px 30px;
        background-color: #fff;
        border-bottom: 1px solid #e2e2e2;
	}

	.atable tr td {
		text-align: center;
        padding: 10px 30px;
        background-color: #fff;
        border-bottom: 1px solid #eee;
	}

.yuspan{ padding: 7px 20px; background-color:#f2a553; color: #fff; margin-left: 20px; border-radius:5px; }
</style>
