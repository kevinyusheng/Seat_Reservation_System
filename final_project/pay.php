<?php
 session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>

	<title>訂票系統</title>
	<style type="text/css">
	body { background-color: #fff; border-top: solid 10px #FFFAFA;
		color:#FFFAFA; font-size: .85em; margin: 10px; padding: 2px;
		font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
	}
	#文字 { 
		 color: #fff;
		 font-size: 1.5em;
		 position: absolute;
		 left: 230px;
		 top: 300px;
		 }
	#圖片 {
			position: absolute;
			left : 100px;
			top :75px;
	}
	#列表 {
		background-color: #000000;
        position: absolute;
		width: 1508px;
		height: 300px;
		padding:2px;
		border-radius: 8px;
	}
	input{
		font-family:'DFKai-sb';
		width : 150px;
		height : 25px;
	}
	select{
		font-family:'DFKai-sb';
		width : 20px;
		height : 15px;
	}
	h3 { font-size: 1.2em; }

	table { margin-top: 0.75em;}

	th { font-size: 1.2em; text-align: center; border: none 0px; padding-right: 15px; }

	td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }

	form{
		display:inline;
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
		.header {
            padding: 80px;
            text-align: center;
            background: #FF8C00;
            color: white;
			border-radius: 8px;
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
		left:400px;
		top: 180px;
		width: 250px;
		height: 55px;
    	padding: 10px 15px;
    	font-size: 20px;
    	text-align: center;
    	cursor: pointer;
    	outline: none;
    	background-color: #ff8c00;
    	border: none;
    	border-radius: 10px;
    	box-shadow: 0 4px #999;
  }
  .button:active {
    background-color: #ffc800;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }
</style>
</head>


<title>付款方式</title>

<body>
	<div class="header"><h1>付款方式</h1></div>
<div id="列表"></div>
<div id="文字">  
<?php
    include "mysql_connect.inc.php";
    $same_order = $_GET["same_order"];
    $date = $_SESSION["date"];

    $sql = "SELECT SUM(TICKET_PRICE) FROM TICKET GROUP BY ORDER_NUM HAVING ORDER_NUM ='$same_order'";
    $result = $mysqli->query($sql);
    $price =$result->fetch_assoc()["SUM(TICKET_PRICE)"];
?>

<form name="表單"  id="付款" method="post" action="payment.php?same_order=<?=$same_order?>">
付款方式:
        <select name ="payment" required>
		<option value="">方式</option>
        <option value="1">信用卡</option>
        <option value="2">手機支付</option>
        <option value="3">匯款</option>
        
        </select>
        <span class="ok">ok</span>
		&nbsp &nbsp &nbsp 
		
付款期限:<input type="text" name="date" value= "<?php echo date("Y-m-d",strtotime("-3 day",strtotime($date))) ?>" readonly="readonly"/>
&nbsp &nbsp &nbsp 

付款金額:
    <input type="text" name="pay" value= "<?php echo $price ?>" readonly="readonly" />
	&nbsp &nbsp &nbsp &nbsp &nbsp
<p nowrap><button class="button"  type = "submit" id="按鈕">確認</button></p> 	
		
</form>


</div>

<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqHz7vIFoHJMQ5JtzgxYUoEhuA5bai4pe7EQ&usqp=CAU" id="圖片">
</body>
