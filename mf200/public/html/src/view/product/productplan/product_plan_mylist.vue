<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <Div class="newdivtop">
            <h4 style="font-weight:bold;">生产计划&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;生产计划详情</span>&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;我的任务</span>
                <span class="h4span-r" style="background-color:#b0c777;" @click="$router.back(-1)">返 回</span>
            </h4>
        </Div>
        
        <div style="display:block; height:100%;">
            <div style="height:100%;">
                <div class="maininfodiv">
                    <h4 style="color:#f2a553; line-height:50px; ">我的任务</h4>
                    <p>生产计划发布人：<span>{{getnewman}}</span></p>
                    <p>生产计划负责人：<span>当前登陆者{{amyjob.all_info.worker_name}}</span></p>

                    <div class="maingropinfo"  style="display:block;">

                        <div class="maingropinfoleft" >
                            <div class="maingropinfolefttop">
                            <p>作物基本信息</p>
                            <p style="font-weight:normal; color:#666;">作物：<span>{{amyjob.all_info.parent_name}}</span> &nbsp;&nbsp;&nbsp;&nbsp;果型：<span>{{amyjob.all_info.cat_type}}</span> &nbsp;&nbsp;&nbsp;&nbsp;果色：<span>{{amyjob.all_info.cat_color}}</span> &nbsp;&nbsp;&nbsp;&nbsp;品种：<span>{{amyjob.all_info.cat_name}}</span></p>
                            <p style="font-weight:normal; color:#666;">描述：<span>{{amyjob.all_info.cat_desc.substring(0,24)}}...</span></p>
                            </div>

                            <p>总种植面积：<span style="font-weight:normal; color:#888;">{{amyjob.all_info.grow_area_2}} 亩</span></p>
                           
                            <p>成本预估--数据未对接</p>

                            <p style="font-weight:normal;font-size:13px;">人工成本预估：<span>30000 元</span> &nbsp;&nbsp;物料成本预估：<span>30000 元</span> 
                            &nbsp;&nbsp;能耗成本预估：<span>30000 元</span><br/>总成本：<span>90000 元</span></p>
           
                        </div>

                        <div class="maingropinforight" >
                            <div class="maingropinfolefttop">
                            <p>时间信息</p>
                            <p style="font-weight:normal; color:#666;">定植时间：<span>{{amyjob.all_info.grow_date}}</span> &nbsp;&nbsp;&nbsp;&nbsp;采收期：<span>{{amyjob.all_info.estimate_get_date_1}} 至 {{amyjob.all_info.estimate_get_date_2}}</span> </p>
                            </div>
                            <p>产量预估</p>
                            <p style="font-weight:normal; color:#666;">总产量预估：<span>{{amyjob.all_info.p_amount}} Kg</span> &nbsp;&nbsp;&nbsp;&nbsp;日产量预估：<span>#{{amyjob.all_info.plan_estimate_amount_one_date}} Kg</span></p>
                            <p>生产计划编号：<span>#{{amyjob.all_info.plan_no}}</span></p>
                        </div>

                        <div style="clear:both;"></div>

                    </div>

                    <div class="mainlistinfo" style="display:block; height:100%;">
                        <h4 style="color:#f2a553; line-height:50px; width:100%;">生产任务</h4>
                        <div class="divulli">
                            <ul>
                                <li v-for="(newlist,index) in amyjob.task_info" v-on:click="addjob(newlist.t_id,index+1)">  
                                    <h4>{{newlist.t_name}}</h4>
                                    <p style="margin-top:10px;">种植模式：<span>{{newlist.mode_name}}</span></p>
                                    <p>种植区域：<span>{{newlist.area_name}}</span></p>
                                    <p>任务预计产量：<span>{{newlist.year_weight}} kg</span></p>
                                    <p>任务费用预估：<span>{{newlist.total_cost}} 元</span></p>
                                    <p>种植任务负责人：<span>{{newlist.worker_name}}</span></p>
                                </li>
                                <!--
                                <li style="text-align:center; padding-left:0;">
                                    
                                    <A v-bind:href="'#/product/planttask/planttask_add?planid='+getplanid+'&psid='+getpsid+'&fabuid='+abid+'&yuchl='+amyjob.all_info.p_amount+'&agomianji='+countsun">
                                    <img src="/lib/img/public/cropmode/shizi.jpg" style="margin-top:50px;" />
                                    <h4 style="line-height:80px;">添加种植任务</h4>
                                    </a>
                                    
                                </li>
                                -->
                            </ul>

                            <div class="mainlistinfo-bot">
                                <h4>总计</h4>
                                <!--页面计算得出结果-->
                                <p>所有任务预计产量之和：{{countsun}} kg</p>
                            </div>

                        </div>
                        <div style="clear:both;"></div> 
                    </div>

                </div> 
                <div style="clear:both;"></div> 
            </div>
        </div>    
    </div>

    <div id="addjob" style="display:none; overflow:hidden;">
        <div style="width:1100px; height:564px; background-color:#f5f9fa;overflow:hidden;">
            <div style="width:1090px; height:514px; background-color:#fff; margin:5px;">
            
                <div class="newmainnei" >
                    
                    <p>任务责任人：{{getzhz.worker_name}}</p>
                    <table>
                        <tr>
                            <td style="padding-left:0px;">
                                <p class="newfontp">作物基本信息</p>
                                <p>作物：<span>{{getzhz.cat_name}}</span></p>
                                <p>果型：<span>{{getzhz.cat_type}}</span></p>
                                <p>果色：<span>{{getzhz.cat_color}}</span></p>
                                <p>品种：<span>{{getzhz.cat_p_name}}</span></p>
                                <p>描述：<span>{{getzhz.cat_desc}}</span></p>
                            </td>

                            <td class="tabletrtd">
                                <p class="newfontp">种植模式：{{getzhz.mode_name}}</p>
                                <p></p>
                                <p class="newfontp">间距</p>
                                <p>株距：<span>{{getzhz.zhu_ju}} cm</span></p>
                                <p>行距：<span>{{getzhz.hang_ju}} cm</span></p>

                            </td>

                            <td class="tabletrtd">
                                <p class="newfontp">种植区域：{{getzhz.area_name}}</p>
                                <p>实际种植面积：<span>{{getzhz.grow_mianji_mu}} 亩</span></p>
                                <p>定制数量：<span>{{getzhz.grow_num}} 株</span></p>
                                <p></p>
                                <p class="newfontp">目标单果重：{{getzhz.grow_num}} g</p>
                            </td>

                            <td class="tabletrtd">
                                <p class="newfontp">目标产量</p>
                                <p>目标每平方米产量：<span>{{getzhz.sm_weight}} Kg</span></p>
                                <p>目标年产量：<span>{{getzhz.year_weight}} Kg</span></p>
                                <p></p>
                                <p></p>
                            </td>
                        </tr>
                    </table>

                    <p class="newfontp" style="line-height:40px;">时间</p>
                    <p>定制时间：<span>{{getzhz.grow_date}}</span></p>
                    <p>预计采收期：<span>{{getzhz.estimate_get_date_1}} 至 {{getzhz.estimate_get_date_2}}</span></p>
                    <p style="line-height:50px; font-weight:bold;">所有者费用预估：{{getzhz.total_cost}} 元</p>

                </div>

            </div>
            <!--
            <div class="layer-add-form-bottom">
                <span style="padding:10px 12px; float:left;display:inline;">种植任务{{newnid}}</span>
		    </div>
            -->
        </div>
    </div>

