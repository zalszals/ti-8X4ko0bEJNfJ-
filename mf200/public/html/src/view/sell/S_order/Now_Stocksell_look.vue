<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">销售下单&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;现有库存销售</span>&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;预览</span></font>

            <span class="h4span-r cursor" style="background-color:#b0c777;">返 回</span>
            <span class="h4span-r cursor" @click="AddInfo()">确认下单</span>
            
        </h4>
        </div>
        <p style="height:50px;"></p>
        <div  class="sell_center">
            <h4 style="color:#f3a753; margin-bottom:20px;">订单信息</h4>
            <p style="font-size:16px; line-height:30px;">模式一：<span>现有库存销售</span></p>
     

            <p style=" width:70%; margin:20px 0; ">
                <table class="atable">
                    <tr>
                        <th>商品</th>
                        <th>数量（Kg）</th>
                        <th>单价</th>
                        <th>金额</th>
                    </tr>
                    <tr v-for="(item,index) in materlists" :key="index">
                        <td>{{item.m_name}}</td>
                        <td>{{item.num}}</td>
                        <td>{{item.price}}</td>
                        <td>{{item.money}}</td>
                    </tr>
                </table>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="display:inline-block; width:200px;">总量：<span id="count_sum">2000</span> Kg</span>
                <span>总额：<span id="count_money">2000</span> 元</span>
            </p>

            <p class="mb30 f16">
                <label class="">*</label>
                <label class="w160">客户要求发货日期:</label>
                <input type="text" class="input-control w160" id="submit_time" :value="submit_time" disabled />
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">包装要求</h4>
                    <label style="width:150px;  font-weight:normal;" id="ask_info">10Kg/一箱，纸包</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">物流及其他要求</h4>
                    <label style="width:150px;  font-weight:normal;" id="other_ask">10Kg/一箱，纸包</label>
                </span>
            </p>

            <p style="margin-bottom:20px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">客户信息</h4>
                    <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">公司名称：</label>
                    <label style="width:150px; font-weight:normal;" id="company_name">江苏绿港</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">联系人：</label>
                    <label style="width:150px; font-weight:normal;" id="customer_name">赵朴</label>
                </span>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">公司地址：</label>
                    <label style="width:150px; font-weight:normal;" id="customer_address">江苏绿港</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">手机号：</label>
                    <label style="width:150px; font-weight:normal;" id="customer_phone">11111111111</label>
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
				materlists: JSON.parse(localStorage.getItem("addlists")),
                submit_time:localStorage.getItem("submit_time")
			}
		},

		mounted: function() {
			this.getlists();

		},

		methods: {

			//显示添加框
			getlists: function() {
 
				
				$('#count_money').html(localStorage.count_money);
		 
				$('#count_sum').html(localStorage.count_sum);
				$('#submit_time').html(localStorage.submit_time);
				$('#company_name').html(localStorage.company_name);
				$('#customer_name').html(localStorage.customer_name);
				$('#customer_address').html(localStorage.customer_address);
				$('#customer_phone').html(localStorage.customer_phone);
				$('#ask_info').html(localStorage.ask_info);
				$('#other_ask').html(localStorage.other_ask);
				var sendData = {
					url: "index.php/sell/Sell/sell_Addlist",
					data: {
						 
					}
				};
				var re = getFaceInfo(sendData);
				//this.materlists = re.data.return_info;
				
				
			},
			AddInfo:function(){
				var sendData = {
					url: "index.php/sell/Sell/pc_add_order",
					data: {
						total_kg:localStorage.count_sum,
						total_money:localStorage.count_money,
						is_have:1,
						submit_time:localStorage.submit_time,
						company_name:localStorage.company_name,
						customer_name:localStorage.customer_name,
						customer_phone:localStorage.customer_phone,
						customer_address:localStorage.customer_address,
						ask_info:localStorage.ask_info,
						other_ask:localStorage.other_ask,
                        materlists:this.materlists //物料详情
					}
				};
				
				var re = getFaceInfo(sendData);
				this.materlists = [];
                var token = localStorage.getItem("mf_token");
                var phone = localStorage.getItem("mf_account");
                var role_id = localStorage.getItem("role_id");
                var role_name = localStorage.getItem("role_name");
                var worker_name = localStorage.getItem("worker_name");
                var group_name = localStorage.getItem("group_name");
				if (re.status == 1) {
                    // location.href =location.href;
                    layer.msg(re.msg, { time: 2000 }, function(){
                        localStorage.clear(); 
                        localStorage.setItem("mf_token", token);
                        localStorage.setItem("mf_account", phone);
                        localStorage.setItem("role_id", role_id);
                        localStorage.setItem("role_name", role_name);
                        localStorage.setItem("worker_name", worker_name);
                        localStorage.setItem("group_name", group_name);
                        window.location.href = '/#/router_main_Sell_System/sell/nocheck_list';
                    });
				} else {
					layer.msg(re.msg);
				}
			},
 
 
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

</style>
