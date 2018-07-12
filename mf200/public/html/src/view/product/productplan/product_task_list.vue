<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >
        
        <div class="newdivtop"> 
            <p class="bold left"><font class="s1">种植管理&nbsp;&nbsp;</font><font class="s2">|&nbsp;&nbsp;我的种植任务</font></p>
            <div class="right">
                <select id="select" class="bold" @change="change()">
                    <option value="1">待执行</option>
                    <option value="2">进行中</option>
                    <option value="3">已完成</option>
                </select>
                <button @click="$router.back(-1)">返&emsp;回</button>
            </div>
        </div>

        <div class="pplanulz">
            <ul>
                <li v-for="list in joball" @click="detail(list.t_id,list.status)">
                    <!-- <span class="gb" @click.stop="del(list.t_id)"><img src="/lib/img/public/System_Icon/gb.png"></span> -->
                    <div class="planlidiv">
                        <p class="zz">{{list.t_name}}</p>
                        <p class="planlidivpa">发布人：&nbsp;&nbsp;<span>{{list.add_worker_name}}</span></p>
                        <p style="width:40px; height:4px; background-color:#b0c777; margin:13px 0;"></p>
                        <p class="planlidivpa">负责人：&nbsp;&nbsp;<span>{{list.worker_name}}</span></p>
                        <p class="planlidivpa">作物：&nbsp;&nbsp;<span>{{list.cat_p_name}}</span></p>
                        <p class="planlidivpa">品种：&nbsp;&nbsp;<span>{{list.cat_name}}</span></p>
                        <p class="planlidivpa">分配面积：&nbsp;&nbsp;<span>{{list.grow_area_2}} 平方米</span> </p>
                        <p class="planlidivpa">预计产量：&nbsp;&nbsp;<span>{{list.task_weight_1}} kg</span></p>
                        <p class="planlidivpa">实际产量：&nbsp;&nbsp;<span>{{list.total_output}} kg</span></p>
                        <p class="planlidivpa">发布日期：&nbsp;&nbsp;<span>{{list.add_time}} </span></p>
                        <button v-if="list.status == 0" class="c m" @click.stop="add()">去&emsp;执&emsp; 行</button>
                        <button v-else-if="list.status == 2" class="m" @click.stop="confirm(list.t_id)">确&ensp;认&emsp;完&emsp;成</button>
                    </div>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div id="page_new" class="paing">
            <ul class="pages" v-if="pages > 1">
                <li @click="getjoblist(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
            </ul>
		</div>
    </div>
</div>
</template>

<script>
export default {
  data(){
      return{joball:[],pages:'',page:''}
  },
  
  mounted:function(){
      this.getjoblist(1);
  },

  methods:{
    
    getjoblist:function(page){
        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/pc/Progrowtask/person_growtask";
        jsonData.type = $('#select').val();
        jsonData.page = page;     
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        if(re.status == 1){
            this.joball = re.data; 
            this.pages = re.total.pages;
            this.page = re.total.page;              
        }else{
            layer.msg(re.msg);
        }	
    },
    change(){
        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/pc/Progrowtask/person_growtask";
        jsonData.type = $('#select').val();
        jsonData.page = 1;     
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        if(re.status == 1){
            this.joball = re.data; 
            this.pages = re.total.pages;
            this.page = re.total.page;              
        }else{
            layer.msg(re.msg);
        }	  
    },
    detail(t_id,status){
        if(status == 0){
            window.location.href = "";//待执行界面
        }else{
            this.$router.push({path: '/product/productplan/product_job_details', query: { id:t_id }});
        }
    },
    add(){
        window.location.href = "";//待执行界面 
    },
    confirm(t_id){
        var val = layer.confirm("确认完成", {
            btn: ["确认", "取消"],
            title: [""]
        },function(){
            var sendData = {};
            var jsonData = {};
            sendData.url = "/index.php/pc/Progrowtask/confirm_task";
            jsonData.t_id = t_id;
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
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4span-pr{ float: right; margin-top: 10px;color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 18px; border-radius:3px; margin-left: 20px;  }
.pplanulz{ margin-top: 30px; width: 100%; height: auto; }
.pplanulz ul{ margin-left: -24px;  width: auto; padding-bottom: 20px}
.pplanulz ul li{cursor:pointer;display:inline-block;overflow:hidden;width: 340px; height:400px; margin-left: 24px; margin-bottom:20px;border-radius:4px; box-shadow:0 0 2px #ccc; background-color: #fff;}
.planlidiv{position:relative;left:28px;top:25px;width:277px}
.planlih4span{ font-size: 13px; font-weight: normal; margin-left: 30px;}
.planlidivpa{ margin-top: 10px; font-size: 14px;}
.planlidivpa span{font-weight:bold}
.planlidivlook{width: 160px; height: 30px; margin-top:20px; text-align: center; line-height: 30px; color: #fff; background-color: #b0c777; border-radius:3px;}
.zz{font-size:18px;font-weight:bold}
.gb{position:relative;left:300px;top:20px;cursor:pointer}
.gb img{width:15px}
.f{font-size:16px;font-weight:bold;}
.clear:after{content:".";display:block;height:0;clear:both;visibility:hidden;}
.clear{height:0px; margin:0; padding:0; width:0; border:none; overflow:hidden; }
#page{}
#page_new{margin-top:40px;position:relative;left:30%}
.pages{overflow:hidden}
.pages li{border-style:solid;border-width: 1.8px;border-color:#EAEEF1;border-radius:5px;padding:5px;background-color:white;float:left}
.bold{font-weight:bold}
.s1{font-size:20px}
.s2{font-size:16px}
button{padding-left: 20px;padding-right: 20px;padding-top: 5px;padding-bottom: 5px;color: white;background:#b0c777;border: 0;border-radius: 5px;outline:none}
button:hover{padding-left: 20px;padding-right: 20px;padding-top: 5px;padding-bottom: 5px;color: white;background:#8cbb19;border: 0;border-radius: 5px;outline:none}
select{width:100px;margin-right:20px;height:28px;border:0.5px solid #cdcdcd;cursor:pointer;}
.c{background:#F4A356}
.c:hover{background:#ea9518}
.m{margin-top:20px}
</style>
