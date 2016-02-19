
// pagination 

$( document ).ready(function() {
	
	$('tr.top input').on('click', function(e) {
		sort(e);
	});

	$('tr.top a').on('click', function(e) {
		check_all(e);
	});
	
	$('div.pagination input').on('click', function(e) {
		pagination($(this).attr('data'), e);
	});

	$('a.delete').on('click', function(e) {
		window_for_delete(e);
		
	});
		
	$('div.pagination a').on('click', function(e) {		
		pagination($(this).attr('data'), e);		
	});
	
	
	$('div.cont_top a').on('click', function(e) {
		sort(e);
	});
});

function pagination(page, e)
{	
	if(e != undefined )
	{
		e.preventDefault();
	}
	var sortFirst = $('.active_sortFirst').attr('data');
	var sortSecond = $('.active_sortSecond').attr('data');
	
	if(url[1] == 'index')
	{
		history.pushState(null, null, '/' + page + '/');
	}
	else{
		history.pushState(null, null, '/'+ url[0] + '/' + url[1] + '/' + page + '/');
	}
						
	$.ajax({
		type: 'post',
		url: '/' + url[0] + '/ajax_' + url[1],
		data:{'page': page, 'first': sortFirst, 'second': sortSecond},
		response:'html',
		success: function(data){
			$('.cont').empty();
			$('.cont').append(data);
			$('.contact').empty();
			$('.contact').append(data);
		},
		error: function(data){
			alert('error')
		},
		complete: function(){
			checked_checkbox();
		}
	});
}		

function sort(e)
{
	
	var sorting = $(e.currentTarget).attr('data');

	if(sorting == 'FirstNameUp' || sorting == 'FirstNameDown')
	{
		var sortFirst = sorting;
		var sortSecond = $('.active_sortSecond').attr('data');
	}
	else if(sorting == 'LastNameUp' || sorting == 'LastNameDown')
	{
		var sortFirst = $('.active_sortFirst').attr('data');
		var sortSecond = sorting;
	}

	e.preventDefault();
	
	var page = $('.page_active').attr('data');
	console.log(page);
	if(url[1] == 'index')
	{
		history.pushState(null, null, '/' + page + '/');
	}
	else{
		history.pushState(null, null, '/'+ url[0] + '/' + url[1] + '/' + page + '/');
	}
					
	$.ajax({
		type: 'post',
		url: '/' + url[0] + '/ajax_' + url[1],
		data:{'page': page, 'first': sortFirst, 'second': sortSecond},
		response:'html',
		success: function(data){
			$('.cont').empty();
			$('.cont').append(data);
			$('.contact').empty();
			$('.contact').append(data);
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

function window_for_delete(e)
{
	e.preventDefault();
	$('#delete_contact').css('display', 'block');
	user = $(e.currentTarget).attr('data').split(', ');
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

			time = 3
			startFrom = time;
			$('#countdown span').text(startFrom).parent('p').show();
			timer = setInterval(function(){
				$('#countdown span').text(--startFrom);
		    if(startFrom <= 0) {
		        clearInterval($('#countdown span'));
		        $('#countdown span').text('');
		        $('#delete_contact').css('display', 'none');
				
		    }
		},1000);
			
			setTimeout(function() {
				pagination($('.page_active').text());
			}, time + '000');
		}
				  
	});
		
}

//checkbox

function check_all(e)
{
	e.preventDefault();	
	var checking_all = $(e.currentTarget).text()

	if(checking_all == 'All')
	{			
		$("input:checkbox").prop("checked", true);
		$(e.currentTarget).text('Off');
		$("input:checkbox").each(function(key, val){
			check(val);
			
		});
	}
	else
	{
		$("input:checkbox").prop("checked", false);
		$(e.currentTarget).text('All');
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
	array = $.unique(array)	
	check = array.join(', ');
			
	$.cookie('select', check, {expires: 1, path: '/'});
}

function checked_checkbox()
{
	if($.cookie('select') != null)
	{
		contacts_id = $.cookie('select').split(', ');

		$.each(contacts_id, function(key, value){
			
			$("input:checkbox[data='" + value + "']").prop("checked", true);
			
		});
	}
	
	if($( "input:checked" ).length == 5)
	{
		$('th.all a').text('Off');
	}
	
}