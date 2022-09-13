<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php 
include("connection.php");

if ($_SESSION['MNA_ID'] != null) {
    $sql = "SELECT * FROM STATION";
    $result = mysqli_query($con, $sql);
}
?>
<html>
<script src="https://kit.fontawesome.com/f11705a8f4.js" crossorigin="anonymous"></script>
<style type="text/css">
	
	#text{

		height: 50px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 700px;
		height: 850px;
		padding: 20px;
        border-radius: 8px;
	}
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 10px; /* 5px rounded corners */
        background: white;
        height:650px;
    }
    .center {
        margin-left: auto;
        margin-right: auto;
    }
    div.container{
        text-align: center;
    }
</style>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

    .form-inline {  
        display: flex;
        flex-flow: row wrap;
        align-items: center;
        text-align: center;    }

    .form-inline label {
        margin: 5px 10px 5px 0;
    }

    .form-inline input {
        vertical-align: middle;
        margin: 5px 10px 5px 0;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .form-inline button {
        padding: 10px 20px;
        background-color: dodgerblue;
        border: 1px solid #ddd;
        color: white;
        cursor: pointer;
    }

    .form-inline button:hover {
        background-color: royalblue;
    }

    @media (max-width: 800px) {
        .form-inline input {
        margin: 10px 0;
    }
  
    .form-inline {
        flex-direction: column;
        align-items: stretch;
    }
    }
</style>
<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .top-container {
        background-color: #f1f1f1;
        padding: 30px;
        text-align: center;
    }

    .header {
        padding: 10px 16px;
        background: #555;
        color: #f1f1f1;
        border-radius: 8px;
    }

    .content {
        padding: 16px;
    }
</style>
<style>
  .button {
    padding: 10px 20px;
    font-size: 20px;
    text-align: center;
    cursor: pointer;
    outline: none;
    color: #fff;
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

    <head>
        <title> train add </title>
    </head>
<body>
    <div id="box" class="container">
        <div>
            <h2 style="text-align: center">新增列車</h2>
        </div>
        <div class="card">
            <form name="form" method="post" action="train_add_finish.php">
                <div class="header" id="myHeader">
                    <!-- <form  class="form-inline center"> -->
                        <label  for="num">車次號碼 :  </label>
                        <input  type="text" id="num" placeholder="Enter train number" name="train_num">
                        <label  for="date">開行日期： </label>
                        <input  type="date" id="date" placeholder="Enter train date" name="train_date">
                        方向：
                        <input type="radio" name="dir" value="1">南
                        <input type="radio" name="dir" value="2">北
                    <!-- </form> -->
                </div>
                <h2  style="text-align: center">停靠站及時間：</h2>
                <!-- <form style="text-align: center"> -->
                    <?php 
                    while ($row = mysqli_fetch_assoc($result)) {?>
                    <input type="checkbox" id="<?php echo $row["STATION_NUM"];?>" value="<?php echo $row["STATION_NUM"];?>" name="checkbox[]" onclick="change(this.id)"/>
                    <?php echo $row["STATION_NAME"];?>&nbsp;&nbsp;

                    <input type="time" id="time<?php echo $row["STATION_NUM"];?>" name="time[]" disabled/>
                    <br><br>
                    <?php
                }?>
                <!-- </form> -->
                <br><br>
                <button class="button" type="submit"><i class="fa-solid fa-plus"></i> 新增</button> 
                <button class="button" type="button" onclick="location.href='train.php'"><i class="fa-solid fa-xmark"></i> 取消</button>
            </form>
        </div>
        <br>
        <!-- <input class="button" type="submit" name="button" value="新增" /> &nbsp;&nbsp;&nbsp;  -->
        
    </div>
<script>
    function change(id) {
        // Get the checkbox
        var checkBox = document.getElementById(id);
        // Get the output text
        let text = "time" + id;
        var time = document.getElementById(text);
        //window.alert(checkBox);
        // If the checkbox is checked, display the output text
        let state = checkBox.checked;
        time.disabled = !checkBox.checked;
    }
</script>
<script>
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
        } else {
        header.classList.remove("sticky");
        }
    }
</script>
</body>
</html>