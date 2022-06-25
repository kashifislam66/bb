<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>HRIS360</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="erp" />
<base href="<?= base_url('/');?>">
<style>:root { --whr-th: #0c64ae; --whr-th2: #07426c; --whr-th3: #cbe2f6; --whr-or: left; --whr-or2: right; } .mfp-wrap{ z-index: 9043 !important; } #ui-datepicker-div{z-index: 9046 !important;} .select2-dropdown { z-index:10000 !important; }</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="<?= base_url();?>/public/assets/kiosk/whr_1_4.css" type="text/css" rel="stylesheet">
<link href="<?= base_url();?>/public/assets/kiosk/whr_ltr.css" type="text/css" rel="stylesheet">
<link href="<?= base_url();?>/public/assets/kiosk/whr_cs_lib1.css" type="text/css" rel="stylesheet">
<link href="<?= base_url();?>/public/assets/kiosk/whr_lib2.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url();?>/public/assets/kiosk/whr_lib1_v1.css">
<link rel="stylesheet" href="<?= base_url();?>/public/assets/kiosk/whr_lib2_v1.css">
<link rel="stylesheet" href="<?= base_url();?>/public/assets/kiosk/whr_fc_v1.css">

<link rel="stylesheet" href="<?= base_url('public/assets/plugins/toastr/toastr.css');?>">
<link rel="stylesheet" href="<?= base_url();?>/public/assets/plugins/jquery-ui/jquery-ui.css">


<script type="text/javascript">
  var base_url = '<?= base_url('/');?>';
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="<?= base_url();?>/public/assets/plugins/toastr/toastr.js"></script>
<style type="text/css">
.kiosk-logo img{
   width: 90px;
   margin-top: -8px;
}
#logo-text {
  font-size: 30px;
}
.WebFont1{
  background-color:#fff; 
  border:1px solid #dedede; 
  border-radius:5px; 
  font-size:40px;
}
.WebFont2{
  background-color:#fff; 
  width: 100%; 
  border:1px solid #dedede; 
  border-radius:5px; 
  font-size:40px !important;
  width: 100%;
  background-color: #fff;
  display: block;
  height: 63px;
}
.active_digit{
  background-color: #7FD6F3 !important; 
}
.siSo a{
  width: 98%;
  font-size: 28px;
  color: white;
}
</style>

<script type="text/javascript">
$(document).ready(function(){

var kiosk_code = [];
$(document).on('click', '.all_digits', function (e) {
  var num = $(this).attr('rel');
  kiosk_code.push(num);
  $("#kiosk_code").val(kiosk_code);
  $(this).children(".WebFont1").addClass("active_digit");
  console.log(kiosk_code);
});

$(document).on('click', '.sign_in_out', function (e) {
  var val = $(this).attr("rel");
  if(val==''){
    swal({
      title: "Warning",
      text: "Please enter a valid code.",
      icon: "error",
      button: "Ok",
    });
    return false;
  }
  $("#clock_state").val(val);
  var kioskCode = '';
  $.each(kiosk_code, function(index, value){
      kioskCode = kioskCode+value;
  });
  if(kioskCode==''){
    swal({
      title: "Warning",
      text: "Please enter a valid code.",
      icon: "error",
      button: "Ok",
    });
    return false;
  }
  $("#kiosk_code").val(kioskCode);
  kiosk_code = [];
  $(".all_digits").children(".WebFont1").removeClass("active_digit");
  console.log(kioskCode);
  var formData = $("#hr_clocking").serializeArray();
  $.ajax({
    url:base_url + "/kiosk/set_clocking",
    type: "POST",
    data: formData,
    dataType: "json",
    success: function(data) {
      if(data.signed_in){
          swal({
            icon: "success",
            text: "You are signed in successfully."
          }).then((value) => {
              location.reload(); 
          });
      }
      else if(data.signed_out){
          swal({
            icon: "success",
            text: "You are signed out successfully."
          }).then((value) => {
              location.reload(); 
          });
      }
      else if (data.error != '') {
          toastr.error(data.error);
          // setTimeout(function() {
          //     location.reload();
          // }, 3000);
      } else {
          toastr.success(data.result);
          //window.location = '';
      }
    }
  });
});

});
</script>

</head>
<body style="" id="whtop" class="pace-done pace-running ">

<div class="whbodyinner" id="divMain"></div>
<div style="height:90px; padding:10px; border-bottom:2px solid #dedede; background-color:#fff;">
<div class="kiosk-logo">
	<img src="<?= base_url();?>/public/uploads/logo/Color logo - no words (1).png"><span id="logo-text">HRIS360</span>
