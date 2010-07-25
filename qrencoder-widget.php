<?php
/*
Plugin Name: QRCode Encoder
Plugin URI: http://wordpress.org/extend/plugins/qr-encoder/
Description: QRCode Encoder
Version: 0.1.3.2
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
		
        extract( $args );
        echo $before_widget;
        $title = apply_filters('widget_title', $instance['title']);
        if( $title ) echo $before_title . $title . $after_title;


?>

<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/qr-encoder/yui/yahoo/yahoo-min.js"></script> 
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/qr-encoder/yui/event/event-min.js"></script> 
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/qr-encoder/yui/connection/connection-min.js"></script> 


<br /><br/>
<center>
<h2><a href=http://wordpress.org/extend/plugins/qr-encoder/ target=blank>QR Encoder</a></h2>

<form id="qrencoder" name="qrencoder" onSubmit="return false;">
<input type="text" name="qr" id="qr" onKeyPress="javascript:myqr(event);" size="20">
<input type="hidden" name="qrfrom" id="qrfrom" value="wb:widget">
<input type="hidden" name="qrbot" id="qrbot" value="abdul">
</form> 
<br/>
<table border="0" style="border:0px">
<tr style="border:none" align="left"><td width="90%" align="left" style="border:none">
<span id="qrgenerate" style="border:0px"></span>
</td></tr></table>

</center>


<script>
var handleEvent = {
	qrstart:function(eventType, args){
	// do something when startEvent fires.
	document.getElementById('qrgenerate').innerHTML = "<center><img src=<?php echo WP_PLUGIN_URL;?>/qr-encoder/images/wait.gif></center>";
	},

	qrcomplete:function(eventType, args){
	// do something when completeEvent fires.
		document.qrencoder.qr.select();
	},

	qrsuccess:function(eventType, args){
	// do something when successEvent fires.
		if(args[0].responseText !== undefined){
			document.getElementById('qrgenerate').innerHTML = args[0].responseText;
			document.qrencoder.qr.select();
		}
	},

	qrfailure:function(eventType, args){
	// do something when failureEvent fires.
		alert('answering system error');
	},

	qrabort:function(eventType, args){
	// do something when abortEvent fires.
	}
};

var qrcallback = {
	customevents:{
		onStart:handleEvent.qrstart,
		onComplete:handleEvent.qrcomplete,
		onSuccess:handleEvent.qrsuccess,
		onFailure:handleEvent.qrfailure,
		onAbort:handleEvent.qrabort
	},
	scope:handleEvent,
 	argument:["foo","bar","baz"]
};


function makeRequest(){
	var q = encodeURIComponent(document.getElementById("qr").value);
	if(q!=""){
		var sUrl = "<?php echo WP_PLUGIN_URL;?>/qr-encoder/abdul.php";
		var data = "q="+q;
		var request = YAHOO.util.Connect.asyncRequest('POST', sUrl, qrcallback,data);
	}
}

function myqr(e){
	var n = e.keyCode;
	if(n==13){//key of Enter Key
		makeRequest();
		document.qrencoder.qr.select();
	}
	
}


</script>


<?php
		
		
		
	}

    //////////////////////////////////////////////////////
    //Update the widget settings
    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        return $instance;
    }

    ////////////////////////////////////////////////////
    //Display the widget settings on the widgets admin panel
    function form( $instance )
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>
        <?php
    }

}

add_action( 'widgets_init', 'qrencoder_widget_init' );


function qrencoder_widget_init() {
	register_widget('QRCode_Encoder_Widget');
}

?>