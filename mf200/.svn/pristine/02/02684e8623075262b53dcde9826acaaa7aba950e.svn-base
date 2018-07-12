<template>
<div id="Application_Form_main_">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>生产看板</h4>
            </div>
            <div class="case">
                <select id="selected" @change="getlist(1)"> 
				  <option value="1">进行中</option>
				  <option value="2">待核查</option>
				  <option value="3">已完成</option>
				</select>
            </div>
        </div>
    </div>
    
    <div id="Application_Form_main_">
        <div id="Application_Form_main_top"> 
			<h4>姓名 ： {{data.worker_name}}</h4>     
            <div v-for="(item,index) in data.info" :key="index">
                <table>
					<tr>
                        <td>
                            <p>作物:&nbsp;{{item.cat_name}}</p>
<!--                            <p v-if="item.sex == 1">性别:&nbsp;男</p>-->
                        </td>
                        <td>
<!--                            <p>上级:&nbsp;——</p>-->
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>工作内容:&nbsp;{{item.skill_name}}</p>
                        </td>
                        <td>
                            <p>工作区域:&nbsp;{{item.area_name}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>工作量:&nbsp;{{item.num}} {{item.unit}}</p>
<!--                            <p v-if="item.sex == 1">性别:&nbsp;男</p>-->
                        </td>
                        <td>
<!--                            <p>上级:&nbsp;——</p>-->
							 <p>实际完成量:&nbsp;{{item.real_num}} {{item.unit}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>工作时间:&nbsp;{{item.work_date}} {{item.require_time_1}} - {{item.require_time_2}}</p>
                        </td>
                        <td v-if="item.status == 3">
							<p>打卡时间:&nbsp;{{item.s_time}} - {{item.e_time}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
							<p v-if="item.status == 3">审核人:&nbsp;{{item.check_worker_name}} {{item.check_role_name}}</p>
                            <p v-else>发布人:&nbsp;{{item.add_worker_name}} {{item.role_name}}</p>
                        </td>
						<td v-if="item.status == 3">
							<p>审核时间:&nbsp;{{item.check_time}}</p>
						</td>
                    </tr>
					<tr v-if="item.status == 3">
						<p>评分:&nbsp;{{item.score}}</p>
					</tr>
					<tr v-if="item.status == 3">
						<p>图片记录:&nbsp;<font v-if="item.photo"><img :src="item1" v-for="item1 in item.photo" width="50"></font></p>
					</tr>
                    <tr>
                    <td>
						<button class="button or" v-if="item.status == 0" @click="purch(1,item.gd_id)">开始打卡</button>
						<button class="button or" v-if="item.status == 1" @click="purch(2,item.gd_id)">结束打卡</button>
						<button class="button or" v-if="item.status == 2">已打卡</button>
					</td>
                    </tr>
                </table>
            </div>
        </div>
		<div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getlist(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
			</ul>
		</div>
    </div>
</div>
</template>

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
		padding-bottom: 20px;
	}

	input {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		padding: 5px;
		border-radius: 5px;
		margin-right: 10px;
	}

	#Application_Form_Date_ {
		overflow: hidden;
	}

	#Application_Form_Date_ button {
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 2px;
		padding-bottom: 2px;
		color: white;
		border: 0;
		border-radius: 5px;
		background-color: #F4A356;
	}

	#w_Warehouse {
		float: left;
		font-size: 15px;
		font-weight: bold !important;
		padding-top: 30px;
		margin-left: 30px;
	}

	.case {
		float: right;
		padding-top: 30px;
	}

	td {
		padding: 10px;
		/* padding-right: 30px; */
		padding-bottom: 5px;
		padding-top: 5px;
		width: 200px;
		height: 35px;
	}

	td h4 {
		margin-bottom: 10px;
	}

	.tdimg {
		position: relative;
		bottom: 30px;
		left: 180px;
	}

	.tdimgjpg img {
		position: relative;
		bottom: 30px;
		left: 70px;
	}

	select {
		border-style: solid;
		border-width: 0.8px;
		border-color: #EAEEF1;
		padding-left: 5px;
		padding-right: 70px;
		padding-bottom: 5px;
		padding-top: 5px;
		border-radius: 5px;
		margin-right: 10px;
		margin-left: 5px;
		margin-bottom: 10px;
	}

	#delete_ {
		position: relative;
		top: 0;
		left: 0;
		width: 1893px;
		height: 1033px;
		background-color: black;
	}

	#Application_Form_main_top {
		margin-left: 90px;
	}

	#Application_Form_main_top div {
		/* padding-right: 100px; */
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
		margin: 10px;
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
		
	}

	#page_new {
		margin-top: 40px;
		position: relative;
		left: 30%;
	}

	.pages {
		overflow: hidden;
	}

	.pages li {
		border-style: solid;
		border-width: 1.8px;
		border-color: #EAEEF1;
		border-radius: 5px;
		padding: 5px;
		background-color: white;
		float: left;
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
<script>
	export default {
		data() {
			return {
               	data:[],
				item:[],
				pages:'',
				page:'',
			}
		},
        mounted:function(){
            this.getlist(1);
        },
		methods: {
            getlist(page){
                var sendData = {};
                var jsonData = {};
				sendData.url = "/index.php/pc/Work/kanban_list";
				jsonData.page = page;
				jsonData.type = $('#selected').val();
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.data = re.data;
					this.pages = re.total.pages;
					this.page = re.total.page;
                }else{
                    layer.msg(re.msg);
                }
			},
			purch(check,gd_id){
				var sendData = {};
                var jsonData = {};
				sendData.url = "/index.php/pc/Work/punch";
				jsonData.gd_id = gd_id;
				jsonData.check = check;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
                if(re.status == 1){
					layer.msg(re.msg,{time: 1500},function(){
							window.location.reload();
					});	
				}else{
					layer.msg(re.msg);
				}
			}		
		}
	}

</script>
