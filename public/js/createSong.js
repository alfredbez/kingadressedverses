$(document).ready(function(){

	$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	var toTitleCase = function(str){
		return str[0].toUpperCase() + str.substr(1).toLowerCase();
	}

	/* neue Kategorie anlegen */
	var updateList = function(list){
		$.ajax({
		    url: '/' + list,
		    type: 'GET',
		    success: function(data) {
		    		var el = $('select[name="' + list + '"]');
		    		el.html('');
		    		$.each(data, function(index, row){
		    			el.append('<option value="' + row.id + '">' + row.name + '</option>');
		    		});
		    		$('#new' + toTitleCase(list) + 'Name').val('');
		    }
		});
	};
	var registerListAddButton = function(list) {
		$('body').on('click', '#new' + toTitleCase(list), function () {
			$.ajax({
			    url: '/' + list,
			    type: 'POST',
			    data: 'name=' + $('#new' + toTitleCase(list) + 'Name').val(),
			    success: function(data) {
			    		updateList(list);
			    }
			});
		});
	}
	registerListAddButton('category');
	registerListAddButton('composer');
	registerListAddButton('orchestration');
});