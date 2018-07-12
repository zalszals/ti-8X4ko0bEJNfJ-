<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">物料管理&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;生产退料</span>&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;详情</span></font>

            <span class="h4span-r" style="background-color:#b0c777;" @click="$router.back(-1)">返 回</span>
           
        </h4>
        </div>
        
        <div class="lcenter">
            <div style="width:100%; height:auto;">
                <h4 style="color:#f2a553; margin-top:20px; font-weight:bold; line-height:40px;">{{t_name}}</h4>
                <p>种植区域： {{area_name}}</p>
                <p>发布人： {{add_name}}</p>
                <p>领料人： {{use_name}}</p>
                <p>发布时间： {{add_time}}</p>
                <div v-for="dlist in detailsb">
                    
                    <div class="ptexta" v-on:click="doshow(dlist.tbd_id)">
                        <p><span class="ptextspan">类别： {{dlist.cat_name}}</span> <span class="ptextspan">规格： {{dlist.m_desc}}</span> <span>返还数量： {{dlist.b_num}} {{dlist.unit}}</span></p>
                        <p><span class="ptextspan">物料名称： {{dlist.m_name}}</span> <span class="ptextspan">领取数量： {{dlist.num}} {{dlist.unit}}</span> <span>领取时间： {{dlist.take_time}}</span></p>
                    </div>
                    
                </div>

                <div class="hide" id="kshow">
                <div class="ptextb">
                        <h4 style="font-weight:bold;">退料明细</h4>
                        <p v-for="mlist in mingxi"><span class="ptextspan" style="margin-top:10px;">申请时间： <font style="font-size:14px;">{{mlist.add_time}}</font></span> <span class="ptextspan">退换数量： {{mlist.num}} </span><span>入库状态： <font style="color:#f2a652" v-if="mlist.materiel_status==1 && mlist.materiel_check==1">已入库</font><font style="color:#f2a652" v-else-if="mlist.materiel_status==0 && mlist.materiel_check==0">未入库</font><font style="color:#f2a652" v-else-if="mlist.materiel_status==1 && mlist.materiel_check==0">审核通过</font><font style="color:#f2a652" v-else-if="mlist.materiel_status==2 && mlist.materiel_check==0">审核不通过</font></span></p>
                </div>
                </div>
            </div>
        </div>


       

    </div>
</div>
</template>

<script>
export default {
  data(){ 
      return{
        nid:'',
        t_name:'', 
        area_name:'', 
        add_name:'', 
        use_name:'', 
        add_time:'',
        detailsb:[],  
        ntrue:1,
        mingxi:[],   
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
    getdetails:function(){

        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/TakeBack/takeback_detail";
        jsonData.tb_id=this.nid;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.detailsb=re.data;
        //console.log(this.detailsb);
        
    },
    
    doshow(tbid){
        
        var sendData = {};
        var jsonData = {};
        sendData.url="index.php/product/TakeBack/tb_insert_info";
        jsonData.tbd_id=tbid;
        sendData.data = jsonData;
        var re = getFaceInfo(sendData);
        this.mingxi=re.data; 
        $("#kshow").removeClass("hide");
    },
    
  },
      

  
}
</script>

<style lang="less" scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top: 10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }

.lcenter{ width: 100%; height: auto; padding-left:30px;}
.lcenter p{ line-height: 40px; color: #333; font-size:16px;}
.dh4span{ float: right; padding:0px;width: 90px; border-radius:3px; text-align: center; height: 30px; margin-top: 10px; line-height: 30px;  font-size: 14px; background-color:#f2a553; color:#fff;}
.ptexta{width: 906px; height: 126px; margin-top:20px; background-color: #fff; border-radius:5px; box-shadow: 0px 0px 6px #e3e3e3; border:1px solid #eee; padding-left: 30px; padding-top: 30px; }
.ptexta p{ font-size:16px; line-height: 34px;}
.ptexta p span{ display: inline-block; }

.ptextb{width: 906px; margin-top:20px; background-color: #fff; border-radius:5px; box-shadow: 0px 0px 6px #e3e3e3; border:1px solid #eee; padding-left: 30px; padding-top: 30px; padding-bottom:20px}
.ptextb p{ font-size:16px; line-height: 34px;}
.ptextb p span{ display: inline-block; }

.ptextspan{ width:280px;}
</style>
