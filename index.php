<?php
/*
  Plugin Name: Contact Popup 
  Plugin URI: http://www.formget.com
  Description: Easy to use Popup Contact Form   
  Version: 1.2
  Author: formget
  Author URI: http://www.formget.com
 */
include_once('fgcf.php');
include_once('response.php');
register_activation_hook(__FILE__, 'Fgcf::fgcf_table_install');
wp_enqueue_style('contact_style', plugins_url('css/contact_style.css', __FILE__ ) );

wp_enqueue_script('contact_script', plugins_url('js/contact_popup.js', __FILE__ ), array( 'jquery' ), '1.0' );

wp_localize_script( 'contact_script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

add_filter('wp_footer', 'popup_form');

function popup_form()
{
	      global $wpdb;
        $fg_iframe_form = get_option('fg_embed_code');
		if (!$fg_iframe_form == null) {
			$string = "sideBar";
$pos = strpos($fg_iframe_form, $string);
if ($pos == false) {
		?>
<div class="contact_top_div" id="cont_frame_div">
<div class="head_wrap" style="background-color:#41a2cd; height:45px">
<img style="float:right; margin-right:10px;" id="anc_close" src=<?php echo plugins_url('image/close.png', __FILE__); ?>>
</div>
<div id="contact_form_div" style="margin-left:18px; padding:0; align:center; overflow-y:scroll; height:400px">
<?php
echo stripslashes($fg_iframe_form);?>
</div></div><div class="contact_button">
<img src=<?php echo plugins_url("image/contact-button.png", __FILE__); ?> >
</div><?php
}
		else
		{
			echo stripslashes($fg_iframe_form);
		}}
	  else {
Fgcf::fgcf_show_form(); 
	  }
}
function insert_data()
{	
$name=sanitize_text_field($_POST['name']);
$email=sanitize_email($_POST['email']);
$msg=sanitize_text_field($_POST['msg']);
Fgcf::fgcf_insert_data($name, $email, $msg);
die();
}
add_action('wp_ajax_insert_data', 'insert_data');
add_action('wp_ajax_nopriv_insert_data', 'insert_data');
function delete_data()
{	
$id=$_POST['post_id'];
$result = Fgcf::fgcf_delete_data($id);
if ($result == true) {
                    $site_url = site_url() . '/wp-admin/admin.php?page=Fgcf_page';
                    header('Location:' . $site_url);
                    exist();
                }

die();
}
add_action('wp_ajax_delete_data', 'delete_data');
add_action('wp_ajax_nopriv_delete_data', 'delete_data');

function formget_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'user'   => '',
		'formcode'   => '',
		'allowTransparency' => true,
		'height'     => '500',
		'tab'=>''
	), $atts));
	$iframe_formget='';
	$url="http://www.formget.com/app/embed/form/".$formcode;
	if($tab=='page'){
	$iframe_formget .="<iframe height='".$height."' allowTransparency='true' frameborder='0' scrolling='no' style='width:100%;border:none'  src='".$url."' >";
	$iframe_formget .="</iframe>";
	add_filter('widget_text', 'do_shortcode');
	return $iframe_formget;
		}
	if($tab=='tabbed'){
	$tabbed_formget = <<<EOD
<script type="text/javascript">
var head=document.getElementsByTagName('head')[0];
        head.innerHTML=head.innerHTML+'<link rel="stylesheet" href="http://www.formget.com/app/app_data/user_js/dialog.css" type="text/css" />';
        window.onload = function() {
        var body=document.getElementsByTagName('body')[0];
        var slide_div=document.createElement('div');
        slide_div.setAttribute('id','slide_div');
        slide_div.setAttribute('class','slide_div');
        slide_div.innerHTML="<span class='pin-top'></span><span class='pin-middle'>Contact form</span><span class='pin-bottom'></span>";
        slide_div.setAttribute('style','top:40%; right:-90px; height:40px; position:fixed;');
        slide_div.setAttribute('onclick','document.getElementById("Formget_Dialog_Box").style.display="block"');
        body.appendChild(slide_div);
        var Formget_Dialog_Box=document.createElement('div');
        Formget_Dialog_Box.setAttribute('id','Formget_Dialog_Box');
        Formget_Dialog_Box.setAttribute('onclick','tabbed();');
        Formget_Dialog_Box.innerHTML='<div class="formget-dialog1"></div><div class="formget-dialog2"><div class="formget-dialog3"><div class="formget-dialog4"><div class="dialog-close" title="Close Dialog"><button>Close Dialog</button></div><div class="formget-dialog5"><iframe allowtransparency="true" frameborder="0" src="{$url}"></iframe></div><a class="formget-dialog-logo" href="http://www.formget.com" target="_blank"></a></div></div></div>';
        body.appendChild(Formget_Dialog_Box);    }   
        function tabbed()  {
        document.getElementById("Formget_Dialog_Box").setAttribute("style","position:fixed; top:0; left:0; width:100%; height:100%; display:none; text-align:center; z-index:2000;");
    }
</script>
EOD;
	return $tabbed_formget;
	}
}
add_shortcode('formget','formget_shortcode');
?>