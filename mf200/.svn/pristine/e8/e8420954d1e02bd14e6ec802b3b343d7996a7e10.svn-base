<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">销售报表</font>
 
        </h4>
        </div>       
        
		<table class="table table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th>商品名称</th>
					<th>数量(Kg)</th>
					<th>平均单价(元)</th>
					<th>最高单价(元)</th>
					<th>最低单价(元)</th>
					<th>销售总额(元)</th> 
				</tr>
			</thead>
			<tbody>
				<tr class="trclass" v-for="item in lists">
					<td>{{item.m_name}}</td>
					<td>{{item.all_num}}</td>
					<td>{{item.avg_price}}</td>
					<td>{{item.max_price}}</td>
					<td>{{item.min_price}}</td>
					<td>{{item.all_money}}</td> 
				</tr> 
			</tbody>

		</table>
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
			this.getlists()
	 	},

		methods:{
 
			getlists:function(){
		 

 
				var sendData = {
					url: "index.php/sell/Sell/sell_excel",
					data: {

					}
				};
				var re = getFaceInfo(sendData);
				this.lists = re.data;
		 
  
   			},
 
			
 
		}
	}

</script>

<style lang="less" scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top: 10px; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.h4span-ra{ float: right; margin-top: 10px; color:#fff; font-size: 16px; font-weight: normal; border-radius:3px; margin-left: 16px;  }

table tr { background-color: #fff;}
table tr td{background: none; line-height: 35px; height:35px; }
table tr th{width: 140px; height:30px; line-height: 30px; text-align: center;border:none;background-color: #d0e69c;color:#333;}
.trclass{height: 40px; width: 140px; line-height: 35px; text-align: center;}


</style>