</div>
</div>
<div style="background:url(<?= base_url();?>/public/assets/kiosk/bg.png); min-height:600px;">
<div align="center"></div>
<div style="height:60px;"></div>
<div class="container-fluid"><div class="row">
<div class="col-md-6" align="center">
<div style="width:500px;">
<div>
<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
<tbody>
<tr>
	<td style="width:33%;" align="center">
		<a href="javascript::" class="all_digits" style="text-decoration:none;" rel='1'><div class="WebFont1">1</div>
		</a>
	</td>
	<td style="width:33%;" align="center">
		<a href="javascript::" class="all_digits" style="text-decoration:none;" rel='2'><div class="WebFont1">2</div>
		</a>
	</td>
	<td style="width:33%;" align="center">
		<a href="javascript::" class="all_digits" style="text-decoration:none;" rel='3'><div class="WebFont1">3</div>
		</a>
	</td>
</tr>
<tr>
<td align="center"><a href="javascript::" class="all_digits" style="text-decoration:none;" rel='4'>
	<div class="WebFont1">4</div></a>
</td>
<td align="center"><a href="javascript::" class="all_digits" style="text-decoration:none;" rel='5'><div class="WebFont1">5</div></a></td>
<td align="center"><a href="javascript::" class="all_digits" style="text-decoration:none;" rel='6'><div class="WebFont1">6</div></a></td>
</tr>
<tr>
<td align="center"><a href="javascript::" class="all_digits" style="text-decoration:none;" rel='7'><div class="WebFont1">7</div></a></td>
<td align="center"><a href="javascript::" class="all_digits" style="text-decoration:none;" rel='8'><div class="WebFont1">8</div></a></td>
<td align="center"><a href="javascript::" class="all_digits" style="text-decoration:none;" rel='9'><div class="WebFont1">9</div></a></td>
</tr>
<tr>
<td align="center"><a href="javascript::" class="all_digits" style="text-decoration:none;" rel='0'><div class="WebFont1">0</div></a></td>
<!-- <td colspan="2" align="center"><a href="javascript::" class="WebFont2" style="text-decoration:none;" id="BarcodeTimeClockEnterButton">
	ENTER</a>
</td> -->
</tr>
</tbody>
</table>
</div>
<div style="height:auto;margin-top: 10px;">
  <div class="row">
    <div class="col-sm-6 siSo">
      <a href="javascript::" class="btn btn-info sign_in_out" rel="clock_in">Sign In</a>
    </div>
    <div class="col-sm-6 siSo">
      <a href="javascript::" class="btn btn-warning sign_in_out" rel="clock_out">Sign Out</a>
    </div>
  </div>
</div>

<form id="hr_clocking">
<div style="margin-top:10px;">
  <br><br>
  <input type="hidden" id="clock_state" name="clock_state" value="">
  <input type="hidden" id="kiosk_code" name="kiosk_code" value="">
</div>
</form>

