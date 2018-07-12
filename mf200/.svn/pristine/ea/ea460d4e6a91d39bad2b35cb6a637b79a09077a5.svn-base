<template>
<div id="left-box">
	<ul class="newdivtop clear mt20">
		<li class="left w160"><h4><b>销售订单</b></h4></li>
		<li class="right w730">
			<p class="left w160"><input type="text" name="date" class="input-control w150" id="ECalendar_case1" placeholder="开始时间" /></p>
			<p class="left w160 text-right"><input type="text" name="date" class="input-control w150" id="ECalendar_case2" placeholder="结束时间" /></p>	
			<p class="left w180 text-right">
				<input type="hidden" value="5" />
				<input type="text" class="w160 input-control" id="company_name" placeholder="请输入客户名称" />
			</p>
			<p class="left w120 text-right">
				<select class="selclass" name="" id="type">
					<option value="2">所有</option>
					<option value="0" selected>进行中</option>
					<option value="1">已完成</option>
				</select>
			</p>
			<p class="h4span-r right cursor" @click="getlists()">搜 索</p>
		</li>
	</ul>
			
	<ul class="checklist-center clear">
		<li class="clear" v-for="(item,index) in lists" :key="index">
			<a :href="'/#/router_main_Sell_System/sell/s_orderdetails/'+item.order_id">
				
				<template v-if="item.is_have==1">
					<h4>现有库存销售</h4>
				</template>
				<template v-if="item.is_have==2">
					<h4>订单化生产</h4>
				</template>
				
				<p>销售日期：{{item.add_time}}</p>
				<p>公司名称：{{item.company_name}}</p>
				<p>商品：{{item.m_name}}</p>
				<p><span style="display:inline-block; width:180px;">总量：{{item.total_kg}} Kg</span> <span>总额：{{item.total_money}} 元</span></p>
				<p>备货数量：{{item.bei_sum}}</p>
				<p>已发数量：{{item.all_sum}}</p>
				
			</a>
			<template v-if="check_worker==2">
			
				<button class="right ml20 mr20 button or" @click="sellSuccess(item.order_id)">确认完成</button>
				<a class="right" :href="'#/router_main_Sell_System/sell/s_choicedetails/'+item.order_id">
					<button class="button or">申请备货</button>
				</a>
			</template>

			
		</li>
	</ul>
			<div id="page_new" class="paing">
				<ul class="pages" v-if="pages > 1">
					<li @click="getlists(truepage-1)">上一页</li> 
					<template  v-for="(item,index) in pages" >
<!--					<li v-if="item==3">...</li>-->
					<li  @click="getlists(item)" :key="index"  :class="item>truepage+5?'ovvvv':''" v-if="item>=truepage-5">{{item}}</li>
					</template>
					<li>...</li>
					<li @click="getlists(truepage+1)">下一页</li>
					
				</ul>
			</div>
</div>
</template>

<script>
	export default {
		data() {
			return {
				lists: [],
				pages: [],
				get_materiel_cat:[],
				page:'',
				check_worker:'',
				truepage:1
			}
		},
		mounted:function(){
			laydate.render({
				elem: '#ECalendar_case1' //指定元素				
			});
			laydate.render({
				elem: '#ECalendar_case2' //指定元素				
			});
			this.getlists(this.truepage)
	 	},

		methods:{
			getlists:function(page,status){	
				this.truepage = page;
				var order_type = $("#order_type option:selected").attr("value");
				var status = $("#type option:selected").attr("value");
				var company_name = $("#company_name").val();
				var start_time = $("#ECalendar_case1").val();
				var end_time = $("#ECalendar_case2").val();
 
				var sendData = {
					url: "index.php/sell/Sell/pc_sell_orderpi",
					data: {
					 order_type:order_type,
					 status:status,
					 start_time:start_time,
					 end_time:end_time,
						page:page,
                        company_name:company_name,
                        pc_form:2
					}
				};
				var re = getFaceInfo(sendData);
				this.check_worker = re.check_worker;
				this.lists = re.data.list;
                this.pages = re.data.pages;
                this.page = re.data.page;
   			},
			sellSuccess:function(order_id){
				var sendData = {
					url: "index.php/sell/Sell/sell_success",
					data: {
					 order_id:order_id,
 
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
			}
 
		}
	}

</script>

<style lang="less" scoped>
	.newdivtop {		
		height: 55px;
		border-bottom: 1px solid #d0dadc;
	}

	.h4spana {
		font-weight: normal;
		font-size: 15px;
		line-height: 16px;
	}

	.h4span-r {	
		color: #fff;		
		background-color:#b0c777;
		font-size: 16px;
		font-weight: normal;
		padding: 5px 23px;
		border-radius: 3px;
		margin-left: 20px;
	}
	.h4span-r:hover{background-color: #f2a553;}
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
		height: 34px;
		border-radius: 3px;
		border: 1px solid #d0dadc;
		color: #aaa;
		width: 100px;
		padding: 0px 10px;
	}

	.checklist-center li {
		width: 430px;
		height: 330px;
		float: left;
		display: inline;
		background-color: #fff;
		border-radius: 5px;
		margin-left: 32px;
		margin-top: 30px;
		border: 1px solid #e8e8e8;
		box-shadow: 0 0 10px #eee;
	}

	.checklist-center li h4 {
		margin: 20px 40px 30px 40px;
		font-weight: bold;
		color: #333;
	}

	.checklist-center li p {
		margin-bottom: 14px;
		color: #333;
		font-size: 16px;
		margin-left: 40px;
	}

</style>
