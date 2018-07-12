<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

       <h4 style="font-weight:bold;">种植任务
           <span class="h4span-r">设为首页</span>
           <span class="h4span-r" style="background-color:#b0c777;">添加种植任务</span>
       </h4>


        <div class="newnav" style="border-bottom:1px solid #d0dadc; height:42px;">
    
               <ul id="myTab" class="nav nav-tabs" style="border:none;" >

                    <li v-for="title in joballtitle" v-on:click="chooseid(title.ps_id,title.plan_id,title.fbr_name,title.fbr_name,title.ps_name)">
                        <A v-bind:href='"#"+title.ps_id' data-toggle="tab">{{title.ps_name}}</A>
                    </li>

                    <!--
                    <li class="active"><a href="#home" data-toggle="tab">我的任务1</a></li>
                    <li><a href="#ios" data-toggle="tab">我的任务2</a></li>
                    <li><a href="#a" data-toggle="tab"> 我的任务3</a></li>
                    <li><a href="#b" data-toggle="tab"> 我的任务4</a></li>
                    <li><a href="#c" data-toggle="tab"> 我的任务5</a></li>
                    <li><a href="#d" data-toggle="tab"> 我的任务6</a></li>
                    -->
                    
                </ul>
        </div>
        
        <div id="myTabContent" class="tab-content">

            <div class="tab-pane fade in active"  v-bind:id="pid" >
                <div class="maininfodiv">
                    <h4 style="color:#f2a553; line-height:50px; ">{{tit}}</h4>
                    <p>生产计划发布人：<span>{{fbr}}</span></p>
                    <p>生产计划负责人：<span>{{fzr}}</span></p>

                    <div class="maingropinfo">

                        <div class="maingropinfoleft">
                            <div class="maingropinfolefttop">
                            <p>作物基本信息</p>
                            <p style="font-weight:normal; color:#666;">作物：<span>{{amyjob.cat_name}}</span> &nbsp;&nbsp;&nbsp;&nbsp;果型：<span>{{amyjob.ftype}}</span> &nbsp;&nbsp;&nbsp;&nbsp;果色：<span>{{amyjob.fcolor}}</span> &nbsp;&nbsp;&nbsp;&nbsp;品种：<span>{{amyjob.cat_p_name}}</span></p>
                            <p style="font-weight:normal; color:#666;">描述：<span>{{amyjob.cat_desc}}</span></p>
                            </div>
                            <p>产量预估</p>
                            <p style="font-weight:normal;">总产量预估：<span>{{amyjob.p_amount}} kg</span> &nbsp;&nbsp;&nbsp;&nbsp;日产量预估：{{amyjob.plan_estimate_amount_one_date}} Kg</p>
                        </div>

                        <div class="maingropinforight">
                            <div class="maingropinfolefttop">
                            <p>时间信息</p>
                            <p style="font-weight:normal; color:#666;">定植时间：<span>{{amyjob.grow_date}}</span> &nbsp;&nbsp;&nbsp;&nbsp;采收期：<span>{{amyjob.estimate_get_date_1}} 至 {{amyjob.estimate_get_date_2}}</span> </p>
                            </div>
                            <p>种植面积：<span>{{amyjob.grow_mianji_mu}} 亩</span></p>   
                        </div>
                        <div style="clear:both;"></div>
                    </div>

                    <div class="mainlistinfo">
                        <h4 style="color:#f2a553; line-height:50px; ">种植任务</h4>
                        <div class="divulli">
                            <ul>
                                <li v-for="(newlist,index) in amyjob.task_list" v-on:click="addjob(newlist.t_id,index+1)">

                                    <h4 style=" text-align:center; margin-top:30px; ">种植任务{{index+1}}</h4>
                                    <p style="margin-top:10px;">种植模式：<span>{{newlist.mode_name}}</span></p>
                                    <p>种植区域：<span>{{newlist.area_name}}</span></p>
                                    <p>任务预计产量：<span>{{newlist.task_weight_1}} kg</span></p>
                                    <p>任务费用预估：<span>{{newlist.total_cost}} 元</span></p>
                                    <p>种植任务负责人：<span>{{newlist.worker_name}}</span></p>

                                </li>
                                <!--
                                <li>

                                    <h4 style=" text-align:center; margin-top:30px; ">种植任务1</h4>
                                    <p style="margin-top:10px;">种植模式：<span>椰康栽培</span></p>
                                    <p>种植模式：<span>椰康栽培</span></p>
                                    <p>任务预计产量：<span>500 kg</span></p>
                                    <p>任务费用预估：<span>5000 元</span></p>
                                    <p>种植任务负责人：<span>王五</span></p>

                                </li>
                                -->
                                <li style="text-align:center;">
                                    <A v-bind:href="'#/product/planttask/planttask_add?planid='+plid+'&psid='+pid">
                                        <img src="/lib/img/public/cropmode/shizi.jpg" style="margin-top:50px;" />
                                        <h4 style="line-height:80px;">添加种植任务</h4>
                                    </a>
                                </li> 
                            </ul>
                            

                             <div class="mainlistinfo-bot">
                                <h4>总计</h4>
                                <p>所有任务预计产量之和：3000 kg</p>
                                <p>所有任务费用预估之和：30000 元</p>
                             </div>

                        </div>

                    </div>
                </div>  
            </div>
                    
        </div>


    
    <!--弹框显示-->

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
            
            <div class="layer-add-form-bottom">
                <span style="padding:10px 12px; float:left;display:inline;">种植任务{{newnid}}</span>
		    </div>

        </div>
    </div>

    <!--弹框结束-->


    </div>
