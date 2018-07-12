// 销售下单
import sell_index from '@/view/sell/S_order/S_index' // 销售系统首页
import sell_baobiao from '@/view/sell/S_order/S_baobiao' // 销售报表
import sell_xiadan from '@/view/sell/S_order/Xd_index' // 销售下单
import sell_kucun from '@/view/sell/S_order/Now_Stocksell' // 现在库存销售
import sell_kucun_look from '@/view/sell/S_order/Now_Stocksell_look' // 现在库存销售 预览
import sell_shengchan from '@/view/sell/S_order/Od_shengchang' // 订单化生产
import sell_shengchan_look from '@/view/sell/S_order/Od_shengchang_look' // 订单化生产 预览

// 下单列表
import sell_nocheck_list from '@/view/sell/orderlist/nocheck/nocheck_list' // 没审核的下单列表
import sell_nocheck_details from '@/view/sell/orderlist/nocheck/nocheck_details' // 没审核的下单 详情
import sell_nocheck_history_list from '@/view/sell/orderlist/nocheck/nocheck_history_list' // 没审核的下单 历史列表
import sell_nocheck_history_list_ok from '@/view/sell/orderlist/nocheck/nocheck_history_list_ok' // 没审核的下单 历史列表 ok
import sell_nocheck_history_list_no from '@/view/sell/orderlist/nocheck/nocheck_history_list_no' // 没审核的下单 历史列表 ok
import sell_check_list from '@/view/sell/orderlist/check/check_list' // 审核的下单列表
import sell_check_details from '@/view/sell/orderlist/check/check_details' // 审核的下单 详情
import sell_check_history_list from '@/view/sell/orderlist/check/check_history_list' // 审核的下单 历史列表
import sell_check_history_list_ok from '@/view/sell/orderlist/check/check_history_list_ok' // 审核的下单 历史列表

// 销售订单
import s_orderlist from '@/view/sell/S_dingdan/sellorder_list/s_order_list' // 审核的 销售订单
import s_orderdetails from '@/view/sell/S_dingdan/sellorder_list/s_order_details' // 审核的 销售订单 详情
import s_choicedetails from '@/view/sell/S_dingdan/sellorder_list/choice_details' // 审核的 备货详情
import s_supplydetails from '@/view/sell/S_dingdan/sellorder_list/supply_details' // 审核的 供货详情

// 销售订单 已完成
import sorderlistok from '@/view/sell/S_dingdan/sellorderlistok/sorderlistok' // 销售订单 已完成
import sorderdetailsok from '@/view/sell/S_dingdan/sellorderlistok/sorderdetailsok' // 订单详情 已完成
import ssupplydetailsoka from '@/view/sell/S_dingdan/sellorderlistok/ssupplydetailsok' // 供货详情 已完成

// 销售系统独立运行时
import s_orderlistgoing from '@/view/sell/S_dingdan/sellorder_list_going/s_supply_going' // 运行中 备货
import s_orderlistgoingdetails from '@/view/sell/S_dingdan/sellorder_list_going/s_supply_going_details' // 运行中 备货详情

import ssupplyindex from '@/view/sell/supplymanagement/supplyindex' // 供货列表
import ssupplyok from '@/view/sell/supplymanagement/supplyok' // 供货 确认
import ssupplydetails from '@/view/sell/supplymanagement/supplydetails' // 供货详情
import scustomerindex from '@/view/sell/customermanagement/customerindex' // 客户管理
import scustomeradd from '@/view/sell/customermanagement/customeradd' // 客户添加

export default [
	{
		path: '/',
		name: 'sell_index',
		component: sell_index
	},
	{
		path: 'sell/list',
		name: 'sell_baobiao',
		component: sell_baobiao
	},
	{
		path: 'sell/xiadan',
		name: 'sell_xiadan',
		component: sell_xiadan
	},
	{
		path: 'sell/stocksell',
		name: 'sell_kucun',
		component: sell_kucun
	},
	{
		path: 'sell/stocksell_look',
		name: 'sell_kucun_look',
		component: sell_kucun_look
	},
	{
		path: 'sell/shengchan',
		name: 'sell_shengchan',
		component: sell_shengchan
	},
	{
		path: 'sell/shengchan_look',
		name: 'sell_shengchan_look',
		component: sell_shengchan_look
	},
	// 下单列表
	{
		path: 'sell/nocheck_list',
		name: 'sell_nocheck_list',
		component: sell_nocheck_list
	},
	{
		path: 'sell/nocheck_details/:order_id',
		name: 'sell_nocheck_details',
		component: sell_nocheck_details
	},
	{
		path: 'sell/nocheck_history_list', // 未使用
		name: 'sell_nocheck_history_list',
		component: sell_nocheck_history_list
	},
	{
		path: 'sell/nocheck_history_ok',
		name: 'sell_nocheck_history_list_ok',
		component: sell_nocheck_history_list_ok
	},
	{
		path: 'sell/nocheck_history_no',
		name: 'sell_nocheck_history_list_no',
		component: sell_nocheck_history_list_no
	},
	// 审核
	{
		path: 'sell/check_list',
		name: 'sell_check_list',
		component: sell_check_list
	},
	{
		path: 'sell/check_details/:order_id',
		name: 'sell_check_details',
		component: sell_check_details
	},
	{
		path: 'sell/check_history_list',
		name: 'sell_check_history_list',
		component: sell_check_history_list
	},
	{
		path: 'sell/check_history_ok',
		name: 'sell_check_history_list_ok',
		component: sell_check_history_list_ok
	},
	// 销售订单
	{
		path: 'sell/s_orderlist',
		name: 's_orderlist',
		component: s_orderlist
	},
	{
		path: 'sell/s_orderdetails/:order_id',
		name: 's_orderdetails',
		component: s_orderdetails
	},
	{
		path: 'sell/s_choicedetails/:order_id',
		name: 's_choicedetails',
		component: s_choicedetails
	},
	{
		path: 'sell/s_supplydetails/:batch_id',
		name: 's_supplydetails',
		component: s_supplydetails
	},
	{
		path: 'sell/sorderlistok', // 已完成
		name: 'sorderlistok',
		component: sorderlistok
	},
	{
		path: 'sell/sorderdetailsok',
		name: 'sorderdetailsok',
		component: sorderdetailsok
	},
	{
		path: 'sell/ssupplydetailsok',
		name: 'ssupplydetailsoka',
		component: ssupplydetailsoka
	},
	{
		path: 'sell/s_orderlistgoing',
		name: 's_orderlistgoing',
		component: s_orderlistgoing
	},
	{
		path: 'sell/s_orderlistgoingdetails',
		name: 's_orderlistgoingdetails',
		component: s_orderlistgoingdetails
	},
	// 供货管理和客户管理
	{
		path: 'sell/supplyindex',
		name: 'ssupplyindex',
		component: ssupplyindex
	},
	{
		path: 'sell/supplyok',
		name: 'ssupplyok',
		component: ssupplyok
	},
	{
		path: 'sell/supplydetails/:order_id/:batch_id',
		name: 'ssupplydetails',
		component: ssupplydetails
	},
	{
		path: 'sell/customerindex',
		name: 'scustomerindex',
		component: scustomerindex
	},
	{
		path: 'sell/customeradd',
		name: 'scustomeradd',
		component: scustomeradd
	},
	// 财务系统 库存盘点

]
