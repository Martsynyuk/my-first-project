
// pagination 

$( document ).ready(function() {
	
	$('.cont, .content').on('click', 'tr.top input, div.cont_top a',  function(e) {
		sort(e);
	});
	
	$('.cont, .content').on('click', 'tr.top a',  function(e) {
		check_all(e);
	});
		
	$('.cont, .content').on('click', 'div.pagination input, div.pagination a', function(e) {
		pagination($(this).attr('data'), e);
	});
	
	$('.cont, .content').on('click', 'a.delete', function(e) {
		window_for_delete(e);		
	});

});

function pagination(page, e)
{	
	var url = [$('.main').data('class'), $('.main').data('method')];

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
	var url = [$('.main').data('class'), $('.main').data('method')];
	
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

function delete_contact(contact)
{
	contact = contact.split(',');
	
	$.ajax({
		type: 'post',
		url: '/contacts/ajax_contact_delete',
		data:{'contact': contact[0]},
		response:'html',
		success: function(){
			$('#yes').css('display', 'none');
			$('#no').css('display', 'none');
			$('#text').text('Contact ' + contact[1] + ' deleted');

			startFrom = 3;
			$('#countdown span').text(startFrom).parent('p').show();
			timer = setInterval(function(){
				$('#countdown span').text(--startFrom);
			    if(startFrom <= 0) {
			        clearInterval(timer);
			        $('#delete_contact').css('display', 'none');
			        pagination($('.page_active').text());
			    }
			},1000);

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
	
	contact_id = $.cookie('select').split(', ');
	contact_id = $.unique(contact_id)	
	check = contact_id.join(', ');
			
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
	
}