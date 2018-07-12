<style scoped>
    .demo-carousel{height: 200px; line-height: 200px; text-align: center;}
	header {
		text-align: center; 
		padding: 20px 0 10px;
		color: #fff;
		background: -webkit-linear-gradient(45deg, #5c9260, #79a468);
		background: -o-linear-gradient(45deg, #5c9260, #79a468);
		background: -moz-linear-gradient(45deg, #5c9260, #79a468);
		background: linear-gradient(45deg, #5c9260, #79a468);
		font-size: 20px;
		position: fixed;
		width: 100%;
		top: 0;
		z-index: 99;
	}
	.divleft{
		width:90px;height:90px;float:left;display:inline;
	}
	.divright{float:left; display:inline; padding:0px 10px 0px 10px;}
	.divright p{ line-height:26px; }
	.abcde{ width:80%; margin:0 auto; }
	.centern{ width:100%; margin:0 auto; height:180px; border-radius:10px; padding:12px 0px;  border-top:1px solid #f6f6f6; box-shadow: 0px 1px 3px #e2e2e2;}
	.centern p{ line-height:26px; text-indent:1em; }	
</style>

<template>
  <div style="width:100%; height:100%">
	  
		<header>工人信息<span class="icon-mobile"></span></header>

		<div style="width:90%;padding-top:70px;margin:0 5%;">

			<div class="divleft">

				<img v-bind:src="imgur" style="width:80px; height:80px; border-top:1px solid #ccc; border-radius:40px; box-shadow:0px 1px 3px #e2e2e2;" />
				
				
			</div>
			
			<div class="divright">
				<p>姓名:<span>{{aall.worker_name}}</span></p>
				<p>部门:<span>{{aall.group_name}}</span></p>
				<p>职务:<span>{{aall.role_name}}</span></p>
			</div>

		</div>

		<div style="clear:both"></div>

		<div style="width:100%; padding:10px 0px; text-align:center; font-size:20px; line-height:50px; "></div>

		<div style="width:100%; height:auto;">

			<ul class="abcde">
              <li class="centern" v-for="clist in workercarda">
                <p>姓名：{{clist.worker_name}}</p>
                <p>工序：{{clist.skill_name}}</p>
                <p>工作区域：{{clist.area_name}}</p>
                <p>工作量：{{clist.num}}</p>
                <p>工作时间：{{clist.work_date}} {{clist.require_time_1}} {{clist.require_time_2}}</p>
                <p>开始时间：{{clist.s_time}}</p>
                <p>结束时间：{{clist.e_time}}</p>
				
                  <!-- <span class="centercheck" v-if="newchangea === '2'">
                    开始工作
                  </span>
                  <span  class="centercheck" v-else-if="newchangea === '1'">
                    结束工作
                  </span> -->

              </li>
          	</ul>

			<p style=" line-height:50px; font-size:16px; text-align:center;">请扫码进行相关操作</p>
			<p style=" line-height:50px; font-size:16px; text-align:center;">
				<a href="/#/worker/ulist">工单列表-示例</a>
			</p>
		</div>

  </div>
</template>

<script>
export default {

	data(){

		return { 	
			aall:[],
			workercarda:[],
			newid:'',
			imgur:'',
		}

	},

	mounted:function(){
		
	   this.maninfo();
	   this.getgongdan(); 

	},

	methods:{
		maninfo:function(){
		   var jsonData = {};
		   var sendData = {};
		   sendData.url = 'http://27.221.53.90:881/index.php/person/PerInfo/get_worker';
		   sendData.data = jsonData;
		   var re = getFaceInfo(sendData);	
		   
		   this.aall=re.worker;
		   this.newid=re.worker.worker_id;

			if(re.worker.img_url==''){
				this.imgur="/lib/img/public/cropmode/rentu.jpg";
			}else{
				this.imgur=re.worker.img_url;
			}
		},

		
		getgongdan:function(){
		   
		    var jsonData = {};
			var sendData = {};
			jsonData.worker_id=this.newid;
						
			sendData.url = 'http://27.221.53.90:881/index.php/Worker/Workercard/workercarda';
			sendData.data = jsonData;
			var re = getFaceInfo(sendData);	

			if(re.status==1){
				this.workercarda=re.data;
				console.log(this.workercarda);
			}else{
				//that.workercarda=re.msg;

			}
			
		},
   

	},

}
</script>
