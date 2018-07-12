<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">销售出库</h4>
            </div>
            <div class="case">
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
    <div>
    	<h5 class="tit">订单信息</h5>
    	<div>
    		<p>模式:</p>
    		<p>{{return_info.is_have_new}}</p>
    	</div>
    	<div>
    		<p>要求发货信息:</p>
    		<p>{{return_info.submit_time}}</p>
    	</div>
    	<div>
    		<p>包装要求:</p>
    		<p>{{return_info.ask_info}}</p>
    	</div>
    	<div>
    		<p>物流要求:</p>
    		<p>{{return_info.other_ask}}</p>
    	</div>
		
    </div>
	<div>
		<h5 class="tit">客户信息</h5>
		<div>
			<p>公司名称:</p>
			<p>{{return_info.company_name}}</p>
		</div>
		<div>
			<p>联系人:</p>
			<p>{{return_info.customer_name}}</p>
		</div>
		<div>
			<p>送货地址:</p>
			<p>{{return_info.customer_address}}</p>
		</div>
		
	</div>
    <div>
   		<h5 class="tit">物流信息</h5>
   		               <select id="sese" @change="sevalue_1(1)" class="select">
  <option value="1" id="car_" @click="sevalue_1(2)">专车运输</option>
  <option value="2" id="ququ_">快递运输</option>
</select>
	</div>
	<div id="car" v-if="sevalue==2">
	<div>
		<p>车辆型号</p>
		<p><input type="text" id="car_clxh" class="input"></p>
	</div>
		<div>
			<p>车牌号</p>
			<p><input type="text" id="car_cp" class="input"></p>
		</div>
		<div>
			<p>运输类型</p>
			<p><input type="text" id="car_yslx" class="input"></p>
		</div>
		<div>
			<p>司机姓名</p>
			<p><input type="text" id="car_sjxm" class="input"></p>
		</div>
		<div>
			<p>联系方式</p>
			<p><input type="text" id="car_lxfs" class="input"></p>
		</div>
		<div>
			<p>预计送达时间</p>
			<p><input type="text" id="submit_time_a" class="input"></p>
		</div>
		
	</div>
	<div id="ququ" v-else>
	<div>
		<p>快递公司</p>
		<p><input type="text" id="car_kdgs" class="input"></p>
	</div>
	<div>
		<p>快递单号</p>
		<p><input type="text" id="car_kddh" class="input"></p>
	</div>
	<div>
		<p>预计送达时间</p>
		<p><input type="text" name="date" class='ECalendar input' id="submit_time_b" /></p>
	</div>
	
	</div>
  <div>
  	<h5 class="tit">商品信息</h5>
  	<table>
  		<tr>
  	 
  			<th>名称</th>
  			<th>数量</th>
  			<th>单位</th>
 
  		</tr>
		
  		<tr v-for="item in return_info.check_pi">
  			<td>{{item.m_name}}</td>
  			<td>{{item.m_num}}</td>
  			<td>{{item.order_price}}</td>
 
  		</tr>
  	</table>
  </div>
  <button v-on:click="sellDeprot()" class="button or">提交</button>
  
    </div>
</div>
</template>
<script>
	export default {
		data() {
			return {
				sevalue:1,
				order_id:this.$route.params.order_id,
				batch_id:this.$route.params.batch_id,
				id:this.$route.params.id,
				return_info:[],
				type:''
			};
		},		
		mounted:function(){
			this.getlists()
	 	},

		methods:{
			sevalue_1:function(type){
				this.type = type;
				this.sevalue=document.getElementById("sese").value;
			},
			
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
				this.return_info = re.data;
				 
   			},
			sellDeprot:function(){
				var order_id = this.order_id;
				var batch_id = this.batch_id;
				var id = this.id;
				var type = this.type;
				
				var car_clxh = $('#car_clxh').val();
				var car_cp = $('#car_cp').val();
				var car_yslx = $('#car_yslx').val();
				var car_sjxm = $('#car_sjxm').val();
				var car_lxfs = $('#car_lxfs').val();
				var car_kdgs = $('#car_kdgs').val();
				var car_kddh = $('#car_kddh').val();
				var submit_time_b = $('#submit_time_b').val();
				var submit_time_a = $('#submit_time_a').val();
				
				if(type=='1'){
					var submit_time = submit_time_a;
				}else{
					var submit_time = submit_time_b;
				}
			 
 
				var sendData = {
					url: "index.php/sell/Sell/sell_deprot",
					data: {
						order_id:order_id,
						batch_id:batch_id,
						id:id,
						type:type,
						car_clxh:car_clxh,
						car_cp:car_cp,
						car_yslx:car_yslx,
						car_sjxm:car_sjxm,
						car_lxfs:car_lxfs,
						car_kdgs:car_kdgs,
						car_kddh:car_kddh,
						submit_time:submit_time,
					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
						// location.href =location.href;
						layer.msg(re.msg, { time: 2000 }, function(){
					    
     
						window.location.href="/#/router_main_Inventory_System/Out_Warehouse_buy";
			 
                 });
				} else {
						layer.msg(re.msg, { time: 2000 }, function(){
                         window.location.reload();
                         });
				}
			}
			
		}
				
	}

</script>
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
	select{
		margin: 0;
		margin-bottom: 30px;
	}
	.case {
		float: right;
		margin-top: -30px;
	}
	#Application_Form_main_ div div{
		overflow: hidden;
		margin-bottom: 30px;
	}
	#Application_Form_main_ div h5{
		margin-bottom: 30px;
	}
	#Application_Form_main_ div div p{
		width: 100px;
		float: left;
	}
	#Application_Form_main_{
		margin-left: 90px;
		margin-top: 40px;
		overflow: hidden;
	}
	table * {
		padding-top: 2px;
		padding-bottom: 2px;
		text-align: center;
	}

	th {
		background-color: white;
		width: 200px;
		height: 50px;
		border-bottom-style: solid;
		border-bottom-width: 2px;
		border-bottom-color: #EAEEF1;
	}
	.pages li {
		padding: 5px;
		background-color: white;
		float: left;
	}
	#page_new{
		margin-top: 10px;
		margin-left: 40%;
	}
</style>

