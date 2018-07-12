<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">供货管理&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;订单详情</span></font>

            <span class="h4span-r" style="background-color:#b0c777;">返 回</span>
            
        </h4>
        </div>
        <p style="height:50px;"></p>
        <div  class="sell_center">
            <h4 style="color:#f3a753; margin-bottom:20px;">2018-08-04 番茄 2000 kg</h4>
            

            <p style=" width:70%; margin:20px 0; ">
                <table class="atable">
                    <tr>
                        <th>商品</th>
                        <th>数量（Kg）</th>
                        <th>单价</th>
                    </tr>
                    <tr v-for="item in materiel_info">
                        <td>{{item.m_name}}</td>
                        <td>{{item.m_num}}</td>
                        <td>{{item.order_price}}</td>
                    </tr>


                </table>
            </p>

 

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:420px; display:inline-block;">
                    <h4 class="rightzhg">包装要求</h4>
                    <label style="width:150px;  font-weight:normal;">{{info.ask_info}}</label>
                </span>
                <span style="width:420px; display:inline-block;">
                    <h4 class="rightzhg">物流及其他要求</h4>
                    <label style="width:150px;  font-weight:normal;">{{info.other_ask}}</label>
                </span>
            </p>

            
                <p style="margin-bottom:20px; font-size:16px;">
                    <span style="width:420px; display:inline-block;">
                        <h4 class="rightzhg">客户信息</h4>
                        <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">公司名称：</label>
                        <label style="width:150px; font-weight:normal;">{{info.company_name}}</label>
                    </span>
                    <span style="width:420px; display:inline-block;">
                        <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">联系人：</label>
                        <label style="width:150px; font-weight:normal;">{{info.customer_name}}</label>
                    </span>
                </p>
 
                <p style="margin-bottom:30px; font-size:16px;">
                    <span style="width:420px; display:inline-block;">
                        <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">公司地址：</label>
                        <label style="width:150px; font-weight:normal;">{{info.customer_address}}</label>
                    </span>
                    <span style="width:420px; display:inline-block;">
                        <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">手机号：</label>
                        <label style="width:150px; font-weight:normal;">{{info.customer_phone}}</label>
                    </span>
                </p>
				
                <h4 class="rightzhg">物流信息</h4>
                <p style="margin-bottom:20px; font-size:16px;">  
                   <span style="width:420px; display:inline-block;">
                        <label style="width:120px; font-size:15px; font-weight:normal;">实际发货日期：</label>
                        <label style="width:150px; font-weight:normal;">{{info.real_time}}</label>
                    </span>
                </p>
				<template  v-if="info.pay_status==1">
                <p style="margin-bottom:20px; font-size:16px;">
                   <span style="width:420px; display:inline-block;">
                        <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal;">车牌型号：</label>
                        <label style="width:150px; font-weight:normal;">{{info.car_clxh}}</label>
                    </span>
                    <span style="width:420px; display:inline-block;">
                        <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">车牌号：</label>
                        <label style="width:150px; font-weight:normal;">{{info.car_cp}}</label>
                    </span>
                </p>

                <p style="margin-bottom:20px; font-size:16px;">
                   <span style="width:420px; display:inline-block;">
                        <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal;">物流要求：</label>
                        <label style="width:150px; font-weight:normal;">{{info.car_yslx}}</label>
                    </span>
                    <span style="width:420px; display:inline-block;">
                        <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal;">司机姓名：</label>
                        <label style="width:150px; font-weight:normal;">{{info.car_sjxm}}</label>
                    </span>
                </p>

                <p style="margin-bottom:20px; font-size:16px;">
                   <span style="width:420px; display:inline-block;">
                        <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal;">联系电话：</label>
                        <label style="width:150px; font-weight:normal;">{{info.car_lxfs}}</label>
                    </span>
                    <span style="width:420px; display:inline-block;">
                        <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal;">预计送达时间：</label>
                        <label style="width:150px; font-weight:normal;">{{info.submit_time}}</label>
                    </span>
                </p>
				</template>
				<template  v-if="info.pay_status==1">
				
				   <p style="margin-bottom:20px; font-size:16px;">
                   <span style="width:420px; display:inline-block;">
                        <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal;">快递公司：</label>
                        <label style="width:150px; font-weight:normal;">{{info.car_kdgs}}</label>
                    </span>
                    <span style="width:420px; display:inline-block;">
                        <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal;">快递单号：</label>
                        <label style="width:150px; font-weight:normal;">{{info.car_kddh}}</label>
                    </span>
                </p>
				</template>
				
				
				
			<template  v-if="info.pay_status==1">
				  <h4 class="rightzhg">状态：备货</h4>
			</template>
			<template  v-if="info.pay_status==2">
				  <h4 class="rightzhg">状态：已发货</h4>
			</template>
			<template  v-if="info.pay_status==3">
				  <h4 class="rightzhg">状态：已收货</h4>
			</template>
               
			
        </div>


    </div>
</div>
</template>

<script>
	export default {
		data() {
			return {
				order_id:this.$route.params.order_id,
				batch_id:this.$route.params.batch_id,
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
				var batch_id = this.batch_id;
 
				var sendData = {
					url: "index.php/sell/Sell/sell_fill_detail",
					data: {
					 order_id:order_id,
					 batch_id:batch_id,
		 
					}
				};
				var re = getFaceInfo(sendData);
				this.info = re.data;
				this.materiel_info = re.data.check_pi;
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
.rightzhga{ line-height: 45px; color:#f3a753;}
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

.leftp{ width: 70%; float:left; display: inline; height: auto;  }
.rightp{ width: 30%; float:left; display: inline; height: auto;  }

</style>
