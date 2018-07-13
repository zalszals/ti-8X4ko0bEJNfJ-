<style>
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

.rightzhspan option{
    color: #666;
}
/*right*/
.plandivaddright {
  float: left;
  display: inline;
  height: auto; 
}
.rightzh{ line-height: 38px; color:#f3a753;}
.rightzhspan{ width:180px; padding: 0px 12px; border-radius:15px; margin: 6px 0px; text-align:center; line-height: 30px;color: #fff; display: block; height: 30px; background-color:#b0c777;  }
.rightzhspan option{ background-color:#fff; }

.maintwo{width: 1100px; height:500px; }

.chooserenwu{ width:100%; height:100%; padding: 6px 0px;  }
.chooserenwubg{ background-color:#fff; border-radius:10px; box-shadow: 0px 0px 5px #e2e2e2; padding: 20px 30px; }

.choosebai{ width: 780px; height: 126px; background-color:#fff; border-radius:6px; box-shadow: 0px 0px 5px #e2e2e2; padding: 30px;}
.choosebai p{ line-height: 40px; font-size: 16px; color: #333;}

.choosebaispan{ width: 230px; display: inline-block; margin-top: 10px;}

.newsul{ width: 100%; height: auto; }
.newsul li{ width: 540px; height: 250px; float: left; display: inline; }
.newsul li p{ width: 100%; height: auto; }
.newsulspan{ display: inline-block; width: 260px; line-height: 80px; font-size:16px; color: #333;  }
</style>

<template>
<div id="left-box">
    <div style=" width: 100%; height: 100%;" >
        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">物料管理&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;申请领料</span></font>
            <span class="h4span-r" style="background-color:#b0c777;" @click="$router.back(-1)">返 回</span>
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

                <div class="plandivaddleft-top-xian hide" style="height:470px; width:5px; margin-left:18px; background-color:#b1c677;" ></div>
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
    
                    <h4 class="rightzh" id="plan">选择生产计划</h4>
                    <select class="rightzhspan"  v-on:change="gettask($event.target)" id="planselect">
                        <option>请选择生产计划</option>
                        <option style="color:#666;" v-for="plist in planall" v-bind:value="plist.plan_id">{{plist.plan_name}}</option>
                    </select>

                    <div class="chooserenwu hide" id="zzhide">
                        <h4 class="rightzh">选择种植任务</h4>
                        <select class="rightzhspan" v-on:change="doshow($event.target)">
                            <option>请选择种植任务</option>
                            <option v-for="tlist in taskall" v-bind:value="tlist.t_id">{{tlist.t_name}}</option>
                        </select>
                    </div>

                    <div class="choosebai hide" id="zebai">
                        <h4 style="font-weight:bold;">负责人：{{growall.worker_name}}</h4>
                        <p>
                            <span class="choosebaispan">品种： {{growall.cat_p_name}}</span>
                            <span class="choosebaispan">种植模式：{{growall.mode_name}}</span>
                            <span class="choosebaispan">已定植天数：{{growall.gd_num}}</span>
                        </p>
                    </div>

                    <div class="chooserenwu hide" id="zzqyhide">
                        <h4 class="rightzh">选择种植区域</h4>
                        <select class="rightzhspan" v-on:change="getman($event.target)">
                            <option>请选择种植区域</option>
                            <option v-for="alist in areaall" v-bind:value="alist.area_id">{{alist.area_name}}</option>
                        </select>
                    </div>

                    <div class="chooserenwu hide" id="zzlhide">
                        <h4 class="rightzh">选择领料人</h4>
                        <select class="rightzhspan" v-on:change="showtwo($event.target)" id="workerselect">
                            <option>请选择领料人</option>
                            <option v-for="mlist in manall" v-bind:value="mlist.worker_id">{{mlist.worker_name}}</option>
                        </select>
                    </div>

                <!--right 第二部分-->
               
                <div class="maintwo hide">
                    <ul class="newsul">
                        <li>
                            <h4 class="rightzh">物料名称</h4>
                            <p>
                                <select class="form-control" style="width:160px; display:inline-block;" id="selop0" v-on:change="wuliao($event.target)">
                                    <option>物料名称</option>
                                    <option v-for="wlist in wuliaoall" v-bind:value="wlist.m_id">{{wlist.m_name}}</option>
                                </select>
                                <label style="width:60px; display:inline-block;"><img src="/lib/img/public/cropmode/jiajia.jpg" v-on:click="doadd(thenum++)" /></label>
                            </p>

                            <p>
                                <span class="newsulspan">类别：<font id="fontid0">{{leibie}}</font></span>
                                <span class="newsulspan">规格：<font id="fontaid0">{{guige}}</font></span>
                            </p>

                            <p>
                                <label style="display:block; font-size:15px; color:#666;">领取数量</label>
                                <input class="form-control" value="" id="lingqu0" style="display:inline-block; width:160px;"  />
                            </p>

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
        planall:[],
        taskall:[],
        growall:[],
        areaall:[],
        workerid:'',
        manall:[],
        wuliaoall:[],
        leibie:'',
        guige:'',
        thenum:1,
        ynum:'',
        tid:'',
        areaid:'',
        workerida:'',
    }
      
  },
  mounted:function(){
    this.getplan();
    this.getwuliao();
  },
  methods:{
    //获取生产计划下拉
    getplan:function(){
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/pc/Work/plan_list";
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        console.log(re);
        if(re.status == 1){
            if(re.state == 1){
                 this.planall=re.data;
            }else{
                $('#plan').hide();
                $('#planselect').hide();
                this.taskall=re.data;
                var arr=re.data;
                for(var i=0;i<arr.length;i++){
                    this.areaall=arr[i]['area'];
                    this.workerid=arr[i]['worker_id'];
                    //this.areaall.push(arr[i]['area']);
                }
                $("#zzhide").fadeIn(2000).removeClass("hide"); 
            }
        }
        //console.log(this.planall);
    },

    //获取物料下拉
    getwuliao:function(){

        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/ProTake/mc_list";
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.wuliaoall=re.data;

    },

    //获取种植任务下拉
    gettask(obj){
        
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/ProTake/grow_list";
        jsonData.plan_id=obj.value;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.taskall=re.data;
        var arr=re.data;
        for(var i=0;i<arr.length;i++){
            this.areaall=arr[i]['area'];
            this.workerid=arr[i]['worker_id'];
            //this.areaall.push(arr[i]['area']);
        }
        //console.log(this.workerid);
        $("#zzhide").fadeIn(2000).removeClass("hide");
       
    },


    doshow(obj){
        this.tid=obj.value;
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/ProTake/pt_addinfo";
        jsonData.t_id=obj.value;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.growall=re.data;

        $("#zebai").fadeIn(2000).removeClass("hide");
        $("#zzqyhide").fadeIn(2000).removeClass("hide");
    },
    getman(aid){
       this.areaid=aid.value;
       var sendData = {};
       var jsonData = {};
       sendData.url="index.php/product/ProTake/takeworker_list";
       jsonData.worker_id=this.workerid;
       sendData.data = jsonData;
       var re = getFaceInfo(sendData);
       this.manall=re.data; 
       //console.log(this.manall);
       

       $("#zzlhide").fadeIn(2000).removeClass("hide");
       
    },

    showtwo(woid){
        this.worker_id=woid.value;
        $(".plandivaddleft-yuan").fadeIn(2500).css("background-color","#b0c777");
        $(".plandivaddleft-top-xian").fadeIn(3500).removeClass("hide");
        $(".plandivaddleft-top").fadeIn(2500).removeClass("hide");
        $(".maintwo").fadeIn(3500).removeClass("hide");
    },

    //获取选择物料的id
    wuliao(obj){

        var arr=this.wuliaoall;
        var that=this;
        for(var i=0;i<arr.length;i++){
            if(arr[i]['m_id']==obj.value){
                that.leibie=arr[i]['cat_name'];
                that.guige=arr[i]['m_desc'];
            }
        }
        //console.log(that.guige);

    },

    doadd(nownum){

        this.ynum=nownum;
        var zleibie='';var zguige='';
        $(".newsul").append("<li id=delli"+nownum+"><h4 class='rightzh'>物料名称</h4><p><select class='form-control' style='width:160px; display:inline-block;' id=selop"+nownum+"><option>物料名称</option></select><label style='width:60px; margin-left:6px; display:inline-block;'><img src='/lib/img/public/cropmode/jianjian.png' id=delimg"+nownum+" /></label></p><p><span class='newsulspan'>类别：<font id=fontid"+nownum+"></font></span><span class='newsulspan'>规格：<font id=fontaid"+nownum+"></font></span></p><p><label style='display:block; font-size:15px; color:#666;'>领取数量</label><input class='form-control' id=lingqu"+nownum+" style='display:inline-block; width:160px;'  /></p></li>")
        .find("#delimg"+nownum).click(function(){
            $("#delli"+nownum).remove();
        });
        //填充数据
        var arr=this.wuliaoall;

        var that=this;
        for(var i=0;i<arr.length;i++){
            var newop="<option value="+arr[i]['m_id']+">"+arr[i]['m_name']+"</option>";
            $("#selop"+nownum).append(newop);  
        }
        $("#selop"+nownum).change(function(){
            var a=$("#selop"+nownum).val();
            for(var i=0;i<arr.length;i++){

               if(a==arr[i]['m_id']){

                zleibie=arr[i]['cat_name'];
                zguige=arr[i]['m_desc'];

               }
           }
           //console.log(zleibie);
           $("#fontid"+nownum).text(zleibie);
           $("#fontaid"+nownum).text(zguige);


        });
    },

    dosave(){
       var num=this.ynum+1;
       var arr=[];
       for(var i=0;i<num;i++){
           arr.push([
             $("#selop"+i).val(),
             $("#lingqu"+i).val()
           ]);
       };
       //console.log(arr);
       var tree = "[";
 　　     for (var i = 0 ;i < arr.length ; i++){
   　　　      tree += "[";
   　　　      tree += "\""+arr[i][0]+"\""+",";
              tree += "\""+arr[i][1]+"\"";
  　　　       tree += "]";
    　　　     if(i<arr.length-1){
        　　 　　   tree+=",";
    　　　      }
  　         }
  　   tree+="]";
       
       //console.log(tree);

       var sendData = {};
       var jsonData = {};
       sendData.url="/index.php/product/TakeBack/tb_add";

       jsonData.t_id=this.tid;//参数
       jsonData.area_id=this.areaid;
       jsonData.use_worker_id=$('#workerselect').val();
       jsonData.remarks="申请领料";
       jsonData.materiel_array=tree;
       console.log(jsonData);
       sendData.data = jsonData;
       var re = getFaceInfo(sendData);
       	if(re.status == 1){
            layer.msg(re.msg,{time: 1500},function(){
                    window.location.href = '#/wuliao/lingliaodan/dailingliao';
            });
        }else{
            layer.msg(re.msg);
        }  
    },



    
  },
}

</script>
