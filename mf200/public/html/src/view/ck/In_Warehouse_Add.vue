<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">其他入库</h4>
            </div>
            <div class="case">
                <button v-on:click="addmater()" class="button or ppp">添加</button>
                <button class="button or ppp">取消</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="Application_Form_main_top">
		<div>
			分类<select id="changeDiv" @change="changeType()" class="select ppp">
				<option value="0">请选择分类</option>
				<option value="1">物料</option>
				<option value="2">其他</option>
			</select>
		</div>		
		 <div id="cateDiv">
			    名称<select id="catevalue" @change="changecat()" class="select ppp">
				<option value="0" >请选择分类名称</option>
				<option v-for="item in lists" v-bind:ckid="item.ckid" v-bind:ckname="item.cat_name" v-bind:value="item.cat_id">{{ item.cat_name }}</option>
			</select>
		</div>		 
		 <div id="mateDiv">
			    作物<select id="changemater" @change="changemater()" class="select">
				<option value="0">请选择作物名称</option>
				<option v-for="item in materlists"
				v-bind:cat_child_id="item.cat_child_id"
				v-bind:cat_child_name="item.cat_child_name"
				v-bind:cat_id="item.cat_id"
				v-bind:ck_id="item.ck_id"
				v-bind:materiel_desc="item.materiel_desc"
				v-bind:materiel_no="item.materiel_no"
				v-bind:num="item.num"
				v-bind:unit="item.unit"
				>{{ item.cat_child_name }}</option>
			</select>
		</div>		 
		 <div>
			     编号  			<input id ="materiel_no" disabled type="text" style="margin-left: 30px;" class="input">	
		</div>		 
		 <div>
			    规格 			<input id ="materiel_desc" disabled type="text" style="margin-left: 30px;" class="input">	
		</div>		     
		    <div>
			    数量<input type="text" id="num" style="margin-left: 30px;" class="input">			
		</div>
   			<div>
   				单位<input type="text" id="unit" disabled style="margin-left: 30px;" class="input">
   			</div>
    </div>
</div></div>
</template>
<script>
	export default {
		data() {
			return {

			lists: [],
			materlists: [],
			pages: [],
            get_materiel_cat:[],
            page:'',
			};
		},
		mounted:function(){
			this.getlists()
	 	},

		methods:{
			getlists:function(){
		
				var sendData = {
					url: "index.php/depot/Deprot/other_cat",
					data: {
 
					}
				};
				var re = getFaceInfo(sendData);
				this.lists = re.data;
   			},
	 
			changeType:function(){
				var changeDiv = $("#changeDiv option:selected").attr("value");
				if(changeDiv=='1'){
					this.changeMateriel();
					$('#cateDiv').hide();
				}else{
					$('#cateDiv').show();
				}

			},
			changeMateriel:function(){
				
				var sendData = {
					url: "index.php/depot/Deprot/pcother_cat_lingliao",
					data: {
 
					}
				};
				var re = getFaceInfo(sendData);
				this.materlists = re.data;
			},
 			changecat:function(){
			
			
				var cat_id = $("#catevalue option:selected").attr("value");
				var sendData = {
					url: "index.php/depot/Deprot/pcother_cat_lingliao",
					data: {
						cat_id:cat_id,
					}
				};
				var re = getFaceInfo(sendData);
				this.materlists = re.data;
			},
			 changemater:function(){
 
				var cat_child_id = $("#changemater option:selected").attr("cat_child_id");
				var cat_child_name = $("#changemater option:selected").attr("cat_child_name");
				var cat_id = $("#changemater option:selected").attr("cat_id");
				var ck_id = $("#changemater option:selected").attr("ck_id");
				var materiel_desc = $("#changemater option:selected").attr("materiel_desc");
				var materiel_no = $("#changemater option:selected").attr("materiel_no");
	 
				var unit = $("#changemater option:selected").attr("unit");
				
				$('#materiel_desc').val(materiel_desc);
				$('#materiel_no').val(materiel_no);
				$('#unit').val(unit);

			},
			addmater:function(){
								
				var cat_child_id = $("#changemater option:selected").attr("cat_child_id");
				var cat_child_name = $("#changemater option:selected").attr("cat_child_name");
				var cat_id = $("#changemater option:selected").attr("cat_id");
				var ck_id = $("#changemater option:selected").attr("ck_id");
				var materiel_desc = $("#changemater option:selected").attr("materiel_desc");
				var materiel_no = $("#changemater option:selected").attr("materiel_no");
				var num = $("#num").val();
				var unit = $("#changemater option:selected").attr("unit");
				
				var check_no = $('#materiel_desc').val();
				if(!check_no){
					alert('请选择作物');
					return false;
				}
				 var patrn = /^(-)?\d+(\.\d+)?$/;
				if (patrn.exec(num) == null || value == "") {
					alert('请填写数字');
					return false
				}
				var sendData = {
					url: "index.php/depot/Deprot/other_insert",
					data: {
						cat_child_id:cat_child_id,
						cat_child_name:cat_child_name,
						ck_id:ck_id,
						cat_id:cat_id,
						materiel_desc:materiel_desc,
				 
						materiel_no:materiel_no,
						num:num,
						unit:unit,
						type:18
					}
				};
				var re = getFaceInfo(sendData);
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
			}
		}
	}

</script>
<style scoped>
	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: -110px;
		height: 80px;
	}

	#Application_Form_Date_ {}


	#w_Warehouse {
		/*        float: left;*/
		font-size: 15px;
		font-weight: bold !important;
		padding-top: 30px;
		margin-left: 30px;
		margin-right: 300px;
	}

	.case {
		float: right;
		margin-top: -30px;
	}
	#Application_Form_main_{
		margin-top: 30px;
		margin-left: 40px;
	}
	#Application_Form_main_ div{
		margin: 20px;
	}
		.pages li {
		padding: 5px;
		background-color: white;
		float: left;
	}
	#page_new{
		margin-top: 10px;
		margin-left: 40%;
	}
</style>