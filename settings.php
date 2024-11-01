<?php
global $callresponseprefixinit;
if(isset($_POST['wpcrsetit']) && wp_verify_nonce($_POST['callwresponsepcsrf'],'callwresponsepcsrf'))
{
	$pref=$callresponseprefixinit;
	if($_POST['wpcremailnotif']=="1"|| strlen($_POST['wpcremailid'])>0)
	{
	if (! filter_var($_POST['wpcremailid'], FILTER_VALIDATE_EMAIL))
	{
		$wpcrentf='0';
		$wpcreml='';
	   echo "<script>alert('Email Id Invalid')</script>";
	}
    else
	{

		$wpcrentf=sanitize_text_field($_POST['wpcremailnotif']);
				//echo $wpcrentf;

		$wpcreml=sanitize_email($_POST['wpcremailid']);
	}		
	}
	else
	{
		$wpcrentf=sanitize_text_field($_POST['wpcremailnotif']);

	}
	if(strlen($_POST['image_url'])>4)
	{
    if(filter_var($_POST['image_url'],FILTER_VALIDATE_URL))
    {
        $wpcrimglnk= esc_url($_POST['image_url']);
    }
    else
    {
       echo "<script>alert('invalid image link')</script>";
	   $wpcrimglnk='';
    }

	}
	update_option($pref.'name',sanitize_text_field($_POST['wpcrname']));
	update_option($pref.'email',sanitize_text_field($_POST['wpcremail']));
	update_option($pref.'number',sanitize_text_field($_POST['wpcrnumber']));
	update_option($pref.'msg',sanitize_textarea_field($_POST['wpcrmsg']));
	update_option($pref.'from',sanitize_text_field($_POST['wpcrfrom']));
	update_option($pref.'to',sanitize_text_field($_POST['wpcrto']));
	//color-settings
	$bgcolor=sanitize_hex_color($_POST['wpcrbg']);
	update_option($pref.'bgcolor',$bgcolor);

	$wpcrbordercolor=sanitize_hex_color($_POST['wpcrbordercolor'] );

	update_option($pref.'border-color',$wpcrbordercolor);
	$wpcrtextcolor = sanitize_hex_color($_POST['wpcrtextcolor']);
	update_option($pref.'text-color',$wpcrtextcolor);
	$wpcrsubmitbuttoncolor = sanitize_hex_color($_POST['wpcrsubmitbuttoncolor']);
	update_option($pref.'submit-color',$wpcrsubmitbuttoncolor);

	$wpcrsubmittextcolor=sanitize_hex_color($_POST['wpcrsubmittextcolor']);
	update_option($pref.'submit-text-color',$wpcrsubmittextcolor);
	$wpcrshortcodebuttoncolor=sanitize_hex_color($_POST['wpcrshortcodebuttoncolor']);
	update_option($pref.'shortcode-button-color',$wpcrshortcodebuttoncolor);
	$wpcrshortcodetextcolor=sanitize_hex_color($_POST['wpcrshortcodetextcolor']);
	update_option($pref.'shortcode-button-text-color',$wpcrshortcodetextcolor);
	//show hide default form
	update_option($pref.'def-form',sanitize_text_field($_POST['wpcrdefform']));
	//change text
	update_option($pref.'btn-txt',sanitize_text_field($_POST['wpcrwbtntxt']));
	update_option($pref.'scode-txt',sanitize_text_field($_POST['wpcrshbtntxt']));
	update_option($pref.'sbmt-txt',sanitize_text_field($_POST['wpcrwsbtntxt']));
	//email settings
update_option($pref.'email-notification',$wpcrentf);
	update_option($pref.'your-email',$wpcreml);
	//display avatar

	update_option($pref.'avatar',$wpcrimglnk);
}
$pref=$callresponseprefixinit;
	
	//show and hide
	$wpcrshowname=get_option($pref.'name');
	$wpcrshowemail=get_option($pref.'email');
	$wpcrshownumber=get_option($pref.'number');
	$wpcrshowmsg=get_option($pref.'msg');
	$wpcrshowfrom=get_option($pref.'from');
	$wpcrshowto=get_option($pref.'to');
	//color-settings
	$wpcrbgcolor=get_option($pref.'bgcolor');
	$wpcrbordercolor=get_option($pref.'border-color');
	$wpcrtextcolor=get_option($pref.'text-color');
	$wpcrsubmitbuttontcolor=get_option($pref.'submit-color');
	$wpcrsubmittexttcolor=get_option($pref.'submit-text-color');
	$wpcrshortcodebuttoncolor=get_option($pref.'shortcode-button-color');
	$wpcrshortcodetextcolor=get_option($pref.'shortcode-button-text-color');
	//show hide default form
	$wpcrshowdefault=get_option($pref.'def-form');
	
	//change text
	$wpcrbuttontext=get_option($pref.'btn-txt');
	$wpcrshortcodetext=get_option($pref.'scode-txt');
	$wpcrsubmittext=get_option($pref.'sbmt-txt');
	//email settings
	$wpcremail=get_option($pref.'email-notification');
	$wpcremailid=get_option($pref.'your-email');
	//display avatar
	$wpcravatar=get_option($pref.'avatar');
