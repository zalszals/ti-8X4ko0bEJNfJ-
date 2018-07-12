
<style scoped>
	body{font-family: "Microsoft YaHei";}
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
		box-shadow: 2px 0px 5px #777;
	}
</style>

<template>
	<div style="width:100%; height:100%">
		
					<header>打卡器登录<span class="icon-mobile"></span></header>
				
					<div style="width:100%; height:240px;"></div>

					<form class="layui-form" action="">
					
						<input type="text" name="phone" lay-verify="title" placeholder="请输入手机号" class="layui-input"  style="width:60%; border-radius:5px; margin:0 auto;  background:url(/lib/layui/images/tubiao/lo.png) 5px center no-repeat; text-indent:2em;">
					
						<div style=" width:100%;height:15px;"></div>
					
						<input type="text" name="pass" lay-verify="title"  placeholder="请输入密码" class="layui-input" style="width:60%; border-radius:5px; margin:0 auto; background:url(/lib/layui/images/tubiao/mi.png) 5px center no-repeat; text-indent:2em;">
					
						<div style="width:100%; height:15px;"></div>
						
						<div class="layui-form-item" style="text-align:center;">
							<span class="layui-btn" lay-submit="" lay-filter="demo1" style="margin:0 auto;" v-on:click="dologin()">登&nbsp;&nbsp;陆</span>
						</div>

					</form> 

		
	</div>
</template>

<script>
export default {

	data(){
			return { 
				shuju:[] ,
			}
	},

	mounted: function(){

	},

	methods:{
		dologin(){

			var jsonData = {};
			var sendData = {};
			jsonData.phone = $("input[name='phone']").val();
			jsonData.password = $("input[name='pass']").val();	
			if(!jsonData.password || !jsonData.phone) {
				layer.msg('张号或者密码不能为空');
				return;
			}
			jsonData.is_login = 1;
			sendData.url = 'http://mfhost.mfarmers.com/index.php/User/UserInfo/do_login';
			sendData.data = jsonData;
			
			var re = getLoginInfo(sendData);	
			
			if(re.status == 1){
			 	localStorage.setItem("mf_token", re.token);
				localStorage.setItem("mf_account", jsonData.phone);
			 	layer.msg(re.info,{time:2000},function(){
				window.location.href="#/worker/ucenter";
				});
			}else{
			 	layer.msg(re.info);
			}


		},
	},
}
</script>
