
"use strict";

var start_count = 5;

class Chat{
	
	ajax_return(){
		
		document.getElementsByClassName("submit")[0].onclick = function(e)
		{
			e.preventDefault();
			chat.send_message();
		}

		document.getElementsByClassName("load_more")[0].onclick = function()
		{
			chat.count_for_old_message();
		}
		
			var xmlhttp;
	
		    if (window.XMLHttpRequest) {
		        // code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp = new XMLHttpRequest();
		    } else {
		        // code for IE6, IE5
		        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		    }
	
		    xmlhttp.onreadystatechange = function() {
		        if (xmlhttp.readyState == 4 ) {
		           if(xmlhttp.status == 200){
		               document.getElementsByClassName('message_plase')[0].innerHTML = xmlhttp.responseText;
		           }
		           
		        }
		    }
		        
		xmlhttp.open("POST", "/contacts/chat_ajax", true);
		   
		if(this.get_cookie('count') != null)
		{
		    xmlhttp.send(this.get_cookie('count'));
		} 
		else{
			xmlhttp.send(start_count)
		}
	}
	
	send_message()
	{	
		var message = document.getElementsByClassName("for_message")[0].value;
		
		if(message != '')
		{
			document.getElementsByClassName("for_message")[0].value = '';
			
			var xmlhttp;
			
		    if (window.XMLHttpRequest) {
		        // code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp = new XMLHttpRequest();
		    } else {
		        // code for IE6, IE5
		        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		    }
	
		    xmlhttp.onreadystatechange = function() {
		        if (xmlhttp.readyState == 4 ) {
		           if(xmlhttp.status == 200){
		               
		           }
		           else if(xmlhttp.status == 400) {
		             // alert('There was an error 400')
		           }
		           else {
		               //alert('something else other than 200 was returned')
		           }
		        }
		    }
		        
		    xmlhttp.open("POST", "/contacts/ajax_write_message", true);
		    xmlhttp.send(message);

		}
	}
	
	count_for_old_message()
	{
		
		if( this.get_cookie('count') == null )
		{
			var count = start_count + 5;
		}
		else{
			var count = Number(this.get_cookie('count')) + 5;
		}
		
		document.cookie = 'count = ' + count;
		
	}
	
	get_cookie ( cookie_name )
	{
	  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
	  
	  if ( results )
	    return ( unescape ( results[2] ) );
	  else
	    return null;
	}
	
}

var chat = new Chat();

setInterval(function(){ 
	chat.ajax_return()
}, 1000);