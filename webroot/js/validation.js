/**
 * 
 */
	$("input:radio:checked").next('input').attr("onChange", "validation(obj=$(this))");
	
	function select_telephone_validation(obj)
	{
		$('input:radio').next('input').removeAttr("onChange");
		$('input:radio').next('input').next('div').removeClass('yes').removeClass('no');
		$(obj).next('input').attr("onChange", "validation(obj=$(this))");
		validation($(obj).next('input'));
	}
	
	function submit_stop(obj)
	{
		$('input[onChange]').each(function(index, value){
			
			if($(value).val() == '')
			{
				$(value).next('div').addClass('no')
			}
		});
		
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
	
	function validation(obj)
	{
		var val = obj.attr('data').split(', ');
		var valid = obj.val();
		
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
					result = valid.replace(/[a-zA-Z]/g, '');
	
					if(result == '')
					{
						someclass = 'yes';
					}
					else{
						someclass = 'no';
					}
					break;
					
				case 'mail':
					result = valid.replace(/[a-zA-Z@.]/g, '');
					simbol = valid.search('@');
					
					if(result == '' && simbol != '-1')
					{
						someclass = 'yes';
					}
					else{
						someclass = 'no';
					}
					break;
				
				case 'number':
					result =	valid.replace(/[-0-9 ]/g, '');
					
					if(result == '')
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
		
		obj.next('div').removeClass('yes').removeClass('no').addClass(someclass);
	}
