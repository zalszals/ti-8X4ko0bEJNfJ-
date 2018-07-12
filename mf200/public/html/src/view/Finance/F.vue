<template>
<div>
	<a><button><router-link to="/router_main_Finance_System/Accounts_Receivable"><img src="lib/img/public/System_Icon/In_Warehouse_Production.png" alt=""><p class="ppp">应收款账单</p><p>园区应收款账单</p></router-link></button></a>
	<a><button ><router-link to="/router_main_Finance_System/Accounts_Payable"><img src="lib/img/public/System_Icon/In_Warehouse_Exit.png" alt=""><p class="ppp">应付款账单</p><p>园区应付款账单</p></router-link></button></a>
	<a><button ><router-link to="/router_main_Finance_System/S_Z_M_X"><img src="lib/img/public/System_Icon/In_Warehouse_Buy.png" alt=""><p class="ppp">收支明细</p><p>园区收支明细</p></router-link></button></a>
	<a><button><router-link to="/router_main_Finance_System/sell/stockingindex"><img src="lib/img/public/System_Icon/In_Warehouse_Surplus.png" alt=""><p class="ppp">库存盘点</p><p>园区库存盘点</p></router-link></button></a>
</div>
</template>
<style scoped>
	* {
		margin: 0;
		padding: 0;
		font-family: "微软雅黑";
		font-weight: 500;
		font-size: 14px;
	}

	div {
		/*        overflow: hidden;*/
		/*        text-align: center;*/
		margin-left: 10px;
	}

	div button {
		padding: 30px;
		/*        float: left;*/
		margin: 20px;
		border-style: solid;
		border-width: 2px;
		border-color: #EAEEF1;
		background-color: white;
		border-radius: 10px;
		margin-left: 15px;
		width: 320px;
		/*        font-size: 50px;*/
	}

	p {
		padding-top: 30px;
	}

</style>
<script>
	export default {


	}

</script>
