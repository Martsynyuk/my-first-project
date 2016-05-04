
$( document ).ready(function() {
	
	chat.test = ({
		inputMessage: $('.for_message'),
		sendButton: $('.submit'),
		loadMore: $('.load_more')
	});
	
});

var chat = {
		step: 5,
		init: function(options) {
			
			options.sendButton.on('click', '.submit', function(e){
				console.log('test');
				e.preventDefault();
			});

		}
};


