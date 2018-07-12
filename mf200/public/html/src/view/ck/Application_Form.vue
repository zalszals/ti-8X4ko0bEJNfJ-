<template>
<div id="Application_Form_main_">
    <div id="Application_Form_head_">
        <div id="Application_Form_Date_">
            <div id="w_Warehouse">
                <h4>预申请列表</h4>
            </div>
            <div class="case">
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input or'id="ECalendar_case1"  />
                </div>至
                <div class="calendarWarp" style="">
                    <input type="text" name="date" class='ECalendar input or' id="ECalendar_case2" />
                </div>
               	<select class="vuesela select" name="addcat_id">
							<option value="">请选择</option>
							<option v-for="item in get_materiel_cat" v-bind:value="item.cat_id">{{ item.cat_name }}</option>
				</select>
                <input type="text" class="ECalendar calendarWarp input or" id="keywords" />
                <button v-on:click="getlists()">筛选</button>
            </div>
        </div>
    </div>
    <div id="Application_Form_main_">
        <div id="Application_Form_main_top">


            <div v-for="item in lists" v-on:click="clickLi(item.materiel_id)" v-bind:id='"cateulli"+item.materiel_id'>
                <table>
                    <tr>
                        <td>来源
                            <p class="ppp">{{item.come}}</p>
                        </td>
                    <td>时间
                            <p class="ppp">{{item.new_time}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>类别
                            <p class="ppp">{{item.cat_name}}</p>
                        </td>
                        <td>名称
                            <p class="ppp">{{item.materiel_name}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>单位
                            <p class="ppp">{{item.unit}}</p>
                        </td>
                        <td>采购数量
                            <p class="ppp">{{item.request_num}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button  v-on:click="checkstatus(item.cg_id)" class="Application_Form_main_but">审核</button>
                        </td>
                    </tr>
                </table>
            </div>

        </div>

 
        <div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getlists(item)" v-for="(item,index) in pages" :key="index" :class="page==item?'page_click':''">{{item}}</li>
			</ul>
			
		
		</div>
    </div>
</div>
</template>
<script>
	export default {
		data() {
			return {

			lists: [],
			pages: [],
            get_materiel_cat:[],
            page:''

			};
		},
		mounted:function(){
			this.getlists()
	 	},

		methods:{
			getlists:function(page){
                var addcat_id = $("select[name='addcat_id']").val();
                var start_time = $("#ECalendar_case1").val();
                var end_time = $("#ECalendar_case2").val();
                var keywords = $("#keywords").val();
				var sendData = {
					url: "index.php/depot/Deprot/kc_applycg",
					data: {
					    cat_id: addcat_id,
						page:page,
                        keywords:keywords,
                        start_time:start_time,
                        end_time:end_time,
                        pc_from:2
					}
				};
				var re = getFaceInfo(sendData);
                //console.log(re);
                this.lists = re.data.page_list.list;
                this.pages = re.data.last_page;
                 
                this.page = re.data.page;


   			},
			
            checkstatus:function(cg_id){
                
				var sendData = {
					url: "index.php/depot/Deprot/check_materiel",
					data: {
					info_str:cg_id
					}
				};
				var re = getFaceInfo(sendData);
                //console.log(re);
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
		#Application_Form_head_{
		border-bottom:  2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: -110px;
		height: 80px;
		
	}
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
    #page{
        position: relative;
        left: 600px;
    }
</style>
 