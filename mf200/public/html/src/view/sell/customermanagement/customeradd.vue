<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">客户管理&nbsp;&nbsp;<span class="h4spana">|&nbsp;&nbsp;添加</span></font>

            
            <span class="h4span-r" style="background-color:#b0c777;">返 回</span>
            <span class="h4span-r" @click="addInfo()">添 加</span>
        </h4>
        </div>
        
        <div class="checklist-centerc">
            <p>
                <span>公司名称</span> <input id="company_name" class="form-control" style="display:inline-block; margin-left:10px; width:200px; text-indent:0.5em;" type="text" placeholder="请选择公司名称">
            </p>
            <p>
                <span>开户银行</span> <input id="bank_name"  class="form-control" style="display:inline-block; margin-left:10px; width:200px; text-indent:0.5em;" type="text" placeholder="请输入开户银行">
            </p>
            <p>
                <span>银行账号</span> <input id="bank_no"  class="form-control" style="display:inline-block; margin-left:10px; width:200px; text-indent:0.5em;" type="text" placeholder="请输入银行账号">
            </p>
            <p>
                <span>纳税人识别码</span> <input id="register_no"  class="form-control" style="display:inline-block; margin-left:10px; width:200px; text-indent:0.5em;" type="text" placeholder="请输入识别码">
            </p>
            <p>
                <span>注册电话</span> <input id="register_phone"  class="form-control" style="display:inline-block; margin-left:10px; width:200px; text-indent:0.5em;" type="text" placeholder="请输入注册电话">
            </p>
            <p>
                <span>注册地址</span> <input id="register_address"  class="form-control" style="display:inline-block; margin-left:10px; width:300px; text-indent:0.5em;" type="text" placeholder="请输入注册地址">
            </p>
            <p>
                <span>联系人</span> <input id="contact_person"  class="form-control" style="display:inline-block; margin-left:10px; width:200px; text-indent:0.5em;" placeholder="请输入联系人">
            </p>
            <p>
                <span>联系方式</span> <input id="contact_phone"  class="form-control" style="display:inline-block; margin-left:10px; width:200px; text-indent:0.5em;" placeholder="请输入联系方式">
            </p>
            <p>
                <span>收货地址</span> <input id="address"  class="form-control" style="display:inline-block; margin-left:10px; width:300px; text-indent:0.5em;" type="text" placeholder="请输入收货地址">
            </p>
           
        </div>
    </div>
</div>
</template>
<script>
	export default {
		data() {
			return {

			};
		},
		mounted: function() {

		},

		methods: {

			addInfo: function() {
				var company_name = $('#company_name').val();
				var bank_name = $('#bank_name').val();
				var bank_no = $('#bank_no').val();
				var register_no = $('#register_no').val();
				var register_phone = $('#register_phone').val();
				var register_address = $('#register_address').val();
				var contact_person = $('#contact_person').val();
				var contact_phone = $('#contact_phone').val();
				var address = $('#address').val();

				if (company_name == '') {
					layer.msg('请输入公司名称');
					return false;
				}
				if (bank_name == '') {
					layer.msg('请输入开户银行');
					return false;
				}

				if (bank_no == '') {
					layer.msg('请输入银行卡号');
					return false;
				}

				if (register_no == '') {
					layer.msg('请输入纳税人识别码');
					return false;
				}

				if (register_phone == '') {
					layer.msg('请输入注册电话');
					return false;
				}

				if (register_address == '') {
					layer.msg('请输入注册地址');
					return false;
				}

				if (contact_person == '') {
					layer.msg('请输入联系人');
					return false;
				}
				if (contact_phone == '') {
					layer.msg('请输入联系人电话');
					return false;
				}
				if (address == '') {
					layer.msg('请输入公司地址');
					return false;
				}

				var sendData = {
					url: "index.php/sell/Sell/add_customer",
					data: {
						company_name: company_name,
						bank_name: bank_name,
						bank_no: bank_no,
						register_no: register_no,
						register_phone: register_phone,
						register_address: register_address,
						contact_person: contact_person,
						contact_phone: contact_phone,
						address: address,
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
			}
		}
	}

</script>

<style lang="less" scoped>
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

	.checklist-centerc {
		width: 70%;
		height: auto;
	}

	.checklist-centerc p {
		margin-top: 40px;
	}

	.checklist-centerc p span {
		width: 130px;
		text-align: right;
		font-size: 16px;
		color: #666;
		line-height: 38px;
		display: inline-block;
	}
</style>
