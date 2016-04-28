

define('mustache', ['mustache'], function(mustache){});

require(['jquery-2.2.0'], function() {
	require(['jquery.cookie']);
	require(['mustache']);
	require(['main']);
	require(['chat_with_jquery']);
	//require(['test']);
});

