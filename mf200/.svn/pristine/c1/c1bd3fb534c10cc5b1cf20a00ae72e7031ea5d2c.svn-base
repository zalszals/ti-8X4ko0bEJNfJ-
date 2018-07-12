<template>
<div id="left-box">
	<div style=" width: 100%; height: 100%; ">
		<div class="main-left-m-top">
			<div class="main-left-m-top-left">
				<H4 style="font-weight:bold; margin-top:14px;">作物管理</H4>
			</div>
			<div class="main-left-m-top-right">
        <span class="newgospan" v-on:click="dogoback()">返 回</span>
				<a href="/#/router_main_Base_System/grow_add" style="font-weight:bold;">+&nbsp;添加品种</a>
			</div><div style="clear:both"></div>
		</div>
	
		<div class="main-left-m-center"  style="background-color:#fff">
			<table class="table table-striped" style="border-bottom:1px solid #ddd">
				<thead>
					<tr>
					<th>作物</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;果型<i class="ysj cursor fa fa-pencil-square-o" aria-hidden="true" @click="gx_edit()"></i></th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;果色<i class="ysj cursor fa fa-pencil-square-o" aria-hidden="true" @click="gx_edit()"></i></th>
					<th>品种</th>
					<th>编号</th>
					<th>描述</th>
					<!--<th>上传图片</th>-->
					<th>编辑</th>
					<th>删除</th>
					</tr>
				</thead>
				<tbody v-for="(abc,key) in articles" :key="key">
          <tr>
            <td class="new-css-ad" style="background-color: #fff;" >
              <div class="left">
                <input type="text" class="cat_name no_outline h28 w120" :value="abc.cat_name" />
                <input type="hidden" class="cat_id" :value="abc.cat_id" />                
              </div>
              <div class="right mt10 ">
                <i class="cursor fa fa-pencil-square-o fa-lg zhengchang" aria-hidden="true" @click="showBorder($event.target)"></i>
                <i class="cursor fa fa-check fa-lg bianji" aria-hidden="true" @click="doeidt($event.target)"></i>
                <i class="cursor fa fa-times fa-lg bianji" aria-hidden="true" @click="hideBorder($event.target)"></i>
              </div>
            </td>
            <td colspan="8" style="padding:0; background-color:#fff; " >
              <table v-for="(abcd, num) in abc.child" :key="num" v-bind:id="'nwd'+abcd.cat_id">
                <tr :style="{ background: num %2? '#f9f9f9':'' }" border="none">
                    <td>{{abcd.cat_type}}</td>
                    <td>{{abcd.cat_color}}</td>
                    <td>{{abcd.cat_name}}</td>
                    <td>{{abcd.cat_no}}</td>
                    <td>
                      <textarea class="form-control no-border">{{abcd.cat_desc}}</textarea>
                    </td>                    
                    <td><A v-bind:href="'/#/router_main_Base_System/cropmode/grow_edit?id='+abc.cat_id+'&cat_name='+abc.cat_name+'&childid='+abcd.cat_id+'&childname='+abcd.cat_name+'&childdesc='+abcd.cat_desc+'&childno='+abcd.cat_no+'&childtype='+abcd.cat_type+'&childcolor='+abcd.cat_color">
                    <img src="/lib/img/public/cropmode/z-add-edit.jpg" /></A></td>
                    <td><span v-on:click="thisDel(abcd.cat_id)" style="cursor:pointer;"><img src="/lib/img/public/cropmode/z-add-del.jpg" /></span></td>
                </tr>
              </table>
            </td>
          </tr>
				</tbody>
			</table>
		  <div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
	</div>
</div>

</template>
<script>
export default {
  data() {
    return {
      articles: [],
      newid:""
    };
  },
  mounted: function() {
    this.getinfo();
  },

  methods: {
    getinfo: function() {
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/crop_list";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.articles = re.data;      
    },
    goEdit(name,obj){
      var q = {
        name,
        cat_id:obj.cat_id,
        cat_type:obj.cat_type,
        cat_color:obj.cat_color,
        cat_name:obj.cat_name,
        cat_no:obj.cat_no,
        cat_desc:obj.cat_desc
      }
      this.$router.push({
        path:'/baseset/cropmode/grow_edit',
        query:q,
      });
    },
    thisDel(id) {
      this.newid=id;
      layer.confirm(
        "您确定要删除这条数据吗？",
        {
          btn: ["确定", "取消"] //按钮
        },function() {
          var sendData = {};
          var jsonData = {};
          sendData.url ="index.php/baseset/Crop/del";
          jsonData.cat_id = id;
          sendData.data = jsonData;
          var re = getFaceInfo(sendData);
          if (re.status == 1) {
                layer.msg(re.msg, { time: 2000 },function(){
                $("#nwd"+id).remove();
                });
              } else {
                layer.msg(re.msg, { time: 2000 }, { icon: 5 });
          }
        }
      );
    },
    dogoback(){
      this.$router.back(-1);
    },
    showBorder: function(obj){      
      $(obj).parents('td').find('.cat_name').addClass('form-control').removeClass('no_outline');
      $(obj).parent().find('i').removeClass('bianji');
      $(obj).parent().find('.zhengchang').hide();
    },
    hideBorder: function(obj){
      $(obj).parents('td').find('.cat_name').removeClass('form-control').addClass('no_outline');
      $(obj).parent().find('i').addClass('bianji');
      $(obj).parent().find('.zhengchang').show().removeClass('bianji');
    },
    doeidt: function(obj){
      var cat_name = $(obj).parents('td').find('.cat_name').val();
      var cat_id =   $(obj).parents('td').find('.cat_id').val();
      var sendData = {};
      var jsonData = {};
      if(!cat_name){
        layer.msg('请输入作物名称');return;
      }
      jsonData.cat_id = cat_id;
      jsonData.cat_name = cat_name;
      sendData.data = jsonData;
      sendData.url = 'index.php/baseset/Crop/do_edit';
      var re = getFaceInfo(sendData);
      if(re.status==1){
        layer.msg(re.info);
        this.hideBorder(obj);
      }else{
        layer.msg(re.info);
        this.getinfo();
      }      
    },
    gx_edit: function(){
      location.href = '/#/router_main_Base_System/gxsEdit';
    }
  }
};
</script>

<style lang="less" scoped>
.ysj{
  position:relative;top:-15px;left:10px;
}
.no-border{resize: none;}
.no_outline{
  outline: none;  border:none;
}
.bianji{
  display: none;
}
.main-left-m-top {
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
}
 .main-left-m-top-left {
    width: 56%;
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
.main-left-m-top-right a {
      padding: 6px 24px;
      background-color: #f2a553;
      border-radius: 3px;
      color: #fff;
      font-size: 14px;
      font-weight:bold;
      float: right;
      display: inline;
      margin-top: 8px;
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
.main-left-m-center table tbody{
  border: none;
}
.new-css-ad {
  border-right: 1px solid #eee;
  vertical-align: middle !important;
}
table tr { background-color: #fff;}
tr td{background: none;}
table tr th,
td { width: 140px;
  text-align: center;
}

.newgospan{
  padding: 6px 24px;
  background-color: #b0c777;
  border-radius: 3px;
  color: #fff;
  font-size: 14px; 
  font-weight: bold;
  float: right;
  display: inline;
  margin-top: 8px;
  margin-left: 18px;
  cursor:pointer;
}
</style>