<!--申请采购单 待审核 编辑-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">采购退料单 | 添加退料单</h4>
            </div>
            <div class="case">
                
                <button @click="do_add()"  class="button or">完成</button>
                <button @click="$router.back(-1)"  class="button or">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
        	<div>
        		<p>申请人</p>
        		<p>{{data.worker_name}}</p>
        		<p>部门</p>
        		<p>{{data.group_name}}</p>
        	</div>
        	<div>
        		<p>日期</p>
        		<p><input type="text" id="date" value="2018-06-20" class="input"></p>
        	</div>
        	<div>
        		<p>供应商</p>
        		<p><select id="supply" class="select">
           	 <option v-for="(item,index) in data.supply" :key="index" v-bind:value ="item.supply_id">{{item.supply_name}}</option>
				</select></p>
        	</div>
        	<div>
        		<p>退料方式</p>
        		<p><select id="mode" class="select">
    <option value ="1">退料换料</option>
  <option value ="2">退料退款</option>
  <option value ="3">仅退料</option>
</select></p>
        	</div>
        	<div>
        		<p>退料原因</p>
        		<p><input type="text" id="cause" class="input"></p>
        	</div>
        	<div>
        		<p>备注</p>
        		<p><input type="text" id="beizhu" class="input"></p>
        	</div>
        </div>
        <div>
            <p >总金额 ：<font id="zje">0</font> 元</p>
            <p >总数量 ： <font id="zsl">0</font></p>
            <p class="ora">添加物料</p>
            <button v-on:click="add_div" class="button or">+&nbsp;&nbsp;添加</button>
        </div>
        <div class="block" v-for='(list,index) in lists' :key="index">
            <img src="lib/img/public/cropmode/add-new-del.png" alt="" v-on:click="close_div(index)">
                <ul>                                 
                    <li>
                        <p>物料分类 ：{{list.wlfl}}</p>
                    </li>                    
                    <li>
                        <p>物料名称 ：{{list.wlmc}}</p>
                    </li>                
                    <li>
                        <p>物料编号 ： {{list.wlbh}}</p>
                    </li>                      
                     <li>
                        <p>物料规格 : {{list.wlgg}}</p>
                    </li>
                    <li>
                        <p>
                            申请数量 ：<input type="text" v-bind:value="list.wlsl" :id="'wlsl'+index" @input="input1(index)"> {{list.wldw}}
                        </p>
                    </li>
                    <li>
                        <p>
                            单价 ：<input type="text" v-bind:value="list.wldj" :id="'wldj'+index" @input="input2(index)"> 元
                        </p>
                    </li>
                    <li>
                        <p>
                            金额 ：<font :id="'wlje'+index">{{list.wlje}}</font> 元
                        </p>
                    </li>
                </ul>
        </div>
        <div id="opendiv">
           <div>
           	            <p class='line'>添&ensp;加&ensp;物&ensp;料</p>
            <p class="line-input">类别&nbsp;&nbsp;
                <select id='cate' @change="change()" class="select">
                    <option value='0'>请选择类别名称</option>
                    <option v-bind:value='item.cat_id' v-for="(item,index) in data.cate" :key="index">{{item.cat_name}}</option>
                </select>
                <span>物料&nbsp;&nbsp;</span><select id='mate' @change="change_mate()" class="select">
                    <option value='0'>请选择物料名称</option>
                    <option v-bind:value='item.m_id' v-for="(item,index) in mate" :key="index">{{item.m_name}}</option>
                </select>
            </p>
            <p class="line-input">编号：<font v-if="wuliao.m_no" id="no">{{wuliao.m_no}}</font><font v-else id="no">————</font><span>规格：</span><font v-if="wuliao.m_desc" id="desc">{{wuliao.m_desc}}</font><font v-else id="desc">————</font></p>
            <p class="line-input">数量&nbsp;&nbsp;<input type="text" name="num" id="num" class="input" placeholder="请输入数量" @input="change1()"> <font id="unit">{{wuliao.unit}}</font><span>单价&nbsp;&nbsp;</span><input type="text" name="price" class="input" id="price" placeholder="请输入单价" @input="change2()"> 元</p>
            <p class="line-input">金额&nbsp;&nbsp;<font id="je">————</font> 元</p>
           </div>

        </div>
    </div>
