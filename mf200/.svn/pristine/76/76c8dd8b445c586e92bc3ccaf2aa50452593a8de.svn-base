<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
            <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">种植任务&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;详情</span></font>
                <span class="h4span-r" style="background-color:#b0c777;cursor:pointer" @click="$router.back(-1)">返 回</span>
            </h4>
        </div>

        <div class="planttaskdetails">

            <table>
                <tr><td class="zz">{{getzhz.t_name}}</td></tr>
                <tr><td><span>发布人：</span>{{getzhz.add_worker_name}}</td></tr>
                <tr><td><span>负责人：</span>{{getzhz.worker_name}}</td></tr>
                <tr><td><span>作物：</span>{{getzhz.cat_name}}</td><td><span>作物：</span>{{getzhz.cat_p_name}}</td></tr>
                <tr><td><span>果型：</span>{{getzhz.ftype}}</td><td><span>果色：</span>{{getzhz.fcolor}}</td></tr>
                <tr><td><span>计划定植时间：</span>{{getzhz.date}}</td><td><span>计划采收期：</span>{{getzhz.get_date_1}} 至 {{getzhz.get_date_2}}</td></tr>
                <tr><td><span>分配面积：</span>{{getzhz.grow_area_2}} 平方米</td><td v-if="getzhz.status > 0"><span>种植模式：</span>{{getzhz.mode_name}}</td><td v-else><span>种植模式：</span>——</td></tr>
                <tr v-if="getzhz.status > 0"> <td><span>种植区域：</span><font v-for="(item,index) in getzhz.area" :key="index">{{item.area_name}}&nbsp;</font></td><td><span>种植面积：</span><font v-for="(item,index) in getzhz.area" :key="index">{{item.area_num}}&nbsp; 平方米</font></td></tr>
                <tr v-else><td><span>种植区域：</span><font>——</font></td><td><span>种植面积：</span><font>——</font></td></tr>
                <tr v-if="getzhz.status > 0"><td><span>株距：</span>{{getzhz.zhu_ju}} cm</td><td><span>行距：</span>{{getzhz.hang_ju}} cm</td></tr>
                <tr v-else><td><span>株距：</span>——</td><td><span>行距：</span>——</td></tr>                                                                     
                <tr><td><span>定植数量：</span>{{getzhz.total_grow_num}} 株</td></tr>
                <tr v-if="getzhz.status > 0"><td><span>实际定植时间：</span>{{getzhz.grow_date}}</td><td><span>实际采收期：</span>{{getzhz.estimate_get_date_1}} 至 {{getzhz.estimate_get_date_2}}</td></tr>
                <tr v-else><td><span>实际定植时间：</span>——</td><td><span>实际采收期：</span>——</td></tr>
                <tr><td><span>预计产量：</span>{{getzhz.task_weight_1}} kg</td><td><span>实际产量：</span>{{getzhz.total_output}} kg</td></tr>
                <tr><td><span>状态：</span><font v-if="getzhz.status < 2" class="mo">待执行</font> <font v-else-if="getzhz.status == 2" class="mo">进行中</font><font v-else class="mt">已完成</font></td></tr>
            </table>
        </div>

    </div>
</div>    
</template>
<script>
export default {
 data(){
    return{
        tid:'',
        getzhz:[],
    }
 },
 
 mounted:function(){

    this.tid=this.$route.query.id;
    this.getdetails();
 },

 methods:{

   getdetails:function(){
    var sendData = {};
    var jsonData = {};
        
    sendData.url ="index.php/pc/Progrowtask/person_growtask_detail";
        
    jsonData.t_id=this.tid;
    sendData.data = jsonData;
    var re = getFaceInfo(sendData);
    this.getzhz = re.data;
   },

 },

 
}
</script>
<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;    }
.h4span-r{ float: right; margin-top:10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.planttaskdetails{ margin: 30px;}
.zz{color:#f2a553;font-size:20px}
table{margin-top:15px}
table tr{height:60px;}
table tr td{width:300px}
table tr td span{font-weight:bold}
.mo{color:#f2a553}
.mt{color:#b0c777}
</style>
