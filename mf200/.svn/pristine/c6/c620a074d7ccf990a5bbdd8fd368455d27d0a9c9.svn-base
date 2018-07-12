<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <Div class="newdivtop">
            <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">生产计划&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;详情</span></font>
                <span class="h4span-r" style="background-color:#b0c777;" @click="$router.back(-1)">返 回</span>
                <span v-if="planall.type == 1" class="h4span-r" style="background-color:#f2a553;" @click="confirm(planall.plan_id)">确认完成</span>
            </h4>
        </Div>
        
        <div style="display:block; height:100%;">
            <div style="height:100%;">
                <div class="maininfodiv">
                    <div class="maingropinfo">
                        <div class="maingropinfoleft" >
                            <table>
                                <tr>
                                    <td class="zz">{{planall.plan_name}}</td>
                                    <td></td><td></td><td></td>
                                    <td><span v-if="planall.type == 1" class="button">进行中</span><span v-else class="button1">已完成</span></td>
                                </tr>
                                <tr>
                                    <td><span class="c">作物：</span>&nbsp;&nbsp;{{planall.cat_name}}</td>
                                    <td><span class="c">品种：</span>&nbsp;&nbsp;{{planall.cat_p_name}}</td>
                                </tr>
                                <tr>
                                    <td><span class="c">果型：</span>&nbsp;&nbsp;{{planall.ft_name}}</td>
                                    <td><span class="c">果色：</span>&nbsp;&nbsp;{{planall.fc_name}}</td>
                                </tr>
                                <tr>
                                    <td><span class="c">描述：</span>&nbsp;&nbsp;{{ planall.cat_desc}}</td>  
                                </tr> 
                                <tr>
                                    <td><span class="c">计划定植时间：</span>&nbsp;&nbsp;{{planall.grow_date}}</td>
                                    <td><span class="c">采收期：</span>&nbsp;&nbsp;{{planall.estimate_get_date_1}} 至 {{planall.estimate_get_date_2}}</td>
                                </tr>
                                <tr>
                                    <td><span class="c">种植面积：</span>&nbsp;&nbsp;{{planall.grow_area_2}} 平方米</td>
                                    <td><span class="c">总产量预估:</span>&nbsp;&nbsp;{{planall.estimate_amount}} kg</td>
                                </tr>
                                <tr>
                                    <td><span class="c">实际产量:</span>&nbsp;&nbsp;{{planall.total}} kg</td>
                                </tr>
                                <tr>
                                    <td><span class="c">人工成本预估：</span>&nbsp;&nbsp;{{planall.cost_worker}} 元</td>
                                    <td><span class="c">物料成本预估：</span>&nbsp;&nbsp;{{planall.cost_materiel}} 元</td>
                                <tr>
                                    <td><span class="c">能耗成本预估：</span>&nbsp;&nbsp;{{planall.cost_amount}} 元</td>
                                    <td><span class="c">总成本预估：</span>&nbsp;&nbsp;{{planall.total_cost}} 元</td>
                                </tr>
                                <tr>
                                    <td class="zz">计划分配</td>
                                </tr>                         
                            </table>
                        </div>
                    </div>

                    <div class="mainlistinfo" style="display:block; height:100%;">
                        <div class="divullia">
                            <ul>
                                <li v-for="(vo,index) in planall.son">
                                   <h4>种植任务{{index+1}}</h4> 
                                   <p style="width:40px; height:2px; background-color:#b0c777; margin-top:20px;"></p>
                                   <p>负责人：<span>{{vo.worker_name}}</span></p>
                                   <p>分配面积：<span>{{vo.grow_area_2}} 平方米</span></p>
                                   <p>目标产量：<span>{{vo.p_amount}} kg</span></p>
                                   <p>实际产量：<span>{{vo.total_output}} kg</span></p>
                                   <p>状态：<span v-if="vo.status < 2" class="mo">待执行</span><span v-else-if="vo.status == 2" class="mo">进行中</span><span v-else class="mt">已完成</span></p>
                                   <!--<A v-bind:href="'#/product/planttask/planttask_details?id='+planall.plan_id+'&psid='+vo.t_id+'&newman='+planall.worker_name+'&fenpei='+vo.grow_area_2"><p style="background-color:#b0c777;border-radius:5px; width:120px; text-align:center; height:30px; margin-top:15px; line-height:30px; color:#fff;">查看更多详情</p></A>-->
                                   <A v-bind:href="'#/product/productplan/product_job_details?id='+vo.t_id"><p style="background-color:#b0c777;border-radius:5px; width:120px; text-align:center; height:30px; margin-top:15px; line-height:30px; color:#fff;">查看更多详情</p></A>
                                   <!--<a v-bind:href="'#/product/planttask/product_job_details?id='+list.t_id"><p class="planlidivlook">查看更多详情</p></a>-->
                                </li>

                            </ul>

                        </div>
                        <div style="clear:both;"></div> 
                    </div>

                </div> 
                <div style="clear:both;"></div> 
            </div>
        </div>    
    </div>
