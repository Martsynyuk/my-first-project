
/**
 * creat new object for chat
 * 
 * step - increasing the sampling step messages from data base
 * 
 */

var chat = {
	step: 5,
/**
* ajax request
*
* url - url to action for request
* data - request for data ( array or string )
*/
	ajax: function(url, data){
		
		$.ajax({
			type: 'post',
			url: url,
			data: data,
			response:'json',
			success: function(data){
				this.data = data;			
			},
			error: function(){
				console.log('problem')
				this.data = false;
			}
				
		});
		
	},
/**
 * this method set cookie 
 * 
 * data - data for set cookie
 * time - time cookie live
 * url - url where cookie is available
 */
	set_cookie: function (data, time, url){	
		$.cookie('count', data, {expires: time, path: url});
	},
	
/**
* this method send new message to data base with ajax query
*/

	send_message: function () {

		if($('.for_message').val() != '')
		{
			if( ! this.ajax('/contacts/ajax_write_message', {'message': $('.for_message').val()}))
			{
				if( this.data )
				{
					$('.for_message').val('');
				}
			}
		}
	},

/**
* 
* this method return message from data base with ajax query
* 
*/
	
	return_message: function () {

		var count = '';
		
		if($('.cont').data('max') != null && $('.cont').data('min') != null )
		{
			this.date_max = $('.cont').data('max');
			this.date_min = $('.cont').data('min');
		}
		else{
			this.date_max = 0;
			this.date_min = 0;
		}
		
		if($.cookie('count') == null)
		{
			count = chat['step'];	
		}
		else{
			count = parseInt($.cookie('count'));
		}
		
		if( ! this.ajax('/contacts/chat_ajax', {'count': count, 'date_max': chat.date_max, 'date_min': chat.date_min}))
		{	
			if($('.cont').data('marker') != 0)
			{	
				if( this.data || this.data != null )
				{
					$('.message_plase').empty();
					$('.message_plase').append(this.data);
					this.data = null;
				}
			}
		}
	},
	
/**
* set counter for chat.return_message method
*  
*/

	load_more: function(){
		
		var count;
		
		if($.cookie('count') == null)
		{
			count = this.step;
			this.set_cookie(count, 1, '/');
		}
		else{
			count = parseInt($.cookie('count')) + this.step;
			this.set_cookie(count, 1, '/');
		}
		
	},
	
	ready: $( document ).ready(function() {
		
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
		
	})
};