</div>
</template>
<style scoped>
	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: -110px;
		height: 80px;
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

	select {
		margin: 0;
	}

	.case {
		float: right;
		margin-top: -30px;
	}

	#Application_Form_main_ {
		margin-left: 50px;
	}

	.ora {
		color: #F4A356;
		margin-top: 35px;
	}

	#from p {
		margin-top: 30px;
		width: 100px;
	}

	.block {
		float: left;
		margin-top: 30px;
		margin-right: 10px;
		background-color: white;
		border-style: solid;
		border-width: 2px;
		border-color: #EAEEF1;
		border-radius: 5px;
		margin-left: 30px;
		width: 320px;
		height: 250px;
	}

	.block li {
		margin-left: 30px;
	}

	.block li p {
		margin-top: 10px;
	}

	.block li h3 {
		margin-top: 20px;
		margin-bottom: 20px;
	}

	#from div {
		overflow: hidden;
	}

	#from div * {
		float: left;
	}
	.select{
		height: 30px;
		width: 160px;
	}
</style>
<style>
	.block img {
		float: right;
		margin-left: 10px;
		margin-top: 10px;
		margin-right: 20px
	}

	.line {
		margin-top: 30px;
		font-size: 18px;
		font-weight: bold
	}

	.line-input {
		margin-top: 25px;
		height: 25px;
		line-height: 25px;
	}

	.line-input select {
		height: 25px;
		width: 150px
	}

	.line-input input {
		height: 25px;
		width: 150px
	}

	.sp_style {
		margin-top: 30px;
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 5px;
		padding-bottom: 5px;
		color: white;
		border: 0;
		border-radius: 5px;
		background-color: #B0C777;
		margin-right: 40px
	}

	.sp_style_two {
		margin-top: 30px;
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 5px;
		padding-bottom: 5px;
		color: white;
		border: 0;
		border-radius: 5px;
		background-color: #F4A356;
		margin-right: 40px
	}

	body .myclass {
		border-radius: 10px;
		/*		text-align: center*/
	}

	body .myclass .layui-layer-btn {
		height: 80px
	}

	body .myclass .layui-layer-btn {
		text-align: center
	}

	body .myclass .layui-layer-btn .layui-layer-btn0 {
		background-color: #b0c777;
		border: 1px solid #fff;
		padding: 0px 28px;
		border-radius: 15px;
		margin-right: 20px
	}

	body .myclass .layui-layer-btn .layui-layer-btn1 {
		border: 1px solid #f1f1f1;
		padding: 0px 28px;
		border-radius: 15px
	}

	#opendiv {
		display: none
	}

	#opendiv p span {
		margin-left: 30px;
	}

	#opendiv p font {
		/*		padding-right: 83px;*/
	}
	#opendiv div{
		margin-left: 40px;
	}
