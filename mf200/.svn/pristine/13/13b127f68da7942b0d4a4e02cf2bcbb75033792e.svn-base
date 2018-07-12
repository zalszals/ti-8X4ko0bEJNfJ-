<template>
  <div id="left-box" >
    <div style=" width: 100%; height: 100%;">

        <div class="newdivtop"> 
            <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">生产汇总表</font>
                <!--
                <div class="h4span-rh">

                    <select class="form-control" style="display:inline-block; width:100px;">
                        <option>全部</option>
                    </select>

                    <input class="form-control" style="display:inline-block; width:160px;" type="date" /> <label>至</label> <input class="form-control" style="display:inline-block;width:160px;"  type="date" />

                    <input class="form-control"  style="display:inline-block;width:160px;"  value="请输入作物名称" />
                    
                    <input class="form-control"  style="display:inline-block;width:160px;"  value="请输入负责人" />

                    <span class="rightspana">筛选</span>
                
                </div>
                -->
            </h4>
        </div>
        <!--
        <div class="prosummain">
            <p style="margin-top:20px;">
               <span>工时：12000 小时</span> <span>物料成本：12000 元</span> <span>能耗成本：12000 元</span> 
            </p>
            <p><span>总成本:3336000 元</span></p>
        </div>
        -->
        <div class="newmainy">
            <ul>
                <li v-for="newlist in allprosum" >
                   <a v-bind:href="'#/worker/production/production_sum_details?id='+newlist.plan_id+'&plan_name='+newlist.plan_name+'&add_time='+newlist.add_time">
                   <h4 style="margin-left:60px; margin-top:30px; font-size:18px; font-weight:bold;">{{newlist.plan_name}}</h4>

                   <div class="inlinediv" style=" width:170px;margin-top:20px;">
                       <span class="span-inlinea" >总产量：<p style="font-size:16px; margin-top:10px;">{{newlist.estimate_amount}} Kg</p></span>
                       <span class="span-inlinea" >能源消耗：<p style="font-size:16px; margin-top:10px;">{{newlist.cost_materiel}} 元</p></span>
                   </div>

                   <div class="inlinediv" style="margin-top:20px;">
                       <span class="span-inlinea" >总成本：<p style="font-size:16px; margin-top:10px;">{{newlist.total_cost}} 元</p></span>
                       <span class="span-inlinea">用工用时：<p style="font-size:16px; margin-top:10px;">{{newlist.worker_time}} 小时</p></span>
                   </div>

                   </a>
                </li>
                
            </ul>
        </div>

    </div>

  </div>
</template>
<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-rh{ float: right; display: inline; }
.rightspana{float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px; }

.prosummain{ width:100%; height:auto; }
.prosummain p{ width: auto; margin-left:40px;  height: 30px; line-height: 30px;  font-size: 15px; }
.prosummain p span{ display: inline-block; margin-right: 30px; }

.newmainy{ width:100%; height: auto; }

.newmainy li{ float: left; display: inline; margin-left: 40px; margin-top: 20px; width:410px; height: 210px; background-color: #fff; border-radius:10px; box-shadow:0px 0px 1px #ccc;}
.inlinediv{margin-left: 50px; width: auto; margin-top: 10px; float: left; display: inline; height:120px; }
.span-inlinea{ margin-top: 10px; display: block; font-size:12px; }

</style>
<script>
export default {
  data(){
      return{
          allprosum:[],
      }
  },

  mounted:function(){
      this.getallprosum();
  },

  methods:{
   getallprosum:function(){

      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/product/ProductSum/prosum_list";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.allprosum = re.data;
      //console.log(this.allprosum);
   },

  },

}
</script>
