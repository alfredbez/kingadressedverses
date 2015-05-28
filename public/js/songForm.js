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
	var updateList = function(list, newOption) {
		$.ajax({
		    url: '/' + list,
		    type: 'GET',
		    success: function(data) {
		    		var el = $('select[name="' + list + '_id"]');
		    		el.html('');
		    		$.each(data, function(index, row){
		    			el.append('<option value="' + row.id + '">' + row.name + '</option>');
		    		});
		    		selectNewOption(list, newOption)
		    		$('#new' + toTitleCase(list) + 'Name').val('');
		    }
		});
	};
	var selectNewOption = function(list, option) {
		$('select[name="' + list + '_id"]')
			.find('option:contains("' + option + '")')
			.attr('selected', 'selected');
	};
	var registerListAddButton = function(list) {
		$('body').on('click', '#new' + toTitleCase(list), function () {
			var newOption = $.trim( $('#new' + toTitleCase(list) + 'Name').val() );
			$.ajax({
			    url: '/' + list,
			    type: 'POST',
			    data: 'name=' + newOption,
			    success: function(data) {
			    		updateList(list, newOption);
			    }
			});
		});
	};
	var showFileEditForm = function () {;
		var id = $(this).data('id');
		var el = $('.list-group-item[data-id=' + id + ']');
		var form = $('#fileEditForm');
		var name = el.find('a');
		var input = form.find('input');
		form.show();
		input.val(name.text());
		$('#fileEditSubmit').click(function(){
			var newName = $.trim( input.val() );
			$.ajax({
			    url: '/file/' + id,
			    type: 'POST',
			    data: {
			    	'name'		: newName + '.' + $.trim( el.find('label').text() ),
			    	'_method'	: 'PUT'
			    },
			    success: function(data) {
			    		form.hide();
			    		$("#fileEditSubmit").off();
			    		name.text(newName);
			    }
			});
		});
	};
	$('body').on('click', '.editFile', showFileEditForm);
	registerListAddButton('category');
	registerListAddButton('composer');
	registerListAddButton('orchestration');
});