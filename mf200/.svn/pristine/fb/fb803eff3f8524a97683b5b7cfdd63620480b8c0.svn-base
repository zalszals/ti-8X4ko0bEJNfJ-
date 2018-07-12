<template>
  <div id="left-box">
		<!--
		<div class="tiao" style="height:70px;">
			<div class="tiao_1">
				
				<H4 style="font-weight:bold; margin-top:14px;">人事管理&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;人员管理</span></H4>
				
			</div>
			<div class="tiao_4">

				<span class="btn co1" onclick="window.location.href='/#/baseset/ppadd'" style="cursor:pointer">
					+ 添加人员
				</span>

				<span class="btn co" v-on:click="sousou" style="cursor:pointer">
					<i class="icon-search" aria-hidden="true"></i>搜索
				</span>

				<span class="newspan">
					<input type="text" name="newname" value="" class="form-control" style="width:160px; display:inline-block;" placeholder="请输入姓名" />
				</span>

				<span class="newspan">
					<select id="newroid" class="form-control" style="width:160px; display:inline-block;">
						<option value="">请选择职务</option>
						<option v-for="ritem in rolelist" v-bind:value="ritem.role_id">{{ ritem.role_name }}</option>
					</select>
				</span>

				<span class="newspan">
					<select class="form-control" style="width:160px; display:inline-block;"  id="ngrid" v-on:click="cgroup">
						<option value="">请选择部门</option>
						<option v-for="gitem in grouplist" v-bind:value="gitem.group_id">{{ gitem.group_name }}</option>
					</select>
				</span>

			</div>
		</div>
	-->

	<div class="main-left-m-top">
		<div class="main-left-m-top-left" style="width:20%;" >
			<H4 style="font-weight:bold; margin-top:14px;">人事管理</H4>
			<!--<h5 style="line-height: 20px;">可对物料进行添加、修改、保存、删除的操作，操作完成后在发布生产计划中的下拉接单中显示。</h5>-->
		</div>
		<div class="main-left-m-top-righta" style="width:80%;">

				<span class="div-a-right" onclick="window.location.href='/#/baseset/ppadd'" style="cursor:pointer">
					+ 添加人员
				</span>

				<span class="div-a-right" v-on:click="sousou" style="cursor:pointer;background-color:#b0c777; margin-right:10px;">
					<i class="icon-search" aria-hidden="true"></i> 搜索
				</span>

				<span class="newspan">
					<input type="text" name="newname" value="" class="form-control" style="width:160px; display:inline-block;" placeholder="请输入姓名" />
				</span>

				<span class="newspan">
					<select id="newroid" class="form-control" style="width:160px; display:inline-block;">
						<option value="">请选择职务</option>
						<option v-for="ritem in rolelist" v-bind:value="ritem.role_id">{{ ritem.role_name }}</option>
					</select>
				</span>

				<span class="newspan">
					<select class="form-control" style="width:160px; display:inline-block;"  id="ngrid" v-on:click="cgroup">
						<option value="">请选择部门</option>
						<option v-for="gitem in grouplist" v-bind:value="gitem.group_id">{{ gitem.group_name }}</option>
					</select>
				</span>


		</div>
   
	</div>
		
		
		<div class="zbcolor">
			<table class="table table-hover table-striped">
				<thead class="c_th">
					<tr>
						<th>部门</th>
						<th>姓名</th>
						<th>性别</th>
						<th>手机号</th>
						<th>身份证号</th>
						<th>职位</th>
						<th>上级</th>
						<th>编辑</th>
						<th>删除</th>
					</tr>
				</thead>
				<tbody class="c_td">
					<tr v-for="item in worker" v-bind:id="'perlist'+item.worker_id">
						<td>{{item.group_name}}</td>
						<td>{{item.worker_name}}</td>
						<td v-if="item.sex==1">男</td>
						<td v-else>女</td>
						<td>{{item.phone}}</td>
						<td>{{item.sfz}}</td>
						<td>{{item.role_name}}</td>
						<td>{{item.fathername}}-{{item.fathergroupname}}</td>
						<td>
							<span class="green"><A v-bind:href="'/#/baseset/ppedit?id='+item.worker_id+'&groid='+item.group_id+'&rolid='+item.role_id+'&pid='+item.pid"><i class="icon-edit" aria-hidden="true"></i></A></span>
						</td>
						<td v-on:click="del(item.worker_id)" style="cursor:pointer" >
							<span class="orange"><i class="icon-trash" aria-hidden="true"></i></span>
						</td>
					</tr>

				</tbody>
			</table>
		</div>
			

	</div>
</template>
<script>

