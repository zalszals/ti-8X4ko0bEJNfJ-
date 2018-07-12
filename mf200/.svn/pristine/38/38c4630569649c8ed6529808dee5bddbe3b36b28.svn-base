<template>
<div id="left-box" >
    <div style=" width: 100%; height:100%;" >
        <div class="newdivtop"> 
        <h4 style="font-weight:bold;">种植任务&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;添加种植任务</span>
            <span class="h4span-r">返 回</span>
            <span class="h4span-r" style="background-color:#b0c777;" v-on:click="dofabu()">发 布</span>
        </h4>
        </div> 

        <div class="maingropplantop" >
            <h4 style="color:#f2a553;">生产计划1</h4>
            <div class="maingropinfoa">
                <div class="maingropinfoleft">
                    <div class="maingropinfolefttop">
                        <p>作物基本信息</p>
                        <p style="font-weight:normal; color:#666;">作物：<span>{{growadd.info.parent_name}}</span> &nbsp;&nbsp;&nbsp;&nbsp;果型：<span>{{growadd.info.cat_type}}</span> &nbsp;&nbsp;&nbsp;&nbsp;果色：<span>{{growadd.info.cat_color}}</span> &nbsp;&nbsp;&nbsp;&nbsp;品种：<span>{{growadd.info.cat_name}}</span></p>
                        <p style="font-weight:normal; color:#666;">描述：<span>{{growadd.info.cat_desc.substring(0,24)}}...</span></p>
                    </div>

                        <p>剩余预计产量</p>
                        <!--总产量 - 种植任务 得出-->
                        <p style="font-weight:normal;"><strong class="gundongtiao"><span id="per" class="spanwidth"></span></strong> &nbsp;&nbsp;&nbsp;&nbsp;<span style="display: inline-block;"> Kg</span></p>

                </div>

                <div class="maingropinforight">
                    <div class="maingropinfolefttop">
                        <p>时间信息</p>
                        <p style="font-weight:normal; color:#666;">定植时间：<span>{{growadd.info.grow_date}}</span> &nbsp;&nbsp;&nbsp;&nbsp;采收期：<span>{{growadd.info.estimate_get_date_1}} 至 {{growadd.info.estimate_get_date_2}}</span> </p>
                    </div>

                        <p>剩余种植面积</p>

                        <p style="font-weight:normal;"> <strong class="gundongtiao"><div id="pera" class="spanwidtha" v-bind:style="'width:'+mupx+'px'"></div></strong> &nbsp;&nbsp;&nbsp;&nbsp;<span style="display: inline-block;">{{mianjilast-mianjiago}} 亩</span> </p>

                </div>
            </div>
        </div>
        
        <div class="maingropplancenter">
            <h4 style="color:#f2a553;">种植任务信息填写</h4>
            <form class="form-inline">
            <div style="width:100%; height:auto;">    
            <div class="" style="width:100%; height:auto;">
                <div style="width: 42%;  height: auto; margin-right:30px; display:inline-block;  ">
                    <div class="form-group;" style="margin-top:20px;">
                        <label>种植模式</label>
                        
                            <select class="form-control" id="growmsid" style="width:200px;margin-left:14px;" >
						        <option value="">请选择</option>
						        <option v-for="item in growadd.ms_info" v-bind:value="item.mode_id">{{ item.mode_name }}</option>
					        </select>
                        
                        
                    </div>
                    
                    <div class="form-group" style="width:100%; height:30px; ">
                        
                    </div>
                  
                </div>

                <div style="width:50%;display:inline-block; ">
                    <div class="form-group">
                        <label>间距</label><img src="/lib/img/public/cropmode/look.jpg" />
                     </div>
                     <div class="form-group" style="width:100%; ">
                         <label style="color:#888; width:90px;">株距</label>
                         <input class="form-control" id="zhuju" value="请输入株距" style="width:200px;">
                         <label style="color:#888; width:90px; text-align:center">行距</label>
                         <input class="form-control" id="hangju" value="请输入行距" style="width:200px;">
                         <label>cm</label>

                     </div>
                    

                </div>

            </div>


            <div style="width:100%; margin-top:20px;" id="addnewdiv">
                <ul>
                    <li style="width:100%; padding:0px; margin:0px;">
                        <div class="form-group" style="width:42%; display:inline-block;  ">
                            <div style="width:100%;">
                                <label>种植环境</label>
                                <select class="form-control" id="growhjid0" style="width:200px; margin-left:14px;" v-on:change="getid()" >
                                    <option value="">请选择</option>
                                    <option v-for="item in growadd.hj_info" v-bind:value="item.id">{{ item.type_name }}</option>
                                </select>
                                <label v-on:click="doadd(addnm++)"><img src="/lib/img/public/cropmode/jiajia.jpg" /></label>
                            </div>
                            
                            <div style="width:100%; margin-top:18px;">
                                <label style="color:#888; height:40px; ">种植区域</label>
                            
                                <select class="form-control" style="width:200px;margin-left:14px;" id="getind0" v-on:change="getlist()" >
                                    <option value="">请选择区域</option>
                                    <option v-for="item in lists" v-bind:value="item.area_id" v-bind:id="'ccc'+item.area_id" v-bind:name="item.area_num">{{item.area_name}}</option>                      
                                </select>
                                
                                <label style="color:#888; width:180px;text-indent:2em; margin-right:16px;">实际种植面积 <input name='zzmj' id="sjzhmj0" class="nonestyle" v-bind:value="abh"> ㎡</label>
                                
                            </div>
                        </div>
                    

                        <div class="form-group" style="width:420px;display:inline-block;padding-left:32px; margin-top:30px; ">
                            
                            <label style="color:#888;width:90px;">定植数量</label>
                            <input class="form-control" name="dzsl" id="dzh0" value="定植数量" style="width:200px;">
                            <label style="width:50px; text-algin:center;">株</label>
                            
                        </div>
                    </li>

                </ul>
                
                <label style="color:#888; width:300px;">所有面积之和 <input id="zongmianji" class="nonestyle" style="width:60px;" v-bind:value="abh"> ㎡</label>
                <label style="color:#888;width:280px;text-indent:0.5em; ">所有定植数量之和 <input id="zongshuliang" class="nonestyle" style="width:60px;" v-bind:value="abh"> ㎡</label>


            </div>


            <div class="maingropplanleft">
                <div style="background:none;">
                    <p class="form-group" style="width:100%;background:none;">
                        <label style="width:120px;">目标单果重</label>
                        <input class="form-control" id="danguo" style="width:200px;">
                        <label>g</label>
                    </p>

                    <p style="background:none; margin-top:20px;"><label>目标产量</label></p>

                    <p class="form-group" style="width:100%;background:none;margin-top:20px;">
                        <label style="color:#888; width:120px;">目标每平方米产量</label>
                        <input class="form-control" id="mile" style="width:200px;">
                        <label>Kg</label>
                    </p>

                    <p class="form-group" style="width:100%;background:none;margin-top:20px;">
                        <label style="color:#888; width:120px;">目标年产量</label>
                        <input class="form-control" id="year" style="width:200px;">
                        <label>Kg</label>
                    </p>
                </div>
            </div>


            <div class="maingropplanright">
                 <div>
                     
                     <p class="form-group" style="width:100%;background:none;"></p>
                     <p class="form-group" style="width:100%;background:none;"></p>
                     <p class="form-group" style="width:100%;background:none;">
                        <label>时间信息</label>
                     </p>
                     
                     <p class="form-group" style="width:100%;background:none;margin-top:20px;">
                         <label style="color:#888; width:90px;">定植时间</label>
                         
                        <input type="date" class="form-control" name="newtimea"  />
                         
                     </p> 
                     
                     <p class="form-group" style="width:100%;background:none;margin-top:20px;">
                        <label style="color:#888; width:90px;">预计采收期</label>
                         
                        <input type="date" class="form-control" name="newtimeb"  />
                         
                        <label style="color:#888;">至</label>
                        
                        <input type="date" class="form-control" name="newtimec"  />
                        
                     </p>

                 </div>
            </div>
            
            
            <div class="maincenterbottom">
                <h4>成本预估</h4>
                <div class="maincenterbottomdiv" style="width:100%;">

                    <div class="form-group" style="width:30%; line-height:40px;">
                        <label style="color:#888;">人工成本低估</label>
                        <input type="text"  name="rengong" class="form-control" value="请输入预估值">
                        <label style="color:#888;">元</label>
                    </div>

                    <div class="form-group" style="width:30%; line-height:40px;">
                        <label style="color:#888;">物料成本预估</label>
                        <input type="text" name="wuliao" class="form-control" value="请输入预估值">
                        <label style="color:#888;">元</label>
                    </div> 

                    <div class="form-group" style="width:30%; line-height:40px;">
                        <label style="color:#888;">能耗成本预估</label>
                        <input type="text" name="nenghao" class="form-control" value="请输入预估值" v-on:blur="thiszong()">
                        <label style="color:#888;">元</label>
                    </div>  

                    <div class="form-group" style="width:30%; line-height:40px;">
                        <label style="color:#888;">总成本 <input id="zongchengben" class="nonestyle" style="width:60px;" v-bind:value="zongcb"> 元</label>
                    </div>   

                </div>

                <div class="maincenterbottomdiv" style="width:100%;">
                    <label>种植任务负责人</label>
                    <select class="form-control" name="addcat_id" id="worid">
						<option value="">请选择</option>
						<option v-for="item in growadd.pep_info" v-bind:value="item.worker_id">{{ item.worker_name }}</option>
                       
					</select>
                </div>

            </div>
        

            </div>
            </form>
           
        </div>
  

   


    </div>
