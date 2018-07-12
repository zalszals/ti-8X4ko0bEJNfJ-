<template>
	<div id="left-box" >
		<div style=" width: 100%; height: 100%; ">
			<div class="main-left-m-top">
				<div class="main-left-m-top-left">
					<H4 style="font-weight:bold; margin-top:14px;">作物管理&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;添加品种</span></H4>
				</div>

				<div class="main-left-m-top-right">
					<span style="background-color:#b0c777; cursor:pointer;" v-on:click="gohistory()">返 回</span>
					<span v-on:click="catadd()" style=" cursor:pointer;" role="button" >完 成</span>
				</div>
				<div style="clear:both"></div>
			</div>
			<div class="main-left-m-center" >
				<div class="add-form-div" style="padding-bottom：0; margin:0px;">
					<form class="form-horizontal">
						<fieldset>
						<div class="control-group">              
              <div style="position:relative; width:283px; display:inline-block;">
                <label class="control-label" for="input01" style="width:43px; display:inline-block; text-align:left;">作物</label>
                <span style="position:absolute;border:1pt solid #ccc; border-radius:4px; box-shadow: inset 0 1px 1px rgba(0,0,0,.075); overflow:hidden;width:188px; height:34px; clip:rect(-1px 190px 190px 170px);">  
                  <select id="cat_name" style="width:190px; height:34px; margin:-2px;" v-on:change="changeFd();">
                    <option value="" style="display:none;"></option>
                    <option v-for="item in catall" v-bind:value="item.cat_id">{{ item.cat_name }}</option> 
                  </select>  
                </span>
                <span style="position:absolute; border-left:1pt solid #ccc;border-top:1pt solid #ccc; border-bottom:1pt solid #ccc;border-top-left-radius:4px; border-bottom-left-radius:4px; width:170px; height:34px;left:43px; background-color:none;">  
                  <input type="text" name="makeupCow" id="makeupCow" placeholder="请选择作物" autoComplete="off" style="width:170px;height:30px; color:#999; border-radius:4px; text-indent:0.5em;border:0pt; margin-left:0px; background-color:none;">  
                </span>
              </div>


						</div>

						<div class="control-group">

            <div style="position:relative; width:283px; display:inline-block;" v-if="step">
                <label class="control-label" for="input01" style="width:43px; display:inline-block; text-align:left;">果型</label>
                <span style="position:absolute;border:1pt solid #ccc; border-radius:4px; box-shadow: inset 0 1px 1px rgba(0,0,0,.075); overflow:hidden;width:188px; height:34px; clip:rect(-1px 190px 190px 170px);">  
                  <select id="cat_guoxing" style="width:190px; height:34px; margin:-2px;" v-on:change="changeF();">
                    <option value="" style="display:none;"></option>
                    <option v-for="itemg in catguoxinglist" :value="itemg.ft_id" :data="itemg.ft_name">{{itemg.ft_name}}</option>  
                  </select>  
                </span>
                <span style="position:absolute; border-left:1pt solid #ccc;border-top:1pt solid #ccc; border-bottom:1pt solid #ccc;border-top-left-radius:4px; border-bottom-left-radius:4px; width:170px; height:34px;left:43px; background-color:none;">  
                  <input type="text" name="makeupCo" id="makeupCo" placeholder="请选择果型" autoComplete="off" style="width:170px;height:30px; color:#999; border-radius:4px; text-indent:0.5em;border:0pt; margin-left:0px; background-color:none;">  
                </span>
            </div>

            <div style="position:relative; width:290px; display:inline-block;" v-if="step">
                <label class="control-label" for="input01" style="width:43px; display:inline-block; text-align:left;">果色</label>
                <span style="position:absolute;border:1pt solid #ccc; border-radius:4px; display:inline-block; box-shadow: inset 0 1px 1px rgba(0,0,0,.075); overflow:hidden;width:188px; height:34px; clip:rect(-1px 190px 190px 170px);">  
                  <select id="cat_guose" style="width:190px; height:34px; margin:-2px;" v-on:change="changeFa();">
                      <option value="" style="display:none;"></option>  
                      <option v-for="items in catguoselist" :value="items.ft_id" :data="items.ft_name">{{items.ft_name}}</option>
                  </select>  
                </span>
                <span style="position:absolute; border-left:1pt solid #ccc;border-top:1pt solid #ccc; border-bottom:1pt solid #ccc;border-top-left-radius:4px; border-bottom-left-radius:4px; width:170px; height:34px;left:43px; background-color:none;">  
                  <input type="text" id="makeupCoz" placeholder="请选择果色" autoComplete="off" style="width:170px;height:30px; color:#999; border-radius:4px; text-indent:0.5em;border:0pt; margin-left:0px; background-color:none;">  
                </span>
            </div>
             
						</div>
					
						<div class="control-group" v-if="step">
							<label class="control-label" for="input01">品种</label>
							<input type="text" class="form-control" autoComplete="off" style="width:15%;"  name="cat_chid_name" placeholder="请输入品种" >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label class="control-label" for="input01">编号</label>
							<input type="text" class="form-control" autoComplete="off" style="width:15%;"  name="cat_no" placeholder="请输入编号" >
						</div>
						<div class="control-group" v-if="step">
							<label>描述</label>
							<textarea class="form-control" name="cat_desc" style="width:37%;" rows="3"></textarea>
						</div>							
						</fieldset>
					</form>
				</div>

  			<div style="clear:both"></div>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
</template>

