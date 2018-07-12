<template>
  <div style="width:100%; height:100%">

    <header>工人工单列表<span class="icon-mobile"></span></header>
    
    <div style="width:90%; padding-top: 70px; margin:0 5%;">

        <div class="layui-row" style="text-align:center;">
          

            <div class="layui-col-xs4">
              <div class="grid-demo grid-demo-bg1" :style="{ background: type==0 ? '#e2e2e2':'' }" style="cursor:pointer;height:40px; width:70%; line-height:40px;border:1px solid #e3e3e3; margin:0 auto; border-radius:5px;" v-on:click="do3">
                进行中
              </div>
            </div>
            
            <div class="layui-col-xs4" @click="do0"> 
              <div class="grid-demo cursor" :style="{ background: type==1 ? '#e2e2e2':'' }" style="cursor:pointer;height:40px; width:70%; line-height:40px;border:1px solid #e3e3e3; margin:0 auto; border-radius:5px;">
                待核查
              </div>
            </div>
            
            <div class="layui-col-xs4">
              <div class="grid-demo grid-demo-bg1" :style="{ background: type==2 ? '#e2e2e2':'' }" style="cursor:pointer;height:40px; width:70%; line-height:40px;border:1px solid #e3e3e3; margin:0 auto; border-radius:5px;" v-on:click="do1">
                已完成
              </div>
            </div>

        </div>
      
      <div style="height:30px;"></div>
      <form class="layui-form" action="">
        <input type="text" name="date" id="date" lay-verify="date" placeholder="日期搜索" v-on:change="changeCount()" class="layui-input"  style="width:90%; height:40px; border:1px solid #e3e3e3; border-radius:5px; margin:0 5%;" />
      </form>
    </div>

    <div style="width:90%; padding-top:20px; margin:0 5%;">
      <div class="layui-row" style="text-align:center; ">
      
        <div class="layui-col-xs4">
          <div class="grid-demo grid-demo-bg1" style="height:40px;  overflow:hidden; width:70%; line-height:40px; margin:0 auto;">姓名：<span>{{aalla.worker_name}}</span></div>
        </div>
        
        <div class="layui-col-xs4"> 
          <div class="grid-demo" style="height:40px; width:70%; overflow:hidden; line-height:40px; margin:0 auto; ">部门：<span>{{aalla.group_name}}</span></div>
        </div>
        
        <div class="layui-col-xs4">
          <div class="grid-demo grid-demo-bg1" style="height:40px;  overflow:hidden; width:70%; line-height:40px;  margin:0 auto; ">职务：<span>{{aalla.role_name}}</span></div>
        </div>
        
        </div>
    </div>

    <div style="width:100%; height:auto; margin-top:12px;">
          <ul class="abcde">

              <li v-for="alist in aball" class="centern">
                <p>姓名：{{alist.worker_name}}</p>
                <p>工序：{{alist.skill_name}}</p>
                <p>工作区域：{{alist.area_name}}</p>
                <p>工作量：{{alist.num}}</p>
                <p>工作时间：{{alist.work_date}} {{alist.require_time_1}} {{alist.require_time_2}}</p>
                <p>开始时间：{{alist.s_time}}</p>
                <p>结束时间：{{alist.e_time}}</p>
                  
                  <div class="ben" v-if="alist.status == 0" v-on:click="dodaka(alist.gd_id)">  
                    开始打卡 
                  </div>  
                  <div class="ben" v-else-if="alist.status == 1" v-on:click="overdaka(alist.gd_id)">  
                    结束打卡 
                  </div>

              </li>

          </ul>
    </div>

  </div>
</template>

<style scoped>
   
  .demo-carousel{height: 200px; line-height: 200px; text-align: center;}
	header {
		text-align: center;
		padding: 20px 0 10px;
		color: #fff;
		background: -webkit-linear-gradient(45deg, #5c9260, #79a468);
		background: -o-linear-gradient(45deg, #5c9260, #79a468);
		background: -moz-linear-gradient(45deg, #5c9260, #79a468);
		background: linear-gradient(45deg, #5c9260, #79a468);
		font-size: 20px;
		position: fixed;
		width: 100%;
		top: 0;
		z-index: 99;
	}

  .abcde{ width:80%; margin:0 auto; }
	.centern{ width:100%; margin-top:15px; height:180px; padding:12px 0px;  border-top:1px solid #f2f2f2;  box-shadow:0px 1px 3px #e2e2e2; border-radius:10px; position:relative; }
  .centern p{ line-height:26px; text-indent:1em; }
  
  .ben{ position: absolute; left:70%; top:170px; z-index: 2; color:#666;}
</style>


<script>
export default {
  data(){
		return {
      newchangea:1,
      aball:[],	
      type:0,
      work_date:'',
      area_id:'67',
      aalla:[],
		}
  },

  mounted:function(){
    this.getabc();
    this.getnew();
    this.maninfoall();
  },

  methods:{

    getabc:function(){

      var sendData = {};
      var jsonData = {};
      sendData.url ="http://27.221.53.90:881/index.php/product/WorkerManage/gd_check_list_daka";
      sendData.data = jsonData;
      jsonData.area_id=this.area_id;
      jsonData.work_date=this.work_date;
      //jsonData.page=this.page;
      jsonData.type=this.type;
      var re = getFaceInfo(sendData);
      this.aball = re.data;      
      //console.log(this.aball);

    },

    maninfoall:function(){
		   
		   var a=localStorage.getItem("mf_token");
		   var b=localStorage.getItem("mf_account");
		   var jsonData = {};
		   var sendData = {};

		   jsonData.newphone = b;
		   jsonData.atoken = a;

		   sendData.url = 'http://27.221.53.90:881/index.php/person/PerInfo/get_worker';
		   sendData.data = jsonData;
		   var re = getFaceInfo(sendData);	

		   this.aalla=re.worker;
		   this.newid=re.worker.worker_id;
		   
		},


    do3(){
      this.type = 0;
      this.getabc();
    },

    do0(){
      this.type = 1;
      this.getabc();
    },
    do1(){
      this.type = 2;
      this.getabc();
    },

    dodaka(nid){
      
       var sendData = {};
       var jsonData = {};
       sendData.url ="http://27.221.53.90:881/index.php/product/WorkerManage/gd_check_list_daka_go";
       jsonData.gd_id=nid;
       //console.log(nid);
       sendData.data = jsonData;
       var re = getFaceInfo(sendData);
       var that= this;
       if(re.status==1){
         layer.msg(re.msg);
         
       }else{
         layer.msg(re.msg);
       }

    },

    overdaka(cesid){

       var sendData = {};
       var jsonData = {};
       sendData.url ="http://27.221.53.90:881/index.php/product/WorkerManage/gd_check_list_daka_over";
       jsonData.gd_id=cesid;
       //console.log(nid);
       sendData.data = jsonData;
       var re = getFaceInfo(sendData);
       
       if(re.status==1){
         layer.msg(re.msg);
       }else{
         layer.msg(re.msg);
       }
      
    },

  getnew(){
    var vueObj = this;
      layui.use(['form', 'layedit', 'laydate'], function(){
        var form = layui.form
        ,layer = layui.layer
        ,layedit = layui.layedit
        ,laydate = layui.laydate;
        
        laydate.render({ 
          elem: '#date',
          done: function(value, date, endDate){
            vueObj.work_date=value;
            vueObj.getabc();
           
          }
         
        
        });

      });
    },

  },
  



}
</script>
