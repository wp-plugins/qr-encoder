var handleEvent = {
	qrstart:function(eventType, args){
	// do something when startEvent fires.
	document.getElementById('qrgenerate').innerHTML = "<center><img src=/wp-content/plugins/qr-encoder/images/wait.gif></center>";
	},

	qrcomplete:function(eventType, args){
	// do something when completeEvent fires.
		document.qrencoder.q.select();
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
		var sUrl = "/wp-content/plugins/qr-encoder/abdul.php";
		var data = "q="+q;
		var request = YAHOO.util.Connect.asyncRequest('POST', sUrl, qrcallback,data);
	}
}

function myqr(e){
	var n = e.keyCode;
	if(n==13){//key of Enter Key
		makeRequest();
		document.qrencoder.q.select();
	}
	
}


