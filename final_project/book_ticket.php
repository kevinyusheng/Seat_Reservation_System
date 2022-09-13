<?php

use LDAP\Result;

 session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<head>

	<title>訂票系統</title>
<style type="text/css">
	body { background-color: #fff; border-top: solid 10px #FFFAFA;
		color:#FFFAFA; font-size: .85em; margin: 5px; padding: 2px;
		font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
	}
	#文字 { 
		 color: #fff;
		 font-size: 1.1em;
		 position: absolute;
		 left: 80px;
		 top: 300px;
		 }
	#圖片 {
			position: absolute;
			left : 100px;
			top :55px;
	}
	#列表 {
		background-color: #000000;
        position: absolute;
		width: 1515px;
		height: 250px;
		padding: 2px;
		border-radius: 8px;
	}
	.header {
			width: 1515px;
			height: 200px;
            padding: 2px;
            text-align: center;
            background: #FF8C00;
            color: white;
			border-radius: 8px;
        }
	select{
		font-family:'DFKai-sb';
		width : 25px;
		height : 15px;
	}
	h3 { font-size: 1.2em; }

	table { margin-top: 0.75em;}

	th { font-size: 1.2em; text-align: center; border: none 0px; padding-right: 15px; }

	td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }

	form{
		font-family:'DFKai-sb';
		line-height: 2em;
		font-size: 1.2em;
	}
	form>input, form>select{
		padding: 5px, 10px; 
		border: 1px solid #888888;
		border-radius: 5px;
		font-size: 0.8em;
		width:150px;
		height:50px;
	}
	form>.ok{
		color: #008800;
	}
	form>input:valid+.ok{
		display: inline;
	}
	form>input:invalid+.ok{
		display: none;
	}
	form>select:valid+.ok{
		display: inline;
	}
	form>select:invalid+.ok{
		display: none;
	}

	.inline-input-group.row {
            margin-left: -6px;
            margin right: -6px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col-input {
            padding-left: 8px;
            padding- right: 8px;
        }
        .input-smalllabel{
            font-size: .9rem;
            margin-bottom: 0;
            line-height: 1;
            padding-left: 5px;
        }
        label {
            display: inline-block;
        }
        #box_select{
            background-color: grey;
            margin: auto;
            width: 1000px;
            padding: 20px;
        }       
	</style>
    <style>
        body {font-family: Arial;}
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }
		
        button {
			font-family:'DFKai-sb';
            font-size: 0.8em;
			width: 150px;
			height: 40px;
			display: block;
			text-align: center;
			cursor: pointer;
			line-height: 40px;
			color: #fff;
			background-color: transparent;
			border: 1px solid #fff;
			transition: all .3s linear;
        }
		button:hover{
			background-color: #fff;
			color: #000;
		}
		.br1{ line-height:20px}
</style>
<style>
	.button {
		position: absolute;
		top: 100px;
		left:550px;
		width: 250px;
		height: 55px;
    	padding: 10px 15px;
    	font-size: 20px;
    	text-align: center;
    	cursor: pointer;
    	outline: none;
    	background-color: #ff8c00;
    	border: none;
    	border-radius: 15px;
    	box-shadow: 0 4px #999;
  }
  .button:active {
    background-color: #ffc800;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }
</style>
</head>


<body>
<?php
include ("mysql_connect.inc.php");
$mem = $_GET['mem'];
$_SESSION['mem'] = $mem;
?>
<div class="header"><h1>訂票系統</h1></div>
<div id="列表"></div>
<div id="文字">  
   <form name="表單" method="post" action="choose_train.php">

   
    啟站:
		
		<select name="start_stop" required>
			<option value="">啟站</option>
			<?php
				$sql = "SELECT * FROM STATION"; //下拉選單
				if (!$result = $mysqli->query($sql)){
					echo "no data";
				}
				while($start_stop = $result->fetch_assoc()){
			?>
					<option value = <?=$start_stop['STATION_NUM']?>> <?=$start_stop["STATION_NAME"]?> </option>
				<?php } ?>
		</select>	
			<span class="ok">ok</span>
	
			
	迄站:

	<select name="end_stop" required>
		<option value="">迄站</option>
		<?php
			$sql = "SELECT * FROM STATION"; //下拉選單
			if (!$result = $mysqli->query($sql)){
				echo "no data";
			}
			while($end_stop = $result->fetch_assoc()){
		?>
				<option value = <?=$end_stop['STATION_NUM']?>> <?=$end_stop["STATION_NAME"]?> </option>
			<?php } ?>
	</select>	
		<span class="ok">ok</span>

	
	日期:
	<input  type="date" min="<?=date('Y-m-d')?>" value="" name="order_date" required/> 
		<span class="ok">ok</span>

	時間:
	<input type="time" min = "06:00:00" max = "23:00:00" name="time_field" value="" required />
		<span class="ok">ok</span>

	
	票數:
	<input type="number" name="quantity" min="1" max="5" placeholder="張數(1~5)" required>
		<span class="ok">ok</span>

	
	優惠:
	<select name="identity_num" required>
		<option value=""> 票種 </option>
        <option value="1"> 孩童票 </option>
        <option value="2"> 大學生票 </option>
		<option value="3"> 全票 </option>
		<option value="4"> 敬老票 </option>
		<option value="5"> 愛心票 </option>
	</select>
		<span class="ok">ok</span>
		<div class="br1"></br></div>
		<div class="shape-ex1"><button class="button" type = "submit">
			查詢
		</div>
		
   </form>
</div>

	<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqHz7vIFoHJMQ5JtzgxYUoEhuA5bai4pe7EQ&usqp=CAU" id="圖片">
</body>

<script type="text/javascript">

window.history.forward(1);

</script>

