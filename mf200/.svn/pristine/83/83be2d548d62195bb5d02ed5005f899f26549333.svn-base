<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">销售订单&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;订单详情</span>&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;供货详情</span></font>

            <span class="h4span-r" style="background-color:#b0c777;">返 回</span>
            
        </h4>
        </div>
        <p style="height:50px;"></p>
        <div  class="sell_center">
        
           
            <p style=" width:70%; margin:30px 0; ">
                <table class="atable">
                    <tr>
                        <th>商品</th>
                        <th>数量（Kg）</th>
                        <th>备货人</th>
                        
                    </tr>
                     <tr v-for="item in materiel_info">
                        <td>{{item.m_name}}</td>
                        <td>{{item.m_num}}</td>
                        <td>{{info.add_people}}</td>
                    </tr>

                </table>
            </p>
			<template  v-if="info.pay_status==1">
			    <h4 style="color:#f3a753; margin-bottom:30px;">状态：备货</h4>
			</template>

<template v-if="info.pay_status==2">
			    <h4 style="color:#f3a753; margin-bottom:30px;">状态：已发货</h4>
			</template>

</div>


</div>
</div>
</template>
<script>
	export default {
		data() {
			return {
				batch_id: this.$route.params.batch_id,
				info: [],
				is_have: '',
				materiel_info: []
			};
		},
		mounted: function() {
			this.getlists()
		},

		methods: {
			getlists: function() {

				var batch_id = this.batch_id;

				var sendData = {
					url: "index.php/sell/Sell/add_piorder_info",
					data: {
						batch_id: batch_id,

					}
				};
				var re = getFaceInfo(sendData);
				this.info = re.data;

				this.materiel_info = re.data.pici_info;
			},




		}
	}

</script>


<style lang="less" scoped>
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

	.h4span-r {
		float: right;
		margin-top: 10px;
		display: inline;
		color: #fff;
		background-color: #f2a553;
		font-size: 16px;
		font-weight: normal;
		padding: 9px 23px;
		border-radius: 3px;
		margin-left: 20px;
	}

	.h4span-ra {
		float: right;
		margin-top: 10px;
		display: inline;
		color: #fff;
		font-size: 16px;
		font-weight: normal;
		border-radius: 3px;
		margin-left: 16px;
	}

	.selclass {
		height: 36px;
		border-radius: 3px;
		border: 1px solid #d0dadc;
		color: #aaa;
		width: 160px;
		padding: 0px 10px;
	}

	.sell_center {
		width: 90%;
		margin-left: 50px;
		height: auto;
	}

	.sell_center ul li {
		width: 100%;
		height: auto;
	}

	.rightzhg {
		line-height: 50px;
		color: #f3a753;
	}

	table {
		width: 100%;
		border-collapse: collapse;
		margin: 0 auto;
		text-align: center;
	}

	.atable tr th {
		text-align: center;
		padding: 10px 30px;
		background-color: #fff;
		border-bottom: 1px solid #e2e2e2;
	}

	.atable tr td {
		text-align: center;
		padding: 10px 30px;
		background-color: #fff;
		border-bottom: 1px solid #eee;
	}

</style>
