<template>
  <div id="left-box" >
    <div style=" width: 100%; height: 100%;">

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;">工人管理
            
           <div class="h4span-rh">
               <select class="form-control" style="display:inline-block; width:100px;">
                   <option>总评分</option>
               </select>

               <select class="form-control" style="display:inline-block;width:180px; margin-left:10px;">
                   <option>综合成绩从高到低</option>
               </select>

               <span class="rightspana" >筛选</span>
           </div>
        </h4>
        </div>

        <div class="gmain">
            <ul>
                <li>
                    <img src="/lib/img/public/cropmode/rentu.jpg" />
                    <div class="liimgdiv">
                        <p>张三</p>
                        <p>职位:工人</p>
                        <p>所属上级：王五 组长</p>
                        <p>综合成绩：95分</p>
                    </div>
                </li>

                <li>
                    <img src="/lib/img/public/cropmode/rentu.jpg" />
                    <div class="liimgdiv">
                        <p>张三</p>
                        <p>职位:工人</p>
                        <p>所属上级：王五 组长</p>
                        <p>综合成绩：95分</p>
                    </div>
                </li>

                <li>
                    <img src="/lib/img/public/cropmode/rentu.jpg" />
                    <div class="liimgdiv">
                        <p>张三</p>
                        <p>职位:工人</p>
                        <p>所属上级：王五 组长</p>
                        <p>综合成绩：95分</p>
                    </div>
                </li>

                <li>
                    <img src="/lib/img/public/cropmode/rentu.jpg" />
                    <div class="liimgdiv">
                        <p>张三</p>
                        <p>职位:工人</p>
                        <p>所属上级：王五 组长</p>
                        <p>综合成绩：95分</p>
                    </div>
                </li>

                <li>
                    <img src="/lib/img/public/cropmode/rentu.jpg" />
                    <div class="liimgdiv">
                        <p>张三</p>
                        <p>职位:工人</p>
                        <p>所属上级：王五 组长</p>
                        <p>综合成绩：95分</p>
                    </div>
                </li>

                <li>
                    <img src="/lib/img/public/cropmode/rentu.jpg" />
                    <div class="liimgdiv">
                        <p>张三</p>
                        <p>职位:工人</p>
                        <p>所属上级：王五 组长</p>
                        <p>综合成绩：95分</p>
                    </div>
                </li>


            </ul>
        </div>
    </div>
  </div>
</template>
<style scoped>

.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-rh{ float: right; display: inline; }
.rightspana{float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px; }

.gmain{ width:90%; margin: 0 auto; height: auto;  }
.gmain li{width: 390px; height: 210px; margin-right:36px ; margin-top: 30px;  border-radius:10px;display: flex; float: left;  box-shadow: 0px 0px 2px #888888; background-color: #fff;}

.gmain li img{width: 120px; height: 150px; margin-top:30px; margin-left: 30px; }
.liimgdiv{ width:190px; height: 150px; margin-top:30px;margin-left: 20px; }
.liimgdiv p{ line-height: 36px; }

</style>
<script>
export default {
  
}
</script>
