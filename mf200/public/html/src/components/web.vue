<template>
  <div id="left-box" class="">
    <div style=" width: 100%; height: 100%; ">
		<div class="main-left-m-top">
			<div class="main-left-m-top-left">
				<H4 style="font-weight:bold;">基础设置</H4>
				
			</div>
			<div class="main-left-m-top-right">
				<a href="#/baseset/cropmode/grow_add/" role="button"><h5>+&nbsp;设为首页</h5></a>
			</div><div style="clear:both"></div>
		</div>
    </div>

    <div class="newul">
        <ul> 
          <li>            
			<router-link to="/router_main_Base_System/growlist">
                <img src="/lib/img/public/cropmode/z1.png" style="margin-top:30px;" />
                <h4 style="line-height:60px;">种植模式管理</h4>
                <p style="padding:0 30px; line-height:24px;">
                    可对种植模式进行添加、修改、保存、删除操作，操作完成后在发布生产计划中的种植模式下拉菜单中显示。
                </p>
			</router-link>
          </li>

          <li>
            <router-link to="/router_main_Base_System/grow_area_list">
                <img src="/lib/img/public/cropmode/z2.png" style="margin-top:30px;" />
                <h4 style="line-height:60px;">种植区域管理</h4>
                <p style="padding:0 30px; line-height:24px;">
                    可对种植区域进行添加、删除操作，可自定义种植区域中分类名称、种植面积，操作完成后在发布生产计划中种植计划中显示。
                </p>
            </router-link>
          </li>

          <li>
            <router-link to="/router_main_Base_System/grow_list">
                <img src="/lib/img/public/cropmode/z3.png" style="margin-top:30px;" />
                <h4 style="line-height:60px;">作物管理</h4>
                <p style="padding:0 30px; line-height:24px;">
                    可对作物品种进行添加、修改、删除的操作，操作完成后在发布生产计划中的作物选择中显示。
                </p>
            </router-link>
          </li>

          <li>
            <router-link to="/router_main_Base_System/materiel_list">
                <img src="/lib/img/public/cropmode/z4.png" style="margin-top:30px;" />
                <h4 style="line-height:60px;">物料管理</h4>
                <p style="padding:0 30px; line-height:24px;">
                    可对物料进行添加、修改、删除、搜索的操作，可管理物料类别且操作完成后在添加物料的类别下拉菜单中显示。
                </p>
            </router-link>
          </li>

          <li>
            <router-link to="/router_main_Base_System/processlist">
                <img src="/lib/img/public/cropmode/z5.png" style="margin-top:30px;" />
                <h4 style="line-height:60px;">工序管理</h4>
                <p style="padding:0 30px; line-height:24px;">
                    可对生管系统中的工序进行自定义式添加、删除的操作，操作完成后在单位设置的选择工序下拉菜单中显示，可对单位进行自定义式添加、删除。
                </p>
            </router-link>
          </li>

          <li>
            <router-link to="/router_main_Personnel_System/Staff_Attendance">
                <img src="/lib/img/public/cropmode/z6.png" style="margin-top:30px;" />
                <h4 style="line-height:60px;">人事管理</h4>
                <p style="padding:0 30px; line-height:24px;">
                    分为人员管理和职务管理两部分，可对人员及职务进行添加、编辑、删除的操作。
                </p>                
            </router-link>
            <p style="padding-top:10px; " v-on:click="opda()"><img src="/lib/img/public/cropmode/xiajiantou.jpg" /></p>

            <div class="addorderbota hide" id="addor" style="background:url(/lib/img/public/cropmode/z7.png) no-repeat center center">

                <h4 style="margin-top:120px;"><router-link to="/router_main_Personnel_System/Personnel_Management">人员管理</router-link></h4>
               
                <h4 style="margin-top:80px;"><router-link to="/router_main_Personnel_System/Job_Mangement">职务管理</router-link></h4>
               
            </div>  

          </li>

         

        </ul> 
    </div>

      <!--<h4 style="width:100%;line-height:50px; font-size:22px; font-weight:bold; color:red; text-align:center">页面索引</h4>
      <div style="width:100%; height:100%;">
          <table class="table table-striped">
              <tr class="newtr">
                  <td>基础设置</td>
              </tr>
              <tr class="newtr">
                  <td>人事管理</td>
                  <td style="padding:0px;">
                    <table style="width:100%;">
                        <tr class="newtra" style="border-bottom:1px solid #777;padding:0px;">
                            <td><A href="#/baseset/perlist">人员管理(列表-删除)</A></td>
                            <td><A href="#/baseset/ppadd">人员管理(添加)</A></td>
                            <td style="border-right:none;"><A href="#/baseset/ppedit">人员管理首页(编辑)</A></td>
                        </tr>

                        <tr class="newtra">
                            <td><a href="#/baseset/joblist">职务管理(列表-删除)</a></td>
                            <td><A href="#/baseset/pjadd">职务管理(添加)</A></td>
                            
                        </tr>

                    </table>
                  </td>
              </tr>
              <tr class="newtr">
                  <td>工序管理</td>
                  <td><a href="#/baseset/processlist">列表-添加-删除-编辑</a></td>
                 
              </tr>

              <tr class="newtr">
                  <td>作物管理</td>
                  <td><A href="#/baseset/cropmode/grow_list">作物管理(列表-删除)</a></td>
                  <td><a href="#/baseset/cropmode/grow_add">作物管理(添加)</a></td>
                  <td><a href="#/baseset/cropmode/grow_edit">作物管理(编辑)</a></td>
              </tr>
              
              <tr class="newtr">
                  <td>种植模式管理</td>
                  <td><a href="#/baseset/growlist">列表-添加-编辑-删除</a></td>
              </tr>
              <tr class="newtr">
                  <td>种植区域管理</td>
                  <td><a href="#/baseset/grow_area/grow_area_list">列表-添加-删除-编辑</a></td>
              </tr>
              <tr class="newtr">
                  <td>物料管理</td>
                  <td><a href="#/baseset/materielmode/materiel_list">列表-添加-删除-编辑</a></td>
                  <td><a href="#/baseset/materielmode/materiel_cate_mode">类别管理(增删改查)</a></td>
              </tr>
              
              <tr class="newtr">
                  <td>种植管理</td>
              </tr>
              
              <tr class="newtr">
                 <td>生产计划</td>
				 <td><a href="#/product/productplan/pro_plan">生产计划列表</a></td>
				 <td><a href="#/product/productplan/product_plan_done">生产计划列表(已完成)</a></td>
				 
                 <td><a href="#/product/productplan/product_plan_list">生产计划详情</a></td>
				 <td><a href="#/product/productplan/product_plan_mylist">生产计划详情-我的任务(详情)</a></td>
				 
				 <td><a href="#/product/productplan/product_job_list">任务列表</a></td>
				 <td><a href="#/product/productplan/product_job_done">任务列表(已完成)</a></td>
				 
				 <td><a href="#/product/productplan/pro_plan_add">生产计划添加</a></td>
				 
              </tr>
			  
			  <tr class="newtr">
                 <td>种植任务</td> 
				 <td><a href="#/product/planttask/planttask_list">种植任务(首页和详情)</a></td>
				 <td><a href="#/product/planttask/planttask_add">添加种植任务</a></td>
				 <td><a href="#/product/planttask/planttask_details">种植任务详情</a></td>
              </tr>
			  
			  <tr class="newtr">
			  	  <td>工人管理</td>
				  <td style="padding:0px;">
				  	<table style="width:100%;">
						<tr class="newtra" style="border-bottom:1px solid #777;padding:0px;border-right:none;">
						<td><a href="#/worker/workerorder/workerorder_list">工单管理</a></td>
						<td style="padding:0px;">
							<table style="width:100%;">
							<tr class="newtra" style="border-bottom:1px solid #777;padding:0px;border-right:none;">
								<td>发布工单</td>
								<td style="border-right:none; padding:0px;">
									<table style="width:100%;">
									<tr class="newtra" style="border-bottom:1px solid #777;padding:0px; border-right:none;">
										<td style="border-right:none;"><a href="#/worker/workerorder/addorder_list1">模式一</a></td>
									</tr>
									<tr class="newtra" style="border-bottom:0px solid #777;padding:0px; border-right:none;">
										<td style="border-right:none;"><a href="#/worker/workerorder/addorder_list2">模式二</a></td>
									</tr>
									</table>
								</td>
                                <td><a href="#/worker/workerorder/pro_order_grow">选择种植任务</a></td>
							</tr>
							<tr>
								<td><A href="#/worker/workerorder/order_list">工单核查</A></td>
                                <td style="border-right:none; padding:0px;"><a href="#/worker/workerorder/order_list_check">核查详情</a></td>
							</tr>
							
							</table>
						</td>
						</tr>

						<tr class="newtra" style="width:100%;border-bottom:1px solid #777;padding:0px;border-right:none;">
                            <td><A href="#/worker/workerorder/order_worker_list">工人管理</A></td>
                            <td><A href="#/worker/workerorder/order_history">工人历史工单</A></td>


                        </tr>
						<tr class="newtra" style="width:100%;padding:0px;border-right:none;"><td><a href="#/worker/workerorder/pro_order_list">生产看板</a></td>
                        <td><a href="#/worker/workerorder/pro_order_History">工人历史工单</a></td>
                        </tr>

						
					</table>
				  </td>
			  </tr>

              <tr class="newtr">
                 <td><a href="#/worker/production/production_sum">生产汇总表</a></td> 
				 <td><a href="#/worker/production/production_sum_details">生产计划</a></td>
				 <td><a href="#/worker/production/production_sum_grow">种植任务</a></td>
				 <td><a href="#/worker/production/production_grow_detail">工时-物料-能耗成本</a></td>
              </tr>

          </table>
          
      </div>
      -->

      


  </div>