<!-- <div style="margin-top:20px;" class="form-group has-feedback">
<label class="control-label" for="bc"></label>
<input type="password" class="form-control WebFont1" id="bc" style="height:72px;" placeholder="Scan your Barcode / RFID..." autocomplete="off">
</div> -->
</div>
</div>
<div class="col-md-6" align="center">
<div id="divClock">
<div style="width:300px;" align="left">
<style>
#clock { }
#a { width:10.0em; height:10.0em; position:relative; border-radius:5.0em; background:#ccc; box-shadow: inset 0.05em -0.05em 0 #333, inset 0.17em -0.17em 0 #555, inset -0.03em -0.04em 0 #333, inset -0.03em 0.02em 0 #333, inset -0.1em -0.1em 0 #555, 0.1em 0.3em 0.2em rgba(0,0,0,0.3); }
#b { width:9.4em; height:9.4em; top:0.3em; left:0.3em; position:relative; border-radius:4.7em; background:#fff; box-shadow: inset 0.04em 0 0 #fff, inset 0 -0.06em 0 #ddd, inset 0.16em -0.08em 0 #222, inset -0.16em 0.08em 0 #222, inset 0.2em 0.2em 0 #222, 0.06em -0.03em 0 #999, -0.1em 0.1em 0 #777, -0.13em -0.2em 0 #fff, 0.13em 0.2em 0 #222, 0.13em 0.3em 0 #333; /*ccc*/ }
#c { width:8.9em; height:8.9em; top:0.25em; left:0.25em; position:relative; border-radius:4.45em; background:#eed;/*f4f5f6;*/ box-shadow: inset 0.15em 0.2em 0.05em rgba(0,0,0,0.4), inset 0.2em 0.4em 0.2em rgba(0,0,0,0.3), inset 0 0.05em 0.3em rgba(0,0,0,0.1), -0.16em 0.08em 0 #444, 0.16em -0.08em 0 #444; } 
#d { width:8.8em; height:8.8em; top:0.05em; left:0.05em; position:relative; border-radius:4.4em; } 
#e { width:8.18em; height:8.18em; padding-top:4.09em; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; left:0.29em; top:0.29em; position:absolute; border:solid 0.04em rgba(0,0,0,0.5); border-radius:4.09em; }
#ii { padding-left:4.34em; position:absolute; }
b, i { height:8.2em; position:absolute; display:block; }
b { border:solid 0 #222; border-width:0.3em 0; width:0.12em; }
i { border:solid 0 rgba(0,0,0,0.5); border-width:0.3em 0; width:0.04em; }
b>i,i>i { transform:rotate(6deg) ; margin-top:-0.3em; }
b>b  { transform:rotate(30deg); margin-top:-0.3em; } 
b>i { left:0.03em; }
#f,#g { font:1.2em/1.0em WallClock, sans-serif; text-align:center; width:6.8em; color:#222; }
#g>u>u { letter-spacing:0.1em; }
#g>u>u>u { letter-spacing:0; }
u { display:block; line-height:1em; text-decoration: none; }
u>u>u>u { margin:0.5em -0.55em; padding: 0 0.05em; }
u>u>u { margin:0.0em -1.75em; padding: 0 0.7em; }
u>u { margin:-0.55em 0; text-align:right; padding: 0 1.65em; }
#f { margin-top:-3.37em; }
#g { margin-top:-6em; }
#g u>u { text-align:left; }
#q { font:0.22em/1em Segoe UI,Helvetica,sans-serif; text-align:center; margin-top:-11.5em; color:#555; }
.ss, .mm, .hh { width:8.0em; height:8.0em; top:0.4em; left:0.4em; position:absolute; }
.hh { transform:rotate(-55deg); }
.mm { transform:rotate(60deg); }
.ss { animation: tick 1s normal infinite steps(25,end); }
@keyframes tick { 0% { transform: rotate(0deg); } 12% { transform:rotate(6deg); } 100% { transform: rotate(6deg); } }
.s { width:0.1em; height:4.8em; top:0.6em; left:3.95em; position:relative; background:#a00; outline: 1px solid transparent; animation: a360_10 60s normal infinite steps(60,end); }
.sr { width:0.3em;
height:0.3em;
background:#a00;
margin:-0.95em 0 0 3.84em;
border-radius:0.15em;
}
@keyframes a360_10  {
0% { transform: translate(0, 1.0em) rotate(0deg) translate(0,-1.0em) }
100% { transform: translate(0, 1.0em) rotate(360deg) translate(0,-1.0em) }
}

.m { height:4.8em; left:3.89em; width:0.22em; position:relative; background:#222; border:0 0 3.2em 0; animation: a36016 3600s normal infinite linear; outline: 1px solid transparent; }
@keyframes a36016 { 0% { transform: translate(0, 1.6em) rotate(0deg) translate(0,-1.6em); } 100% { transform: translate(0, 1.6em) rotate(360deg) translate(0,-1.6em); } }
.mr { width:0.5em; height:0.5em; background:#222; margin:-1.05em 0 0 3.74em; border-radius:0.25em; } 
.h { width:0.3em; height:3.4em; left:3.85em; position:relative; background:#222; margin-top:1.3em; outline: 1px solid transparent; animation: a36010 43200s normal infinite linear; }
#sh { width:8.0em; height:8.0em; top:0.2em; left:0.1em; position:absolute; /*display:none;*/ }
#sh .s, #sh .m, #sh .h, #sh .mr  { background:#ddc; box-shadow:0 0 0.05em #ddc, 0 0 0.025em #ddc; }
#k { width:8.8em; height:8.8em; position:absolute; border-radius:4.4em; box-shadow:inset 0.45em 0.9em 0.05em rgba(250,252,253,0.2); }
/* Vendor CSS prefixes */
#clock { -webkit-transition: all 0.5s ease; -moz-transition: all 0.5s ease; -o-transition: all 0.5s ease; }
#clock b>i, #clock i>i { -ms-transform:rotate(6deg); -webkit-transform:rotate(6deg); }
#clock b>b { -ms-transform:rotate(30deg); -webkit-transform:rotate(30deg); }
#clock .hh { -webkit-transform:rotate(-55deg); }
#clock .mm { -webkit-transform:rotate(60deg); }
#clock .ss { -webkit-animation: tick 1s normal infinite steps(25,end); }
@-webkit-keyframes tick { 0% { -webkit-transform: rotate(0deg); } 12% { -webkit-transform:rotate(6deg); } 100% { -webkit-transform: rotate(6deg); } }
#clock .s { -webkit-animation: a360_10 60s normal infinite steps(60,end); }
@-webkit-keyframes a360_10 {
0% { -webkit-transform: translate(0, 1.0em) rotate(0deg) translate(0,-1.0em) }
100% { -webkit-transform: translate(0, 1.0em) rotate(360deg) translate(0,-1.0em) }
}
#clock .m {
-webkit-animation: a36016 3600s normal infinite linear;
}
@-webkit-keyframes a36016 {
0% { -webkit-transform: translate(0, 1.6em) rotate(0deg) translate(0,-1.6em); }
50% { -webkit-transform: translate(0, 1.6em) rotate(180deg) translate(0,-1.6em); }
100% { -webkit-transform: translate(0, 1.6em) rotate(360deg) translate(0,-1.6em); }
}
#clock .h,
#css3fixed:checked ~ #clock .hh {
-webkit-animation: a36010 43200s normal infinite linear;
}

/* Fixes */

#clock { transition:none; -webkit-transition: none; -moz-transition: none; -o-transition: none; }
#clock b:nth-child(2) { transform:rotate(30deg); -ms-transform:rotate(30deg); -webkit-transform:rotate(30deg); }
#clock b:nth-child(3) { transform:rotate(60deg); -ms-transform:rotate(60deg); -webkit-transform:rotate(60deg); }
#clock b:nth-child(4) { transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg); }
#clock b:nth-child(5) { transform:rotate(120deg); -ms-transform:rotate(120deg); -webkit-transform:rotate(120deg); }
#clock b:nth-child(6) { transform:rotate(150deg); -ms-transform:rotate(150deg); -webkit-transform:rotate(150deg); }
#clock i:nth-child(1) { transform:rotate(12deg); -ms-transform:rotate(12deg); -webkit-transform:rotate(12deg); }
#clock i:nth-child(2) { transform:rotate(18deg); -ms-transform:rotate(18deg); -webkit-transform:rotate(18deg); }
#clock i:nth-child(3) { transform:rotate(24deg); -ms-transform:rotate(24deg); -webkit-transform:rotate(24deg); }
#clock #f { -webkit-transform:translate(0,0.05em); }
/* IE10 fix */
@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) { #css3fixed:checked ~  #clock i, #css3fixed:checked ~  #clock b { border-left:solid 0px #fff; border-right:solid 0px #fff; }
}
/* Opera rotation fix */
#clock .s { animation: a360_10of 60s normal infinite steps(60,end); }
@keyframes a360_10of { 0% {  transform: translate(0, 1.0em) rotate(0deg) translate(0,-1.0em); -o-transform: translate(0, 2em) rotate(0deg) translate(0,-2em) } 100% { transform: translate(0, 1.0em) rotate(360deg) translate(0,-1.0em); -o-transform: translate(0, 2em) rotate(360deg) translate(0,-2em) } }

/*** Font for numbers ***/
@font-face { font-family: "WallClock"; asrc: url("wallclock.eot"); }
@font-face { font-family: "WallClock"; src: url(data:font/otf;charset=utf-8;base64,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) format("opentype"); font-weight: normal; font-style: normal; }
#clock { font-size:30px; }

</style>
<div id="clock">
<div id="a">
<div id="b">
<div id="c">
<div id="d">
<div id="sh">
<div class="hh" style="transform: rotate(319deg);"><div class="h"></div></div>
<div class="mm" style="transform: rotate(228deg);">
<div class="m"></div>
<div class="mr"></div>
</div>
<div class="ss">
<div class="s"></div>
</div>
</div>
<div id="ii">
<b><i></i><i></i><i></i><i></i></b>
<b><i></i><i></i><i></i><i></i></b>
<b><i></i><i></i><i></i><i></i></b>
<b><i></i><i></i><i></i><i></i></b>
<b><i></i><i></i><i></i><i></i></b>
<b><i></i><i></i><i></i><i></i></b>
</div>
<div id="e">
<div id="f"><u>12<u>1<u>2<u>3</u>4</u>5</u></u></div>
<div id="g"><u><u>11<u>10<u>9</u>8</u>7</u>6</u></div>
<div id="q"><a href="" style="position:relative;z-index:1000;color:#222;text-decoration:none;">HRIS360</a></div>
</div>
<div class="hh" style="transform: rotate(319deg);"><div class="h"></div></div>
<div class="mm" style="transform: rotate(228deg);"><div class="m"></div><div class="mr"></div></div>
<div class="ss"><div class="s"></div><div class="sr"></div></div>
<div id="k"></div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
		var hour_as_degree = ( 10 + 38/60 ) / 12 * 360;
		var minute_as_degree = 38 / 60 * 360;
		
		$("#clock div.hh").css({transform: "rotate(" + hour_as_degree + "deg)"});
		$("#clock div.mm").css({transform: "rotate(" + minute_as_degree + "deg)"});
</script>
</div>
<br>
<div class="WebFont1" style="font-size: 32px;display: inline-block; padding: 5px 30px 5px 30px;" align="center"><?php echo date('l, F d Y');?></div>
</div>
</div>
</div></div>
<div style="height:40px; clear:both;"></div>
</div>
<div id="divExecute"></div>
<div id="GetPresentAbsentEmp" style="width: 88%; margin: 0 auto;">
<div class="row">
<div class="col-md-12">
<div class="container-fluid">
	<div class="row">
         <div class="col-md-6 WebHR_Title2" align="center">Present Employees (<?php echo count($present_employees)?>)<br>
         	<div style="width:120px;">
         		<div style="font-size:120px;" class="c100 p<?php echo $present_percentage;?> medium"><span><?php echo $present_percentage;?>%</span>
         			<div style="font-size:120px;;" class="pb_slice">
         				<div style="font-size:120px;" class="pb_bar"></div>
         				<div style="font-size:120px;" class="pb_fill"></div>
         			</div>
         		</div>
         		<div style="clear:both;"></div>
         	</div>
         	<table style="width:100%;" id="tWebHR">
         		<tbody>
            <?php foreach ($present_employees as $key => $value) { ?>
           		<tr>
  						<td><?php echo $value['first_name'].' '.$value['last_name'];?></td>
  						<td align="right">
                <div style="font-size:11px;" class="badge bg-primary">
                <?php echo date('h:i A', strtotime(date($value['sign_in_time'])));;?>
                </div></td>
  		        </tr>
            <?php } ?>
		        </tbody>
		    </table>
		</div>
<div class="col-md-6 WebHR_Title2" align="center">Absent Employees (<?php echo count($absent_employees)?>)<br>
	<div style="width:120px;">
		<div style="font-size:120px;;" class="c100 p<?php echo $absent_percentage;?> medium"><span><?php echo $absent_percentage;?>%</span>
			<div style="font-size:120px;" class="pb_slice">
				<div style="font-size:120px;" class="pb_bar"></div>
				<div style="font-size:120px;" class="pb_fill"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<table style="width:100%;" id="tWebHR">
		<tbody>
      <?php foreach ($absent_employees as $key => $value) { ?>
			<tr>
				<td><?php echo $value['first_name'].' '.$value['last_name'];?></td>
			</tr>
      <?php } ?>
		</tbody>
	</table><br>
	<!-- <table style="width:100%;" id="tWebHR">
        <tbody>
        	<tr>
        		<td colspan="2">
        			<div class="WebHR_Title2">Employees On Leave</div>
        		</td>
        	</tr>
            <tr><td>Vanessa-Lynn Danes [vldanes]</td></tr>
        </tbody>
    </table><br> -->
    <!-- <table style="width:100%;" id="tWebHR">
        <tbody>
        	<tr><td colspan="2"><div class="WebHR_Title2">Employees On Travel</div></td></tr>
        </tbody>
    </table><br>
    <table style="width:100%;" id="tWebHR">
        <tbody>
        	<tr><td colspan="2"><div class="WebHR_Title2">Employees On Specific Day Off</div></td></tr>
        </tbody>
    </table><br> -->
</div>
</div></div>
</div></div>
</div>

<div class="whrf">
©&nbsp;2022 - <a href="javascript::" target="_blank">HIRS360</a>&nbsp;-&nbsp;
<!-- <a href="https://webhr.co/termsconditions.php" target="_blank">Terms &amp; Conditions</a>&nbsp;|&nbsp;
<a href="https://webhr.co/privacy.php" target="_blank">Privacy Policy</a>&nbsp;|&nbsp;
<a href="https://webhr.co/contact.php" target="_blank">Contact Us</a> -->
</div>
<link href="<?= base_url();?>/public/assets/kiosk/2.css" rel="stylesheet">
<link href="<?= base_url();?>/public/assets/kiosk/main.css" rel="stylesheet">
<script src="<?= base_url();?>/public/assets/kiosk/2.js" type="text/javascript"></script>
<script src="<?= base_url();?>/public/assets/kiosk/3.js" type="text/javascript"></script>
<script src="<?= base_url();?>/public/assets/kiosk/main.js" type="text/javascript"></script>

</body></html>