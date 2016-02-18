
// pagination 
$( document ).ready(function() {
	
	$('tr.top input').on('click', function(e) {
		e.preventDefault();
	});

	$('tr.top a').on('click', function(e) {
		e.preventDefault();
	});
	
	$('div.pagination input').on('click', function(e) {
		e.preventDefault();
	});
	
	$('div.pagination a').on('click', function(e) {
		e.preventDefault();
	});
	
	$('a.delete').on('click', function(e) {
		e.preventDefault();
	});
	
	$('div.cont_top a').on('click', function(e) {
		e.preventDefault();
	});
});

function pagination(page)
{		
	
	var sortFirst = $('.active_sortFirst').attr('title');
	var sortSecond = $('.active_sortSecond').attr('title');
					
	history.pushState(null, null, '/' + page + '/');
					
	$.ajax({
		type: 'post',
		url: '/contacts/ajax_index',
		data:{'page': page, 'first': sortFirst, 'second': sortSecond},
		response:'html',
		success: function(data){
			$('.cont').empty();
			$('.cont').append(data);	
		},
		error: function(data){
			alert('error')
		},
		complete: function(){
			checked_checkbox();
		}
	});
}		

function sort(sortFirst, sortSecond)
{
	var page = $('.page_active').text();
	
	history.pushState(null, null, '/' + page + '/');
					
	$.ajax({
		type: 'post',
		url: '/contacts/ajax_index',
		data:{'page': page, 'first': sortFirst, 'second': sortSecond},
		response:'html',
		success: function(data){
			$('.cont').empty();
			$('.cont').append(data);	
		},
		error: function(data){
			alert('error')
		},
		complete: function(){
			checked_checkbox();
		}
	});
}

// end pagination

// delete in index file 

function window_for_delete(user, obj)
{
	$('#delete_contact').css('display', 'block');
	user = user.split(', ');
	$('#text').text('You really want to delete contact - ' + user[1] + ' ?');
	$('#yes').attr('data', user)
}

function close_window_for_delete()
{
	$('#delete_contact').css('display', 'none');	
}

function delete_contact(user)
{
	user = user.split(',');
	
	$.ajax({
		type: 'post',
		url: '/contacts/ajax_contact_delete',
		data:{'user': user[0]},
		response:'html',
		success: function(){
			$('#yes').css('display', 'none');
			$('#no').css('display', 'none');
			$('#text').text('Contact ' + user[1] + ' deleted');
			setTimeout(function() {
				$('#delete_contact').css('display', 'none');
				
				pagination($('.page_active').text());
			}, 2000);
			
		},
				  
	});
		
}

//checkbox

function check_all(obj)
{
	var checking_all = $(obj).text()
	
	if(checking_all == 'All')
	{			
		$("input:checkbox").prop("checked", true);
		$(obj).text('Off');
		$("input:checkbox").each(function(key, val){
			check(val);
		});
	}
	else
	{
		$("input:checkbox").prop("checked", false);
		$(obj).text('All');
		$("input:checkbox").each(function(key, val){
			check(val);
		});
	}
}

function check(obj)
{
	var check = $(obj).attr('data');
	
	if($(obj).is(':checked'))
	{
		
		if($.cookie('select') == null || $.cookie('select') == '')
		{
			$.cookie('select', check, {expires: 1, path: '/'});
		}
		else{
			check = check + ', ' + $.cookie('select');
			$.cookie('select', check, {expires: 1, path: '/'});
		}
	}
	else{
		
		if($.cookie('select') == null || $.cookie('select') == '')
		{
			
		}
		else{
			array = $.cookie('select').split(', ');
			$.each(array, function(key, val){
			
				if(val == check)
					{
						array.splice($.inArray(val, array), 1);
					}
			});
			
			check = array.join(', ');
			
			$.cookie('select', check, {expires: 1, path: '/'});
		}
	 
	}
	
	array = $.cookie('select').split(', ');
	array = jQuery.unique(array)	
	check = array.join(', ');
			
	$.cookie('select', check, {expires: 1, path: '/'});
}

function checked_checkbox()
{
	
	if($.cookie('select') != null)
	{
		
		contacts_id = $.cookie('select').split(', ');

		jQuery.each(contacts_id, function(key, value){
			
			$("input:checkbox[data='" + value + "']").prop("checked", true);
			
		});
	}

}