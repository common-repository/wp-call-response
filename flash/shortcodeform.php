<?php
if(!function_exists('wpcrShortcodeTemplate'))
{
function wpcrShortcodeTemplate()
{
global $callresponseprefixinit;
$wpcrpref=$callresponseprefixinit;
$dname=get_option($wpcrpref.'name');$demail=get_option($wpcrpref.'email');$dnumber=get_option($wpcrpref.'number');$dmsg=get_option($wpcrpref.'msg');$dfrom=get_option($wpcrpref.'from');$dto=get_option($wpcrpref.'to');
$script='<script type="text/javascript">
  function callRequstForShortcode()
  {'; 
	 if($dname=='1')
	 {
		$script.="var name=document.scallrqst.name.value;";
	 }
     else
	 {
		$script.="var name='Not Set';";
	 }
     if($demail=='1')
	 {
		$script.="var email=document.scallrqst.email.value;";
	 }
     else
	 {
		 $script.="var email='Not Set';";
	 }
	 if($dnumber=='1')
	 {
		$script.="var number=document.scallrqst.number.value;";
	 }
	else
	{
		$script.="var number='Not Set';";
	}
	if($dmsg=='1')
	{
		$script.="var msg=document.scallrqst.msg.value;";
	}
	else
	{
		$script.= "var msg='Not Set';";
	}
	if($dfrom=='1')
	{
	   $script.= "var frm=document.scallrqst.fromtime.value;";
	}
	else
	{
		$script.="var frm='Not Set';";
	}
	 if($dto=='1')
	 {
	    $script.="var to=document.scallrqst.totime.value;";
	 }
     else
	 {
		 $script.="var to='Not Set';";
	 }
	 $script.='document.getElementById("scllerr").innerHTML="Processing...";
	 var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
		var reqresponse=this.responseText;
     if(reqresponse.trim()=="1")
	      {
		 document.getElementById("wpcrssuccess").innerHTML="Request Received";
		 document.getElementById("scllrqstform").style.display="none";
		  }
		 else
		 {
	      document.getElementById("scllerr").innerHTML=this.responseText;
		 }
    }
  };
  xhttp.open("POST", "'.admin_url('admin-ajax.php').'", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("action=cllrspncsubmitrqst&sbmtcll=1&name="+name+"&email="+email+"&number="+number+"&msg="+msg+"&frm="+frm+"&to="+to+"&cllrspncpwajxcsrf='.wp_create_nonce('cllrspncpwajxcsrf').'");}
  function mfluxshowboxwpcr(){document.getElementById("myMfThmbnlImgModalwpcr").style.display="none";}
  function displayWpcrPopup(){document.getElementById("myMfThmbnlImgModalwpcr").style.display="block";
document.getElementById("scllrqstform").style.display="block";document.getElementById("scllerr").innerHTML="";document.getElementById("wpcrssuccess").innerHTML="";}
</script>';

if (!filter_var(get_option($wpcrpref.'avatar'), FILTER_VALIDATE_URL))
{
$body='<button type="button" class="btn-swpcr" onclick="displayWpcrPopup()" style="max-width:fit-content;border:0px;border-radius:4px;background-color: '.esc_html(get_option($wpcrpref."shortcode-button-color")).';color:'.esc_html(get_option($wpcrpref.'shortcode-button-text-color')).'">'.esc_html(get_option($wpcrpref."scode-txt")).' </button>';
}
else
{
$body='<button type="button" class="btn-swpcr"  onclick="displayWpcrPopup()" style="max-width:fit-content;border-radius:50px;background-color:'.esc_html(get_option($wpcrpref."shortcode-button-color")).';color:'.esc_html(get_option($wpcrpref."shortcode-button-text-color")).';"><table><tr><td><img src="'.esc_url(get_option($wpcrpref."avatar")).'" style="max-height:50px;max-width:40px;border-radius:50%;border:2px solid white"></td><td> <span style="color:'.esc_html(get_option($wpcrpref."shortcode-button-text-color")).';margin-left:4px;"> '.esc_html(get_option($wpcrpref."scode-txt")).'</span></td></tr></table></button>';
}

$body.='<div id="myMfThmbnlImgModalwpcr" style="" class="mflux-main-classwpcr">
<div class=""><div class="mflux-contentwpcr"><span onclick="mfluxshowboxwpcr();" class="mfluxpopup-closewpcr">&times;</span><h4 class="" id="mfpopuptitlewpcr">Fill out the form below .</h4><hr><div class="mfluxbodywpcr" id="mfpopupbodywpcr"><p><form method="POST" action="" class="form cllrspns-form" name="scallrqst"><div class="callresponse" style="margin-left:8%;"><p id="wpcrssuccess" style="width:90%;text-align:center;background-color:green;color:white;font-size:20px;border-radius:5px;margin-top:5px"></p><div class="form-group-swpcr" id="scllrqstform">';
if($dname=='1'){
$body.='<input type="text" placeholder="Your Name" class="form-control-swpcr" name="name">';
 } 
if($demail=='1'){
$body.='<input type="text" placeholder="Your Email" class="form-control-swpcr" name="email">';
}
if($dnumber=='1'){ 
$body.='<input type="text" placeholder="Your Phone Number" class="form-control-swpcr" name="number">';
}
if($dmsg=='1'){
$body.='<textarea placeholder="Message" class="form-control-swpcr" name="msg"></textarea>';
}
if($dfrom=='1'){
$body.='<br><label>From </label>';
$body.=wpcrtimepicker('fromtime');
} 
if($dto=='1'){
$body.='<b>To </b>';
$body.=wpcrtimepicker('totime');
}
$body.='<div id="scllerr" style="width:90%;text-align:center;background-color:#b30059;color:white;font-size:18px;border-radius:5px;margin-top:5px"></div><input type="button" value="'.esc_attr(get_option($wpcrpref.'sbmt-txt')).'"  class="btn btn-info-swpcr" style="width:90%;font-size:15px;color:'.esc_attr(get_option($wpcrpref.'submit-text-color')).';background-color:'.esc_attr(get_option($wpcrpref.'submit-color')).';min-height:30px;border:0px;border-radius:5px;margin-top:2px;" name="sbmtcll" onclick="callRequstForShortcode()"></div></div><style>.callresponse .form-group-swpcr .form-control-swpcr{width:90%;margin-bottom:12px}.callresponse .form-group-swpcr textarea{max-width:90%;max-height:80px;margin-bottom:12px;resize:vertical;}</style></form></p></div></div></div></div>';
$style="<style>
select.wpcr{
padding:12px;
margin-top:8px;
line-height:1;
border-radius:5px;
font-size:15px;
-webkit-appearance:none;
outline:none;
}
.form-control-swpcr
{
	border:1px solid #8080ff !important;
	border-radius:5px;
	min-height:30px;
	max-height:32px;
	width:100%;
}
.btn-swpcr
{
	min-height:50px;
	text-align:center;
	vertical-align:middle;
	border:0px;
}
.mflux-main-classwpcr select.wpcr{display:block;width:90% !important;}
@media only screen and (max-width:1200px)
{
.mflux-contentwpcr
{
	max-height:400px !important;
	overflow:auto;
}
}
@media only screen and (max-width:600px)
{
.mflux-contentwpcr
{
	max-height:300px !important;
	overflow:auto;
}
}
h4#mfpopuptitlewpcr {
    padding: 0px;
}
.btn-swpcr table,.btn-swpcr tr,.btn-swpcr td{padding:0px !important;border:0px !important;margin:0px !important;}
</style>";

return $script.$body.$style;
}
}
?>