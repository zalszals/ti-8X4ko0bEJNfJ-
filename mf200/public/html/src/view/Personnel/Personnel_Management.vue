<template>
<div id="Application_Form_main_">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>人员管理</h4>
            </div>
            <div class="case">
                <select id="groupselect">
                    <option value="0">请选择部门</option>
                    <option v-for="(item,index) in grouplist" :key="index" v-bind:value="item.group_id">{{item.group_name}}</option>
                </select>
                <input type="text" placeholder="请输入人员姓名" id="worker_name"/>
                <button @click="getworkerlist(1)">搜索</button>
                <button><router-link to="/router_main_Personnel_System/Add_Personnel">添加人员</router-link></button>
            </div>
        </div>
    </div>
    
    <div id="Application_Form_main_">
        <div id="Application_Form_main_top">      
            <div v-for="(item,index) in workerlist" :key="index" @click="detail(item.worker_id)">
                <table>
                    <tr>
                        <td class="tdimgjpg" @click.stop="edit(item.worker_id)">
                            <h4>{{item.worker_name}}</h4><img src="/lib/img/public/cropmode/z-add-edit.jpg" alt="">
                        </td>
                        <td class="tdimg" @click.stop="del(item.worker_id)">
                             <img src="/lib/img/public/cropmode/add-new-del.png" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>工号:&nbsp;{{item.worker_no}}</p>
                        </td>
                        <td>
                            <p>职务:&nbsp;{{item.role_name}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p v-if="item.sex == 0">性别:&nbsp;女</p>
                            <p v-if="item.sex == 1">性别:&nbsp;男</p>
                        </td>
                        <td>
                            <p v-if="item.fatherid == 0">上级:&nbsp;——</p>
                            <p v-if="item.fatherid != 0">上级:&nbsp;{{item.fathergroupname}}-{{item.fathername}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>部门:&nbsp;{{item.group_name}}</p>
                        </td>
                        <td>
                            <p>工资:&nbsp;{{item.price}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>手机号:&nbsp;{{item.phone}}</p>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
       <div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getworkerlist(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
			</ul>
		</div>
    </div>
</div>
</template>

<style scoped>
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

	.pages {
		display: inline-block;
		padding: 0;
		margin: 0;
	}

	.pages li {
		display: inline;
	}

	.pages li a {
		color: black;
		float: left;
		padding: 8px 16px;
		text-decoration: none;
/*		transition: background-color .3s;*/
		border: 1px solid #ddd;
	}

	.pages li a.active {
		background-color: #4CAF50;
		color: white;
		border: 1px solid #4CAF50;
	}

	.pages li a:hover:not(.active) {
		background-color: #ddd;
	}
	/*
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
*/

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
				workerlist: [],
				grouplist: [],
				item: [],
				pages: '',
				page: '',
				val: '',
			}
		},
		mounted: function() {
			this.getworkerlist(1);
		},
		methods: {
			del: function(worker_id) {
				var val = layer.confirm("确认删除", {
					btn: ["确认", "取消"],
					title: [""]
				}, function() {
					var sendData = {};
					var jsonData = {};
					sendData.url = "/index.php/pc/Worker/workerdel";
					jsonData.worker_id = worker_id;
					sendData.data = jsonData;
					var re = getFaceInfo(sendData);
					if (re.status == 1) {
						layer.msg(re.msg, {
							time: 1000
						}, function() {
							window.location.reload();
						});
					} else {
						layer.msg(re.msg);
					}
				}, function() {
					layer.close(val);
				})
			},
			getworkerlist(page) {

				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Worker/workerlist";
				jsonData.page = page;
				jsonData.group_id = $('#groupselect').val();
				jsonData.worker_name = $('#worker_name').val();
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
					this.workerlist = re.data;
					this.grouplist = re.group;
					this.pages = re.total.pages;
					this.page = re.total.page;
				} else {
					layer.msg(re.msg);
				}
			},
			edit(worker_id) {
				this.$router.push({
					path: '/router_main_Personnel_System/Edit_Personnel',
					query: {
						worker_id: worker_id
					}
				});
			},
			detail(worker_id) {
				this.$router.push({
					path: '/router_main_Personnel_System/Details_Personnel',
					query: {
						worker_id: worker_id
					}
				});
			}
		}
	}

</script>
