<template>
<div id="Application_Form_main_">
    <div id="Application_Form_main_">
        <div id="Application_Form_main_top">

            <div  v-for="item in category_info">
                <table>
                    <tr>
                        <td>
                            <p>物品分类</p>
                        </td>
                        <td>
                            <p>{{item.cat_name}}</p>
                        </td>
                        <td>
                            <button v-on:click="changeManage(item.cat_id)">关联</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>关联仓库</p>
                        </td>
                        <select class="vuesela" name="addck_id">
							<option v-for="items in manage_info" :selected="item.ck_id==items.ck_id ? true:''" v-bind:value="items.ck_id">{{ items.ck_name }}</option>
						</select>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</template>
<script>
	export default {
		data() {
			return {

			category_info: [],
			manage_info: [],
 

			};
		},
		mounted:function(){
			this.getlists()
	 	},

		methods:{
			getlists:function(){
				var sendData = {
					url: "index.php/depot/Deprot/pc_manage_list",
					data: {
					}
				};
				var re = getFaceInfo(sendData);
 
                this.category_info = re.data.category_info;
                this.manage_info = re.data.manage_info;
 
   			},
            changeManage:function(cat_id){
                   var ck_id = $("select[name='addck_id']").val();
                    var sendData = {
                        url: "index.php/depot/Deprot/ck_relation",
                        data: {
                            ck_id:ck_id,
                            cat_id:cat_id,
                        }
                    };
                    var re = getFaceInfo(sendData);
                    if(re.status=='1'){
       					layer.msg(re.msg, { time: 2000 }, function(){
                            window.location.reload();
                        });
                    }else{
				 		layer.msg(re.msg, { time: 2000 }, function(){
                        window.location.reload();
                        });
                    }

            },
			
            
		}
	}

</script>
<style scoped>
    * {
        margin: 0;
        padding: 0;
        font-family: "微软雅黑";
        font-weight: 500;
    }

    input {
        border-style: solid;
        border-width: 1px;
        border-color: #EAEEF1;
        padding: 5px;
        border-radius: 5px;
        margin-right: 10px;
    }

    #Application_Form_Date_ {
        overflow: hidden;
    }

    button {
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 2px;
        padding-bottom: 2px;
        color: white;
        border: 0;
        border-radius: 5px;
        background-color: green;
    }

    #w_Warehouse {
        float: left;
        font-size: 15px;
        font-weight: bold !important;
        padding-top: 30px;
        margin-left: 30px;
    }

    .case {
        float: right;
        padding-top: 30px;
    }

    td {
        padding: 20px;
        padding-right: 30px;
        padding-bottom: 5px;
        padding-top: 5px;
    }

    #Application_Form_main_top {
        margin-left: 90px;
    }

    #Application_Form_main_bottom {
        margin-left: 90px;
    }

    #Application_Form_main_top table {
        margin: 20px;
    }

    #Application_Form_main_bottom table {
        margin: 20px;
    }

    #Application_Form_main_top {
        overflow: hidden;
    }

    #Application_Form_main_bottom {
        overflow: hidden;
    }

    #Application_Form_main_top div {
        float: left;
        border-style: solid;
        border-width: 2px;
        border-color: #EAEEF1;
        border-radius: 10px;
        background-color: white;
        margin: 35px;
    }

    #Application_Form_main_bottom div {
        float: left;
        border-style: solid;
        border-width: 2px;
        border-color: #EAEEF1;
        background-color: white;
        border-radius: 10px;
        margin: 35px;
    }

    .Application_Form_main_but {
        border: 0;
        background-color: #B3C57C;
        padding-left: 15px;
        padding-right: 15px;
        padding-top: 2px;
        padding-bottom: 2px;
        color: white;
        border-radius: 5px;
    }

    #page {
        position: relative;
        left: 600px;
    }

</style>
<style>
    .pageButton {
        border-style: solid;
        border-width: 1px;
        border-color: #EAEEF1;
        background-color: white;
        margin-left: 5px;
        margin-top: 5px;
    }

    .prePage {
        border-style: solid;
        border-width: 1px;
        border-color: #EAEEF1;
        background-color: white;
        margin-left: 5px;
        margin-top: 5px;
    }

    .nextPage {
        border-style: solid;
        border-width: 1px;
        border-color: #EAEEF1;
        background-color: white;
        margin-left: 5px;
        margin-top: 5px;
    }

</style>

