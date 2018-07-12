<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">库存盘点&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;本期库存盘点</span></font>

            <span onclick="go_back()" class="h4span-r" style="background-color:#b0c777; color:#fff;">返 回</span>
            <span class="h4span-r" @click="UrlHref()">添 加</span>
            <span class="h4span-ra">
                <select class="form-control" id="ck" @change="changeList()">
					<option value="0">请选择仓库</option>
                    <option  v-for="item in ck_list"v-bind:ckname="item.ck_name" v-bind:value="item.ck_id">{{item.ck_name}}</option>
                </select>
            </span>
           
        </h4>
        </div>
        <p style=" height:20px;"></p>
        <h4 style="line-height:40px; color:#f2a553">编号：{{this.no}}
		<span style="padding:0px 20px; background-color:#f2a553; color:#fff; float:right; border-radius:5px;" @click="AddKeep()">保存本期盘点</span>
		</h4>  
        <p style=" height:30px;"></p>
        <div style="width:100%;">
            <table class="table table-striped" style="border-bottom:1px solid #ddd">
				<thead>
					<tr>
					<th>盘点日期</th>
					<th>类别</th>
					<th>物料名称</th>
					<th>规格</th>
					<th>单位</th>
					<th>库存数量</th>
					<!--<th>上传图片</th>-->
					<th>盘点数量</th>
					<th>差值</th>
					</tr>
				</thead>

				<tbody>
                    <tr class="trclass" v-for="item in get_materiel_cat">
                        <td>{{item.add_time }}</td>
                        <td>{{item.cat_name}}</td>
                        <td>{{item.m_name}}</td>
                        <td>{{item.m_desc}}</td>
                        <td>{{item.unit}}</td>
                        <td>{{item.ck_num}}</td>
                        <td>{{item.inventory_num}}</td>
                        <td>{{item.diff_num}}</td>
                    </tr>
 
				</tbody>

			</table>
        </div>
       


       

    </div>
</div>
</template>
<script>
	export default {
		data() {
			return {

			no:'',
			pages: [],
            get_materiel_cat:[],
			ck_list:[],
            page:'',
			};
		},
		mounted:function(){
			this.getck()
		 
	 	},

		methods:{
			getck:function(){
				var sendData = {
					url: "index.php/finance/Library/ck_list",
					data: {
					
					}
				};
				var re = getFaceInfo(sendData);
				this.ck_list = re.data;
				
			},
			changeList:function(){
				var ck_id = $("#ck option:selected").attr("value");
				if(ck_id=='0'){
					alert('请选择仓库');
					return false;
				}
	 
				var sendData = {
					url: "index.php/finance/Library/library_list",
					data: {
						ck_id:ck_id
					}
				};
				var re = getFaceInfo(sendData);
				this.no = re.no;
		 
				this.get_materiel_cat = re.data;
		 
   			},
			UrlHref:function(){
				var ck = $("#ck option:selected").attr("value");
				var ckname = $("#ck option:selected").attr("ckname");
				if(ck=='0'){
					alert('请选择仓库');
					return false;
				}
				this.$router.push({path: '/router_main_Finance_System/sell/thisstockingadd', query: { ck:ck ,ckname:ckname,no:this.no}});
			},
			AddKeep:function(){
				var ck_id = $("#ck option:selected").attr("value");
				if(ck_id=='0'){
					alert('请选择仓库');
					return false;
				}
				
				var info = this.get_materiel_cat;
				if(info==''){
					alert('本次盘点无数据');
					return false;
				}
				var no = this.no;
				var sendData = {
					url: "index.php/finance/Library/pc_library_keep",
					data: {
						ck_id:ck_id,
						no:no
						
					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
						// location.href =location.href;
						layer.msg(re.msg, { time: 2000 }, function(){
                          window.location.reload();
                 });
				} else {
						layer.msg(re.msg, { time: 2000 }, function(){
                         window.location.reload();
                         });
				}
				
			}

		}
	}

</script>

<style lang="less" scoped>
.newdivtop{ width: 100%; height: 70px; border-bottom: 1px solid #d0dadc;}
.h4spana{ font-weight: normal; font-size:15px; line-height: 16px;}
.h4span-r{ float: right; margin-top: 10px; display: inline; color:#fff; background-color:#f2a553; font-size: 16px; font-weight: normal; padding:9px 23px; border-radius:3px; margin-left: 20px;  }
.h4span-ra{ float: right; margin-top: 10px; display: inline; color:#fff; font-size: 16px; font-weight: normal; border-radius:3px; margin-left: 16px;  }
.selclass{ height: 36px; border-radius:3px; border: 1px solid #d0dadc; color: #aaa; width: 160px; padding: 0px 10px;}
table tr{ background-color: #fff;}
table tr th{ padding: 5px 20px; line-height: 36px;}
table tr td{ padding: 5px 20px; line-height: 40px;}

</style>
