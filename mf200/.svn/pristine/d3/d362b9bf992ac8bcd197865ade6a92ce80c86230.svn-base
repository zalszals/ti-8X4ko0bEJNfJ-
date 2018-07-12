<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">物料管理&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;领料单</span></font>

            <span class="h4span-r" style="background-color:#b0c777;" @click="$router.back(-1)">返 回</span>
            <span class="h4span-r" v-on:click="dosearch()">筛 选</span>
            <span class="h4span-ra">
                <select class="selclass" id="zquyu">
                    <option value=''>请选择种植区域</option>
                    <option v-for="alist in areaall" v-bind:value="alist.area_id">{{alist.area_name}}</option>
                </select>
            </span>
            <span class="h4span-ra">
                <select class="selclass" id="zrenwu">
                    <option value=''>请选择种植任务</option>
                    <option v-for="tlist in taskall" v-bind:value="tlist.t_id">{{tlist.t_name}}</option>
                </select>
            </span>
            <span class="h4span-ra">
                <select class="selclass" id="zjihua" v-on:change="searchrenwu($event.target)">
                    <option value=''>请选择生产计划</option>
                    <option v-for="plist in planall" v-bind:value="plist.plan_id">{{plist.plan_name}}</option>
                </select>
            </span>
            <span class="h4span-ra">
                <select class="selclass1" id="type" @change="change()">
                    <option value="1">待领料</option>
                    <option value="3">已领料</option>
                </select>
            </span>
            <!--
            <span class="h4span-ra">
                <select class="selclass" id="zlingliao">

                    <option value="3">待领料</option>

                </select>
            </span>
            -->
        </h4>
        </div>
        
        <div class="ncenter">

            <ul>

                <li v-for="llist in lingliao">
                    <a v-bind:href="'#/wuliao/lingliaodan/ddetails?id='+llist.tb_id+'&tname='+llist.t_name+'&areaname='+llist.area_name+'&addname='+llist.add_name+'&usename='+llist.use_name+'&addtime='+llist.add_time">
                        <h4 style="font-weight:bold;">{{llist.t_name}}</h4>
                        <p style="margin-top:10px;">种植区域：{{llist.area_name}}</p>
                        <p>发布人： {{llist.add_name}}</p>
                        <p>领料人： {{llist.use_name}}</p>
                        <p>发布时间： {{llist.add_time}}</p>
                    </a>
                </li>
                
            </ul>

            
            
        </div>


       

    </div>
</div>
</template>

<script>
export default {
  data(){ 
      return {
        lingliao:[],
        planall:[],
        taskall:[],
        areaall:[],
        workerid:'',
        pid:'',
      }
  },
  mounted:function(){
      this.getlingliao();
      this.getplan();
      

  },
  methods:{

    getlingliao:function(){//待领料页面使用 status=1
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/TakeBack/takeback_list";
        jsonData.status=1;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.lingliao=re.data;
        //console.log(this.lingliao);
    },

    //获得生产计划
    getplan:function(){
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/ProTake/plan_list";
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.planall=re.data;
        //console.log(this.planall);
    },

    // 获取种植任务
    searchrenwu(obj){
        this.pid=obj.value;
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/ProTake/grow_list";
        jsonData.plan_id=obj.value;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.taskall=re.data;
        //console.log(this.taskall);

        var arr=re.data;
        for(var i=0;i<arr.length;i++){
            this.areaall=arr[i]['area'];
            this.workerid=arr[i]['worker_id'];
            //this.areaall.push(arr[i]['area']);
        }
    },
    
    //执行搜索
    dosearch(){
        //var staid=$("#zlingliao").val();
        var jihua=$("#zjihua").val();
        var renwu=$("#zrenwu").val();
        var quyu=$("#zquyu").val();

        var sendData = {};
        var jsonData = {};
        if(jihua!=''){
            jsonData.plan_id=jihua;
        }
        if(renwu!=''){
            jsonData.t_id=renwu;
        }
        if(quyu!=''){
            jsonData.area_id=quyu;
        }

        sendData.url="index.php/product/TakeBack/takeback_list";

        jsonData.status=$('#type').val();
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.lingliao=re.data;
        //console.log(this.lingliao);
    },
    change(){
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/TakeBack/takeback_list";

        jsonData.status=$('#type').val();
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.lingliao=re.data;
    }

  


  },
      

  
}
</script>

<style lang="less" scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top: 10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }

.h4span-ra{ float: right; margin-top: 10px; display: inline; color:#fff; font-size: 16px; font-weight: normal; border-radius:3px; margin-left: 16px;  }

.selclass{ height: 36px; border-radius:3px; color: #aaa; width: 160px; padding: 0px 10px;}
.selclass1{ height: 36px; border-radius:3px; color: #000; width: 100px; padding: 0px 10px;}
.ncenter{ width: 100%; height: auto; }
.ncenter li{ width: 406px; height: 226px; background-color: #fff; border-radius:5px; float: left; margin-left: 46px; box-shadow: 0px 0px 2px #e3e3e3; margin-top: 30px; border: 1px solid #e1e1e1; }
.ncenter li h4{ margin-left: 30px; margin-top: 30px;}
.ncenter li p{ font-size:15px; color: #333; line-height: 36px; margin-left: 30px; }


</style>
