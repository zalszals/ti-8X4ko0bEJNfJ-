<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">库存盘点&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;盘点差值列表</span></font>

            <span onclick="go_back()" class="h4span-r" style="background-color:#b0c777; color:#fff;">返 回</span>
            <span class="h4span-r" style="background-color:#b0c777; color:#fff;" @click="IgNore()">忽 略</span>
            <span class="h4span-r" @click="AdJust()">调整库存</span>
 


			 <span class="h4span-ra">
                <select class="form-control" id="inventory_id" @change="getInfo()">
                    <option value="0">请选择盘点编号</option>
                    <option v-for="item in get_materiel_cat" v-bind:value="item.inventory_id">{{item.inventory_no}}</option>
                </select>
            </span>
			
                       <span class="h4span-ra">
                <select class="form-control" id="style" @change="getInfo()">
                    <option value="2" selected="selected">盘亏</option>
                    <option value="1">盘盈</option>
                </select>
            </span>
			
			
            <span class="h4span-ra">
                <select class="form-control" id="type" @change="getlists()">
                    <option value="1" selected="selected">未处理</option>
                    <option value="2">已处理</option>
                </select>
            </span>
        </h4>
        </div>
        
        <p style=" height:30px;"></p>
        <div style="width:100%;">
            <table class="table table-striped" style="border-bottom:1px solid #ddd">
				<thead>
					<tr>
                    <th style="text-align:center;">选择</th>
					 
					<th>类别</th>
					<th>物料名称</th>
					<th>规格</th>
					<th>单位</th>
					<th>库存数量</th>
					<!--<th>上传图片</th>-->
					<th>盘点数量</th>
					<th>差值</th>
					<th>状态</th>
					</tr>
				</thead>

				<tbody>
                    <tr class="trclass" v-for="item in lists ">
                        <td style="text-align:center;">
							<template v-if="item.status !='0'">
								<input type="checkbox" disabled="true" name="box" v-bind:value="item.id"/>
							</template>
                            <template v-if="item.status =='0'">
								<input type="checkbox" name="box" v-bind:value="item.id"/>
							</template>
                        </td>
                        
                        <td>{{item.cat_name}}</td>
                        <td>{{item.m_name}}</td>
                        <td>{{item.m_desc}}</td>
                        <td>{{item.unit}}</td>
                        <td>{{item.ck_num}}</td>
                        <td>{{item.inventory_num}}</td>
                        <td>{{item.change_num}}</td>
                        <td>
						<template v-if="item.status =='0'">
							未操作
						</template>
						<template v-if="item.status =='1'">
							已调整
						</template>
						<template v-if="item.status =='2'">
							已忽略
						</template>
						</td>
                    </tr>
 
				</tbody>

			</table>
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
            page:'',
			};
		},
		mounted:function(){
			this.getlists();
	 	},

		methods:{
 
			getlists:function(page){
				var type = $("#type option:selected").attr("value");
				var sendData = {
					url: "index.php/finance/Library/get_no",
					data: {
					 type:type,
					}
				};
				var re = getFaceInfo(sendData);
				this.get_materiel_cat = re.data;
   			},
			getInfo:function(){
				var style = $("#style option:selected").attr("value");
				var inventory_id = $("#inventory_id option:selected").attr("value");
				if(inventory_id=='0'){
					return false;
				}
				var sendData = {
					url: "index.php/finance/Library/diff_list",
					data: {
					 style:style,
					 inventory_id:inventory_id,
					}
				};
				var re = getFaceInfo(sendData);
				this.lists = re.data;
				
			},
			AdJust:function(){
				var number = '';
				var style = $("#style option:selected").attr("value");
				var inventory_id = $("#inventory_id option:selected").attr("value");
				$('input:checkbox[name=box]:checked').each(function(k){
					if(k == 0){
						number = $(this).val();
					}else{
						number += ','+$(this).val();
					}
				})
				if(number==''){
					alert('未选择差值信息');
					return false;
				}
				var sendData = {
					url: "index.php/finance/Library/pc_ck_adjust",
					data: {
					 style:style,
					 id:number,
					 inventory_id:inventory_id
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
	
			},
			IgNore:function(){
				var number = '';
				var style = $("#style option:selected").attr("value");
				var inventory_id = $("#inventory_id option:selected").attr("value");
				$('input:checkbox[name=box]:checked').each(function(k){
					if(k == 0){
						number = $(this).val();
					}else{
						number += ','+$(this).val();
					}
				})
				if(number==''){
					alert('未选择差值信息');
					return false;
				}
				var sendData = {
					url: "index.php/finance/Library/pc_ck_ignore",
					data: {
					 style:style,
					 id:number,
					 inventory_id:inventory_id
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
.selclass{ height: 36px; border-radius:3px; border: 1px solid #d0dadc; color: #aaa; width: 160px; padding: 0px 10px;}
table tr{ background-color: #fff;}
table tr th{ padding: 5px 20px; line-height: 36px;}
table tr td{ padding: 5px 20px; line-height: 40px;}

</style>