?>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('#upload-btn').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
			library: {type:'image'},
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#image_url').val(image_url);
			$('#theimage_url').src(image_url);
        });
    });
});

function crcopyWpcrShortcode(){
  var copyText = document.getElementById("wpcrhdninp");
  copyText.style.display="block";
  copyText.select();
  document.execCommand("copy");
   copyText.style.display="none";
}
jQuery(document).ready(function($){
    $('[data-toggle="tooltip"]').tooltip(); 
      });
</script>
<div class="container-fluid wpcr">
 <br>
 <div class="row">	
 <div class="col-sm-12">
<div class="panel-group">
<div class="panel panel-primary">
<div class="panel-heading wpcrpanel"><h3>WP CallResponse Settings</h3></div> 
 <div class="panel-body">
 
 <form action="" method="post" style="margin: 20px;">
 <div class="alert alert-warning">Use <span onclick="crcopyWpcrShortcode()" style="cursor:pointer;" data-toggle="tooltip" title="Copy to clipboard"><strong>[CallResponse]</strong></span> shortcode or widget to display callback request form .<input type="text" id="wpcrhdninp" style="display:none" value="[CallResponse]"></div>
 <div class="input-group">
    <span class="input-group-addon"> <b><i class="fa fa-eye" aria-hidden="true"></i>
Display Default Form </b></span>		<span class='form-control'>

	<input id="msg" type="radio"  name="wpcrdefform" value="1" <?php if($wpcrshowdefault=='1') echo 'checked'; ?>/>Yes&nbsp;&nbsp;&nbsp;&nbsp;<input id="msg" type="radio"  name="wpcrdefform" value="0" selected <?php if($wpcrshowdefault=='0') echo 'checked'; ?> />No
	
	</span>
 </div>
 <br>
  <div class="input-group">
  
    <span class="input-group-addon"><strong><i class="fa fa-envelope" aria-hidden="true"></i> Email Notification</strong></span>
	<span class='form-control'>
	<input id="msg" type="radio"  name="wpcremailnotif" value="1" <?php if($wpcremail=='1') echo 'checked'; ?> />Yes&nbsp;&nbsp;&nbsp;&nbsp;<input id="msg" type="radio"  name="wpcremailnotif" value="0" <?php if($wpcremail=='0') echo 'checked'?> />No&nbsp;&nbsp;&nbsp;&nbsp;
	<input id="msg" type="text"  name="wpcremailid" <?php if($wpcremailid==""){echo 'placeholder="Your Email"';}else{echo 'value="'.esc_attr($wpcremailid).'"';}  ?> style="height:95%">
	</span>
  </div>
  <br>
 <div class="input-group" >
  
    <span class="input-group-addon" id="upload-btn" style="cursor:pointer"><strong><i class="fa fa-upload" aria-hidden="true"></i>
 Upload Image</strong>
