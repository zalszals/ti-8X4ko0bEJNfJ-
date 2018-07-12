<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>应收款账单&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;账单详情</h4>
            </div>
            <div class="case">
			<template  v-if="info_arap.status==1">
					<button @click="check(info_arap.a_id)">审核</button>
			</template>
           
           	<button onclick="go_back()">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
    <div>
        <h5 style="color: orange">编号&nbsp;:&nbsp;&nbsp;{{info_arap.a_sn}}</h5>
        <ul>
            <li>
                <p>申请人 ： {{info_arap.worker_name}}</p>
            </li>
            <li>
                <p>申请部门 ： {{info_arap.group_name}}</p>
               <!-- <p>公司名称 ： {{info_arap.company}}</p>-->
            </li>
            <li>
                <p>总金额 ： {{info_arap.sum}}元</p>
                <p>已收金额 ： {{info_arap.pay_sum}}元</p>
            </li>
            <li>
                <p>未收金额 ：{{info_arap.diff_sum}}元</p>
                <p>来源 ： {{info_arap.origin_name}}</p>
            </li>
            <li>
              <p>申请日期 ： {{info_arap.add_time}}</p>
            </li>
        </ul>
    </div>
  <div>
  	<h5 style="color: orange">销售信息</h5>
  	<table>
  		<tr>
  			<th>商品名称</th>
  			<th>数量</th>
  			<th>单位</th>
  			<th>单价</th>
  			<th>金额</th>
  		</tr>
  		<tr v-for="item in info">
  			<td>{{item.m_name}}</td>
  			<td>{{item.num}}</td>
  			<td>{{item.unit}}</td>
  			<td>{{item.price}}</td>
  			<td>{{item.sum}}</td>
  		</tr>
  	</table>
  </div>
   <div id="add">
   	  	<h5 style="color: orange">收款记录</h5>
		<template  v-if="info_arap.status==1">
   	  	<button @click="AddInfo(info_arap.a_id)">+添加</button>
		</template>
   	  	<div v-for="item in materiel_info">
   	  		<p>{{item.add_time}}</p>
   	  		<p>{{item.way}}</p>
   	  		<p>{{item.money}}</p>
			<template  v-if="info_arap.status==1">
   	  		<a @click="EditInfo(item.cash_id)"><img src="/lib/img/public/cropmode/z-add-edit.jpg" class="cursor" /></a>
   	  		<a @click="DelInfo(item.cash_id)"><img src="/lib/img/public/cropmode/z-add-del.jpg" class="cursor" /></a>
			</template>
   	  	</div>
   </div>
   
   <div id="AddInfo" style="display:none">
		收款时间：<input type="text" name="date" class='ECalendar' id="ECalendar_case1" />
		收款方式：<input type="text" name="date" class='ECalendar' id="way" />
		收款金额：<input type="number" name="date" class='ECalendar' id="money" />
		<input type="hidden" name="date" class='ECalendar' id="a_id" />
		<button @click="AddSubmit()">提交</button>
		<button @click="HideInfo()">取消</button>
   </div>
   
      <div id="EditInfo" style="display:none">
		收款时间：<input type="text" name="date" class='ECalendar' id="ECalendar_case2" />
		收款方式：<input type="text" name="date" class='ECalendar' id="way_edit" />
		收款金额：<input type="number" name="date" class='ECalendar' id="money_edit" />
		<input type="hidden" name="date" class='ECalendar' id="cash_id" />
		<button @click="EditSubmit()">提交</button>
		<button @click="HideEditInfo()">取消</button>
   </div>
   
   
   
    </div>
