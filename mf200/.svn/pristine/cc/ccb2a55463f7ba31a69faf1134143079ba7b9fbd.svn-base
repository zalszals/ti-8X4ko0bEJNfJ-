import Vue from 'vue'
import Router from 'vue-router'
import router from '@/router'
import router_main_Personnel_System from '@/router_main_/Personnel_System'
import router_main_Production_Management_System from '@/router_main_/Production_Management_System'
import router_main_main from '@/router_main_/main'
import router_main_Inventory_System from '@/router_main_/Inventory_System'
import router_main_Sell_System from '@/router_main_/Sell_System'
import router_main_Base_System from '@/router_main_/Baseset_System'
import B_router from '@/router/B_router'
import router_main_Purchase_System from '@/router_main_/Purchase_System'
import router_main_Finance_System from '@/router_main_/Finance_System'
import P_router from '@/router/P_router'
import W_router from '@/router/W_router'
import S_router from '@/router/S_router'
import F_router from '@/router/F_router'
import P_M_router from '@/router/P_M_router'
import P_S_router from '@/router/P_S_router'
import Main_Main_router from '@/router/Main_Main_router'

Vue.use(Router)

export default new Router({
	routes: [
		{
			path: '/',
			name: 'router_main_main',
			component: router_main_main,
			children: [Main_Main_router]		
		},

		{
			path: '/router_main_Personnel_System',
			name: 'router_main_Personnel_System',
			component: router_main_Personnel_System,
			children: [...P_router]
		},
		{
			path: '/router_main_Production_Management_System',
			name: 'router_main_Production_Management_System',
			component: router_main_Production_Management_System,
			children: [...P_M_router]
		},
		{
			path: '/router_main_Inventory_System',
			name: 'router_main_Inventory_System',
			component: router_main_Inventory_System,
			children: [...W_router]
		}, {
			path: '/router_main_Sell_System',
			name: 'router_main_Sell_System',
			component: router_main_Sell_System,
			children: [...S_router]
		}, {
			path: '/router_main_Base_System',
			name: 'router_main_Base_System',
			component: router_main_Base_System,
			children: [...B_router]
		}, {
			path: '/router_main_Finance_System',
			name: 'router_main_Finance_System',
			component: router_main_Finance_System,
			children: [...F_router]
		},
         {
			path: '/router_main_Purchase_System',
			name: 'router_main_Purchase_System',
			component: router_main_Purchase_System,
			children: [...P_S_router]
		},
		{
			path: '/router',
			name: 'router',
			component: router
    }
  ]
})
