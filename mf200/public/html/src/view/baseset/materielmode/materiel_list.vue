<template>
	<div id="left-box" >
	<div style=" width: 100%; height: 100%; ">
	<div class="main-left-m-top">
		<div class="main-left-m-top-left" style="width:20%;" >
			<H4 style="font-weight:bold; margin-top:14px;">物料管理</H4>
			<!--<h5 style="line-height: 20px;">可对物料进行添加、修改、保存、删除的操作，操作完成后在发布生产计划中的下拉接单中显示。</h5>-->
		</div>
		<div class="main-left-m-top-righta" style="width:80%;">
				<span class="div-a-right" style="cursor:pointer"  v-on:click="addForm()">+添加物料</span>
				<a href="/#/router_main_Base_System/materielmode/materiel_cate_mode" class="div-a-right" style="background-color:#b0c777; margin-right:10px;">
        <img src="/lib/img/public/cropmode/wuliaocate.jpg" />&nbsp;类别管理</a>
				<span class="div-a-right" style="background-color:#b0c777; margin-right:10px;cursor:pointer;" v-on:click="sousou()"><img src="/lib/img/public/cropmode/fangdajing.jpg" />&nbsp;搜索</span>

				<div class="fiveyejiao">
					<input type="text" class="form-control" style="width:100%; margin-top:9px; float:right; display:inline;" name="wuliaoname" placeholder="输入物料名称" >
				</div>
				
				<span class="fiveyejiao">
						<select id="seltid" class="form-control" style="width:160px; display:inline-block;margin-top:9px; ">
								<option value="">请选择类别</option>
								<option v-for="item in lists" v-bind:value="item.cat_id">{{ item.cat_name }}</option>
						</select>
				</span>

		</div>
    <div style="clear:both"></div>
	</div>
	
	<div class="main-left-m-center">
		<table class="table table-striped" style="border-bottom:1px solid #ddd">
		  <thead>
		    <tr>
		      <th>类别</th>
		      <th>物料名称</th>
		      <th>物料编号</th>
		      <th>单价</th>
		      <th>单位</th>
		      <th>规格</th>
		      <th>编辑</th>
		      <th>删除</th>
		    </tr>
		  </thead>

		  <tbody v-for="abc in news">
			<tr>
				<td class="new-css-ad" style="background-color: #fff;" >{{abc.cat_name}}</td>
				<td colspan="8" style="padding:0; background-color:#fff;" >
				<table v-for="(abcd, num) in abc.child" v-bind:id="'newia'+abcd.m_id">
					<tr :style="{ background: num %2? '#f9f9f9':'' }" border="none">
						<td>{{abcd.m_name}}</td>
						<td>{{abcd.m_no}}</td>
						<td>{{abcd.price}}</td>
						<td>{{abcd.unit}}</td>
						<td>{{abcd.m_desc}}</td>
						<td><span style="cursor:pointer;" v-on:click="editForm(cat_id=abc.cat_id,m_id=abcd.m_id)"><img src="/../lib/img/public/cropmode/z-add-edit.jpg" /></span></td>
						<td><span style="cursor:pointer;" v-on:click="thisDel(abcd.m_id)"><img src="/../lib/img/public/cropmode/z-add-del.jpg" /></span></td>
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

		<!--addForm editForm-->
		<div id="addForm" style="background-color:#e5f2f5;width:800px;height:410px;overflow:hidden; display:none">
			<div class="layer-add-form-a">
				<form class="form-horizontal" id="addMyForm">
					<div class="a1input">
						<label class="control-label" style=" float:left; display:inline; margin-right:8px; width:60px; text-align:left;" >类别</label>
						<select class="vuesela" name="addcat_id">
							<option value="">请选择类别</option>
							<option v-for="item in lists" v-bind:value="item.cat_id">{{ item.cat_name }}</option>
						</select>
					</div>
				
							<div class="a1input">
								<label class="control-label" style=" float:left; display:inline; margin-right:8px;  width:60px; text-align:left;">物料名称</label>
								<input type="text" class="add_form form-control" style="width:25%;" name="addm_name" placeholder="请输入物料名称">
								<label class="control-label" style=" float:left; display:inline; margin-right:8px; width:60px; text-align:left;"></label>
								<label class="control-label" style=" float:left; display:inline; margin-right:8px;  width:60px; text-align:left;">物料编号</label>
								<input type="text" class="add_form form-control" style="width:25%;" name="addm_no" placeholder="请输入物料编号">
							</div>
							<div class="a1input">
								<label class="control-label" style=" float:left; display:inline; margin-right:8px;  width:60px; text-align:left;">单价</label>
								<input type="text" class="add_form form-control" style="width:25%;"  name="addprice" placeholder="请输入单价">
								<label class="control-label" style=" float:left; display:inline; margin-right:8px; width:60px;text-align:left; text-indent:8px;" >元</label>
								<label class="control-label" style=" float:left; display:inline; margin-right:8px; width:60px; text-align:left;">单位</label>
								<input type="text" class="add_form form-control" style="width:25%;"  name="addunit" placeholder="请输入单位">
							</div>
							<div class="a1input">
								<label class="control-label" style=" float:left; display:inline; margin-right:8px; width:60px; text-align:left;">规格</label>
								<input type="text" class="add_form form-control" style="width:72%;"  name="addm_desc" placeholder="请输入规格">
							</div>
					
				</form>
		</div>
		<div class="layer-add-form-bottom">
			<span style="padding:10px 12px; font-weight:bold; float:left;display:inline;">添加物料</span>
			<span v-on:click="doAdd" style="padding:10px 12px; float:right;display:inline;font-weight:bold;color:#f2a652;cursor:pointer;"><img src="/lib/img/public/cropmode/litterdh.jpg" style="margin-right:6px;">完成</span>
		</div>
	</div>

		<div id="editForm" style="background-color:#e5f2f5;width:800px;height:410px; overflow:hidden; display:none">
			<div class="layer-add-form-a">
				<form class="form-horizontal">
					<div class="a1input">
						<label class="control-label" style=" float:left; display:inline; margin-right:8px; width:60px; text-align:left;" for="input01">类别</label>
						<select  class="vuesela" name="editcat_id">
							<!--二次更改-->
							<option v-for="item in lists" v-if="item.cat_id==catid" v-bind:value="catid" selected>{{ item.cat_name }}</option>
						</select>
					</div>
					<div v-for="items in news">
						<div v-for="itemedit in items.child" v-if="itemedit.m_id==mid">
							<div class="a1input">
								<label class="control-label" style=" float:left; display:inline; margin-right:8px;  width:60px; text-align:left;" for="input01">物料名称</label>
								<input type="text" class="form-control" style="width:25%;"  name="editm_name" v-bind:value="itemedit.m_name">
								<label class="control-label" style=" float:left; display:inline; margin-right:8px; width:60px; text-align:left;" for="input01"></label>
								<label class="control-label" style=" float:left; display:inline; margin-right:8px;  width:60px; text-align:left;" for="input01">物料编号</label>
								<input type="text" class="form-control" style="width:25%;"  name="editm_no" v-bind:value="itemedit.m_no">
							</div>
							<div class="a1input">
								<label class="control-label" style=" float:left; display:inline; margin-right:8px;  width:60px; text-align:left;" for="input01">单价</label>
								<input type="text" class="form-control" style="width:25%;"  name="editprice" v-bind:value="itemedit.price">
								<label class="control-label" style=" float:left; display:inline; margin-right:8px; width:60px;text-align:left; text-indent:8px;" for="input01">元</label>
								<label class="control-label" style=" float:left; display:inline; margin-right:8px; width:60px; text-align:left;" for="input01">单位</label>
								<input type="text" class="form-control" style="width:25%;"  name="editunit" v-bind:value="itemedit.unit">
							</div>
							<div class="a1input">
								<label class="control-label" style=" float:left; display:inline; margin-right:8px; width:60px; text-align:left;" for="input01">规格</label>
								<input type="text" class="form-control" style="width:72%;"  name="editm_desc" v-bind:value="itemedit.m_desc">
							</div>
						</div>
					</div>	
				</form>
			</div>
			<div class="layer-add-form-bottom">
				<span style="padding:10px 12px; font-weight:bold; float:left;display:inline;">编辑物料</span>
				<span v-on:click="doEdit" style="padding:10px 12px; float:right;display:inline;cursor:pointer;font-weight:bold;color:#f2a652;cursor:pointer;">
          <img src="/../lib/img/public/cropmode/litterdh.jpg" style="margin-right:6px;">完成
        </span>				
			</div>
		</div>
		<!--addForm editForm-->
	</div>
