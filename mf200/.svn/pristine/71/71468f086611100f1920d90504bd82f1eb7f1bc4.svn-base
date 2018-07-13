<!--供应商管理-->
<template>
<div id="Application_Form_main__">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4 class="tit">供应商管理</h4>
            </div>
            <div class="case">
                <select id="select" class="select" @change="change()">
                    <option value ="0">全部</option>
                    <option v-for="(item,index) in pro" :key="index" v-bind:value="index+1">{{item}}</option>
                </select>
                <input type="text" name="date" class='ECalendar input' placeholder="请输入供应商名称"  id="no"/>
                <button class="button or" @click="getlist(1)">搜索</button>
                <button class="button or" @click="add()">添加</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
<!--        <router-link >-->
            <div v-for="(item,index) in data" :key="index">
                <ul>
                    <li>
                        <h3 class="tit">{{item.supply_name}}
                        <a @click.stop="edit(item.supply_id)"><img src="/lib/img/public/cropmode/z-add-edit.jpg" alt=""></a>
                        <a @click.stop="del(item.supply_id)" id="ac59075b964b0715"><img src="/lib/img/public/cropmode/add-new-del.png" alt=""></a>
                        </h3>
                    </li>                   
                    <li>
                        <p>联系人 : {{item.contact}}</p>
                    </li>                    
                    <li>
                        <p >电话 ：{{item.contact_number}}</p>
                    </li>                
                    <li>
                        <p>银行名称 ：{{item.bank}}</p>
                    </li>                      
                     <li>
                        <p>银行卡号 ：{{item.account}}</p>
                    </li>                     
                    <li>
                        <p>公司地址 ：{{item.address}}</p>
                    </li>                 
                    <li>
                        <p>备注 ：{{item.beizhu}}</p>
                    </li>                   
                    <li >
                        <p>备份 ：{{item.pro}}</p>
                    </li>                                           
                </ul>
            </div>
<!--        </router-link>-->
    </div>
    <div id="page_new" class="paing">
        <ul class="pages" v-if="pages > 1">
            <li @click="getlist(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
        </ul>
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
    #Application_Form_main_{
        overflow: hidden;
    }
    #Application_Form_main_ div {
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
        height: 300px;
    }
	#ac59075b964b0715{
		margin-left: 100px;
	}
    .case select {
        border-style: solid;
        border-width: 1px;
        border-color: #EAEEF1;
        padding: 5px;
        border-radius: 5px;
        margin-right: 10px;
    }

    li button {
        margin-top: 20px;
    }
    li{
        margin-left: 30px;
    }
    li p{
        margin-top: 10px;
    }
    li h3{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    ul{
    }
</style>
<script>
    export default {
        data() {
            return {
                data:[],
                item:[],
                pro:[],
                pages:'',
                page:''
            }
        },
        mounted:function(){
			this.getlist(1);
        },
        methods: {
            getlist(page){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Supply/supply_list";
                jsonData.page = page;
                jsonData.supply_name = $('#no').val();
                if($('#select').val() != 0){
                    jsonData.province =  $('#select').find('option:selected').text();
                }
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.data = re.data;
                    this.pro = re.pro;
					this.pages = re.total.pages;
					this.page = re.total.page;
                }else{
                    layer.msg(re.msg);
                }
            },
            change(){
                var sendData = {};
                var jsonData = {};
                sendData.url = "/index.php/pc/Supply/supply_list";
                jsonData.page = 1;
                if($('#select').val() != 0){
                    jsonData.province =  $('#select').find('option:selected').text();
                }
                sendData.data = jsonData;
                var re = getFaceInfo(sendData);
                if(re.status == 1){
                    this.data = re.data;
                    this.pro = re.pro;
					this.pages = re.total.pages;
					this.page = re.total.page;
                }else{
                    layer.msg(re.msg);
                }
            },
            add(){
                window.location.href = '#/router_main_Purchase_System/Supplier_Manage_Add';
            },
            edit(supply_id){
                this.$router.push({path: '/router_main_Purchase_System/Supplier_Manage_Details', query: { supply_id:supply_id }}); 
            },
            del:function(supply_id) {
				var val = layer.confirm("确认删除", {
						btn: ["确认", "取消"],
						title: [""]
					},function(){
						var sendData = {};
						var jsonData = {};
						sendData.url = "/index.php/pc/Supply/supply_del";
                        jsonData.supply_id = supply_id;
						sendData.data = jsonData;
						var re = getFaceInfo(sendData);
						if(re.status == 1){
							layer.msg(re.msg,{time: 1000},function(){
								window.location.reload();
							});					
						}else{
							layer.msg(re.msg);
						}	
					},function(){
						layer.close(val);
                    })
            }
        }
    }

</script>