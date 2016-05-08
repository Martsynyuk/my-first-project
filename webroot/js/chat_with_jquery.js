
/**
 * creat new object for chat
 * 
 */

var chat = {
	step: 5, 
	inputMessage: 'input.for_message',
	sendButton: 'input.submit',
	loadMore: 'span.load_more',
	loadMessage: 'div.message_plase',
	minId: 0,
	maxId: 0,
	count: 0,
	flag: 0,
	
	options: {},
	init: function(options){
		chat.options = options;
		
		$(options.sendButton).on('click', function(){
			if($(options.inputMessage).val() != ''){
				chat.send_message($(options.inputMessage).val());
			}
		});
		
		$(options.loadMore).on('click', function(){
			chat.flag = 2;
			chat.count = chat.count + chat.options.step;
			chat.return_messages(chat.count, chat.minId, '<', chat.getMessage);
		});
		
		setInterval(function(){
			chat.return_messages(chat.options.step, chat.maxId, '>', chat.getMessage);
		}, 1000);
	
	},
	
	send_message: function(message){
		chat.ajax('/contacts/ajax_write_message', {'message': message}, chat.clearMessagePlace);
	},
	
	clearMessagePlace: function(){
		$(chat.options.inputMessage).val('');
	},
	
	return_messages: function(count, id, delimeter, method){
		chat.ajax('/contacts/chat_ajax', {'count': count, 'id': id, 'delimeter': delimeter}, method);
	},
	
	getMessage: function(information) {
		
		if( information[0] != null )
		{
			if(chat.flag == 0)
			{	
				chat.maxId = information.max;
				chat.minId = information.min;
				chat.flag = 1;
				chat.loadMessage(information, 'down');
			}
			else if(chat.flag == 1)
			{
				chat.maxId = information.max;
				chat.loadMessage(information, 'up');
			}
			else{
				chat.flag = 1;
				chat.loadMessage(information, 'down');
			}
		}
	},
	
	loadMessage: function(information, status){
		if(status == 'down')
		{
			for( var key in information ){
				if(information[key] !== null && typeof information[key] === 'object')
				{	
					var date = new Date(information[key].date);
					
					$(chat.options.loadMessage).append('<div class="message"><span class="name">' + information[key].user_name + 
							'</span><span class="date">on ' + date.getDay() + '/' + date.getMonth() + '/' + date.getFullYear() +
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
					var date = new Date(information[key].date);
					
					$(chat.options.loadMessage).prepend('<div class="message"><span class="name">' + information[key].user_name + 
							'</span><span class="date">on ' + date.getDay() + '/' + date.getMonth() + '/' + date.getFullYear() +
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
			error: function(){
				console.log('problem')
			}
				
		});
	},
	
};
