<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
            <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">种植任务&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;详情</span></font>
                <span class="h4span-r" style="background-color:#b0c777;">返 回</span>
            </h4>
        </div>

        <div class="planttaskdetails">
            <h5 style="font-weight:bold; color:#222; margin-bottom:20px;">发布人：<span>{{getnewman}}</span></h5>
            <h5 style="font-weight:bold; color:#222; margin-bottom:40px;">负责人：<span>{{getzhz.worker_name}}</span></h5>
            
            <p class="details-top-p">作物基本信息</p>
            <p class="details-top-p-son">作物:<span>{{getzhz.cat_name}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;果型:<span>{{getzhz.cat_type}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;果色:<span>{{getzhz.cat_color}}</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;品种:<span>{{getzhz.cat_p_name}}</span>
            </p>
            
            <!--<p class="details-top-p-son">描述:<span>{{getzhz.cat_desc}}</span></p>-->

            <p style="height:30px; "></p>
            <p class="details-top-p">种植模式:<span>{{getzhz.mode_name}}</span></p>
            <p style="height:30px; "></p>

            <p class="details-top-p">间距</p>
            <p class="details-top-p-son">株距:<span>{{getzhz.zhu_ju}} cm</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 行距:<span>{{getzhz.hang_ju}} cm</span></p>
            
            <!--添加-->
            <!--
            <div class="middle">
                <ul>
                    <li v-for="alist in getzhz.area_name">
                        <p style="font-weight:bold;">种植区域：<span>日光-01</span></p>
                        <p>实际产量：<span>100 Kg</span></p>
                        <p>种植面积：<span>10 平方米</span></p>
                        <p>定植数量：<span>300 株</span></p>
                    </li>
                    
                    <li>
                        <p style="font-weight:bold;">种植区域：<span>日光-01</span></p>
                        <p>实际产量：<span>100 Kg</span></p>
                        <p>种植面积：<span>10 平方米</span></p>
                        <p>定植数量：<span>300 株</span></p>
                    </li>

                    <li>
                        <p style="font-weight:bold;">种植区域：<span>日光-01</span></p>
                        <p>实际产量：<span>100 Kg</span></p>
                        <p>种植面积：<span>10 平方米</span></p>
                        <p>定植数量：<span>300 株</span></p>
                    </li>

                    <li>
                        <p style="font-weight:bold;">种植区域：<span>日光-01</span></p>
                        <p>实际产量：<span>100 Kg</span></p>
                        <p>种植面积：<span>10 平方米</span></p>
                        <p>定植数量：<span>300 株</span></p>
                    </li>

                    <li>
                        <p style="font-weight:bold;">种植区域：<span>日光-01</span></p>
                        <p>实际产量：<span>100 Kg</span></p>
                        <p>种植面积：<span>10 平方米</span></p>
                        <p>定植数量：<span>300 株</span></p>
                    </li>

                    <li>
                        <p style="font-weight:bold;">种植区域：<span>日光-01</span></p>
                        <p>实际产量：<span>100 Kg</span></p>
                        <p>种植面积：<span>10 平方米</span></p>
                        <p>定植数量：<span>300 株</span></p>
                    </li>
                   
                </ul>
            </div>
             -->
            <!--添加-->

            <p style="height:30px; "></p>
            <p class="details-top-p">分配面积：<span>{{mianji}} 平方米</span></p>
            <p style="height:30px; "></p>
            <p class="details-top-p" v-for="alist in getzhz.area_name">种植区域：{{alist.area_name}}<span></span></p>

            <p style="height:30px; "></p>
            <p class="details-top-p">产量</p>
            <p class="details-top-p-son" v-for="nnlist in gzplanall.son" v-if="nnlist.t_id==getpsid">预计产量:<span> {{nnlist.p_amount}} Kg</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 实际产量:<span> {{nnlist.total_output}} Kg</span></p>

            <p style="height:30px; "></p>
            <p class="details-top-p">时间</p>
            <p class="details-top-p-son">计划定植时间:<span> {{gzplanall.grow_date}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 计划采收期:<span> {{gzplanall.estimate_get_date_1}} 至 {{gzplanall.estimate_get_date_2}}</span></p>
            <p class="details-top-p-son">实际定植时间:<span> {{getzhz.grow_date}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 实际采收期:<span> {{getzhz.estimate_get_date_1}} 至 {{getzhz.estimate_get_date_2}}</span></p>
            <p style="height:30px; "></p>
            <!--<p class="details-top-p">所有费用预估：<span>{{getzhz.total_cost}} 元</span></p>-->

        </div>

    </div>
</div>    
</template>
<script>
export default {
 data(){
     return{
         getplanid:'',
         getpsid:'',
         getnewman:'',
         gzplanall:[],
         getzhz:[],
         mianji:'',
     }
 },
 
 mounted:function(){

     this.getplanid=this.$route.query.id;
     this.getpsid=this.$route.query.psid;
     this.getnewman=this.$route.query.newman;
     this.mianji=this.$route.query.fenpei;
     this.getplan();
     this.getdetails();
 },

 methods:{
   getplan(){
      var sendData = {};
      var jsonData = {};
      //sendData.url ="index.php/product/ProductPlanNew/product_list_pcdetail";
      //sendData.url ="index.php/product/ProductPlan/product_list_detail";
      sendData.url ="index.php/product/Progrowtask/person_growtask_detail";
      
      //jsonData.plan_id = this.getplanid;
      jsonData.t_id = this.getpsid;
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.gzplanall=re.data; 
   },


   getdetails:function(){

    var sendData = {};
    var jsonData = {};
    //sendData.url ="index.php/product/Progrowtask/task_pcdetail";
    sendData.url ="index.php/product/Progrowtask/task_detail";
    jsonData.plan_id =this.getplanid;
    jsonData.ps_id =this.getpsid;
    jsonData.t_id=this.getpsid;
    sendData.data = jsonData;
    var re = getFaceInfo(sendData);
    this.getzhz = re.data;

  },
 },

 
}
</script>
<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;    }
.h4span-r{ float: right; margin-top: 10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.planttaskdetails{ margin: 30px;}

.details-top-p{
    font-weight: bold; color: #222;
}

.details-top-p-son{
    font-weight: normal; color: #666; font-size: 15px; text-indent: 0.2em; line-height: 30px;
}

.details-top-p-son span{ color: #333; text-indent: 0.5em; display:inline-block; }

.middle{ width: 100%; height: auto; padding: 20px 0px; display: block;  }
.middle li{ width:236px; height:162px; padding-top: 20px; margin-top: 20px; display: inline-block; margin-right: 20px; background-color: #fff; border-radius:5px; box-shadow: 0px 0px 8px #e2e2e2;}
.middle li p{ margin-left:30px; line-height: 30px; }

</style>