</template>
<style>
.newtr{ height: 40px; border: 1px solid#666; }

.newtra{ height: 40px; }

.newul{ width: 100%; height: auto; display: flex;}
.newul ul{ margin-left: -20px; }
.newul li{ width: 340px; height: 260px; float: left; display: inline; text-align: center; margin-top: 20px; margin-left: 20px; background-color:#fff; border:1px solid #e8e8e8; border-radius:8px;  }

.main-left-m-top {
  width: 100%;
  height: 70px;
  border-bottom: 1px solid #d0dadc;
}
 .main-left-m-top-left {
    width: 56%;
    height: auto;
    float: left;
    display: inline; 
  }
.main-left-m-top-right {
    width: 40%;
    height: auto;
    float: right;
    display: inline;
  }
.main-left-m-top-right a {
      padding: 9px 24px;
      background-color: #f2a553;
      border-radius: 3px;
      color: #fff;
      font-size: 14px;
      font-weight: bold;
      float: right;
      display: inline;
      margin-top: 8px;
}
.main-left-m-top-right a:visited {
      color: #fff;
      text-decoration: none;
}
.main-left-m-top-right a:hover {
      color: #fff;
      text-decoration: none;
}
.addorderbota{width:340px; height:295px; float: left; text-align: center; margin-top: 10px; display: block;}
</style>
<script>
export default {
  
  methods:{
      opda(){
          $("#addor").removeClass("hide");
      }
  },

}
</script>
