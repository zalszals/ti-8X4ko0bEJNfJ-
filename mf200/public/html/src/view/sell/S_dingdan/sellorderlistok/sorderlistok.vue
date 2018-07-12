<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">销售订单&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;备货详情</span></font>

            <span class="h4span-r" style="background-color:#b0c777;">返 回</span>
            <span class="h4span-r">确认发货</span>
        </h4>
        </div>
        <p style="height:50px;"></p>
        <div  class="sell_center">
            <!--
            <h4 style="color:#f3a753; margin-bottom:20px;">订单信息 <span style="float:right; padding:5px 20px; border-radius:3px; color:#fff; font-size:15px; background-color:#f2a553;">待审核</span></h4>
            <p style="font-size:16px; line-height:30px;">模式一：<span>现有库存销售</span></p>
            <p style="font-size:16px; line-height:60px;">销售日期：<span>2018-01-01</span></p>
            -->
            <p style=" width:70%; margin-bottom:30px;">
                <table class="atable">
                    <tr>
                        <th>商品</th>
                        <th>数量（Kg）</th>
                        <th>备货数量</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>爱吉301</td>
                        <td>1000</td>
                        <td><input type="text" value="5" style="width:100px; text-indent:0.5em;" /></td>
                        <td><img src="/lib/img/public/cropmode/jianjian.png" /></td>
                    </tr>
                    <tr>
                        <td>爱吉301</td>
                        <td>1000</td>
                        <td><input type="text" value="5" style="width:100px; text-indent:0.5em;" /></td>
                        <td><img src="/lib/img/public/cropmode/jiajia.jpg" /></td>
                    </tr>

                </table>
            </p>

           
            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">包装要求</h4>
                    <label style="width:150px;  font-weight:normal;">10Kg/一箱，纸包</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">物流及其他要求</h4>
                    <label style="width:150px;  font-weight:normal;">10Kg/一箱，纸包</label>
                </span>
            </p>

            <p style="margin-bottom:20px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg">客户信息</h4>
                    <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">公司名称：</label>
                    <label style="width:150px; font-weight:normal;">江苏绿港</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">联系人：</label>
                    <label style="width:150px; font-weight:normal;">赵朴</label>
                </span>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <label style="width:80px; display:inline-block; font-size:15px; font-weight:normal;">公司地址：</label>
                    <label style="width:150px; font-weight:normal;">江苏绿港</label>
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:70px; display:inline-block; font-size:15px; font-weight:normal;">手机号：</label>
                    <label style="width:150px; font-weight:normal;">11111111111</label>
                </span>
            </p>

            <h4 class="rightzhg" style="margin-bottom:0px;">物流信息</h4>

            <p style="margin-bottom:30px; font-size:16px;">
                <select name="" id="" class="form-control" style="width:260px;">
                    <option>请选择物流方式</option>
                </select>
            </p>
            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg" style="margin-bottom:0px;">物流信息</h4>
                   
                    <p style="margin-bottom:30px; font-size:16px;">
                        <select name="" id="" class="form-control" style="width:260px;">
                            <option>请选择物流方式</option>
                        </select>
                    </p>
                </span>
                <span style="width:520px; display:inline-block;">
                    <h4 class="rightzhg" style="margin-bottom:0px;">物流信息</h4>
                    <p style="margin-bottom:30px; font-size:16px;">
                        <select name="" id="" class="form-control" style="width:260px;">
                            <option>快递运输</option>
                        </select>
                    </p>
                </span>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal;">快递公司：</label>
                    <input type="text" class="form-control" style="width:200px; display:inline-block;" value="请输入快递公司" />
                </span>
                <span style="width:520px; display:inline-block;">
                    <label style="width:80px;  display:inline-block; font-size:15px; font-weight:normal;">快递单号：</label>
                    <input type="text" class="form-control" style="width:200px; display:inline-block;" value="请输入快递单号" />
                </span>
            </p>

            <p style="margin-bottom:30px; font-size:16px;">
                <span style="width:520px; display:inline-block;">
                    <label style="width:120px; display:inline-block; font-size:15px; font-weight:normal;">预计送达时间：</label>
                    <input type="date" class="form-control" style="width:200px; display:inline-block;" value="请选择时间" />
                </span>
            </p>
            
			
        </div>


    </div>
</div>
</template>

<script>

</script>

<style lang="less" scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top: 10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.h4span-ra{ float: right; margin-top: 10px; display: inline; color:#fff; font-size: 16px; font-weight: normal; border-radius:3px; margin-left: 16px;  }
.selclass{ height: 36px; border-radius:3px; border: 1px solid #d0dadc; color: #aaa; width: 160px; padding: 0px 10px;}

.sell_center{ width: 90%; margin-left: 50px; height: auto;}
.sell_center ul li{ width: 100%; height: auto; }
.rightzhg{ line-height: 50px; color:#f3a753;}

table {
		width: 100%;
		border-collapse: collapse;
		margin: 0 auto;
		text-align: center;
	}

	.atable tr th {
		text-align: center;
        padding: 10px 30px;
        background-color: #fff;
        border-bottom: 1px solid #e2e2e2;
	}

	.atable tr td {
		text-align: center;
        padding: 10px 30px;
        background-color: #fff;
        border-bottom: 1px solid #eee;
	}

</style>
