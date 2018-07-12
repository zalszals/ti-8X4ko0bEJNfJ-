<template>
	<div id="left-box">
	    <div class="main-left-m-top">
		    <div class="main-left-m-top-left">
			    <H4 style="font-weight:bold; margin-top:14px;">人事管理&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;人员管理</span>&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;添加人员</span></H4>
			   
		    </div>
		    <div class="main-left-m-top-right">
			    <span style="background-color:#b0c777;cursor:pointer" v-on:click="gohistory()">返 回</span>
			    <span v-on:click="saveworkeradd" style="cursor:pointer">完 成</span>
		    </div>
        <div style="clear:both"></div>
	    </div>
		<!-- 表单 开始 -->
		<ul class="from-box mt30 bgc-1" style="padding-bottom:200px;">
			<li class="h45 fc-3"><b>1、 人员基本信息</b></li>
			<li>
				<span class="thenewclass">姓名</span>
				<span class="row-box"><input type="text" class="form-control w260" name="workername" placeholder="请输入姓名"/></span>
			</li>
			<li class="h45 mt45 clear">
				<span class="thenewclass">性别</span>
				<ul class="row-box" >
					<li>
							<label style="margin-left:8px;">
								<input type="radio" name="workersex"  value="1" checked> 男
							</label>
					
						
							<label style="margin-left:30px;">
								<input type="radio" name="workersex" value="0"> 女
							</label>	
					</li>			
				</ul>
			<li class="h45 mt45 clear">
				<span class="thenewclass">身份证号</span>
				<span class="row-box"><input type="text" class="form-control w260" name="workersfz" placeholder="请输入身份证号"/></span>
			</li>
			<li class="h45 mt45 clear">
				<span class="thenewclass">手机号</span>
				<span class="row-box"><input type="text" class="form-control w260" name="workerphone" placeholder="请输入手机号"/></span>
			</li>
			<li class="h45 mt45 fc-3"><b>2、 部门信息</b></li>
			<li>
				<ul class="h45">

					<li class="left" >
						<p class="thenewclass">部门</p>
						<p class="row-box">
							<select id="workergroupid" v-on:change="choosegroup($event.target)" class="form-control w200">
							<option value="">请选择部门</option>
							<option v-for="item in grouplist" v-bind:value="item.group_id">{{ item.group_name }}</option>
							</select>
						</p>
					</li>

					<li class="left">
						<p class="thenewclass">职位</p>
						<p class="row-box">
							<select id="workerroleid" name="workerroleida"  class="form-control w200" >
								<option>请选择职位</option>
								<option v-for="roleitem in rolelist" v-bind:value="roleitem.role_id">{{roleitem.role_name}}</option>
							</select>

						</p>
					</li>	


					<li class="left">
						<p class="thenewclass">上级</p>
						<p class="row-box">
							<select id="workerpidid" name="workerroleidb"  class="form-control w200">
								<option>请选择上级</option>
								<option v-for="piditem in pidlist" v-bind:value="piditem.worker_id">{{piditem.role_name}}-{{piditem.worker_name}}</option>
							</select>
						</p>
					</li>	

				</ul>
			</li>			
		</ul>	
		<!-- 表单 结束 -->
	</div>
</template>
<script>
  export default {

	  data (){
		  return{
			  groupid:"",
			  grouplist:[],
			  pidlist:[],
			  rolelist:[]
		  }
	  },

	  mounted:function(){
		  this.getgrouplist()
		  
	  },

	  methods:{
		getgrouplist(){
			
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
			});*/
		},
	
		choosegroup(obj){
			
			var that=this;
			this.groupid=obj.value;
			/*this.$options.methods.chooserole(this.groupid);
			this.$options.methods.choosepid(this.groupid);*/
			//this.$options.methods.choosepid(this.groupid);
			//console.log(this.pidlist);

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
				for(var i=0;i<abc.length;i++){
					that.rolelist.push(abc[i]);
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
				}*/
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
				console.log("错误");
			}
		},
		
		saveworkeradd(){
			var wname=$("input[name='workername']").val();
			if(wname==''){
				layer.msg("请输入姓名");return;
			}
			var wsex=$("input[name='workersex']").val();
			if(wsex==''){
				layer.msg("请选择性别");return;
			}
			var wsfz=$("input[name='workersfz']").val();
			if(wsfz==''){
				layer.msg("请输入身份证");return;
			}
			var wphone=$("input[name='workerphone']").val();
			if(wphone==''){
				layer.msg("请输入手机号");return;
			}
			var goid=$("#workergroupid").val();
			if(goid==''){
				layer.msg("请选择部门");return;
			}

			var roid=$("#workerroleid").val();
			if(roid==''){
				layer.msg("请选择职位");return;
			}

			var piid=$("#workerpidid").val();
			if(piid==''){
				layer.msg("请选择上级");return;
			}

			var sendData = {};
			var jsonData = {};
			sendData.url ="index.php/baseset/worker/workeradd";
			jsonData.worker_name = wname;
			jsonData.sex = wsex;
			jsonData.tel = wphone;
			jsonData.sfz = wsfz;
			jsonData.group_id=this.groupid;
			jsonData.role_id=roid;
			jsonData.pid=piid;
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);
        	if(re.status==1){
				layer.msg(re.msg,{time:1500},function(){
					window.location.reload();
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

<style lang="less" scoped>
.main-left-m-top {
  //头部样式
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
  
  .main-left-m-top-left {
    //头部左侧样式
    width: 60%;
    height: auto;
    float: left;
    display: inline;
    
  }
  .main-left-m-top-right span{
	  padding:6px 24px;
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
  .main-left-m-top-right {
    //头部右侧样式
    width: 40%;
    height: auto;
    float: right;
    display: inline;
    a {
      padding:6px 24px;
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
    a:visited {
      color: #fff;
      text-decoration: none;
    }
    a:hover {
      color: #fff;
      text-decoration: none;
    }
  }
}
.h4span {
  font-weight: bold;
  font-size: 15px;
}
.ml350{margin-left:350px;}
.w80{width:80px;}
.border-bottom{border-bottom:1px solid #d0dadc;}	
.from-box{padding:50px;border-radius: 2px;box-shadow: 1px 1px 50px #eaeaea; background-color: #fff;}
.row-box{margin-left: 15px; display:inline-block;}
.thenewclass{ width:160px; text-align:right; display:inline-block;}
</style>