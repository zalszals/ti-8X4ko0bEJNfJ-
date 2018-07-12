<style scoped>
	body {
		font-family: "Microsoft YaHei";
	}

	input {
		background-color: #fff;
	}

	.demo-carousel {
		height: 200px;
		line-height: 200px;
		text-align: center;
	}

	.header {
		text-align: center;
		padding: 20px 0 10px;
		color: #fff;
		background: -webkit-linear-gradient(45deg, #5c9260, #79a468);
		background: -o-linear-gradient(45deg, #5c9260, #79a468);
		background: -moz-linear-gradient(45deg, #5c9260, #79a468);
		background: linear-gradient(45deg, #5c9260, #79a468);
		font-size: 20px;
		position: fixed;
		width: 100%;
		top: 0;
		z-index: 99;
		box-shadow: 2px 0px 5px #777;
	}

	.icon-mobile {
		position: absolute;
		right: 8px;
		padding: 5px 10px;
		font-size: 14px;
	}

	.form-group {
		width: 100%;
		text-align: center;
		margin-bottom: 20px;
		border-radius: 4px;
		color: #888;
	}

	.startend {
		text-align: center;
	}

	.startinput {
		width: 35%;
		height: 40px;
		display: inline-block;
		text-indent: 0.5em;
	}

	.henginput {
		width: 20%;
		height: 20px;
		display: inline-block;
	}

	.endinput {
		width: 35%;
		height: 40px;
		display: inline-block;
		text-indent: 0.5em;
	}

	.bottomshai {
		position: fixed;
		text-indent: 1em;
		bottom: 0px;
		height: 50px;
		width: 100%;
		border-top: 1px solid #ccc;
	}

	.bottodivtwoshai {
		background-color: #fff;
		height: 50px;
		text-align: center;
	}

	.bottodivtwoleftshai {
		float: left;
		background-color: #fff;
		display: inline;
		border-right: 1px solid #ccc;
		width: 49%;
		height: 50px;
		line-height: 50px;
	}

	.bottodivtworightshai {
		float: left;
		background-color: #fff;
		display: inline;
		width: 50%;
		height: 50px;
		line-height: 50px;
	}

	.tubiaopa {
		background: url(/lib/img/public/cropmode/tupiana.png) 16px center no-repeat;
	}

	.bottodivtwoleft a {
		color: #434343;
		text-decoration: none;
	}

	.bottodivtwoleft a:visited {
		color: #434343;
		text-decoration: none;
	}

	.bottodivtwoleft a:hover {
		color: #434343;
		text-decoration: none;
	}

	.bottodivtworight a {
		color: #434343;
		text-decoration: none;
	}

	.bottodivtworight a:visited {
		color: #434343;
		text-decoration: none;
	}

	.bottodivtworight a:hover {
		color: #434343;
		text-decoration: none;
	}

</style>

<template>
	<div style="width:100%; height:100%">
		
	  <div class="header" style="font-size:17px;"><span class="headerspana" onclick="window.history.go(-1)" style=" width:10%; position: absolute; left: 3%; background: url(/lib/img/public/cropmode/leftjiantou.png) 16px center no-repeat;">&nbsp;</span>筛选</div>

      <div style="height:70px; width:100%;"></div>
      <div style=" width:100%; height:100%;">

          <form>

            <div class="form-group">
              <select name="" id="" style=" width:90%; margin:0 auto; height:40px; border-radius:5px; line-height:40px; text-indent:1em; border:1px solid #bbb; color:#aaa">
                  <option value="">请选择工人姓名</option>
              </select>
            </div>

            <div class="form-group">
              <select name="" id="" style=" width:90%; margin:0 auto; height:40px; border-radius:5px; line-height:40px; text-indent:1em; border:1px solid #bbb; color:#aaa">
                  <option value="">请选择工序</option>
              </select>
            </div>

            <div class="form-group" >

                <div style=" width:95%; height:40px; line-height:40px; text-indent:1em;">
                  <input name="" id="" value="开始时间" class="startinput"  style="border-radius:5px; border:1px solid #bbb; color:#aaa " /><label class="henginput" >----</label>
                  <input name="" id="" value="结束时间" class="endinput" style="border-radius:5px; border:1px solid #bbb; color:#aaa" />
                </div>

            </div>
            
            <div class="form-group" >
              <select name="" id="" style=" width:90%; margin:0 auto; height:40px; border-radius:5px; line-height:40px; text-indent:1em; border:1px solid #bbb; color:#aaa">
                  <option value="">全部结算历史</option>
              </select>
            </div>

          </form>
        
      </div>

     <div class="bottomshai">

         <div class="bottodivtwoshai">
             <span class="bottodivtwoleftshai">取消</span>
             <span class="bottodivtworightshai">确定</span>
         </div>

     </div>

	</div>
</template>

<script>
	export default {

		data() {
			return {
				shuju: [],
			}
		},

		mounted: function() {

		},

		methods: {

		},

	}

</script>
