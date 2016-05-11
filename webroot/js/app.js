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
    },

});

require(['jquery'], function() {
	require(['mustache', 'jquery.cookie', 'main'], function(mustache){
		require(['chat'], function(){
			chat.mustache = mustache;
			require(['start_chat']);
		});
	});
});
