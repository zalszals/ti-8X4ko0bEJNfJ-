<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >
        <div class="newdivtop"> 
            <p class="bold left"><font class="s1">种植管理&nbsp;&nbsp;</font><font class="s2">|&nbsp;&nbsp;生产计划</font></p>
            <div class="right">
                <select id="select" class="bold" @change="getinfo(1,1)">
                    <option value="1">进行中</option>
                    <option value="2">已完成</option>
                </select>
                <input type="text" placeholder=" 请选择开始时间" id="start"/><font class="bold">至 </font> 
                <input type="text" placeholder=" 请选择结束时间" id="end"/>
                <input type="text" placeholder=" 请输入作物或品种名称" id="cat_name"/>
                <button @click="getinfo(1,2)"><img src="/lib/img/public/System_Icon/search.png" class="img">搜 索</button>
                <button class="c button or" @click="fabu()">发布生产计划</button>
                <button @click="$router.back(-1)">返 回</button>
            </div>
            <div class="clear"></div>
            <!-- <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">生产计划</font>
                <a class="h4span-pr" style="color:#fff;"  href="#/product/productplan/product_plan_done" >返回</a>
                <a class="h4span-pr" style="color:#fff;" href="#/product/productplan/pro_plan_add">发布生产计划</a>
            </h4> -->
        </div>

        <div class="pplanula">
            <ul>
                <li v-for="abc in planall">
                    <span class="gb" @click.stop="del(abc.plan_id)"><img src="/lib/img/public/System_Icon/gb.png"></span>
                    <div class="planlidiv">
                        <h4>{{abc.plan_name}}</h4>
                        <h5 style="line-height:40px; font-size:14px;">发布人：<b> {{ abc.worker_name }}</b></h5>

                        <p v-if="abc.type == 1" style="width:40px; height:4px; background-color:#b0c777; margin:5px 0px 17px 0px;"></p>
                        <p v-else style="width:40px; height:4px; background-color:#F4A356; margin:5px 0px 17px 0px;"></p>
                        <p class="planlidivp">作物:<span>{{abc.cat_name}}</span></p>
                        <p class="planlidivp">品种:<span>{{abc.cat_p_name}}</span></p>
                        <p class="planlidivp">果型:<span>{{abc.fc_name}}</span></p>
                        <p class="planlidivp">果色:<span>{{abc.ft_name}}</span></p>
                        
                        <p class="planlidivp">总种植面积:<span>{{abc.grow_area_2}} 平方米</span></p>
                        <p class="planlidivp">预计产量:<span>{{abc.estimate_amount}} Kg</span></p>
                        <p class="planlidivp">发布日期:<span>{{abc.add_time}}</span></p>
                        <a v-bind:href="'#/product/productplan/product_plan_list?id='+abc.plan_id+'&pname='+abc.plan_name+'&addtime='+abc.add_time"><p  v-if="abc.type ==1" class="planlidivlook">查看更多详情</p><p  v-else class="planlidivlookt">查看更多详情</p></a>
                    </div>
                </li>
            </ul>
        </div>
        <div id="page_new" class="paing">
            <ul class="pages" v-if="pages > 1">
                <li @click="getinfo(item,state)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
            </ul>
		</div>
    </div>
</div>
</template>

<script>
export default {
  data(){ return{ planall:[],pages:'',page:'',val:'',state:1} },
  mounted:function(){
        this.getinfo(1,1);
        laydate.render({
            elem: '#start',
            showBottom: false,
            theme: '#molv'
        });
        laydate.render({
            elem: '#end',
            showBottom: false,
            theme: '#molv'
        });
  },
  methods:{
      getinfo:function(page,state){

        var sendData = {};
        var jsonData = {};
        
        sendData.url ="index.php/pc/ProductPlan/product_list";
        
        jsonData.type = $('#select').val();
        jsonData.page = page;
        if(state == 2){
            this.state = 2;
            jsonData.cat_name = $("#cat_name").val();
            jsonData.s_time = $("#start").val();
            jsonData.e_time = $("#end").val();
        }else{
            this.state = 1;
        }
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        if(re.status ==1){
            this.planall=re.data;
            this.pages = re.total.pages;
			this.page = re.total.page;
        }
      },
      fabu(){
          window.location.href = "#/product/productplan/pro_plan_add";
      },
      del(plan_id) {
            var val = layer.confirm("确认删除", {
                    btn: ["确认", "取消"],
                    title: [""]
                },function(){
                    var sendData = {};
                    var jsonData = {};
                    sendData.url = "/index.php/pc/ProductPlan/del_product_plan";
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
    }
}
</script>

<style scoped>
html{cursor:pointer;}
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}

.h4span-pr{ float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; margin-top: 10px; padding:9px 18px; border-radius:3px; margin-left: 20px;  }
.pplanula{ margin-top: 30px; width: 100%; height: auto; }
.pplanula ul{ margin-left: -24px;  width: auto; height: auto; padding-bottom: 20px;}
.pplanula ul li{display:inline-block;overflow:hidden;width: 340px; height: 432px;margin-left: 24px; margin-bottom:20px;border-radius:4px; box-shadow:0 0 2px #ccc; background-color: #fff; }

.planlidiv{position:relative;left:30px;top:22px;width:310px}
.planlih4span{ font-size: 13px; font-weight: normal; margin-left: 30px; display:inline-block;  }
.planlidivp{ height:18px; line-height: 18px; margin-bottom: 13px; font-size: 14px; color: #666;}
.planlidivp span{ color: #444; font-weight: bold; display: inline-block; text-indent: 1em;}
.planlidivlook{ width: 160px; height: 30px; text-align: center;display: block; margin-top:30px; line-height: 30px; color: #fff; background-color: #b0c777; border-radius:3px;}
.planlidivlookt{ width: 160px; height: 30px; text-align: center;display: block; margin-top:30px; line-height: 30px; color: #fff; background-color: #F4A356; border-radius:3px;}
.bold{font-weight:bold}
.s1{font-size:20px}
.s2{font-size:16px}
.clear{clear:both}
button{padding-left: 20px;padding-right: 20px;padding-top: 5px;padding-bottom: 5px;color: white;background:#b0c777;border: 0;border-radius: 5px;outline:none}
button:not(.c):hover{padding-left: 20px;padding-right: 20px;padding-top: 5px;padding-bottom: 5px;color: white;background:#8cbb19;border: 0;border-radius: 5px;outline:none}
.c{background:#F4A356}
.c:hover{background:#ea9518}
.planlidivlook:hover{background:#8cbb19}
.planlidivlookt:hover{background:#ea9518}
.right input{margin-right:10px;width:160px;height:28px;border:0.5px solid #cdcdcd}
.right select{margin-right:10px;width:90px;height:28px;border:0.5px solid #cdcdcd;cursor:pointer;}
#start,#end{background:#fff url(/lib/img/public/System_Icon/date.png) no-repeat 130px 2px;background-size:22px;cursor:pointer;}
.img{width:14px;margin-right:5px}
#page{}
#page_new{margin-top:40px;position:relative;left:30%}
.pages{overflow:hidden}
.pages li{border-style:solid;border-width: 1.8px;border-color:#EAEEF1;border-radius:5px;padding:5px;background-color:white;float:left}
.gb{position:relative;left:300px;top:20px;cursor:pointer}
.gb img{width:15px}
</style>
