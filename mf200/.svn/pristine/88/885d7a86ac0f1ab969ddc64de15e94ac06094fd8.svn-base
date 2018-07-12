<template>
  <div id="left-box">
	<!--头部标题开始-->
	<div class="main-left-m-top">
			<div class="main-left-m-top-left">
				<H4 style="font-weight:bold; margin-top:14px;">人事管理&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;职务管理</span></H4>
			</div>
			<div class="main-left-m-top-right">
				<span class="btn btn-warning w130" style="cursor:pointer;" onclick='window.location.href="/#/baseset/pjadd"'>+ 添加职务</span>
				<!--<a href="#">保&nbsp;&nbsp;存</a>-->
			</div><div style="clear:both"></div>
	</div>
	<!--头部标题结束-->
	<!--列表开始-->
	<div class="list-box">
		<div class="main-left-m-center">
		<table class="table table-striped">
			<thead>
				<tr class="main-left-m-centertr">
					<th>部门名称</th>
					<th>职务名称</th>
					<th>编辑</th>
					<th>删除</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="njlist in joblist">
					<td class="new-css-ad" style="background-color: #fff;" >{{njlist.group_name}}</td>
					<td colspan="3" style="padding:0; background-color:#fff; " >
						<table v-for="(jlist, num) in njlist.child" :key="num" v-bind:id="'nwd'+jlist.role_id">

							<tr :style="{ background: num %2? '#f9f9f9':'' }" border="none">

								<td>{{jlist.role_name}}</td>
								<td><A v-bind:href="'#/baseset/pjedit?roleid='+jlist.role_id+'&rolename='+jlist.role_name"><img src="/lib/img/public/cropmode/z-add-edit.jpg" /></A></td>
								<td><span v-on:click="del(jlist.role_id)" style="cursor:pointer;"><img src="/lib/img/public/cropmode/z-add-del.jpg" /></span></td>

							</tr>

						</table>
					</td>
				</tr>

			</tbody>
		</table>
		</div>
	</div>
	<!--列表结束-->
  </div>
</template>
<script>
export default {
	data() {
		return {
			joblist:[]
		}
	},

	mounted:function(){
		this.getjoblist()
	},

	methods: {

		getjoblist:function(){
			var jsonData = {};
			var sendData = {};
			//jsonData.group_id=2;
			sendData.url="index.php/baseset/role/pc_lists";
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
       		this.joblist = re.data;
			console.log(this.joblist);
		},

		del(rid){
		layer.confirm(
				"您确定要删除这条数据吗？",
				{
				btn: ["确定", "取消"] //按钮
				},
				function() {
					var sendData = {};
					var jsonData = {};
					sendData.url ="index.php/pc/role/del";
					jsonData.role_id = rid;
					sendData.data = jsonData;
					var re = getFaceInfo(sendData);
					if (re.status == 1) {
							layer.msg(re.msg, { time: 2000 }, function(){
								$("#nwd"+rid).remove();
							});
					} else {
							layer.msg(re.msg, { time: 2000 }, { icon: 5 });
					}
					
				}
		);
	},


}		
}
</script>

<style scoped>
.main-left-m-center {
  width: 100%;
  height: auto;
  margin: 30px 0;
  background-color: #fff;
  padding: 10px 0;
  box-shadow: 0 0 2px #ddd;
}
.main-left-m-center table {
  width: 100%;
  height: auto;
}
.main-left-m-center table tr th {
  padding: 12px 26px; 
  font-weight: bold;
  color: #333;
  border-bottom: 1px solid #ddd;
  font-size: 14px;
}
.main-left-m-center table tr td {
  padding: 12px 26px;
  font-weight: normal;
  color: #333;
  font-size: 13px;
}
.main-left-m-center table tbody{
  border: none;
}
.new-css-ad {
  border-right: 1px solid #eee;
  vertical-align: middle !important;
}
table tr { background-color: #fff;}
tr td{background: none;}
table tr th,
td { width: 140px;
  text-align: center;
}
.main-left-m-centertr th{font-size: 16px;}
.main-left-m-top {
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
}
.main-left-m-top-left {
  width: 40%;
  height: auto;
  float: left;
  display: inline;
}
.main-left-m-top-right {
  width: 60%;
  height: auto;
  float: right;
  display: inline;
}
.main-left-m-top-right a {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-right a:visited {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-right a:hover {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-right span{
  padding: 6px 24px;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  float: right;
  display: inline;
  margin-top: 8px;
  margin-left: 18px;
}
.h4span {
  font-weight: bold;
  font-size: 15px;
}

</style>
