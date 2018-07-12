<template>
  <div id="left-box" class="">
    <div class="newula">
        <ul> 
          <li>
            <a href="/#/router_main_Finance_System/sell/thisstocking">
                <img src="/lib/img/public/cropmode/sell_a9.jpg" style="margin-top:30px;" />
                <h4 style="line-height:60px;">本期库存盘点</h4>
                <p style="padding:0 30px; line-height:24px;">
                    本期的所有库存信息盘点
                </p>
            </a>
          </li>

          <li>
            <a href="/#/router_main_Finance_System/sell/dvalue">
                <img src="/lib/img/public/cropmode/sell_a10.jpg" style="margin-top:30px;" />
                <h4 style="line-height:60px;">盘点差值列表</h4>
                <p style="padding:0 30px; line-height:24px;">
                    未处理及已处理的盘点差值列表
                </p>
            </a>
          </li>

          <li>
            <a href="/#/router_main_Finance_System/sell/historystocking">
                <img src="/lib/img/public/cropmode/sell_a11.jpg" style="margin-top:30px;" />
                <h4 style="line-height:60px;">历史库存盘点</h4>
                <p style="padding:0 30px; line-height:24px;">
                    历史的所有库存信息盘点
                </p>
            </a>
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
  


}
</script>
