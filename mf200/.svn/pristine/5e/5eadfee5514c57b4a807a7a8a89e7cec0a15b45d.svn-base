<template>
	<div id="left-box">	

		<div class="newdivtop">
			<h4 style="font-weight:bold;">
				<font style="display:inline-block; margin-top:20px;">销售下单&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;现有库存销售</span></font>
				<span class="h4span-r cursor" style="background-color:#b0c777;">返 回</span>
				<span class="h4span-r cursor" @click="localHref()">下单预览</span>
			</h4>
		</div>
		<p class="mt30">商品<img class="ml20 cursor" src="/lib/img/public/cropmode/jiajia.jpg" @click="showInfo()"/></p>
		<ul class="w200 mt40 ml50" id="hideDiv" style="display:none;">
			<li class="form-group h40">					
				<label class="">商品</label>
				<input class="form-control rt30" id="keywords" list="goods" @keyup="showCateInfo()" @change="selectT($event.target)" />
				<datalist id="goods">						
					<option class="data_list_option" v-for="(item,index) in materlists" :key="index" :value="item.m_name" :data="item.m_id" :catId="item.cat_id"/>						
				</datalist>	
				<input type="hidden" id="m_id" value="" />
				<input type="hidden" id="cat_id" value="" />
			</li>				
			<li class="form-group h40">					
				<label class="">数量</label>
				<input class="form-control rt30" type="text" id="num" @keyup="countMoney()">
			</li>
			<li class="form-group h40">
				<label class="">单价</label>
				<input class="form-control rt30" type="text" id="price" @keyup="countMoney()">
			</li>
			
			<li class="form-group h40">
				<label class="">金额</label>
				<input class="form-control rt30" type="text" id="money" disabled>
			</li>
			<li class="text-right mb20">
				<button @click="sellAdd()" class="button or">确定</button>&nbsp;&nbsp;&nbsp;&nbsp;
				<button @click="hideSell()" class="button or">取消</button>
			</li>
		</ul>
		
		<ul class="w1100 ml50 h50" v-for="(item,index) in addlists" :key="index">
			<li class="left w260">
				<label>商品</label>
				<input class="input-control w200" disabled type="text" :value="item.m_name" />
			</li>
			<li class="left w260">
				<label>数量</label>
				<input class="input-control w200" disabled type="text" :value="item.num" />
			</li>
			<li class="left w260">	
				<label>单价</label>
				<input class="input-control w200" disabled type="text" :value="item.price" />
			</li>	
			<li class="left w260">	
				<label>金额</label>
				<input class="input-control w200" disabled type="text" :value="item.money">
			</li>
			<li class="left w60">
				<button @click="delAdd(index)" class="button or">×</button>
			</li>
		</ul>
		
		<p class="mt30">总量 {{sum_num}} Kg，总额 {{sum_m}} 元</p>
		
	
		<div class="sell_center mt40 mb20" id="sell_center">
			<p style="margin-bottom:30px;">
				<label style="width:6px; color:red; font-size:15px; font-weight:normal;">*</label>
				<label style="width:150px; color:#888; font-size:15px; font-weight:normal;">客户要求发货日期</label>
				<input type="text" name="date" class="ECalendar input-control w150" id="ECalendar_case2" />
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
</template>

