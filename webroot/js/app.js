requirejs.config({
    baseUrl: '/js',
    paths: {
        // the left side is the module ID,
        // the right side is the path to
        // the jQuery file, relative to baseUrl.
        // Also, the path should NOT include
        // the '.js' file extension. This example
    	app: '/',
        jquery: 'jquery-2.2.0',
        chat: 'chat_with_jquery',
    }
});

define("muctacheWithChat", function() {
	return function Chat(mustache, chat) {
        this.mustache = mustache; 
        this.chat = chat;
    };
});

/*define("main", ["muctacheWithChat", "mustache", "chat"], function (muctacheWithChat, mustache, chat) {
    var john = new muctacheWithChat(mustache, chat);
    return john;
});*/


require(['jquery'], function() {
	require(['jquery.cookie']);
	require(['mustache'], function(mustache){
		require(['chat'], function(chat){
			require(['start_chat']);
		});
		//require(['test']);
	});
	require(['main']);
});

//http://stackoverflow.com/questions/4869530/requirejs-how-to-define-modules-that-contain-a-single-class