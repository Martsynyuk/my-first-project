

define('mustache', ['mustache'], function(mustache){});

require(['jquery-2.2.0'], function() {
	require(['jquery.cookie']);
	require(['mustache']);
	require(['chat_with_jquery'], function(){
		require(['main']);
	});
	//require(['test']);
});

