<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;">生产计划&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;发布生产计划</span>
            <button class="h4span-r" style="background-color:#b0c777;" @click="$router.back(-1)">返 回</button>
            <button class="h4span-r" v-on:click="doadd()" :disabled="disabled">发 布</button>
        </h4>
        </div>

        <div class="plandivadd">

            <div class="plandivaddleft">
                <div class="plandivaddleft-top">
                    <div class="plandivaddleft-yuan" >
                        <img src="/lib/img/public/cropmode/tubiaoliebiao.png">
                    </div>
                    <i class="plandivaddleft-jiantou" style="float:right; display:inline;"></i>
                </div>

                <div class="plandivaddleft-top-xian hide" style=" height:250px; width:5px; margin-left:18px; background-color:#b1c677;"></div>
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

            <div class="plandivaddright">
                <div class="addright-topa">
                    <h4 style="color:#f2a553; line-height:40px;">作物基本信息</h4>
                    <div class="addright-topa-div" style="margin-top:10px;">

                        <div class="form-group" style="margin-right:60px; display:inline-block; ">
                            <label class="newlabel">作物</label>
                           
                            <select class="form-controla" style="width:200px;" v-on:change="getpz($event.target)">
                                <option>请选择作物</option>
                                <option v-for="list in zuowuall" v-bind:value="list.cat_id" >{{list.cat_name}}</option> 
                            </select>
                        </div>

                        <div class="form-group" style="margin-right:60px;display:inline-block;" >
                            <label class="newlabel">品种</label>
                            <!--<input type="text" class="form-controla" style="width:200px;" placeholder="请输入品种">-->
                            <select class="form-controla" id="pinzhongid" style="width:200px;" v-on:change="getgxge($event.target)" v-on:blur="thisup()">
                                <option>请选择品种</option>
                                <option v-for="listpz in pzlist" v-bind:value="listpz.cat_id" >{{listpz.cat_name}}</option> 
                            </select>
                        </div>
                        
                        <div class="form-group" style="margin-right:60px; display:inline-block;">
                            <label class="newlabel">果形</label>

                            <!--
                            <input type="text" class="form-controla" v-for="listpza in pzlist" v-if="listpza.cat_id==newpid"  style="width:200px;"  v-bind:value="listpza.cat_type">
                            -->
                            <input type="text" class="form-controla" id="hideid"  style="width:200px;" value="">
                            <input type="text" class="form-controla"  style="width:200px;"  v-for="listpza in pzlist" v-if="listpza.cat_id==newpid" v-bind:value="listpza.cat_type">
                        
                        </div>
                        

                        <div class="form-group" style=" display:inline-block;">
                            <label class="newlabel">果色</label>
                            <!--
                            <input type="text" class="form-controla" style="width:200px;" value="果色">
                            -->
                            <input type="text" class="form-controla" id="hideida"  style="width:200px;" value="">
                            <input type="text" class="form-controla"  style="width:200px;"  v-for="listpza in pzlist" v-if="listpza.cat_id==newpid" v-bind:value="listpza.cat_color">

                        </div>
 
                        

                    </div>

                    <div class="addright-topa-div">

                        <div class="form-group">
                            <label class="newlabel">描述</label>
                            <textarea class="form-control" rows="4" id="hideidab" style="color:#888; height:94px;">请输入描述</textarea>
                            <textarea class="form-control" rows="4" style="color:#888; height:94px;"  v-for="listpza in pzlist" v-if="listpza.cat_id==newpid">{{listpza.cat_desc}}</textarea>

                        </div>

                    </div>

                </div>

                <!-- 中部 -->
                <div class="addright-centera hide" style="height:530px; ">
                    <h4 style="color:#f2a553; line-height:40px;">计划目标</h4>
                    <p>时间信息</p>

                    <div class="addright-topa-div" style="margin-top:10px;">
                        <div class="form-group" style="margin-right:60px; display:inline-block; ">
                            <label class="newlabel">定植时间</label>
                            <input type="date" class="form-controlb" name="grow_time" style="width:200px;" placeholder="请选择时间" >
                        </div>

                        <div class="form-group" style=" margin-right:60px; display:inline-block;">
                            <label class="newlabel" style="display:block">采收期</label>
                            <input type="date" class="form-controlb" name="estimate_get_date_1" style="width:200px; display:inline-block" placeholder="请选择时间">
                            <span style="display:inline-block"> 至 </span>
                            <input type="date" class="form-controlb" name="estimate_get_date_2" style="width:200px; display:inline-block" placeholder="请选择时间">
                        </div>

                        <div class="form-group" style=" margin-right:60px; display:block;"> 
                            <label class="newlabel" style="display:block"><p>种植面积</p></label>
                            <input type="text" class="form-controlb" name="grow_area_2" style="width:200px; display:inline-block" placeholder="请输入面积"><span class="spaninline" style="width:130px; text-align:left;" > 平方米 </span>
                        </div>

                        
                        <div class="form-group" style="margin-right:60px; display:inline-block; ">
                            <label class="newlabel" style="display:block">预估总产量</label>
                            <input type="text" class="form-controlb" style="width:200px; display:inline-block" name="estimate_amount" placeholder="总产量预估"><span class="spaninline" > Kg </span>
                        </div>

                        <p>预估成本</p>
                        <div class="form-group" style="margin-right:60px; display:inline-block; ">
                            <label class="newlabel" style="display:block">预估人工成本</label>
                            <input type="text" class="form-controlb" style="width:200px; display:inline-block" name="cost_worker" placeholder="请输入预估值"><span class="spaninline" > 元 </span>
                        </div>

                        <div class="form-group" style="margin-right:60px; display:inline-block; ">
                            <label class="newlabel" style="display:block">预估物料成本</label>
                            <input type="text" class="form-controlb" style="width:200px; display:inline-block" name="cost_materiel" placeholder="请输入预估值"><span class="spaninline" > 元 </span>
                        </div>

                        <div class="form-group" style="margin-right:60px; display:inline-block; ">
                            <label class="newlabel" style="display:block">预估能耗成本</label>
                            <input type="text" class="form-controlb" id="nenghao" v-on:blur="thisupa()" style="width:200px; display:inline-block" name="cost_amount" placeholder="请输入预估值"><span class="spaninline" > 元 </span>
                        </div>
                        
                        <label class="newlabel" style="display:block">总成本 <input type="text" style="border:none;  width:120px; background:none;" name="newsum" v-bind:value="sunmoney" /> 元</label>

                    </div>

                </div>
 
                 <!-- 底部 -->
                <div class="addright-centerb hide" style="height:auto; padding-bottom:100px;">
                    <ul>
                        <li>
                            <h4 style="color:#f2a553; line-height:40px;">负责人</h4>
                            <p>
                              <label class="newlabel" style="display:inline-block"><p>未分配面积：{{summi}} 平方米</p></label>
                              <label class="newlabel" style="display:inline-block; margin-left:140px;"><p>未分配产量：{{sumchl}} Kg</p></label>
                            </p>
                            <div class="form-group" style="margin-right:60px; display:block; ">
                                <label class="newlabel" style="display:block"><p>选择生产计划负责人</p></label>

                                <select class="form-control" id="selval0" style="width:200px;display:inline-block" >
                                 <option value="0">请选择生产计划负责人</option>
                                 <option v-for="listman in manall" v-bind:value="listman.worker_id" >{{listman.worker_name}}</option> 
                                </select>

                                <span class="spaninline" v-on:click="addman(addnum++)"> <img src="/lib/img/public/cropmode/jiajia.jpg" /> </span>
                            </div>

                            <div class="form-group" style="margin-right:60px; display:inline-block;">
                                <label class="newlabel" style="display:block">种植面积</label>
                                <input type="text" class="form-control" id="zhongzhival0" style="width:200px; display:inline-block" placeholder="请输入预估值" v-on:blur="dosmthing()"><span class="spaninline" style="width:130px; text-align:left;"> 平方米 </span>
                            </div>

                            <div class="form-group" style="margin-right:60px; display:inline-block; ">
                                <label class="newlabel" style="display:block">目标产量</label>
                                <input type="text" class="form-control" id="mubiaoval0" v-on:blur="thisupb()"  style="width:200px; display:inline-block" placeholder="请输入预估值"><span class="spaninline" > Kg </span>
                            </div>

                        </li>

                    </ul>
                </div>

            </div>
           
        </div>
    </div>
