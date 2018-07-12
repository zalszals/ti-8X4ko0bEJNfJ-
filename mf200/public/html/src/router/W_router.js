import Warehouse_Management_AllTable from '../view/ck/Warehouse_Management_AllTable_'
import Application_Form from '@/view/ck/Application_Form_'
import Out_Warehouse from '../view/ck/Out_Warehouse'
import In_Warehouse from '../view/ck/In_Warehouse'
import Out_In_Warehouse_Detail from '../view/ck/Out_In_Warehouse_Detail'
import Goods_Associated_Warehouse from '../view/ck/Goods_Associated_Warehouse_'
import In_Warehouse_Buy from '../view/ck/In_Warehouse_Buy'
import In_Warehouse_Exit from '../view/ck/In_Warehouse_Exit'
import In_Warehouse_Other from '../view/ck/In_Warehouse_Other'
import In_Warehouse_Production from '../view/ck/In_Warehouse_Production'
import In_Warehouse_Surplus from '../view/ck/In_Warehouse_Surplus'
import Out_Warehouse_Buy from '../view/ck/Out_Warehouse_Buy'
import Out_Warehouse_Exit from '../view/ck/Out_Warehouse_Exit'
import Out_Warehouse_Other from '../view/ck/Out_Warehouse_Other'
import Out_Warehouse_Production from '../view/ck/Out_Warehouse_Production'
import Out_Warehouse_Surplus from '../view/ck/Out_Warehouse_Surplus'
import Out_Warehouse_Details from '@/view/ck/Out_Warehouse_Details'
import Warehouse_Management_Warning from '../view/ck/Warehouse_Management_Warning'
import M from '../view/ck/M'
import wdkq from '../view/ck/wdkq'
import spdxq from '../view/ck/spdxq'
import spd from '../view/ck/spd'
import sckb from '../view/ck/sckb'
import sckb_ from '../view/ck/sckb_'
import grgl from '../view/ck/grgl'
import d1 from '../view/ck/d1'
import d2 from '../view/ck/d2'
import d3 from '../view/ck/d3'
import d4 from '../view/ck/d4'
import qzx from '../view/ck/qzx'

import In_Warehouse_Add from '../view/ck/In_Warehouse_Add'
import Out_Warehouse_Add from '../view/ck/Out_Warehouse_Add'
export default [
	{
	  path: '/',
		name: 'M',
		component: M //仓库管理
    },	{
	  path: 'Warehouse_Management',
		name: 'Warehouse_Management',
		component: Warehouse_Management_AllTable //仓库管理
    }, {
		path: 'Application_Form',
		name: 'Application_Form',
		component: Application_Form //预申请列表
    },
	{
		path: 'Out_Warehouse',
		name: 'Out_Warehouse',   //出库
		component: Out_Warehouse
    },
	{
		path: 'In_Warehouse',
		name: 'In_Warehouse',
		component: In_Warehouse  //入库
    }, {
		path: 'Out_In_Warehouse_Detail',
		name: 'Out_In_Warehouse_Detail',
		component: Out_In_Warehouse_Detail  //出入库明细
    }, {
		path: 'Goods_Associated_Warehouse',
		name: 'Goods_Associated_Warehouse',
		component: Goods_Associated_Warehouse   //物料关联仓库
    },
	{
		path: 'In_Warehouse_Buy', //购买入库
		name: 'In_Warehouse_Buy',
		component: In_Warehouse_Buy
    },
	{
		path: 'In_Warehouse_Exit',
		name: 'In_Warehouse_Exit',
		component: In_Warehouse_Exit  //退货入库
    },
	{
		path: 'In_Warehouse_Other',
		name: 'In_Warehouse_Other',
		component: In_Warehouse_Other  //其他入库
    },
	{
		path: 'In_Warehouse_Production',
		name: 'In_Warehouse_Production',
		component: In_Warehouse_Production  //生产入库
    },
	{
		path: 'In_Warehouse_Surplus', //盘余入库
		name: 'In_Warehouse_Surplus',
		component: In_Warehouse_Surplus
    },
	{
		path: 'Out_Warehouse_Buy',  //销售出库
		name: 'Out_Warehouse_Buy',
		component: Out_Warehouse_Buy
    },
	{
		path: 'Out_Warehouse_Exit', //报废出库
		name: 'Out_Warehouse_Exit',
		component: Out_Warehouse_Exit
    },
	{
		path: 'Out_Warehouse_Other',//其他出库
		name: 'Out_Warehouse_Other',
		component: Out_Warehouse_Other
    },
	{
		path: 'Out_Warehouse_Production', //生产领料
		name: 'Out_Warehouse_Production',
		component: Out_Warehouse_Production
    },
	{
		path: 'Out_Warehouse_Surplus', //盘亏出库
		name: 'Out_Warehouse_Surplus',
		component: Out_Warehouse_Surplus
    }, 	{
		path: 'Out_Warehouse_Details/:order_id/:batch_id/:id', //销售出库 详情
		name: 'Out_Warehouse_Details',
		component: Out_Warehouse_Details
    },	{
		path: 'In_Warehouse_Add', //销售出库 详情
		name: 'In_Warehouse_Add',
		component: In_Warehouse_Add
    },  	{
		path: 'Out_Warehouse_Add', //销售出库 详情
		name: 'Out_Warehouse_Add',
		component: Out_Warehouse_Add
    },  	{
		path: 'wdkq', //销售出库 详情
		name: 'wdkq',
		component: wdkq
    }, 	{
		path: 'spd', //销售出库 详情
		name: 'spd',
		component: spd
    }, 	{
		path: 'spdxq', //销售出库 详情
		name: 'spdxq',
		component: spdxq
    }, 	{
		path: 'sckb', //销售出库 详情
		name: 'sckb',
		component: sckb
    },	{
		path: 'sckb_', //销售出库 详情
		name: 'sckb_',
		component: sckb_
    }, 	{
		path: 'grgl', //销售出库 详情
		name: 'grgl',
		component: grgl
    }, 	{
		path: 'd4', //销售出库 详情
		name: 'd4',
		component: d4
    }, 	{
		path: 'd3', //销售出库 详情
		name: 'd3',
		component: d3
    }, 	{
		path: 'd2', //销售出库 详情
		name: 'd2',
		component: d2
    }, 	{
		path: 'd1', //销售出库 详情
		name: 'd1',
		component: d1
    },  	{
		path: 'qzx', //销售出库 详情
		name: 'qzx',
		component: qzx
    }, 
]