</div>
</template>
<script>
export default {
  data(){
      return {
        
        amyjob:[],
        getplanid:'',
        getpsid:'',
        newnid:'',
        getnewman:'',
        getzhz:[],
        abid:'',
        countsun:'',
        
      }
  },

  mounted:function(){

     this.getplanid=this.$route.query.id;
     this.getpsid=this.$route.query.psid;
     this.getnewman=this.$route.query.newman;
     this.abid=this.$route.query.woid;

     this.getplandata(); 
  },
  
  methods:{

     getplandata:function(){
        var planid =this.getplanid;
        var psid=this.getpsid;
        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/product/Progrowtask/progrowtask_list";
        jsonData.plan_id=planid;
        jsonData.ps_id=psid;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.amyjob = re.data;
        var ac=re.data.task_info;
            var sum=0;
            for(var i=0;i<ac.length;i++){
                sum+=ac[i]['year_weight'];     
            }
        this.countsun=sum;

        /*
        sendData.url ="27.221.53.90:880/index.php/product/Progrowtask/progrowtask_list";
        jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
        jsonData.phone = "18114158894";

        jsonData.plan_id=planid;
        jsonData.ps_id=psid;

        sendData.data = jsonData;
        $.ajax({
            url: "http://www.pc200.com/router.php",
            data: sendData,
            dataType: "Json",
            success: function(msg) {     
            this.amyjob = msg.data;
            //执行求 总产量的操作
            var ac=msg.data.task_info;
            var sum=0;
            for(var i=0;i<ac.length;i++){
                sum+=ac[i]['year_weight'];     
            }
            this.countsun=sum;

            //console.log(sum);
            //console.log(msg.data);
            }.bind(this),
            error: function(msg) {
            //alert("错误");
            }
        });
        */
              
     }, 


    addjob(tid,newindex){
        
        this.newnid=newindex;
        layer.open({
			type: 1,
			title: false,
			area: ["1100px", "564px"],
			closeBtn: 0,
			shadeClose: true,
			skin: "layer-add-forma",
			content:$("#addjob"),		
        });
        

        //获取种植任务的接口

        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/product/Progrowtask/task_pcdetail";
        jsonData.plan_id =this.getplanid;
        jsonData.ps_id =this.getpsid;
        jsonData.t_id=tid;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.getzhz = re.data;
        /*
        sendData.url ="27.221.53.90:880/index.php/product/Progrowtask/task_pcdetail";
        jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
        jsonData.phone = "18114158894";
        jsonData.plan_id =this.getplanid;
        jsonData.ps_id =this.getpsid;
        jsonData.t_id=tid;

        sendData.data = jsonData;
        $.ajax({
            url: "http://www.pc200.com/router.php",
            data: sendData,
            dataType: "Json",
            success: function(msg) {
            this.getzhz = msg.data;
            }.bind(this),
            error: function(msg) {
            //alert("错误");
            }
        });
        */


    },



  }
}
</script>
<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }

