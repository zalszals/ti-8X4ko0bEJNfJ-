import Purchase_Application_Form from '@/view/Purchase/Purchase_Application_Form'
//import Purchase_Application_Form_Details_Not_Through from '@/view/Purchase/Purchase_Application_Form_Details_Not_Through'
import Purchase_Application_Form_Details_Not_Through_Edit from '@/view/Purchase/Purchase_Application_Form_Details_Not_Through_Edit'
//import Purchase_Application_Form_Details_Through from '@/view/Purchase/Purchase_Application_Form_Details_Through'
import Purchase_Application_Form_Not_Audited from '@/view/Purchase/Purchase_Application_Form_Not_Audited'
import Purchase_Application_Form_Not_Audited_Add from '@/view/Purchase/Purchase_Application_Form_Not_Audited_Add'
//import Purchase_Application_Form_Not_Audited_Edit from '@/view/Purchase/Purchase_Application_Form_Not_Audited_Edit'
import Purchase_In_From from '@/view/Purchase/Purchase_In_From'
import Purchase_In_From_Not_Audited_Details from '@/view/Purchase/Purchase_In_From_Not_Audited_Details'
//import Purchase_In_From_Not_Through_Details from '@/view/Purchase/Purchase_In_From_Not_Through_Details'
//import Purchase_In_From_Wait_Details from '@/view/Purchase/Purchase_In_From_Wait_Details'
import Purchase_Order from '@/view/Purchase/Purchase_Order'
import Purchase_Order_Audited_Details_In_Details_ from '@/view/Purchase/Purchase_Order_Audited_Details_In_Details_'
import Purchase_Order_Audited_Details_Payable_ from '@/view/Purchase/Purchase_Order_Audited_Details_Payable_'
import Purchase_Order_Audited_Details_Exit from '@/view/Purchase/Purchase_Order_Audited_Details_Exit'
import Purchase_Order_Audited_Details_In from '@/view/Purchase/Purchase_Order_Audited_Details_In'
import Purchase_Order_Audited_Details_In_Details from '@/view/Purchase/Purchase_Order_Audited_Details_In_Details'
import Purchase_Order_Audited_Details_Payable from '@/view/Purchase/Purchase_Order_Audited_Details_Payable'
import Purchase_Order_Not_Audited_Add from '@/view/Purchase/Purchase_Order_Not_Audited_Add'
// import Purchase_Order_Not_Audited_Draw from '@/view/Purchase/Purchase_Order_Not_Audited_Draw'
import Purchase_Order_Not_Audited_Details from '@/view/Purchase/Purchase_Order_Not_Audited_Details'
import Purchase_Order_Not_Audited_Details_Edit from '@/view/Purchase/Purchase_Order_Not_Audited_Details_Edit'
import Purchase_Return_From from '@/view/Purchase/Purchase_Return_From'
import Purchase_Return_From_Not_Through_Details from '@/view/Purchase/Purchase_Return_From_Not_Through_Details'
import Purchase_Return_From_Not_Through_Details_Edit from '@/view/Purchase/Purchase_Return_From_Not_Through_Details_Edit'
//import Purchase_Return_From_Through_Details from '@/view/Purchase/Purchase_Return_From_Through_Details'
//import Purchase_Return_From_Not_Audited_Details from '@/view/Purchase/Purchase_Return_From_Not_Audited_Details'
import Supplier_Manage from '@/view/Purchase/Supplier_Manage'
import Supplier_Manage_Add from '@/view/Purchase/Supplier_Manage_Add'
import Supplier_Manage_Details from '@/view/Purchase/Supplier_Manage_Details'
import Purchase_Return_From_Not_Audited_Details_Edit from '@/view/Purchase/Purchase_Return_From_Not_Audited_Details_Edit'
import Purchase_Main from '@/view/Purchase/Purchase_Main'
import Purchase_Report from '@/view/Purchase/Purchase_Report'
export default [
    {
        path: '/',
        name: 'Purchase_Main',
        component: Purchase_Main
    },     {
        path: 'Purchase_Application_Form',
        name: 'Purchase_Application_Form',
        component: Purchase_Application_Form
    },
//	{
//        path: 'Purchase_Application_Form_Details_Not_Through',
//        name: 'Purchase_Application_Form_Details_Not_Through',
//        component: Purchase_Application_Form_Details_Not_Through
//    },
	{
        path: 'Purchase_Application_Form_Details_Not_Through_Edit',
        name: 'Purchase_Application_Form_Details_Not_Through_Edit',
        component: Purchase_Application_Form_Details_Not_Through_Edit
    }, 
//	{
//        path: 'Purchase_Application_Form_Details_Through',
//        name: 'Purchase_Application_Form_Details_Through',
//        component: Purchase_Application_Form_Details_Through
//    },
	{
        path: 'Purchase_Application_Form_Not_Audited',
        name: 'Purchase_Application_Form_Not_Audited',
        component: Purchase_Application_Form_Not_Audited
    }, {
        path: 'Purchase_Application_Form_Not_Audited_Add',
        name: 'Purchase_Application_Form_Not_Audited_Add',
        component: Purchase_Application_Form_Not_Audited_Add
    }, 
//	{
//        path: 'Purchase_Application_Form_Not_Audited_Edit',
//        name: 'Purchase_Application_Form_Not_Audited_Edit',
//        component: Purchase_Application_Form_Not_Audited_Edit
//    },
	{
        path: 'Purchase_In_From',
        name: 'Purchase_In_From',
        component: Purchase_In_From

    }, {
        path: 'Purchase_In_From_Not_Audited_Details',
        name: 'Purchase_In_From_Not_Audited_Details',
        component: Purchase_In_From_Not_Audited_Details
    }, 
//	{
//        path: 'Purchase_In_From_Not_Through_Details',
//        name: 'Purchase_In_From_Not_Through_Details',
//        component: Purchase_In_From_Not_Through_Details
//    }, 
//	{
//        path: 'Purchase_In_From_Wait_Details',
//        name: 'Purchase_In_From_Wait_Details',
//        component: Purchase_In_From_Wait_Details
//    },
	{
        path: 'Purchase_Order',
        name: 'Purchase_Order',
        component: Purchase_Order
    }, {
        path: 'Purchase_Order_Audited_Details_In_Details_',
        name: 'Purchase_Order_Audited_Details_In_Details_',
        component: Purchase_Order_Audited_Details_In_Details_
    }, {
        path: 'Purchase_Order_Audited_Details_Payable_',
        name: 'Purchase_Order_Audited_Details_Payable_',
        component: Purchase_Order_Audited_Details_Payable_
    }, {
        path: 'Purchase_Order_Audited_Details_Exit',
        name: 'Purchase_Order_Audited_Details_Exit',
        component: Purchase_Order_Audited_Details_Exit
    }, {
        path: 'Purchase_Order_Audited_Details_In',
        name: 'Purchase_Order_Audited_Details_In',
        component: Purchase_Order_Audited_Details_In
    }, {
        path: 'Purchase_Order_Audited_Details_In_Details',
        name: 'Purchase_Order_Audited_Details_In_Details',
        component: Purchase_Order_Audited_Details_In_Details
    }, {
        path: 'Purchase_Order_Audited_Details_Payable',
        name: 'Purchase_Order_Audited_Details_Payable',
        component: Purchase_Order_Audited_Details_Payable
    }, {
        path: 'Purchase_Order_Not_Audited_Add',
        name: 'Purchase_Order_Not_Audited_Add',
        component: Purchase_Order_Not_Audited_Add
    }, /* {
        path: 'Purchase_Order_Not_Audited_Draw',
        name: 'Purchase_Order_Not_Audited_Draw',
        component: Purchase_Order_Not_Audited_Draw
    } ,*/ {
        path: 'Purchase_Order_Not_Audited_Details',
        name: 'Purchase_Order_Not_Audited_Details',
        component: Purchase_Order_Not_Audited_Details
    }, {
        path: 'Purchase_Order_Not_Audited_Details_Edit',
        name: 'Purchase_Order_Not_Audited_Details_Edit',
        component: Purchase_Order_Not_Audited_Details_Edit
    }, {
        path: 'Purchase_Return_From',
        name: 'Purchase_Return_From',
        component: Purchase_Return_From
    }, {
        path: 'Purchase_Return_From_Not_Through_Details',
        name: 'Purchase_Return_From_Not_Through_Details',
        component: Purchase_Return_From_Not_Through_Details
    }, {
        path: 'Purchase_Return_From_Not_Through_Details_Edit',
        name: 'Purchase_Return_From_Not_Through_Details_Edit',
        component: Purchase_Return_From_Not_Through_Details_Edit
    }, 
//	{
//        path: 'Purchase_Return_From_Through_Details',
//        name: 'Purchase_Return_From_Through_Details',
//        component: Purchase_Return_From_Through_Details
//    }, 
//	{
//        path: 'Purchase_Return_From_Not_Audited_Details',
//        name: 'Purchase_Return_From_Not_Audited_Details',
//        component: Purchase_Return_From_Not_Audited_Details
//    }, 
	{
        path: 'Supplier_Manage',
        name: 'Supplier_Manage',
        component: Supplier_Manage
    }, {
        path: 'Supplier_Manage_Add',
        name: 'Supplier_Manage_Add',
        component: Supplier_Manage_Add
    }, {
        path: 'Supplier_Manage_Details',
        name: 'Supplier_Manage_Details',
        component: Supplier_Manage_Details
    }, {
        path: 'Purchase_Return_From_Not_Audited_Details_Edit',
        name: 'Purchase_Return_From_Not_Audited_Details_Edit',
        component: Purchase_Return_From_Not_Audited_Details_Edit
    },{
        path: 'Purchase_Report',
        name: 'Purchase_Report',
        component: Purchase_Report
    },
]
