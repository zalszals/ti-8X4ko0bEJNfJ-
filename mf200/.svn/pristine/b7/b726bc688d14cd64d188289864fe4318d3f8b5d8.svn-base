<template>
<div id="left-box">
	<div>
		<div class="newdivtop">
			<h4 style="font-weight:bold;">
				<font style="display:inline-block; margin-top:20px;">下单列表</font>

				<span class="h4span-r" style="background-color:#b0c777;" @click="getlists()">搜 索</span>
				<span class="h4span-ra">
                <select class="selclass" name="" id="order_type">
                    <option value="5" selected="selected">果蔬</option>                    
                </select>
            </span>

				<span class="h4span-ra">
                <input class="selclass" id="company_name" placeholder="请输入客户名称" type="text">
            </span>

				<span class="h4span-ra">
                <select class="selclass" name="" id="type">
                    <option value="1" selected>待审批</option>
                    <option value="2">历史审批</option>
                </select>
            </span>

			</h4>
		</div>

		<div class="checklist-center">
			<ul class="clear">
				<li v-for="(item,index) in lists" :key="index">
					<a :href="'/#/router_main_Sell_System/sell/nocheck_details/'+item.order_id">
						<h4>{{item.have_name}}</h4>
						<p>销售日期：{{item.add_time}}</p>
						<p>公司名称：{{item.company_name}}</p>
						<p>商品：{{item.name_str}}</p>
						<p><span style="display:inline-block; width:180px;">总量：{{item.total_kg}} Kg</span> <span>总额：{{item.total_money}} 元</span></p>
						<p>发货日期：{{item.submit_time}}</p>
						<template  v-if="shen_worker==2">
						<template  v-if="item.check_status==0">
						<button class="button or">待审核</button>
						</template>
						</template>
 						<template  v-if="item.check_status==1">
						<button class="button or">已通过</button>
						</template>
						<template  v-if="item.check_status==2">
						<button class="button or">已拒绝</button>
						</template>
					</a>					
				</li>
			</ul>			
		</div>
	</div>
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
			shen_worker:'',
			truepage:1
			};
		},
		mounted:function(){
			this.getlists(this.truepage)
	 	},

		methods:{
			getlists:function(page,status){	
				this.truepage = page;
				var order_type = $("#order_type option:selected").attr("value");
				var type = $("#type option:selected").attr("value");
				var keywords = $("#company_name").val();
				
 
				var sendData = {
					url: "index.php/sell/Sell/order_listwait",
					data: {
					 order_type:order_type,
					 type:type,
						page:page,
                        keywords:keywords,
                        pc_form:2
					}
				};
				var re = getFaceInfo(sendData);
				this.lists = re.data.list;
                this.pages = re.data.pages;
                this.page = re.data.page;
                this.shen_worker = re.shen_worker;
   			},
			
 
		}
	}

</script>

<style lang="less" scoped>
	.button{
		margin-left: 35px;
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

	.checklist-center {
/*		width: 100%;*/
		/* height: auto; */
	}

	.checklist-center li {
		width: 430px;
		height: 315px;
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
		margin: 40px 40px 30px 40px;
		font-weight: bold;
		color: #333;
	}

	.checklist-center li p {
		margin-bottom: 14px;
		color: #333;
		font-size: 16px;
		margin-left: 40px;
	}
	.clear{
		height: 600px;
	}
</style>
