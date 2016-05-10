
/**
 * creat new object for chat
 * 
 */

var chat = {
	step: 5,	
	minId: 0,
	maxId: 0,
	count: 0,

	options: {},
	init: function(options){
		
		chat.options = options;
		
		chat.return_messages(chat.step, chat.maxId, true, chat.getDefaultMessage);
		
		$(options.sendButton).on('click', function(){
			if($(options.inputMessage).val() != ''){
				chat.send_message($(options.inputMessage).val());
			}
		});
		
		$(options.loadMore).on('click', function(){
			chat.count = chat.count + chat.step;
			chat.return_messages(chat.count, chat.minId, false, chat.getOldMessage);
		});
		
		setInterval(function(){
			//console.log(chat.mustache);
			chat.return_messages(chat.step, chat.maxId, true, chat.getNewtMessage);
		}, 1000);
		
	},
	
	send_message: function(message){
		chat.ajax('/contacts/ajax_write_message', {'message': message}, chat.clearMessagePlace);
	},
	
	clearMessagePlace: function(){
		$(chat.options.inputMessage).val('');
	},
	
	return_messages: function(count, id, condition, method){
		chat.ajax('/contacts/chat_ajax', {'count': count, 'id': id, 'condition': condition}, method);
	},
	
	getDefaultMessage: function(information){
		if( information[0] != null ){
			chat.maxId = information.max;
			chat.minId = information.min;
			chat.loadMessage(information, 'down');
		}
	},
	
	getNewtMessage: function(information){
		if( information[0] != null )
		{
			chat.maxId = information.max;
			chat.loadMessage(information, 'up');
		}
	},
	
	getOldMessage: function(information) {
		
		if( information[0] != null )
		{
			chat.loadMessage(information, 'down');
		}
	},
	
	loadMessage: function(information, status){
		if(status == 'down')
		{
			for( var key in information ){
				if(information[key] !== null && typeof information[key] === 'object')
				{					
					$(chat.options.loadMessage).append('<div class="message"><span class="name">' + information[key].user_name + 
							'</span><span class="date">on ' + information[key].date +
							'</span><div class="claer"></div>' + information[key].text +
							'</div>')
				}
			}
		}
		else if(status == 'up')
		{
			for( var key in information ){
				if(information[key] !== null && typeof information[key] === 'object')
				{
					$(chat.options.loadMessage).prepend('<div class="message"><span class="name">' + information[key].user_name + 
							'</span><span class="date">on ' + information[key].date +
							'</span><div class="claer"></div>' + information[key].text +
							'</div>')
				}
			}
		}
	},
	
/**
* ajax request
*
* url - url to action for request
* data - request for data ( array or string )
* callback - function with call'd after success query
* 
* jqXHR.status - 0 - Network Problem
* 			   - 404 - Requested page not found
* 		       - 500 - Internal Server Error 
* 
*/
	ajax: function(url, data, method){
		$.ajax({
			type: 'post',
			url: url,
			data: data,
			response:'json',
			success: function(data){
				var information = JSON.parse(data);
				method(information);		
			},
			error: function(jqXHR){
				console.log(jqXHR.status);
			}
				
		});
	},
};
//console.log(mustache);