<script>
	export default {

		data() {
			return {
				materlists: [],
				addlists: [],
				sum_num:0,
				sum_m:0,
				onum_value: 0,
			}
		},

		mounted: function() {
			//this.getcat_info();
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});
			
		},

		methods: {
			//显示添加框
			showInfo: function() {
				$('#hideDiv').show();
				$('#jiahao').hide();
			},
			selectT: function(){
				var input_select = $("#keywords").val();  
				var option_length = $(".data_list_option").length;  
				var option_id = ''; 
				var cat_id = ''; 
				
				for(var i=0;i<option_length;i++){  
					var option_value = $(".data_list_option").eq(i).attr('value');  
					if(input_select == option_value){  
						option_id = $(".data_list_option").eq(i).attr('data');  
						cat_id =  $(".data_list_option").eq(i).attr('catId');
						break;  
					}  
				}  
				$('#m_id').val(option_id);
				$('#cat_id').val(cat_id);
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
				if(!price || !num){
					return false;
				}
				if (isNaN(num)) {
					layer.msg('数量格式错误');
					return false;
				}
				if (isNaN(price)) {
					layer.msg('单价格式错误');
					return false;
				}
				var countM = num * price;
				$('#money').val(countM.toFixed(2));
			},
			//添加虚拟库
			sellAdd: function() {	
						 
				var json = {};
			 
				json.m_id = $("#m_id").val();
				json.m_name = $("#keywords").val();
				json.cat_id = $("#cat_id").val();
				json.num = $("#num").val();
				json.price = $("#price").val();
				json.money = $("#money").val();
				if(!json.m_id || !json.num || !json.price){					
					layer.msg('商品信息填写不全或者商品不存在');
					return;
				}
				var l = this.addlists.push(json);
				var sum_m = 0;
				var sum_num = 0;
				$(this.addlists).each(function(){
					sum_m += parseFloat(this.money);
					sum_num += parseFloat(this.num);
				});
				this.sum_m = sum_m.toFixed(2);
				this.sum_num = sum_num;
				// console.log(this.addlists[0]);
				/*
 
				
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
	
		 
				
				
				*/
				//$('#count_sum').html(re.data.count_sum);
				//$('#count_money').html(re.data.count_money);
				
			},
			//删除虚拟库信息
			delAdd: function(id) {
				this.addlists.splice(id,1);return;
				var sendData = {
					url: "index.php/sell/Sell/delAdd",
					data: {
						id:id
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
				// var m_id = $("#selectMid option:selected").attr("mid");
				var submit_time = $("#ECalendar_case2").val();
				var ask_info = $("#ask_info").val();
				var other_ask = $("#other_ask").val();
				var company_name = $("#company_name").val();
				var customer_name = $("#customer_name").val();
				var customer_address = $("#customer_address").val();
				var customer_phone = $("#customer_phone").val();
				var count_sum = this.sum_num;
				var count_money = this.sum_m;
				
				

				
				if(eval(count_sum)<=0){
					layer.msg('选择商品1');					
					return false;
				}
				/*
				if(!m_id || m_id==''){
					layer.msg('选择商品2');					
					return false;
				}*/
				if(!submit_time || submit_time==''){
					layer.msg('选择时间');					
					return false;					
				}
				if(!ask_info || ask_info==''){					
					layer.msg('填写包装要求');	
					return false;
				}
				if(!other_ask || other_ask==''){					
					layer.msg('填写其他要求');	
					return false;
				}
				if(!company_name || company_name==''){					
					layer.msg('填写公司名字');	
					return false;
				}
				if(!customer_name || customer_name==''){					
					layer.msg('填写联系人');	
					return false;
				}
				if(!customer_address || customer_address==''){
					layer.msg('填写运送地址');
					return false;
				}
				if(!customer_phone || customer_phone==''){
					layer.msg('填写联系方式');
					return false;
				}
				localStorage.count_money      = count_money;
				localStorage.count_sum        = count_sum;
				localStorage.submit_time      = submit_time;
				localStorage.company_name     = company_name;
				localStorage.customer_name    = customer_name;
				localStorage.customer_phone   = customer_phone;
				localStorage.customer_address = customer_address;
				localStorage.ask_info         = ask_info;
				localStorage.other_ask        = other_ask;
				localStorage.setItem("addlists",JSON.stringify(this.addlists));				
				window.location.href = '#/router_main_Sell_System/sell/stocksell_look';
			}
		},

	}

</script>

<style lang="less" scoped>
	.rt30{
		position: relative;top:-30px;left:40px;
	}
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

</style>
