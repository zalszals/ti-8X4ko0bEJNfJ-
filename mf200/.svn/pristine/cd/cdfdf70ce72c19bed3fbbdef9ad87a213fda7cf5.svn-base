<template>
  <div id="left-box" >
    <div style=" width: 100%; height: 100%;">

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;">工单管理&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;工单核查</span>&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;核查详情</span>
            
           <div class="h4span-rh">
               <span @click="$router.back(-1)" class="rightspana" style="background-color:#b0c777;">返 回</span>
           </div>
        </h4>
        </div>
        
        <Div style="width:100%; height:auto; margin-top:20px;">

            <p style="width:100%; height:60px;">
                <label style="display:block;">工序名称</label>
                <input class="form-control" v-bind:value="data.skill_name" style="display:inline-block; width:160px;" />
            </p>

            <p style="width:100%; height:60px; margin-top:20px;">
                <ul class="pulli">
                    <li>
                        <label style="display:block;">工作量</label>
                        <input class="form-control" v-bind:value="data.num" style="display:inline-block; width:160px;" />
                    </li>
                    <li>
                        <label style="display:block;">单位</label>
                        <input class="form-control" v-bind:value="data.unit" style="display:inline-block; width:160px;" />    
                    </li>
                    <li>
                        <label style="display:block;">实际完成量</label>
                        <input id="real" class="form-control" style="display:inline-block; width:160px;" placeholder="请输入实际完成量" onkeyup="value=value.replace(/[^\d]/g,'')"/>    
                    </li>
                    <li>
                        <label style="display:block;">评分</label>
                        <input id="score" class="form-control" placeholder="请输入评分" style="display:inline-block; width:160px;" /> <label style="display：inline-block" onkeyup="value=value.replace(/[^\d]/g,'')">分</label>    
                    </li>
                </ul>
            </p>

            <p style="width:100%; height:120px; margin-top:20px;">
                <label style="display:block;">备注</label>
                <textarea id="beizhu" class="form-control" placeholder="请输入备注"  rows="4" style="display:inline-block;"></textarea>
            </p>

            <p style="width:100%; height:220px; margin-top:20px; display:block;">
                <label style="display:block;">工作成果照片</label>
                <input id="file" type="file" value="上传图片" @change="change()" accept="image/png, image/jpeg, image/gif, image/jpg"/>
                <ul class="ptuulli">
                    <li v-on:click="tudel()">
                        <img id="show" src=""/>
                        <Span class="ptuullispan hide" id="guanbi" @click.stop="dodel()"> <font> X </font></Span>
                    </li>
                </ul>
            </p>

            <p style="width:100%; height:60px; text-align:center; margin-top:20px; display:block;">
                <span class="pspan" v-on:click="doadd(data.gd_id)">确认核查</span>
            </p>
        </Div>

    </div>

  </div>
</template>
<style scoped>

.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-rh{ float: right; display: inline; }
.rightspana{float: right; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px; }
.pulli li{ float: left; display: inline; margin-right: 16px;}

.ptuulli li{ display: inline-block; margin-right:16px; margin-top:12px; position: relative; }
.pspan{ width:90px; height: 40px; display: block; border-radius:5px; margin: 0 auto; text-align: center; line-height: 40px; color:#fff; background-color:#f2a553; }

.ptuullispan{ color: #000; position: absolute; right: 8px; top: 5px; }
</style>
<script>
export default {
    data() {
        return {
            data:[]
        }
    },
    mounted:function(){
        var gd_id = this.$route.query.gd_id;
        this.edit(gd_id);
    },
    methods:{
      tudel(){
        $("#guanbi").removeClass("hide"); 
      },
      dodel(){

          //删除本张图片
          $('#file').val('');
          $('#show').removeAttr("src");
          $('#guanbi').addClass('hide');
          $('#show').width(0);
          $('#show').height(0);
          
      },
      doadd(gd_id){
        var val = layer.confirm(
        "请确认核查内容真实有效，已经确认不可修改！",
        {
          btn: ["确定", "取消"] //按钮
        },function() {  
            var sendData = {};
            var jsonData = {};
            sendData.url = "/index.php/pc/WorkerOrder/gd_check";
            jsonData.real_num = $('#real').val();
            jsonData.score = $('#score').val();
            jsonData.beizhu = $('#beizhu').val();
            if($('#file').val().length > 0){
                jsonData.photo = $('#show')[0].src;
            }else{
                jsonData.photo = '';
            }
            jsonData.gd_id = gd_id;
            sendData.data = jsonData;
            var re = getFaceInfo(sendData);
            if(re.status == 1){
               	layer.msg(re.msg,{time: 1500},function(){
					window.location.href = '#/worker/workerorder/order_list';
				});
            }else{
                layer.msg(re.msg); 
            }
        },
        function(){
            layer.close(val);
        }
      )},
      edit(gd_id){
        var sendData = {};
        var jsonData = {};
        sendData.url = "/index.php/pc/WorkerOrder/edit";
        jsonData.gd_id = gd_id;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        if(re.status == 1){
            this.data = re.data;
        }else{
            layer.msg(re.msg); 
        }
      },
      change(){
          if($('#file').val().length > 0){
            var reads = new FileReader();
            var f = document.getElementById('file').files[0];
            reads.readAsDataURL(f);
            reads.onload = function (e) {
                document.getElementById('show').src = this.result;
                $('#show').width(240);
                $('#show').height(160);
            };
          }else{
                $('#file').val('');
                $('#show').removeAttr("src");
                $('#guanbi').addClass('hide');
                $('#show').width(0);
                $('#show').height(0);
          }
      }
    }
}
</script>
