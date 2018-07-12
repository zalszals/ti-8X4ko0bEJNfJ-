<template>
<div>
	<div id="main_router"></div>
	<ul id="left_main_">		
		<router-link to="/router_main_Production_Management_System" v-if="do_indexOf('2')">
			<li @click="noMenu()">				
				<img src="/lib/img/public/System_Icon/Production_Management_System.png" alt="">
				<p>生产管理系统</p>
			</li>
		</router-link>
		<router-link to="/router_main_Purchase_System" v-if="do_indexOf('5')">
			<li @click="noMenu()">
				<img src="/lib/img/public/System_Icon/Purchase_System.png" alt="">
				<p>采购系统</p>
			</li>
		</router-link>				
		<router-link to="/router_main_Sell_System" v-if="do_indexOf('7')">
			<li @click="noMenu()">
				<img src="/lib/img/public/System_Icon/Sell_System.png" alt="">
				<p>销售系统</p>
			</li>
		</router-link>		
		<router-link to="/router_main_Inventory_System" v-if="do_indexOf('4')">
			<li @click="noMenu()">
				<img src="/lib/img/public/System_Icon/Inventory_System.png" alt="">
				<p>库存系统</p>
			</li>
		</router-link>		
		<router-link to="/router_main_Finance_System" v-if="do_indexOf('6')">
			<li @click="noMenu()">
				<img src="/lib/img/public/System_Icon/Finance_System.png" alt="">
				<p>财务系统</p>
			</li>
		</router-link>		
		<router-link to="/router_main_Personnel_System" v-if="do_indexOf('3')">
			<li @click="noMenu()">
				<img src="/lib/img/public/System_Icon/Personnel_System.png" alt="">
				<p>人事系统</p>
			</li>
		</router-link>
		<router-link to="/router_main_Base_System" v-if="do_indexOf('1')">
			<li @click="noMenu()">
				<img src="/lib/img/public/System_Icon/Set_System.png" alt="">
				<p>基础设置</p>
			</li>
		</router-link>
		<p class="cursor" id="showMenu" @click="showMenu()"><i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></p>
		<p class="cursor" id="hideMenu" @click="hideMenu()"><i class="fa fa-angle-right fa-lg" aria-hidden="true"></i></p>
	</ul>
</div>
</template>
<script>
	export default {
		data() {
			return {
				group_id:localStorage.getItem("group_id"),
				role_id:localStorage.getItem("role_id"),
				group_str:''
			}
  		},
		mounted: function() {
			if(this.group_id!=1){
				$('#showMenu').hide().remove();
				$('#hideMenu').hide().remove();
				$('#left_main_').hide();
			}
			this.get_group_str();			
		},
		methods: {
			initPage: function(){				
				$('#left_main_').find('li').mouseover(function(){
					var src = $(this).find('img').attr('src');					
					src = src.replace(/.png/,'_1.png');										;
					$(this).find('img').attr('src',src);
					$(this).find('p').addClass('fw');					
				})

				$('#left_main_').find('li').mouseout(function(){
					var src = $(this).find('img').attr('src');					
					src = src.replace(/(_1){1}.png/,'.png');
					$(this).find('img').attr('src',src);
					$(this).find('p').removeClass('fw');
				})
			},
			showMenu: function(){
				$('#left_main_').animate({"left":"-1px"},500,function(){
					$('#hideMenu').show();
				});
			},
			hideMenu: function(){
				$('#left_main_').animate({"left":"-150px"},500,function(){
					$('#hideMenu').hide();
				});
			},
			noMenu: function(){
				this.hideMenuFast();
			},
			hideMenuFast: function(){
				$('#left_main_').css("left","-150px");
				$('#hideMenu').hide();
			},
			get_group_str: function(){
				var sendData = {};
				var jsonData = {};
				jsonData.role_id = this.role_id;
				sendData.data = jsonData;
				sendData.url = '/index.php/baseset/Bccc/get_group_str.html';
				var re = getFaceInfo(sendData);
				this.group_str = re.data;
				this.initPage();
				//console.log(re);
				//console.log(this.group_str);
			},
			do_indexOf: function(str){
				if(this.group_str.indexOf(str) > -1){
					return true;
				}else{
					return false;
				}
			}
		}
	}	
</script>
<style scoped>
	* {
		padding: 0;
		margin: 0;
		text-align: center;
		color: #000;
	}

	div {
		
		position: absolute;
		height: 100px;
		left: 0;
	}

	ul {
		/*isplay: none;*/
		margin-top: 60px;		
		left: 0px;
		border: 1px solid #eaeaea;
    	box-shadow: 1px 1px 50px #eaeaea;	
	}

	li {
		padding-top: 30px;
		height: 120px;
		background-color: #fff;
		width: 150px;
	}
	li img{
		width:40px;height:35px;
	}
	#left_main {
		background-color: wheat;
		height: 100px;
	}

	li:hover {
		background-color: #317753;
	}

	p {
		margin-top: 10px;
	}

	.fw{color:#fff;}
	#left_main_{
		position:relative;
		z-index: 99;
		top:0px;
		left:-150px;
	}
	#showMenu{
		width:30px;height:30px;border-radius:50%;border:2px solid #F2A148;line-height:24px;text-indent:7px;
		color:#F2A148;background-color:#FFF;
		position: fixed; top:465px;left:-15px;z-index:-1;
	}
	#hideMenu{
		width:30px;height:30px;border-radius:50%;border:1px solid #DDD;line-height:25px;text-indent:7px;
		color:#F2A148;display:none;background-color:#FFF;
		position: absolute; top:405px;right:-15px;z-index:-1;
	}
	#showMenu i{color:#F2A148;}
	
</style>
