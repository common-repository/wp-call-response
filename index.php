<?php
/*
PLUGIN NAME:WP Call Response
Plugin URI: http://www.teknikforce.com
Description: Get call request from people with email notification, easily handle the requests with a huge options to control the user interface .  
AUTHOR:TEKNIKFORCE
VERSION:1.0
*/


if ( ! defined( 'ABSPATH' ) ) exit;
include("function.php");

$callresponseprefixinit='cllrspwp';

/*
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://teknikforce.com/appcasts/wpplugins/wp_callresponse_bonus.json',
	__FILE__, //Full path to the main plugin file or functions.php.
	'wp_call_response_bonus'
);
*/

require_once("response-sequence/plugin.php");

		$gdprwpvar=new \CallResponse\license\wpgdprpluginlisence(array('wpcallresponse',$callresponseprefixinit));
		if($gdprwpvar->validate()==1)
		{
		add_action('admin_menu','wp_call_response_adminpage');
		}
		else
		{
		new \CallResponse\license\gdpractivationpage(array('wpcallresponse',$callresponseprefixinit));
		}
		

if(!function_exists('wp_call_response_adminpage'))
{
function wp_call_response_adminpage()
{
	add_menu_page('Call Response','Call Response','administrator','call_response','wp_call_response_admin_page','');
	add_submenu_page('call_response','Settings','Settings','administrator','callresponse_settings','crcall_response_settings','');
}
}
if(!function_exists('wp_call_response_admin_page'))
{
function wp_call_response_admin_page()
{
	require_once("callresponse.php");
}
}

if(!function_exists('crcall_response_settings'))
{
function crcall_response_settings()
{
include("settings.php")	;
}
}

if(!function_exists('crcall_slide_form'))
{
function crcall_slide_form()
{
	global $callresponseprefixinit;
	$pref=$callresponseprefixinit;
	if(get_option($pref.'def-form')=='1')
	require_once("flash/form.php");
}
}
add_action('wp_footer','crcall_slide_form',0,0);
register_activation_hook( __FILE__, 'call_response_table_install' );

if(!function_exists('call_response_popup'))
{
function call_response_popup()
{
	require_once("flash/shortcodeform.php");
	$data=wpcrShortcodeTemplate();
	return $data;
}
}
add_shortcode('CallResponse','call_response_popup');

register_activation_hook( __FILE__, 'crwp_call_response_settings_install' );
//register_deactivation_hook( __FILE__, 'crwp_call_response_settings_uninstall' );

add_action('wp_enqueue_scripts','crgetAllScriptsAndStyle');

if(!function_exists('crgetAllScriptsAndStyle'))
{
function crgetAllScriptsAndStyle()
{
//$content=get_the_content();
wp_enqueue_script('jquery');
wp_register_style('wpcr_shortcode_css',plugins_url('shortcodecss/style.css',__FILE__));
wp_enqueue_style('wpcr_shortcode_css');
}
}
add_action('admin_enqueue_scripts','craddScriptandAdminStyle');

if(!function_exists('craddScriptandAdminStyle'))
{
function craddScriptandAdminStyle()
{
	$add=0;
	$arr=array('callresponse_settings','call_response');
	if(isset($_GET['page']))
	{
		if(in_array($_GET['page'],$arr)){$add=1;}
	}
	if($add==1)
	{
		wp_register_style('bootstrapcsswpcr',plugins_url('asset/bootstrap/css/bootstrap.min.css',__FILE__));
		wp_enqueue_style('bootstrapcsswpcr');
		wp_register_script('bootstapjquerywpcr_popper',plugins_url('asset/bootstrap/js/popper.min.js',__FILE__),array('jquery'));
		wp_enqueue_script('bootstapjquerywpcr_popper');
		wp_register_script('bootstapjquerywpcr',plugins_url('asset/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
		wp_enqueue_script('bootstapjquerywpcr');
		wp_register_style('callresponse_fontawesome_allcss',plugins_url('asset/fontawesome/css/all.css',__FILE__));
		wp_enqueue_style('callresponse_fontawesome_allcss');
		wp_enqueue_media();
	}
}
}
//add_action('wp_ajax_crresponse_adminajxlcnc',"crresponse_adminajxlcnc");
add_action('wp_ajax_cractionresponse_adminajxlcnc',"crresponse_adminajxlcnc");
if(!function_exists('crresponse_adminajxlcnc'))
{
function crresponse_adminajxlcnc()
{
	if(isset($_POST['reverifyjkmvhblicense']) && isset($_POST['rvryfyplugin']) && isset($_POST['rvryfypluginpref']))
	{
	$ob=new \CallResponse\license\wpgdprpluginlisence(array(sanitize_text_field($_POST['rvryfyplugin']),sanitize_text_field($_POST['rvryfypluginpref'])));
	$ob->reValidate("server");
	}
	//echo "WP CallResponse Started";
	wp_die();
}
}
add_action('wp_ajax_crresponsecallstatup',"do_crresponsecallstatup");
if(!function_exists('do_crresponsecallstatup'))
{
function do_crresponsecallstatup()
{
	require_once("flash/requestResponse.php");
	wp_die();
}

}
add_action('wp_ajax_cllrspncsubmitrqst','do_cllrspncsubmitrqst');
add_action('wp_ajax_nopriv_cllrspncsubmitrqst','do_cllrspncsubmitrqst');

if(!function_exists('do_cllrspncsubmitrqst'))
{
function do_cllrspncsubmitrqst()
{
	require_once("flash/requestResponse.php");
	wp_die();
}
}

?>