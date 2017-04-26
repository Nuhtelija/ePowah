<?php
$title = "Results";
session_start();
require_once 'class.user.php';
$user_home = new USER();
$highresults = "w3-blue";
require_once 'nav.php';
?>
       <link rel="stylesheet" href="css/results.css">
        <script>
            var myConfig = {
                
                "type": "line"
                , "background-color": "white"
                            , "border-width": 1
                            , "border-color": "#dae5ec"
                , "utc": true
                , "title": {
                    "y": "7px"
                    ,"x": "0.5%"
                    , "text": "Measurement"
                    , "background-color": "white"
                    , "font-size": "24px"
                    , "font-color": "#707d94"
                    , "height": "25px"
                    , "width": "99%"
                }
                , "plotarea": {
                    "margin": "20% 5% 14% 5%"
                    , "background-color": "white"
                }
                , "legend": {
                    "layout": "float"
                    , "background-color": "none"
                    , "border-width": 0
                    , "shadow": 0
                    , "width": "75%"
                    , "text-align": "middle"
                    , "x": "43%"
                    , "y": "10%"
                    , "item": {
                        "font-color": "#707d94"
                        , "font-size": "14px"
                    }
                }
                , "scale-x": {
                    "min-value": 0
                    , "shadow": 0
                    , "step": 1
                    , "line-color": "#d2dae2"
                    , "tick": {
                        "line-color": "#d2dae2"
                    }
                    , "guide": {
                        "line-color": "#8391a5"
                    }
                    , "item": {
                        "font-color": "#8391a5"
                    }
                    , "label": {
                        "text": "Seconds"
                        , "font-color": "#707d94"
                    }
                    , "minor-ticks": 0
                }
                , "scale-y": {
                    "values": "0:1000:250"
                    , "line-color": "#d2dae2"
                    , "shadow": 0
                    , "tick": {
                        "line-color": "#d2dae2"
                    }
                    , "guide": {
                        "line-color": "#8391a5"
                        , "line-style": "dashed"
                    }
                    , "item": {
                        "font-color": "#8391a5"
                    }
                    , "label": {
                        "text": "μVolts"
                        , "font-color": "#707d94"
                    }
                    , "minor-ticks": 0
                    , "thousands-separator": ","
                }
                , "crosshair-x": {
                    "line-color": "#707d94"
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
                            ,"show-line": true
                            , "size": 5
                            , "background-color": "white"
                            , "border-width": 1
                            , "shadow": 0
                            , "border-color": "#da534d"
                        }
                        , "marker": {
                            "background-color": "white"
                            , "border-width": 1
                            , "shadow": 0
                            , "border-color": "#da534d"
                        }
              }, 
                {
       
        "text": "Measure 2",
        "line-color": "#ff9800",
        "legend-marker": {
          "type": "circle",
            "show-line": true,
          "size": 5,
          "background-color": "white",
          "border-width": 1,
          "shadow": 0,
          "border-color": "#ff9800"
        },
        "marker": {
          "background-color": "white",
          "border-width": 1,
          "shadow": 0,
          "border-color": "#ff9800"
        }
      },]
            };
            
            
function getavg(str) {
    if (str == "") {
        document.getElementById("measure1avg").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("measure1avg").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getavg.php?q="+str,true);
        xmlhttp.send();
    }
}
            function getavg2(str) {
    if (str == "") {
        document.getElementById("measure2avg").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("measure2avg").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getavg.php?q="+str,true);
        xmlhttp.send();
    }
}
            function getmax1(str) {
    if (str == "") {
        document.getElementById("measure1max").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("measure1max").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getmax.php?q="+str,true);
        xmlhttp.send();
    }
}
                    function getmax2(str) {
    if (str == "") {
        document.getElementById("measure2max").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("measure2max").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getmax.php?q="+str,true);
        xmlhttp.send();
    }
}


            function measure1(str) {
                if (str=="") {
                    myConfig.series[0].values = 0;
                    zingchart.render({
                        id: 'myChart'
                        , data: myConfig
                        , height: "99%"
                        , width: "100%"
                    });
                
                return;
                }
                
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
                        , height: "99%"
                        , width: "100%"
                    });
                }
            }
            
            function measure2(str) {
                if (str=="") {
                    myConfig.series[1].values = 0;
                    zingchart.render({
                        id: 'myChart'
                        , data: myConfig
                        , height: "99%"
                        , width: "100%"
                    });
                
                return;
                }
                
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
                    myConfig.series[1].values = eval(xmlhttp.responseText);
                    zingchart.render({
                        id: 'myChart'
                        , data: myConfig
                        , height: "99%"
                        , width: "100%"
                    });
                }
            }
        </script>

                
  <!-- Header -->
  <header class="w3-container" style="padding-top:1px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>
      

