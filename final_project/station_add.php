<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<html>
<script src="https://kit.fontawesome.com/f11705a8f4.js" crossorigin="anonymous"></script>
<style type="text/css">
	#text{

		height: 35px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 200px;
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
		width: 600px;
        height: 450px;
		padding: 20px;
        border-radius: 8px;
	}
    div.container {
        text-align: center;
    }
    form.container{
        text-align: center;
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 50px; /* 5px rounded corners */
        background: white;
        height:400px;
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
    box-shadow: 0 5px #999;
  }
  .button:active {
    background-color: #ffc800;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }
</style>
<head>
    <title>add new station</title>
</head>
<body>
    <div id="box">
        <div class="card">
            <div class="container">
                <br>
                <h1>新增車站</h1> <br>
             </div>
            <form  class="container" name="form" method="post" action="station_add_finish.php">
                車站編號 : <input id="text" type="text" name="station_num" /> <br><br><br>
                車站名稱：<input id="text" type="text" name="station" /> <br><br><br>
                車站地址：<input id="text" type="text" name="station_address" /> <br><br><br>
                <!-- <input  class="button" type="submit" name="button" value="新增" /> &nbsp;&nbsp;&nbsp; -->
                <button class="button" type="submit"><i class="fa-solid fa-plus"></i> 新增</button>
                <button class="button" type="button" onclick="location.href='station.php'"><i class="fa-solid fa-xmark"></i> 取消</button>
            </form>
        </div>     
    </div>
</body>
</html>