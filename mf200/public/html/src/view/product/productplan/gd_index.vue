<template>
  <div id="left-box" class="">
    <div class="newula">
        <ul> 
          <li>            
            <router-link to="/router_main_Product_System/GrowManage/product_plan_list">
                <img src="/lib/img/public/cropmode/z8.png" style="margin-top:30px;" />
                <h4 style="line-height:60px;">发布工单</h4>
                <p style="padding:0 30px; line-height:24px;">
                    发布工单责任到人
                </p>
            </router-link>
          </li>

          <li>
            <router-link to="/router_main_Product_System/GrowManage/product_task_list">
                <img src="/lib/img/public/cropmode/z9.png" style="margin-top:30px;" />
                <h4 style="line-height:60px;">工单管理</h4>
                <p style="padding:0 30px; line-height:24px;">
                    已发布工单列表
                </p>
            </router-link>
          </li>

          <li>
            <router-link to="/router_main_Product_System/GrowManage/product_task_list">
                <img src="/lib/img/public/cropmode/z9.png" style="margin-top:30px;" />
                <h4 style="line-height:60px;">工人管理</h4>
                <p style="padding:0 30px; line-height:24px;">
                    员工评分排行
                </p>
            </router-link>
          </li>
        </ul> 
    </div>

  </div>


</template>
<style lang="less" scoped>
.newtr{ height: 40px; border: 1px solid#666; }

.newtra{ height: 40px; }

.newula{ width: 100%; height: auto; display: flex;}
.newula ul{ margin-left: -20px; }
.newula li{ width: 340px; height: 210px; float: left; display: inline; text-align: center; margin-top: 20px; margin-left: 20px; background-color:#fff; border:1px solid #e8e8e8; border-radius:8px;  }

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
