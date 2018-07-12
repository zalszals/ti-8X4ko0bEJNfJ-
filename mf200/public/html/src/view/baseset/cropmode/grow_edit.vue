<template>
  <div id="left-box" >
		<div style=" width: 100%; height: 100%; ">
	    <div class="main-left-m-top">
		    <div class="main-left-m-top-left">
			    <H4 style="font-weight:bold; margin-top:14px;">作物管理&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;编辑品种</span></H4>
		    </div>
		    <div class="main-left-m-top-right">
			    <a href="#" role="button" style="background-color:#b0c777" @click="goback(-1)">返 回</a>
			    <a @click="catedit()" style="cursor:pointer" role="button" >保 存</a>
		    </div>
        <div style="clear:both"></div>
	    </div>
	
		  <ul class="w500">
			  
            <li class="form-group">
              <label class="control-label" for="cat_name">作物：{{getcatname}}</label>
            </li>
						<li class="control-group clear"> 
              <div class="left w250">
                <label>果型</label>
                <select class="form-control w200" id="cat_guoxing">                    
                  <option v-for="(itemg,index) in catguoxinglist" :key="index" :value="itemg.ft_name" :selected="cat2info.ftype==itemg.ft_name?true:false">{{ itemg.ft_name }}</option>  
                </select>
              </div>
              <div class="left w250">
                <label>果色</label>                  
                <select class="form-control w200" id="cat_guose">                     
                  <option v-for="(items,index) in catguoselist" :key="index" :value="items.ft_name" :selected="cat2info.fcolor==items.ft_name?true:false">{{ items.ft_name }}</option>
                </select>
              </div>
						</li>
					  <li class="control-group clear">
              <div class="left w250">
                <label>品种</label>
                <input type="text" class="form-control w200 mlf10" id="cat_name" :value="getchildname" >
              </div>  
              <div class="left w250">
                <label>编号</label>
                <input type="text" class="form-control w200 mlf10" id="cat_no" :value="getchildno" >
              </div>
            </li>
						<li class="control-group">
              <div class="">
                <label class="control-label">描述</label>
                <textarea class="form-control w400 mlf10" id="cat_desc" name="cat_desc" rows="3" :value="getchilddesc"></textarea>
              </div>
						</li>
						
			  
		  </ul>		
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
      cat2info:[],
      catguoselist:[],
      getid:"",
      getchildid:"",
      getcatname:"",
      getchildname:"",
      getchilddesc:"",
      getchildno:"",
      getchildtype:"",
      getchildcolor:"",
      neweditid:'',
      step:0
    }
  },

  mounted:function(){
       //this.getcat();
       this.getid=this.$route.query.id;
       this.getcatname=this.$route.query.cat_name;
       this.getchildid=this.$route.query.childid;
             
       this.getnewtype();
       this.getnewtypea();
       this.getcat2info();
  },

  methods:{

    getcat2info: function(){
      //获取作物下拉框
      var sendData = {};
      var jsonData = {};
      jsonData.cat_id = this.getchildid;
      sendData.url ="index.php/baseset/Crop/getcat2info";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.cat2info = re.data;
      this.getchilddesc = re.data.cat_desc;
      this.getchildname=re.data.cat_name;       
      this.getchildno=re.data.cat_no;
      this.getchildtype=re.data.ftype;
      this.getchildcolor=re.data.fcolor; 
    },

    getnewtype:function(){
      var that=this;
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/type_list";
      jsonData.cat_id = this.getid;
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      var ab=re.data;
      
      if(re.status==1){
            for(var $i=0;$i<ab.length; $i++){
              that.catguoxinglist.push(ab[$i]);
            }
      }else{
        layer.msg(re.msg);
      }
    },

    getnewtypea:function(){
      var that=this;
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/color_list";
      jsonData.cat_id = this.getid;
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      var ab=re.data;
      that.catguoselist=re.data;
      /*
      if(re.status==1){
              
        for(var $i=0;$i<ab.length; $i++){
        that.catguoselist.push(ab[$i]);
        }
      }else{
        layer.msg(re.msg);
      } */
    },

    changeF(){// 果型复合select
      document.getElementById('makeupCo').value=  
      document.getElementById('cat_guoxing').options[document.getElementById('cat_guoxing').selectedIndex].value;
    },

    changeFa(){// 果色复合select
      document.getElementById('makeupCoz').value=  
      document.getElementById('cat_guose').options[document.getElementById('cat_guose').selectedIndex].value;
    },

    choosecid(catid){
      this.getcatname=document.getElementById('cat_name').options[document.getElementById('cat_name').selectedIndex].text;

      var cid=catid.value;
      this.neweditid=catid.value;
      var that=this;
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/color_list";
      jsonData.cat_id = cid;
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      that.catguoselist=re.data;
      
      /*var ab=re.data;
      if(re.status==1){ 
        
        for(var $i=0;$i<ab.length; $i++){
    
          that.catguoselist.push(ab[$i]);
        }
      }else{
        layer.msg(re.msg);
      }*/
      if(catid.value){
        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/baseset/Crop/type_list";
        jsonData.cat_id = catid.value;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        that.catguoxinglist=re.data;
        /*
        var ab=re.data;
        if(re.status==1){  
              for(var $i=0;$i<ab.length; $i++){
                that.catguoselist.empty();
                that.catguoxinglist.push(ab[$i]);
              }
        }else{
          layer.msg(re.msg);
        }*/

      }

    },

    catedit(){

      var ftype =$("#cat_guoxing").val();
      var fcolor=$("#cat_guose").val();
      var cat_name=$("#cat_name").val();
      var cat_no=$("#cat_no").val();      
      var cat_desc=$("#cat_desc").val();
      
      //console.log(guoxing);console.log(guose);
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/savecat2";
      jsonData.cat_id=this.getchildid;
      jsonData.cat_name = cat_name;      
      jsonData.ftype = ftype;
      jsonData.fcolor = fcolor;
      jsonData.cat_desc = cat_desc; 
      jsonData.cat_no = cat_no;     
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      if(re.status==1){
        layer.msg(re.info,{time: 1500},function(){
						history.back(-1);
					});
      }else{
        layer.msg(re.info,{time:1500},function(){
          location.reload(); 
        });   
      }
    },
    goback: function(i){
      history.go(i);
    }
  }
}
</script>

