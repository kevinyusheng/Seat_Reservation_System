<html>
    <script>
        function openproject(evt, activity) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
             }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(activity).style.display = "block";
            evt.currentTarget.className += " active";
     }
    </script>
    <style>
        .header {
            padding: 80px;
            text-align: center;
            background: #FF8C00;
            color: white;
        }
		.topnav {
    		background-color: #333;
   			 overflow: hidden;
  		}
  		/* Style the links inside the navigation bar */
  		.topnav a {
    		float: left;
    		color: #f2f2f2;
    		text-align: center;
    		padding: 14px 16px;
    		text-decoration: none;
    		font-size: 17px;
            border-bottom: 3px solid transparent;
  		}
        .topnav a.col{
            width:24.99999%;
        }
        .topnav a.incol{
            width:46.75%;
        }
 		/* Change the color of links on hover */
  		.topnav a:hover {
    		background-color: #ddd;
    		color: black;
            border-bottom: 3px solid red;
 	 	}
  
  		/* Add a color to the active/current link */
  		.topnav a.active {
    		background-color: black;
    		color: white;
            border-bottom: 3px solid red;
 	 	}
        .topnav a.right{
            float: right;
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

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            width: 50%;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }   

            /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

            /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

            /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }   
    </style>
    <style>
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
    </style>
    <head>
        <title>Home</title>
    </head>

    <body>
        <div class="header">
            <h1>歡迎來到高鐵訂票系統</h1>
            
        </div>
        <div class="topnav">
  			<a class="active, col" href="logout.php">首頁</a>
  			<a class="col" href="security.php">更新用戶資料</a>
            <a class="right" href="index.php">會員</a>
		</div>
        <div id="box_select">
            <h2>Tabs</h2>
            <p>Click on the buttons inside the tabbed menu:</p>

            <div class="tab">
                <button class="tablinks" onclick="openproject(event, 'time')">時刻表與票價</button>
                <button class="tablinks" onclick="openproject(event, 'booking')">網路訂票</button>
            </div>

            <div id="time" class="tabcontent ,inline-input-group, row">
                <div class="col-input">
                    <label class="input-smalllabel">起始站</label>
                    <button> <select title="出發站">
                        <option value="NAnGang">南港</option>
                        <option value="TaiPei">台北</option>
                        <option value="BanQiao">板橋</option>
                        <option value="TaoYuan">桃園</option>
                        <option value="XinZhu">新竹</option>
                        <option value="MiaoLi">苗栗</option>
                        <option value="TaiZhong">台中</option>
                        <option value="ZhangHua">彰化</option>
                        <option value="YunLin">雲林</option>
                        <option value="JiaYi">嘉義</option>
                        <option value="TaiNan">台南</option>
                        <option value="ZuoYing">左營</option>
                    </select></button>
                </div>
                
            </div>

            <div id="booking" class="tabcontent">
                <h3>Paris</h3>
                <p>Paris is the capital of France.</p> 
            </div>
        </div>
    </body>
</html>
