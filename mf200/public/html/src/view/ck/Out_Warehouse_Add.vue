<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">其他出库</h4>
            </div>
            <div class="case">
                <button v-on:click="addLingliao()" class="button or">添加</button>
                <button class="button or">取消</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="Application_Form_main_top">		
		 <div>
			    名称<select id="changeName" @change="changeName()" class="select">
				<option value='0'>请选择分类名称</option>
				<option v-for="item in get_materiel_cat"
				v-bind:materiel_desc="item.materiel_desc" 
				v-bind:materiel_no="item.materiel_no" 
				v-bind:num="item.num" 
				v-bind:unit="item.unit" 
				v-bind:value="item.cat_child_id">{{ item.cat_child_name }}</option>
			</select>
		</div>		 
	 
		 <div>
			     编号  	<input type="text" id="materiel_no" disabled style="margin-left: 30px;" class="input">				
		</div>		 
		 <div>
			    规格 	<input type="text" id="materiel_desc"  disabled style="margin-left: 30px;" class="input">			
		</div>			
		     <div>
			    可领数量 <input type="text" id="new_num" style="margin-left: 0px;" class="input">				
		</div>		     
		    <div>
			    数量<input type="text" id="num" disabled style="margin-left: 30px;" class="input">			
		</div>
		<div>
			单位<input type="text" id="unit" disabled style="margin-left: 30px;" class="input">
		</div>
		<input type="hidden" id="cat_child_id" class="input">
		<input type="hidden" id="cat_child_name" class="input">
		<input type="hidden" id="cat_id" class="input">
		<input type="hidden" id="ck_id" class="input">
 
		
    </div>
</div></div>
</template>
<script>
	export default {
		data() {
			return {
 
				get_materiel_cat:[],
				type:''
			};
		},		
		mounted:function(){
			this.getlists()
	 	},

		methods:{
			sevalue_1:function(type){
				this.type = type;
				this.sevalue=document.getElementById("sese").value;
			},
			changeName:function(obj){
 
			   var unit = $("#changeName option:selected").attr("unit");
			   var num = $("#changeName option:selected").attr("num");
			   var materiel_no = $("#changeName option:selected").attr("materiel_no");
			   var materiel_desc = $("#changeName option:selected").attr("materiel_desc");
			   
			   $('#unit').val(unit);
			   $('#num').val(num);
			   $('#materiel_no').val(materiel_no);
			   $('#materiel_desc').val(materiel_desc);
			   $('#cat_child_id').val(cat_child_id);
			   $('#cat_child_name').val(cat_child_name);
			   $('#cat_id').val(cat_id);
			   $('#ck_id').val(ck_id);
			 
			},
			getlists:function(){
			
 
 
				var sendData = {
					url: "index.php/depot/Deprot/other_cat_lingliao",
					data: {
	 
 
					}
				};
				var re = getFaceInfo(sendData);
				this.get_materiel_cat = re.data;
				 
   			},
			addLingliao:function(){
				var type = 13;
				
				var num = $('#num').val();
				var new_num = $('#new_num').val();
				var unit = $('#unit').val();
				var materiel_no = $('#materiel_no').val();
				var materiel_desc = $('#materiel_desc').val();
				var cat_child_id = $('#cat_child_id').val();
				var cat_child_name = $('#cat_child_name').val();
				var cat_id = $('#cat_id').val();
				var ck_id = $('#ck_id').val();
				var value = $("#changeName option:selected").attr("value");
				if(value=='0'){
					alert('请选择物料');
					return false;
				}
				
				if(new_num){
					if(eval(new_num)<eval(num)){
					
					}else{
						alert('输入数量过大');return false;
					}
				}else{
					alert('请输入数量');return false;
				}
				

			 
				var sendData = {
					url: "index.php/depot/Deprot/ck_lingliao",
					data: {
						type:type,
						num:new_num,
						unit:unit,
						materiel_no:materiel_no,
						materiel_desc:materiel_desc,
						cat_child_id:cat_child_id,
						cat_child_name:cat_child_name,
						cat_id:cat_id,
						ck_id:ck_id,
 
					}
				};
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


