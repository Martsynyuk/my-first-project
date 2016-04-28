/**
 * 
 */


	var data = {
			  "newsCategory": "IT",
			  "news": [
				  {
					"id": 1,
					"title": "Write once, render anywhere", 
					"preview": "bla bla bla", 
					"date": "01.01.2012"
				  },
				  {
					"id": 2,
					"title": "Mustache in action", 
					"preview": "bla bla bla", 
					"date": "02.02.2012"
				  }
			  ]
			}
			$(function(){
				$("body").html(mustache.render($("body").html(), data));
			});
