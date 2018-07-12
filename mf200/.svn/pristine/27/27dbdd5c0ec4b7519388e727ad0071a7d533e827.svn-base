<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;  }
.h4span-r{ float: right; margin-top:10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }

.plandivadd {
  margin: 30px 50px;
  padding: 30px;
}

.plandivaddleft {
  float: left;
  display: inline;
  width: 50px;
  height: auto;
  margin-right: 20px;
}
.plandivaddright {
  float: left;
  display: inline;
  height: auto;
}

.plandivaddleft-top {
  width: 50px;
  height: 40px;
}
.plandivaddleft-yuan {
  width: 40px;
  height: 40px;
  border-radius: 20px;
  line-height: 40px;
  background-color: #d0dadc;
  text-align: center;
  vertical-align: middle;
  float: left;
  display: inline-block;
}
.plandivaddleft-yuan img {
  width: 18px;
  height: 24px;
}

.plandivaddleft-yuana {
  width: 40px;
  height: 40px;
  border-radius: 20px;
  line-height: 40px;
  background-color: #d0dadc;
  text-align: center;
  vertical-align: middle;
  float: left;
  display: inline-block;
}
.plandivaddleft-yuana img {
  width: 18px;
  height: 24px;
}
.plandivaddleft-yuanb {
  width: 40px;
  height: 40px;
  border-radius: 20px;
  line-height: 40px;
  background-color: #d0dadc;
  text-align: center;
  vertical-align: middle;
  float: left;
  display: inline-block;
}
.plandivaddleft-yuanb img {
  width: 18px;
  height: 24px;
}


.plandivaddleft-jiantou {
  width: 0;
  height: 0;
  border-top: 3px solid transparent;
  border-left: 6px solid #d0dadc;
  border-bottom: 3px solid transparent;
  float: right;
  display: inline-block;
  margin-top: 17px;
}
.plandivaddleft-jiantoua {
  width: 0;
  height: 0;
  border-top: 3px solid transparent;
  border-left: 6px solid #d0dadc;
  border-bottom: 3px solid transparent;
  float: right;
  display: inline-block;
  margin-top: 17px;
}
.plandivaddleft-jiantoub {
  width: 0;
  height: 0;
  border-top: 3px solid transparent;
  border-left: 6px solid #d0dadc;
  border-bottom: 3px solid transparent;
  float: right;
  display: inline-block;
  margin-top: 17px;
}


