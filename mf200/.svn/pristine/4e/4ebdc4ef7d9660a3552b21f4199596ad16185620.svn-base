<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">库存盘点&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;历史库存盘点</span>&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;盘点详情</span></font>

            <span onclick="go_back()" class="h4span-r" style="background-color:#b0c777; color:#fff;">返 回</span>
           
        </h4>
        </div>
        <p style=" height:20px;"></p>
        <h4 style="line-height:40px; color:#f2a553">编号：PD2018025001</h4>  
        <p style=" height:30px;"></p>
        <div style="width:100%;">
            <table class="table table-striped" style="border-bottom:1px solid #ddd">
				<thead>
					<tr>
					<th>盘点日期</th>
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
                    <tr class="trclass" v-for="item in materiel_info">
                        <td>{{item.add_time}}</td>
                        <td>{{item.cat_name}}</td>
                        <td>{{item.m_name}}</td>
                        <td>{{item.m_desc}}</td>
                        <td>{{item.unit}}</td>
                        <td>{{item.ck_num}}</td>
                        <td>{{item.inventory_num}}</td>
                        <td>{{item.last_num}}</td>
                        <td>{{item.status}}</td>
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
				inventory_id:this.$route.params.inventory_id,
				info:[],
				company_name:'',				
				materiel_info:[],
				info_arap:[],
			};
		},
		mounted:function(){			
			this.getlists();
	 	},

		methods:{
			getlists:function(){
			
				var inventory_id = this.inventory_id;
			 
				var sendData = {
					url: "index.php/finance/Library/inventory_detail",
					data: {
					 inventory_id:inventory_id,
		 
					}
				};
				var re = getFaceInfo(sendData);
				this.materiel_info = re.data;
		 
   			},
 

 
	 

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
