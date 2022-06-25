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
<body style="" id="whtop" class="pace-done pace-running " onload="initClock()">

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
<style type="text/css">
.datetime{
  color: #fff;
  background: #10101E;
  font-family: "Segoe UI", sans-serif;
  width: 340px;
  padding: 15px 10px;
  border: 3px solid #2E94E3;
  border-radius: 5px;
  -webkit-box-reflect: below 1px linear-gradient(transparent, rgba(255, 255, 255, 0.1));
  transition: 0.5s;
  transition-property: background, box-shadow;
}

.datetime{
  background: #2E94E3;
  box-shadow: 0 0 30px #2E94E3;
}

.date{
  font-size: 20px;
  font-weight: 600;
  text-align: center;
  letter-spacing: 3px;
}

.time{
  font-size: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.time span:not(:last-child){
  position: relative;
  margin: 0 6px;
  font-weight: 600;
  text-align: center;
  letter-spacing: 3px;
}

.time span:last-child{
  background: #2E94E3;
  font-size: 30px;
  font-weight: 600;
  text-transform: uppercase;
  margin-top: 10px;
  padding: 0 5px;
  border-radius: 3px;
}
#divClock {
  margin: 27px 0px 0px 0px;
}
</style>
<script type="text/javascript">
    function updateClock(){
      var now = new Date();

      //now.toLocaleString('en-US', { timeZone: "<?php echo date_default_timezone_get();?>"});
      var dname = now.getDay(),
          mo = now.getMonth(),
          dnum = now.getDate(),
          yr = now.getFullYear(),
          hou = now.getHours(),
          min = now.getMinutes(),
          sec = now.getSeconds(),
          pe = "AM";
      
          if(hou >= 12){
            pe = "PM";
          }
          if(hou == 0){
            hou = 12;
          }
          if(hou > 12){
            hou = hou - 12;
          }
          Number.prototype.pad = function(digits){
            for(var n = this.toString(); n.length < digits; n = 0 + n);
            return n;
          }
          var months = ["January", "February", "March", "April", "May", "June", "July", "Augest", "September", "October", "November", "December"];
          var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
          var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
          var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
          for(var i = 0; i < ids.length; i++)
          document.getElementById(ids[i]).firstChild.nodeValue = values[i];
    }
    function initClock(){
      updateClock();
      window.setInterval("updateClock()", 1);
    }
    </script>
<div class="col-md-6" align="center">
<div id="divClock">
<div>

<!--digital clock start-->
    <div class="datetime">
      <div class="date">
        <span id="dayname">Day</span>,
        <span id="month">Month</span>
        <span id="daynum">00</span>,
        <span id="year">Year</span>
      </div>
      <div class="time">
        <span id="hour">00</span>:
        <span id="minutes">00</span>:
        <span id="seconds">00</span>
        <span id="period">AM</span>
      </div>
    </div>
    <!--digital clock end-->

</div>
<br>
<!-- <div class="WebFont1" style="font-size: 32px;display: inline-block; padding: 5px 30px 5px 30px;" align="center"><?php echo date('l, F d Y');?></div> -->
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