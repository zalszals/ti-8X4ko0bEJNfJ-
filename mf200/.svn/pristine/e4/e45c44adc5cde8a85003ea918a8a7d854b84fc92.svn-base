<!--申请采购单 待审核 添加-->
<!--申请采购单 不通过 编辑-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">申请采购单 | 采购申请单详情 | 添加采购申请表</h4>
            </div>
            <div class="case">
                
                <button @click="do_add()" class="button or">完成</button>
                <button @click="$router.back(-1)"  class="button or">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="from">
        <p>申请人&nbsp;&nbsp;：&nbsp;&nbsp;{{data.worker_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;部门&nbsp;&nbsp;：&nbsp;&nbsp;{{data.group_name}}</p>
        <p>日期&nbsp;&nbsp;：&nbsp;&nbsp;<input type="text" id="date" value="2018-06-14"  class="input"></p>
        <p>备注&nbsp;&nbsp;：&nbsp;&nbsp;<input type="text" id="beizhu"   class="input"></p>
        </div>
        <div id="center_">
            <p class="ora tit">添加物料</p>
            <button v-on:click="add_div" class="button or">+&nbsp;&nbsp;添加</button>
        </div>
        <div class="block" v-for='(list,index) in lists' :key="index">
                <img src="lib/img/public/cropmode/add-new-del.png" alt="" v-on:click="lists.splice(index, 1)">
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
                            申请数量 ：<input type="text" v-bind:value="list.wlsl" :id="'wlsl'+index" class="input"> {{list.wldw}}
                        </p>
                    </li>
                </ul>
        </div>
        <div id="opendiv">
            <p class='line'>添&ensp;加&ensp;物&ensp;料</p>
            <p class="line-input">类别&nbsp;&nbsp;
                <select id='cate' @change="change()">
                    <option value='0'>请选择类别名称</option>
                    <option v-bind:value='item.cat_id' v-for="(item,index) in data.cate" :key="index">{{item.cat_name}}</option>
                </select>
                <span>物料&nbsp;&nbsp;</span><select id='mate' @change="change_mate()" >
                    <option value='0'>请选择物料名称</option>
                    <option v-bind:value='item.m_id' v-for="(item,index) in mate" :key="index">{{item.m_name}}</option>
                </select>
            </p>
            <p class="line-input">编号：<font v-if="wuliao.m_no" id="no">{{wuliao.m_no}}</font><font v-else id="no">————</font><span>规格：</span><font v-if="wuliao.m_desc" id="desc">{{wuliao.m_desc}}</font><font v-else id="desc">————</font></p>
            <p class="line-input">数量&nbsp;&nbsp;<input type="text" name="num" id="num" placeholder="请输入数量"><span>单位&nbsp;&nbsp;</span><input type="text" name="unit" id="unit" v-bind:value="wuliao.unit"></p>
        </div>
    </div>
</div>
</template>
<script>
    export default {
        data() {
            return {
                data:[],
                mate:[],
                wuliao:[],
                close_: 1000,
                id: 1,
                lists: []
            }
        },
        mounted:function(){
			this.add();
        },
        methods: {
            add(){
               	var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Apply/add";
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.data = re.data;
				} 
            },
            close_div: function() {

            },
            add_div: function() {
                var _this = this;
                $('#opendiv select').val(0);
                $('#opendiv input').val('');
                this.wuliao.m_no = '';
                this.wuliao.m_desc = '';
                var val = layer.open({
                    type: 1,
                    title: false,
                    closeBtn: 0,
                    btn: ['确认','取消'],
                    shadeClose: true,
                    skin: 'myclass',
                    area: ['550px', '350px'],
                    content: $('#opendiv'),
                    yes:function(index, layero){
                        if($('#cate').val() == 0){
                            layer.msg('请选择物料类别');return;
                        }    
                        if($('#mate').val() == 0){
                            layer.msg('请选择物料');return;
                        } 
                        if(!$('#num').val()){
                            layer.msg('请输入数量');return;
                        }
                        if(isNaN($('#num').val())){
                            layer.msg('数量必须为数字');return;
                        } 
                        _this.lists.push({
                            id: _this.id,
                            m_id: $("#mate").val(),
                            wlfl: $("#cate").find("option:selected").text(),
                            wlmc: $("#mate").find("option:selected").text(),
                            wlbh: $('#no').text(),
                            wlgg: $('#desc').text(),
                            wlsl: $('#num').val(),
                            wldw: $('#unit').val()
                        });
                        _this.id=_this.id+1;
                        layer.close(val);
                    }
                });
            },
            change(){
                var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Apply/add_msg";
                sendData.data = jsonData;
                jsonData.cat_id = $('#cate').val();
				var re = getFaceInfo(sendData);
				if(re.status == 1){
                    this.mate = re.data;
				}  
            },
            change_mate(){
                var sendData = {};
				var jsonData = {};
				sendData.url = "/index.php/pc/Apply/add_msgt";
                sendData.data = jsonData;
                jsonData.m_id = $('#mate').val();
				var re = getFaceInfo(sendData);
				if(re.status == 1){
					this.wuliao = re.data;
				}  
            },
            do_add(){
                if(!$('#date').val()){
                    layer.msg('请选择日期');return;
                }
                if(this.lists.length == 0){
                    layer.msg('请完善物料信息');return;
                }
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Apply/apply_add";
                sendData.data = jsonData;
                jsonData.add_time = $('#date').val();
                jsonData.beizhu = $('#beizhu').val();
                var m_id = '';
                var num = '';
                for(var i = 0;i<this.lists.length;i++){
                    if(i == this.lists.length-1){
                        m_id += this.lists[i]['m_id'];
                        num += $('#wlsl'+i).val();
                    }else{
                        m_id += this.lists[i]['m_id']+',';
                        num += $('#wlsl'+i).val()+',';
                    }
                }
                jsonData.m_id = m_id;
                jsonData.num = num;
				var re = getFaceInfo(sendData);
                if(re.status == 1){
                    layer.msg(re.msg,{time: 1000},function(){
                        window.location.href = '#/router_main_Purchase_System/Purchase_Application_Form';
                    });					
                }else{
                    layer.msg(re.msg);
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
        margin-left: 50px;
    }

    .ora {
        color: #F4A356;
        margin-top: 35px;
    }

    #from p {
        margin-top: 30px;
    }

    #from p input {
        width: 300px;
        height: 60px;
    }

    #center_ button {
        margin-top: 10px;
    }

</style>
<style>
    .block {
        float: left;
        margin-top: 30px;
        margin-right: 10px;
        background-color: white;
        border-style: solid;
        border-width: 2px;
        border-color: #EAEEF1;
        border-radius: 5px;
        width: 320px;
        height: 180px;
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

    .block img {
        float: right;
        margin-left: 10px;
        margin-top: 10px;
        margin-right: 20px
    }
    .line {margin-top:30px;font-size:18px;font-weight:bold}
    .line-input {margin-top:25px;height:25px;line-height:25px;}
    .line-input select{height:25px;width:150px}
    .line-input input{height:25px;width:150px}
    .sp_style {margin-top: 30px;padding-left: 20px;padding-right: 20px;padding-top: 5px; padding-bottom: 5px;color: white;border: 0;border-radius: 5px;background-color: #B0C777;margin-right: 40px}
    .sp_style_two {margin-top: 30px;padding-left: 20px;padding-right: 20px;padding-top: 5px; padding-bottom: 5px;color: white;border: 0;border-radius: 5px;background-color: #F4A356;margin-right: 40px}
    body .myclass {border-radius:10px;text-align:center}
    body .myclass .layui-layer-btn{height:80px}
    body .myclass .layui-layer-btn {text-align:center}
    body .myclass .layui-layer-btn .layui-layer-btn0 {background-color:#b0c777;border:1px solid #fff;padding:0px 28px;border-radius:15px;margin-right:20px}
    body .myclass .layui-layer-btn .layui-layer-btn1 {border:1px solid #f1f1f1;padding:0px 28px;border-radius:15px}
    #opendiv{display:none}
    #opendiv p span{margin-left:30px;}
    #opendiv p font{padding-right:83px;}
</style>