export default {
	
  data() {
    return {
			worker:[],
			grouplist:[],
			rolelist:[],

		};
	},

	mounted:function(){
		this.getworker(),
		this.getgrouplist()
	},
  methods: {
		getworker:function(){
			var sendData = {};
      sendData.url="index.php/baseset/Worker/workerlist";
			var jsonData = {};
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
			
			this.worker = re.data.data;
			//this.all=re.data.data.length;
			//console.log(this.worker);
			//console.log(this.all);
			/*
			var sendData = {
        url: "27.221.53.90:880/index.php/baseset/Worker/workerlist",
        data: {
          token: "3f1tabe0jtumhnr56qkolh44m0",
					phone: "18114158894",
        }
			};
			$.ajax({
				url:"http://www.pc200.com/router.php",
				data:sendData,
				dataType:"Json",
				success:function(re){
					this.worker=re.data.data;
				}.bind(this)
			})
			*/

		},
		//获取部门下拉框
		getgrouplist:function(){
			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/Worker/groupselect";
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
			this.grouplist = re.data;
			/*
			sendData.url ="27.221.53.90:880/index.php/baseset/Worker/groupselect";
			jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
			jsonData.phone = "18114158894";
			sendData.data = jsonData;
			$.ajax({
				url:"http://www.pc200.com/router.php",
				data:sendData,
				dataType:"Json",
				success:function(re){
					this.grouplist=re.data;
				}.bind(this)
			})*/
		},
		//获取gid 职务下拉框
		cgroup(){
			var rolid=$("#ngrid").val();
			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/Worker/roleselect";
			jsonData.group_id=rolid;
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
      this.rolelist = re.data;
			/*
			sendData.url ="27.221.53.90:880/index.php/baseset/Worker/roleselect";
			jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
			jsonData.phone = "18114158894";
			jsonData.group_id=rolid;
			sendData.data = jsonData;

			$.ajax({
				url:"http://www.pc200.com/router.php",
				data:sendData,
				dataType:"Json",
				success:function(re){
					this.rolelist=re.data;
				}.bind(this)
			})*/
		},

		sousou(){
			var souname=$("input[name='newname']").val();
			var groaid=$("#ngrid").val();
			var nroaid=$("#newroid").val();
			//console.log(souname);console.log(groaid);console.log(nroaid);
			//console.log(nroaid);console.log(groaid);console.log(souname);
			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/Worker/workerselect";
		
			jsonData.group_id = groaid;
			jsonData.role_id = nroaid;
			//jsonData.status=1;
			jsonData.worker_name = souname;
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
			this.worker = re.data.data;
			/*
			sendData.url ="27.221.53.90:880/index.php/baseset/Worker/workerselect";
			jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
			jsonData.phone = "18114158894";
			jsonData.group_id = groaid;
			jsonData.role_id = nroaid;
			jsonData.selectinput = souname;
			sendData.data = jsonData;

			$.ajax({
				url:"http://www.pc200.com/router.php",
				data:sendData,
				dataType:"Json",
				success:function(re){
					this.worker=re.data.data;
					//console.log(re.data.data);
				}.bind(this)
			})*/
		},


    del(id) {
			layer.confirm(
				"您确定要删除这条数据吗？",
				{
				btn: ["确定", "取消"] //按钮
				},function() {
				var sendData = {};
				var jsonData = {};
				sendData.url ="index.php/baseset/Worker/workerdel";
				jsonData.worker_id = id;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
       
				if (re.status == 1) {
						// location.href =location.href;
						layer.msg(re.msg, { time: 1500 }, function(){
							$("#perlist"+id).remove();
						});
						
					} else {
						layer.msg(re.msg, { time: 1500 }, { icon: 5 });
					}
				/*
				sendData.url ="27.221.53.90:880/index.php/baseset/Worker/workerdel";
				jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
				jsonData.phone = "18114158894";
				jsonData.worker_id = id;
				sendData.data = jsonData;
				$.ajax({
					url: "http://www.pc200.com/router.php",
					data: sendData,
					dataType: "json",
					success: function(data) {
					if (data.status == 1) {
						// location.href =location.href;
						layer.msg(data.msg, { time: 1500 }, function(){
							$("#perlist"+id).remove();
						});
						
					} else {
						layer.msg(data.msg, { time: 1500 }, { icon: 5 });
					}
					}
				});*/
				}
			)
		},

  }
};
</script>

<style scoped>
.tiao {
  width: 100%;
  line-height: 25px; 
  
}
.h4span {
  font-weight: bold;
  font-size: 15px;
}
.r2 {
  padding-top: 10px;
  border-bottom: 0px solid #e1e1e1;
  padding-bottom: 10px;
}
.r1 {
  padding-top: 10px;
  border-bottom: 1px solid #e1e1e1;
  padding-bottom: 10px;
  padding-left: 9px;
}
.tiao_1 {
  float: left;
  width: 40%;
}
.table {
  background-color: white;
}
.tiao_2 {
  float: left;
  font-size: 16px;
  width: 100%;
}

.tiao_3 {
  float: left;
  font-size: 14px;
  width: 100%;
}

.tiao_4 {
  float: right;
  width: 60%;
  margin-top:16px;
}
.se {
  float: left;
  width: 96px;
  margin-right: 2%;
  font-size: 14px;
  height: 30px;
  color: #a7a7a7;
}
.newspan{ float: right; display: inline; margin-right: 10px;  margin-top:9px;}
.co {
  background-color: #b0c777;
  width: 75px;
  height: 30px;
  color: white;
  margin-right: 2%;
  float: right;
  padding-top: 4px;
}

.co1 {
  background-color: #f2a553;
  width: 101px;
  height: 30px;
  color: white;
  float: right;
  padding-top: 4px;
}


.green {
  color: green;
}

.orange {
  color: orange;
}
.zbcolor {
  height: auto;
  
  background-color: white;
  padding-bottom: 100px;
}
.table > thead > tr > th {
  border-top: none;
  line-height: 35px;
	padding-left: 2%;
	border-bottom: 1px solid #ddd
}
.table > tbody > tr > td {
  border-top: none;
  line-height: 40px;
  padding-left: 2%;
}
.c_th{color:#343434}
.c_td{color:#5c5c5c}

.main-left-m-top {
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
}
.main-left-m-top-left {
  width: 60%;
  height: auto;
  float: left;
  display: inline;
}
.main-left-m-top-righta {
  width: 40%;
  height: auto;
  float: right;
  display: inline;
}
.main-left-m-top-righta a {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-righta a:visited {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-righta a:hover {
  color: #fff;
  text-decoration: none;
}
.div-a-right {
  padding: 7px 18px;
  background-color: #f2a553;
  border-radius: 3px;
  font-size: 14px;
  font-weight: bold;
  float: right;
  display: inline;
  margin-top: 8px;
  color: #fff;
}

</style>