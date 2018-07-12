<template>
  <div id="left-box">
		<div class="main-left-m-top">
			<div class="main-left-m-top-left">
				<H4 style="font-weight:bold; margin-top:14px;">人事管理&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;人员管理</span>&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;编辑人员</span></H4>
			</div>
			<div class="main-left-m-top-right">
				<span style="cursor:pointer; background-color:#b0c777;" v-on:click="gohistory()">返 回</span>
				<span style="cursor:pointer" v-on:click="dosave()">保 存</span>
			</div>
			<div style="clear:both"></div>
		</div>


		<div style=" height:30px; border-top:1px solid #c5c5c5;"></div>
		<div class="zbcolor" v-for="infoitem in infolist" v-if="infoitem.worker_id==getid">
			<form class="" role="form">
				<div class="biaoti">1、人员基本信息</div>
				<div class="biaoti_1">
					<label class="thenewclass" for="">姓名</label>
					<span class="row-box">
						<input type="text" id="thename"  class="form-control" style="display:inline-block; width:260px;" v-bind:value="infoitem.worker_name">
					</span>
				</div>
				<div class="biaoti_1">
					<label class="thenewclass" for="">姓别</label>
					
					<span class="boy">
						<input type="radio" name="sex" :checked="infoitem.sex==1? 'checked':''" > 男
					</span>
					<span class="girl">
						<input type="radio" name="sex" :checked="infoitem.sex==0?'checked':''" > 女
					</span>
				</div>
				<div class="biaoti_1">
					<label class="thenewclass">身份证号</label>
					<span class="row-box">
						<input type="text" id="thesfz"  class="form-control" style="display:inline-block; width:260px;" v-bind:value="infoitem.sfz">
					</span>
				</div>
				<div class="biaoti_1">
					<label class="thenewclass">手机号</label>
					<span class="row-box">
						<input type="text" id="thephone" class="form-control" style="display:inline-block; width:260px;" v-bind:value="infoitem.phone">

					</span>
					<span class="biaoti_3">
						<strong>
							<span class="bell">
								<i class="icon-bell" aria-hidden="true"></i> 手机号做为登陆账号使用</span>
						</strong>
					</span>
				</div>
				<div class="biaoti">2、部门信息</div>
			
				<ul class="h45">
					<li class="left" >
						<span class="thenewclass">部门</span>
						<span class="row-box">
							<select id="thegro" v-on:change="choosegroup($event.target)" class="form-control" style="width:200px;">
							<option style="background-color:#e9e9e9;" v-bind:value="infoitem.group_id==groid">{{infoitem.group_name}}</option>	
							<option v-for="item in grouplist" v-bind:value="item.group_id">{{ item.group_name }}</option>
							</select>
						</span>
					</li>

					<li class="left">
						<span class="thenewclass">职位</span>
						<span class="row-box">
							<select id="therole" name="workerroleida" class="form-control" style="width:200px;">
								<option style="background-color:#e9e9e9;" v-bind:value="infoitem.role_id==rolid">{{infoitem.role_name}}</option>
								<option v-for="roleitem in rolelist" v-bind:value="roleitem.role_id" >{{roleitem.role_name}}</option>
							</select>
						</span>
					</li>	


					<li class="left">
						<span class="left text-right w100 fc-4 mt10">上级</span>
						<span class="row-box">
							<select id="workerpidid" name="workerroleidb"  class="form-control" style="width:200px;">
								<option style="background-color:#e9e9e9;" v-bind:value="infoitem.pid==pid">{{infoitem.fathername}}-{{infoitem.fathergroupname}}</option>
								<option v-for="piditem in pidlist" v-bind:value="piditem.worker_id==getid">{{piditem.role_name}}-{{piditem.worker_name}}</option>
							</select>
						</span>
					</li>	

				</ul>
			</form>
			<div style="height:340px;background-color:#fff;"></div>
		</div>

	</div>
