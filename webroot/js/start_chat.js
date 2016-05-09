/**
 * 
 */
$( document ).ready(function() {
	
	/**
	 * propertis for chat
	 * 
	 * step - message sampling step
	 * inputMessage - field for text message
	 * sendButton - button for send message
	 * loadMore - button for load old message
	 * loadMessage - place for load message
	 * 
	 */
	chat.init({
		step: 5, 
		inputMessage: 'input.for_message',
		sendButton: 'input.submit',
		loadMore: 'span.load_more',
		loadMessage: 'div.message_plase',
	});
	
});