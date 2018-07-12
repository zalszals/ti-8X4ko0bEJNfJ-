<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top: 10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }

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
.rightzh{ line-height: 38px; margin-top: 6px; color:#f3a753;}
.rightzhspan{ min-width:146px; padding: 0px 12px; border-radius:15px; color: #fff;  text-align:center; line-height: 30px;display: block; height: 30px; background-color:#b0c777;  }
.rightzhspan option{ background-color:#fff; }
.plandivaddright-one{ width: 1100px; height:260px; padding-left:50px;  }
.maintwo{ width: 1100px; height:auto; }

.chooserenwu{ width:100%; height:100%; padding: 6px 0px;  }
.chooserenwubg{ background-color:#fff; border-radius:10px; box-shadow: 0px 0px 5px #e2e2e2; padding: 20px 30px; }
.chdiva{ float: left; display: inline; width: 230px; margin-top: 20px;  }
.chdiva p{ line-height: 30px; }
.nenn{ width: 100%; height: auto; }
.nenn li{ height: 250px; float: left; display: inline;  width: 100%; }

</style>
<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >
        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">工单管理&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;发布工单</span>&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;模式一</span></font>
            <span class="h4span-r" style="background-color:#b0c777;" @click="$router.back(-1)">返 回</span>
            <span class="h4span-r" v-on:click="dasave()">发 布</span>
        </h4>
        </div> 

        <div class="plandivadd" >
            <!--left-->
            <div class="plandivaddleft">
                <div class="plandivaddleft-top" style="margin-top: 6px;">
                    <div class="plandivaddleft-yuan" >
                        <img src="/lib/img/public/cropmode/tubiaoliebiao.png">
                    </div>
                    <i class="plandivaddleft-jiantou" style="float:right; display:inline;"></i>
                </div>

                <div class="plandivaddleft-top-xian hide" style=" height:332px; width:5px; margin-left:18px; background-color:#b1c677;"></div>
                <!-- 中头部 -->
               
                    <div class="plandivaddleft-top hide">
                        <div class="plandivaddleft-yuana" >
                            <img src="/lib/img/public/cropmode/tubiaoquxian.png" >
                        </div>
                        <i class="plandivaddleft-jiantoua" style="float:right; display:inline;"></i>
                    </div>
                    <div class="plandivaddleft-top-xiana hide" style=" height:480px; width:5px; margin-left:18px; background-color:#b1c677;"></div>
                
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
                    <div id="plandd">
                        <h4 class="rightzh">选择生产计划</h4>
                        <select class="rightzhspan" style="width:174px;" v-on:change="chooseplanid($event.target)" id="plan">
                            <option style="color:#666;" value="0">请选择生产计划</option>
                            <option style="color:#666;" v-for="jihua in shuju" v-bind:value="jihua.plan_id">{{jihua.plan_name}}</option>
                        </select>
                    </div>

                    <div class="chooserenwu">
                        <h4 class="rightzh">选择种植任务</h4>
                        <select class="rightzhspan" style="width:174px;" v-on:change="choosegrow($event.target)" id="task">
                            <option style="color:#666;" value="0">请选择种植任务</option>
                            <option style="color:#666;" v-for="renwu in zhzh" v-bind:value="renwu.t_id">{{renwu.t_name}}</option>
                        </select>
                    </div>

                    <div class="chooserenwu hide" id="bai">
                        <div class="chooserenwubg" style="width:780px; height:180px;">

                            <h4>负责人：{{order.work_name}}</h4>

                            <div class="chdiva">
                                <p>作物：{{order.parent_name }}</p>
                                <p>品种：{{order.child_name}}</p>
                                <p>果形：{{order.type_info}}</p>
                            </div>

                            <div class="chdiva">
                                <p>果色：{{order.color_info}}</p>
                                <p>株距：{{neworder.zhu_ju}}  cm</p>  
                                <p>行距：{{neworder.hang_ju}} cm</p>
                               
                            </div>

                            <div class="chdiva">
                                <p>种植模式：{{order.mode_name}}</p>
                                <p>定植数量：{{neworder.total_grow_num}}</p>
                                <p>定植时间：{{neworder.grow_date}}</p>
                            </div>

                        </div>
                    </div>

                <!--right 第二部分-->

                <div class="maintwo" >

                    <h4 class="rightzh">选择人员</h4>
                    <p>
                        <select class="form-control" style="width:160px;" id="workerid">
                            <option style="color:#666;" value="0">请选择工人</option>
                            <option v-for="manlist in manall"  v-bind:value="manlist.worker_id">{{manlist.worker_name}}</option>
                        </select>
                    </p>

                    <ul class="nenn">
                        <li style="width:100%; margin-top:20px; height:250px;" id="adddiv">
                            <p style="width:100%; ">
                                <div class="" style=" float:left; display:inline;">
                                    <label style="display:block;">种植区域</label>
                                    <select class="form-control" style="width:160px;display:inline-block;" v-on:change="dold($event.target)"  name='quyu' id="quyu0">
                                        <option value="0">请选择区域</option>
                                        <option v-for="listquyu in quyu" v-bind:value="listquyu.area_id">{{listquyu.area_name}}</option>
                                    </select>
                                    <label style="width:60px; display:inline-block;" v-on:click="doadd(adnum++)"><img src="/lib/img/public/cropmode/jiajia.jpg" /></label>
                                </div>

                                <div style="float:left; display:inline; margin-left:50px; ">
                                    <label style="display:block;">定植数量</label>
                                    <input class="form-control" style="width:160px; display:inline-block;" name="shuliang" id="shuliang0" v-bind:value="newnum" /><label style="display:inline-block;">株</label>
                                </div>
                                <div style="clear:both"></div>
                            </p>
                        
                            <p style="margin-top:30px;width:100%;">
                                <div class="" style="float:left; display:inline;">
                                    <label style="display:block;">工序</label>
                                    <select class="form-control" style="width:160px;display:inline-block;"  name="gongxu" id="gongxu0" v-on:change="quskill($event.target)">
                                        <option v-for="gongxulist in gongxu" v-bind:value="gongxulist.skill_id">{{gongxulist.skill_name}}</option>
                                    </select>
                                    <!--<label style="width:60px; display:inline-block;"><img src="/lib/img/public/cropmode/jiajia.jpg" /></label>-->
                                </div>
                                <div style=" float:left; display:inline; margin-left:110px; width:230px;">
                                    <p>
                                    <label style="display:block;">工序单位</label>
                                    <select name="" class="form-control" id="gxunit0" name="danwei">
                                        <option v-for="strlist in newstr">{{strlist}}</option>
                                    </select>
                                    </p>

                                    <p style="margin-top:20px;">
                                    <label style="display:block;">时间</label>
                                    <input name="b_time" type="time" id="b_time0" class="form-control" style="width:100px;display:inline-block;" /> <label style="display:inline-block;">至</label> 
                                    <input name="o_time" type="time" id="o_time0" class="form-control" style="width:100px;display:inline-block;" />
                                      
                                    </p>
                                </div>

                                <div style="float:left; display:inline; margin-left:40px;">
                                    <p>
                                        <label style="display:block;">工作量</label>
                                        <input class="form-control" name="gongzuoliang" id="gongzuoliang0" placeholder="请输入工作量"/>
                                    </p>
                                    <p style="margin-top:20px;">
                                        <label style="display:block;">开始时间</label>
                                        <input name="do_time" id="do_time0" type="date" class="form-control" />       
                                    </p> 
                                </div>
                                
                                <div style="float:left; display:inline; margin-left:40px;">
                                    <label style="display:block;">持续天数</label>
                                    <input class="form-control" name="day" id="day0" value="" style="display:inline-block; width:160px;" /> <label style="display:inline-block;"> 天</label>
                                </div>

                            </p>
                            <div style="clear:both"></div>
                        </li>
                        <div style="clear:both"></div>
                    </ul>
                </div>

            </div>     
            <!--right-->
            <div style="clear:both"></div>

        </div>    

    </div>

</div>
</template>

<script>
export default {
   
   data(){
       return {
           shuju:[],
           palnid:'',
           atid:'',
           zhzh:[],
           order:[],
           neworder:[],
           gongxu:[],
           manall:[],
           quyu:[],
           adnum:1,
           newnum:'',
           newstr:[],
           //newstra:[],
           newaddid:'',
           state:'',
           
       }
   },
   
   mounted: function() {
    this.getnewinfo();
    this.getgongxu();//获取工序接口

   },

   methods: {
    
    getnewinfo(){

        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/pc/Work/get_work_plan";
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.state = re.state;
        if(re.state == 1){
            this.shuju=re.data;
        }else{
            $('#plandd').hide();
            this.zhzh=re.data; 
        }
    },

    //获取工序
    getgongxu(){

        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/baseset/Skill/skill_list";
        jsonData.group_id=2;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.gongxu=re.data;

    },
  
    
    chooseplanid(obj){

       this.palnid=obj.value;
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/pc/Work/get_plan_order";
        jsonData.plan_id=this.palnid;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.zhzh=re.data;
        //console.log(this.zhzh);
    },

    choosegrow(newobj){
        //获取参数
        var tid=newobj.value;
        this.atid=newobj.value;
        var main=this.zhzh;
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
        this.order=re.data;
        this.neworder=re.data.grow_task;
        this.manall=re.data.work_info;//获取工人数据
        this.quyu=re.data.area_info; //获取种植区域信息
        //console.log(this.order);

        if(re.status==1){
            $("#bai").removeClass("hide");
            $(".plandivaddleft-yuan").fadeIn(2500).css("background-color","#b0c777");
            $(".plandivaddleft-top-xian").fadeIn(3500).removeClass("hide");
            $(".plandivaddleft-top").fadeIn(2500).removeClass("hide");
            $(".maintwo").fadeIn(3500).removeClass("hide");

        }else{
            layer.msg("数据异常");
        }
    },

    dold(obj){
      
      var areaid=obj.value;
      var quyuall=this.quyu;
      var that=this;
      for(var i=0;i<quyuall.length;i++){
          if(areaid==quyuall[i]['area_id']){
              //console.log(quyuall[i]['area_id']);
              that.newnum=quyuall[i]['grow_num'];
          }
      }
      //console.log(that.newnum);
    },

    //工序单位下拉制作
    quskill(obja){

       var skillid=obja.value; 
       var skillall=this.gongxu;
       var that=this;
       for(var i=0;i<skillall.length;i++){
          if(skillid==skillall[i]['skill_id']){
              //console.log(quyuall[i]['area_id']);
              var unitstr = skillall[i]['unit_str'];
              that.newstr = unitstr.split(',');
          }
       }
    },

    doadd(num){
        this.newaddid=num;
        //console.log(num);
        
        $(".maintwo ul").append("<li style='width:100%; margin-top:20px; height:250px;' id=adddiv"+num+"><p style='width:100%; '><div class='' style=' float:left; display:inline;'><label style='display:block;'>种植区域</label><select class='form-control' name='quyu' id=quyu"+num+" style='width:160px;display:inline-block;'><option value='0'>请选择区域</option></select><label style='width:60px; display:inline-block; margin-left:5px;'><img src='/lib/img/public/cropmode/jianjian.png' id=donoa"+num+" /></label></div><div style='float:left; display:inline; margin-left:110px;'><label style='display:block;'>定植数量</label><input class='form-control' name='shuliang' id=shuliang"+num+" style='width:160px; display:inline-block;' value=''/><label style='display:inline-block;'>株</label></div><div style='clear:both'></div></p><p style='margin-top:30px;width:100%;'><div class='' style='float:left; display:inline;'><label style='display:block;'>工序</label><select class='form-control' id=gongxu"+num+" name='gongxu' style='width:160px;display:inline-block;'></select></div><div style=' float:left; display:inline; margin-left:110px; width:230px;'><p><label style='display:block;'>工序单位</label><select class='form-control' name='danwei' id=gxunit"+num+"></select></p><p style='margin-top:20px;'><label style='display:block;'>时间</label><input name='b_time' type='time' id=b_time"+num+" class='form-control' style='width:100px;display:inline-block;' /><label style='display:inline-block;'>至</label><input name='o_time' type='time' id=o_time"+num+" class='form-control' style='width:100px;display:inline-block;' /></p></div><div style='float:left; display:inline; margin-left:40px;'><p><label style='display:block;'>工作量</label><input class='form-control' name='gongzuoliang' id=gongzuoliang"+num+"  placeholder='请输入工作量'/></p><p style='margin-top:20px;'><label style='display:block;'>开始时间</label><input name='do_time' id=do_time"+num+" class='form-control' type='date' /></p></div><div style='float:left; display:inline; margin-left:40px;'><label style='display:block;'>持续天数</label><input class='form-control' name='day' id=day"+num+" value='' style='display:inline-block; width:160px;' /> <label style='display:inline-block;'> 天</label></div></p></li>")
         .find("#donoa"+num).click(function(){
            $("#adddiv"+num).remove();
        });

        //种植区域下拉框赋值

        var newquyu=this.quyu;  // 种植区域 数据

        for(var i=0;i<newquyu.length;i++){
            var op="<option value="+newquyu[i]['area_id']+">"+newquyu[i]['area_name']+"</option>"; 
            $("#quyu"+num).append(op);
        }

        $("#quyu"+num).change(function(){
               
           var a = $("#quyu"+num).val();   
           for(var i=0;i<newquyu.length;i++){

               if(a==newquyu[i]['area_id']){
                var huodenum=newquyu[i]['grow_num'];  
               }
           }
           $("#shuliang"+num).attr("value",huodenum);
        });

        //工序的下拉赋值
        var newgongxu = this.gongxu;
        for(var i=0;i<newgongxu.length;i++){

            var opgx="<option value="+newgongxu[i]['skill_id']+">"+newgongxu[i]['skill_name']+"</option>";

            $("#gongxu"+num).append(opgx);

        }

        //工序单位下拉赋值
        $("#gongxu"+num).change(function(){
               
           var b = $("#gongxu"+num).val();   
           for(var i=0;i<newgongxu.length;i++){

               if(b==newgongxu[i]['skill_id']){

                  var huodnum=newgongxu[i]['unit_str']; 

                  var newstra = huodnum.split(',');

               }
           }
           
           $("#gxunit"+num).find("option").remove(); 
           for(var i=0;i<newstra.length;i++){
               
               var opunit="<option>"+newstra[i]+"</option>"; 
               $("#gxunit"+num).append(opunit);
           }

        });

    },

    //保存
    dasave(){
        var overnum=this.newaddid+1;
        var wid=$("#workerid").val();
        var arr=[];
        console.log($('#plan').val());
        if(this.state == 1){
            if($('#plan').val() == 0){
                layer.msg('请选择生产计划');return;
            }
        }
        if($('#task').val() == 0){
            layer.msg('请选择种植任务');return;
        }
        if($('#workerid').val() == 0){
            layer.msg('请选择工人');return;
        }
        for(var n=0;n<overnum;n++){
            if($("#quyu"+n).val()!= 0 || $("#shuliang"+n).val() != '' || $("#gongzuoliang"+n).val() != '' || $("#b_time"+n).val() != '' || $("#o_time"+n).val() != '' || $("#do_time"+n).val() != '' || $("#day"+n).val() != ''){
                if($("#quyu"+n).val() == 0){
                    layer.msg('请选择区域');return;
                }
                if($("#shuliang"+n).val() == ''){
                    layer.msg('请输入定植数量');return;
                }
                if($("#gongzuoliang"+n).val() == ''){
                    layer.msg('请输入工作量');return;
                }
                if($("#b_time"+n).val() == ''){
                    layer.msg('请选择工单要求开始时间');return;
                }
                if($("#o_time"+n).val() == ''){
                    layer.msg('请选择工单要求结束时间');return;
                }
                if($("#do_time"+n).val() == ''){
                    layer.msg('请选择开始时间');return;
                }
                if($("#day"+n).val() == ''){
                    layer.msg('请输入持续天数');return;
                }
                var r = /^[1-9][0-9]*$/;
                if(!r.test($("#day"+n).val())){
                    layer.msg('持续天数为整数');return;
                }
                arr.push([
                    this.atid,
                    wid,
                    $("#quyu"+n).val(),
                    $("#shuliang"+n).val(),
                    $("#gongxu"+n).val(),
                    $("#gxunit"+n).val(),
                    $("#gongzuoliang"+n).val(),
                    $("#b_time"+n).val(),
                    $("#o_time"+n).val(),
                    $("#do_time"+n).val(),
                    $("#day"+n).val()
                ]);
            }
        };
        if(arr.length == 0){
            layer.msg('请完善工单信息');return;
        }
        var tree = "[";
 　　     for (var i = 0 ;i < arr.length ; i++){
   　　　      tree += "[";
   　　　      tree += "\""+arr[i][0]+"\""+",";
              tree += "\""+arr[i][1]+"\""+",";
              tree += "\""+arr[i][2]+"\""+",";
              tree += "\""+arr[i][3]+"\""+",";
              tree += "\""+arr[i][4]+"\""+",";
              tree += "\""+arr[i][5]+"\""+",";
              tree += "\""+arr[i][6]+"\""+",";
              tree += "\""+arr[i][7]+"\""+",";
              tree += "\""+arr[i][8]+"\""+",";
              tree += "\""+arr[i][9]+"\""+",";
              tree += "\""+arr[i][10]+"\"";
  　　　       tree += "]";
    　　　     if(i<arr.length-1){
        　　 　　   tree+=",";
    　　　      }
  　         }
  　   tree+="]";
      
        var sendData={};
		var jsonData={};
        sendData.url="index.php/pc/Work/add_worker_job";
        jsonData.t_id=this.atid;
        jsonData.array_info=tree;
        sendData.data=jsonData;
		var re = getFaceInfo(sendData);
        if(re.status==1){

            layer.msg(re.msg,{time:2000},function(){
                window.location.href = "#/worker/workerorder/order_list";
            });

        }else{
            layer.msg(re.msg); 
        }

    },




   }
}
</script>
