<template>
<div id="left-box">
	<div style=" width: 100%; height: 100%;">

		<div class="newdivtop">
			<h4 style="font-weight:bold;">
				<font style="display:inline-block; margin-top:20px;">销售下单&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;订单生产化</span></font>

				<span class="h4span-r" style="background-color:#b0c777;">返 回</span>
				<!--<router-link to="/router_main_Sell_System/sell/stocksell_look">
					<span class="h4span-r">下单预览</span>
				</router-link>-->
				<span class="h4span-r" @click="localHref()">下单预览</span>

			</h4>
		</div>
		<p style="height:50px;"></p>
		<div id="hideDiv" style="display:none">
			<ul>
				<li>
					商品<input id="keywords" value="" @keyup="showCateInfo()" class="input">
				</li>
				<select id="selectMid" @change="changeMinfo()" class="select">
					<option value="0" >请选择商品</option>
					<option v-for="item in materlists" v-bind:mid="item.m_id" v-bind:mname="item.m_name" v-bind:value="item.cat_id">{{ item.m_name }}</option>
				</select>
				<li>
					数量<input type="" id="num"  class="input">
				</li>
				<li>
					单价<input type="" id="price" v-on:blur="countMoney()"  class="input">
				</li>
				
				<li>
					金额<input type="" id="money" disabled  class="input">
				</li>
			</ul>
			<button @click="sellAdd()" class="button or">确定</button>
			<button @click="hideSell()" class="button or">取消</button>
		</div>
		<div >
		 
		<div v-for="item in addlists" id="hideDivtwo">
		商品<input disabled type="text" v-bind:value="item.cat_name" class="input">
		数量<input disabled type="text" v-bind:value="item.num" class="input">
		单价<input disabled type="text" v-bind:value="item.price" class="input">
		金额<input disabled type="text" v-bind:value="item.money" class="input">
		<button @click="delAdd(item.id)" class="button or">--</button>
		</div>
		