<script>
export default {
  data(){
    return{
      catall:[],
      catguoxinglist:[],
      abcd:"",
      catguoselist:[],
      step:0
    }
  },

  mounted:function(){
       this.getcat();
  },

  methods:{
    
    getcat:function(){
      //获取作物下拉框
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/crop_list";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.catall = re.data;
      
    },

    getnewguoxing:function(cat_id){// 获取初始果型
      var sendData = {};
      var jsonData = {};
      jsonData.cat_id = cat_id;
      sendData.url ="index.php/baseset/Crop/type_list";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.catguoxinglist = re.data;      
    },

    getnewguose:function(cat_id){// 获取初始果色
      var sendData = {};
      var jsonData = {};
      jsonData.cat_id = cat_id;
      sendData.url ="index.php/baseset/Crop/color_list";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.catguoselist = re.data;      
    },
    
    changeF(){
      var obj = document.getElementById('cat_guoxing').options[document.getElementById('cat_guoxing').selectedIndex];
      var ft_name = $(obj).attr('data');      
      $('#makeupCo').val(ft_name); 
      //
    },

    changeFa(){
      var obj = document.getElementById('cat_guose').options[document.getElementById('cat_guose').selectedIndex];
      var ft_name = $(obj).attr('data');      
      $('#makeupCoz').val(ft_name); 
      /*
      document.getElementById('makeupCoz').value=  
      document.getElementById('cat_guose').options[document.getElementById('cat_guose').selectedIndex].value;
      */
    },
    // 选择作物
    changeFd(){
      document.getElementById('makeupCow').value=  
      document.getElementById('cat_name').options[document.getElementById('cat_name').selectedIndex].text;
      var cat_id = $('#cat_name').val();
      this.step = 1;    
      this.getnewguoxing(cat_id);
      this.getnewguose(cat_id);
    },
    
    choosecid(obj){
      
      this.abcd=obj.value;
      //console.log(obj.name);
      var that=this;
      //console.log(obj.value); 
      //this.$options.methods.catguoxing(this.abcd);
      //this.$options.methods.catguose(this.abcd);
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/type_list";
      jsonData.cat_id = obj.name;
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      if(re.status==1){
            var ab=re.data;
            for(var $i=0;$i<ab.length; $i++){
              that.catguoxinglist.push(ab[$i]);
            }
      }else{
        layer.msg(re.msg);
      }
      if(obj.value){
          var vm=this;
          var sendData = {};
          var jsonData = {};
          sendData.url ="index.php/baseset/Crop/color_list";
          jsonData.cat_id = obj.value;
          sendData.data = jsonData;
          var re = getFaceInfo(sendData);
          if(re.status==1){
                 var ab=re.data;
                 for(var $i=0;$i<ab.length; $i++){
                    that.catguoselist.push(ab[$i]);
                 }
          }else{
              layer.msg(re.msg);
          }          
        }else{
          alert("错误");
        }
    },
    catadd(){

      var catname=$("#makeupCow").val();
      if(catname==''){
        layer.msg("请选择作物");return;
      }

      var guoxing=$("#makeupCo").val();
      if(guoxing==''){
        layer.msg("请选择果型");return;
      }

      var guose=$("#makeupCoz").val();
      if(guose==''){
        layer.msg("请选择果色");return;
      }

      //console.log(guoxing);console.log(guose);
      var pinzhong=$("input[name=cat_chid_name]").val();
      if(pinzhong==''){
        layer.msg("请输入品种");return;
      }

      var bianhao=$("input[name=cat_no]").val();
      if(bianhao==''){
        layer.msg("请输入编号");return;
      }

      var catdesc=$("textarea[name=cat_desc]").val();
      if(bianhao==''){
        layer.msg("请输入描述");return;
      }

      //console.log(catname); console.log(guoxing);  console.log(guose);
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/add";
      jsonData.cat_name = catname;
      jsonData.cat_no = bianhao;
      jsonData.cat_chid_name = pinzhong;
      jsonData.ft_type = guoxing;
      jsonData.ft_color = guose;
      jsonData.cat_desc = catdesc;
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      if(re.status==1){
            layer.msg(re.msg,{time:1500},function(){
             window.location.href="/#/router_main_Base_System/grow_list"; 
            });
      }else{
            layer.msg(re.msg);
      }
    },
    gohistory(){
      this.$router.back(-1);
    },
    
  },
}
</script>
 
	
<style scoped>
.main-left-m-top {
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
}
.main-left-m-top-left {
  width: 60%;
  height: auto;
  float: left;
  display: inline;
}
.main-left-m-top-right {
  width: 40%;
  height: auto;
  float: right;
  display: inline;
}
.main-left-m-top-right span{
  padding: 6px 24px;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  float: right;
  display: inline;
  margin-top: 8px;
  margin-left: 18px;
}
.main-left-m-top-right a:visited {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-right a:hover {
  color: #fff;
  text-decoration: none;
}
.main-left-m-center {
  width: 100%;
  height: 100%;
  margin: 30px 0;
  background-color: #fff;
  padding: 10px 0;
  box-shadow: 0 0 2px #ddd;
}
.main-left-m-center table {
  width: 100%;
  height: auto;
}
.main-left-m-center table tr th {
  padding: 12px 26px;
  font-weight: bold;
  color: #333;
  border-bottom: 1px solid #ddd;
  font-size: 14px;
}
.main-left-m-center table tr td {
  padding: 12px 26px;
  font-weight: normal;
  color: #333;
  font-size: 13px;
}
.new-css-ad {
  border-right: 1px solid #eeeeee;
  vertical-align: middle !important;
}
table tr th,
td {
  text-align: center;
}
/**add form**/
.add-form-div {
  width: 94.2%;
  padding: 1% 2.9%;
  background-color: #fff;
  height: 98%;
  display: block;
}
.h4span {
  font-weight: bold;
  font-size: 15px;
}
.control-group {
  display: flex;
  padding: 30px 0;
}
.control-group input {
  margin-left: 12px;
}
.control-group textarea {
  margin-left: 12px;
}
</style>