<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">供应管理</font>

            <span class="h4span-r" style="background-color:#b0c777;"><a @click="getlists()">搜 索</a></span>
            
            
            <span class="h4span-ra" >
            开始时间<input type="text" name="date" class='ECalendar selclass' id="ECalendar_case1" />
			结束时间<input type="text" name="date" class='ECalendar selclass' id="ECalendar_case2" />
            </span>

            <span class="h4span-ra">
                <input class="selclass" placeholder="请输入公司名" id="company_name"  type="text">
            </span>
 
            <span class="h4span-ra">
                <select class="selclass" name="" id="pay_status">
                    <option value="2">待收货</option>
                    <option value="3">已收货</option>
                </select>
            </span>
           
        </h4>
        </div>
        
        <div class="checklist-centera">
            <ul>			
                <li v-for="item in lists">
				<a :href="'#/router_main_Sell_System/sell/supplydetails/'+item.order_id+'/'+item.batch_id">
					<template  v-if="item.is_have==1">
							<h4>现有库存销售</h4>
					</template>
<template v-if="item.is_have==2">
							<h4>订单生产化</h4>
					</template>

<p>销售日期：{{item.add_time}}</p>
<p>客户名称：{{item.company_name}}</p>

<p v-for="item in item.orinfo">
	<span style="display:inline-block; width:220px;">商品：{{item.m_name}}</span><span>数量：{{item.m_num}} Kg</span>
</p>


<p><span style="display:inline-block; width:220px;">总量：{{item.count_num}} Kg</span><span>总额：{{item.count_money}} 元</span></p>
<p>发货日期：{{item.real_time}}</p>
</a>
<template v-if="item.pay_status==2">
						<p style="margin-top:30px;">
							<span class="divpspana" style="background-color: #f2a553;"><a @click="check_batch(item.batch_id)">确认收货</a></span>
						</p>
					</template>
</li>


</ul>

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
</div>
</template>

<script>
	export default {
		data() {
			return {

				lists: [],
				pages: [],
				get_materiel_cat: [],
				truepage:1,
				page: '',
			};
		},
		mounted: function() {
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
			});
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});
			this.getlists(this.truepage);
	 	},

		methods:{
			getlists:function(page,status){	
				this.truepage = page;
				var pay_status = $("#pay_status option:selected").attr("value");
				var company_name = $("#company_name").val();
				var start_time = $("#ECalendar_case1").val();
				var end_time = $("#ECalendar_case2").val();

				var sendData = {
					url: "index.php/sell/Sell/pc_sell_fill",
					data: {
						pay_status: pay_status,
						page: page,
						start_time: start_time,
						end_time: end_time,
						company_name: company_name,
						pc_form: 2
					}
				};
				var re = getFaceInfo(sendData);
				this.lists = re.data.list;

				this.pages = re.data.pages;
				this.page = re.data.page;
			},
			check_batch: function(batch_id) {


				var sendData = {
					url: "index.php/sell/Sell/check_batch",
					data: {
						batch_id: batch_id
					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
					// location.href =location.href;
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				} else {
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				}
			}


		}
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
/*		color: #fff;*/
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

	.checklist-centera {
		width: 100%;
		height: auto;
		overflow: hidden;
	}

	.checklist-centera li {
		width: 430px;
		height: 384px;
		float: left;
		display: inline;
		background-color: #fff;
		border-radius: 5px;
		margin-left: 32px;
		margin-top: 30px;
		border: 1px solid #e8e8e8;
		box-shadow: 0 0 10px #eee;
	}

	.checklist-centera li h4 {
		margin: 40px 40px 30px 40px;
		font-weight: bold;
		color: #333;
	}

	.checklist-centera li p {
		margin-bottom: 14px;
		color: #333;
		font-size: 16px;
		margin-left: 40px;
	}
	.divpspana {
		width: 108px;
		height: 34px;
		border-radius: 3px;
		background-color: #b0c777;
		float: left;
		display: inline;
		color: #fff;
		margin-right: 20px;
		line-height: 34px;
		text-align: center;
	}

</style>
