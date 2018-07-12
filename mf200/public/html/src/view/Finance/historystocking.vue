<template>
<div id="left-box" >
    <div style=" width: 100%; height: 100%;" >

        <div class="newdivtop"> 
        <h4 style="font-weight:bold;"><font style="display:inline-block; margin-top:20px;">历史库存盘点</font>

            <span class="h4span-r" style="background-color:#b0c777; color:#fff;" @click="getInfo()">搜 索</span>
            <span class="h4span-ra">
                <select class="form-control" id="ck">
					<option value="0">请选择仓库</option>
                    <option  v-for="item in ck_list"v-bind:ckname="item.ck_name" v-bind:value="item.ck_name">{{item.ck_name}}</option>
                </select>
            </span>
            <span class="h4span-ra">
               选择时间:<input type="text" name="date" class='ECalendar' id="ECalendar_case1" /><label style="display:inline-block; color:#777; width:22px; text-align:center;">至</label>
			   选择时间:<input type="text" name="date" class='ECalendar' id="ECalendar_case2" />
            </span>
            
           
        </h4>
        </div>
        
        <p style=" height:30px;"></p>
        <div class="hisdiv" style="width:100%;">
            <ul>
                <li v-for="item in infolist">
                    <h4>盘点编号：{{item.inventory_no}}</h4>
                    <p>盘点日期：{{item.add_time}}</p>
                    <p>仓库：{{item.ck_name}}</p>
                </li>
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
				ck_list: [],
				infolist: [],
				page: '',
			};
		},
		mounted: function() {
			this.getlists();
		},

		methods: {

			getlists: function(page) {
				var ck_name = $("#ck option:selected").attr("value");
				var start = $('#ECalendar_case1').val();
				var end = $('#ECalendar_case2').val();
				var sendData = {
					url: "index.php/finance/Library/ck_list",
					data: {
						ck_name: ck_name,
						start: start,
						end: end
					}
				};
				var re = getFaceInfo(sendData);
				this.ck_list = re.data;

			},
			getInfo: function() {
				var ck_name = $("#ck option:selected").attr("value");
				var start = $('#ECalendar_case1').val();
				var end = $('#ECalendar_case2').val();
				var sendData = {
					url: "index.php/finance/Library/inventory_list",
					data: {
						ck_name: ck_name,
						start: start,
						end: end
					}
				};
				var re = getFaceInfo(sendData);
				this.infolist = re.data;
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
/*		color: #fff;*/
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
/*		color: #fff;*/
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

	.hisdiv {
		width: 100%;
		height: auto;
	}

	.hisdiv li {
		width: 430px;
		height: 190px;
		float: left;
		display: inline;
		background-color: #fff;
		border-radius: 5px;
		margin-left: 32px;
		margin-top: 30px;
		border: 1px solid #e8e8e8;
		box-shadow: 0 0 10px #eee;
	}

	.hisdiv li h4 {
		margin: 40px 40px 30px 40px;
		font-weight: bold;
		color: #333;
	}

	.hisdiv li p {
		margin-bottom: 14px;
		color: #333;
		font-size: 16px;
		margin-left: 40px;
	}

</style>
