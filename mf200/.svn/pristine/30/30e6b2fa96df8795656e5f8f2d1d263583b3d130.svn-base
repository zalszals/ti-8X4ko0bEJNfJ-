<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >
        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">工单管理</font></h4>
        </div> 

        <div class="ordermain">
            <div style=" width:100%; height:270px;">
                <div class="addorder">
                    <img src="/lib/img/public/cropmode/ordertupiana.jpg" style="margin-top:30px;" />
                    <h4 style="line-height:60px;">发布工单</h4>
                    <p style="padding:0 30px; line-height:24px;">
                        可发布工单，已经发布的工单可在生产看板的历史工单中查看。
                    </p>
                    <p style="padding-top:10px;" v-on:click="opd()"><img src="/lib/img/public/cropmode/xiajiantou.jpg" /></p>
                    
                </div>
                <div class="ordercheck">
                    <a href="#/worker/workerorder/order_list">
                        <img src="/lib/img/public/cropmode/ordertupianb.jpg" style="margin-top:30px;" />
                        <h4 style="line-height:60px;">工单审查</h4>
                        <p style="padding:0 30px; line-height:24px;">
                            对工单进行审查，已经核查正在进行的工单在生产看板中查看，已经核查已完成的工单在生产看板的历史工单中查看。
                        </p>
                    </a>
                </div>
            </div>            
            <div class="addorderbot hide" id="addor" style="background:url(/lib/img/public/cropmode/orderbj.jpg) no-repeat center center">
                <router-link to="/worker/workerorder/addorder_list1">
                    <h4 style="margin-top:80px;">模式一</h4>
                    <p style="line-height:40px;">按 <a href="/#/worker/workerorder/addorder_list1" style="color:#f2a553">工人</a> 发布工单</p>
                </router-link>
                <router-link to="/worker/workerorder/addorder_list2">
                    <h4 style="margin-top:80px;">模式二</h4>
                    <p style="line-height:40px;">按 <a href="/#/worker/workerorder/addorder_list2" style="color:#f2a553">工序</a> 发布工单</p>
                </router-link>
            </div>            
        </div>
        


    </div>
</div>
</template>
<script>
export default {

  data(){
      return {

      }

  },

  mounted: function() {
   
  },
  
  methods:{
      opd(){
          if($("#addor").hasClass("hide")){
            $("#addor").removeClass("hide");
          }else{
            $("#addor").addClass("hide");
          }
      }
  },

}
</script>
<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }

.ordermain{width:100%; height:auto;}
.addorder{ width: 340px; height: 240px; text-align:center; float:left; display:inline; border-radius:12px; box-shadow:0 0 1px #ccc; margin-top: 30px; background-color: #fff;}
.ordercheck{ width: 340px; height: 240px; text-align:center; float:left; display:inline; border-radius:12px; box-shadow:0 0 1px #ccc; margin-left: 30px; margin-top: 30px; background-color: #fff;}

.addorderbot{width:340px; height:295px; float: left; text-align: center; display: block;}
</style>