</div>    
</template>
<script>
export default {
   
  data(){
      return{
      zuowuall: [],
      manall: [],
      pzlist: [],
      newpid: "",
      addnum:1,
      newaddid:'',
      catid:'',
      sunmoney:'',
      summi:0,
      sumchl:0,
      disabled:false
    }
  },

  mounted: function() {
    
    this.getzuowu();
    this.getman();
    //this.check();
  },

  methods: {
    //jquery 隐藏显示的js 效果  触发由选择品种 失去焦点触发
    thisup() {
      $(".form-controla").each(function() {
        var result = true;
        //console.log($(this).val());
        if ($(this).val() =='' || $("#pinzhongid").val() =='请选择品种') {
         
          result = false;
          return false;
        } else {
          
          $(".plandivaddleft-yuan").fadeIn(2500).css("background-color","#b0c777");
          //$(".plandivaddleft-jiantou").css("background-color","#b0c777");
         
          $(".plandivaddleft-top-xian").fadeIn(3500).removeClass("hide");
          $(".plandivaddleft-top").fadeIn(2500).removeClass("hide");
          $(".addright-centera").fadeIn(3500).removeClass("hide");
          
        }
      });
    },

    thisupa() {
      this.sunmoney=parseInt($("input[name='cost_worker']").val())+parseInt($("input[name='cost_materiel']").val())+parseInt($("input[name='cost_amount']").val());
      this.summi=$("input[name='grow_area_2']").val();
      this.sumchl=$("input[name='estimate_amount']").val();

      var resulta = true;
      $(".form-controlb").each(function() { 
        if ($(this).val() ==0 || $("#nenghao").val() =='') {
          //alert("请输入内容");
          resulta = false;
          return false;
        } else {
            
            $(".plandivaddleft-yuana").fadeIn(2500).css("background-color","#b0c777");
            $(".plandivaddleft-bot").fadeIn(3500).removeClass("hide");
            $(".plandivaddleft-top-xiana").fadeIn(3500).removeClass("hide");
            $(".addright-centerb").fadeIn(2500).removeClass("hide");
        }
      });
    },

    dosmthing(){
      var s=$("input[name='grow_area_2']").val();
      
      var a=$("#zhongzhival0").val();
      var cha=parseInt(s)-parseInt(a);
      this.summi=cha;
    },

    thisupb(){

      if($("#mubiaoval0").val()!=''){
        var s=$("input[name='estimate_amount']").val();
        var a=$("#mubiaoval0").val();
        var chaa=parseInt(s)-parseInt(a);
        this.sumchl=chaa;
        $(".plandivaddleft-yuanb").fadeIn(2500).css("background-color","#b0c777");
      }
  
    },

    addman(newnum) {
    
      this.newaddid=newnum;
      //1.js循环出数据
      var abc = this.manall;
      var that=this;
      $(".addright-centerb ul").append("<li><h4 style='color:#f2a553; line-height:40px;'>负责人</h4><div class='form-group' style='margin-right:60px; display:block;'><label class='newlabel' style='display:block'><p>选择生产计划负责人</p></label><select class='form-control' id=selval"+newnum+" name='atest' style='width:200px;display:inline-block' ><option>请选择生产计划负责人</option></select></div><div class='form-group' style='margin-right:60px; display:inline-block;'><label class='newlabel' style='display:block'>种植面积</label><input type='text' id=zhongzhival"+newnum+" class='form-control' style='width:200px; display:inline-block' placeholder='' onchick='dothing()'><span class='spaninline' > 平米 </span></div><div class='form-group' style='margin-right:60px; display:inline-block;'><label class='newlabel' style='display:block'>目标产量</label><input type='text' id=mubiaoval"+newnum+" class='form-control' style='width:200px; display:inline-block' placeholder=''><span class='spaninline' > Kg </span></div></li>")
      .find("#mubiaoval"+newnum).blur(function(){

             var spingmi=$("input[name='grow_area_2']").val();
            
             var schanliang=$("input[name='estimate_amount']").val();
             var snu=newnum+1;
             var newsum=0;var newsumchl=0;
             for(var i=0;i<snu;i++){

                newsum += parseInt($("#zhongzhival"+i).val());
                //newsum+=$("#zhongzhival"+i).val();
                newsumchl+=parseInt($("#mubiaoval"+i).val());

             }
            
             var cha=parseInt(spingmi)-parseInt(newsum);
             var chaa=parseInt(schanliang)-parseInt(newsumchl);

             that.summi=cha;  that.sumchl=chaa; 

      });

      for(var i=0;i<abc.length;i++){

        var op="<option value="+abc[i]['worker_id']+">"+abc[i]['worker_name']+"</option>";

        $("#selval"+newnum).append(op);
        //console.log(op);    
      }
      //2.赋值
      //$(".addright-centerb ul").append(this.addhtml);

    },

    //获取作物下拉框
    getzuowu: function() {
      var sendData = {};
      var jsonData = {};
      sendData.url = "index.php/product/ProductPlan/crop";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.zuowuall = re.data;
      /*
      sendData.url = "27.221.53.90:880/index.php/product/ProductPlan/crop";
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

    //获取生产计划负责人下拉列表
    getman: function() {
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/product/ProductPlan/plan_manager";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.manall = re.data;
      
      /*
      sendData.url ="27.221.53.90:880/index.php/product/ProductPlan/plan_manager";
      jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
      jsonData.phone = "18114158894";

      sendData.data = jsonData;
      $.ajax({
        url: "http://www.pc200.com/router.php",
        data: sendData,
        dataType: "Json",
        success: function(msg) {
          this.manall = msg.data;
          //console.log(msg.data);
        }.bind(this),
        error: function(msg) {
          //alert("错误");
        }
      });
      */
    },

    getgxge(obj) {
      this.newpid = obj.value;
      //console.log(this.newpid);
      if (this.newpid != "请选择品种") {
        $("#hideid").css("display", "none");
      }
      if (this.newpid != "请选择品种") {
        $("#hideida").css("display", "none");
      }
      if (this.newpid != "请选择品种") {
        $("#hideidab").css("display", "none");
      }
    },

    //添加执行
    doadd() {
      this.disabled = true;
      setTimeout(() => {
        this.disabled = false;
      }, 30000)
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/pc/ProductPlan/add_product_plan";
      jsonData.cat_id=this.newpid;
      if(!jsonData.cat_id){
        layer.msg('请选择作物信息');
        return;
      }
      jsonData.grow_date = $("input[name='grow_time']").val();
      if(!jsonData.grow_date){
        layer.msg('请选择定植日期');
        return;
      }
      jsonData.estimate_get_date_1 = $("input[name='estimate_get_date_1']").val();
      if(!jsonData.estimate_get_date_1){
        layer.msg('请选择采收开始日期');
        return;
      }
      jsonData.estimate_get_date_2 = $("input[name='estimate_get_date_2']").val();
      if(!jsonData.estimate_get_date_2){
        layer.msg('请选择采收结束日期');
        return;
      }
      if(new Date(jsonData.estimate_get_date_1.replace("-", "/").replace("-", "/")) > new Date(jsonData.estimate_get_date_2.replace("-", "/").replace("-", "/"))){
        layer.msg('采收结束日期应大于采收开始日期');
        return;
      }
      jsonData.grow_area_1 = 0;
      jsonData.grow_area_2 = $("input[name='grow_area_2']").val();
      if(!jsonData.grow_area_2){
        layer.msg('请输入种植面积');
        return;
      }
      if (isNaN(jsonData.grow_area_2)) {
        layer.msg('种植面积必须为数字');
        return;
      }
      jsonData.estimate_amount = $("input[name='estimate_amount']").val();
      if(!jsonData.estimate_amount){
        layer.msg('请输入总产量');
        return;
      }
      if (isNaN(jsonData.estimate_amount)) {
        layer.msg('总产量必须为数字');
        return;
      }
      jsonData.estimate_amount_one_date = $("input[name='estimate_amount_one_date']").val();
      jsonData.cost_worker = $("input[name='cost_worker']").val();
      jsonData.cost_materiel = $("input[name='cost_materiel']").val();
      jsonData.cost_amount = $("input[name='cost_amount']").val();
      jsonData.cost_total = $("input[name='newsum']").val();
      if(jsonData.cost_worker){
        if (isNaN(jsonData.cost_worker)) {
          layer.msg('人工成本必须为数字');
          return;
        }
      }
      if(jsonData.cost_materiel){
        if (isNaN(jsonData.cost_materiel)) {
          layer.msg('物料成本必须为数字');
          return;
        }
      }
      if(jsonData.cost_amount){
        if (isNaN(jsonData.cost_amount)) {
          layer.msg('能耗成本必须为数字');
          return;
        }
      }
      //console.log(this.catid);
      var nu=this.newaddid;
      var anum=nu;
      anum=anum+1;

      var arr=[];
      for(var n=0;n<anum;n++){ 
        if($("#selval"+n).val() != 0 || $("#zhongzhival"+n).val().length != 0 || $("#mubiaoval"+n).val().length != 0){ 
          if($("#selval"+n).val() == 0){
            layer.msg('请选择生产计划负责人');
            return;
          }
          if($("#zhongzhival"+n).val().length == 0){
            layer.msg('请输入负责人种植面积');
            return;
          }
          if (isNaN($("#zhongzhival"+n).val())) {
            layer.msg('负责人种植面积必须为数字');
            return;
          }
          if($("#mubiaoval"+n).val().length == 0){
            layer.msg('请输入负责人目标产量');
            return;
          }
          if (isNaN($("#mubiaoval"+n).val())) {
            layer.msg('负责人目标产量必须为数字');
            return;
          }
          arr.push([$("#selval"+n).val(),$("#zhongzhival"+n).val(),$("#mubiaoval"+n).val()]);
        }
      }

      if(arr.length == 0){
          layer.msg('负责人信息为空');
          return;
      }

      var tree = "[";
 　　     for (var i = 0 ;i < arr.length ; i++){
   　　　      tree += "[";
   　　　      tree += arr[i][0]+",";
   　　　      tree += arr[i][1]+",";
              tree += arr[i][2];

  　　　       tree += "]";
    　　　     if(i<arr.length-1){
        　　 　　   tree+=",";
    　　　      }
  　         }
  　   tree+="]";

      //var arra="[[18,111,0,111],[15,2222,0,2222]]";
      //console.log(jsonData.fzr_worker);
      //var arra=[[18,15,1,50],[15,12,2,60]];
      jsonData.fzr_worker=tree;
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      console.log(jsonData);
      if(re.status==1){
        layer.msg(re.msg, { time: 1500 }, function() {
          window.location.href="#/product/productplan/pro_plan";
        }); 
      }else{
          layer.msg(re.msg);
      }
      /*
      jsonData.fzr_worker=tree;
      sendData.url ="27.221.53.90:880/index.php/product/ProductPlan/add_product_plan";
      jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
      jsonData.phone = "18114158894";
      jsonData.cat_id=this.newpid;
      jsonData.grow_date = $("input[name='grow_time']").val();
      jsonData.estimate_get_date_1 = $("input[name='estimate_get_date_1']").val();
      jsonData.estimate_get_date_2 = $("input[name='estimate_get_date_2']").val();
      jsonData.grow_area_1 = 0;
      jsonData.grow_area_2 = $("input[name='grow_area_2']").val();
      jsonData.estimate_amount = $("input[name='estimate_amount']").val();
      jsonData.estimate_amount_one_date = $("input[name='estimate_amount_one_date']").val();
      jsonData.cost_worker = $("input[name='cost_worker']").val();
      jsonData.cost_materiel = $("input[name='cost_materiel']").val();
      jsonData.cost_amount = $("input[name='cost_amount']").val();
      
      
      sendData.data = jsonData;
     
      $.ajax({
        url: "http://www.pc200.com/router.php",
        data: sendData,
        dataType: "Json",
        success: function(re) {
          if (re.status == 1) {
            layer.msg(re.msg, { time: 1500 }, function() {
              window.location.reload();
            });
          } else {
            layer.msg(re.msg);
          }
        }.bind(this),
        error: function(msg) {
          //alert("错误");
        }
      });
      */
    },

    getpz(obj) {
      var that = this;
      this.catid=obj.value;
      var pid = obj.value;
      //console.log(pid);
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/product/ProductPlan/crop_child";
      jsonData.cat_id = pid;
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      var ban = re.data;
      for (var $i = 0; $i < ban.length; $i++) {
              that.pzlist.push(ban[$i]);
              //that.newguoxing.push(ban[$i].cat_type);
              //that.newguose.push(ban[$i].cat_color);
      }
     
    },

    // check: function(){

    //   var spingmi=$("input[name='grow_area_2']").val();
    //   var schanliang=$("input[name='estimate_amount']").val();
    //   var snu=this.newaddid+1;
    //   var newsum='';
    //   for(var i=0;i<snu;i++){
    //      newsum+=$("#zhongzhival").val();
    //   }
    //   var cha=parseInt(spingmi)-parseInt(newsum);
    //   console.log(cha);
    //   this.summi.push(cha);
      
    // },

    dothing(){
      alert("ok");
    },

    
  }
};
</script>
<style scoped>
.newdivtop {
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
}
.h4spana {
  font-weight: normal;
  font-size: 15px;
  line-height: 16px;
}
.h4span-r {
  float: right;
  display: inline;
  color: #fff;
  background-color: #f2a553;
  font-size: 16px;
  font-weight: normal;
  padding: 9px 23px;
  border-radius: 3px;
  margin-left: 20px;
}

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

.addright-topa {
  width: 100%;
  height: 290px;
}
.addright-topa-div {
  width: 100%;
  height: auto;
}
.newlabel {
  font-size: 15px;
  color: #666;
}

.addright-centera p {
  font-size: 15px;
  color: #333;
  font-weight: bold;
  line-height: 30px;
}
.addright-centerb p {
  font-size: 15px;
  color: #333;
  font-weight: bold;
  line-height: 30px;
}

.addright-centerb li {
  width: 100%;
  height: 100%;
}

.spaninline {
  display: inline-block;
  width: 40px;
  text-align: center;
}
.plandivaddleft-bot {
  width: 50px;
  height: 40px;
}

.form-controla {
  display: block;
  width: 100%;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border-color ease-in-out 0.15s,
    -webkit-box-shadow ease-in-out 0.15s;
  -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
  transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}

.form-controlb {
  display: block;
  width: 100%;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border-color ease-in-out 0.15s,
    -webkit-box-shadow ease-in-out 0.15s;
  -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
  transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}
button{border:1px solid;cursor:pointer;}
</style>