</span>
	<span class='form-control'>

<input type="text" value="<?php echo esc_attr($wpcravatar); ?>" class="form-control" name="image_url" id="image_url" class="regular-text " placeholder="Enter Image URL" ></span>
  </div>
  <br>
 
 <div class="row">
<div class="col-sm-6"> 
<div class="panel panel-primary">
<div class="panel-heading"><strong>Change Text</strong></div>
 <div class="panel-body">
 <div class="input-group">
    <span class="input-group-addon">Widget Button Text</span>
    <input id="msg" type="text" value="<?php echo esc_attr($wpcrbuttontext); ?>" class="form-control" name="wpcrwbtntxt" placeholder="Add Text">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Shortcode Button Text</span>
    <input id="msg" type="text" value="<?php echo esc_attr($wpcrshortcodetext); ?>" class="form-control" name="wpcrshbtntxt" placeholder="Add Text">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Submit Button Text</span>
    <input id="msg" type="text" value="<?php echo esc_attr($wpcrsubmittext); ?>" class="form-control" name="wpcrwsbtntxt" placeholder="Add Text">
  </div>
  <br>
</div></div>
<br>
<div class="panel panel-primary">
<div class="panel-heading"><strong>Show or Hide</strong></div>
 <div class="panel-body">
  <div class="input-group">
  
    <span class="input-group-addon">Show Name Input Box </span>
	<span class='form-control'>
	<input id="msg" type="radio"  name="wpcrname" value="1" <?php if($wpcrshowname=='1') echo 'checked'; ?>/>Yes&nbsp;&nbsp;&nbsp;&nbsp;<input id="msg" type="radio"  name="wpcrname" value="0"  <?php if($wpcrshowname=='0') echo 'checked'; ?>/>No
	
	
	</span>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Show Email Input Box </span>
	<span class='form-control'>
	<input id="msg" type="radio"  name="wpcremail" value="1" <?php if($wpcrshowemail=='1') echo 'checked'; ?>>Yes<input id="msg" type="radio"  name="wpcremail" value="0" selected <?php if($wpcrshowemail=='0') echo 'checked'; ?>>No

	
	</span>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Show Number Input Box </span>
	<span class='form-control'>
	<input id="msg" type="radio"  name="wpcrnumber" value="1" <?php if($wpcrshownumber=='1') echo 'checked'; ?>/>Yes&nbsp;&nbsp;&nbsp;&nbsp;<input id="msg" type="radio"  name="wpcrnumber" value="0" selected <?php if($wpcrshownumber=='0') echo 'checked'; ?>/>No

	
	</span>
 </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Show Message Input Box </span>
	<span class='form-control'>
	<input id="msg" type="radio"  name="wpcrmsg" value="1" <?php if($wpcrshowmsg=='1') echo 'checked'; ?>/>Yes&nbsp;&nbsp;&nbsp;&nbsp;<input id="msg" type="radio"  name="wpcrmsg" value="0" selected <?php if($wpcrshowmsg=='0') echo 'checked'; ?>/>No
	</span>	
 </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Show From(time) Input Box </span>
	<span class='form-control'>
	<input id="msg" type="radio"  name="wpcrfrom" value="1" <?php if($wpcrshowfrom=='1') echo 'checked'; ?>/>Yes &nbsp;&nbsp;&nbsp;&nbsp;<input id="msg" type="radio"  name="wpcrfrom" value="0" selected <?php if($wpcrshowfrom=='0') echo 'checked'; ?>>No

	
	</span>
		
 </div>
 
 <br>
 <div class="input-group">
    <span class="input-group-addon">Show To(time) Input Box </span>
	<span class='form-control'>
	<input id="msg" type="radio"  name="wpcrto" value="1" <?php if($wpcrshowto=='1') echo 'checked'; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;<input id="msg" type="radio"  name="wpcrto" value="0" selected <?php if($wpcrshowto=='0') echo 'checked'; ?>>No

	
	</span>
		
 </div>
 </div></div>

