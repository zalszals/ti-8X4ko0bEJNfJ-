<template>
<div id="left-box">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">物料关联仓库</h4>
            </div>
            <div class="case">
                <button class="button or ppp" @click="t(1)">+添加仓库</button>
                <button  class="button or ppp">设为首页</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
    <table class="wb100">
        <tr>
            <th style="width:10%">删除</th>
            <th style="width:25%">仓库</th>
            <th style="width:45%">物料分类</th>
            <th style="width:20%">操作</th>
        </tr>
        <tr class="w_color" v-for="item in mange_info">
            <td @click="DelCkRelation(item.ck_id)"><img src="\lib\img\public\cropmode\z-add-del.jpg" alt=""></td>
            <td class="bbb" >
				<p>{{item.ck_name}}</p>
				<button class="button or" @click="ShowAdd(item.ck_id)"><img src="" alt="" >添加</button>
			</td>
            <td colspan="2" class="nopadding">
                <ul class="clear nei_ul" v-for="(items,index) in item.cate_info" :key="index">
                    <li class="wb70 left h45 lh45">{{items.cat_name}}</li>
					<li class="wb30 left h45 lh45"><span class="button or cursor" @click="ResetRelation(item.ck_id,items.cat_id)">取消关联</span></li>                    
                </ul>
            </td>
        </tr>        
 
    </table>
</div>

<div id="add_show" style="display:none">
	<div style="margin:40px 0 0 72px;">
		<input type="hidden" id="hide_ckid">
		请选择分类:
		<select class="w160 input-control" id="change_cat">
		<option value="">请选择</option>
		<option v-for="item in add_info" v-bind:value="item.cat_id">{{item.cat_name}}</option>
		</select>				
	</div>
	<div class="mt45 text-center ml20">
		<button class="ml30 button or" @click="ComitCatinfo()">提交</button>
		<button class="button or" @click="HideDiv()">取消</button>
	</div>
</div>


<div id="ComintCk" style="display:none">
	<input type="hidden" id="hide_ckid">
	请输入仓库名:<input type="text" id="ck_name">
	<button @click="ComitCkInfo()">提交</button>
	<button @click="ComintCk(2)">取消</button>
</div>

</div>

</template>
<script>
	export default {
		data() {
			return {
				mange_info: [],
				add_info: []

			};
		},
		mounted: function() {
			this.getlists()
		},
		methods: {
			ComintCk: function(type) {
				if (type == '1') {
					$('#ComintCk').show();
				} else {
					$('#ComintCk').hide();
				}

			},
			t: function() {
				layer.open({
					type: 1,
					skin: 'layui-layer-demo', //样式类名
					closeBtn: 0, //不显示关闭按钮
					anim: 2,
					area: ['340px', '215px'],
					shadeClose: true, //开启遮罩关闭
					content: $('#ComintCk').html()
				});
				/* layer.open({
					type: 1,
					skin: 'layui-layer-rim', //加上边框
					area: ['420px', '240px'], //宽高
					content: $('#ComintCk').html()
				}); */
			},
			ComitCkInfo() {
				var ck_name = $('#ck_name').val();
				if (ck_name == '') {
					alert('请填写仓库名字');
					return false;
				}
				var sendData = {
					url: "index.php/depot/Deprot/add_ck",
					data: {
						ck_name: ck_name,
					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == '1') {
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				} else {
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				}

			},
			getlists: function() {
				var sendData = {
					url: "index.php/depot/Deprot/pc_manage_list",
					data: {}
				};
				var re = getFaceInfo(sendData);

				this.mange_info = re.data;


			},
			ResetRelation: function(ck_id, cat_id) {
				var sendData = {
					url: "index.php/depot/Deprot/pc_change_catemange",
					data: {
						ck_id: ck_id,
						cat_id: cat_id,
					}
				};
				var re = getFaceInfo(sendData);

				if (re.status == '1') {
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				} else {
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				}
			},
			ShowAdd: function(ck_id) {
				$('#hide_ckid').val(ck_id);
				var sendData = {
					url: "index.php/depot/Deprot/pc_last_cateinfo",
					data: {}
				};
				var re = getFaceInfo(sendData);
				this.add_info = re.data;
				setTimeout(function () {
					//自定页
					layer.open({
						type: 1,
						skin: 'layui-layer-demo', //加上边框
						area: ['400px', '240px'], //宽高
						content: $('#add_show')
					});
				}, 300);								
			},
			doAdd: function(){
				
			},
			HideDiv: function() {
				$('#hide_ckid').val('');
				$('#add_show').hide();
			},
			ComitCatinfo: function() {
				var ck_id = $('#hide_ckid').val();
				var cat_id = $("#change_cat option:selected").val();
				if (ck_id == '') {
					layer.msg('仓库信息不正确');
					return false;
				}
				if (cat_id == '') {
					alert('请选择物料分类');
					return false;
				}
				var sendData = {
					url: "index.php/depot/Deprot/ck_relation",
					data: {
						ck_id: ck_id,
						cat_id: cat_id,
					}
				};
				var re = getFaceInfo(sendData);
				var vueObj = this;
				if (re.status == '1') {
					layer.msg(re.msg, {
						time: 1500
					}, function() {
						oveObj.getlists();
					});
				} else {
					layer.msg(re.msg);
				}

			},
			DelCkRelation: function(ck_id) {
				var sendData = {
					url: "index.php/depot/Deprot/ck_delete",
					data: {
						ck_id: ck_id,
					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == '1') {
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				} else {
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				}
			}

		}
	}

</script>
<style scoped>
	.lh45{line-height: 45px;}
	.nei_ul{border-left:1px solid #ddd;}
	.nopadding{padding:0 !important;}
	#add_fl{
		widows: 200px;height:260px;margin:auto;
	}
	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		/* margin-left: 40px; */
		padding-bottom: -110px;
		height: 80px;
	}

	td table {
		border-left-style: solid;
		border-left-width: 2px;
		border-bottom-style: solid;
		border-left-width: 2px;
		border-color: #EAEEF1;
		border-radius: 5px;
	}

	#w_Warehouse {
		font-size: 15px;
		font-weight: bold !important;
		padding-top: 30px;
		margin-left: 30px;
		margin-right: 300px;
		overflow: hidden;
	}

	#w_Warehouse * {
		float: left;
	}

	#w_Warehouse h4 {
		margin-right: 30px;
	}

	#w_Warehouse button {
		margin-right: 10px;
	}

	.case {
		float: right;
		margin-top: -30px;
	}

	#Application_Form_main_ {
		margin-top: 30px;
		font-weight: 500;
		/* margin-left: 5%;
		margin-right: 10%; */
	}

	.bbb {
		overflow: hidden;
	}

	.bbb * {
		float: left;
	}

	.bbb p {
		width: 150px;
	}

	table * {
		padding-top: 2px;
		padding-bottom: 2px;
		text-align: center;
	}

	th {
		background-color: white;
		width: 200px;
		height: 50px;
		border-bottom-style: solid;
		border-bottom-width: 2px;
		border-bottom-color: #EAEEF1;
	}

	.w_color {
		background-color: white;border-bottom: 1px solid #ddd;
	}

	td {
		height: 50px;
		/*        background-color: white;*/
	}

	.color {
		background-color: white !important;
	}

	.color:nth-child(2n) {

		background-color: #F9F9F9 !important;
	}

	td table tr td {
		width: 1900px;
	}

	.pages li {
		padding: 5px;
		background-color: white;
		float: left;
	}

	#page_new {
		margin-top: 10px;
		margin-left: 40%;
	}

</style>
