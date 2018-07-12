<style lang="less" scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;  }
.h4span-r{ float: right; margin-top:10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }

.plandivadd {
  margin: 30px 50px;
  
}

.plandivaddleft {
  float: left;
  display: inline;
  width: 50px;
  height: auto;
  margin-right: 20px;
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
.plandivaddrighta { width: 100%; 
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

.choosebaib{ width: 1070px; height: 126px; background-color:#fff; border-radius:6px; box-shadow: 0px 0px 5px #e2e2e2; padding: 30px;}
.choosebaib p{ line-height: 40px; font-size: 16px; color: #333;}

.choosebaispanb{ width: 196px; display: inline-block; margin-top: 10px;}

.newsul{ width: 100%; height: auto; }
.newsul li{ width: 540px; height: 250px; float: left; display: inline; }
.newsul li p{ width: 100%; height: auto; }
.newsulspan{ display: inline-block; width: 260px; line-height: 80px; font-size:16px; color: #333;  }
.abnewpspan{ display: inline-block; }
.rightzhspan option{
    color: #666;
}
</style>

<template>
<div id="left-box">
    <div style=" width: 100%; height: 100%;" >
        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">物料管理&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;记录能耗</span></font>
            <span class="h4span-r" style="background-color:#b0c777;">返 回</span>
            <span class="h4span-r" v-on:click="dosave()">完 成</span>
        </h4>
        </div> 

        <div class="plandivadd" >
            <!--left-->
            
            <!--left-->

            <!--right-->
            <div class="plandivaddrighta" >
    
                    <h4 class="rightzh">选择种植区域</h4>
                    <select class="rightzhspan" id="huodei" v-on:change="gettask($event.target)">
                        <option>请选择种植区域</option>
                        <option style="color:#666;" v-for="alist in areaall" v-bind:value="alist.area_id">{{alist.area_name}}</option>
                    </select>

                    <div class="chooserenwu">
                        <h4 class="rightzh">选择种植任务</h4>
                        <select class="rightzhspan" v-on:change="doshow($event.target)">
                            <option>请选择种植任务</option>
                            <option style="color:#666;" v-for="tlist in taskall" v-bind:value="tlist.t_id">{{tlist.task_name}}</option>
                        </select>
                    </div>

                    <div class="choosebaib hide" id="zebai">
                        <h4 style="font-weight:bold;">负责人：{{growall.worker_name}}</h4>
                        <p>
                            <span class="choosebaispanb">作物：{{growall.cat_name}}</span>
                            <span class="choosebaispanb">品种：{{growall.cat_p_name}}</span>
                            <span class="choosebaispanb">果形：{{growall.ftype}}</span>
                            <span class="choosebaispanb">果色：{{growall.fcolor}}</span>
                            <span class="choosebaispanb">已定植天数：{{growall.gd_num}}</span>
                        </p>
                    </div>

                <!--right 第二部分-->
               
                <div class="maintwo" style=" width:100%;">
                    <p>
                        <span class="abnewpspan">
                            <h4 style="color:#f2a553; margin-top:20px; line-height:40px;">开始时间</h4>
                            <input type="time" id="b_time" class="form-control" style="width:200px; display:inline-block" placeholder="请选择时间" >
                        </span>
                        <span class="abnewpspan" style="margin-left:120px;">
                            <h4 style="color:#f2a553; margin-top:20px; line-height:40px;">结束时间</h4>
                            <input type="time" id="o_time" class="form-control" style="width:200px; display:inline-block" placeholder="请选择时间" >
                        </span>
                    </p>

                    <p>
                        <span class="abnewpspan">
                            <h4 style="color:#f2a553; margin-top:20px; line-height:40px;">种植日期</h4>
                            <input type="date" id="day" class="form-control" style="width:200px; display:inline-block" placeholder="请选择日期" >
                        </span>
                    </p>

                    <p>
                        <span class="abnewpspan">
                            <h4 style="color:#f2a553; margin-top:20px; line-height:40px;">天然气</h4>
                            <label style="display:block;">使用数量</label>
                            <input type="text" class="form-control" id="num0" style="width:200px; display:inline-block" placeholder="请输入使用数量" > <label style="display:inline-block;"> 立方米</label>
                        </span>
                        <span class="abnewpspan" style="margin-left:70px; ">
                            <h4 style="color:#f2a553; margin-top:20px; line-height:40px;"></h4>
                            <label style="display:block;">单价</label>
                            <input type="text" class="form-control" id="danjia0" style="width:200px; display:inline-block"  placeholder="请输入单价" v-on:blur="dosuma()"> <label style="display:inline-block;"> 元</label>
                        </span>

                        <span class="abnewpspan" style="margin-left:100px;">
                            <h4 style="color:#f2a553; margin-top:20px; line-height:40px;">二氧化碳</h4>
                            <label style="display:block;">使用数量</label>
                            <input type="text" class="form-control" id="num1" style="width:200px; display:inline-block"  placeholder="请输入使用数量" > <label style="display:inline-block;"> Kg</label>
                        </span>

                        <span class="abnewpspan" style="margin-left:70px;">
                            <label style="display:block;">单价</label>
                            <input type="text" class="form-control" id="danjia1" style="width:200px; display:inline-block"  placeholder="请输入单价" v-on:blur="dosumb()"> <label style="display:inline-block;"> 元</label>
                        </span>
                    </p>
                    <p>
                        <span class="abnewpspan" style="width:650px;">
                            <h4 style=" line-height:40px;">总费用：<input name="monry" style="border:none; background-color:#F3F9F9; display:inline-block; min-width:40px; max-width:80px;" v-bind:value="tovera" /> 元</h4>
                        </span>
                       

                        <span class="abnewpspan" style="margin-left:0px;">
                            <h4 style=" line-height:40px;">总费用：<input name="monry" style="border:none; background-color:#F3F9F9; display:inline-block; min-width:40px; max-width:80px;" v-bind:value="toverb" /> 元</h4>
                        </span>
                    </p>

                    <p>
                        <span class="abnewpspan">
                            <h4 style="color:#f2a553; margin-top:20px; line-height:40px;">水</h4>
                            <label style="display:block;">使用数量</label>
                            <input type="text" class="form-control" id="num2" style="width:200px; display:inline-block" placeholder="请输入使用数量" > <label style="display:inline-block;"> 立方米</label>
                        </span>
                        <span class="abnewpspan" style="margin-left:70px; ">
                            <h4 style="color:#f2a553; margin-top:20px; line-height:40px;"></h4>
                            <label style="display:block;">单价</label>
                            <input type="text" class="form-control" id="danjia2" style="width:200px; display:inline-block"  placeholder="请输入单价" v-on:blur="dosumc()"> <label style="display:inline-block;"> 元</label>
                        </span>

                        <span class="abnewpspan" style="margin-left:100px;">
                            <h4 style="color:#f2a553; margin-top:20px; line-height:40px;">电</h4>
                            <label style="display:block;">使用数量</label>
                            <input type="text" class="form-control" id="num3" style="width:200px; display:inline-block"  placeholder="请输入使用数量" > <label style="display:inline-block;"> Kw/h</label>
                        </span>

                        <span class="abnewpspan" style="margin-left:70px;">
                            <label style="display:block;">单价</label>
                            <input type="text" class="form-control" id="danjia3" style="width:200px; display:inline-block"  placeholder="请输入单价" v-on:blur="dosumd()"> <label style="display:inline-block;"> 元</label>
                        </span>
                    </p>
                    <p>
                        <span class="abnewpspan" style="width:650px;">
                            <h4 style=" line-height:40px;">总费用：<input name="monry" style="border:none; background-color:#F3F9F9; display:inline-block; min-width:40px; max-width:80px;" v-bind:value="toverc" /> 元</h4>
                        </span>
                       
                        <span class="abnewpspan" style="margin-left:0px;">
                            <h4 style=" line-height:40px;">总费用：<input name="monry" style="border:none; background-color:#F3F9F9; display:inline-block; min-width:40px; max-width:80px;" v-bind:value="toverd" /> 元</h4>
                        </span>
                    </p>
                    <p>
                        <h4 style="color:#f2a553; margin-top:20px; line-height:40px;">总费用和：{{money}} 元</h4>
                    </p>
                    <p style="height:120px;"></p>

                     
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
        areaall:[],
        taskall:[],
        growall:[],
        areaid:'',
        areaname:'',
        tid:'',
        tovera:0,
        toverb:0,
        toverc:0,
        toverd:0,
        money:0,
    }
      
  },
  mounted:function(){
    this.getarea();
    
  },
  methods:{
    //获取种植区域下拉
    getarea:function(){
        var sendData = {};
        var jsonData = {};
        //sendData.url="index.php/product/ProLosses/pro_area_list";接口不能获取数据
        sendData.url="index.php/product/ProTake/pro_area_list";
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.areaall=re.data;
        //console.log(this.areaall);
    },

    //获取种植任务下拉
    gettask(obj){
        this.areaname=$("#huodei").find("option:selected").text()
        this.areaid=obj.value;
        
        //console.log(ab);
        var sendData = {};
        var jsonData = {};
        //sendData.url="index.php/product/ProLosses/pro_task_list";接口数据有问题
        sendData.url="index.php/product/ProTake/pro_task_list";
        jsonData.area_id=obj.value;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.taskall=re.data;
        
    },

    doshow(obj){
        this.tid=obj.value;
        var sendData = {};
        var jsonData = {};
        //sendData.url="index.php/product/ProLosses/m_task_list"; 获取失败
        sendData.url="index.php/product/ProTake/pt_addinfo";
        jsonData.t_id=obj.value;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.growall=re.data;

        $("#zebai").fadeIn(2000).removeClass("hide");
    },
    //天然气 总价
    dosuma(){
        var a=$("#num0").val();
        var b=$("#danjia0").val();
        var c=a*b;
        this.tovera=c.toFixed(2);
    },
    //二氧化碳 总价
    dosumb(){
        var a=$("#num1").val();
        var b=$("#danjia1").val();
        var c=a*b;
        this.toverb=c.toFixed(2);
    },
    //水 总价
    dosumc(){
        var a=$("#num2").val();
        var b=$("#danjia2").val();
        var c=a*b;
        this.toverc=c.toFixed(2);
    },
    //电 总价
    dosumd(){
        var a=$("#num3").val();
        var b=$("#danjia3").val();
        var c=a*b;
        this.toverd=c.toFixed(2);
        //总价格 计算  
        this.money=parseFloat(this.tovera)+parseFloat(this.toverb)+parseFloat(this.toverc)+parseFloat(this.toverd);  
    },

    //添加
    dosave(){
        var arr=[];
        for(var i=0;i<4;i++){
            arr.push([
                $("#num"+i).val(),
                $("#danjia"+i).val()
               
            ]);
        };
        var tree = "[";
 　　     for (var i = 0 ;i < arr.length ; i++){
   　　　      tree += "[";
   　　　      tree += arr[i][0]+",";          
              tree += arr[i][1];
  　　　       tree += "]";
    　　　     if(i<arr.length-1){
        　　 　　   tree+=",";
    　　　      }
  　         }
  　   tree+="]";


        console.log(tree);

        var b_time=$("#b_time").val();
        var o_time=$("#o_time").val();

        //console.log(arr);
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/ProLosses/add_prolos";
        jsonData.t_id=this.tid;
        jsonData.date_1=b_time;
        jsonData.date_2=o_time;
        jsonData.area_id=this.areaid;
        jsonData.area_name=this.areaname;
        jsonData.prolosses_array=tree;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        if(re.status==1){
            layer.msg(re.msg);
        }else{
            layer.msg(re.msg);
        }

    },


  }
  
}


</script>
