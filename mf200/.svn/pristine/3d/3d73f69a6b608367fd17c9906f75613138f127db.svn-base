<template>
<div id="left-box">
	<div style=" width: 100%; height: 100%; ">
		<div class="main-left-m-top">
			<div class="main-left-m-top-left">
				<H4 style="font-weight:bold;">人事管理&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;职务管理</span>&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;职务编辑</span></H4>
				<h5 style="line-height:20px;">可对职务中的工序进行自定义式添加、删除的操作，操作完成后在添加人员档案中职务下拉菜单中显示。</h5>
			</div>
			<div class="main-left-m-top-right">
				<span style="background-color:#b0c777; cursor:pointer;" v-on:click="gohistory()">返&nbsp;&nbsp;回</span>
				<span v-on:click="savethis" style="cursor:pointer;">保&nbsp;&nbsp;存</span>
			</div><div style="clear:both"></div>
		</div>

		<div class="main-left-m-center"  style="background-color:#fff">
			<div class="main-left-m-job">
			
				<table>
					<tr><label style="display:inline-block; width:90px;">职务名称</label><input class="form-control" style="width:160px; display:inline-block; height:32px; line-height:32px; color:#777;" name="zhiwu" v-bind:value="rname" /></tr>
					<tr style="height:20px; line-height:60px;"></tr>
					<tr style="height:70px; line-height:70px; font-size:16px;"><label><input type="checkbox" id="zhiwuid" value="all"> 职务权限管理</label></tr>
					
					<tbody v-for="node in nodelist" ><!--v-bind:checked="node.node_id==getnid"  v-bind:checked="a.search(node.node_id)"  { background: num %2? '#f9f9f9':'' }-->
						<tr>
							<label>
							<input type="checkbox" v-bind:name="'planBox'+node.node_id" v-bind:class="'checkAll'+node.node_id" v-on:click="choose(node.node_id)" v-bind:id="'planid'+node.node_id"  v-bind:value="node.node_id" v-if="a.indexOf(node.node_id) != -1" checked> 
							{{node.title}}
							</label>
						</tr>
						<tr>
							<td v-for="sonnode in node.child">
							<label v-if="a.indexOf(sonnode.node_id) != -1 ">
								<input type="checkbox" checked v-bind:class="'checkOne'+node.node_id" v-bind:name="'planBox'+node.node_id" v-on:click="choosed(node.node_id,sonnode.node_id,$event.target)" v-bind:id="'sonplanid'+sonnode.node_id" v-bind:value="sonnode.node_id"> {{sonnode.title}}
							</label>
							<label v-else>
								<input type="checkbox" v-bind:class="'checkOne'+node.node_id" v-bind:name="'planBox'+node.node_id" v-on:click="choosed(node.node_id,sonnode.node_id,$event.target)" v-bind:id="'sonplanid'+sonnode.node_id" v-bind:value="sonnode.node_id"> {{sonnode.title}}
							</label>
							</td>
						</tr>
					</tbody>

					<tbody v-for="node in commonlist">
						<tr>
							<label v-if="a.indexOf(node.node_id) != -1">
								<input type="checkbox" checked v-bind:name="'planBox'+node.node_id" v-bind:class="'checkAll'+node.node_id" v-on:click="choose(node.node_id)" v-bind:id="'planid'+node.node_id" v-bind:value="node.node_id"> {{node.title}}
							</label>
							<label v-else>
								<input type="checkbox" v-bind:name="'planBox'+node.node_id" v-bind:class="'checkAll'+node.node_id" v-on:click="choose(node.node_id)" v-bind:id="'planid'+node.node_id" v-bind:value="node.node_id"> {{node.title}}
							</label>
						</tr>	
						<tr>
							<td v-for="sonnode in node.child">
								<label v-if="a.indexOf(sonnode.node_id) != -1 ">
									<input type="checkbox" checked v-bind:class="'checkOne'+node.node_id" v-bind:name="'planBox'+node.node_id" v-on:click="choosed(node.node_id,sonnode.node_id,$event.target)" v-bind:id="'sonplanid'+sonnode.node_id"  v-bind:value="sonnode.node_id"> {{sonnode.title}}
								</label>
								<label v-else>
									<input type="checkbox" v-bind:class="'checkOne'+node.node_id" v-bind:name="'planBox'+node.node_id" v-on:click="choosed(node.node_id,sonnode.node_id,$event.target)" v-bind:id="'sonplanid'+sonnode.node_id"  v-bind:value="sonnode.node_id"> {{sonnode.title}}
								</label>
							</td>
						</tr>
					</tbody>
				</table>
				
			</div>
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
			nodelist:[],
			therole:[],
			commonlist:[],
			a:'',
			planCheckAll:false,
			mainid:"",
			getrid:"",
			rname:"",
			getgroupid:'',
    }
  },
  mounted:function(){

		this.getrid=this.$route.query.roleid,
		this.rname=this.$route.query.rolename,
		this.getnodelist()
		this.getcheckall()
  },

  methods: {

	  getnodelist:function(){
		  var jsonData = {};
			var sendData = {};
			
			sendData.url="index.php/pc/role/edit";
			jsonData.role_id=this.getrid;
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
			this.nodelist = re.menu;
			this.therole = re.role;
			this.commonlist = re.common;
			
			var str=re.role.node_str; 
			
			this.a=str;
			
		
	  },

	 getcheckall:function(){
		var isCheckAll = false;
		$("#zhiwuid").click(function(){
			if (isCheckAll) {  
					$("input[type='checkbox']").each(function() {  
						this.checked = false;  
					});  
					isCheckAll = false;  
			} else {  
					$("input[type='checkbox']").each(function() {  
						this.checked = true;  
					});  
					isCheckAll = true;  
			}
			
		}) 
	},
	
	
    choose(newnodeid) {

			$(".checkOne"+newnodeid).prop("checked",$(".checkAll"+newnodeid).prop("checked"));
		
		},

		choosed(chooseaid,choosebid,obj){
			var allChecked = true;
			var tag = 0;
			var classname = $(obj).attr('class');
			
      $(".checkOne"+chooseaid).each(function(){
        if($(this).prop("checked") == false){
          allChecked = true;
        };
      });
      if(allChecked){
        $(".checkAll"+chooseaid).prop("checked",true);
      } else {
        $(".checkAll"+chooseaid).prop("checked",false);
			}
			$('.'+classname).each(function(){
				if(this.checked){
					tag = 1;
					//$(this).parents('tr').prev('input').attr('checked',true);
					return;
				}else{
					if(tag){
						tag = 1;
					}else{
						tag = 0;
					}					
				}
			})
			
			if(tag){
				$(obj).parents('tr').prev('input').attr('checked',true);
			}else{
				$(obj).parents('tr').prev().find('input')[0].checked = false;
			}
		},
		
		savethis(){
			 var str = "";
			 $("input[name*='planBox']:checked").each(function () {
			 str += $(this).val() + ",";
			 })
			 str = str.substring(0, str.length - 1);
			
			var zhiwu=$("input[name='zhiwu']").val();
			var sendData={};
			var jsonData={};
			sendData.url="index.php/pc/role/editsave";
			jsonData.role_name=zhiwu;
			jsonData.node_str=str;
			jsonData.role_id=this.getrid;
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
      if(re.status==1){
						layer.msg(re.msg,{time:1500},function(){
							window.location.reload();
						});
			}else{
						layer.msg(re.msg);	
			}
			
		},

	gohistory(){
      this.$router.back(-1);
    },

  }
}
</script>




<style scoped>
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
.main-left-m-top-right span {
      padding: 7px 20px;
      background-color: #f2a553;
      border-radius: 3px;
      color: #fff;
      font-size: 14px;
      font-weight: bold;
      float: right;
      display: inline;
      margin-top: 8px;
}
   
.main-left-m-center {
  width: 100%;
  height: auto;
  margin: 30px 0;
  background-color: #fff;
  padding: 10px 0;
  box-shadow: 0 0 2px #ddd;
}
.main-left-m-job{
	 padding:40px 50px;
}
.main-left-m-job tr{ text-align: left; font-size:15px; font-weight: bold; color: #555; }
.main-left-m-job tr td{ text-align: center;  padding: 16px 50px; font-size:13px; color:#777; font-weight: normal; }



</style>