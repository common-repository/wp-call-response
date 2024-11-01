<?php
if(!function_exists('call_response_table_install'))
{

function call_response_table_install() {
	//function to install callers list table
global $wpdb;
$charset_collate = '';
  if (!empty($wpdb->charset)) 
  {
  $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
  }
 if (!empty($wpdb->collate)) 
 {
        $charset_collate .= " COLLATE {$wpdb->collate}";
 }
 $table_name = $wpdb->prefix . "cll_response_records";


	 $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (" .
            
			"`id` bigint(11) NOT NULL AUTO_INCREMENT,".
             "`name` varchar(255) NOT NULL,".
			 "`email` varchar(255) NOT NULL,".
			 "`number` varchar(255) NOT NULL,".
              "`ip` varchar(255) NOT NULL,".
               "`comment` varchar(255) NOT NULL,".
			   "`frmtime` varchar(255) NOT NULL,".
			   "`totime` varchar(255) NOT NULL,".
			   "`recorded` varchar(255) NOT NULL,".
			   "`action` varchar(255) NOT NULL,".
                  "PRIMARY KEY (`id`)".
                     ") {$charset_collate} ENGINE=InnoDB;";


         $wpdb->query($sql);



	}

}

if(!function_exists('crwp_call_response_settings_install'))
{


function crwp_call_response_settings_install()
{//install settings function
	$pref='cllrspwp';
	
	//show and hide
	add_option($pref.'name','1');
	add_option($pref.'email','1');
	add_option($pref.'number','1');
	add_option($pref.'msg','1');
	add_option($pref.'from','1');
	add_option($pref.'to','1');
	//color-settings;
	add_option($pref.'bgcolor','#6495ED');
	add_option($pref.'border-color','#6495ED');
	add_option($pref.'text-color','#F8F8FF');
	add_option($pref.'submit-color','#6A5ACD');
	add_option($pref.'submit-text-color','#F8F8FF');
	add_option($pref.'shortcode-button-color','#6A5ACD');
	add_option($pref.'shortcode-button-text-color','#F8F8FF');
	//show hide default form
	add_option($pref.'def-form','1');
	//change text
	add_option($pref.'btn-txt','Request a Call Back');
	add_option($pref.'scode-txt','Call Me Back');
	add_option($pref.'sbmt-txt','Call Me');
	//email settings
	add_option($pref.'email-notification','0');
	add_option($pref.'your-email','');
	//display avatar
	add_option($pref.'avatar','');
}

}
if(!function_exists('crwp_call_response_settings_uninstall'))
{

function crwp_call_response_settings_uninstall()
{//uninstall settings function
	$pref='cllrspwp';
	
	//show and hide
	delete_option($pref.'name');
	delete_option($pref.'email');
	delete_option($pref.'number');
	delete_option($pref.'msg');
	delete_option($pref.'from');
	delete_option($pref.'to');
	//color-settings
	delete_option($pref.'bgcolor');
	delete_option($pref.'border-color');
	delete_option($pref.'text-color');
	delete_option($pref.'submit-color');
	delete_option($pref.'submit-text-color');
	delete_option($pref.'shortcode-button-color');
	delete_option($pref.'shortcode-button-text-color');
	//show hide default form
	delete_option($pref.'def-form');
	//change text
	delete_option($pref.'btn-txt');
	delete_option($pref.'scode-txt');
	delete_option($pref.'sbmt-txt');
	//email settings
	delete_option($pref.'email-notification');
	delete_option($pref.'your-email');
	//display avatar
	delete_option($pref.'avatar');
}
}
/*function load_wp_media_files() 
{//image uploader
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );*/
if(!function_exists('wpcrtimepicker'))
{
function wpcrtimepicker($name)
{
$timepicker="<select name='".esc_attr($name)."' class='wpcr-form-control wpcr' style='height: auto;
    max-height: 200px;
    overflow-x: hidden;'>";
$timepicker .="<option value='' selected>Select Time</option>";
 for($i=0;$i<24;$i++)
 {
	 $otime=$i.":00";
	 $thirtytime=$i.":30";
	 if(strlen($i)==1)
	 {
		$otime ="0".$otime;
		$thirtytime ="0".$thirtytime;
	 }
	$timepicker .= "<option value='".esc_attr($otime)."'>".esc_html($otime)."</option>";
	$timepicker .= "<option value='".esc_attr($thirtytime)."'>".esc_html($thirtytime)."</option>";
    		 
 }
$timepicker .= "</select>";

return $timepicker;
}
}
?>