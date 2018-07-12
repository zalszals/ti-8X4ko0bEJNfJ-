<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <Div class="newdivtop">
            <h4 style="font-weight:bold;">生产计划&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;已完成的生产计划</span>
                <span class="h4span-r" @click="$router.back(-1)">返 回</span>

                <span class="h4span-r" style="background-color:#b0c777;" v-on:click="sousou()"><img src="/lib/img/public/cropmode/fangdajing.jpg" />&nbsp;搜 索</span>
                <span class="h4span-ra"><input type="date" class="form-control"  style="display:inline-block;width:160px;" name="atime" value=""/> 至 <input type="date" class="form-control" style="display:inline-block;width:160px;" name="btime" value=""/></span>
                <span class="h4span-ra"><input type="text" class="form-control" style="width:160px;"  name="addman_name" placeholder="请输入发布人"></span>
                <span class="h4span-ra"><input type="text" class="form-control" style="width:160px;"  name="zuowu_name" placeholder="请输入作物"></span>


            </h4>
        </Div>

        <div class="overmainneia">
            <ul>
                <li v-for="(vo,index) in planall" :key="index">
                    <h4>{{vo.plan_name}}</h4> 
                    <h5 style="line-height:40px; font-size:14px;">发布人：<b>{{vo.worker_name}}</b></h5>
                    <p style="width:40px; height:2px; background-color:#f2a553; margin-top:20px;"></p>
                    <p class="planlidivp">作物:<span>{{vo.cat_name}}</span></p>
                    <p class="planlidivp">品种:<span>{{vo.cat_p_name}}</span></p>
                    <p class="planlidivp">果型:<span>{{vo.fc_name}}</span></p>
                    <p class="planlidivp">果色:<span>{{vo.ft_name}}</span></p>
                    <p class="planlidivp">总种植面积:<span>{{vo.grow_area_2}} 平方米</span></p>
                    <p class="planlidivp">预计产量:<span>{{vo.estimate_amount}} Kg</span></p>
                    <p class="planlidivp">实际产量:<span>{{vo.estimate_amount}} Kg</span></p>
                    <p class="planlidivp">发布日期:<span>{{vo.add_time}}</span></p>

                    <a v-bind:href="'#/product/productplan/product_plan_list?id='+vo.plan_id">
                        <p style="background-color:#f2a553;border-radius:5px; width:120px; text-align:center; height:30px; margin-top:15px; line-height:30px; color:#fff;">查看更多详情</p>
                    </a>
                </li>
            </ul>
            <div style="clear:both"></div>
            <!--<div class="overpage">分页</div>-->
        </div>
        <div id="page_new" class="paing">
            <ul class="pages" v-if="pages > 1">
                <li @click="changetype(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
            </ul>
		</div>   
    </div>
</div>
</template>

<script>
export default {
  data(){return { planall:[],pages:'',page:''}},
  
  mounted:function(){
      this.changetype(1);
  },
  methods:{
        changetype(page){
            var sendData = {};
            var jsonData = {};
            sendData.url = "index.php/pc/ProductPlan/product_list";
            jsonData.type = 2;
            jsonData.page = page;
            sendData.data = jsonData;
            var re = getFaceInfo(sendData);
            if(re.status == 1){
                this.planall = re.data;
                this.pages = re.total.pages;
			    this.page = re.total.page;
            }
        },
        sousou(){
            var sendData = {};
            var jsonData = {};
            sendData.url = "index.php/pc/ProductPlan/product_list";
            jsonData.type = 2;
            jsonData.page = 1;
            jsonData.cat_name = $("input[name='zuowu_name']").val();
            jsonData.worker_name = $("input[name='addman_name']").val();
            jsonData.s_time = $("input[name='atime']").val();
            jsonData.e_time = $("input[name='btime']").val();
            sendData.data = jsonData;
            var re = getFaceInfo(sendData);
            if(re.status == 1){
                this.planall = re.data;
                this.pages = re.total.pages;
			    this.page = re.total.page;
            }
        }
  }
}
</script>

<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.h4span-ra{ float: right; display: inline; font-size: 14px; font-weight: normal; border-radius:3px; margin-left: 20px;}

.overmainneia{ width: 100%; height: 100%;}
.overmainneia ul{ float: left; display: inline; margin-left: -25px;  width: 102%;}
.overmainneia ul li{ width: 340px; height: 430px; float: left; display: inline; padding-left:50px; padding-top:40px;  margin-top: 30px; margin-left: 24px; background-color: #fff; border-radius:5px; box-shadow: 0px 0px 2px #eee;}
.overmainneia ul li p{ font-size: 14px; line-height: 36px;}

.planlidivp{ height: 20px; line-height: 20px;}
.planlidivp span{ font-weight: bold; font-size: 14px; line-height:20px;  display: inline-block; text-indent: 1em;} 
.overpage{ width: 100%; height: 40px; line-height: 40px; font-size: 14px;  border: 1px solid  red}
</style>