.maininfodiv{ margin:30px; }
.maininfodiv p{font-weight: bold; line-height: 40px; font-size:16px; color:#555;}
.maininfodiv p span{color:#000; font-weight:normal;}

.maingropinfo{ width: 100%; height:280px; }
.maingropinfoleft{ float: left; display: inline;  }

.maingropinforight{ float: left; display: inline; margin-left: 100px; text-align: left; }
.maingropinfolefttop{ height: 120px; }

.mainlistinfo{ width:100%; height: auto;  }
.divulli{ width: 100%; height: auto; }
.divulli ul{ margin-left: -45px; height: auto; width: 105%; float: left; display:inline; }
.divulli ul li{ float: left; display: inline; margin-left:36px; margin-top: 20px; width: 320px; height: 330px; padding-left:30px; padding-top:30px;   background-color: #fff; box-shadow:0px 1px 2px #dedede;border-radius:8px; border:1p solid red; }
.divulli ul li p{ font-size: 14px; line-height: 36px;}

.mainlistinfo-bot{ width:100%; height: 120px; margin-top: 20px;  float: left; display: inline; }
.mainlistinfo-bot h4{ font-weight: bold;}
.mainlistinfo-bot p{ font-weight: normal;}
.mainlistinfo-bot p span{ color: #222;}

.layer-add-forma{ width: 1100px; height: 564px;}
.newmainnei{ padding: 50px 70px;  }
.newmainnei td{ padding: 20px 30px;}
.newmainnei td p{ line-height: 40px;}

.tabletrtd p{ height: 40px; line-height: 40px; }
.newfontp{ font-weight: bold;  color: #333;}

.layer-add-form-bottom {
  width: 100%;
  position: absolute;
  bottom: 0px;
}
</style>
