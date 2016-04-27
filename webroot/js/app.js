
/*define( 'test',
        ['jquery-2.2.0'],
        function( $ ){
          
        }
);
*/

require(['jquery-2.2.0'], function() {
	require(['jquery.cookie']);
	require(['mustache']);
	require(['main']);
	require(['chat']);
});
/*
require(['jquery-2.2.0'], function() {
	require(['mustache'], function(){
		require(['test']);
	});
	
});
*/