</div>
</template>
<script>
export default {
  data(){ return{ planall:[],getplanid:'', pname:'',adtime:'',} },
  mounted:function(){
      this.getplanid=this.$route.query.id;
      //this.getplanman=this.$route.query.man;
      this.pname=this.$route.query.pname;
      this.adtime=this.$route.query.addtime;
      this.getinfo(); 
  },
  methods:{

    getinfo:function(){
        var sendData = {};
        var jsonData = {};
        //sendData.url ="index.php/product/ProductPlanNew/product_list_pcdetail";
        sendData.url ="index.php/pc/ProductPlan/product_list_detail";
        jsonData.plan_id = this.getplanid;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.planall=re.data;
        //console.log(this.planall);
    },
    confirm(plan_id){
        var val = layer.confirm("确认完成", {
            btn: ["确认", "取消"],
            title: [""]
        },function(){
            var sendData = {};
            var jsonData = {};
            sendData.url ="index.php/pc/ProductPlan/confirm_plan";
            jsonData.plan_id = plan_id; 
            sendData.data = jsonData;
            var re = getFaceInfo(sendData);
            if(re.status == 1){
                layer.msg(re.msg,{time: 1000},function(){
                    window.location.reload();
                });
            }else{
                layer.msg(re.msg);
            }
        },function(){
            layer.close(val);
        })
    }

  },
}
</script>
<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top:10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px; cursor:pointer }

.maininfodiv{ margin:30px;}
.maininfodiv p{font-weight: bold; line-height: 40px; font-size:16px; color:#555;}
.maininfodiv p span{font-weight:normal}

.maingropinfo{ width: 100%; height:auto;}
.maingropinfoleft{ display: block; width: 100%;  }

.maingropinforight{ display: block; width: 100%;  text-align: left; }
.maingropinfolefttop{ height: 200px; }
.mainlistinfo{ width:100%; height: auto;  }
.divullia{ width: 100%; height: auto; }
.divullia ul{ margin-left: -45px; height: auto; width: 105%; float: left; display:inline; }
.divullia ul li{ float: left; display: inline; margin-left:36px; margin-top: 20px; width: 320px; height: 330px; padding-left:30px; padding-top:30px;   background-color: #fff; box-shadow:0px 1px 2px #dedede;border-radius:8px; border:1p solid red; }
.divullia ul li p{ font-size: 14px; line-height: 36px;}

.maingropinfo-p{ font-size: 15px; font-weight:bold; }
.maingropinfo-p-span{ width: 590px; display: inline-block; font-weight:bold; }
.c{font-weight:bold}
.mo{color:#f2a553}
.mt{color:#b0c777}
.m{margin-left:30px}
table{margin-top:15px}
table tr{height:60px;}
table tr td{width:280px}
.zz{color:#f2a553;font-size:20px}
.button{padding-left: 25px;padding-right: 25px;padding-top: 5px;padding-bottom: 5px;color: white;background:#f2a553;border: 0;border-radius: 5px;opacity:0.8;}
.button1{padding-left: 25px;padding-right: 25px;padding-top: 5px;padding-bottom: 5px;color: white;background:#b0c777;border: 0;border-radius: 5px;opacity:0.8;}
</style>