/*right*/
.plandivaddright {
  float: left;
  display: inline;
  height: auto; 
}
.rightzh{ line-height: 38px; color:#f3a753;}
.rightzhspan{ width:146px; padding: 0px 12px; border-radius:15px; margin: 6px 0px; text-align:center; line-height: 30px;color: #fff; display: block; height: 30px; background-color:#b0c777;  }
.rightzhspan option{ background-color:#fff; color: #666; }

.plandivaddright-one{ width: 1100px; height:260px; padding-left:50px;  }

.maintwo{width: 1100px; height:500px; }
.maintwo{width: 1100px; height:500px; }
.maintwo li{ float: left ; width: 100%; height:66px;  }
.chooserenwu{ width:100%; height:100%; padding: 6px 0px;  }
.chooserenwubg{ background-color:#fff; border-radius:10px; box-shadow: 0px 0px 5px #e2e2e2; padding: 20px 30px; }

.chdiva{ float: left; display: inline; width: 230px; margin-top: 20px;  }
.chdiva p{ line-height: 30px; }

</style>

<template>
<div id="left-box">
    <div style=" width: 100%; height: 100%;" >
        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">工单管理&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;发布工单</span>&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;模式二</span></font>
            <span class="h4span-r" style="background-color:#b0c777;">返 回</span>
            <span class="h4span-r" v-on:click="dosave()">发 布</span>
        </h4>
        </div> 

        <div class="plandivadd">
            <!--left-->
            <div class="plandivaddleft">
                <div class="plandivaddleft-top">
                    <div class="plandivaddleft-yuan" >
                        <img src="/lib/img/public/cropmode/tubiaoliebiao.png">
                    </div>
                    <i class="plandivaddleft-jiantou" style="float:right; display:inline;"></i>
                </div>

                <div class="plandivaddleft-top-xian hide" style="height:426px; width:5px; margin-left:18px; background-color:#b1c677;" ></div>
                <!-- 中头部 -->
               
                    <div class="plandivaddleft-top hide">
                        <div class="plandivaddleft-yuana" >
                            <img src="/lib/img/public/cropmode/tubiaoquxian.png" >
                        </div>
                        <i class="plandivaddleft-jiantoua" style="float:right; display:inline;"></i>
                    </div>
                    <div class="plandivaddleft-top-xiana hide" style=" height:490px; width:5px; margin-left:18px; background-color:#b1c677;"></div>
                
                <!--底 头部-->
              
                <div class="plandivaddleft-bot hide">
                    <div class="plandivaddleft-yuanb">
                      <img src="/lib/img/public/cropmode/tubiaoren.png">
                    </div>
                    <i class="plandivaddleft-jiantoub" style="float:right; display:inline;"></i>
                </div>

            </div>
            <!--left-->

            <!--right-->
            <div class="plandivaddright">
                    <div id="plan">
                        <h4 class="rightzh">选择生产计划</h4>
                        <select class="rightzhspan" style="width:174px;" v-on:change="chooseplanidb($event.target)" id="planselect">
                            <option style="color:#666;" value="0">请选择生产计划</option>
                            <option style="color:#666;" v-for="jihua in shujub" v-bind:value="jihua.plan_id">{{jihua.plan_name}}</option>
                        </select>
                    </div>

                    <div class="chooserenwu">
                        <h4 class="rightzh">选择种植任务</h4>
                        <select class="rightzhspan" style="width:174px;" v-on:change="choosegrowb($event.target)" >
                            <option style="color:#666;" value="0">请选择种植任务</option>
                            <option v-for="renwu in zhzhb" v-bind:value="renwu.t_id">{{renwu.t_name}}</option>
                        </select>
                    </div>

                    <div class="chooserenwu hide" id="yincang">
                        <h4 class="rightzh">选择种植区域</h4>
                        <select class="rightzhspan" style="width:174px;" v-on:change="choosegrowc($event.target)" >
                            <option style="color:#666;" value="0">请选择种植区域</option>
                            <option v-for="nlistquyu in quyub" v-bind:value="nlistquyu.area_id">{{nlistquyu.area_name}}</option>
                        </select>
                    </div>

                    <div class="chooserenwu hide" id="bai">
                        <div class="chooserenwubg" style="width:780px; height:180px;">

                            <h4>负责人：{{orderb.work_name}}</h4>

                            <div class="chdiva">
                                <p>作物：{{orderb.parent_name }}</p>
                                <p>品种：{{orderb.child_name}}</p>
                                <p>果形：{{orderb.type_info}}</p>
                            </div>

                            <div class="chdiva">
                                <p>果色：{{orderb.color_info}}</p>
                                <p>株距：{{neworderb.zhu_ju}}  cm</p>  
                                <p>行距：{{neworderb.hang_ju}} cm</p>
                               
                            </div>

                            <div class="chdiva">
                                <p>种植模式：{{orderb.mode_name}}</p>
                                <p>定植数量：{{neworderb.total_grow_num}}</p>
                                <p>定植时间：{{neworderb.grow_date}}</p>
                            </div>

                        </div>
                    </div>

                <!--right 第二部分-->
               
                <div class="maintwo" >

                    <h4 class="rightzh">选择工序</h4>
                    <p>
                        <select class="form-control" style="width:160px;" id="chgongxu" v-on:change="hqgongxu($event.target)">
                            <option v-for="gongxulist in gongxub" v-bind:value="gongxulist.skill_id">{{gongxulist.skill_name}}</option>
                        </select>
                    </p>

                    <p style="width:100%; margin-top:16px; ">
                        <div class="" style=" float:left; display:inline;">
                            <label style="display:block;">工作量</label>
                            <input class="form-control" id="chgongzuoliang" style="width:160px; display:inline-block;" name="gongzuoliang" value="" />
                        </div>

                        <div style="float:left; display:inline; margin-left:50px; ">
                            <label style="display:block;">工序单位</label>
                            
                            <select name="" class="form-control" style="width:160px; display:inline-block;" id="chdanwei" name="danwei">
                                <option v-for="strlist in newstrb">{{strlist}}</option>
                            </select>

                        </div>
                        <div style="clear:both"></div>
                    </p>

                    <p style="width:100%; margin-top:16px; ">
                        <div class="" style=" float:left; display:inline;">
                            <label style="display:block;">工作日期</label>
                            <input class="form-control" style="width:160px; display:inline-block;" id="chdotime" name="gongzuoriqi" type="date" value="" />
                        </div>

                        <div style="float:left; display:inline; margin-left:50px; ">  
                            <label style="display:block;">时间</label>
                            <input class="form-control" style="width:160px; display:inline-block;" id="chb_time" name="gongzuoriqi" type="time" value="" /> 
                            <label style="display:inline-block;">至</label> 
                            <input class="form-control" style="width:160px; display:inline-block;" id="cho_time" name="gongzuoriqi" type="time" value="" />
                        </div>

                        <div style="float:left; display:inline; margin-left:50px; ">
                            <label style="display:block;">持续天数</label>
                            <input class="form-control" value="" id="chday" style="display:inline-block; width:160px;" /> <label style="display:inline-block;"> 天</label>
                        </div>

                        <div style="clear:both"></div>
                    </p>

                    <ul>
                        <li style="width:100%; margin-top:16px;">
                            <div class="" style=" float:left; display:inline;">
                                <label style="display:block;">工人</label>
                                <select class="form-control" style="width:160px;display:inline-block;" id="chworker0">
                                    <option value="0">请选择工人</option>
                                    <option v-for="listmanallb in manallb" v-bind:value="listmanallb.worker_id">{{listmanallb.worker_name}}</option>
                                </select>
                            </div>

                            <div class="" style=" float:left; display:inline; margin-left:50px;">
                                <label style="display:block;">工作量</label>
                                <input class="form-control" value="" id="chgz0" style="display:inline-block; width:160px;" />
                                <label style="width:60px; display:inline-block;" v-on:click="dotianjia(ynum++)"><img src="/lib/img/public/cropmode/jiajia.jpg" /></label>
                            </div>
                        </li>
                    </ul>
                    
                </div>
                
            </div>     
            <!--right-->
        </div>    

    </div>

</div>
</template>

<script>
export default {
  data(){
    return {

        shujub:[],
        gongxub:[],
        palnidb:'',
        zhzhb:[],
        areaid:'',
        sid:'',
        atidb:'',
        orderb:[],
        neworderb:[],
        manallb:[],
        quyub:[], 
        newstrb:[],
        ynum:1,
        oknum:'',
        state:'',
        
    }
  },

  mounted: function() {

    this.getnewinfob();
    this.getgongxub();//获取工序接口

   },

  methods: {
    
    getnewinfob(){//获取生产计划

        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/pc/Work/get_work_plan";
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        if(re.state == 1){
            this.shujub=re.data;
        }else{
            $('#plan').hide();
            this.zhzhb=re.data; 
        }
    },

    //获取工序
    getgongxub(){

        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/baseset/Skill/skill_list";
        jsonData.group_id=2;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.gongxub=re.data;
    },

    //工序单位下拉制作
    hqgongxu(obja){

       var skillid=obja.value;
       this.sid=obja.value;
       var skillall=this.gongxub;
       var that=this;
       for(var i=0;i<skillall.length;i++){
          if(skillid==skillall[i]['skill_id']){
              //console.log(quyuall[i]['area_id']);
              var unitstr = skillall[i]['unit_str'];
              that.newstrb = unitstr.split(',');
          }
       }
    },


    chooseplanidb(obj){//或得种植任务

        this.palnidb=obj.value;
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/pc/Work/get_plan_order";
        jsonData.plan_id=this.palnidb;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.zhzhb=re.data;
        //console.log(this.zhzh);
    },
    

    choosegrowb(newobj){
        //获取参数
        var tid=newobj.value;
        this.atidb=newobj.value;
        var main=this.zhzhb;
        for(var i=0;i<main.length;i++){
            if(main[i]['t_id']==tid){
               var catid = main[i]['cat_id'];
               var addworkerid = main[i]['add_worker_id'];

            }  
        }
        // console.log(this.palnid);
        // console.log(tid);
        // console.log(catid);
        // console.log(addworkerid);
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/pc/Work/get_plan_orderinfo";
        jsonData.t_id=tid;
        jsonData.cat_id=catid;
        jsonData.add_worker_id=addworkerid;

        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.orderb=re.data;
        this.neworderb=re.data.grow_task;
        this.manallb=re.data.work_info;//获取工人数据
        this.quyub=re.data.area_info; //获取种植区域信息

        if(re.status==1){
           
            $("#yincang").removeClass("hide");
            
        }else{
            layer.msg("数据异常");
        }
    },

    choosegrowc(obj){
        this.areaid=obj.value;
        $("#bai").removeClass("hide");
        $(".plandivaddleft-yuan").fadeIn(2500).css("background-color","#b0c777");
        $(".plandivaddleft-top-xian").fadeIn(3500).removeClass("hide");
        $(".plandivaddleft-top").fadeIn(2500).removeClass("hide");
        $(".maintwo").fadeIn(3500).removeClass("hide"); 
    },

    dotianjia(dnum){
        this.oknum=dnum;
        $(".maintwo ul").append("<li style='width:100%; margin-top:16px;' id=delli"+dnum+"><div style='float:left; display:inline;'><label style='display:block;'>工人</label><select class='form-control' style='width:160px;display:inline-block;' id=chworker"+dnum+"><option value='0'>请选择工人</option></select></div><div style='float:left; display:inline; margin-left:50px;'><label style='display:block;'>工作量</label><input class='form-control' id=chgz"+dnum+" value='' style='display:inline-block; width:160px;' /><label style='width:60px; margin-left:5px; display:inline-block;'><img src='/lib/img/public/cropmode/jianjian.png' id=dono"+dnum+" /></label></div></li>")
        .find("#dono"+dnum).click(function(){
            $("#delli"+dnum).remove();
        });
        
        var eveman=this.manallb;
        for(var i=0;i<eveman.length;i++){
            var op="<option value="+eveman[i]['worker_id']+">"+eveman[i]['worker_name']+"</option>";
            $("#chworker"+dnum).append(op);
        }

    },


    dosave(){
        var endnum=this.oknum+1;
        var planid=$("#planselect").val();
        var endgongxu=$("#chgongxu").val();
        var endgongzuoliang=$("#chgongzuoliang").val();
        var enddanwei=$("#chdanwei").val();
        var enddotime=$("#chdotime").val();
        var endb_time=$("#chb_time").val();
        var endo_time=$("#cho_time").val();
        var endday=$("#chday").val();
        
        // 工人id 的字符串拼接 
        var str = "";var strnum = "";
        for(var i=0; i<endnum;i++){
            if($("#chworker"+i).val() != 0 || $("#chgz"+i).val() != ''){
                if($("#chworker"+i).val() == 0 && $("#chgz"+i).val() == ''){
                    layer.msg('请完善工人信息');return;
                }
                if($("#chworker"+i).val() != 0 && $("#chgz"+i).val() == ''){
                    layer.msg('请完善工人工作量信息');return;
                }
                str += $("#chworker"+i).val() + ",";
                strnum += $("#chgz"+i).val() + ",";
            }

        }
        if (str.length > 0) {

            str = str.substr(0, str.length - 1);
            strnum = strnum.substr(0, strnum.length - 1);

        }
        //console.log(str);
        //console.log(strnum);

        var sendData={};
		var jsonData={};
        sendData.url="index.php/pc/WorkerOrder/confirm";

        jsonData.t_id=this.atidb;
        jsonData.plan_id=planid;
        jsonData.area_id=this.areaid;
        jsonData.skill_id=endgongxu;
        jsonData.worknum=endgongzuoliang;
        jsonData.unit_name=enddanwei;
        jsonData.date=enddotime;
        jsonData.s_time=endb_time;
        jsonData.e_time=endo_time;
        jsonData.day=endday;
        jsonData.worker_id=str;
        jsonData.num=strnum;
        
        sendData.data=jsonData;
		var re = getFaceInfo(sendData);
        if(re.status==1){
            layer.msg(re.msg,{time:1500},function(){
                window.location.href = "#/worker/workerorder/order_list";
            });
        }else{
            layer.msg(re.msg);
        }
    },

   

  },
}
</script>