</style>
<script>
	export default {
		data() {
			return {
				data: [],
				item: [],
				mate: [],
				wuliao: [],
				close_: 1000,
				id: 1,
				lists: []
			}
		},
		mounted: function() {
			this.getlist();
		},
		methods: {
			getlist(order_id) {
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Order/add";
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
					this.data = re.data;
				}
			},
			close_div: function(index) {
				this.lists.splice(index, 1);
				var num = 0;
				var sum = 0;
				for (var i = 0; i < this.lists.length; i++) {
					num = num + this.lists[i]['wlsl'] * 1;
					sum = sum + this.lists[i]['wlje'] * 1;
				}
				$('#zsl').text(num);
				$('#zje').text(sum);
			},
			add_div: function() {
				var _this = this;
				$('#opendiv select').val(0);
				$('#opendiv input').val('');
				$('#je').text('————');
				this.wuliao.m_no = '';
				this.wuliao.m_desc = '';
				var val = layer.open({
					type: 1,
					title: false,
					closeBtn: 0,
					btn: ['确认', '取消'],
					shadeClose: true,
					skin: 'myclass',
					area: ['550px', '350px'],
					content: $('#opendiv'),
					yes: function(index, layero) {
						if ($('#cate').val() == 0) {
							layer.msg('请选择物料类别');
							return;
						}
						if ($('#mate').val() == 0) {
							layer.msg('请选择物料');
							return;
						}
						if (!$('#num').val()) {
							layer.msg('请输入数量');
							return;
						}
						if (isNaN($('#num').val())) {
							layer.msg('数量必须为数字');
							return;
						}
						if (!$('#price').val()) {
							layer.msg('请输入单价');
							return;
						}
						if (isNaN($('#price').val())) {
							layer.msg('单价必须为数字');
							return;
						}
						var num = Number($('#num').val()).toFixed(2);
						var price = Number($('#price').val()).toFixed(2);
						var je = Number($('#je').text()).toFixed(2);
						_this.lists.push({
							id: _this.id,
							m_id: $("#mate").val(),
							wlfl: $("#cate").find("option:selected").text(),
							wlmc: $("#mate").find("option:selected").text(),
							wlbh: $('#no').text(),
							wlgg: $('#desc').text(),
							wlsl: num,
							wldw: $('#unit').text(),
							wldj: price,
							wlje: je,
						});
						_this.id = _this.id + 1;
						var num = 0;
						var sum = 0;
						for (var i = 0; i < _this.lists.length; i++) {
							num = num + Number(_this.lists[i]['wlsl']);
							sum = sum + Number(_this.lists[i]['wlje']);
						}
						$('#zsl').text(num);
						$('#zje').text(sum);
						layer.close(val);
					}
				});
			},
			change() {
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Apply/add_msg";
				sendData.data = jsonData;
				jsonData.cat_id = $('#cate').val();
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
					this.mate = re.data;
				}
			},
			change_mate() {
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Apply/add_msgt";
				sendData.data = jsonData;
				jsonData.m_id = $('#mate').val();
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
					this.wuliao = re.data;
				}
			},
			do_add() {
				if (!$('#date').val()) {
					layer.msg('请选择日期');
					return;
				}
				if (this.lists.length == 0) {
					layer.msg('请完善物料信息');
					return;
				}
				var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Order/order_draw";
				sendData.data = jsonData;
				jsonData.add_time = $('#date').val();
				jsonData.supply_id = $('#supply').val();
				jsonData.group_id = this.data.worker_id;
				jsonData.worker_id = this.data.group_id;
				jsonData.num = $('#zsl').text();
				jsonData.sum = $('#zje').text();
				jsonData.style = 2;
				jsonData.beizhu = $('#beizhu').val();
				jsonData.cause = $('#cause').val();
				jsonData.mode = $('#mode').val();
				var m_id = '';
				var m_num = '';
				var m_sum = '';
				var price = '';
				for (var i = 0; i < this.lists.length; i++) {
					if (i == this.lists.length - 1) {
						m_id += this.lists[i]['m_id'];
						m_num += $('#wlsl' + i).val();
						m_sum += $('#wlje' + i).text();
						price += $('#wldj' + i).val();
					} else {
						m_id += this.lists[i]['m_id'] + ',';
						m_num += $('#wlsl' + i).val() + ',';
						m_sum += $('#wlje' + i).text() + ',';
						price += $('#wldj' + i).val() + ',';
					}
				}
				jsonData.m_id = m_id;
				jsonData.m_num = m_num;
				jsonData.m_sum = m_sum;
				jsonData.price = price;
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
					layer.msg(re.msg, {
						time: 1000
					}, function() {
						window.location.href = '#/router_main_Purchase_System/Purchase_Return_From';
					});
				} else {
					layer.msg(re.msg);
				}
			},
			change1() {
				if (!isNaN($('#price').val()) && !isNaN($('#num').val())) {
					var je = $('#price').val() * $('#num').val();
					$('#je').text(je.toFixed(2));
				} else {
					$('#je').text('————');
				}
			},
			change2() {
				if (!isNaN($('#price').val()) && !isNaN($('#num').val())) {
					var je = $('#price').val() * $('#num').val();
					$('#je').text(je.toFixed(2));
				} else {
					$('#je').text('————');
				}
			},
			input1(index) {
				if (!isNaN($('#wldj' + index).val()) && !isNaN($('#wlsl' + index).val())) {
					var je = $('#wldj' + index).val() * $('#wlsl' + index).val();
					$('#wlje' + index).text(je.toFixed(2));
					var num = 0;
					var sum = 0;
					for (var i = 0; i < this.lists.length; i++) {
						num = num + $('#wlsl' + i).val() * 1;
						sum = sum + $('#wlje' + i).text() * 1;
					}
					$('#zje').text(sum);
					$('#zsl').text(num);
				}
			},
			input2(index) {
				if (!isNaN($('#wldj' + index).val()) && !isNaN($('#wlsl' + index).val())) {
					var je = $('#wldj' + index).val() * $('#wlsl' + index).val();
					$('#wlje' + index).text(je.toFixed(2));
					var num = 0;
					var sum = 0;
					for (var i = 0; i < this.lists.length; i++) {
						num = num + $('#wlsl' + i).val() * 1;
						sum = sum + $('#wlje' + i).text() * 1;
					}
					$('#zje').text(sum);
					$('#zsl').text(num);
				}
			},
		}

	}

</script>
