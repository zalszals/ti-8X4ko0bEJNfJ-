<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <Div class="newdivtop">
            <h4 style="font-weight:bold;">种植任务&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;已完成的任务</span>
                <span class="h4span-r">返 回</span>

                <span class="h4span-r" style="background-color:#b0c777;" v-on:click="sousou()"><img src="/lib/img/public/cropmode/fangdajing.jpg" />&nbsp;搜 索</span>
                <span class="h4span-ra"><input type="date" style="display:inline-block;width:160px;" class="form-control" name="atime" value=""/> 至 <input type="date" style="display:inline-block;width:160px;" class="form-control" name="btime" value=""/></span>
                
                <span class="h4span-ra"><input type="text" class="form-control" style="width:160px;"  name="fuzeren_name" placeholder="请输入负责人"></span>
                <span class="h4span-ra"><input type="text" class="form-control" style="width:160px;"  name="addman_name" placeholder="请输入发布人"></span>
                <span class="h4span-ra"><input type="text" class="form-control" style="width:160px;"  name="zuowu_name" placeholder="请输入作物"></span>
                
            </h4>
        </Div>

        <div class="overmainnei">
            <ul>
                <!--
                <li>
                    <h4>201804210000001</h4> 
                    <p style="line-height:40px; font-size:15px; font-weight:bold;"><span>吴京</span></p>
                    <p style="width:40px; height:4px; background-color:#f2a553; margin:0px 0px 17px 0px;"></p>
                    
                    <p class="planlidivp">种植模式:<span>叶康栽培</span></p>
                    <p class="planlidivp">种植区域:<span>日光-01</span></p>
                    <p class="planlidivp">预计产量:<span>500 Kg</span></p>
                    <p class="planlidivp">种植面积:<span>50 平方米</span></p>
                   
                    <a href="#/product/planttask/planttask_details">
                        <p style="background-color:#f2a553;border-radius:5px; width:120px; text-align:center; height:30px; margin-top:30px; line-height:30px; color:#fff;">查看更多详情</p>
                    </a>
                </li>
                -->
                
                <li v-for="(nba,index) in joball" :key="index">
                    <h4>{{ nba.ps_name }}</h4> 
                    <p class="planlidivp">负责人:<span>{{ nba.fzr_name }}</span></p>
                    <p style="width:40px; height:2px; background-color:#f2a553; margin-top:5px;"></p>
                    
                    <p class="planlidivp">种植模式:<span>{{nba.grow_date}}</span></p>
                    <p class="planlidivp">种植区域:<span>{{nba.estimate_get_date_1}}</span> 至 <span>{{nba.estimate_get_date_2}}</span></p>
                   
                    <p class="planlidivp">预计产量:<span>{{nba.p_grow_area_2}} 亩</span></p>
                    <p class="planlidivp">实际产量:<span>{{nba.p_grow_area_2}} 亩</span></p>
                    <p class="planlidivp">种植面积:<span>{{ nba.p_amount }} Kg</span></p>
                   
                    <a href="#/product/planttask/planttask_details">
                        <p style="background-color:#f2a553;border-radius:5px; width:120px; text-align:center; height:30px; margin-top:15px; line-height:30px; color:#fff;">查看更多详情</p>
                    </a>
                </li>

            </ul>
            <div style="clear:both"></div>
            <div class="overpage">分页</div> 
        </div>

    </div>
</div>
</template>

<script>
export default {
  data(){return { joball:[],}},
  
  mounted:function(){
      this.changetypedone();
  },
  methods:{
        changetypedone(){            
            var sendData  = {};
            var jsonData  = {};
            sendData.url  = "index.php/product/ProductPlanNew/p_son_all";            
            jsonData.type = 2;            
            sendData.data = jsonData;
            var re = getFaceInfo(sendData);
            this.joball = re.data;

            /* $.ajax({
                url: "http://www.pc200.com/router.php",
                data: sendData,
                dataType: "Json",
                success: function(msg) {
                this.joball = msg.data;
                console.log(msg.data);
                }.bind(this),
                error: function(msg) {
                //alert("错误");
                }
            }); */
        },
        sousou(){
          var that=this;
          var zuowuname=$("input[name='zuowu_name']").val();
          //console.log(zuowuname);
          var addmanname=$("input[name='addman_name']").val();
          //console.log(addmanname);
          var fuzerenname=$("input[name='fuzeren_name']").val();
          //console.log(fuzerenname);
          var atime=$("input[name='atime']").val();
          //console.log(atime);
          var btime=$("input[name='btime']").val();
          //console.log(btime);
          
          var sendData = {};
          var jsonData = {};
          sendData.url ="27.221.53.90:880/index.php/product/ProductPlanNew/product_list";          
          jsonData.cat_name = zuowuname;
          jsonData.catp_name = addmanname;
          jsonData.worker_name = fuzerenname;
          jsonData.type = 2;
          var re = getFaceInfo(sendData);
          if(re.status == 1){
            var ab = re.data;                 
            for(var $i = 0;$i<ab.length; $i++){
                that.planall.push(ab[$i]);
            }
          }  
          sendData.data = jsonData;
            /* $.ajax({
                url: "http://www.pc200.com/router.php",
                data: sendData,
                dataType: "Json",
                success: function(msg) {
                //this.planall = msg.data;
                
                if(msg.status==1){
                    var ab=msg.data;
                    //console.log(ab);
                    for(var $i=0;$i<ab.length; $i++){
                    that.planall.push(ab[$i]);
                    }
                }

                //console.log(msg.data);
                }.bind(this),
                error: function(msg) {
                //alert("错误");
                }
            }); */

        },
   
  }

}
</script>

<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.h4span-ra{float: right; display: inline; font-size: 14px; font-weight: normal; border-radius:3px; margin-left: 20px;}

.overmainnei{ width: 100%; height: 100%;}
.overmainnei ul{ float: left; display: inline; margin-left: -25px;  width: 102%;}
.overmainnei ul li{ width: 320px; height: 380px; float: left; display: inline; padding-left:50px; padding-top:40px;  margin-top: 30px; margin-left: 24px; background-color: #fff; border-radius:5px; box-shadow: 0px 0px 2px #eee;}
.overmainnei ul li p{ font-size: 14px; line-height: 36px;}
.planlidivp span{ font-weight: bold; font-size: 14px; line-height: 36px;  display: inline-block; text-indent: 1em;} 

.overpage{ width: 100%; height: 40px; line-height: 40px; font-size: 14px;  border: 1px solid  red}
</style>