<style lang="less" scoped>
.mlf10{margin-left:0px !important;}
.main-left-m-top {
  //头部样式
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
  
  .main-left-m-top-left {
    //头部左侧样式
    width: 60%;
    height: auto;
    float: left;
    display: inline;
  }
  .main-left-m-top-right {
    //头部右侧样式
    width: 40%;
    height: auto;
    float: right;
    display: inline;
    a {
      padding:6px 24px;
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
    a:visited {
      color: #fff;
      text-decoration: none;
    }
    a:hover {
      color: #fff;
      text-decoration: none;
    }
  }
}
.h4span {
  font-weight: bold;
  font-size: 15px;
}
.main-left-m-center {
  //中部样式
  width: 100%;
  height: 100%;
  margin: 30px 0;
  background-color: #fff;
  padding: 10px 0;
  box-shadow: 0 0 2px #ddd;
  table {
    width: 100%;
    height: auto;
    tr th {
      padding: 12px 26px;
      font-weight: bold;
      color: #333;
      border-bottom: 1px solid #ddd;
      font-size: 14px;
      text-align: center;
    }
    tr td {
      padding: 12px 26px;
      font-weight: normal;
      color: #333;
      font-size: 13px;
      text-align: center;
    }
  }
  .add-form-div {
    width: 94.2%;
    padding: 1% 2.9%;
    background-color: #fff;
    height: 98%;
    display: block;
    
  }
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
.new-css-ad {
  border-right: 1px solid #eeeeee;
  vertical-align: middle !important;
}


/**add form**/
</style>
