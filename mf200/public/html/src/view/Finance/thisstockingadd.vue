<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">库存盘点&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;本期库存盘点</span>&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;添加</span></font>

            <span onclick="go_back()" class="h4span-r" style="background-color:#b0c777; color:#fff;">返 回</span>
            <span class="h4span-r" @click="AddSubmit()">确 认</span>
           
        </h4>
        </div>
        
        <p style=" height:40px;"></p>
        <div class="thisstockinga">
            <p style="margin-bottom:40px; font-size:16px; color:#666;">
                <label style="width:120px; text-align:right; display:inline-block; ">盘点编号</label>
                <input type="text" id="no" disabled="disabled"  class="form-control" style="width:260px; display:inline-block; margin-left:10px; " value="" />
            </p>
            <p style="margin-bottom:40px; font-size:16px; color:#666;">
                <label style="width:120px; text-align:right; display:inline-block; ">仓库</label>
                <input type="text" id="ckname" disabled="disabled" class="form-control" style="width:260px;display:inline-block; margin-left:10px;" value="" />
            </p>   
            <p style="margin-bottom:40px; font-size:16px; color:#666;">
                <label style="width:120px; text-align:right; display:inline-block; ">物料名称</label>
                <select id="m_name" @change="changeMaInfo()">
				<option value="0">选择物料</option>
				<option v-for="item in get_materiel_cat" 
				v-bind:m_id="item.m_id"
				v-bind:cat_id ="item.cat_id"
				v-bind:m_name="item.m_name"
				v-bind:m_desc="item.m_desc"
				v-bind:unit="item.unit"
				
				>{{item.m_name}}</option>
				</select>
            </p>
			
            <p style="margin-bottom:40px; font-size:16px; color:#666;">
                <label style="width:120px; text-align:right; display:inline-block; ">单位</label>
                <input  disabled type="text" id="unit"  class="form-control" style="width:260px;  display:inline-block; margin-left:10px;" value="" />
            </p>
            <p style="margin-bottom:40px; font-size:16px; color:#666;">
                <label style="width:120px; text-align:right; display:inline-block; ">规格</label>
                <input disabled type="text" id="m_desc" class="form-control" style="width:260px;  display:inline-block; margin-left:10px;" value="" />
            </p>
            <p style="margin-bottom:40px; font-size:16px; color:#666;">
                <label style="width:120px; text-align:right; display:inline-block; ">盘点数量</label>
                <input type="text"  class="form-control" style="width:260px;  display:inline-block; margin-left:10px;" id="num" value="" />
            </p>         
        </div>
       
    </div>
</div>
</template>

<script>
	export default {
		data() {
			return {

			no:'',
			pages: [],
            get_materiel_cat:[],
			ck_list:[],
            page:'',
			};
		},
		mounted:function(){
			var ck = this.$route.query.ck;
			var ckname = this.$route.query.ckname;
			var no = this.$route.query.no;
			$('#ckname').val(ckname);
			$('#no').val(no);
			this.getlist()
	 	},

		methods:{
			getlist:function(){
				//var keywords = $('#m_name').val();
				var ck_id = this.$route.query.ck;
				var sendData = {
					url: "index.php/finance/Library/wlnew_list",
					data: {
						ck_id:ck_id,
						//keywords:keywords
					}
				};
				var re = getFaceInfo(sendData);
				this.get_materiel_cat = re.data;
			},
			changeMaInfo:function(){
				var m_id = $("#m_name option:selected").attr("m_id");
				var cat_id = $("#m_name option:selected").attr("cat_id");
				var m_name = $("#m_name option:selected").attr("m_name");
				var m_desc = $("#m_name option:selected").attr("m_desc");
				var unit = $("#m_name option:selected").attr("unit");
				
				$('#unit').val(unit);
				$('#m_desc').val(m_desc);
			},
			AddSubmit:function(){
				var no = this.$route.query.no;
				var ck = this.$route.query.ck;
				var m_id = $("#m_name option:selected").attr("m_id");
				var num = $('#num').val();
				 
				if(num==''){
					alert('请填写数量');
					return false;
				}else{
					if(isNaN(num)){
						alert('请填写数字');
						return false;
					}
				}
				if(m_id==''){
					alert('请选择物料');
					return false;
				}
				var sendData = {
					url: "index.php/finance/Library/library_add",
					data: {
						ck_id:ck,
						no:no,
						m_id:m_id,
						num:num
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

<style lang="less" scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top: 10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.h4span-ra{ float: right; margin-top: 10px; display: inline; color:#fff; font-size: 16px; font-weight: normal; border-radius:3px; margin-left: 16px;  }

.thisstockinga{  width:70%; }
</style>
