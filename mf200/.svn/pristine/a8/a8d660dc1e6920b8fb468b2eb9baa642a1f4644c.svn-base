<!--供应商管理-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">供应商管理 | 添加供应商</h4>
            </div>
            <div class="case">
                <button class="button or" @click="add()">完成</button>
                <button class="button or" @click="$router.back(-1)">返回</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
    <div>
    	<p>省份</p><select id="select" class="select">
        <option value ="0">请选择省份</option>
        <option v-for="(item,index) in pro" :key="index" v-bind:value="index+1">{{item}}</option>
    </select>
    </div>
    <div>
    	<p>名称</p><input type="text" class="input" id="name">
    </div>
	<div>
		<p>联系人</p><input type="text" class="input" id="contact">
	</div>
    <div>
    	<p>联系电话</p><input type="text" class="input" id="phone">
    </div>
    <div>
    	<p>地址</p><input type="text" class="input" id="addr">
    </div>
    <div>
    	<p>银行名称</p><input type="text" class="input" id="bank">
    </div>
    <div>
    	<p>银行卡号</p><input type="text" class="input" id="account">
    </div>
    <div>
    	    <p>备注</p><input type="text" class="input" id="beizhu">.
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

    .case {
        float: right;
        margin-top: -30px;
    }
	select{
		margin: 0;
	}
	p{
		width: 100px;
	}
	#Application_Form_main_{
		overflow: hidden;
	}
	#Application_Form_main_ p{
		float: left;
		margin-left: 60px;
	}
	#Application_Form_main_ div{
		margin-top: 30px;
	}
</style>
<script>
    export default {
        data() {
            return {
                pro:[],
                item:''
            }
        },
        mounted:function(){
			this.getlist();
        },
        methods: {
            getlist(page){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Supply/add";
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.pro = re.data;
                }else{
                    layer.msg(re.msg);
                }
            },
            add(){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Supply/supply_add";
                sendData.data = jsonData;
                if($('#select').val() != 0){
                    jsonData.province =  $('#select').find('option:selected').text();
                }else{
                   layer.msg('请选择省份');return; 
                }
                if($('#name').val().length == 0){
                    layer.msg('请输入供应商名称');return; 
                }
                jsonData.supply_name = $('#name').val();
                jsonData.contact = $('#contact').val();
                jsonData.contact_number = $('#phone').val();
                jsonData.address = $('#addr').val();
                jsonData.bank = $('#bank').val();
                jsonData.account = $('#account').val(); 
                jsonData.beizhu = $('#beizhu').val(); 
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    layer.msg(re.msg,{time: 1000},function(){
                        window.location.href = '#/router_main_Purchase_System/Supplier_Manage';
                    });	
                }else{
                    layer.msg(re.msg);
                }
            }  
        }
    }

</script>
