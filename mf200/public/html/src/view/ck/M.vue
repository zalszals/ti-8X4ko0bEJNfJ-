<template>
<div>
	<a><button><router-link to="/router_main_Inventory_System/Warehouse_Management"><img src="lib/img/public/System_Icon/In_Warehouse_Production.png" alt=""><p class="ppp">库存管理</p><p>园区库存信息管理</p></router-link></button></a>
	<a><button ><router-link to="/router_main_Inventory_System/Application_Form"><img src="lib/img/public/System_Icon/In_Warehouse_Exit.png" alt=""><p class="ppp">预申请列表</p><p>预申请列表管理</p></router-link></button></a>
	<a><button ><router-link to="/router_main_Inventory_System/Out_Warehouse"><img src="lib/img/public/System_Icon/In_Warehouse_Buy.png" alt=""><p class="ppp">出库管理</p><p>园区库存出库管理</p></router-link></button></a>
	<a><button><router-link to="/router_main_Inventory_System/In_Warehouse"><img src="lib/img/public/System_Icon/In_Warehouse_Surplus.png" alt=""><p class="ppp">入库管理</p><p>园区库存出库管理</p></router-link></button></a>
	<a><button ><router-link to="/router_main_Inventory_System/In_Warehouse_Other"><img src="lib/img/public/System_Icon/In_Warehouse_Other.png" alt=""><p class="ppp">出入库明细</p><p>园区出入库明细管理</p></router-link></button></a>
		<a><button ><router-link to="/router_main_Inventory_System/Goods_Associated_Warehouse"><img src="lib/img/public/System_Icon/In_Warehouse_Other.png" alt=""><p class="ppp">物料关联仓库</p><p>园区物料关联仓库</p></router-link></button></a>
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
