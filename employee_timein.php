<?php date_default_timezone_set('Asia/Manila'); ?>
<html>
<head>
  <meta name="description" content="QR Code scanner" />
  <meta name="keywords" content="qrcode,qr code,scanner,barcode,javascript" />
  <meta name="robots" content="index, follow"/>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>CENPRI Timekeeping Web QR</title>
<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
<link type="text/css" href="css/bootstrap-grid.min.css" rel="stylesheet">
<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<script>
var d = new Date(<?php echo time() * 1000 ?>);
function digitalClock() {
    var today = new Date();
    
    const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(today)
    const mo = new Intl.DateTimeFormat('en', { month: 'long' }).format(today)
    const da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(today)

    var date = mo+' '+da+', '+ye;
  d.setTime(d.getTime() + 1000);
  var hrs = d.getHours();
  var mins = d.getMinutes();
  var secs = d.getSeconds();
  mins = (mins < 10 ? "0" : "") + mins;
  secs = (secs < 10 ? "0" : "") + secs;
  var apm = (hrs < 12) ? "AM" : "PM";
  hrs = (hrs > 12) ? hrs - 12 : hrs;
  hrs = (hrs == 0) ? 12 : hrs;
  var ctime = hrs + ":" + mins + ":" + secs + " " + apm;
  document.getElementById("clock").firstChild.nodeValue = date + ' ' + ctime;
}
window.onload = function() {
  digitalClock();
  setInterval('digitalClock()', 1000);
}
</script>
<style type="text/css">
body{
    width:100%;
    text-align:center;
    background-image: url(images/background1.jpg); 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 615px;
    overflow: hidden;
}
img{
    border:0;
}
#main{
    margin: 15px auto;
    background:white;
    overflow: auto;
    width: 100%;
    font-family: arial;
}
#header{
    background:white;
    margin-bottom:15px;
}
#mainbody{
    background: white;
    width:100%;
    display:none;
}
#footer{
    background:white;
}
#v{
    width:320px;
    height:240px;
}
#qr-canvas{
    display:none;
}
#qrfile{
    width:320px;
    height:240px;
}
#mp1{
    text-align:center;
    font-size:35px;
}
#imghelp{
    position:relative;
    left:0px;
    top:-160px;
    z-index:100;
    font:18px arial,sans-serif;
    background:#f0f0f0;
    margin-left:35px;
    margin-right:35px;
    padding-top:10px;
    padding-bottom:10px;
    border-radius:20px;
}
.selector{
    margin:0;
    padding:0;
    cursor:pointer;
    margin-bottom:-5px;
}
#outdiv
{
    width:320px;
    height:240px;
    border: solid;
    border-width: 3px 3px 3px 3px;
}
#result{
    border: solid;
    border-width: 1px 1px 1px 1px;
    padding:5px;
    width:65%;
    font-size: 18px;
    background: #ffffff36;
    border-radius: 10px;
    color: #fff;
}

ul{
    margin-bottom:0;
    margin-right:40px;
}
li{
    display:inline;
    padding-right: 0.5em;
    padding-left: 0.5em;
    font-weight: bold;
    border-right: 1px solid #333333;
}
li a{
    text-decoration: none;
    color: black;
}


#footer a{
    color: black;
}
.tsel{
    padding:0;
}

</style>
 <script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/llqrcode.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="scripts/webqr.js"></script>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24451557-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>

<body>
    <div class="container">
        <div style="margin-top:150px"></div>
        <div class="row">
            <div class="col-lg-6">
                <div style="position:relative;top:+20px;left:0px;"><g:plusone size="medium"></g:plusone></div>
                <div style="margin-top: 80px"></div>
                <center>
                    <h1 class="text-white" style="font-size: 100px">CENPRI</h1>
                    <p class="text-white" id="mp1" style="line-height: 10px">
                     Online Timekeeping
                    </p>
                    <br>
                    <div id="clock" style='font-size:24px; font-weight:bold; color:#fff'> </div>
                  
                    <div id='msg'></div>    
                    <ul></ul> 
                </center>  
               
            </div>
            <div class="col-lg-6">
                <div id="mainbody">
                    <table class="tsel" border="0" width="100%">
                        <tr>
                            <td valign="top" align="center" width="50%">
                                <table class="tsel" border="0">
                                    <tr>
                                        <td>
                                            <button onclick="setwebcam()" id="webcamimg" align="left" class="btn btn-link text-white" style="border:1px solid #fff">
                                                <span class="fa fa-video-camera"></span>
                                            </button>
                                        </td>
                                        <td  align="right">
                                            <button onclick="setimg()" id="qrimg"  class="btn btn-link text-white" style="border:1px solid #fff">
                                                <span class="fa fa-camera"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div style="margin: 5px"></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                        <div id="outdiv">
                                        </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center">
                                <span class="fa fa-caret-down"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center">
                                <div id="result"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
<canvas id="qr-canvas" width="800" height="600"></canvas>
<script type="text/javascript">load();</script>
</body>

</html>
