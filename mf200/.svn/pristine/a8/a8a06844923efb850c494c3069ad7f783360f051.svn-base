<template>
<div id="Application_Form_main_">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>职务管理</h4>
            </div>
            <div class="case">
            <select id="groupselect" @change="getrolelist(1,item.group_id)">
				<option value="1">高级管理</option>				
				<option v-for="(item,index) in group" :key="index" v-bind:value="item.group_id">{{item.group_name}}</option>				
			</select>
                <button><router-link to="/router_main_Personnel_System/Job_Mangement_Add">添加职务</router-link></button>
            </div>
        </div>
    </div>
    
    <div id="Application_Form_main_">
        <div id="Application_Form_main_top">
            <div v-for="(item,index) in role" :key="index">
                <table>
                    <tr>
                        <td class="tdimgjpg">
                            <h4>{{item.role_name}}</h4>
                        </td>
                        <td @click="edit(item.role_id)">
                        	<img src="/lib/img/public/cropmode/z-add-edit.jpg" alt="">
                        </td>
                        <td class="tdimg" @click="del(item.role_id)">
                            <img src="/lib/img/public/cropmode/add-new-del.png" alt="">
                        </td>
                    </tr>
                </table>
			</div>
        </div>
		<div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getrolelist(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
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
		padding: 20px;
		/*		margin-left: 70px;*/
	}
	#Application_Form_main_top{
		overflow: hidden;
	}
	#Application_Form_main_top div {
		margin-left: 50px;
		background-color: white;
		width: 250px;
		margin-top: 30px;
		border-style: solid;
		border-width: 2px;
		border-color: #EAEEF1;
		border-radius: 10px;
		float: left;
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
	/*

	td {
		padding: 20px;
		padding-right: 30px;
		padding-bottom: 5px;
		padding-top: 5px;
	}

	td h4 {
		margin-bottom: 10px;
	}

	.tdimg {
		position: relative;
		bottom: 30px;
		left: 80px;
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
<script>
	export default {
		data() {
			return {
				group:[],
				role:[],
				item:[],
				pages:'',
				page:'',
				selected:''
			}
		},
		mounted:function(){
            this.getrolelist(1);
        },
		methods: {
			del: function(role_id) {
				var val = layer.confirm("确认删除", {
						btn: ["确认", "取消"],
						title: [""]
					},function(){
						var sendData = {};
						var jsonData = {};
						sendData.url = "/index.php/pc/Role/del";
						jsonData.role_id = role_id;
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
			getrolelist(page){
				var sendData = {};
                var jsonData = {};
				var group_id = $('#groupselect').val();
				sendData.url = "/index.php/pc/Role/rolelist";
				jsonData.page = page;
				jsonData.group_id = group_id;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.group = re.group;
					this.role = re.role;
					this.pages = re.total.pages;
					this.page = re.total.page;
					this.selected = re.total.group_id;
				}
			},
			add(){
				window.location.href = '#/Job_Mangement_Add/';
			},
			edit(role_id){
				this.$router.push({name: 'Job_Mangement_Add_', query: { role_id:role_id }});
			},  
		}
	}

</script>
