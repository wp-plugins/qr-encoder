<?php
/*
Plugin Name: QRCode Encoder
Plugin URI: http://wordpress.org/extend/plugins/qr-encoder/
Description: QRCode Encoder
Version: 0.1
Author: DreamBuilder Inc.
Author URI: http://www.conan.in.th/
*/


global $wp_version;

if ( version_compare( $wp_version, '2.9', '<' ) ) {

}


class QRCode_Encoder_Widget extends WP_Widget {

	function QRCode_Encoder_Widget() {
		$widget_ops = array('classname' => 'widget_qrencoder', 'description' => __( "QRCode Encoder") );
		$this->WP_Widget('qrencoder', __('QRCode Encoder'), $widget_ops);
	}

	function widget( $args, $instance ) {
		
		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = __( 'QRCode Encoder' );


?>

<script type="text/javascript" src="/wp-content/plugins/qr-encoder/yui/yahoo/yahoo-min.js"></script> 
<script type="text/javascript" src="/wp-content/plugins/qr-encoder/yui/event/event-min.js"></script> 
<script type="text/javascript" src="/wp-content/plugins/qr-encoder/yui/connection/connection-min.js"></script> 
<script type="text/javascript" src="/wp-content/plugins/qr-encoder/js/abdul.js"></script> 

<br /><br/>
<center>
<h2><a href=http://wordpress.org/extend/plugins/qr-encoder/ target=blank>QR Encoder</a></h2>

<form id="abdul" name="abdul" onSubmit="return false;">
<input type="text" name="q" id="q" onKeyPress="javascript:myquery(event);" size="20">
<input type="hidden" name="from" id="from" value="wb:widget">
<input type="hidden" name="bot" id="bot" value="abdul">
</form> 
<br/>
<table border="0" style="border:0px">
<tr style="border:none" align="left"><td width="90%" align="left" style="border:none">
<span id="abdulanswer" style="border:0px"></span>
</td></tr></table>

</center>


<?php
		
		
		
	}

	function update( $new_instance, $old_instance ) {

	}

}

add_action( 'widgets_init', 'qrencoder_widget_init' );

function qrencoder_widget_init() {
	register_widget('QRCode_Encoder_Widget');
}

?>