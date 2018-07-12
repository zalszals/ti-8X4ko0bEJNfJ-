<template>
<div id="left-box">
	<div style=" width: 100%; height: 100%; ">
		<div class="main-left-m-top">
			<div class="main-left-m-top-left">
				<H4 style="font-weight:bold; margin-top:14px;">人事管理&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;职务管理</span>&nbsp;&nbsp;<span class="h4span">|&nbsp;&nbsp;添加职务</span></H4>
				
			</div>
			<div class="main-left-m-top-right">
				<span role="button" style="background-color:#b0c777; margin-left:10px;cursor:pointer;" v-on:click="gohistory()">返 回</span>
				<span role="button" v-on:click="savonode" style="cursor:pointer;">保 存</span>
			</div><div style="clear:both"></div>
		</div>
	
		<div class="main-left-m-center"  style="background-color:#fff">
			<div class="main-left-m-job">
				<p style="width:100%;">
					<span style="display：inline-block; margin-right:50px;">
						<label class="control-label" style="font-size:16px; margin-right:20px; color:#666; display:inline-block;">选择部门</label>
						<select class="form-control" style="width:160px; display:inline-block;" v-on:change="getid($event.target)">
							<option v-for="glist in grouplist" v-bind:value="glist.group_id">
								{{glist.group_name}}
							</option>
						</select>
					</span>

					<span style="display：inline-block;">
						<label class="control-label" style="font-size:16px; margin-right:20px; color:#666; display:inline-block;">职务名称</label>
						<input class="form-control" style="height:36px; font-size:15px; width:200px; display:inline-block; color:#666; font-weight: normal;" name="zhiwu" placeholder="请输入职务名称" />
					</span>

				</p>
				<table>
					<tr style="height:20px; line-height:60px;"></tr>
					<tr class="hide" id="trid" style="height:70px; line-height:70px; font-size:16px;"><label><input type="checkbox"  id="zhiwuid" value="all"> 职务权限管理</label></tr>
					<tbody v-for="node in nodelist">
						<tr><label><input type="checkbox" v-bind:name="'planBox'+node.node_id" v-bind:class="'checkAll'+node.node_id" v-on:click="choose(node.node_id)" v-bind:id="'planid'+node.node_id" v-bind:value="node.node_id"> {{node.title}}</label></tr>	
						<tr>
							<td v-for="sonnode in node.child">
								<label>
									<input type="checkbox" v-bind:class="'checkOne'+node.node_id" v-bind:name="'planBox'+node.node_id" v-on:click="choosed(node.node_id,sonnode.node_id,$event.target)" v-bind:id="'sonplanid'+sonnode.node_id"  v-bind:value="sonnode.node_id"> {{sonnode.title}}
								</label>
							</td>
						</tr>
					</tbody>
				</table>
				<table>
							
					<tbody v-for="node in commonlist">
						<tr><label><input type="checkbox" v-bind:name="'planBox'+node.node_id" v-bind:class="'checkAll'+node.node_id" v-on:click="choose(node.node_id)" v-bind:id="'planid'+node.node_id" v-bind:value="node.node_id"> {{node.title}}</label></tr>	
						<tr>
							<td v-for="sonnode in node.child">
								<label>
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
			grouplist:[],
			nodelist:[],
			commonlist:[],
			planCheckAll:false,
			mainid:"",
			gid:''
    };
  },
  mounted: function() {
	this.getcheckall(),
	//this.getnodelist(),
	this.getgroup()
  },

  methods: {
		
	 getgroup:function(){
		 var jsonData = {};
		 var sendData = {};
		 sendData.url="index.php/baseset/group/lists";
		 sendData.data=jsonData;
		 var re = getFaceInfo(sendData);
     this.grouplist = re.data;
	 },

	 

	 getcheckall:function(){
		var isCheckAll = false;
		//总盒子
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

		getid(theid){

			this.gid=theid.value;
			var a=$("#trid").removeClass("hide");
			var jsonData = {};
			var sendData = {};
				//jsonData.group_id=2;
			sendData.url="index.php/pc/role/change";
			jsonData.group_id=theid.value;
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
			this.nodelist = re.data;
			this.commonlist=re.common;
		},
		
		savonode(){
			 var str = "";
			 $("input[name*='planBox']:checked").each(function () {
			 str += $(this).val() + ",";
			 })
			 str = str.substring(0, str.length - 1);
			 //console.log(str);
			var zhiwu=$("input[name='zhiwu']").val();
			//console.log(zhiwu);console.log(this.gid);
			var sendData={};
			var jsonData={};
			sendData.url="index.php/pc/role/save";
			jsonData.role_name=zhiwu;
			jsonData.node_str=str;
			jsonData.group_id=this.gid;
			sendData.data=jsonData;
			var re = getFaceInfo(sendData);
      
			if(re.status==1){
						layer.msg(re.msg,{time:1500},function(){
							window.location.href="#/baseset/joblist";
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



<style lang="less"  scoped>
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
      font-weight: bold;
      float: right;
      display: inline;
      margin-top: 8px;
		}
	.main-left-m-top-right span {
      padding: 6px 24px;
      background-color: #f2a553;
      border-radius: 3px;
      color: #fff;
      font-size: 14px;
      font-weight: bold;
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
.main-left-m-job{
	 padding:40px 50px;
}
.main-left-m-job tr{ text-align: left; font-size:15px; font-weight: bold; color: #555; }
.main-left-m-job tr td{ text-align: center;  padding: 16px 50px; font-size:13px; color:#777; font-weight: normal; }
.h4span {
  font-weight: bold;
  font-size: 15px;
}


</style>