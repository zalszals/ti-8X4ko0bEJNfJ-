<template>
  <div id="left-box" style="width:370px;">
    <form>
      <div class="form-group">
        <label for="cat_name">作物：{{cat_name}}</label>        
        <input type="text" class="form-control" id="title_name" :value="title_name" :v-model="title_name"/>
      </div>
      <center>
        <button type="submit" class="btn btn-default mauto" @click="dosave()">保 存</button>
      </center>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      ft_id: this.$route.params.ft_id,
      tag: this.$route.params.tag,
      title_name: '',
      cat_name: ''
    }
  },
  mounted: function() {
    this.initPage();    
  },
  methods: {
    initPage: function() {
      var sendData = {};
      var jsonData = {};
      jsonData.tag = this.tag;
      jsonData.ft_id = this.ft_id;
      sendData.url ="index.php/baseset/Crop/get_gxs_info";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.cat_name = re.data.cat_name; 
      this.title_name = re.data.ft_name;
    },
    dosave: function(){
      var sendData = {};
      var jsonData = {};
      jsonData.ft_id = this.ft_id;
      jsonData.ft_name = $('#title_name').val();
      jsonData.tag = this.tag;
      sendData.url ="index.php/baseset/Crop/save_gxs";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      if(re.status==1){
        layer.msg(re.info,{time:1500},function(){
          parent.location.reload();
        });
      }else{
        layer.msg(re.info);
      }
    }
  }
};
</script>

<style lang="less" scoped>
body{
  max-width: 370px;
}
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