</div>

<div class="col-sm-6"> 
<div class="panel panel-primary">
<div class="panel-heading"><strong>Control colors</strong></div>
 <div class="panel-body">
 <div class="input-group">
    <span class="input-group-addon">Default Scroll Button Color </span>
    <span class="form-control"><input id="msg" type="color" value="<?php echo esc_attr($wpcrbgcolor); ?>" name="wpcrbg"></span>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Form Border Color </span>
    <span class="form-control"><input id="msg" type="color" value="<?php echo esc_attr($wpcrbordercolor); ?>" name="wpcrbordercolor" ></span>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Scroll button Text Color </span>
    <span class="form-control"><input id="msg" type="color" value="<?php echo esc_attr($wpcrtextcolor); ?>" name="wpcrtextcolor" ></span>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Form Submit Button Color </span>
    <span class="form-control"><input id="msg" type="color" value="<?php echo esc_attr($wpcrsubmitbuttontcolor); ?>" name="wpcrsubmitbuttoncolor" ></span>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Form Submit Text Color </span>
    <span class="form-control"><input id="msg" type="color" value="<?php echo esc_attr($wpcrsubmittexttcolor); ?>" name="wpcrsubmittextcolor" ></span>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Shortcode Button Color </span>
    <span class="form-control"><input id="msg" type="color" value="<?php echo esc_attr($wpcrshortcodebuttoncolor); ?>" name="wpcrshortcodebuttoncolor" ></span>
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon">Shortcode Text Color </span>
    <span class="form-control"><input id="msg" type="color" value="<?php echo esc_attr($wpcrshortcodetextcolor); ?>" name="wpcrshortcodetextcolor" ></span>
  </div>
  </div>
</div>
  <input type="hidden" name="callwresponsepcsrf" value="<?php echo wp_create_nonce('callwresponsepcsrf'); ?>">
  <div class="form-group"><br><button type="submit" class="btn btn-primary form-control" name="wpcrsetit">Save Settings</button></div>
  
  </div>
  
 </div>
 </form>

</div>

 </div></div>
</div></div>
 
</div>
 <style>
 	p.radioyn{margin-left:10px;margin-right:10px}
 
 
 .wpcrpanel
 {
	background:linear-gradient(#23282d,#23282d); 
 }
 .wpcr .panel-heading
 {
    background:linear-gradient(#2c333a,#2c333a);
    color: #fff;
    padding: 10px;
 }	
 .wpcrpanel>h3
 {
	 margin:0px;
	 color: #fff;
	 padding: 4px;
 }
 .alert{
 	margin:3px;
 	margin-bottom: 15px;
 }
 .wpcr .panel{border:1px solid #23282d;}
.panel-body{
	padding: 10px;
}
p.radioyn {
    margin-left: 10px;
    margin-right: 10px;
}
.input-group {
    position: relative;
    display: table;
    border-collapse: separate;
}
.input-group-addon:first-child {
    border-right: 0;
}
.input-group .form-control:first-child, .input-group-addon:first-child, .input-group-btn:first-child>.btn, .input-group-btn:first-child>.btn-group>.btn, .input-group-btn:first-child>.dropdown-toggle, .input-group-btn:last-child>.btn-group:not(:last-child)>.btn, .input-group-btn:last-child>.btn:not(:last-child):not(.dropdown-toggle) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.input-group-addon {
    padding: 6px 12px;
    font-size: 16px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.input-group-addon, .input-group-btn {
    width: 1%;
    white-space: nowrap;
    vertical-align: middle;
}
.input-group .form-control, .input-group-addon, .input-group-btn {
    display: table-cell;
}
.btn{
	height: auto;
}
 </style>



<span style="right:0px;bottom:40px;position:absolute;"><a href="https://teknikforce.com" target="_BLANK"><img src="<?php echo esc_url(plugins_url("asset/img/logo.jpg",__FILE__)); ?>" style="max-height:40px;max-width:150px"></a></span>