<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();
$highresults = "w3-blue";

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
    <?php
$userMail = $_SESSION['email'];

$imageWidth = '150'; //The image size

$imgUrl = 'http://www.gravatar.com/avatar/'.md5($userMail).'fs='.$imageWidth;

?>
        <!DOCTYPE html>
        <html>
        <title>ePower | Results
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/w3.css">
        <link rel="stylesheet" href="css/results.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            html,
            body,
            h1,
            h2,
            h3,
            h4,
            h5 {
                font-family: "Raleway", sans-serif
            }
        </style>
       
        <script>
            var myConfig = {
                "type": "line"
                , "background-color": "#003849"
                , "utc": true
                , "title": {
                    "y": "7px"
                    , "text": "Measurement"
                    , "background-color": "#003849"
                    , "font-size": "24px"
                    , "font-color": "white"
                    , "height": "25px"
                }
                , "plotarea": {
                    "margin": "20% 8% 14% 12%"
                    , "background-color": "#003849"
                }
                , "legend": {
                    "layout": "float"
                    , "background-color": "none"
                    , "border-width": 0
                    , "shadow": 0
                    , "width": "75%"
                    , "text-align": "middle"
                    , "x": "25%"
                    , "y": "10%"
                    , "item": {
                        "font-color": "#f6f7f8"
                        , "font-size": "14px"
                    }
                }
                , "scale-x": {
                    "min-value": 0
                    , "shadow": 0
                    , "step": 0.5
                    , "line-color": "#f6f7f8"
                    , "tick": {
                        "line-color": "#f6f7f8"
                    }
                    , "guide": {
                        "line-color": "#f6f7f8"
                    }
                    , "item": {
                        "font-color": "#f6f7f8"
                    }
                    , "label": {
                        "text": "Seconds"
                        , "font-color": "#f6f7f8"
                    }
                    , "minor-ticks": 0
                }
                , "scale-y": {
                    "values": "0:1000:250"
                    , "line-color": "#f6f7f8"
                    , "shadow": 0
                    , "tick": {
                        "line-color": "#f6f7f8"
                    }
                    , "guide": {
                        "line-color": "#f6f7f8"
                        , "line-style": "dashed"
                    }
                    , "item": {
                        "font-color": "#f6f7f8"
                    }
                    , "label": {
                        "text": "μVolts"
                        , "font-color": "#f6f7f8"
                    }
                    , "minor-ticks": 0
                    , "thousands-separator": ","
                }
                , "crosshair-x": {
                    "line-color": "#f6f7f8"
                    , "plot-label": {
                        "border-radius": "5px"
                        , "border-width": "1px"
                        , "border-color": "#f6f7f8"
                        , "padding": "10px"
                        , "font-weight": "bold"
                    }
                    , "scale-label": {
                        "font-color": "#00baf0"
                        , "background-color": "#f6f7f8"
                        , "border-radius": "5px"
                    }
                }
                , "tooltip": {
                    "visible": false
                }
                , "plot": {
                    "tooltip-text": "%t views: %v<br>%k"
                    , "shadow": 0
                    , "line-width": "3px"
                    , "marker": {
                        "type": "circle"
                        , "size": 3
                    }
                    , "hover-marker": {
                        "type": "circle"
                        , "size": 4
                        , "border-width": "1px"
                    }
                }
                , "series": [

                    {
                        "text": "Measure 1"
                        , "line-color": "#da534d"
                        , "legend-marker": {
                            "type": "circle"
                            , "size": 5
                            , "background-color": "#da534d"
                            , "border-width": 1
                            , "shadow": 0
                            , "border-color": "#faa39f"
                        }
                        , "marker": {
                            "background-color": "#da534d"
                            , "border-width": 1
                            , "shadow": 0
                            , "border-color": "#faa39f"
                        }
              }, ]
            };

            function showUser(str) {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getmeasure.php?q=" + str, false);
                xmlhttp.send(null);
                if (xmlhttp.status === 200) {
                    console.log(xmlhttp.responseText);
                    myConfig.series[0].values = eval(xmlhttp.responseText);
                    zingchart.render({
                        id: 'myChart'
                        , data: myConfig
                        , height: 500
                        , width: 725
                    });
                }
            }
        </script>

        <body onload="submit()" class="w3-light-grey">
            <!-- Top container -->
            <div class="w3-container w3-top w3-black w3-large w3-padding" style="z-index:4">
                <button class="w3-button w3-hide-large w3-padding-0 w3-black w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button> <span class="w3-right">ePower</span> </div>
            <!-- Sidebar/menu -->
            <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar">
                <br>
                <div class="w3-container w3-row">
                    <div class="w3-col s4"> <img src="<?php echo $imgUrl;?>" class="w3-circle w3-margin-right" style="width:70px" alt="Profilepic"> </div>
                    <div class="w3-col s8 w3-bar"> <span>Welcome, <strong><?php echo $row['userName']; ?></strong></span>
                        <br> </div>
                </div>
                <hr>
                <div class="w3-container">
                    <h5>Dashboard</h5> </div>
                <div class="w3-bar-block"> <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a> <a href="home.php" class="w3-bar-item w3-button w3-padding <?php echo $highhome; ?>"><i class="fa fa-home"></i>  Home</a> <a href="results.php" class="w3-bar-item w3-button w3-padding <?php echo $highresults; ?>"><i class="fa fa-area-chart"></i>  Results</a> <a href="social.php" class="w3-bar-item w3-button w3-padding <?php echo $highsocial; ?>"><i class="fa fa-weixin"></i>  Social</a> <a href="profile.php" class="w3-bar-item w3-button w3-padding <?php echo $highprofile; ?>"><i class="fa fa-user"></i>  Profile</a> <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-sign-out"></i>  Logout</a>
                    <br>
                    <br> </div>
            </nav>
            <!-- Overlay effect when opening sidebar on small screens -->
            <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
            <!-- !PAGE CONTENT! -->
            <div class="w3-main" style="margin-left:300px;margin-top:43px;">
                <!-- Header -->
                <!-- End page content -->
                <script>
                    // Get the Sidebar
                    var mySidebar = document.getElementById("mySidebar");
                    // Get the DIV with overlay effect
                    var overlayBg = document.getElementById("myOverlay");
                    // Toggle between showing and hiding the sidebar, and add overlay effect
                    function w3_open() {
                        if (mySidebar.style.display === 'block') {
                            mySidebar.style.display = 'none';
                            overlayBg.style.display = "none";
                        }
                        else {
                            mySidebar.style.display = 'block';
                            overlayBg.style.display = "block";
                        }
                    }
                    // Close the sidebar with the close button
                    function w3_close() {
                        mySidebar.style.display = "none";
                        overlayBg.style.display = "none";
                    }
                </script>
                <form>
                    <select name="users" onchange="showUser(this.value)">
                        <?php 
$connection = mysqli_connect('mysql.metropolia.fi', 'juskam', 'password', 'juskam');
$sql = mysqli_query($connection, "SELECT date, measureID FROM measure");
$mesures = array();
echo '<option value="'.$id.'">'."Select measurement".'</option>';
while ($row = $sql->fetch_assoc()){
    $id = $row['measureID'];
    $time = $row['date'];
    array_push($mesures, $id);
    echo '<option value="'.$id.'">'.$time.'</option>';
}
?>
                    </select>
                </form>
                <br>
                <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
                <script>
                    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
                    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
                </script>
                <style>
                    .zc-ref {
                        display: none;
                    }
                </style>
                <div id='myChart'><a class="zc-ref" href="https://www.zingchart.com/">Charts by ZingChart</a></div>
                <script>
                    zingchart.THEME = "classic";
                </script>
                <div id="txtHint"></div>