</div>
</template>
<script>
	export default {
		data() {
			return {
				a_id:this.$route.params.a_id,
				info:[],
				company_name:'',				
				materiel_info:[],
				info_arap:[],
			};
		},
		mounted:function(){
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
			});
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});			
			this.getlists();
	 	},

		methods:{
			getlists:function(){
			
				var a_id = this.a_id;
 
				var sendData = {
					url: "index.php/finance/Account/account_detail",
					data: {
					 a_id:a_id,
		 
					}
				};
				var re = getFaceInfo(sendData);
				this.info = re.data;
				this.materiel_info = re.info;
				this.info_arap = re.info_arap;
		 
   			},
			AddInfo:function(a_id){
				$('#AddInfo').show();
				$('#a_id').val(a_id);
			},
			HideInfo:function(){
				$('#AddInfo').hide();
				$('#a_id').val('');
			},
			HideEditInfo:function(){
				$('#EditInfo').hide();
			},
			AddSubmit:function(){
				var a_id = $('#a_id').val();
				var way = $('#way').val();
				var money = $('#money').val();
				var add_time = $('#ECalendar_case1').val();
				if(add_time==''){
					layer.msg('请输入时间');
					return false;
				}
				if(way==''){
					layer.msg('请输入付款方式');
					return false;
				}
				if(money==''){
					layer.msg('请输入金额');
					return false;
				}else{
					if (!(/(^(([0-9]+\\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\\.[0-9]+)|([0-9]*[1-9][0-9]*))$)/.test(money))){  
						layer.msg("输入格式错误");  
						return false;
					}
				}
				
	 
				var sendData = {
					url: "index.php/finance/Account/account_add",
					data: {
						a_id:a_id,
						way:way,
						money:money,
						add_time:add_time
					}
				};
				var re = getFaceInfo(sendData);
				this.materiel_info = re.info;
				
				$('#money').val('');
				$('#way').val('');
				$('#ECalendar_case1').val('');
			},			
			DelInfo:function(cash_id){
				var  vueObj = this;
				layer.confirm('确认要删除吗？', {btn: ['确认','取消']}, function(){
					vueObj.do_del(cash_id);
				});					
			},
			do_del:function(cash_id){
				var a_id = this.a_id;
				var sendData = {
					url: "index.php/finance/Account/account_del",
					data: {
						a_id:a_id,
						cash_id:cash_id		 
					}
				};
				var re = getFaceInfo(sendData);
				this.materiel_info = re.info;
				layer.closeAll();
			},
			EditInfo:function(cash_id){
				$('#EditInfo').show();
				var sendData = {
					url: "index.php/finance/Account/account_edit_get",
					data: {
					 cash_id:cash_id
		 
					}
				};
				var re = getFaceInfo(sendData);
 
				$('#ECalendar_case2').val(re.info.add_time);
				$('#way_edit').val(re.info.way);
				$('#money_edit').val(re.info.money);
				$('#cash_id').val(re.info.cash_id);
			},
			EditSubmit:function(){
				var cash_id = $('#cash_id').val();
				var way = $('#way_edit').val();
				var money = $('#money_edit').val();
				var add_time = $('#ECalendar_case2').val();
				if(add_time==''){
					layer.msg('请输入时间');
					return false;
				}
				if(way==''){
					layer.msg('请输入付款方式');
					return false;
				}
				if(money==''){
					layer.msg('请输入金额');
					return false;
				}else{
					if (!(/(^(([0-9]+\\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\\.[0-9]+)|([0-9]*[1-9][0-9]*))$)/.test(money))){  
						layer.msg("输入格式错误");  
						return false;
					}
				}
				
				var sendData = {
					url: "index.php/finance/Account/account_edit",
					data: {
						cash_id:cash_id,
						way:way,
						money:money,
						add_time:add_time
		 
					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
						// location.href =location.href;
						layer.msg(re.msg, { time: 2000 }, function(){
                          window.location.reload();
                 });
				} else {
						layer.msg(re.msg, { time: 2000 }, function(){
                         window.location.reload();
                         });
				}
			},
			 check: function(a_id) {
				var val = layer.confirm("确认通过吗？", {
						btn: ["确认", "取消"],
						title: [""]
					},function(){
						var sendData = {};
						var jsonData = {};
						sendData.url = "index.php/finance/Account/account_check";
                        jsonData.a_id = a_id;
           
						sendData.data = jsonData;
						var re = getFaceInfo(sendData);
						if(re.status == 1){
							layer.msg(re.msg,{time: 1000},function(){
								window.location.reload();
							});					
						}else{
							layer.msg(re.msg);
						}	
					},function(){
						layer.close(val);
					})
            },
		}
	}

</script>
<style scoped>
	* {
		margin: 0;
		padding: 0;
		font-family: "微软雅黑";
		font-weight: 500;
	}

	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: -110px;
		height: 80px;
	}

	input {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		padding: 5px;
		border-radius: 5px;
		margin-right: 10px;
	}

	button {
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 2px;
		padding-bottom: 2px;
		color: white;
		border: 0;
		border-radius: 5px;
		background-color: #F4A356;
		margin-top: 10px;
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

	.case {
		float: right;
		margin-top: -30px;
	}

	select {
		margin-top: 10px;
		border-radius: 5px;
		border-style: solid;
		border-width: 0.8px;
		border-color: #EAEEF1;
		padding-left: 5px;
		padding-right: 70px;
		padding-bottom: 5px;
		padding-top: 5px;

		margin-right: 10px;
		margin-left: 5px;
		margin-bottom: 10px;
	}

	p {
		margin: 30px;
	}

	#Application_Form_main_ {
		margin-left: 90px;
		margin-top: 40px;
	}

	table {
		margin-top: 10px;
	}

	table * {
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 2px;
		padding-bottom: 2px;
		text-align: center;
		border-style: solid;
		border-width: 2px;
		border-color: #EAEEF1;
		background-color: white;
		border-radius: 10px;
	}

	th {
		padding: 20px;
	}

	td {
		padding: 20px;
	}

	#add {
		margin-top: 30px;
	}

	#add div {
						border-radius: 5px;
		border-style: solid;
		border-width: 0.8px;
		border-color: #EAEEF1;
		overflow: hidden;
		width: 600px;
		height: 50px;
		text-align: center;
		background-color: white;
		margin-top: 30px;
	}

	#add div * {
		float: left;
	}
	#add div img{
		padding-top: 15px;
		padding-left: 50px;
	}	
	#add div p{
		margin: 0;
		margin-top: 15px;
		margin-left: 70px;
	}
    #Application_Form_main_ li{
        overflow: hidden;
        
    }
    #Application_Form_main_ li p{
        float: left;
        width: 200px;
    }
</style>
<style>
	.pageButton {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		background-color: white;
		margin-left: 5px;
		margin-top: 5px;
	}

	.prePage {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		background-color: white;
		margin-left: 5px;
		margin-top: 5px;
	}

	.nextPage {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		background-color: white;
		margin-left: 5px;
		margin-top: 5px;
	}

</style> 