<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red  w3-padding-16">
        <div class="w3-left"><i class="fa fa-balance-scale w3-xxxlarge"></i></div>
        <div class="w3-right w3-size" id="measure1avg">
          <h3>—</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Measure 1 AVG</h4>
      </div>
    </div>
   
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-balance-scale w3-xxxlarge"></i></div>
        <div class="w3-right w3-size" id="measure2avg">
          <h3>—</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Measure 2 AVG</h4>
      </div>
    </div>
    
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-battery-full w3-xxxlarge"></i></div>
        <div class="w3-right w3-size" id="measure1max">
          <h3>—</h3> 
        </div>
        <div class="w3-clear"></div>
        <h4>Measure 1 MAX</h4>
      </div>
    </div>
    
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-battery-full w3-xxxlarge"></i></div>
        <div class="w3-right w3-size" id="measure2max">
          <h3>—</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Measure 2 MAX</h4>
      </div>
    </div>
  </div>
  
  
              <!--Measure 1 dropdown-->
                <form>
                    <select id="soflow" name="users" onchange="measure1(this.value); getavg(this.value); getmax1(this.value);">
                        <?php 
$connection = mysqli_connect('mysql.metropolia.fi', 'juskam', 'password', 'juskam');
$sql = mysqli_query($connection, "SELECT date, measureID FROM measure");
$mesures = array();
echo '<option value="'."".'">'."Select measurement 1".'</option>';
while ($row = $sql->fetch_assoc()){
    $id = $row['measureID'];
    $time = $row['date'];
    array_push($mesures, $id);
    echo '<option value="'.$id.'">'.$time.'</option>';
}
?>
                   
                    </select>
                </form>
          
<!--Measure 2 dropdown-->
                <form>
                    <select id="soflow" name="users2" onchange="measure2(this.value); getavg2(this.value); getmax2(this.value);">
                        <?php 
$connection = mysqli_connect('mysql.metropolia.fi', 'juskam', 'password', 'juskam');
$sql = mysqli_query($connection, "SELECT date, measureID FROM measure");
$mesures = array();
echo '<option value="'."".'">'."Select measurement 2".'</option>';
while ($row = $sql->fetch_assoc()){
    $id = $row['measureID'];
    $time = $row['date'];
    array_push($mesures, $id);
    echo '<option value="'.$id.'">'.$time.'</option>';
}
?>
                    </select>
                </form>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
    </div>
  </div>
  



              
                <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
                <script>
                    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
                    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
                </script>
                <style>
                    .zc-ref {
                        display: none;
                    }
                    .center {
                        margin-left: 16px;
                        margin-right: 16px;
                        margin-top: -16px;

}
                </style>
                <div class="center">
                <div id='myChart'><a class="zc-ref" href="https://www.zingchart.com/">Charts by ZingChart</a></div>
                <script>
                    zingchart.THEME = "classic";
                </script>
                
                </div>

                <div id="txtHint"></div>
                
                
                
                           <?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
echo "<script type='text/javascript'>measure1($id); getavg($id); getmax1($id);</script>";
} else {
    $id = 0;
echo "<script type='text/javascript'>measure1($id)</script>";
}

?>
        