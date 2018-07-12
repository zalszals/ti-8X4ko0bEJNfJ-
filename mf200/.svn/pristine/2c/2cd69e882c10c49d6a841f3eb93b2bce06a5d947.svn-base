<template>
	<div id="Application_Form_main__">
		<div id="Application_Form_head_">
			<div id="Application_Form_Date_">
				<div id="w_Warehouse">
					<h4 class="tit">生产领料</h4>
					<button v-on:click="getlists(1,1)" class="button or">待审核</button>
					<button v-on:click="getlists(1,3)" class="button or">待出库</button>
					<button v-on:click="getlists(1,4)" class="button or">已完成</button>
				</div>
				<div class="case">
					<div class="calendarWarp" style="">
						<input type="text" name="date" class='ECalendar input' id="ECalendar_case1" />
					</div>至
					<div class="calendarWarp" style="">
						<input type="text" name="date" class='ECalendar input' id="ECalendar_case2" />
					</div>
					<input type="text" name="date" class='ECalendar input' placeholder="请输入关键字" id="keywords" />
					<button  class="button or">查询</button>
				</div>
			</div>
		</div>
		<div id="Application_Form_main_">
		<table  align="center">
				<tr>
					<th>申请人</th>			
					<th>出库日期</th>
					<th>类别</th>
					<th>名称</th>
					<th>规格</th>
					<th>出库数量</th>
					<th>操作</th>
				</tr>
				<tr v-for="(item,index) in lists" :key="index" class="color">
					<td>{{item.apply_worker}}</td>			
					<td>{{item.add_time}}</td>
					<td>{{item.cat_id}}</td>
					<td>{{item.cat_child_name}}</td>
					<td>{{item.materiel_desc}}</td>
					<td>{{item.num}}</td>
					<template v-if="item.status=='0'">
						<template v-if="shen_worker=='2'">
							<td class="changeButton_new" style=""><button  @click="changeInfo(item.id)"  class="button or">审核</button></td>
						</template>
					</template>
					<template v-if="item.status=='1'">
						<template v-if="item.is_checked=='0'">
							<template v-if="bao_worker=='2'">
							<td class="changeButton_old" style="" ><button @click="outInfo(item.id)"  class="button or">出库</button></td>
							</template>
						</template>
					</template>
				</tr>
			</table> 
			<div id="page_new" class="paing">
				<ul class="pages" v-if="pages > 1">
					<li @click="getlists(truepage-1)">上一页</li> 
					<template  v-for="(item,index) in pages" >
				<!--	<li v-if="item==3">...</li>-->
					<li @click="getlists(item)" :key="index"  :class="item>truepage+5?'ovvvv':''" v-if="item>=truepage-5">{{item}}</li>
					</template>
					<li>...</li>
					<li @click="getlists(truepage+1)">下一页</li>	
				</ul>
			</div>
		</div>
		<div id="showDiv" style="display:none">
		<input type="text" id="reply" class="input">
		<input type="hidden" id="change_id" class="input">
		<button @click="changeType(1)" class="button or">通过</button>
		<button @click="changeType(2)" class="button or">拒绝</button>
		</div>
		<input type="hidden" id="HideStatus" value = "1" class="input">
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
				bao_worker:'',
				shen_worker:'',
				truepage:1
			};
		},
		mounted:function(){
			this.getlists(this.truepage);
			laydate.render({
				elem: '#ECalendar_case1' //指定元素
			});
			laydate.render({
				elem: '#ECalendar_case2' //指定元素
			});
	 	},

		methods:{
			getlists:function(page,status){	
				this.truepage = page;
				var start_time = $("#ECalendar_case1").val();
                var end_time = $("#ECalendar_case2").val();
                var keywords = $("#keywords").val();
				var sendData = {
					url: "index.php/depot/Deprot/pc_ck_lingliaolist",
					data: {
					    status:status,
						page:page,
                        keywords:keywords,
                        start_time:start_time,
                        end_time:end_time,
                        pc_from:2
					}
				};
				var re = getFaceInfo(sendData);
				this.lists = re.data.list;
                this.pages = re.data.pages;
                this.page = re.data.page;
				this.bao_worker = re.bao_worker;
				this.shen_worker = re.shen_worker;
				this.truepage =page;
   			},
 			changeInfo:function(id){
				var vueObj = this;
				layer.confirm('确定要通过吗？', {btn: ['确定','取消']}, function(){
					vueObj.changeType(1,id,'同意');
				});				
   			},
			changeType:function(type,id,msg){
				msg ? msg : '通过';
				var type = type;
                var reply = msg;
                var id = id;//$("#change_id").val();
				var sendData = {
					url: "index.php/depot/Deprot/ck_lingliaoinsert",
					data: {
					    type:type,
						reply:reply,
                        id:id
					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
						// location.href =location.href;
						layer.msg(re.msg, { time: 2000 }, function(){
                        	window.location.reload();
                 });
				} else {
					layer.msg(re.msg);
				}
			},
 			outInfo:function(id){
                var id = id;
				var sendData = {
					url: "index.php/depot/Deprot/ck_lingliaoinsert_end",
					data: {
                        id:id,
   
					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
						// location.href =location.href;
						layer.msg(re.msg, { time: 2000 }, function(){
                        //  window.location.reload();
                 });
				} else {
						layer.msg(re.msg, { time: 2000 }, function(){
                        // window.location.reload();
                         });
				}
			},

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

	.case {
		float: right;
		margin-top: -30px;
	}

	#Application_Form_main_ {
		margin-top: 30px;
		font-weight: 500;
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
	td {
		height: 50px;
	}

	.color {
		background-color: white;
	}

	.color:nth-child(2n) {

		background-color: #F9F9F9;
	}

	.pages li {
		padding: 5px;
/*		background-color: white;*/
		float: left;
	}
	#page_new{
		margin-top: 10px;
		margin-left: 40%;
	}

</style>