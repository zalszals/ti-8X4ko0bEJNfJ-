<template>
  <div id="left-box" class="">
    <div class="newula">
        <ul> 
          <li>
            <a href="#/wuliao/apply">
                <img src="/lib/img/public/cropmode/zz1.jpg" style="margin-top:30px;" />
                <h4 style="line-height:60px;">申请物料</h4>
                <p style="padding:0 30px; line-height:24px;">
                    可根据实际情况填写信息量完成发布领料的需求，完成生产领料。
                </p>
            </a>
          </li>

          <li>
            <a href="#/wuliao/lingliaodan/dailingliao">
                <img src="/lib/img/public/cropmode/zz1.jpg" style="margin-top:30px;" />
                <h4 style="line-height:60px;">领料单</h4>
                <p style="padding:0 30px; line-height:24px;">
                    可查看待领料以及已领料的领料单列表，也可以查看某个领料单的具体内容。
                </p>
            </a>
          </li>

          <li>
            <a href="#/wuliao/retreating/list">
                <img src="/lib/img/public/cropmode/zz2.jpg" style="margin-top:30px;" />
                <h4 style="line-height:60px;">生产退料</h4>
                <p style="padding:0 30px; line-height:24px;">
                   可查看所有的生产退料，也可以查看某个生产退料单的详细内容。
                </p>
            </a>
          </li>

          <li>
            <a href="#/wuliao/record">
                <img src="/lib/img/public/cropmode/zz3.jpg" style="margin-top:30px;" />
                <h4 style="line-height:60px;">记录能耗</h4>
                <p style="padding:0 30px; line-height:24px;">
                    可记录下生产过程中所需的能源消耗的具体内容，包括使用数量以及单价等明细。
                </p>
            </a>
          </li>     

        </ul> 
    </div>

  </div>


</template>
<style>
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
