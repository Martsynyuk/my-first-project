/**
 * 
 * for simple chat only
 * 
 * don't broken my code ^)
 */

$( document ).ready(function() {
	
	$('#chat').on('click', '.submit', function(e){
		chat.send_message();
		e.preventDefault();
	});
	
	$('#chat').on('click', '.load_more', function(){
		chat.load_more();
	});
	
	setInterval(function(){ 
		chat.return_message()
	}, 1000);  
});

/**
 * creat new object for chat
 * 
 * step - increasing the sampling step messages from data base
 * 
 */

var chat = {step: 5};

chat.load_more = function(){
	
	var count;
	
	if($.cookie('count') == null)
	{
		count = chat['step'];
		chat.set_cookie(count, 1, '/');
	}
	else{
		count = parseInt($.cookie('count')) + chat['step'];
		chat.set_cookie(count, 1, '/');
	}
	
}

/**
 * 
 * this method return message from data base with ajax query
 * 
 */

chat.return_message = function () {
	
	var count;
	
	if($.cookie('count') == null)
	{
		count = chat['step'];	
	}
	else{
		count = parseInt($.cookie('count'));
	}
	
	if( chat.ajax('/contacts/chat_ajax', {'count': count}))
	{
	
	}
	
	$.ajax({
		type: 'post',
		url: '/contacts/chat_ajax',
		data:{'count': count},
		response:'html',
		success: function(data){
			$('.message_plase').empty();
			$('.message_plase').append(data);
		},
		error: function(){
			console.log('some problem');
		}
	});
};

/**
 * 
 * this method send new message to data base with ajax query
 * 
 */

chat.send_message = function () {

	if($('.for_message').val() != '')
	{
		if( ! chat.ajax('/contacts/ajax_write_message', {'message': $('.for_message').val()}))
		{
			$('.for_message').val('');
		}
	}
};

/**
 * 
 * this method set cookie for count of message that returns
 * return_message method
 * data - data for set cookie
 * time - time cookie live
 * url - url where cookie is available
 */

chat.set_cookie = function (data, time, url) {	
	$.cookie('count', data, {expires: time, path: url});
};

/**
 * ajax request
 * 
 * url - url to action for request
 * data - request for data ( array or string )
 */

chat.ajax = function(url, data){
  $.ajax({
		type: 'post',
		url: url,
		data: data,
		response:'html',
		success: function(data){
			return true;
		},
		error: function(){
			console.log('problem')
			return false;
		}
		
	});
};