</div>
</template>
<script>
export default {

  data(){
    return{
        joballtitle:[],
        pid:'',
        plid:'',
        fzr:'',
        amyjob:[],
        fbr:'',
        tit:'',
        getzhz:[],
        newnid:''
    }
  },
  
  mounted:function(){
      this.getmyjobtitle();   
  },
  
  methods:{

    getmyjobtitle:function(){
        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/product/ProductPlanNew/p_son_all";
        jsonData.type=1;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.joballtitle = re.data;

        /*
        sendData.url ="27.221.53.90:880/index.php/product/ProductPlanNew/p_son_all";
        jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
        jsonData.phone = "18114158894";
        jsonData.type=1;
        sendData.data = jsonData;
        $.ajax({
            url: "http://www.pc200.com/router.php",
            data: sendData,
            dataType: "Json",
            success: function(msg) {
            this.joballtitle = msg.data
            //console.log(msg.data);
            }.bind(this),
            error: function(msg) {
            //alert("错误");
            }
        });*/
    },

    chooseid(getpsid,getplanid,getfzr,getfbr,psname){
        this.plid=getplanid;
        this.pid=getpsid;
        this.tit=psname;
        this.fzr=getfzr;
        this.fbr=getfbr;
        //console.log(this.id);
        //种植任务获取
        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/product/ProductPlanNew/product_son_detail";
        jsonData.plan_id=getplanid;
        jsonData.ps_id=getpsid;
        
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.amyjob = re.data;
        /*
        sendData.url ="27.221.53.90:880/index.php/product/ProductPlanNew/product_son_detail";
        jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
        jsonData.phone = "18114158894";

        jsonData.plan_id=getplanid;
        jsonData.ps_id=getpsid;
        
        sendData.data = jsonData;
        $.ajax({
            url: "http://www.pc200.com/router.php",
            data: sendData,
            dataType: "Json",
            success: function(msg) {     
            this.amyjob = msg.data;
            //console.log(this.amyjob);
            }.bind(this),
            error: function(msg) {
            //alert("错误");
            }
        });*/

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
        jsonData.plan_id =this.plid;
        jsonData.ps_id =this.pid;
        jsonData.t_id=tid;

        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.getzhz = re.data;

        /*
        sendData.url ="27.221.53.90:880/index.php/product/Progrowtask/task_pcdetail";
        jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
        jsonData.phone = "18114158894";
        jsonData.plan_id =this.plid;
        jsonData.ps_id =this.pid;
        jsonData.t_id=tid;

        sendData.data = jsonData;
        $.ajax({
            url: "http://www.pc200.com/router.php",
            data: sendData,
            dataType: "Json",
            success: function(msg) {
            this.getzhz = msg.data
            console.log(msg.data);
            }.bind(this),
            error: function(msg) {
            //alert("错误");
            }
        });
        */

    },

  },
  

}
</script>
<style scoped>

.h4span-r{ float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; padding: 9px 16px; border-radius:3px; margin-left: 20px;  }
.maininfodiv{ margin:30px; }
.maininfodiv p{font-weight: bold; line-height: 40px; font-size:16px; color:#555;}
.maininfodiv p span{color:#000; font-weight:normal;}

.maingropinfo{ width: 100%; height:210px; }
.maingropinfoleft{ float: left; display: inline;  }

.maingropinforight{ float: left; display: inline; margin-left: 100px; text-align: left; }
.maingropinfolefttop{ height: 120px; }

.mainlistinfo{ width:100%; height: auto;  }
.divulli{ width: 100%; height: auto; }
.divulli ul{ margin-left: -20px; height: auto; width: 100%; float: left; display:inline; }
.divulli ul li{ float: left; display: inline; margin-left:20px; width: 276px; height: 242px; background-color: #fff; box-shadow:0px 1px 2px #dedede;border-radius:8px; }
.divulli ul li p{ margin-left: 46px; font-size:14px; color: #666; font-weight:normal; line-height:32px;  }

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
