<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>产品溯源</title>
</head>
<style>
	*{
		padding: 0;
		margin: 0;
		border: 0;
		list-style: none;
		font-size: 70px;
	}
	div{
		margin-left: 20px;
		margin-top: 20px;
	}
	.color {
		background-color: white;
	}

	.color:nth-child(2n) {

		background-color: #F9F9F9;
	}

</style>
<body>
<div>
	<?php
		require('../../application/common.php');
		$db_name = authcode($_REQUEST['dd'],'DECODE','www.mframers.com');
		$h_id = $_REQUEST['h_id'];
		$batch_no = $_REQUEST['batch_no'];
		$detail_id = $_REQUEST['detail_id'];

		/*$con = mysql_connect("127.0.0.1","mysql-link","qdlg.com",'880') or die("连接数据库错误！");
		mysql_query("SET NAMES utf8");
    	mysql_query("SET CHARACTER SET utf8");
    	mysql_select_db($db_name,$con);*/
    	$pdo = new PDO("mysql:host=127.0.0.1;dbname={$db_name}",'mysql-link','qdlg.com');  
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    	$sql = "select p.plan_name,h.get_time,h.href,h.href_t,h.percentum_1,h.percentum_2,t.t_name,g.cat_name,w.worker_name,g.fcolor,g.ftype,go.cat_name as p_name,mo.mode_name,a.area_name,t.zhu_ju,t.hang_ju,t.grow_date from mf_pro_harvest_day as h join mf_product_plan as p on h.plan_id = p.plan_id";
    	$sql1 = " join mf_pro_grow_task as t on h.t_id = t.t_id join mf_materiel_category as g on h.cat_id = g.cat_id join mf_materiel_category as go on g.pid = go.cat_id join mf_grow_mode as mo on t.grow_mode_id = mo.mode_id join mf_grow_area as a on h.area_id = a.area_id join mf_worker as w on t.worker_id = w.worker_id";
    	$where = " where h_id = {$h_id}";
    	$query = $sql.$sql1.$where;
    	$result = $pdo->query($query);
    	//$result = mysql_query($query,$con);
    	//while($row = mysql_fetch_array($result)){
    	while($row = $result->fetch()){
    ?>
    	<ul>
			<li class="color"><p>生产计划 ：<?php echo $row['plan_name'] ?></p></li>
			<li class="color"><p>种植任务 ： <?php echo$row['t_name'] ?></p></li>
			<li class="color"><p>负责人 ： <?php echo $row['worker_name'] ?></p></li>
			<li class="color"><p>作物 ： <?php echo $row['p_name'] ?></p></li>
			<li class="color"><p>果形 ： <?php echo $row['ftype'] ?></p></li>
			<li class="color"><p>果色 ： <?php echo $row['fcolor'] ?></p></li>
			<li class="color"><p>品种 ： <?php echo $row['cat_name'] ?></p></li>
			<li class="color"><p>种植模式 ： <?php echo $row['mode_name'] ?></p></li>
			<li class="color"><p>种植区域 ： <?php echo $row['area_name'] ?></p></li>
			<li class="color"><p>株距 ：  <?php echo $row['zhu_ju'] ?> cm</p></li>
			<li class="color"><p>行距 ： <?php echo $row['hang_ju'] ?> cm</p></li>
			<li class="color"><p>定植时间 ： <?php echo $row['grow_date'] ?></p></li>
			<li class="color"><p>采收时间 ： <?php echo date('Y-m-d',strtotime($row['get_time'])) ?></p></li>
			<li class="color"><p>质检结果 ：一级果率： <?php echo $row['percentum_1'] ?>%  二级果率：<?php echo $row['percentum_2'] ?>%</p></li>
		</ul>
    <?php
    	}
    	if(isset($detail_id)){
    		$sql2 = "select d.m_num,d.m_id,s.*,m.m_name,o.customer_name,o.customer_phone,o.customer_address,o.ask_info,o.other_ask,m.unit from mf_sell_batch_detail as d join mf_sell_batch as s on d.batch_id = s.batch_id";
    		$sql3 = " join mf_sell_order as o on d.order_id = o.order_id join mf_materiel as m on d.m_id = m.m_id";
    		$where1 = " where d.detail_id = {$detail_id}";
    		$query1 = $sql2.$sql3.$where1;
    		$res = $pdo->query($query1);
	    	// $res = mysql_query($query1,$con);
	    	// while($row1 = mysql_fetch_array($res)){
    		while($row1 = $res->fetch()){
	    		$arr = array();
		    	$str = '';
				$str = str_replace(':null', ':""', json_encode($row1));
				$arr = json_decode($str,'true');
    ?>
		<ul>
			<li class="color"><p>商品名称 ：<?php echo $arr['m_name'] ?></p></li>
			<li class="color"><p>批 次 号 ：<?php echo $batch_no ?></p></li>
			<li class="color"><p>订单数量 ：<?php echo $arr['m_num'].' '.$arr['unit'] ?></p></li>
			<li class="color"><p>包装要求 ：<?php echo $arr['ask_info'] ?></p></li>
			<li class="color"><p>附加要求： <?php echo $arr['other_ask'] ?></p></li>
			<li class="color"><p>客户名称 ：<?php echo $arr['customer_name'] ?></p></li>
			<li class="color"><p>客户地址 ：<?php echo $arr['customer_address'] ?></p></li>
			<li class="color"><p>客户电话 ：<?php echo $arr['customer_phone'] ?></p></li>
			<li class="color"><p>发货时间 ：<?php echo date('Y-m-d H:i:s',$arr['real_time']) ?></p></li>
			<li class="color"><p>运输方式 ： <?php if($arr['type'] == 1){echo '快递运输';}else{echo '专车运输';} ?></p></li>
			<?php if($arr['type'] == 1){ ?>	
				<li class="color"><p>快  递 ： <?php echo $arr['car_kdgs'] ?></p></li>
				<li class="color"><p>快递单号 ：<?php echo $arr['car_kddh'] ?></p></li>
			<?php }else{ ?>
				<li class="color"><p>车辆型号 ：<?php echo $arr['car_clxh'] ?></p></li>
				<li class="color"><p>车牌号 ：  <?php echo $arr['car_cp'] ?></p></li>
				<li class="color"><p>运输类型 ：<?php echo $arr['car_yslx'] ?></p></li>
				<li class="color"><p>司机姓名 ：<?php echo $arr['car_sjxm'] ?></p></li>
				<li class="color"><p>联系方式： <?php echo $arr['car_lxfs'] ?></p></li>
			<?php } ?>
		</ul>
	<?php
			}
    	}
    	mysql_close($con);
	?>
</div>
</body>
</html>