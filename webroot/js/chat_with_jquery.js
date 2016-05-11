
/**
 * creat new object for chat
 * 
 */

chat = {
	
	options: {
		step: 5,	
		minId: 0,
		maxId: 0,
		count: 0,
		inputMessage: 'input.for_message',
		sendButton: 'input.submit',
		loadMore: 'span.load_more',
		loadMessage: 'div.message_plase',
		template: '{{#messages}}<div class="message"><span class="name">{{user_name}}</span><span class="date">on {{date}}</span><div class="claer"></div>{{text}}</div>{{/messages}}',
	},
	
	init: function(options){	

		chat.options = $.extend(chat.options, options); 
		
		chat.return_messages(chat.options.step, chat.options.maxId, true, chat.getDefaultMessage);
		
		$(chat.options.sendButton).on('click', function(){
			if($(chat.options.inputMessage).val() != ''){
				chat.send_message($(chat.options.inputMessage).val());
			}
		});
		
		$(chat.options.loadMore).on('click', function(){
			chat.options.count = chat.options.count + chat.options.step;
			chat.return_messages(chat.options.count, chat.options.minId, false, chat.getOldMessage);
		});
		
		setInterval(function(){
			chat.return_messages(chat.options.step, chat.options.maxId, true, chat.getNewMessage);
		}, 1000);
		
	},
	
	send_message: function(message){
		chat.ajax('/contacts/ajax_write_message', {'message': message}, chat.clearMessagePlace);
	},
	
	clearMessagePlace: function(){
		$(chat.options.inputMessage).val('');
	},
	
	return_messages: function(count, id, delimiter, method){
		chat.ajax('/contacts/chat_ajax', {'count': count, 'id': id, 'delimiter': delimiter}, method);
	},
	
	getDefaultMessage: function(information){
		if( information.messages != null ){
			chat.options.maxId = information.max;
			chat.options.minId = information.min;
			chat.loadMessage(information, 'down');
		}
	},
	
	getNewMessage: function(information){
		if( information.messages != null )
		{
			chat.options.maxId = information.max;
			chat.loadMessage(information, 'up');
		}
	},
	
	getOldMessage: function(information) {
		
		if( information.messages != null )
		{
			chat.loadMessage(information, 'down');
		}
	},
	
	loadMessage: function(information, status){
		if(status == 'down')
		{	
			$(chat.options.loadMessage).append(chat.mustache.render(chat.options.template, information));
		}
		else if(status == 'up')
		{
			$(chat.options.loadMessage).prepend(chat.mustache.render(chat.options.template, information));
		}
	},
	
/**
* ajax request
*
* url - url to action for request
* data - request for data ( array or string )
* method - function with call'd after success query
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
				method(JSON.parse(data));		
			},
			error: function(jqXHR){
				console.log(jqXHR.status);
			}
				
		});
	},
};
