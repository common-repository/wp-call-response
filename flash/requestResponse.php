<?php
$cllrspncwpcsrfvalid=false;
if(isset($_POST['cllrspncpwajxcsrf'])&& wp_verify_nonce($_POST['cllrspncpwajxcsrf'],'cllrspncpwajxcsrf'))
{
	$cllrspncwpcsrfvalid=true;
}
global $callresponseprefixinit;
if(isset($_POST['sbmtcll']) && $cllrspncwpcsrfvalid)
{
$wpcrpref=$callresponseprefixinit;
$dname=get_option($wpcrpref.'name');$demail=get_option($wpcrpref.'email');$dnumber=get_option($wpcrpref.'number');$dmsg=get_option($wpcrpref.'msg');$dfrom=get_option($wpcrpref.'from');$dto=get_option($wpcrpref.'to');

	$name=sanitize_text_field($_POST['name']);
	$email=sanitize_email($_POST['email']);
	$phone=sanitize_text_field($_POST['number']);
	$msg=sanitize_textarea_field($_POST['msg']);
	$from=sanitize_text_field($_POST['frm']);
	$to=sanitize_text_field($_POST['to']);
	
	if((!preg_match("/^[a-zA-Z ]*$/",$name)|| strlen($name)<2) && $dname=='1')
	{echo "Invalid Name";}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && $demail=='1')
	{
	echo "Invalid Email Id";	
	}
	else if((!is_numeric($phone)||strlen($phone)<10)&& $dnumber=='1')
	{
		echo "Invalid Number";
	}
	else if(strlen($msg)<1)
	{
		echo "Invalid Message";
	}
	else if(strlen($from)<4 && $dfrom=='1')
	{
		echo "Please Enter a valid Time";
	}
	else if(strlen($to)<4 && $dto=='1')
	{
		echo "Please Enter a valid Time";
	}
	else
	{
		$date=date("d-m-y");
		global $wpdb;
		$table=$wpdb->prefix."cll_response_records";
		$in=$wpdb->query($wpdb->prepare("insert into ".$table."(id,name,email,number,ip, comment,frmtime,totime,recorded,action)values(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s)",array('',$name,$email,$phone,'1',$msg,$from,$to,$date,'0')));
		if($in)
		{
			echo '1';
			$wpcremail=get_option($callresponseprefixinit.'email-notification');
			if($wpcremail=='1')
			{
				$wpcrmailheaders = "MIME-Version: 1.0" . "\r\n";
                $wpcrmailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				$wpcrmailbody='
				<html><head></head><body>
				<p style="font-size:18px;padding:2px;margin-top:8px;margin-bottom:6px;color:white;background-color:#003366;">Call Request</p><br>
				<b>Hi, you got a Call Request <br> 
				from :'.$name.'<br>
				Number : '.$phone.' <br>
				email : '.$email.'<br>
				Call back between '.$from.' - '.$to.'<br>
				Message : '.$msg.' </b>
				</body></html>
				';
				
				wp_mail(get_option($callresponseprefixinit.'your-email'),'New Call Request',$wpcrmailbody,$wpcrmailheaders);
			}
		}
		else
		{
			echo "not inserted";
		}
	}
	
}
if(isset($_POST['adminresponse']) && $cllrspncwpcsrfvalid)
{
	$id=sanitize_text_field($_POST['id']);
	$type=sanitize_text_field($_POST['type']);
	global $wpdb;
	$table=$wpdb->prefix."cll_response_records";
	if($type=='del')
	{
		$sql="delete from ".$table." where id=".$id."";
		$del=$wpdb->query($sql);
		if($del)
		{
		echo 1;
		}
		
	}
    if($type=='done')
	{
		$sql="update ".$table." set action=%s where id=".$id."";
		$u=$wpdb->query($wpdb->prepare($sql,array('1')));
		if($u)
		{
		echo 1;
		}
	}
    if($type=='cancel')
	{
		$sql="update ".$table." set action=%s where id=".$id."";
		$u=$wpdb->query($wpdb->prepare($sql,array('0')));
		if($u)
		{
		echo 1;
		}
	}
}
?>