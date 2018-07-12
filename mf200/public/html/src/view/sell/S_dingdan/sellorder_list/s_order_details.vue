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
            <h4 style="color:#f3a753; margin-bottom:20px;">订单信息 
 
			</h4>
 
            <p style="font-size:16px; line-height:60px;">销售日期：<span>{{info.add_time}}</span></p>

            <p style=" width:70%; margin:20px 0; ">
                <table class="atable">
                    <tr>
                        <th>时间</th>
                        <th>数量（Kg）</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    <tr v-for="item in materiel_info">
                        <td>{{item.add_time}}</td>
                        <td>{{item.num}}</td>
						<template  v-if="item.pay_status==1">
						  <td>备货中</td>
						</template>
						<template  v-if="item.pay_status==2">
						  <td>已发货</td>
						</template>
						<template  v-if="item.pay_status==3">
						  <td>已收货</td>
						</template>
					
                        
                        <td><a :href="'#/router_main_Sell_System/sell/s_supplydetails/'+item.batch_id">详情</a></td>
                    </tr>
 

                </table>
            </p>


            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">包装要求</h4>
                    <label style="width:150px;  font-weight:normal;">{{info.ask_info}}</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">物流及其他要求</h4>
                    <label style="width:150px;  font-weight:normal;">{{info.other_ask}}</label>
                </span>
            </p>

            <p style="margin-bottom:20px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">客户信息</h4>
                    <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">公司名称：</label>
                    <label style="width:150px; font-weight:normal;">{{info.company_name}}</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">联系人：</label>
                    <label style="width:150px; font-weight:normal;">{{info.customer_name}}</label>
                </span>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">公司地址：</label>
                    <label style="width:150px; font-weight:normal;">{{info.customer_address}}</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">手机号：</label>
                    <label style="width:150px; font-weight:normal;">{{info.customer_phone}}</label>
                </span>
            </p>
			
             <p style="margin-bottom:20px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">订单状态</h4>
                    <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">状态：</label>
					
                   
					<template  v-if="info.check_status==1">
						 <label style="width:150px; font-weight:normal;">审核通过</label>
					</template>
					<template  v-if="info.check_status==2">
						 <label style="width:150px; font-weight:normal;">审核未通过</label>
					</template>
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">审批日期：</label>
                    <label style="width:150px; font-weight:normal;">{{info.check_time}}</label>
                </span>
            </p>

			<p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">审批人：</label>
                    <label style="width:150px; font-weight:normal;">{{info.check_people}}</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">最低付款比例：</label>
                    <label style="width:150px; font-weight:normal;">{{info.check_money}}%</label>
                </span>
				<span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">审批意见：</label>
                <label style="width:150px; font-weight:normal;">{{info.check_remark}}</label>
                </span>
            </p>
			
			
        </div>


    </div>
</div>
</template>

<script>
	export default {
		data() {
			return {
				order_id:this.$route.params.order_id,
				info:[],
				is_have:'',
				materiel_info:[]
			};
		},
		mounted:function(){
			this.getlists()
	 	},

		methods:{
			getlists:function(){
			
				var order_id = this.order_id;
 
				var sendData = {
					url: "index.php/sell/Sell/add_order_info",
					data: {
					 order_id:order_id,
		 
					}
				};
				var re = getFaceInfo(sendData);
				this.info = re.data;
				this.is_have = this.info.is_have;
				this.materiel_info = re.data.pici_info;
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

</style>
