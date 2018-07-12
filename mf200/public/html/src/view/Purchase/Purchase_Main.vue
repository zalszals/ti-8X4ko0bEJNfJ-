<template>
  <div id="left-box" class="">
    <div class="newula">
        <ul> 
            <li>            
                <router-link to="router_main_Production_Management_System">
                    <img src="/lib/img/public/cropmode/z8.png" style="margin-top:30px;" />
                    <h4 style="line-height:60px;">申请采购单</h4>
                    <p style="padding:0 30px; line-height:24px;">
                        园区采购申请单
                    </p>
                </router-link>
            </li>            <li>            
                <router-link to="router_main_Production_Management_System">
                    <img src="/lib/img/public/cropmode/z8.png" style="margin-top:30px;" />
                    <h4 style="line-height:60px;">采购订单</h4>
                    <p style="padding:0 30px; line-height:24px;">
                        园区采购订单
                    </p>
                </router-link>
            </li>            <li>            
                <router-link to="router_main_Production_Management_System">
                    <img src="/lib/img/public/cropmode/z8.png" style="margin-top:30px;" />
                    <h4 style="line-height:60px;">采购退料单</h4>
                    <p style="padding:0 30px; line-height:24px;">
                        园区采购退料单管理
                    </p>
                </router-link>
            </li>            <li>            
                <router-link to="router_main_Production_Management_System">
                    <img src="/lib/img/public/cropmode/z8.png" style="margin-top:30px;" />
                    <h4 style="line-height:60px;">采购入库单</h4>
                    <p style="padding:0 30px; line-height:24px;">
                        园区采购入库单管理
                    </p>
                </router-link>
            </li>            <li>            
                <router-link to="router_main_Production_Management_System">
                    <img src="/lib/img/public/cropmode/z8.png" style="margin-top:30px;" />
                    <h4 style="line-height:60px;">供应商管理</h4>
                    <p style="padding:0 30px; line-height:24px;">
                        园区供应商管理
                    </p>
                </router-link>
            </li>            <li>            
                <router-link to="router_main_Production_Management_System">
                    <img src="/lib/img/public/cropmode/z8.png" style="margin-top:30px;" />
                    <h4 style="line-height:60px;">采购报表</h4>
                    <p style="padding:0 30px; line-height:24px;">
                        园区采购报表
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
