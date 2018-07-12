
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
    
    .icon-mobile{position: absolute; right: 8px;  padding: 5px 10px; font-size:14px;  }
    
    .details{ width: 100%; height: auto;}
    .details li{ width: 100%; margin-bottom: 30px; text-indent: 2em;  float:left; display: inline;}
    .details li p{line-height: 28px; color:#222;}
    .details li p span{ color:#777;}
    .bottomc{ position: fixed; text-indent: 1em; bottom: 0px; height: 40px;  width: 100%; }
    .bottodivc{ width: 100%; height: 40px; line-height: 40px; background: rgba(104,104,104,0.9);}
    .bottodivleftc{ float: left; display: inline;  height:40px; line-height: 40px; color:#fff; }
    .bottodivrightc{ float: right; margin-right: 12px; display: inline; display: inline-block;  text-align: right; height:40px; line-height: 40px; color:#fff; }
    .tubiaopa{ background: url(/lib/img/public/cropmode/tupiana.png) 16px center no-repeat;}
    .headerspana{ width:60%; display: inline-block;  }
</style>

<template>
	<div style="width:100%; height:100%; padding-bottom:50px;">
		
	  <div class="header" style="font-size:17px;"><span class="headerspana" onclick="window.history.go(-1)" style=" width:10%; position: absolute; left: 3%; background: url(/lib/img/public/cropmode/leftjiantou.png) 16px center no-repeat;" >&nbsp;</span><span class="headerspana">工人工资详情</span></div>
    
      <div style="height:70px; width:100%;"></div>
      <div style=" width:100%; height:100%; ">

        <Div class="details">
           <ul>
               <li v-for="wlist in details">
                   <p class="tubiaopa">姓名：<span>{{wlist.worker_name}}</span></p>
                   <p>工序：<span>{{wlist.skill_name}}</span></p>
                   <p>工作区域：<span>{{wlist.area_name}}</span></p>
                   <p>实际完成量：<span>{{wlist.num}}</span></p>
                   <p>工作时间：<span>{{wlist.worker_date}} {{wlist.require_time_1}} {{wlist.require_time_2}}</span></p>
                   <p>打卡时间：<span>{{wlist.s_time}}<br/> <font style="display: block; text-indent:7em;">{{wlist.e_time}}</font></span></p>
                   <p>审核人：<span>{{wlist.check_worker_name}}</span></p>
                   <p>核查时间：<span>{{wlist.check_time}}</span></p>
                   <p>评分：<span>{{wlist.score}}分</span></p>
                   <p>备注：<span>{{wlist.beizhu}}</span></p>
                   <p>图片：<span>查看</span></p>
                   <p>结算金额：<span>{{wlist.money}}元</span></p>
               </li>
               <!--<li>
                   <p class="tubiaopa">姓名：<span>刘苗苗</span></p>
                   <p>工序：<span>定植</span></p>
                   <p>工作区域：<span>6号玻璃温室</span></p>
                   <p>实际完成量：<span>666株</span></p>
                   <p>工作时间：<span>2018-05-01 07：00-12:00</span></p>
                   <p>打卡时间：<span>2018-05-01 08：00<br/> <font style="display: block; text-indent:7em;">2018-05-01 12：00</font></span></p>
                   <p>审核人：<span>李腾</span></p>
                   <p>核查时间：<span>2018-05-01 14:00</span></p>
                   <p>评分：<span>90分</span></p>
                   <p>备注：<span></span></p>
                   <p>图片：<span>查看</span></p>
                   <p>结算金额：<span>20.6元</span></p>
               </li>
               <li>
                   <p class="tubiaopa">姓名：<span>刘苗苗</span></p>
                   <p>工序：<span>定植</span></p>
                   <p>工作区域：<span>6号玻璃温室</span></p>
                   <p>实际完成量：<span>666株</span></p>
                   <p>工作时间：<span>2018-05-01 07：00-12:00</span></p>
                   <p>打卡时间：<span>2018-05-01 08：00<br/> <font style="display: block; text-indent:7em;">2018-05-01 12：00</font></span></p>
                   <p>审核人：<span>李腾</span></p>
                   <p>核查时间：<span>2018-05-01 14:00</span></p>
                   <p>评分：<span>90分</span></p>
                   <p>备注：<span></span></p>
                   <p>图片：<span>查看</span></p>
                   <p>结算金额：<span>20.6元</span></p>
               </li>-->
           </ul>
        </Div>

      </div>

     <div class="bottomc">

         <div class="bottodivc">
             <span class="bottodivleftc">今日结算工资总额：76.2元</span>
             <span class="bottodivrightc">2018-04-16</span>
         </div>

     </div>

	</div>
</template>

<script>
export default {

	data(){
		return { 
          details:[], 
          getwid:'', 
		}
	},

	mounted: function(){
        this.getwid=this.$route.query.id;
        this.getdetails()
	},

	methods:{

       getdetails:function(){

           var jsonData = {};
		   var sendData = {};
           sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/workerwages_list_details';
           jsonData.worker_id=this.getwid;
           sendData.data = jsonData;
           
		   var re = getFaceInfo(sendData);	
           this.details=re.data;
           

       }    

    },
    
}
</script>
