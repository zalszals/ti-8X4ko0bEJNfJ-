<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">订单列表&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;详情</span></font>

            <span class="h4span-r cursor" style="background-color:#b0c777;"><a @click="addOrderPi()">确认备货</a></span>
            <span class="h4span-r cursor" style="background-color:#b0c777;">返 回</span>
            
        </h4>
        </div>
        <p style="height:50px;"></p>
        <div  class="sell_center">
            <h4 style="color:#f3a753; margin-bottom:20px;">订单信息 
 
			</h4>
 
 
            <ul class="f16 h60" clear>
				<li class="left w250">销售日期：{{info.add_time}}</li>
				<li class="left w250">总金额：{{info.total_money}}</li>				
				<li class="left w250">已付金额：{{info.true_money}}</li>
				<li class="left w250" id="check_money" :value="info.check_money">最低付款比例：{{info.check_money}}%</li>
				<li class="left w250" id="true_remark" :value="info.true_remark">已付款比例：{{info.true_remark}}%</li>
			</ul>
 
            <p style=" width:70%; margin:20px 0; ">
                <table class="atable">	
                    <tr>
                        <th>商品</th>
                        <th>数量（Kg）</th>
                        <th>备货数量(Kg)</th>     
                    </tr>
                    <tr v-for="item in materiel_info">
                        <td>{{item.m_name}}</td>
                        <td>{{item.order_num}}</td>
                        <td>
							<input type="hidden" name="ajaxArray_cat_id" :value="item.cat_id" />
							<input type="hidden" name="ajaxArray_m_id" :value="item.m_id" />
							<input type="number" name="ajaxArray_mnum" placeholder="0" class="input-control w140" />
						</td>
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
			
			<input type="hidden" id="company_name" value="info.company_name">
			运输类型：
			<select @change="changeType()" class="input-control w160" id="type">
				<option value="2">专车运输</option>
				<option value="1">快递运输</option>
			</select> 
			<div class="mt20 mb20" id="show_2">
				车辆型号：<input class="input-control w160" type="text" id="car_clxh" value="">&nbsp;&nbsp;
				运输类型：<input class="input-control w160" type="text" id="car_yslx" value="">&nbsp;&nbsp;
				车牌号：<input class="input-control w160" type="text" id="car_cp" value="">&nbsp;&nbsp;				
				司机姓名：<input class="input-control w160" type="text" id="car_sjxm" value="">&nbsp;&nbsp;
				联系方式：<input class="input-control w160" type="text" id="car_lxfs" value="">
			</div>
			 
			<div class="mt20 mb20" id="show_1" style="display:none">
				快递公司：<input class="input-control w160"  type="text" id="car_kdgs" value="">&nbsp;&nbsp;
				快递单号：<input class="input-control w160"  type="text" id="car_kddh" value="">
			</div>
			预计到达：<input type="text" class="input-control w160"  id="ECalendar_case2">
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
				company_name:'',				
				materiel_info:[],
				check_materiel:''
			};
		},
		mounted:function(){	
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});		
			this.getlists();
	 	},

		methods:{
			getlists:function(){
			
				var order_id = this.order_id;
 
				var sendData = {
					url: "index.php/sell/Sell/sell_choice",
					data: {
					 order_id:order_id,
		 
					}
				};
				var re = getFaceInfo(sendData);
				this.info = re.data;
				this.check_materiel = re.check_materiel;
				
			 
				this.materiel_info = this.info.order_detail;
				this.company_name = this.info.company_name;
				this.order_id = this.info.order_id;
   			},
			addOrderPi:function(){			
				var type = $("#type option:selected").attr("value");
				
				var car_clxh = $('#car_clxh').val();
				var car_yslx = $('#car_yslx').val();
				var car_cp = $('#car_cp').val();
				var car_sjxm = $('#car_sjxm').val();
				var car_lxfs = $('#car_lxfs').val();
				
				var car_kdgs = $('#car_kdgs').val();
				var car_kddh = $('#car_kddh').val();
				var submit_time = $('#ECalendar_case2').val();
				
				var check_money = $('#check_money').attr("value");
				var true_remark = $('#true_remark').attr("value")
				
		 
				if(parseFloat(check_money) > parseFloat(true_remark)){
					alert('最低付款比例不符合要求');
					return false;
				} 
				
				
				
				
				if(type=='2'){
					if(car_clxh==''){
						alert('请填写车辆型号');
						return false;
					}
					if(car_yslx==''){
						alert('请填写运输类型');
						return false;
					}
					if(car_cp==''){
						alert('请填写车牌号');
						return false;
					}
					if(car_sjxm==''){
						alert('请填写司机姓名');
						return false;
					}
					if(car_lxfs==''){
						alert('请填写联系方式');
						return false;
					}
				}else{
					if(car_kdgs==''){
						alert('请填写快递公司');
						return false;
					}
					if(car_kddh==''){
						alert('请填写快递单号');
						return false;
					}
				}
				if(submit_time==''){
					alert('请填写预计到达时间');
					return false;
				}
			
				
			
				var company_name = this.company_name;
				var order_id = this.order_id;
			 
				var check_materiel = 1;
				var info_str = {};
				info_str = getAjaxData();
				var check_materiel = this.check_materiel;
				// return;
				var sendData = {
					url: "index.php/sell/Sell/pc_add_order_pi",
					data: {
						check_materiel:check_materiel,
						type:type,
						car_clxh:car_clxh,
						car_cp:car_cp,
						car_yslx:car_yslx,
						car_sjxm:car_sjxm,
						car_lxfs:car_lxfs,
						car_kdgs:car_kdgs,
						car_kddh:car_kddh,
						order_id:order_id,
						submit_time:submit_time,
						company_name:company_name,
					 
						info_str:info_str   //获取拼接字符串[[分类id,物料id,数量],[分类id,物料id,数量]]
		 
					}
				};
				var re = getFaceInfo(sendData);
				if(re.status==1){
					layer.msg(re.msg,{time:1500},function(){
						location.href = '/#/router_main_Sell_System/sell/s_orderlist';
					})
				}else{
					layer.msg(re.msg);
				}
			},
			changeType:function(){
				var type=$("#type option:selected").attr("value");
				if(type=='2'){
					$('#show_2').show();
					$('#show_1').hide();
				}else{
					$('#show_1').show();
					$('#show_2').hide();
				}
				
			}
 
	 

		}
	}

</script>

<style lang="less" scoped>
.w250{width:250px !important;}
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