</template>
<script>
export default {
  data() {
    return {
      news: [],
      lists: [],
      selected: "",
      catid: "",
      mid: "",
      newid:""
    };
  },
  mounted: function() {
    this.getnews();
    this.getlists();
  },
  methods: {
    getnews: function() {
      var sendData = {};
      var jsonData = {};
      sendData.url ="index.php/baseset/Materiel/materiel_list";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);
      this.news = re.data;
    },
    getlists: function() {
      var sendData = {};
      var jsonData = {};
      sendData.url = "index.php/baseset/Materiel/materiel_list";
      sendData.data = jsonData;
      var re = getFaceInfo(sendData);

      this.lists = re.data;
      //console.log(this.lists);
      /*
      sendData.url = "27.221.53.90:880/index.php/baseset/Materiel/edit";
      jsonData.token = "3f1tabe0jtumhnr56qkolh44m0";
      jsonData.phone = "18114158894";
      sendData.data = jsonData;
      $.ajax({
        url: "http://www.pc200.com/router.php",
        dataType: "Json",
        data: sendData,
        success: function(msg) {
          this.lists = msg.meteriel_info;
        }.bind(this),
        error: function(msg) {
          //alert("错误");
        }
      });*/

    },

    addForm() {
      layer.open({
        type: 1,
        title: '添加物料',
        area: ["800px", "452px"],
        closeBtn: 1,
        shadeClose: false,
        skin: "layer-add-form",
        content: $("#addForm")
      });
    },
    doAdd() {
      var addcat_id = $("select[name='addcat_id']").val();
      if(addcat_id==''){
        layer.msg("请选择类别");return;
      }

      var addm_name = $("input[name='addm_name']").val();
      if(addm_name==''){
        layer.msg("请输入物料名称");return;
      }

      var addm_no = $("input[name='addm_no']").val();
      if(addm_no==''){
        layer.msg("请输入物料编号");return;
      }

      var addprice = $("input[name='addprice']").val();
      if(addprice==''){
        layer.msg("请输入单价");return;
      }
      if(isNaN(addprice)) {
        layer.msg('单价必须为数字');
        return;
      }

      var addunit = $("input[name='addunit']").val();
      if(addunit==''){
        layer.msg("请输入单位");return;
      }

      var addm_desc = $("input[name='addm_desc']").val();
      if(addm_desc==''){
        layer.msg("请输入规格");return;
      }

      var sendData = {};
      var jsonData = {};
      jsonData.cat_id=addcat_id;
      jsonData.m_name=addm_name;
      jsonData.m_no=addm_no;
      jsonData.unit=addunit;
      jsonData.price=addprice;
      jsonData.m_desc=addm_desc;
      sendData.url = "index.php/baseset/Materiel/add";
      sendData.data = jsonData;
     
      var re = getFaceInfo(sendData);
      var oveObj = this;
      if (re.status == 1) {
          layer.msg(re.msg, { time: 1500 },function(){
            layer.closeAll();
            $('.add_form').val('');
            oveObj.getnews();
            oveObj.getlists();
          });
      } else {
          layer.msg(re.msg);
      }
    },

    doEdit() {
      var editcat_id = $("select[name='editcat_id']").val();
      if(editcat_id==''){
        layer.msg("请选择类别");return;
      }
      var editm_name = $("input[name='editm_name']").val();
      if(editm_name==''){
        layer.msg("请输入物料名称");return;
      }
      var editm_no = $("input[name='editm_no']").val();
      if(editm_no==''){
        layer.msg("请输入物料编号");return;
      }
      var editprice = $("input[name='editprice']").val();
      if(editprice==''){
        layer.msg("请输入单价");return;
      }
      if(isNaN(editprice)) {
        layer.msg('单价必须为数字');
        return;
      }
      var editunit = $("input[name='editunit']").val();
      if(editunit==''){
        layer.msg("请输入单位");return;
      }
      var editm_desc = $("input[name='editm_desc']").val();
      if(editm_desc==''){
        layer.msg("请输入规格");return;
      }
      var sendData = {};
      var jsonData = {};
      jsonData.cat_id=editcat_id;
      jsonData.m_id=this.mid;
      jsonData.m_name=editm_name;
      jsonData.m_no=editm_no;
      jsonData.unit=editunit;
      jsonData.price=editprice;
      jsonData.m_desc=editm_desc;
      jsonData.do='';
      sendData.url="index.php/baseset/Materiel/edit";
      sendData.data=jsonData;

      var re = getFaceInfo(sendData);
      var oveObj = this;
      if (re.status == 1) {
            layer.msg(re.msg,{time:1500},function(){
              layer.closeAll();              
              oveObj.getnews();
              oveObj.getlists();
            });
      } else {
            layer.msg(re.msg);
      }
    },
    editForm(editcatid, editmid) {
      this.catid = editcatid,
      this.mid = editmid,
        layer.open({
          type: 1,
          title: '编辑物料',
          area: ["800px", "452px"],
          closeBtn: 1,
          shadeClose: false,
          skin: "layer-add-form",
          content: $("#editForm")
        });
    },
    thisDel(id) {
      this.newid=id;
      layer.confirm(
        "您确定要删除这条数据吗？",
        {
          btn: ["确定", "取消"] //按钮
        },
        function() {
          var sendData = {};
          var jsonData = {};
          sendData.url = "index.php/baseset/Materiel/del";
          jsonData.m_id = id;
          sendData.data = jsonData;
          var re = getFaceInfo(sendData);
          if (re.status == 1) {
                layer.msg(re.msg, { time: 2000 },function(){
                  $("#newia"+id).remove();
                });
          } else {
                layer.msg(re.msg, { time: 2000 }, { icon: 5 });
          }          
        }
      );
    },
    sousou(){      
        var seltid=$("#seltid").val();    
        var wuliaoname=$("input[name='wuliaoname']").val();
        var sendData = {};
        var jsonData = {};
        sendData.url = "index.php/baseset/Materiel/pc_search";
        jsonData.cat_id = seltid;
        jsonData.m_name = wuliaoname;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.news=re.data;
        if(re.status==1){
          layer.msg(re.msg);
        }else{
          layer.msg(re.msg);
        }
    }
  }
};
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
.main-left-m-top-righta {
  width: 40%;
  height: auto;
  float: right;
  display: inline;
}
.main-left-m-top-righta a {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-righta a:visited {
  color: #fff;
  text-decoration: none;
}
.main-left-m-top-righta a:hover {
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
.main-left-m-center table tbody {
  border: none;
}

.new-css-ad {
  border-right: 1px solid #eee;
  vertical-align: middle !important;
}
table tr {
  background-color: #fff;
}
tr td {
  background: none;
}
table tr th,
td {
  width: 140px;
  text-align: center;
}

/**materiel_list**/
.fiveyejiao {
  display: inline-block;
  text-indent: right;
  float: right;
  display: inline;
  margin-right: 10px;
}

.div-a-right {
  padding: 7px 18px;
  background-color: #f2a553;
  border-radius: 3px;
  font-size: 14px;
  font-weight: bold;
  float: right;
  display: inline;
  margin-top: 8px;
  color: #fff;
}

.layer-add-form {
  width: 800px;
  height: 410px;
}

.layer-add-form-a {
  width: 630;
  height: 365px;
  padding: 45px 80px 0px 80px;
  margin: 5px;
  border-radius: 5px;
  background-color: #fff;
}
.a1input {
  display: flex;
  padding: 16px 0;
}
.layer-add-form-bottom {
  width: 100%;
  position: absolute;
  bottom: 0px;
}

/**select**/
.vuesel {
  width: 140px;
  height: 34px;
  margin-top: 9px;
  color: #999;
  line-height: 34px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.vuesela {
  width: 140px;
  height: 34px;
  color: #999;
  line-height: 34px;
  border: 1px solid #ccc;
  border-radius: 4px;
}




</style>