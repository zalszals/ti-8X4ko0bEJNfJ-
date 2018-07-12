<template>
  <div id="left-box" >
    <div style=" width: 100%; height: 100%;">
        <div class="newdivtop"> 
            <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">生产汇总表 | <font style="font-size:14px;">详情</font></font>
                
                <div class="h4span-rh">
                    <span class="rightspana" style="background-color:#b0c777;" @click="$router.back(-1)">返 回</span>
                </div>

            </h4>
        </div>

        <div class="prodetailmain">
            <h4 class="prodetailmainh4">生产计划：{{plan_name}}</h4>
			<p style="height:30px;"></p>
            <ul style="height:70px; width:100%;" v-for="jihualist in jihua" v-if="jihualist.plan_id==id">
                <li>
                        <span class="firstspan">预估产量：<p>{{jihualist.yg_amount}} Kg</p></span>
                        
                </li>

                <li>
                        <span class="firstspan">实际产量：<p>{{jihualist.estimate_amount}} Kg</p></span>
                        
                </li>

                <li>
                        <span class="firstspan">预估总成本：<p>{{jihualist.yg_cost}} 元</p></span>
                        
                </li>

                <li>
                        <span class="firstspan">实际总成本：<p>{{jihualist.total_cost}} 元</p></span>
                </li>

                <div style="clear:both"></div>
            </ul>

            <ul style="height:70px; width:100%;">
                <li>
                    <span class="secondspan">一级果：<p>{{allprosumde.day.num1}} Kg</p></span>
                </li>
                <li>
                    <span class="secondspan">二级果：<p>{{allprosumde.day.num2}} Kg</p></span>
                </li>
                <li>
                    <span class="secondspan">平均单果重量：<p>{{allprosumde.day.one_weight }} g</p></span>
                </li>
                <li>
                    <span class="secondspan">优果率：<p>{{allprosumde.day.rate }} %</p></span>
                </li>
                <div style="clear:both"></div>
            </ul>

        </div>
		<p style="height:20px;"></p>
        <div class="prodetailmain" style="width:100%; height:120px;">

            <h4 class="prodetailmainh4a">能源消耗：</h4>
            <div style="margin-left:40px;" v-for="jihualist in jihua" v-if="jihualist.plan_id==id">
                <span class="firstspana">预估成本：<p>{{jihualist.amount }} 元</p></span>
                <span class="secondspana">实际成本：<p>{{jihualist.cost_amount }} 元</p></span>
            </div>    

        </div>

        <div class="newaddmain">
           <div class="newbaitu">

                <table>  
                   
                    <tr style="border:none;"><th>名称</th><th>用量</th><th>平均单价</th><th>总价</th></tr>  
                    <tr style="border:none;"><td>天然气</td><td>{{allprosumde.energy.gas}} ㎡</td><td>{{allprosumde.energy.gas_price_d}} 元</td><td>{{allprosumde.energy.gas_total}} 元</td></tr>
                    <tr><td>二氧化碳</td><td>{{allprosumde.energy.co2}} ㎡</td><td>{{allprosumde.energy.co2_price_d}} 元</td><td>{{allprosumde.energy.co2_total}} 元</td></tr>
                    <tr><td>水</td><td>{{allprosumde.energy.water}} ㎡</td><td>{{allprosumde.energy.water_price_d}} 元</td><td>{{allprosumde.energy.water_total}} 元</td></tr>
                    <tr><td>电</td><td>{{allprosumde.energy.electric}} ㎡</td><td>{{allprosumde.energy.electric_price_d}} 元</td><td>{{allprosumde.energy.electric_total}} 元</td></tr>    
    
                </table>

           </div>
        </div>

    </div>
  </div>
</template>

