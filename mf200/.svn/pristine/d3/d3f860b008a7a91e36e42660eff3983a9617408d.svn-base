<template>
<div id="left-box" >
    <div style="" >		
        <div class="newdivtop"> 
        <h4 style="font-weight:bold;">			
			<font style="display:inline-block; margin-top:20px;">订单列表&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;详情</span></font>

            <span class="h4span-r" style="background-color:#b0c777;">返 回</span>
            
        </h4>
        </div>
        <p style="height:50px;"></p>
        <div  class="sell_center">
            <h4 style="color:#f3a753; margin-bottom:20px;">订单信息 
			<template  v-if="info.check_status==0">
				 <span style="float:right; padding:5px 20px; border-radius:3px; color:#fff; font-size:15px; background-color:#f2a553;">待审核</span>
			</template>
			<template  v-if="info.check_status==1">
				 <span style="float:right; padding:5px 20px; border-radius:3px; color:#fff; font-size:15px; background-color:#f2a553;">已通过</span>
			</template>			
			<template  v-if="info.check_status==2">
				 <span style="float:right; padding:5px 20px; border-radius:3px; color:#fff; font-size:15px; background-color:#f2a553;">未通过</span>
			</template>
			
			</h4>
            <p style="font-size:16px; line-height:30px;">模式一：
			
			<span v-if="is_have=='1'">现有库存销售</span>
			<span v-if="is_have=='2'">订单化生产</span>
			
			</p>
            <p style="font-size:16px; line-height:60px;">销售日期：<span>{{info.add_time}}</span></p>

            <p style=" width:70%; margin:20px 0; ">
                <table class="atable">
                    <tr>
                        <th>商品</th>
                        <th>数量（Kg）</th>
                        <th>单价</th>
                        <th>金额</th>
                    </tr>
                    <tr v-for="item in materiel_info">
                        <td>{{item.m_name}}</td>
                        <td>{{item.order_num}}</td>
                        <td>{{item.order_price}}</td>
                        <td>{{item.all_money}}</td>
                    </tr>
                </table>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="display:inline-block; width:200px;">总量：{{info.total_kg}} Kg</span>
                <span>总额：{{info.total_money}} 元</span>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <label style="width:6px; color:red; font-size:15px; font-weight:normal;">*</label>
                <label style="width:160px; font-weight:normal;">客户要求发货日期:</label>
                <label style="width:150px; font-weight:normal;">{{info.submit_time}}</label>
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

			
        </div>

		<template v-if="info.check_status==0">
			<template v-if="check_worker=='2'">
			<ul class="ml50">
				<li class="h80">
					<p>最低付款比例：</p>
					<input type="number" class="input-control w100" id="check_money"/> %
				</li>
				<li class="mb20">
					<p>审核意见：</p>
					<textarea class="input-control w500 h80" id="check_remark"></textarea>
				</li>
				<li>
					<button @click="checkRemark(1)" class="button or">通过</button>
					<button @click="checkRemark(2)" class="button or">不通过</button>
				</li>
			</ul>			
			</template>
		</template>
		<template v-if="info.check_status!=0">
			<ul class="ml50">
				<li class="h80">
					<p>最低付款比例：</p>
					<input type="text" class="input-control w300"  disabled :value="info.check_money" />
				</li>
				<li>
					<p>审核意见：</p>
					<textarea class="input-control w500 h80"  disabled :value="info.check_remark"></textarea>
				</li>
			</ul>			
		</template>
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
				materiel_info:[],
				check_worker:''
			};
		},
		mounted:function(){
			this.getlists()
	 	},

		methods:{
			getlists:function(){
			
				var order_id = this.order_id;
 
				var sendData = {
					url: "index.php/sell/Sell/order_infowait",
					data: {
					 order_id:order_id,
		 
					}
				};
				var re = getFaceInfo(sendData);
				this.check_worker = re.check_worker;
				this.info = re.data;
				this.is_have = this.info.is_have;
				this.materiel_info = re.data.orinfo;
   			},
	 
 			checkRemark:function(type){
			 
				var order_id = this.order_id;
				var check_money = $('#check_money').val();
				var check_remark = $('#check_remark').val();
				
				if(check_money==''){
					layer.msg('请输入付款比例');
					return false;
				}
 				if(check_remark==''){
					if(type==2){
						layer.msg('请输入审批意见');
						return false;
					}else{
						check_remark = '同意';
					}
				}
 
				var sendData = {
					url: "index.php/sell/Sell/check_order",
					data: {
						order_id:order_id,
						type:type,
						check_remark:check_remark,
						check_money:check_money
					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
					// location.href =location.href;
					layer.msg(re.msg, { time: 2000 }, function(){
						window.location.href = "/#/router_main_Sell_System/sell/nocheck_list";
					});
				} else {
					layer.msg(re.msg);
				}
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
