<template>
  <div id="left-box" >
    <div style=" width: 100%; height: 100%;">

        <div class="newdivtop"> 
        <div style="">
            <div class="left wb30">
                工单管理&nbsp;&nbsp;<span class="">|&nbsp;&nbsp;工单核查</span>
            </div>
            <!--
            <span class="h4span-r" style="background-color:#b0c777;">返 回</span>
            <span class="h4span-r">发 布</span>
            -->
           <ul class="right wb70 clear">
                <li class="left w100">
                    <select class="form-control w100" id="groupselect" @change="getlist(1,1)">
                        <option value="0">未打卡</option>
                        <option value="1">进行中</option>
                        <option value="2">待核查</option>
                        <option value="3">已完成</option>
                    </select>
                </li>
                <li class="left w160">
                    <input id="start" class="form-control w160" type="date" placeholder="请选择开始时间"/>
                </li>
                <li class="left w100">
                    <label>至</label>
                </li>
                <li class="left w160">
                    <input id="end" class="form-control w160"  type="date" placeholder="请选择结束时间"/>
                </li>
                <li class="left w160">
                    <input id="worker" class="form-control w160" style="" placeholder="请输入姓名" />
                </li>    
                <li class="left w80">
                    <span class="rightspana" @click="getlist(1,2)">筛选</span> 
                </li>               
           </ul>
        </div>
        </div>

        <div class="mainnew">
            <ul>
                <li v-for="(item,index) in data" :key="index">
                    <h4 style="line-height:40px; margin-top:12px; font-weight:bold; text-align:center;">工人名称：{{item.worker_name}}</h4>

                    <p style="width:75%; padding-left:25%; padding-top:20px;">
                        <span class="span-inline">工序：{{item.skill_name}}<p></p></span>
                        <span class="span-inline" style="margin-left:10px;">工作区域：<p>{{item.area_name}}</p></span>
                    </p>

                    <p style="width:75%; padding-left:25%; padding-top:20px;">
                        <span class="span-inline"  style="width:140px;">工作量：<p>{{item.num}}{{item.unit}}</p></span>
                    </p>
                    <p style="width:75%; padding-left:25%; padding-top:20px;">
                        <span class="span-inline"  style="width:140px;">工作时间：<p>{{item.work_date}}&nbsp;{{item.require_time_1}}-{{item.require_time_2}}</p></span>
                    </p>
                    <p style="width:75%; padding-left:25%; padding-top:20px;">
                        <span class="span-inline">开始工作时间：<p v-if="item.s_time">{{item.s_time}}</p><p v-else></p></span>
                    </p>

                    <p style="width:75%; padding-left:25%;  padding-top:20px;">
                        <span class="span-inline">结束工作时间：<p v-if="item.e_time">{{item.e_time}}</p><p v-else></p></span>
                    </p>

                    <p style="bottom:10px; height:30px;  width:100%; text-align:center; position: absolute;" v-if="item.status == 2">
                        <span class="centercheck" @click="edit(item.gd_id)">核 查</span>
                    </p>
                </li>
            </ul>
        </div>
        <div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getlist(item,state)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
			</ul>
		</div>
    </div>
  </div>
</template>
<style scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-rh{ float: right; display: inline; }
.rightspana{float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px; }
.mainnew li{ width:308px; height: 400px;display: inline-block; background-color: #fff; margin-left:30px; margin-top:20px; position:relative; overflow:hidden}
.span-inline{ display:inline-block; text-align: left;}
.centercheck{ background-color:#b0c777;border-radius:5px; width:80px; height:30px; line-height: 30px; margin: 0 auto; color:#fff; display:block;  }
#page {
		
}
#page_new {
    margin-bottom: 40px;
    position: relative;
    left: 30%;
}

.pages {
    overflow: hidden;
}

.pages li {
    border-style: solid;
    border-width: 1.8px;
    border-color: #EAEEF1;
    border-radius: 5px;
    padding: 5px;
    background-color: white;
    float: left;
}
</style>
<script>
export default {
  data() {
        return {
            data:[],
            item:[],
            pages:'',
            page:'',
            state:1
        }
    },
    mounted:function(){
        this.getlist(1,1);
    },
    methods: {
        getlist(page,state){
            var sendData = {};
            var jsonData = {};
            sendData.url = "/index.php/pc/WorkerOrder/gd_check_list";
            jsonData.type = $('#groupselect').val();
            jsonData.page = page;
            if(state == 2){
                this.state = 2;
                jsonData.type = $('#groupselect').val();
                jsonData.start = $('#start').val();
                jsonData.end = $('#end').val();
                jsonData.worker = $('#worker').val();  
            }else{
                this.state = 1;
            }
            sendData.data = jsonData;
            var re = getFaceInfo(sendData);
            if(re.status == 1){
                this.data = re.data;
                this.pages = re.total.pages;
				this.page = re.total.page;
            }else{
               layer.msg(re.msg); 
            }
        },
        edit(gd_id){
            this.$router.push({path: '/worker/workerorder/order_list_check', query: { gd_id:gd_id }});
        }
    }
}
</script>
