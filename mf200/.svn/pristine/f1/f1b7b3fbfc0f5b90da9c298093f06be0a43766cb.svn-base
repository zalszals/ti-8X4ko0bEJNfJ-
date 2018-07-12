<template> 
<div id="left-box">
	<div style="width: 100%; height: 100%;">
		<div class="main-left-m-top">
			<div class="main-left-m-top-left">
				<H4 style="font-weight:bold; margin-top:14px;">物料管理&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;类别管理</span></H4>
			</div>
			<div class="main-left-m-top-right">
				<span style="background-color:#b0c777; cursor:pointer" v-on:click="gohistory()">返 回</span>
				<!--<a href="#">保&nbsp;&nbsp;存</a>-->
			</div><div style="clear:both"></div>
		</div>
    <div class="main-left-m-center">
      <div style="padding:25px 50px;">
        <div class="main-left-m-center-top" style="display:flex; border-bottom:1px solid #f5f9fa; padding-bottom:20px;  ">
          <input type="text" class="form-control" style="width:12%;border-radius:2px; " name="cateclass" placeholder="请输入分类名称" > 
          <span class="main-left-m-center-top-add" style="cursor:pointer" v-on:click="doaddcateclass">
            +添加
          </span>
        </div>
        <div class="main-left-m-center-cate">
          <h4 style=" height:40px; line-height:40px; font-size:16px; color:#666; ">已添加的物料类别
            <span class="main-left-m-center-cate-span" id="centercatespan">
              <img id="mypicchange"  src="/lib/img/public/cropmode/z-add-edit-fff.jpg" />
              <div id="abca" style="display:none;">
                <span v-on:click="cateedit(catid)" style="cursor:pointer">保&nbsp;&nbsp;存</span>
                <span role="button" style="background-color:#b0c777; cursor:pointer" v-on:click="dellink(catid)">取&nbsp;&nbsp;消</span>
              </div>
            </span>
          </h4>
          <ul class="main-left-m-center-cate-ul">
            <li v-for="item in lists" style="cursor:pointer;" v-on:click="clickLi(item.cat_id)" v-bind:id='"cateulli"+item.cat_id'>
              <span class="main-left-m-center-cate-del hidden" style="cursor:pointer" v-bind:id='"cateullispan"+item.cat_id' v-on:click="thisDel(item.cat_id)">×</span>
              <input type="text" class="w100" :name="'cateeditname'+item.cat_id" :id="'cateulliinput'+item.cat_id" :value="item.cat_name"/>
            </li>
          </ul>
          <div style="clear:both"></div>
        </div>
      </div>
      <div style="clear:both"></div>
    </div>
    <div style="clear:both"></div>
  </div>
</div>
</template>

