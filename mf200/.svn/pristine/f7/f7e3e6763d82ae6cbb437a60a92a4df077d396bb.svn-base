<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">物料管理&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;领料单</span>&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;详情</span></font>

            <span class="h4span-r" style="background-color:#b0c777;" @click="$router.back(-1)">返 回</span>
           
        </h4>
        </div>
        
        <div class="lcenter">
            <div style="width:100%; height:auto;">
                <h4 style="color:#f2a553; margin-top:20px; font-weight:bold; line-height:40px;">{{t_name}}<span class="dh4span" style="margin-left:20px;" v-on:click="dodel()">删除</span></h4>
                <p>种植区域： {{area_name}}</p>
                <p>发布人： {{add_name}}</p>
                <p>领料人： {{use_name}}</p>
                <p>发布时间： {{add_time}}</p>
                <div class="ptextd" v-for="dlist in details">
                    <span class="xuanze"><input type="checkbox" name="box" id="checkbox_1" v-bind:value="dlist.tbd_id" /></span>
                    <p><span class="ptextspan">类别： {{dlist.cat_name}}</span> <span>规格： {{dlist.m_desc}}</span></p>
                    <p><span class="ptextspan">物料名称： {{dlist.m_name}}</span> <span>领取数量： {{dlist.num}} {{dlist.unit}}</span></p>
                </div>
            </div>
        </div>

    </div>
</div>
</template>

<script>
export default {
  data(){ 
      return {
        nid:'',
        t_name:'',
        area_name:'',
        add_name:'',
        use_name:'',
        add_time:'',
        details:[],
        
      }
  },
  mounted:function(){

      this.nid=this.$route.query.id;
      this.t_name=this.$route.query.tname;
      this.area_name=this.$route.query.areaname;
      this.add_name=this.$route.query.addname;
      this.use_name=this.$route.query.usename;
      this.add_time=this.$route.query.addtime;
      
      this.getdetails();

  },
  methods:{
    
   

    getdetails:function(){//待领料页面使用 status=1
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/TakeBack/takeback_detail";
        jsonData.tb_id=this.nid;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.details=re.data;
        //console.log(this.lingliao);
    },

    // //待领料
    // dodai(){
    //     var boxName = document.getElementsByName("box");   
    //         var arr=[];
    //         for(var i = 0; i < boxName.length; i++)   
    //         {   
    //             if(boxName[i].checked == true)   
    //             {   
    //                 arr.push(boxName[i].value);   
    //             }   
    //         }   
            
    //         var str=arr.join(',') 
    //         //console.log(str); 
    //         console.log(this.nid);
    //         var sendData = {};
    //         var jsonData = {};
    //         sendData.url="index.php/product/TakeBack/tb_ok_one";
    //         jsonData.tb_id=this.nid;
    //         jsonData.tbd_id=str; // 字符串
    //         sendData.data = jsonData;
    //         var re = getFaceInfo(sendData);
    //         if(re.status==1){
    //             layer.msg(re.msg,{time:2000},function(){
    //                 window.location.reload();
    //             });
    //         }else{
    //             layer.msg(re.msg);
    //         }
    // },


    //删除 
    dodel(){
        
        var that=this;
        layer.confirm(
        "您确定要删除这条数据吗？",
        {
          btn: ["确定", "取消"] //按钮
        },function() {

            var boxName = document.getElementsByName("box");   
            var arr=[];
            for(var i = 0; i < boxName.length; i++)   
            {   
                if(boxName[i].checked == true)   
                {   
                    arr.push(boxName[i].value);   
                }   
            }
            if(arr.length == 0){
                layer.msg('请先勾选物料');return;
            }   
            
            var str=arr.join(',') 
            //console.log(str); 
            
            var sendData = {};
            var jsonData = {};
            sendData.url="index.php/product/TakeBack/tb_del";
            jsonData.tb_id=that.nid;
            jsonData.tbd_id=str; // 字符串
            sendData.data = jsonData;
            var re = getFaceInfo(sendData);
            if(re.status==1){
                layer.msg(re.msg,{time:2000},function(){
                    window.location.reload();
                });
            }else{
                layer.msg(re.msg);
            }

        })
    },

    
  },
      

  
}
</script>

<style lang="less" scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top: 10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }

.lcenter{ width: 100%; height: auto; padding-left:30px;  }
.lcenter p{ line-height: 40px; color: #333; font-size:16px;}
.dh4span{ float: right; padding:0px;width: 90px; border-radius:3px; text-align: center; height: 30px; margin-top: 10px; line-height: 30px;  font-size: 14px; background-color:#f2a553; color:#fff;}
.ptextd{width: 510px; height: 126px; position: relative; margin-top:20px; background-color: #fff; border-radius:5px; box-shadow: 0px 0px 6px #e3e3e3; border:1px solid #eee; padding-left: 30px; padding-top: 30px; }
.ptextd p{ font-size:16px; line-height: 34px;}
.ptextd p span{ display: inline-block; }
.ptextspan{ width:300px;}
.xuanze{ position: absolute; right: 20px; top: 8px; }
</style>
