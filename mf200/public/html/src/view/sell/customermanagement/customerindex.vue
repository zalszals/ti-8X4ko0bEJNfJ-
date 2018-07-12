<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;" class="tit"><font style="display:inline-block; margin-top:20px;">客户管理</font>

            <span class="h4span-r"><router-link to="/router_main_Sell_System/sell/customeradd">添加</router-link></span>
            <span class="h4span-r" style="background-color:#b0c777;" @click="getlists()">搜 索</span>
            
            <span class="h4span-ra">
                <input class="selclass" id="contact_phone" placeholder="请输入联系电话" type="text">
            </span>

            <span class="h4span-ra">
                <input class="selclass" id="contact_person" placeholder="请输入联系人" type="text">
            </span>
            <span class="h4span-ra">
                <input class="selclass" id="company_name" placeholder="请输入公司名称" type="text">
            </span>
           
        </h4>
        </div>
        
        <div class="checklist-centerb">
            <ul>
                <li v-for="item in lists">
                    <p style="margin-top:40px;">公司名称：{{item.company_name}}</p>
                    <p>开户银行：{{item.bank_name}}</p>
                    <p>银行账号：{{item.bank_no}}</p>
                    <p>纳税人识别码：{{item.register}}</p>
                    <p>注册电话：{{item.register_phone}}</p>
                    <p>注册地址：{{item.register_address}}</p>
                    <p>联系人：{{item.contact_person}}</p>
                    <p>常用联系电话：{{item.contact_phone}}</p>
                    <p>收货地址：{{item.address}}</p>                     
                    <button @click="ask_del(item.customer_id)" class="button or">删除</button>
                </li> 
            </ul>            
        </div>
		
		<div id="page_new" class="paing">
			<ul class="pages" v-if="pages > 1">
				<li @click="getlists(truepage-1)">上一页</li> 
				<template  v-for="(item,index) in pages" >
				<!-- <li v-if="item==3">...</li> -->
				<li  @click="getlists(item)" :key="index"  :class="item>truepage+5?'ovvvv':''" v-if="item>=truepage-5">{{item}}</li>
				</template>
				<li>...</li>
				<li @click="getlists(truepage+1)">下一页</li>
				
			</ul>
		</div>

    </div>
</div>
</template>

<script>
	export default {
		data() {
			return {

				lists: [],
				pages: [],
				get_materiel_cat: [],
				truepage:1,
				page: '',
			};
		},
		mounted: function() {
			this.getlists(this.truepage)
		},

		methods: {

			getlists: function(page) {
				this.truepage = page;
				var company_name = $("#company_name").val();
				var contact_phone = $("#contact_phone").val();
				var contact_person = $("#contact_person").val();

				var sendData = {
					url: "index.php/sell/Sell/pc_list_customer",
					data: {


						page: page,
						contact_person: contact_person,
						contact_phone: contact_phone,
						company_name: company_name,
						pc_form: 2
					}
				};
				var re = getFaceInfo(sendData);
				this.lists = re.data.list;

				this.pages = re.data.pages;
				this.page = re.data.page;
			},
			ask_del: function(customer_id){
				var vueObj = this;
				//询问框
				layer.confirm('确定要删除吗？', {btn: ['确定','取消']}, function(){
					vueObj.delete_customer(customer_id);
				});	
			},
			delete_customer: function(customer_id) {



				var sendData = {
					url: "index.php/sell/Sell/delete_customer",
					data: {


						customer_id: customer_id,

					}
				};
				var re = getFaceInfo(sendData);
				if (re.status == 1) {
					// location.href =location.href;
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				} else {
					layer.msg(re.msg, {
						time: 2000
					}, function() {
						window.location.reload();
					});
				}
			},

		}
	}

</script>

<style lang="less" scoped>
	.button {
		margin-left: 35px;
	}

	.newdivtop {
		width: 100%;
		height: 70px;
		border-bottom: 1px solid #d0dadc;
	}

	.h4spana {
		font-weight: normal;
		font-size: 15px;
		line-height: 16px;
	}

	.h4span-r {
		float: right;
		margin-top: 10px;
		display: inline;
		color: #fff;
		background-color: #f2a553;
		font-size: 16px;
		font-weight: normal;
		padding: 9px 23px;
		border-radius: 3px;
		margin-left: 20px;
	}

	.h4span-ra {
		float: right;
		margin-top: 10px;
		display: inline;
		color: #fff;
		font-size: 16px;
		font-weight: normal;
		border-radius: 3px;
		margin-left: 16px;
	}

	.selclass {
		height: 36px;
		border-radius: 3px;
		border: 1px solid #d0dadc;
		color: #aaa;
		width: 160px;
		padding: 0px 10px;
	}

	.checklist-centerb {
		width: 100%;
		height: auto;
		overflow: hidden;
	}
	
	.checklist-centerb li {
		width: 410px;
		height: 426px;
		float: left;
		display: inline;
		background-color: #fff;
		border-radius: 5px;
		margin-left: 32px;
		margin-top: 30px;
		border: 1px solid #e8e8e8;
		box-shadow: 0 0 10px #eee;
	}

	.checklist-centerb li h4 {
		margin: 40px 40px 30px 40px;
		font-weight: bold;
		color: #333;
	}

	.checklist-centerb li p {
		margin-bottom: 14px;
		color: #333;
		font-size: 16px;
		margin-left: 40px;
	}

	.divpspana {
		width: 108px;
		height: 34px;
		border-radius: 3px;
		background-color: #b0c777;
		float: left;
		display: inline;
		color: #fff;
		margin-right: 20px;
		line-height: 34px;
		text-align: center;
	}

</style>