</div>
<div class="sell_center" id="sell_center">
	<UL>
		<LI>
			<p style="margin-bottom:20px;">
				<label style="width:40px; color:#888; font-size:15px; font-weight:normal;">商品</label>
				<label style="width:60px; margin-left:8px; display:inline-block;"><a v-on:click="showInfo()"><img src="/lib/img/public/cropmode/jiajia.jpg"	 /></a></label>
			</p>
			<p style="margin-bottom:20px;">
				<span style="width:180px; display:inline-block;">
                            <label style="width:40px; color:#888; font-size:15px; font-weight:normal;">总量</label>
                            <label id="count_sum" style="width:40px; color:#555; font-size:15px; font-weight:normal;">0 </label>Kg
                        </span>
				<span style=" display:inline-block;">
                            <label style="width:40px; color:#888; font-size:15px; font-weight:normal;">总额</label>
                            <label id="count_money" style="width:40px; color:#555; font-size:15px; font-weight:normal;">0 </label>元
                        </span>
			</p>
		</LI>
	</UL>

	<p style="margin-bottom:30px;">
		<label style="width:6px; color:red; font-size:15px; font-weight:normal;">*</label>
		<label style="width:150px; color:#888; font-size:15px; font-weight:normal;">客户要求发货日期</label>
		<input type="text" name="date" class='ECalendar' id="ECalendar_case2" />
	</p>

	<p style="margin-bottom:30px;">
		<span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">包装要求</h4>
                    <input class="form-control" id="ask_info" placeholder="请输入包装要求" type="text" style="width:460px;">
                </span>
		<span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">物流及其他要求</h4>
                    <input class="form-control" id="other_ask" placeholder="请输入客户其他要求" type="text" style="width:460px;">
                </span>
	</p>

	<p style="margin-bottom:20px;">
		<span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">客户信息</h4>
                    <label style="width:70px; color:#888; display:inline-block; font-size:15px; font-weight:normal;">公司名称</label>
                    <input class="form-control" id="company_name" placeholder="请输入公司名称" type="text" style="width:260px; display:inline-block; margin-left:10px;">
                </span>
		<span style="width:520px; display:inline-block;">
                    <label style="width:70px; color:#888; display:inline-block; font-size:15px; font-weight:normal;">联系人</label>
                    <input class="form-control" id="customer_name" placeholder="请输入客户名称" type="text" style="width:260px; display:inline-block; margin-left:10px;">
                </span>
	</p>

	<p style="margin-bottom:30px;">
		<span style="width:520px; display:inline-block;">
                    <label style="width:70px; color:#888; display:inline-block; font-size:15px; font-weight:normal;">公司地址</label>
                    <input class="form-control" id="customer_address" placeholder="请输入运送地址" type="text" style="width:260px; display:inline-block; margin-left:10px;">
                </span>
		<span style="width:520px; display:inline-block;">
                    <label style="width:70px; color:#888; display:inline-block; font-size:15px; font-weight:normal;">手机号</label>
                    <input class="form-control" id="customer_phone" placeholder="请输入联系方式" type="text" style="width:260px; display:inline-block; margin-left:10px;">
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
				materlists: [],
				addlists: [],
 
				onum_value: 0,
			}
		},

		mounted: function() {
			//this.getcat_info();

		},

		methods: {

			//显示添加框
			showInfo: function() {
				$('#hideDiv').show();
			},
			//显示物料信息
			showCateInfo: function() {
				var keywords = $("#keywords").val();
				var sendData = {
					url: "index.php/sell/Sell/get_materiel",
					data: {
						keywords: keywords,
					}
				};
				var re = getFaceInfo(sendData);
				this.materlists = re.data;
			},
			//改变数量 	
			changeMinfo: function() {
				var m_id = $("#selectMid option:selected").attr("mid");
				var m_name = $("#selectMid option:selected").attr("mname");
				var cat_id = $("#selectMid option:selected").attr("value");

				$("#keywords").val(m_name);

			},
			//计算总额
			countMoney: function() {
				var price = $('#price').val();
				var num = $('#num').val();
				if (isNaN(num)) {
					alert('数量格式错误');
					return false;
				}
				if (isNaN(price)) {
					alert('单价格式错误');
					return false;
				}
				var countM = num * price;
				$('#money').val(countM);
			},
			//添加虚拟库
			sellAdd: function() {
				var m_id = $("#selectMid option:selected").attr("mid");
				var m_name = $("#selectMid option:selected").attr("mname");
				var cat_id = $("#selectMid option:selected").attr("value");
				var num = $("#num").val();
				var price = $("#price").val();
				var money = $("#money").val();
				var sendData = {
					url: "index.php/sell/Sell/sell_Add",
					data: {
					m_id:m_id,
					cat_name:m_name,
					cat_id:cat_id,
					price:price,
					num:num,
					money:money,
					}
				};
				var re = getFaceInfo(sendData);
				this.addlists = re.data.return_info;
				$('#count_sum').html(re.data.count_sum);
				$('#count_money').html(re.data.count_money);
				
			},
			//删除虚拟库信息
			delAdd: function(id) {
 
				var sendData = {
					url: "index.php/sell/Sell/delAdd",
					data: {
					id:id,
 
					}
				};
				var re = getFaceInfo(sendData);
				this.addlists = re.data.return_info;
				$('#count_sum').html(re.data.count_sum);
				$('#count_money').html(re.data.count_money);
			},
			//隐藏添加框
			hideSell:function(){
				$('#hideDiv').hide();
			},
			localHref:function(){
				var m_id = $("#selectMid option:selected").attr("mid");
				var submit_time = $("#ECalendar_case2").val();
				var ask_info = $("#ask_info").val();
				var other_ask = $("#other_ask").val();
				var company_name = $("#company_name").val();
				var customer_name = $("#customer_name").val();
				var customer_address = $("#customer_address").val();
				var customer_phone = $("#customer_phone").val();
				var count_sum = $('#count_sum').html();
				var count_money = $('#count_money').html();
				
				

				
				if(eval(count_sum)<=0){
					alert('选择商品');
					return false;
				}
				if(!m_id || m_id==''){
					alert('选择商品');
					return false;
				}
				if(!submit_time || submit_time==''){
					alert('选择时间');
					return false;
				}
				if(!ask_info || ask_info==''){
					alert('填写包装要求');
					return false;
				}
				if(!other_ask || other_ask==''){
					alert('填写其他要求');
					return false;
				}
				if(!company_name || company_name==''){
					alert('填写公司名字');
					return false;
				}
				if(!customer_name || customer_name==''){
					alert('填写联系人');
					return false;
				}
				if(!customer_address || customer_address==''){
					alert('填写运送地址');
					return false;
				}
				if(!customer_phone || customer_phone==''){
					alert('填写联系方式');
					return false;
				}
				localStorage.count_money =count_money;
				localStorage.count_sum =count_sum;
				localStorage.submit_time =submit_time;
				localStorage.company_name =company_name;
				localStorage.customer_name =customer_name;
				localStorage.customer_phone =customer_phone;
				localStorage.customer_address =customer_address;
				localStorage.ask_info =ask_info;
				localStorage.other_ask =other_ask;
 
				window.location.href = '#/router_main_Sell_System/sell/stocksell_look';
			}
		},

	}

</script>

<style lang="less" scoped>
	.newdivtop {
		width: 100%;
		height: 70px;
		border-bottom: 1px solid #d0dadc;
	}

	.h4spana {
		font-weight: normal;
		font-size: 15px;
		line-height: 16px;
	}

	.h4span-r {
		float: right;
		margin-top: 10px;
		display: inline;
		color: #fff;
		background-color: #f2a553;
		font-size: 16px;
		font-weight: normal;
		padding: 9px 23px;
		border-radius: 3px;
		margin-left: 20px;
	}

	.h4span-ra {
		float: right;
		margin-top: 10px;
		display: inline;
		color: #fff;
		font-size: 16px;
		font-weight: normal;
		border-radius: 3px;
		margin-left: 16px;
	}

	.selclass {
		height: 36px;
		border-radius: 3px;
		border: 1px solid #d0dadc;
		color: #aaa;
		width: 160px;
		padding: 0px 10px;
	}

	.sell_center {
		width: 90%;
		margin-left: 50px;
		height: auto;
	}

	.sell_center ul li {
		width: 100%;
		height: auto;
	}

	.rightzhg {
		line-height: 50px;
		color: #f3a753;
	}
	#hideDiv{
		margin-left: 50px;
		margin-bottom: 30px;
	}
	#hideDivtwo{
		margin-left: 50px;
		margin-bottom: 30px;
	}
	select{
		margin: 0;
	}
</style>
