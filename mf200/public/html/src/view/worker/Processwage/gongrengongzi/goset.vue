<style scoped>
   body{font-family: "Microsoft YaHei";}
   input{background-color:#fff; }
   select option{background-color:#fff; }
  .demo-carousel{height: 200px; line-height: 200px; text-align: center;}
	.headerb {
		text-align: center;
		padding: 20px 0 0px;
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
        box-shadow: 2px 0px 5px #777;
	}
    
    .icon-mobile{position: absolute; right: 8px;  padding: 5px 10px; font-size:14px;  }
    
    
    .bottomb{ position: fixed; text-indent: 1em; bottom: 0px; height: 50px;  width: 100%; }
    
    .bottodivtwo{ background-color: #fff; text-align: center; border-top: 1px solid #ccc;}
    .bottodivtwoleft{ float: left; background-color: #fff; display: inline; width: 50%; height:50px; text-align: center; }
    .bottodivtworight{ float: left; background-color: #fff; display: inline; width: 50%; height:50px; text-align: center; }
    .tubiaopa{ background: url(/lib/img/public/cropmode/tupiana.png) 16px center no-repeat;}
    .headerspana{ width:60%; display: inline-block;  }
    .headerb p{ height:34px; width:100%; }
    .headerb p span{ width:30%; font-size:13px;  line-height:50px; text-align:center; color:#fff; display:inline-block; }
    .setting{ width:90%; margin:0 auto; }

    .form-group{ margin-top:16px;}
    .form-grouplab{ width:20%; text-align:right; display:inline-block; }
    
    .setting p{ color:#666; font-size:13px; line-height:26px; letter-spacing:1px; }
    .settingtwo{ width:90%; margin:0 auto; text-align:center; font-size:16px; line-height:50px; }
    .changetable{ width:100%; line-height:40px; border-collapse:collapse;}

    .changetable,td{  border: 1px solid #ccc; color:#444; font-size:14px; }
    .active a{ background-color:none; display: inline-block;  border-bottom: 2px solid #fff; height:44px; }

    #myTab li{ width:30%; font-size:13px; line-height:50px; text-align:center; color:#fff; display:inline-block; }
    #myTab li a{ color:#fff; text-decoration:none; }
    #myTab li a:visited{ color:#fff; text-decoration:none; }
    #myTab li a:hover{ color:#fff; text-decoration:none; }
    .layui-layer-close2{ top:80px; }
    .newtanchuang{ width:50%; text-indent:0.5em;  height:36px; line-height:36px;  color:#666; border:1px solid #ccc;  margin:0 auto; display:inline-block; border-radius:5px; }
    .newspan{height:35px; line-height:35px; text-align:center; padding:0px 12px; background-color:#1e9fff; color:#fff; border-radius:3px; display:inline-block; }
    .newdanjia{ width:100%;  height:36px; background: none;  text-indent:1em; border:none; color:#aaa; }
    .newdanjiaspan{ width:70%; margin-left:12px; height:40px; line-height:40px; border-radius:5px; border:1px solid #bbb;  }
    .newdanjiaa{ width:70%; margin-left:12px; height:40px; line-height:40px; border-radius:5px;  border:1px solid #bbb; text-indent:1em; color:#aaa; }
    .thissave{ padding:7px 24px; color:#fff; background-color:#1e9fff; border-radius:3px; display:inline-block; }
    .bottodivtwoleft a{color: #434343; text-decoration:none;}
    .bottodivtwoleft a:visited{color: #434343; text-decoration:none;}
    .bottodivtwoleft a:hover{color: #434343; text-decoration:none;}
    .bottodivtworight a{color: #434343; text-decoration:none;}
    .bottodivtworight a:visited{color: #434343; text-decoration:none;}
    .bottodivtworight a:hover{color: #434343; text-decoration:none;}
</style>

<template>
	<div style="width:100%; height:100%; padding-bottom:90px;">
		
	  <div class="headerb" style="font-size:17px;"><span class="headerspana" onclick="window.history.go(-1)" style="width:10%; position: absolute; left: 3%; background: url(/lib/img/public/cropmode/leftjiantou.png) 16px center no-repeat;">&nbsp;</span><span class="headerspana">工资设置</span>
      
        <p>
            <ul id="myTab" style="border:none;">

                <li class="active" id="doactive"><a href="#setting" data-toggle="tab">设置</a></li>
                <li><a href="#setted" style="margin-top:20x;" data-toggle="tab">已设置工序</a></li>
                <li id="doactivea"><a href="#noset"  style="margin-top:20x;"  data-toggle="tab">未设置工序</a></li>

            </ul>
        </p>  
      </div>
    
      <div style="height:110px; width:100%;"></div>

    <div style=" width:100%; height:100%;">

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade in active" id="setting" style="border:none; height:100%; padding-bottom:0px;">  
            <div class="setting">
                
                <div class="form-group">
                <label class="form-grouplab">工序</label>
                    <select id="skillid" v-on:change="chooseid($event.target)" style="width:70%; margin-left:12px; height:40px; border-radius:5px; line-height:40px; text-indent:1em; border:1px solid #bbb; color:#aaa">
                        <option>请选择工序</option>
                        <option v-for="sclist in skillchoose" v-bind:value="sclist.skill_id">{{sclist.skill_name}}</option>
                    </select>
                </div>

                <div class="form-group">
                <label class="form-grouplab">单位</label>
                <select name="" id="dselect" v-on:change="choosedid($event.target)" style=" width:70%; margin-left:12px; height:40px; border-radius:5px; line-height:40px; text-indent:1em; border:1px solid #bbb; color:#aaa">
                    <option v-for="newlist in skillchoosemore" v-bind:value="newlist.p_id">{{newlist.unit_str}}</option>
                </select>
                </div>

                <div class="form-group">

                    <label class="form-grouplab" style=" height:40px; line-height:40px; float:left;">单价</label>
                    <span class="newdanjiaspan" style="display:inline-block;margin-left:16px; " ><input id="pinput" type="text" v-for="plist in skillprice" v-bind:value="plist.price" class="newdanjia" /></span>

                </div>

       
             
                <div class="form-group" style="text-align:center;">

                    <Span class="thissave" v-on:click="dosave()">保 存</span>
                    
                </div>


            </div>
            <div style="height:16px;"></div>
            <!-- 规则 -->
            <div class="setting">
                <p><font style="color:red;">*</font> 工资核算规则</p>
                <p>工人工资=核查实际工作量X工序单价X评分系数</p>
                <p>注：</p>
                <p>1、核查实际工作量为核查工单时的实际工作量</p>
                <p>2、评分系数为核查工单时评出的分数/100</p>
                <p>例：100x0.5x0.96=48</p>
            </div>
        </div>

        <!-- 第二个 已设置工序 -->
        <div class="tab-pane fade" id="setted" style="border:none;  height:100%; ">  
          <div class="settingtwo">
              <p>工序单价一览表</p>
              <table class="changetable">
                <tr><td>工序</td><td>单位</td><td>单价（元）</td><td>状态</td></tr>

                <tr v-for="settedlist in setted">
                    <td>{{settedlist.skill_name}}</td>
                    <td>{{settedlist.unit_str}}</td>
                    <td>{{settedlist.price}} <img style="margin-left:8px;" src="/lib/img/public/cropmode/z-add-edit-fff.jpg" v-on:click="imgclcik(settedlist.p_id)" /></td>
                    <td><span class="tdspan" v-on:click="dodel(settedlist.p_id)">删除</span></td>
                </tr>

              </table>
          </div>
        </div>

        <!-- 第三个 未设置工序 -->
        <div class="tab-pane fade" id="noset" style="border:none; height:100%; ">  
          <div class="settingtwo">
              <p>未设置单价的工序</p>
              <table class="changetable">
                <tr><td>工序</td><td>单位</td><td>单价(元)</td></tr>

                <tr v-for="setlist in set">
                    <td>{{setlist.skill_name}}</td>
                    <td>{{setlist.unit_str}}</td>
                    <td><span v-on:click="doedit(setlist.p_id)">去完善</span></td>
                </tr>

                <!--<tr><td>打杈</td><td>株</td><td><span>去完善</span></td></tr>
                <tr><td>缠头</td><td>株</td><td><span>去完善</span></td></tr>
                <tr><td>授粉</td><td>株</td><td><span>去完善</span></td></tr>-->      
              </table>
          </div>
        </div>

        <!--第四个 隐藏-->
        <div class="tab-pane fade" id="cangset" style="border:none; height:100%; "> 
            <div class="setting">
                
                <div class="form-group">
                <label class="form-grouplab">工序</label>
                    <select id="skillida" v-on:change="chooseid($event.target)" readonly="readonly" style="width:70%; margin-left:12px; height:40px; border-radius:5px; line-height:40px; text-indent:1em; border:1px solid #bbb; color:#aaa">
                        
                        <option v-for="sclista in cang" v-bind:value="sclista.skill_id">{{sclista.skill_name}}</option>
                    </select>
                </div>

                <div class="form-group">
                <label class="form-grouplab">单位</label>
                <select name="" id="dselecta" v-on:change="choosedid($event.target)" readonly="readonly" style=" width:70%; margin-left:12px; height:40px; border-radius:5px; line-height:40px; text-indent:1em; border:1px solid #bbb; color:#aaa">
                    <option v-for="newlista in cang" v-bind:value="newlista.p_id">{{newlista.unit_str}}</option>
                </select>
                </div>

                <div class="form-group">
                <label class="form-grouplab">单价</label>

                    <input id="pinputa" type="text" value="价格" class="newdanjiaa" />

                </div>
             
                <div class="form-group" style="text-align:center;">

                    <Span class="thissave" v-on:click="dosavea()">保 存</span>
                    
                </div>

            </div>
        </div>    
        <!--第四个 结束-->


      </div>

    </div>


     <div class="bottomb">
         <div class="bottodivtwo">
             <span class="bottodivtwoleft" v-if="num==0">
                 <a href="#/worker/wages">
                    <p style="height:20px; margin-top:3px; line-height:20px; ">
                        <img src="/lib/img/public/cropmode/wages.png" style=" heiht:20px;" />
                    </p>
                    <span style=" display:block; margin-top:-6px; color:#5c9260;">工人工资</span>
                 </a>
             </span>

            <span class="bottodivtwoleft" v-else>
                <a href="#/worker/wages">
                    <p style="height:20px; margin-top:3px; line-height:20px; ">
                        <img src="/lib/img/public/cropmode/wagesed.png" style=" heiht:20px;" />
                    </p>
                    <span style=" display:block; margin-top:-6px;">工人工资</span>
                 </a>
            </span>

             <span class="bottodivtworight" v-if="num==1">
                 <a href="#/worker/set">
                 <p style="height:20px; margin-top:3px; line-height:20px; ">
                     <img src="/lib/img/public/cropmode/setting.png" style=" heiht:20px;" />
                 </p>
                 <span style=" display:block; margin-top:-6px; color:#5c9260;">工资设置</span>
                 </a>
             </span>

             <span class="bottodivtworight" v-else>
                 <a href="#/worker/set">
                 <p style="height:20px; margin-top:3px; line-height:20px; ">
                     <img src="/lib/img/public/cropmode/setted.png" style=" heiht:20px;" />
                 </p>
                 <span style=" display:block; margin-top:-6px;">工资设置</span>
                 </a>
             </span>

             
         </div>
     </div>
     
     <div id="test" style="display:none; overflow:hidden;">

        <div style="width:100%; text-align:center;">
            <div style="height:22px;"></div>
            <input v-for="settedlista in setted" v-if="settedlista.p_id==kid" id="inputida" type="text" class="newtanchuang"  v-bind:value="settedlista.price" />
            <span class="newspan" v-on:click="madesave(kid)">保存</span>
        </div>

     </div>


	</div>
</template>

<script>
export default {

	data(){
		return { 
           num:1,  
           setted:[],
           set:[],
           skillchoose:[],
           skillchoosemore:[],
           skillprice:[],
           kid:'',
           cang:[],
           abid:'',
		}
	},

	mounted: function(){
        this.getsetted();
        this.getset();
        this.getskillchoose();
	},

	methods:{
       //获得已经设置
       getsetted:function(){

           var jsonData = {};
		   var sendData = {};
           sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/workerwages_setted';
		   sendData.data = jsonData;
		   var re = getFaceInfo(sendData);	
           this.setted=re.data;
        
       },

       //获得未设置
       getset:function(){

           var jsonData = {};
		   var sendData = {};
           sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/workerwages_set';
		   sendData.data = jsonData;
		   var re = getFaceInfo(sendData);	
           this.set=re.data;
        
       },

       //工序选择
       getskillchoose:function(){
           
           var jsonData = {};
		   var sendData = {};
           sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/skill_choose';
		   sendData.data = jsonData;
		   var re = getFaceInfo(sendData);	
           this.skillchoose = re.data;
           //console.log(re.data);

       },
       // 工序的单位
       chooseid(obj){
           var jsonData = {};
		   var sendData = {};
           sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/skill_choose_more';
           jsonData.skill_id=obj.value;
		   sendData.data = jsonData;
		   var re = getFaceInfo(sendData);	
           this.skillchoosemore = re.data;
       },

       //工序的钱
       choosedid(obj){

           var jsonData = {};
		   var sendData = {};
           sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/skill_choose_mon';
           jsonData.p_id=obj.value;
		   sendData.data = jsonData;
		   var re = getFaceInfo(sendData);	
           this.skillprice = re.data; 

       },

       imgclcik(nid){
         
         this.kid=nid;
         layer.open({

			type: 1,
			title: "价格编辑",
			area: ["70%", "140px"],
			closeBtn: 1,
			shadeClose: false,
			skin: "layer-add-form",
            content:$("#test"),
            
		 });  
      },

      madesave(aid){
        var pin=$("#inputida").val();
        var dse=aid;
        var jsonData = {};
        var sendData = {};
        
        sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/workerwages_setting';
        jsonData.p_id=dse;
        jsonData.mon=pin;
		sendData.data = jsonData;
		var re = getFaceInfo(sendData);	
        if(re.status==1){
            layer.msg(re.msg);

        }else{

            layer.msg(re.msg);  
        }  


      },


      dodel(){
          
          layer.confirm('删除这个工序？', {

            btn: ['确定','取消'] //按钮
            },function(){
                layer.msg("删除");
            }
            );
      },

      //保存
      dosave(){
        var dse=$("#dselect").val();
        var pin=$("#pinput").val();
        var jsonData = {};
        var sendData = {};
        
        sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/workerwages_setting';
        jsonData.p_id=dse;
        jsonData.mon=pin;
		sendData.data = jsonData;
		var re = getFaceInfo(sendData);	
        if(re.status==1){
            layer.msg(re.msg);
        }else{
            layer.msg(re.msg);  
        }

      },

      dodel(id){

        var jsonData = {};
        var sendData = {};
        sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/workerwages_set_del';
        jsonData.p_id=id;
		sendData.data = jsonData;
        var re = getFaceInfo(sendData);	
        if(re.status==1){
            layer.msg(re.msg);
        }else{
            layer.msg(re.msg);  
        }

      },

      doedit(zid){
          this.abid=zid;
          var jsonData = {};
          var sendData = {};
          sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/workerwages_set_over';
          jsonData.p_id=zid;
		  sendData.data = jsonData;
          var re = getFaceInfo(sendData);
         
          var that=this;	
          if(re.status==1){
            //that.abc=re.data;
            $("#doactivea").removeClass("active");   
            $("#doactive").addClass("active");
            $("#noset").removeClass("active");
            $("#cangset").addClass("tab-pane fade in active");
            
            that.cang=re.data;
          }else{
             layer.msg(re.msg);   
          }

      },


      dosavea(){

        var pin=$("#pinputa").val();
        var jsonData = {};
        var sendData = {};
        
        sendData.url = 'http://27.221.53.90:881/index.php/workerwages/workerwages/workerwages_setting';
        jsonData.p_id=this.abid;
        jsonData.mon=pin;
		sendData.data = jsonData;
        var re = getFaceInfo(sendData);

        if(re.status==1){
            layer.msg(re.msg);
        }else{
            layer.msg(re.msg);  
        }

      },




    },
    
}
</script>