</div>
</template>
<script>
export default {

  data(){
      return {
          getplanid:'',
          getpid:'',
          growadd:[],
          gethjid:'',
          lists:[],
          did:'',
          addnm:1,
          okid:'',
          planno:'',
          auid:1,
          mianjilast:'',
          mianjiago:'',
          mupx:'',
          abh:'',
          zongcb:'',
          

      }
  },

  mounted: function() {
    this.getplanid=this.$route.query.planid;
    this.getpid=this.$route.query.psid;
    this.planno=this.$route.query.pno;
    this.auid=this.$route.query.fabuid;
    this.mianjilast=this.$route.query.yuchl;
    this.mianjiago=this.$route.query.agomianji;


    this.getper();
    this.getaper();
    this.getinfoadd();
  },
  
  methods:{
    

     getper:function(){
       var num=this.mianjiago;  // 获取已经完成多少亩
       
       var mainnum=this.mianjilast; 

       var newper = num/mainnum; //获取百分比

       var perwidth=(newper*180).toFixed(0); // 通过百分比得到 应该的宽度
       this.mupx=perwidth;
          
    },
    //剩余产量 计算
    getaper:function(){
       var numa=50;  // 获取已经完成多少亩
       var newpera = numa/150; //获取百分比
       var perwidtha=newpera*180; // 通过百分比得到 应该的宽度
       $("#per").css("width",perwidtha); // 定义对应的宽度
    },




    getinfoadd:function(){
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/product/Progrowtask/progrowtask_add_all";
      jsonData.plan_id=this.getplanid;
      jsonData.ps_id=this.getpid;
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.growadd = re.data;

      /*
      sendData.url ="27.221.53.90:880/index.php/product/Progrowtask/progrowtask_add_all";
      jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
      jsonData.phone = "18114158894";
      jsonData.plan_id=this.getplanid;
      jsonData.ps_id=this.getpid;
      sendData.data = jsonData;
      $.ajax({
        url: "http://www.pc200.com/router.php",
        data: sendData,
        dataType: "Json",
        success: function(msg) {
        this.growadd = msg.data;
        //console.log(msg.data);
        }.bind(this),
        error: function(msg) {
        //alert("错误");
        }
       });*/
    },

   
    getid(){
        
      this.gethjid=$("#growhjid0").val();
      //console.log(this.gethjid);
        
      var sendData = {};
      var jsonData = {};
      sendData.url = "index.php/product/progrowtask/getprowtask_get_area";
      jsonData.id=this.gethjid;
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.lists = re.data;
      /*
      sendData.url = "27.221.53.90:880/index.php/product/progrowtask/getprowtask_get_area";
      jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
      jsonData.phone = "18114158894";
      jsonData.id=this.gethjid;
      sendData.data = jsonData;
      $.ajax({
        url: "http://www.pc200.com/router.php",
        dataType: "Json",
        data: sendData,
        success: function(re) {
          this.lists = re.data;
          //console.log(this.lists);
        }.bind(this),
        error: function(msg) {
          //alert("错误");
        }
      });*/

    },

    getlist(){
      
      this.did=$("#getind0").val();
      var cid=$("#getind0").val();
      //console.log(this.did);
      this.abh=$("#ccc"+cid).attr("name");
      
      //console.log(abh);
    },


    doadd(addid){
      //console.log(addid);
      this.okid=addid;
      var newmain=this.growadd['hj_info'];
      //var arealist=this.lists;
      
      //$("#addnewdiv ul").append("<li style='width:100%;'><div class='form-group' style='width:42%; display:inline-block;'><label style='color:#888; text-indent:0.5em; width:85px; height:40px;'>种植区域</label><select class='form-control' style='width:200px;' id='getind' name='testa' v-on:change='getlist()'><option value=''>请选择区域</option></select><label style='color:#888; width:160px;text-indent:2em; margin-right:16px;'>实际种植面积---㎡</label></div><div class='form-group' style='width:420px;display:inline-block;padding-left:36px;'><label style='color:#888;width:110px;'>定植数量</label><input class='form-control' value='请输入行距' style='width:200px;'><label style='width:50px; text-algin:center;'>株</label><label style='color:#888; width:300px; height:40px;'></label></div></li>");
      $("#addnewdiv ul").append("<li style='width:100%; padding:0px; margin:0px;'><div class='form-group' style='width:42%; display:inline-block;'><div style='width:100%;'><label style=' margin-left:10px;'>种植环境</label><select class='form-control' name='atest' id=growhjid"+addid+" style='width:200px; margin-left:20px;'></select></div><div style='width:100%; margin-top:18px;'><label style='color:#888; text-indent:0.5em; width:85px; height:40px;'>种植区域</label><select class='form-control' style='width:200px;margin-left:4px;' name='btest'  id=getind"+addid+" ></select><label id=changelabel"+addid+" style='color:#888; width:180px;text-indent:2em; margin-right:16px;'>实际种植面积<input name='zzmj' class='nonestyle' value=''>㎡</label></div></div><div class='form-group' style='width:420px;display:inline-block;padding-left:36px; margin-top:30px;'><label style='color:#888;width:110px;'>定植数量</label><input class='form-control' name='dzsl' id=dzh"+addid+" value='请输入定植数量' style='width:200px;'><label style='width:50px; text-algin:center;'>株</label></div></li>");
    //添加种植环境数据
    for(var i=0;i<newmain.length;i++){
        
        var op="<option value="+newmain[i]['id']+">"+newmain[i]['type_name']+"</option>";
        
        $('#growhjid'+addid).append(op);
        //console.log(op);    
      }
      //var that=this;
      //获得选取种植环境的id
      $('#growhjid'+addid).click(function(){
          var abcd=$('#growhjid'+addid).val();
          //console.log(abcd);
          var sendData = {};
          var jsonData = {};
          sendData.url = "index.php/product/progrowtask/getprowtask_get_area";
          jsonData.id=abcd;
          sendData.data = jsonData;
          var re = getFaceInfo(sendData);
          var arealist=re.data;
          //console.log(arealist);
          $("#getind"+addid).empty();
          $("#changelabel"+addid).empty();
          
          
          for(var n=0;n<arealist.length;n++){
              
              var opa="<option value="+arealist[n]['area_id']+">"+arealist[n]['area_name']+"</option>";
              $("#getind"+addid).append(opa);
             
             $("#changelabel"+addid).html("实际种植面积 <input name='zzmj' id=sjzhmj"+addid+" class='nonestyle' value=''> ㎡"); //添加本段 只有点击种植区域才会显示实际种植面积

             
               //获得种植面积 $("#changelabel"+addid).html("实际种植面积"+arealist[n]['area_num']+"㎡");
                   
                    $("#getind"+addid).click(function(){
                        var afid=$('#getind'+addid).val();//获取当前 种植区域id
                        //console.log(afid);
                            for(var na=0;na<arealist.length;na++){
                             
                                    if(arealist[na]['area_id']==afid){
                                    //console.log(arealist[na]['area_num']);
                                        $("#changelabel"+addid).html("实际种植面积 <input name='zzmj' class='nonestyle' value="+arealist[na]['area_num']+"> ㎡");
                                        //var newty=arealist[na]['area_num'];
                                        //zong.zmj=newty;
                                    }
                                
                            }
                    
                    //种植面积之和
                        
                        var sum = 0;
                        $("input[name='zzmj']").each(function(k,v){
                        sum += parseInt($(v).val());
                        });
                        $("#zongmianji").val(sum);

                    })
             
                // 总定植数量之和 待测试
                var suma = 0;
                $("input[name='dzsl']").each(function(ka,va){
                    suma += parseInt($(va).val());
                });
                $("#zongshuliang").val(suma);
          
          
          }
          /*
          sendData.url = "27.221.53.90:880/index.php/product/progrowtask/getprowtask_get_area";
          jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
          jsonData.phone = "18114158894";
          jsonData.id=abcd;
          sendData.data = jsonData;
      $.ajax({
        url: "http://www.pc200.com/router.php",
        dataType: "Json",
        data: sendData,
        success: function(re) {
          
          var arealist=re.data;
          //console.log(arealist);
          $("#getind"+addid).empty();
          $("#changelabel"+addid).empty();
          
          
          for(var n=0;n<arealist.length;n++){
              
              var opa="<option value="+arealist[n]['area_id']+">"+arealist[n]['area_name']+"</option>";
              $("#getind"+addid).append(opa);
             
             $("#changelabel"+addid).html("实际种植面积 <input name='zzmj' id=sjzhmj"+addid+" class='nonestyle' value=''> ㎡"); //添加本段 只有点击种植区域才会显示实际种植面积

             
               //获得种植面积 $("#changelabel"+addid).html("实际种植面积"+arealist[n]['area_num']+"㎡");
                   
                    $("#getind"+addid).click(function(){
                        var afid=$('#getind'+addid).val();//获取当前 种植区域id
                        //console.log(afid);
                            for(var na=0;na<arealist.length;na++){
                             
                                    if(arealist[na]['area_id']==afid){
                                    //console.log(arealist[na]['area_num']);
                                        $("#changelabel"+addid).html("实际种植面积 <input name='zzmj' class='nonestyle' value="+arealist[na]['area_num']+"> ㎡");
                                        //var newty=arealist[na]['area_num'];
                                        //zong.zmj=newty;
                                    }
                                
                            }
                    
                    //种植面积之和
                        
                        var sum = 0;
                        $("input[name='zzmj']").each(function(k,v){
                        sum += parseInt($(v).val());
                        });
                        $("#zongmianji").val(sum);

                    })
             
                // 总定植数量之和 待测试
                var suma = 0;
                $("input[name='dzsl']").each(function(ka,va){
                    suma += parseInt($(va).val());
                });
                $("#zongshuliang").val(suma);
          
          
          }
         
        }.bind(this),
        error: function(msg) {
          //alert("错误");
        }
      });*/

      })
     
    



    },
    // 获取总成本 待测试
    thiszong(){
        var aa=$("input[name='rengong']").val();
        var bb=$("input[name='wuliao']").val();
        var cc=$("input[name='nenghao']").val();
        if(aa=='' || aa=="请输入预估值"){
            alert("请填写人工成本");
        }
        if(bb=='' || bb=="请输入预估值"){
            alert("请填写物料成本");
        }
        if(cc=='' || cc=="请输入预估值"){
            alert("请填写能耗成本");
        }
        this.zongcb=Number(aa)+Number(bb)+Number(cc);
        //console.log(this.zongcb);

    },



    dofabu(){
      var zzid=this.okid+1;
      //console.log(zzid);

      //获取种植环境数组 第一条数据可能存在问题
      var arr=[];
      for(var n=0;n<zzid;n++){
         
         var dd=$("#sjzhmj"+n).val(); //获取实际种植面积 亩  
         var ee=dd*667; //转化成平方米
         arr.push([$("#growhjid"+n).val(),$("#getind"+n).val(),$("#dzh"+n).val(),ee,dd]);

      }

      var tru = "[";
 　　     for (var i = 0 ;i < arr.length ; i++){
   　　　      tru += "[";
   　　　      tru += arr[i][0]+",";
   　　　      tru += arr[i][1]+",";
              tru += arr[i][2]+",";
              tru += arr[i][3]+",";
              tru += arr[i][4];
  　　　       tru += "]";
    　　　     if(i<arr.length-1){
        　　 　　   tru+=",";
    　　　      }
  　         }
  　   tru+="]";


      var sendData = {};
      var jsonData = {};

      jsonData.array_info=tru;

      jsonData.cost_worker=$("input[name='rengong']").val();

      jsonData.cost_materiel=$("input[name='wuliao']").val();

      jsonData.cost_amount=$("input[name='nenghao']").val();
      
      jsonData.plan_id=this.getplanid;

      jsonData.ps_id=this.getpid;
      
      //种植任务编号 待确定
      //jsonData.t_no=this.planno;

      jsonData.grow_mode_id=$("#growmsid").val();

      jsonData.zhu_ju=$("#zhuju").val();

      jsonData.hang_ju=$("#hangju").val();
    
      //定植数量是 相加之和
      jsonData.total_grow_num=$("#zongshuliang").val();

      jsonData.one_weight=$("#danguo").val();

      jsonData.sm_weight=$("#mile").val();

      jsonData.year_weight=$("#year").val();

      jsonData.grow_date=$("input[name='newtimea']").val();

      jsonData.estimate_get_date_1=$("input[name='newtimeb']").val();
      jsonData.estimate_get_date_2=$("input[name='newtimec']").val();
      
      //人工成本+物料预估成本+能耗成本
      

      //预估成本 
      jsonData.total_cost=this.zongcb;

      jsonData.worker_id=$("#worid").val();
      
      jsonData.add_worker_id=1;
      sendData.url = "index.php/product/ProductPlan/add_pg_task";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.zuowuall = re.data;
      /*
      sendData.url = "27.221.53.90:880/index.php/product/ProductPlan/add_pg_task";
      jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
      jsonData.phone = "18114158894";

      sendData.data = jsonData;
      $.ajax({
        url: "http://www.pc200.com/router.php",
        data: sendData,
        dataType: "Json",
        success: function(msg) {
          this.zuowuall = msg.data;
          //console.log(msg.data);
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
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;    }
.h4span-r{ float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.maingropplantop{ width: 100%; height: auto; margin: 30px; display: block;}
.maingropinfoa{ width: 100%; height:200px; margin-top: 20px; }
.maingropinfoa p{font-weight: bold; line-height: 40px; font-size:16px; color:#555;}
.maingropinfoa p span{color:#000; font-weight:normal;}

.maingropinfoleft{ float: left; display: inline; width: 42%; margin-right: 30px;  }

.maingropinforight{ float: left; display: inline; width: 42%; text-align: left; }
.maingropinfolefttop{ height: 120px; }

.maingropplancenter{ width: 100%; height: auto; margin: 30px; display: block; }
.maingropplanleft{ float: left; display: inline; margin-top: 26px; width: 42%;  height: auto; margin-right: 30px; }
.maingropplanright{ float: left; display: inline; margin-top: 26px; width: 50%;  height: auto;}
table tr{ padding: 12px 0px; background-color: none; }
table tr td{ padding: 0 10px;background-color: none;}


.maincenterbottom{ clear: both; }

.gundongtiao{ width: 180px;  background-color: #fff; height: 8px;  border-radius:2px;  display: inline-block;  box-shadow:0 0 1px #ddd; position:relative; z-index: 1;}

.spanwidth{ background-color: greenyellow; height: 8px;  border-radius:2px;  position: absolute; z-index: 2;  }
.spanwidtha{ background-color: green; height: 8px;  border-radius:2px;  position: absolute; z-index: 2;}
#addnewdiv ul li{ margin-top: 5px;}


.nonestyle{ width: 30px; border:none; background-color: #f3f9f9; text-align: center; }

</style>
