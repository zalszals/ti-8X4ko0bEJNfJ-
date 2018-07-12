<template>
<div id="Application_Form_main_">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4>员工考勤&nbsp;|&nbsp;设置</h4>
			</div>
			<div class="case">
				<button>完成</button>
				<button>返回</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main__">
	<div>
		<ul id="ulone">
			<li id="lione" class="ws">
				<p>董事长</p>
			</li>
			<li class="ws"><p>董事长</p></li>
			<li class="ws"><p>董事长</p></li>
			<li class="ws"><p>董事长</p></li>
			<li class="ws"><p>董事长</p></li>
			<li class="ws"><p>董事长</p></li>
		</ul>
		<ul id="ultwo">
			<li id="litwo" class="ws">
				<p>出差单</p>
			</li>
			<li class="ws"><p>出差单</p></li>
			<li class="ws"><p>出差单</p></li>
			<li class="ws"><p>出差单</p></li>
			<li class="ws"><p>出差单</p></li>
			<li class="ws"><p>出差单</p></li>
		</ul>
		<ul id=""> 
			<li class="ws"><p>2018-05-01</p></li>
			<li class="ws"><p>2018-05-02</p></li>
			<li class="ws"><p>2018-05-03</p></li>
			<li class="ws"><p>2018-05-04</p></li>
			<li class="ws"><p>2018-05-05</p></li>
			<li class="ws"><p>2018-05-05</p></li>
		</ul>
	</div>
	</div>
</div>
</template>
<style scoped>
	* {

		margin: 0;
		padding: 0;
		font-family: "微软雅黑";
		font-weight: 500;
	}

	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: 20px;
		margin-bottom: 30px;
	}

	#Application_Form_main__ div {
		margin-left: 150px;
		/*		margin-top: 60px;*/
	}

	#Application_Form_Date_ {
		overflow: hidden;
	}
	li{
		text-align: center;
		border-bottom-style: solid;
        border-width: 1px;
        border-color: #EAEEF1;
	}
	input {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		padding: 5px;
		border-radius: 5px;
		margin-right: 10px;
		margin-top: 30px;
	}
	
	#Application_Form_Date_ button {
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 2px;
		padding-bottom: 2px;
		color: white;
		border: 0;
		border-radius: 5px;
		background-color: #F4A356;
	}

	ul {
		text-align: center;
		float: left;
	}

	ul li {
		/*		padding-top: 10px;*/
		/*		padding-bottom: 1px;*/
		padding-right: 50px;
		margin-bottom: 40px;
	}

	ul li p {
		padding-top: 10px;
/*		padding-bottom: 10px;*/
	}

	#lione {
		/*		background-color: black;*/
		/*		float: left;*/
	}

	#litwo {
		/*		background-color: black;*/
		/*		float: left;*/
	}

	#w_Warehouse {
		float: left;
		font-size: 15px;
		font-weight: bold !important;
		padding-top: 30px;
		margin-left: 30px;
	}

	select {
		border-style: solid;
		border-width: 0.8px;
		border-color: #EAEEF1;
		padding-left: 5px;
		padding-right: 60px;
		padding-bottom: 5px;
		padding-top: 5px;
		border-radius: 5px;
		margin-right: 10px;
		margin-left: 30px;
	}

	#Application_Form_main_ {
		overflow: hidden;
	}

	#Application_Form_main_ {
		overflow: hidden;
	}

	.case {
		float: right;
		padding-top: 30px;
	}

	h3 {
		color: orange;
		margin-top: 20px;
		margin-bottom: 30px;
		margin-left: 80px;
	}

	p {
		margin-left: 80px;
		margin-bottom: 10px;
	}

	.qiandao {
		height: 500px;
	}

	.ws {
		background-color: white;
	}

	.rs {
		background-color: #E0E0E0;
	}

	#ultwo li {
		padding-right: 300px;
	}

</style>
<style>
	.pageButton {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		background-color: white;
		margin-left: 5px;
		margin-top: 5px;
	}

	.prePage {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		background-color: white;
		margin-left: 5px;
		margin-top: 5px;
	}

	.nextPage {
		border-style: solid;
		border-width: 1px;
		border-color: #EAEEF1;
		background-color: white;
		margin-left: 5px;
		margin-top: 5px;
	}

</style>
<script>
	export default {

	}

</script>
