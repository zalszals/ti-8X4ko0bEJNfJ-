<template>
<div id="Application_Form_main__">
	<div id="Application_Form_head_">
		<div id="Application_Form_Date_">
			<div id="w_Warehouse">
				<h4 class="tit">种植管理 | 我的种植任务 | 执行种植任务</h4>
			</div>
			<div class="case">
				<button class="button or">完成</button>
				<button class="button or">返回</button>
			</div>
		</div>
	</div>
	<div id="Application_Form_main_">
		<div>
			<div><h4 class="tit ">种植参数</h4></div>
			<div>
				<p class="pf">作物 ： 测试f</p>
				<p class="pf">果形 ： 测试f</p>
			</div>
			<div>
				<p class="pf">计划定植时间 ： 2018-06-09</p>
				<p class="pf">计划采收期 ： 2018-06-11 至 2018-06-23</p>
			</div>
			<div>
				<p class="pf">未分配面积 ： 10平方米</p>
			</div>
			<div>
				<span><p>实际定植时间</p><input type="text" class="input"></span>
				<span><p>实际定植时间</p><input type="text" class="input">至<input type="text" class="input"></span>
			</div>
			<div>
				<span><p>种植模式</p><select class="selclass select" name="" id="type"></select></span>
				<span><p>株距</p><input type="text" class="input">cm</span>
				<span><p>行距</p><input type="text" class="input">cm</span>
			</div>
						<div>
				<span><p>种植环境</p><select class="selclass select" name="" id="type"></select></span>
				<span><p>种植区域</p><select class="selclass select" name="" id="type"></select></span>
			</div>
						<div>
				<span><p>区域种植面积 : 0平方米</p></span>
				<span><p>定植数量</p><input type="text" class="input">至<input type="text" class="input"></span>
			</div>
						<div>
				<p class="pf">已分配面积 ： 800.0平方米</p>
				<p class="pf">定植数量和 ： 100株</p>
			</div>
			<div><h4 class="tit ">目标产量</h4></div>
						<div>
				<p class="pf">定植时间 ： 2018-06-09</p>
				<p class="pf">预计采收期 ： 2018-06-11 至 2018-06-23</p>
			</div>
						<div>
				<p class="pf">未分配产量 ： 0kg</p>
			</div>
						<div>
				<span><p>目标单果重</p><input type="text" class="input">kg</span>
				<span><p>单位产量</p><input type="text" class="input">kg/m3</span>
				<span><p>总产量</p><input type="text" class="input">kg</span>
			</div>
		</div>
	</div>
</div>
</template>
<style scoped>
	#Application_Form_head_ {
		border-bottom: 2px solid #EAEEF1;
		margin-left: 40px;
		padding-bottom: -110px;
		height: 80px;
	}

	#Application_Form_Date_ {}

	#w_Warehouse {
		/*        float: left;*/
		font-size: 15px;
		font-weight: bold !important;
		padding-top: 30px;
		margin-left: 30px;
		margin-right: 300px;
	}
	select{
		margin: 0;
	}
	.case {
		float: right;
		margin-top: -30px;
	}
	#Application_Form_main_{
		margin-left: 70px;
		margin-top: 30px;
	}
	#Application_Form_main_ div div {
		overflow: hidden;
		margin-bottom: 30px;
	}

	#Application_Form_main_ div div .pf {
		float: left;
		margin-right: 90px;
	}

	#Application_Form_main_ div div span {
		float: left;
			margin-right: 90px;
	}

</style>
