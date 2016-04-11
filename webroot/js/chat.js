
"use strict";

var chat_body =	'<div class="chat_place chat_open"><div id="chat" class="chat"><span class="header_text">SHOUTBOX</span><form action="/" method="POST"><input class="for_message" type="text" name="message"><input class="submit" type="submit" name="say" value="SAY"><div class="claer"></div></form><div class="message_plase" id="style"><span class="load_more">load more</span></div></div></div>';

document.getElementsByClassName('chat')[0].innerHTML = chat_body;

class Chat{
	
	ajax(){
		setInterval(function(){ 

			var xmlhttp;
	
		    if (window.XMLHttpRequest) {
		        // code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp = new XMLHttpRequest();
		    } else {
		        // code for IE6, IE5
		        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		    }
	
		    xmlhttp.onreadystatechange = function() {
		        if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
		           if(xmlhttp.status == 200){
		               document.getElementsByClassName('message_plase')[0].innerHTML = xmlhttp.responseText;
		           }
		           else if(xmlhttp.status == 400) {
		             // alert('There was an error 400')
		           }
		           else {
		               //alert('something else other than 200 was returned')
		           }
		        }
		    }
		        
		    xmlhttp.open("POST", "/contacts/chat_ajax", true);
		    xmlhttp.send();
		    
		}, 3000);
	}
}


var chat = new Chat();

chat.ajax();