<script>
export default {
  data () {
	  return {
     lists:[],
     catid:""
	  }
  },  
  mounted:function(){
		this.getlists();
  },
  methods:{
    doaddcateclass(){
      var that=this;
      var cateclassname=$("input[name='cateclass']").val();
      var sendData={};
      var jsonData={};
      sendData.url="index.php/baseset/MaterielCategor/add";
      jsonData.cat_name=cateclassname;
      sendData.data=jsonData;
      var re = getFaceInfo(sendData);
      if(re.status==1){
            layer.msg(re.msg,{time:1500},function(){
              var sendData={};
              var jsonData={};
              sendData.url="index.php/baseset/Materiel/materiel_list";
              sendData.data=jsonData;
              var re = getFaceInfo(sendData);
              that.lists = re.data;
            });
          }else{
            layer.msg(re.msg);
          } 
      
    },

    getlists:function(){
			var sendData={};
      var jsonData={};
      sendData.url="index.php/baseset/Materiel/materiel_list";
      sendData.data=jsonData;
      var re = getFaceInfo(sendData);
      this.lists = re.data;
    },
    
	  clickLi (aid){
      this.catid=aid;

      $("#cateulli"+aid).addClass("act");
      $("#cateullispan"+aid).removeClass("hidden");
      $("#cateulli"+aid).siblings().find('.main-left-m-center-cate-del').addClass('hidden');
     
      document.getElementById("mypicchange").src = "/lib/img/public/cropmode/z-add-edit.jpg";
      document.getElementById("mypicchange").style.cursor = "pointer";
      document.getElementById("mypicchange").onclick = function() {
        document.getElementById("cateulliinput"+aid).style.border = "1px solid #d7dfe2";
        document.getElementById("mypicchange").style.display = "none";
        document.getElementById("abca").style.display = "inline";
      };

      $("#cateulli"+aid).siblings().removeClass("act");
     
    },

    cateedit(editid){
       // var catename = document.getElementById("cateulliinput"+editid).val();
        var catename = $("#cateulliinput"+editid).val();
        var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/baseset/MaterielCategor/edit";
        jsonData.cat_id = editid;
        jsonData.cat_name = catename;
        jsonData.do='';
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        if (re.status == 1) {
						// location.href =location.href;
						layer.msg(re.msg, { time: 2000 }, function(){
              window.location.reload();
            });
					} else {
						layer.msg(re.msg, { time: 2000 }, function(){
              window.location.reload();
            });
					}
    },
  
     thisDel(id) {
			layer.confirm(
				"您确定要删除这条数据吗？",
				{
				btn: ["确定", "取消"] //按钮
				},function() {
				var sendData = {};
        var jsonData = {};
        sendData.url ="index.php/baseset/MaterielCategor/del";
        jsonData.cat_id = id;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        if (re.status == 1) {
						// location.href =location.href;
						layer.msg(re.msg, { time: 2000 }, function(){
              $("#cateulli"+id).remove(); 
              $("#abca").style.display = "none";
              document.getElementById("mypicchange").src = "/lib/img/public/cropmode/z-add-edit-fff.jpg";
            })
					} else {
						layer.msg(re.msg, { time: 2000 }, { icon: 5 });
					}
				}
			)
    },

    dellink(aid){
      document.getElementById("cateulliinput"+aid).style.border = "0px solid #d7dfe2";
      document.getElementById("mypicchange").style.display = "inline-block";
      document.getElementById("abca").style.display = "none";
      $('[name^="cateeditname"]').css('border','none');
    },
    gohistory(){
      this.$router.back(-1);
    },

  }  
}
</script>
		
<style scoped>
.act{ box-shadow:0px 0px 2px #ccc; }


.main-left-m-top {
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
}
.main-left-m-top-left {
  width: 40%;
  height: auto;
  float: left;
  display: inline;
}
.main-left-m-top-right {
  width: 60%;
  height: auto;
  float: right;
  display: inline;
}
.main-left-m-top-right a {
  color: #fff;
  text-decoration: none;
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
  height: auto;
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

/**materiel_cate_mode**/
.h4span {
  font-weight: bold;
  font-size: 15px;
}
.main-left-m-top-right a {
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
.main-left-m-center-top-add {
  width:90px;
  height:34px;
  text-align:center;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  line-height:34px;
  font-size: 14px;
  font-weight: bold;
  margin-left: 18px;
 
}

.main-left-m-center-cate {
  width: 100%;
  height: auto;
  padding-top: 30px; 
}
.main-left-m-center-cate-span {
  width: 30%;
  height: 40px;
  line-height: 40px;
  float: right;
  display: inline;
  text-align: right;
}

.main-left-m-center-cate-span span {
  padding: 7px 20px;
  background-color: #f2a553;
  border-radius: 3px;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  margin-left: 18px;
  margin-top: 0px;
}
.main-left-m-center-cate-ul {
  width: 100%;
  height: auto;
  padding: 0px 46px 10px 26px;
  display: block;
  margin-left: -20px;
}
.main-left-m-center-cate-ul li {
  width: auto;
  height: auto;
  padding: 24px 15px;
  background-color: #f5f9fa;
  display: inline-block;
  font-size: 14px;
  margin-left: 18px;
  margin-top: 30px;
  color: #444;
  border-radius: 3px;
  position: relative;
}
.main-left-m-center-cate-ul li input {
  width: 120px;
  height: 30px;
  text-align: center;
  border: none;
  background: none;
}
.main-left-m-center-cate-del {
  width:14px; height:20px; margin: 0px; line-height: 20px; text-align: center;cursor:pointer; 
  position: absolute;
  right: 6px;
  top: 1px;
}
</style>
