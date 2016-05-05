
/**
 * creat new object for chat
 * 
 * step - increasing the sampling step messages from data base
 * 
 */

var chat = {
	options: {},
	init: function(options){
		chat.options = options;
		
		$(options.sendButton).on('click', function(){
			if($(options.inputMessage).val() != ''){
				chat.send_message($(options.inputMessage).val());
			}
		});
		
		$(options.loadMore).on('click', function(){
			//load count for old message
			//chat.return_message();
		});
		
		setInterval(function(){
			chat.return_messages();
		}, 1000);
	
	},
	
	send_message: function(message){
		chat.ajax('/contacts/ajax_write_message', {'message': message}, chat.clearMessagePlace);
	},
	
	clearMessagePlace: function(data){
		$(chat.options.inputMessage).val('');
	},
	
	return_messages: function(){
		chat.ajax('/contacts/chat_ajax', {'count': 5}, chat.getData);
	},
	
	getData: function(data) {
		var information = JSON.parse(data); 
		
		$.each(information, function(key, val){
			$.each(information[key], function(index, value){
				
			});
		});
	},
	
/**
* ajax request
*
* url - url to action for request
* data - request for data ( array or string )
* callback - function with call'd after success query
* 
*/
	ajax: function(url, data, method){
		$.ajax({
			type: 'post',
			url: url,
			data: data,
			response:'json',
			success: function(data){
				method(data);			
			},
			error: function(){
				console.log('problem')
			}
				
		});
	},
	
};
