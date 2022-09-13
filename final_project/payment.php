<?php
 session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
	<title>付款資訊</title>
	<style type="text/css">
	body { background-color: #fff; border-top: solid 10px #000;
		color: #fff; font-size: .85em; margin: 10px; padding: 2px;
		font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
	}
	h1 { 
		color: #fff;
		font-size: 2em;
		margin-bottom: 0;
		padding-bottom: 0;  }
	table { 
        position:absolute;
        left:-250px;
        margin-top: 0.75em;
        height: 250px;
        width: 500px;
    }
	th { font-size: 1.2em; text-align: center; padding-right: 15px; }
	td { font-size: 1.2em; text-align: center; }
	form{
		line-height: 2em;
	}
	form>input{
		padding: 5px, 10px; 
		border: 1px solid #888888;
		border-radius: 5px;
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
    a {
    text-decoration:none;
    }

    .header {
        width: 1510px;
        height:200px;
        padding: 2px;
        text-align: center;
        background: #FF8C00;
        color: #fff;
        border-radius: 8px;
	}
    #付款{
		color:#fff;
		position:absolute;
		left: 200px;
		top: 270px;
	}

    #圖片 {
			position: absolute;
			left : 50px;
			top :55px;
	}
    #列表 {
        background-color: #000000;
        position: absolute;
        top: 225px;
        width: 1515px;
        height:300px;
        border-radius: 8px;
    }
    #列表2 {
        background-color: #000000;
        position: absolute;
        top: 225px;
        width: 1515px;
        height:500px;
        border-radius: 8px;
    }
    input{
		width : 150px;
		height : 25px;
	}
	select{
		width : 150px;
		height : 25px;
	}

    #qrcode{
        position: absolute;
        left: 600px;

    }
    #but{
        position: absolute;
        left: 630px;
        top: 600px;
    }
    #charge{
        position: absolute;
        
        left: 800px;
        top: 300px;
    }
    #complete{
        position:absolute;
        left: 655px;
        top: 600px;
    }
</style>
<style>
	.button {
		position: absolute;
        top: 180px;
		left:450px;
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
    	box-shadow: 0 6px #999;
  }
  .button:active {
    background-color: #ffc800;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }
</style>
</head>

<title>付款資訊</title>

<body>



<h2>
<?php
    include "mysql_connect.inc.php";
    $same_order = $_GET["same_order"];
    $date = $_SESSION["date"];
    
    $sql = "SELECT SUM(TICKET_PRICE) FROM TICKET GROUP BY ORDER_NUM HAVING ORDER_NUM ='$same_order'";
    $result = $mysqli->query($sql);
    $price =$result->fetch_assoc()["SUM(TICKET_PRICE)"];
    
    $_pay = $_POST["payment"];
    if(intval($_pay) == 1){
        ?>
        <div id="列表"></div>
        <div class="header"><h1>信用卡支付</h1></div>
        
        <form name="表單" id="付款" method="post" action="end.php?pay=1&order=<?=$same_order?>">
            信用卡卡號: <input type="text" name="date" value= "" placeholder="xxxx-xxxx-xxxx-xxxx" required />
            <span class="ok">ok</span>&nbsp &nbsp 
            信用卡有效期限: <input type="month" value= "" required/>
            <span class="ok">ok</span>&nbsp &nbsp  
            安全碼: <input type="text" name="safe" maxlength = "3" value="" placeholder="xxx" oninput = "value=value.replace(/[^\d]/g,'')" required/>
            <span class="ok">ok</span>&nbsp &nbsp 
            金額: <input type="text" name="pay" value= "<?php echo $price ?>" readonly="readonly" />
            <button class="button" type = "submit">付款</button>  
        </form>
        <?php
    }else if(intval($_pay) == 2){
        ?>
        <div class="header"><h1>手機支付-QRCODE</h1></div>
        <form name="表單" method="post" action="end.php?pay=2&order=<?=$same_order?>">
                <img src="QRCODE.png" id="qrcode" width="300" height="300">
                    <br/>
            <button  class="button" type = "submit" id="but" >
                付款完成
            </button>  
        </form>
        <?php
    }else if(intval($_pay) == 3){
        ?>
        <div class="header"><h1>匯款資訊</h1></div>
        <div id="列表2"></div>
        <div id="charge">
        
        <table style="border:3px #fff dashed;" cellpadding="10" border='1'>

        <tr>
        <td> 銀行名稱  </td>
        <td> (XXX)XX銀行 XX分行 </td>
        </tr>
        <tr>
        <td> 匯款帳號  </td>
        <td> XXXX-XXXX-XXXX-XXXX </td>
        </tr>
        <tr>
        <td> 匯款戶名  </td>
        <td> XXXX有限公司 </td>
        </tr>
        <tr>
        <td> 金額  </td>
        <td> <?php echo $price?> </td>
        </tr>
        </table>
        </div>
        <input class="button" type="button"  id="complete" value="完成" onclick="location.href='end.php?pay=3&order=<?=$same_order?>'">
        <?php
    }
?>
</h2>



<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqHz7vIFoHJMQ5JtzgxYUoEhuA5bai4pe7EQ&usqp=CAU" id="圖片">
</body>