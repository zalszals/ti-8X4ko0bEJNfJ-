<template>
<div id="Application_Form_main__">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4 class="tit">应收账款单</h4>
			</div>
			<div class="case">
				<select class="selclass select" name="" id="type">
                    <option value="1" selected="selected">应收</option>
                    <option value="2">已收</option>
                </select>
				<div class="calendarWarp" style="">
					<input type="text" name="date" class='ECalendar input' id="ECalendar_case1" placeholder="请输入" />
				</div>至
				<div class="calendarWarp" style="">
					<input type="text" name="date" class='ECalendar input' id="ECalendar_case2" />
				</div>
				<input type="text" class="ECalendar calendarWarp input" id="company" placeholder="请输入公司名称" />
				<button @click="getlists(1)" class="button or">搜索</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main_">
	
		<div id="Application_Form_main_top">
			<div v-for="item in get_materiel_cat">
				<a :href="'#/router_main_Finance_System/Accounts_Receivable_Details/'+item.a_id"><table>
					<tr>
						<td>
							<h3>编号&nbsp;:&nbsp;&nbsp;{{item.a_sn}}</h3>
						</td>
					</tr>
					<tr>
						<td>
							<p>申请人&nbsp;：&nbsp;&nbsp;{{item.worker_name}}</p>
						</td>
					</tr>
					<tr>
						<td>
							<p>申请部门&nbsp;:&nbsp;&nbsp;{{item.group_name}}</p>
						</td>
					</tr>
					<!--<tr>
						<td>
							<p>公司名称&nbsp;:&nbsp;&nbsp;{{item.company}}</p>
						</td>
					</tr>-->
					<tr>
						<td>
							<p>总金额&nbsp;:&nbsp;&nbsp;{{item.sum}}元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;已收金额&nbsp;:&nbsp;&nbsp;{{item.pay_sum}}元</p>
						</td>
					</tr>
					<tr>
						<td>
							<p>未收金额&nbsp;:&nbsp;&nbsp;{{item.diff_sum}}元</p>
						</td>
					</tr>
					<tr>
						<td>
							<p>来源&nbsp;:&nbsp;&nbsp;{{item.origin_name}}</p>
						</td>
					</tr>
					<tr>
						<td>
							<p>申请日期&nbsp;:&nbsp;&nbsp;{{item.add_time}}</p>
						</td>
					</tr>
				</table>
				</a>
			</div>			
		</div>
		<div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getlists(truepage-1)" class="wi">上一页</li>
				<template v-for="(item,index) in 10">
					<template v-if="Math.floor((truepage-1)/10)*10+item <= pages">					
					<li :key="index" @click="getlists(Math.floor((truepage-1)/10)*10+item)" :class="truepage%10 == item || truepage%10 == 0 && item == 10 ? 'or' : 'wi'" >
					{{Math.floor((truepage-1)/10)*10+item}}
					</li>						
					</template>						
				</template>
				<li @click="getlists(truepage+1)" class="wi">下一页</li>
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
				pages: 1,
            	get_materiel_cat:[],
            	page:'',
				truepage: 1,
				showNum:1
			};
		},
		mounted: function() {			
			this.getlists(this.truepage);
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
			});				
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});
	 	},

		methods:{ 
			getlists:function(page){
				page = page > this.pages ? this.pages : page;
				page = page < 1 ? 1 : page; 
				this.truepage = page;				
				// alert(this.truepage);				
				var type = $("#type option:selected").attr("value");		 
			 
				var start_time = $("#ECalendar_case1").val();
				var end_time = $("#ECalendar_case2").val();
				var company = $("#company").val();
 
				var sendData = {
					url: "index.php/finance/Account/pc_account",
					data: {					
						style:2,
						type:type,
						status:status,
						start:start_time,
						end:end_time,
						page:page,
						company:company,
						pc_form:2
					}
				};
				var re = getFaceInfo(sendData);
				this.get_materiel_cat = re.data.list;
				this.pages = re.data.pages;
                this.page = re.data.page;
   			},
			aaa:function(){
				document.write('sf');
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

	#Application_Form_Date_ {}
	#w_Warehouse {
		/*        float: left;*/
		font-size: 15px;
		font-weight: bold !important;
		padding-top: 30px;
		margin-left: 30px;
		margin-right: 300px;
	}

	.case {
		float: right;
		margin-top: -30px;
	}

	td {
		padding: 20px;
		padding-right: 30px;
		padding-bottom: 5px;
		padding-top: 5px;
	}

	p {
		margin-top: 6px;
	}

	#Application_Form_main_top {
		margin-left: 90px;
	}

	#Application_Form_main_bottom {
		margin-left: 90px;
	}

	#Application_Form_main_top table {
		margin: 20px;
	}

	#Application_Form_main_bottom table {
		margin: 20px;
	}

	#Application_Form_main_top {
		overflow: hidden;
	}

	#Application_Form_main_bottom {
		overflow: hidden;
	}

	#Application_Form_main_top div {
		float: left;
		border-style: solid;
		border-width: 2px;
		border-color: #EAEEF1;
		border-radius: 10px;
		background-color: white;
		margin: 35px;
	}

	#Application_Form_main_bottom div {
		float: left;
		border-style: solid;
		border-width: 2px;
		border-color: #EAEEF1;
		background-color: white;
		border-radius: 10px;
		margin: 35px;
	}

	.Application_Form_main_but {
		border: 0;
		background-color: #B3C57C;
		padding-left: 15px;
		padding-right: 15px;
		padding-top: 2px;
		padding-bottom: 2px;
		color: white;
		border-radius: 5px;
	}

	#page {
		position: relative;
		left: 600px;
	}

</style>