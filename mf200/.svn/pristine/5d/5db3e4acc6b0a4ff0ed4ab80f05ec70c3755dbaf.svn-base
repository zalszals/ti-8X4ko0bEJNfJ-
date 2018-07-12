<template>
<div id="left-box">
	<div style=" width: 100%; height: 100%; ">
		<div class="main-left-m-top">
			<div class="main-left-m-top-left">
				<H4 style="font-weight:bold; margin-top:14px;">作物管理</H4>
			</div>
			<div class="main-left-m-top-right">
        <span class="newgospan" @click="goback(-1)">返 回</span>				
			</div><div style="clear:both"></div>
		</div>
	
		<div class="main-left-m-center"  style="background-color:#fff">
			<table class="table table-striped" style="border-bottom:1px solid #ddd">
				<thead>
					<tr>
            <th>作物</th>
            <th>果型</th>
            <th>果色</th>					
					</tr>
				</thead>
				<tbody v-for="(crop,key) in cat_list" :key="key">
          <tr>
            <td class="new-css-ad f16" style="background-color: #fff;" >              
                <input type="text" class="cat_name no_outline h28 w120" :value="crop.cat_name" />
                <input type="hidden" class="cat_id" :value="crop.cat_id" />
            </td>
            <td>
              <ul class="gxgs">
                <li v-for="(item,index) in gx_list" :key="index" v-if="item.p_cat_id==crop.cat_id">                 
                    <p class="left w150">{{item.ft_name}}</p>
                    <i class="cursor fa fa-pencil-square-o mr10 zhengchang" aria-hidden="true" @click="toedit($event.target,item.ft_id,1)"></i>                    
                    <i class="cursor fa fa-times" aria-hidden="true" @click="ask_del($event.target,item.ft_id,1)"></i>                                 
                </li>
              </ul>
            </td>
            <td>
              <ul class="gxgs">
                <li v-for="(item,index) in gs_list" :key="index" v-if="item.p_cat_id==crop.cat_id">                  
                    <p class="left w150">{{item.ft_name}}</p>
                    <i class="cursor fa fa-pencil-square-o mr10 zhengchang" aria-hidden="true" @click="toedit($event.target,item.ft_id,2)"></i>                    
                    <i class="cursor fa fa-times" aria-hidden="true" @click="ask_del($event.target,item.ft_id,2)"></i>                                  
                </li>
              </ul>
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
      cat_list: [],
      gx_list: [],
      gs_list: []
    }
  },
  mounted: function() {
    this.getinfo();
    this.get_gx();
    this.get_gs();
  },
  methods: {
    getinfo: function() {
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/crop_list";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.cat_list = re.data; 
      console.log('dddddddddd');
      console.log(re.data);     
    },
    get_gx: function(){
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/gx_list";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.gx_list = re.data;
    },
    get_gs: function(){
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Crop/gs_list";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.gs_list = re.data;
    },
    ask_del: function(obj,ft_id,tag){
      var vueObj = this;
      layer.confirm('确定要删除吗？', {btn: ['确定','取消']}, function(){
        vueObj.do_del(obj,ft_id,tag);
      });
    },
    do_del: function(obj,ft_id,tag){
      var sendData = {};
      var jsonData = {};
      jsonData.ft_id = ft_id;
      jsonData.tag = tag;
      sendData.data = jsonData;
      sendData.url = 'index.php/baseset/Crop/del_gxs';
      var re = getFaceInfo(sendData);
      if(re.status==1){
        layer.msg(re.info,{time:1500},function(){
          $(obj).parents('li').remove();
        })
      }else{
        layer.msg(re.info);
      }
    },
    toedit: function(obj,ft_id,tag){
      layer.open({
        type: 2,
        title: '果型果色编辑页',
        shadeClose: true,
        shade: 0.4,
        area: ['400px', '260px'],
        content: ['/#/router_main_Base_System/toEdit/'+ft_id+'/'+tag, 'no'], //iframe的url，no代表不显示滚动条  
      });
    },
    goback: function(i){
      history.go(i);
    }
  }
};
</script>

<style lang="less" scoped>
.gxgs li{
  height:40px;line-height:40px;font-size:15px;
}
.ysj{
  position:relative;top:-15px;left:10px;
}
.no_outline{
  outline: none;  border:none;
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