<?php
global $callresponseprefixinit;
$wpcrpref=$callresponseprefixinit;
$dname=get_option($wpcrpref.'name');$demail=get_option($wpcrpref.'email');$dnumber=get_option($wpcrpref.'number');$dmsg=get_option($wpcrpref.'msg');$dfrom=get_option($wpcrpref.'from');$dto=get_option($wpcrpref.'to');
?>
  <script type="text/javascript">
  jQuery(document).ready(
  function($)
  {
	  $(".tglform").hide();
       $(".tglbtn").click(function(){$(".tglform").toggle(500);document.getElementById("cllerr").innerHTML="";document.getElementById("tsuccess").innerHTML="";document.getElementById("cllrqstform").style.display="block";});
  });
  //call request submission using ajax
  function callRequst()
  {
	 <?php 
	 if($dname=='1')
		echo "var name=document.callrqst.name.value;";
     else
		echo "var name='Not Set';";
     if($demail=='1')
		echo "var email=document.callrqst.email.value;";
     else
		 echo "var email='Not Set';";
	 if($dnumber=='1')
		echo "var number=document.callrqst.number.value;";
	else
		echo "var number='Not Set';";
	if($dmsg=='1')
		echo "var msg=document.callrqst.msg.value;";
	else
		echo "var msg='Not Set';";
	if($dfrom=='1')
	    echo "var frm=document.callrqst.fromtime.value;";
	else
		 echo "var frm='Not Set';";
	 if($dto=='1')
	     echo "var to=document.callrqst.totime.value;";
     else
		 echo "var to='Not Set';";
	 ?>
	 document.getElementById("cllerr").innerHTML="Processing...";
	 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		var rspnstxt=this.responseText;
     if(rspnstxt.trim()=='1')
	      {
		 document.getElementById("tsuccess").innerHTML="Request Received";
		 document.getElementById("cllrqstform").style.display="none";
		 
		 document.getElementById("wpcrydtl").style.display="none";
		$(".tglform").hide(500);
		 
		  }
		 else
		 {
	      document.getElementById("cllerr").innerHTML=this.responseText;
		 }
    }
  };
  xhttp.open("POST", "<?php echo admin_url('admin-ajax.php'); ?>", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=cllrspncsubmitrqst&sbmtcll=1&name="+name+"&email="+email+"&number="+number+"&msg="+msg+"&frm="+frm+"&to="+to+"&cllrspncpwajxcsrf=<?php echo wp_create_nonce('cllrspncpwajxcsrf'); ?>");
  }
  
  </script>

<div class="active-form-wrap" style="right:0px;top:20%;position:fixed;">
	<form method="POST" action="" class="form cllrspns-form" name="callrqst">

		<div class="cllbtn bar-deactive" style="">
			<input type="button" class="tglbtn" value="<?php echo esc_attr(get_option($wpcrpref.'btn-txt')); ?>" style="background-color:<?php echo esc_attr(get_option($wpcrpref.'bgcolor')); ?>;color:white;font-size:15px;padding:10px;color;border:0px;">
			
		</div>

       <div class="tglform" style="border:1px solid <?php echo esc_attr(get_option($wpcrpref.'border-color')); ?>;background-color:white;padding:10px;min-height:185px;">
	   
	   
<p><b><center><span id="wpcrydtl">Your Detail</span></center></b></p>
<p id="tsuccess" style="width:90%;text-align:center;background-color:green;color:white;font-size:20px;border-radius:5px;margin-top:5px"></p>
<div class="form-group" id="cllrqstform">
<?php if($dname=='1'){ ?>
<input type="text" placeholder="Your Name" class="wpcr-form-control" name="name">
<?php } ?>
<?php if($demail=='1'){ ?>
<input type="text" placeholder="Your Email" class="wpcr-form-control" name="email">
<?php } ?>
<?php if($dnumber=='1'){ ?>
<input type="text" placeholder="Your Phone Number" class="wpcr-form-control" name="number">
<?php } ?>
<?php if($dmsg=='1'){ ?>
<textarea placeholder="Message" class="wpcr-form-control" style="width:100%" name="msg"></textarea>
<?php } ?>
<?php if($dfrom=='1'){ ?>
<b>From </b>
<?php echo wpcrtimepicker('fromtime'); ?>
<?php } ?>
<?php if($dto=='1'){ ?>
<b>To </b>
<?php echo wpcrtimepicker('totime'); ?>
<?php } ?>
<div id="cllerr" style="width:100%;text-align:center;background-color:#b30059;color:white;font-size:18px;border-radius:5px;margin-top:5px"></div>
<input type="button" class="wpcr-form-control" value="<?php echo esc_attr(get_option($wpcrpref.'sbmt-txt'));?>" style="width:100%;font-size:12px;background-color:<?php echo esc_attr(get_option($wpcrpref.'submit-color')); ?>;color:<?php echo esc_attr(get_option($wpcrpref.'text-color')); ?>;" name="sbmtcll" onclick="callRequst()">
</div>

</div>
           
		
	</form>
</div>
<style>
.active-form-wrap{
	
    z-index: 9999;
    
}
.cllrspns-form .cllbtn {
	cursor: pointer;
    position: absolute;
    transform-origin: 0 0;
    font-size: 16px;
    line-height: 34px;
    z-index: 1;
    display:block;
	
    color: #ffffff;
    left: 0;
    top: 0;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    -webkit-transform: rotate(-90deg) translate(-100%, -100%);
    transform: rotate(-90deg) translate(-100%, -100%);
    
}

</style>
<style>
select.wpcr{
padding:6px;
margin-top:5px;
line-height:1;
border-radius:5px;
font-size:15px;
-webkit-appearance:none;
outline:none
}
#cllrqstform .wpcr-form-control
{
	display:block;
	margin-bottom:5px;
	border:1px solid #8080ff;
	width:200px !important;
	min-height:30px;
	max-height:32px;
	border-radius:5px;
}
#cllrqstform textarea.wpcr-form-control
{
	min-height:50px;
	max-height:60px;
	resize:vertical;
}

@media only screen and (max-width:600px)
{
	.active-form-wrap .tglform
	{
		max-height:250px !important;
		overflow: auto;
		max-width:300px;
		min-width:180px;
	}
	#cllrqstform .wpcr-form-control
	{
		max-width:160px !important;
	}
	select.wpcr{padding:4px !important;margin-top:4px !important;}
}
</style>