/**
 * 
 */
"use strict";

$("input:radio:checked").next('input').attr("onChange", "valid.validation($(this))");
	
class Valid
{	
	select_telephone_validation(obj)
	{
		
		$('input:radio').next('input').removeAttr("onChange");
		$('input:radio').next('input').next('div').removeClass('yes').removeClass('no');
		$(obj).next('input').attr("onChange", "valid.validation($(this))");
		
		this.validation($(obj).next('input'));
	}

	submit_stop(obj)
	{
		
		$('input[onChange]').each(function(index, value){
			
			if($(value).val() == '')
			{
				$(value).next('div').addClass('no')
			}
			parent:valid.validation($(value));
			
		});
		
		this.select_telephone_validation($("input:radio:checked"));
		
		if(this.date_validation())
		{
			$('#valid-year').next('div').removeClass('no').addClass('yes');
		}
		else{
			$('#valid-year').next('div').removeClass('yes').addClass('no');
		}
		
		if($('div').is('.no'))
			{
				$(obj).css('color', 'red')
				
				setTimeout(function() {
					$(obj).css('color', 'white')
				}, 800);
				
				return false;
			}
		
		return true;
		
	}
	
	validation(obj)
	{	
		var val = obj.attr('data').split(', ');
		var valid = obj.val();
		var someclass = '';
		
		$.each(val, function(index, value){
			
			if($.isNumeric(value))
				{
					if( valid.length < value && value < 30)
					{
						someclass = 'yes';
					}	
					else{
						someclass = 'no';
						return false;
					}	
				}
			
			switch(value)
			{
				case 'text':				
					var result = valid.replace(/[a-zA-Z]/g, '');
	
					if(result == '')
					{
						someclass = 'yes';
					}
					else{
						someclass = 'no';
					}
					break;
					
				case 'mail':
					var result = valid.replace(/[a-zA-Z@.]/g, '');
					var simbol = valid.search('@');
					
					if(result == '' && simbol != '-1')
					{
						someclass = 'yes';
					}
					else{
						someclass = 'no';
					}
					break;
				
				case 'number':
					
					var result = valid.replace(/[-0-9 ]/g, '');
					
					if(result == '')
					{
						someclass = 'yes';
					}
					else{
						someclass = 'no';
					}
					break;
				case 'date':
					if(date_validation())
					{
						someclass = 'yes';
					}
					else{
						someclass = 'no';
					}
					break;
			}
			
			if( someclass == 'no')
				{
					return false;
				}
			else if(valid == '')
				{
					someclass = 'no';
					return false;
				}
			
			
		});
		//console.log(someclass);
		obj.next('div').removeClass('yes').removeClass('no').addClass(someclass);
	}
	
	date_validation()
	{
		
		var str = $('#valid-year option').val() + '-'
				+ $('#valid-month option').val() + '-'
				+ $('#valid-day option').val();
		
		var regular = /^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/i;
		
	    if (!regular.test(str))
	    {
	    	return false;
	    }
	    else{
				var result = str.split('-');
				
		    var y = parseInt(result[0]);
		    var m = parseInt(result[1]);
		    var d = parseInt(result[2]);

		    if (m < 1 || m > 12 || y < 1900 || y > 2000)
		    {
		    	return false;
		    }
		    else{
			    if (m == 2){
			    	var days = ((y % 4) == 0) ? 29 : 28;
			    } 
			    else if(m == 4 || m == 6 || m == 9 || m == 11){
			    	var days = 30;
			    } 
			    else{
			    	var days = 31;
			    }
			    
			    if(d >= 1 && d <= days)
			    {
			    		
			    }
			    else{
			    	return false;
			    }
		    }
	    }
	    
	    return true;
	}
}

var valid = new Valid();