</template>
<script>
  export default {
	  data(){
		  return{
			  infolist:[],
			  getid:"",groid:"",rolid:"",pid:"",
			  groupid:"",
			  grouplist:[],
			  pidlist:[],
			  rolelist:[]
		  }
	  },
	  mounted:function(){
		this.getgrouplist(),
		this.getinfolist(),
		this.getid=this.$route.query.id,
		this.groid=this.$route.query.groid,
		this.rolid=this.$route.query.rolid,
		this.pid=this.$route.query.pid
	  },
	  methods:{
		
		getinfolist:function(){
			var sendData = {
       		 	url: "index.php/baseset/Worker/workerlist",
				data: {
				page:this.$route.query.page,
				}
			};
			var re = getFaceInfo(sendData);
        	this.infolist = re.data.data;
			/*
			var sendData = {
       		 	url: "27.221.53.90:880/index.php/baseset/Worker/workerlist",
				data: {
				token: "3f1tabe0jtumhnr56qkolh44m0",
				phone: "18114158894",
				page:this.$route.query.page,
				}
			};
			$.ajax({
				url:"http://www.pc200.com/router.php",
				data:sendData,
				dataType:"Json",
				success:function(re){
					this.infolist=re.data.data;
				}.bind(this)
			})*/
		},


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

			
		choosegroup(obj){
			var that=this;
			this.groupid=obj.value;

			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/Worker/roleselect";
			jsonData.group_id=this.groupid;
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
			that.rolelist=re.data;
			/*
			if(re.status==1){
						var abc=re.data;
						for(var $i=0;$i<abc.length;$i++){
							that.rolelist.push(abc[$i]);
						}		
			}else{
						layer.msg(re.msg);
			}
			*/
			/*
			sendData.url ="27.221.53.90:880/index.php/baseset/Worker/roleselect";
			jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
			jsonData.phone = "18114158894";
			jsonData.group_id=this.groupid;
			sendData.data = jsonData;
			$.ajax({
				url:"http://www.pc200.com/router.php",
				data:sendData,
				dataType:"Json",
				success:function(re){
					if(re.status==1){
						var abc=re.data;
						for(var $i=0;$i<abc.length;$i++){
							that.rolelist.push(abc[$i]);
						}		
					}else{
						layer.msg(re.msg);
					}
				}
			});*/
			if(obj.value){
				
				var vm=this;
				var sendData = {};
				var jsonData = {};
				sendData.url ="index.php/baseset/Worker/groupworker";
				jsonData.group_id=this.groupid;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				vm.pidlist=re.data;
				/*
        		if(re.status==1){
							var abc=re.data;
							for(var $i=0;$i<abc.length;$i++){
								vm.pidlist.push(abc[$i]);
							}		
				}else{
							layer.msg(re.msg);
				}
				*/

				
				/*
				sendData.url ="27.221.53.90:880/index.php/baseset/Worker/groupworker";
				jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
				jsonData.phone = "18114158894";
				jsonData.group_id=this.groupid;
				sendData.data = jsonData;
				$.ajax({
					url:"http://www.pc200.com/router.php",
					data:sendData,
					dataType:"Json",
					success:function(re){
						if(re.status==1){
							var abc=re.data;
							for(var $i=0;$i<abc.length;$i++){
								vm.pidlist.push(abc[$i]);
							}		
						}else{
							layer.msg(re.msg);
						}
					}
				});*/
			}else{
				layer.msg("错误");
			}

		},
		
		dosave(){
			var then=$("#thename").val();
			if(then==''){
				layer.msg("请输入姓名");return;
			}
			var wsex=$("input[name='sex']").val();
			if(wsex===''){
				layer.msg("请选择性别");return;
			}
			var thesf=$("#thesfz").val();
			if(thesf==''){
				layer.msg("请输入身份证");return;
			}
			var theph=$("#thephone").val();
			if(theph==''){
				layer.msg("请输入手机号");return;
			}
			var theg=$("#thegro").val();
			if(theg==''){
				layer.msg("请选择部门");return;
			}
			var thero=$("#therole").val();
			if(thero==''){
				layer.msg("请选择职务");return;
			}
			var workerpid=$("#workerpidid").val();

			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/Worker/workeredit_do";
			
			jsonData.worker_id=this.getid;
			jsonData.worker_name=then;
			jsonData.sex=wsex;
			jsonData.sfz=thesf;
			jsonData.group_id=theg;
			jsonData.role_id=thero;
			jsonData.pid=workerpid;

			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
			if(re.status==1){
				layer.msg(re.msg,{time:2000},function(){
					window.location.href="#/baseset/perlist";
				});
			}else{
				layer.msg(re.msg);
			}
		
		},

		gohistory(){
			this.$router.back(-1);
		},

	  }
  }
</script>

<style scoped>
	
	.tiao {
		width: 100%;
		
		line-height: 20px;
		
	}
	.boy{color:#B3C97A;}
	.girl{color:#F2A553;margin-left: 7%}
	.tiao_1 {
		float: left;
		width: 60%
	}

	.tiao_2 {
		float: left;
		width: 100%;
		font-size: 16px
	}

	.tiao_3 {
		float: left;
		width: 100%;
		font-size: 14px;
		line-height: 30px
	}

	.tiao_4 {
		float: right;
		width: 40%;
	}

	.s1 {
		border-bottom: 1px solid #C5C5C5;
		float: left;
		width: 100%;
		height: 20px;
	}

	.bc {
		background-color: #F2A553;
		width: 80px;
		height: 30px;
		color: white;
		float: right;
		margin-right: 3%;
	}
	.btn{padding: 4px}
	.fh {
		background-color: #B0C777;
		width: 80px;
		height: 30px;
		color: white;
		
		float: right;
	}

	.zbcolor {
		width: 100%;
		background-color: #fff;
		
		box-shadow: 0 0 2px #ddd;
	}
	.biaoti {
		border: 0px solid red;
		width: 100%;
		font-size: 15px;
		font-weight: 600;
		padding: 35px 0px 20px 45px;
		color: #3C3C3C;
		
	}
	.biaoti_1{width: 100%;line-height: 40px;margin-top: 25px}
	.biaoti_2{width: 20%;padding-left:12%;line-height: 40px;font-size:15px;}
	.biaoti_3{width: 80%;line-height: 25px;}
	.biaoti_4{width: 100%;line-height: 25px;}
	.biaoti_5{width: 100%;line-height: 40px;}
	input[type='radio']{width:2%}
	input{width: 15%}
	.bell {
		font-size: 12px;
		color: #F2A553;
		padding-top: 5px
	}
	select{width:10%}
	.ml350{margin-left:350px;}
.w80{width:80px;}
.border-bottom{border-bottom:1px solid #d0dadc;}	
.from-box{padding:50px;border-radius: 2px;box-shadow: 1px 1px 50px #eaeaea; background-color: #fff;}

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
  margin-left: 10px;
}
.h4span {
  font-weight: bold;
  font-size: 15px;
}
.row-box{margin-left: 15px; display:inline-block;}
.thenewclass{ width:160px; text-align:right; display:inline-block;}
</style>
