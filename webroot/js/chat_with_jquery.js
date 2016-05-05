
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
			chat.return_messages(chat.options.maxId);
		}, 1000);
	
	},
	
	send_message: function(message){
		chat.ajax('/contacts/ajax_write_message', {'message': message}, chat.clearMessagePlace);
	},
	
	clearMessagePlace: function(data){
		$(chat.options.inputMessage).val('');
	},
	
	return_messages: function(id){
		chat.ajax('/contacts/chat_ajax', {'count': chat.options.step, 'id': id}, chat.getData);
	},
	
	getData: function(data) {
		
		if( data.length > 2 )
		{
			var information = JSON.parse(data); 
			
			if(chat.options.flag != 1)
			{
				chat.options.minId = information.min;
				chat.options.maxId = information.max;
				
				chat.options.flag = 1;
				
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
			else{
				chat.options.maxId = information.max;
				
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
				method(data);			
			},
			error: function(){
				console.log('problem')
			}
				
		});
	},
	
};
