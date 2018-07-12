
<style scoped>
   body{font-family: "Microsoft YaHei";}
   input{background-color:#fff; }
  .demo-carousel{height: 200px; line-height: 200px; text-align: center;}
	.header {
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
    
    .icon-mobile{position: absolute; right: 22px; font-size:16px;top:24px;  }
    .wages{ width: 90%; margin: 0 auto; height: auto; }
    .wages li{ width: 100%; height: auto; float:left; display: inline;border-radius:5px; box-shadow: 1px 1px 20px #eaeaea; text-indent: 2em; margin-top: 16px; padding:10px 0px;  }
    .wages li p{ line-height: 26px; color: #434343;}
    .wages li p span{ line-height: 26px; color: #777;}
    .topp{ height:20px; line-height:20px; padding-top: 20px; }
    .topp span{ width: 48%; color: #777; text-align: center; font-size: 15px; display: inline-block; }
    .bottom{ position: fixed; text-indent: 1em; bottom: 0px; height: 90px;  width: 100%; }
    .bottodiv{ width: 100%; height: 40px; line-height: 40px; background: rgba(104,104,104,0.9);}
    .bottodivleft{  float:left; display: inline;  height:40px; line-height: 40px; color:#fff; }
    .bottodivright{float:right; margin-right: 12px; display: inline; display: inline-block;  text-align: right; height:40px; line-height: 40px; color:#fff; }
    .bottodivtwo{ background-color: #fff; text-align: center;}
    .bottodivtwoleft{ float: left; background-color: #fff; display: inline; width: 50%; height:50px; text-align: center; }
    .bottodivtworight{ float: left; background-color: #fff; display: inline; width: 50%; height:50px; text-align: center; }
    .tubiaop{ background: url(/lib/img/public/cropmode/tupiana.png) 16px center no-repeat;}

    .headerspan{ width: 30%; text-align: center; display: inline-block; }
    .bottodivtwoleft a{color: #434343; text-decoration:none;}
    .bottodivtwoleft a:visited{color: #434343; text-decoration:none;}
    .bottodivtwoleft a:hover{color: #434343; text-decoration:none;}
    .bottodivtworight a{color: #434343; text-decoration:none;}
    .bottodivtworight a:visited{color: #434343; text-decoration:none;}
    .bottodivtworight a:hover{color: #434343; text-decoration:none;}

    .gundong::-webkit-scrollbar {display: none;scrollbar-track-color:none;}
    .wages li a{ color: #434343; text-decoration:none; }
    .wages li a:visited{ color: #434343; text-decoration:none; }
    .wages li a:hover{ color: #434343; text-decoration:none; }

    .headerspan a{ color:#fff; text-decoration:none;}
    .headerspan a:visited{ color:#fff; text-decoration:none;}
    .headerspan a:hover{ color:#fff; text-decoration:none;}

</style>

<template>
	<div style="width:100%; height:100%;padding-bottom:90px;">
		
      <div class="header"><span class="headerspan" onclick="window.history.go(-1)" style=" width:30%; position: absolute; left: 3%; display: inline-block; text-align:left; background: url(/lib/img/public/cropmode/leftjiantou.png) 16px center no-repeat;">&nbsp; </span><span class="headerspan" style=" font-size:17px;">工人工资</span><span class="headerspan"  style="position: absolute; right:5%; top:25px; text-indent:3em; font-size:15px;"><A href="#/worker/query">搜索</a></span></div>

      <div style="height:50px; width:100%;"></div>
      <div class="gundong" style=" width:100%; height:100%; overflow-y:scroll;">
        <div class="wages">
            <ul>
                
                <li v-for="nlist in alldata">
                    <a v-bind:href="'#/worker/workerdetails?id='+nlist.worker_id">
                        <p class="tubiaop">姓名：<span>{{nlist.worker_name}}</span></p>
                        <p>结算工单数：<span>{{nlist.count}}单</span></p>
                        <p>结算金额：{{nlist.cmoney}} 元 </p>
                    </a>
                </li>

            </ul>
            <div style="clear:both; height:20px;"></div>
        </div>
      </div>
       

     <div class="bottom">

         <div class="bottodiv">
             <span class="bottodivleft">今日结算工资总额：{{gentle}} 元</span>
             <span class="bottodivright">{{time}}</span>
         </div>
         
         
         <div class="bottodivtwo">
            <span class="bottodivtwoleft" v-if="num==0">
                 <a href="#/worker/wages">
                    <p style="height:20px; margin-top:3px; line-height:20px; ">
                        <img src="/lib/img/public/cropmode/wages.png" style=" heiht:20px;" />
                    </p>
                    <span style=" display:block; margin-top:-6px; color:#5c9260;">工人工资</span>
                 </a>
             </span>

            <span class="bottodivtwoleft" v-else>
                <a href="#/worker/wages">
                    <p style="height:20px; margin-top:3px; line-height:20px; ">
                        <img src="/lib/img/public/cropmode/wagesed.png" style=" heiht:20px;" />
                    </p>
                    <span style=" display:block; margin-top:-6px;">工人工资</span>
                 </a>
            </span>

             <span class="bottodivtworight" v-if="num==1">
                 <a href="#/worker/set">
                 <p style="height:20px; margin-top:3px; line-height:20px; ">
                     <img src="/lib/img/public/cropmode/setting.png" style=" heiht:20px;" />
                 </p>
                 <span style=" display:block; margin-top:-6px; color:#5c9260;">工资设置</span>
                 </a>
             </span>

             <span class="bottodivtworight" v-else>
                 <a href="#/worker/set">
                 <p style="height:20px; margin-top:3px; line-height:20px; ">
                     <img src="/lib/img/public/cropmode/setted.png" style=" heiht:20px;" />
                 </p>
                 <span style=" display:block; margin-top:-6px;">工资设置</span>
                 </a>
             </span>

         </div>

     </div>

	</div>
</template>

<script>
export default {

	data(){
		return { 
            num:0,
            alldata:[],
            gentle:'',
            date:'',
            time:'',
		}
	},

	mounted: function(){
        
        this.getgongdan();
        
        
	},

	methods:{
        
        getgongdan:function(){

           var myDate = new Date();
           this.time=myDate.getFullYear()+'年'+(myDate.getMonth()+1)+'月'+myDate.getDate()+'日'; 
           var jsonData = {};
		   var sendData = {};
           sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/workerwages_list';
		   sendData.data = jsonData;
		   var re = getFaceInfo(sendData);	
           
           this.alldata=re.data;
           var da=re.data;
           var sum=0;
           for(var i=0;i<da.length;i++){
               sum += da[i]['cmoney'];
           };
           this.gentle=sum;
           
        },

        


        

    },
    
}
</script>