<style scoped>
	.newdivtop {
		width: 100%;
		height: 70px;
		border-bottom: 1px solid #d0dadc;
	}

	.h4spana {
		font-weight: normal;
		font-size: 15px;
		line-height: 16px;
	}

	.h4span-rh {
		float: right;
		display: inline;
		margin-top: 10px;
	}

	.rightspana {
		float: right;
		display: inline;
		color: #fff;
		background-color: #f2a553;
		font-size: 16px;
		font-weight: normal;
		padding: 9px 23px;
		border-radius: 3px;
		margin-left: 20px;
	}

	.prodetailmain {
		width: 100%;
	}

	.prodetailmainh4 {
		color: #f2a553;
		margin-left: 40px;
		margin-top: 30px;
	}

	.prodetailmainh4a {
		font-size: 15px;
		font-weight: bold;
		margin-left: 40px;
		margin-top: 16px;
	}

	.prodetailmain ul {
		width: 100%;
		height: 80px;
	}

	.prodetailmain li {
		float: left;
		width: 180px;
		display: inline;
		margin-top: 16px;
		margin-left: 40px;
	}

	.prodetailmainul li {
		width: 436px;
		height: 256px;
		float: left;
		margin-left: 40px;
		margin-top: 20px;
		box-Shadow: 0px 0px 1px#ccc;
		display: inline;
		background-color: #fff;
		border-radius: 10px;
	}

	.prodetailmainh4ulh4 {
		margin-left: 30px;
		margin-bottom: 15px;
		font-weight: bold;
		margin-top: 30px;
	}

	.prodetailmainh4ulh4 span {
		margin-left: 26px;
		font-size: 14px;
		font-weight: normal;
	}

	.prodetailmainh4lidiv {
		margin-left: 30px;
		display: block;
		height: 60px;
	}

	.prodetailmainh4lidiv span {
		width: 90px;
		display: inline-block;
		margin-right: 40px;
		margin-top: 12px;
	}

	.newaddmain {
		width: 100%;
		height: auto;
	}

	.newaddmain li {
		width: 350px;
		height: 170px;
		float: left;
		margin-left: 40px;
		margin-top: 20px;
		box-Shadow: 0px 0px 1px#ccc;
		display: inline;
		background-color: #fff;
		border-radius: 10px;
	}

	.newpldiv {
		width: 130px;
		display: inline-block;
		line-height: 40px;
		color: #222;
	}

	.newpl {
		margin-left: 30px;
		display: inline-block;
	}

	.divdiv {
		width: 64px;
		text-align: left;
		display: inline-block;
	}

	.firstspan {
		font-size: 14px;
	}

	.firstspan p {
		font-size: 16px;
		margin-top: 3px;
	}

	.secondspan {
		font-size: 14px;
	}

	.secondspan p {
		font-size: 16px;
		margin-top: 3px;
	}

	.firstspana {
		display: inline-block;
		font-size: 14px;
		width: 200px;
		margin-top: 15px;
	}

	.firstspana p {
		font-size: 16px;
		margin-top: 3px;
	}

	.secondspana {
		display: inline-block;
		font-size: 14px;
		margin-top: 15px;
	}

	.secondspana p {
		font-size: 16px;
		margin-top: 3px;
	}

	.newbaitu {
		width: 610px;
		height: 260px;
		padding-top: 20px;
		background-color: #fff;
		margin-left: 40px;
		border-radius: 10px;
		box-Shadow: 0px 0px 6px #e3e3e3;
	}

	table {
		width: 100%;
		border-collapse: collapse;
		margin: 0 auto;
		text-align: center;
	}

	table tr th {
		text-align: center;
		padding: 10px 30px;
	}

	table tr td {
		text-align: center;
		padding: 10px 30px;
	}

</style>

<script>
	export default {
		data() {
			return {
				id: '',
				plan_name: '',
				jihua: [],
				allprosumde: [],
				addtime: ''

			}
		},

		mounted: function() {
			this.plan_name = this.$route.query.plan_name;
			this.id = this.$route.query.id;
			this.addtime = this.$route.query.add_time;
			this.getallprosumde();
			this.newgetshuju();
		},

		methods: {

			newgetshuju: function() {
				var sendData = {};
				var jsonData = {};
				sendData.url = "index.php/product/ProductSum/prosum_list";
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				this.jihua = re.data;
			},

			getallprosumde: function() {

				var sendData = {};
				var jsonData = {};

				sendData.url = "index.php/product/ProductSum/prosum_list_detail";
				jsonData.plan_id = this.id;
				jsonData.s_time = this.addtime;
				sendData.data = jsonData;
				var re = getFaceInfo(sendData);
				this.allprosumde = re.data;
				//console.log(this.allprosumde);
			},

		},


	}

</script>
