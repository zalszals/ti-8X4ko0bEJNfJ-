<template>
<div>
	<header class="row header clearfix" style="position:relative;">
		<div class="pull-left pad0 w315" onclick="if_router_hide_show()">
			<ul class="clearfix">
				<li class="pull-left wb50 text-left" id="system_icon"><img src='/lib/img/public/logo.png' class="logo mt5 ml35" /></li>
				<li class="pull-left wb40">
					<p class="text-center fc-fff fs18 mt10">库存系统</p>
					<p class="text-center fc-fff f12">当前版本2.0</p>
				</li>
			</ul>
		</div>
		<div class="fc-fff pad0 f16" style="padding-top:18px;overflow:hidden;">
			<span class="mr35"><router-link to="/router_main_Inventory_System/Warehouse_Management">库存管理</router-link></span>
			<span class="mr35"><router-link to="/router_main_Inventory_System/Application_Form">预申请列表</router-link></span>
			<span class="mr35"><router-link to="/router_main_Inventory_System/Out_Warehouse">出库管理</router-link></span>
			<span class="mr35"><router-link to="/router_main_Inventory_System/In_Warehouse">入库管理</router-link></span>
			<span class="mr35"><router-link to="/router_main_Inventory_System/Out_In_Warehouse_Detail">出入库明细</router-link></span> 
			<span class="mr35"><router-link to="/router_main_Inventory_System/Goods_Associated_Warehouse">物料关联仓库</router-link></span> 
		</div>
		<div class="pad0 w415 pull-right" style="position:absolute;top:0;right:10px;">
			<p class="text-right fc-fff">
				<i class="icon-angle-left f16 ml15"></i>
				<i class="icon-angle-right f16 ml15"></i>
				<i class="glyphicon glyphicon-repeat f14 ml15"></i>
				<span class="f14 ml15">提交反馈</span>
				<span class="f14 ml15">使用帮助</span>
				<span class="f14 ml15">摩登庄园</span>
				<i class="icon-minus f14 ml10"></i>
				<i class="icon-check-empty f14 ml10"></i>
				<i class=" icon-remove f14 ml10 mr10"></i>
			</p>
			<p class="text-right fc-fff">
                <i class="fa fa-user-o mr10"></i>
                <span class="mr10">{{worker_name}}</span>
                <span class="mr10">{{role_name}}</span>
                <span class="mr10" v-if="role_id != 1">{{group_name}}</span>
                <i class="icon-caret-down mr10 mt5"></i>
            </p>
		</div>
	</header>
	<right></right>
	<router-view></router-view>
</div>
</template>

<script>
	import right from '@/components/public/right'
	export default {
		name: 'top',
		data:function(){
            return{
                worker_name: localStorage.getItem('worker_name'),
                role_name: localStorage.getItem('role_name'),
                role_id: localStorage.getItem('role_id'),
				group_name: localStorage.getItem('group_name')
            }
        },
		components: {
			right
		}
	}

</script>
