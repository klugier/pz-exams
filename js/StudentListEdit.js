$(document).ready(function() {

	// .modal-dialog{
 //  		width: 100%;
	// }

	// #myModal .modal-body {max-height: 800px;}

	$('button#add_students').click( function(){

	emails = new Array();
	first_names = new Array();
	last_names = new Array();

	var email_p = /<(([^()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))>/gm;
	var f_name_p = /[a-zA-Z\-\'\sżźćńółęąśŻŹĆĄŚĘŁÓŃ]+[\s]+</gm;
	var l_name_p = /[a-zA-Z\-\'\sżźćńółęąśŻŹĆĄŚĘŁÓŃ]+[\s]+</gm;
	var elements = $();

	 	
		emails = $('#student_list').val().match(email_p);
		first_names = $('#student_list').val().match(f_name_p);
		last_names = $('#student_list').val().match(l_name_p);

		if (emails != null && first_names != null && last_names != null) {
			for (var i = 0; i < first_names.length; i++){ 
				first_names[i] = first_names[i].replace("<", "").replace(">", "").split(" ")[0].trim();
			}

			for (var i = 0; i < last_names.length; i++) {
				last_names[i] = last_names[i].split(" ").splice(1, 2).join(' ').replace("<", "").trim();;
			}

		for (var i = 0; i < emails.length; i++) {
			emails[i] = emails[i].replace("<", "").replace(">", "");

			$.ajax({

			type: "POST",
			url: "lib/Ajax/AjaxStudentAddingRequest.php",
			dataType: "JSON",
			data: {
				exam_id : $('span#exam_id').text().trim(),
				firstname : first_names[i],
				lastname : last_names[i],
				email : emails[i]
			},
			success: function (data) {

				if (data != null) {

					var nr = $('#students').find('tr').size() - 1;

					$('table#students tbody').append('<tr id="' + data[0] + '"><td id="number">' + nr +'</td><td id="firstname">' + 
						data[1] + '</td><td id="lastname">' + 
						data[2] + '</td><td id="email">' + 
						data[3] + '</td><td style="text-align:center; vertical-align:middle;"><a><span id="edit" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Edit" class="glyphicon glyphicon-pencil"></span></a><a><span id="remove" data-toggle="tooltip" data-placement="bottom" title="Remove" class="glyphicon glyphicon-remove" style="margin-left: 10%; cursor: pointer;"></span></a></td></tr>');

					$('tr#'+data[0]).hide();
					$('tr#'+data[0]).fadeIn(500);

					$('#student_list').val("");
				}

			},
			error: function (error) {
				alert('Wystapil blad przy dodawaniu studenta/ów.');
			},
			complete: function() {
				
			}

			});

		}

	}

});


	$('body').on( "click", 'button#add', function(){
	//$('body').click(function() {

		var email_pattern =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		// if ($('input#firstname').val().trim() == '') {
		// 	$('div#fn').attr('class', 'form-group has-error');
		// } else {
		// 	$('div#fn').attr('class', 'form-group');
		// }

		// if ($('input#lastname').val().trim() == '') {
		// 	$('div#ln').attr('class', 'form-group has-error');
		// } else {
		// 	$('div#ln').attr('class', 'form-group');
		// }

		if ($('input#email').val().trim() == '' || !(email_pattern.test($('input#email').val().trim()))) {
			$('div#em').attr('class', 'input-group has-error');
		} else {
			$('div#em').attr('class', 'input-group');
		}

		if(
			//$('input#firstname').val().trim() != '' && $('input#lastname').val().trim() != '' && 
			$('input#email').val().trim() != '' && email_pattern.test($('input#email').val().trim()))
		{

			$.ajax({

			type: "POST",
			url: "lib/Ajax/AjaxStudentAddingRequest.php",
			dataType: "JSON",
			data: {
				exam_id : $('span#exam_id').text().trim(),
				//firstname : $('input#firstname').val().trim(),
				//lastname : $('input#lastname').val().trim(),
				email : $('input#email').val().trim()
			},
			success: function (data) {

				var nr = $('#students').find('tr').size() - 1;

				$('table#students tbody').append('<tr id="' + data[0] + '"><td id="number">' + nr +'</td><td id="firstname">' + 
					data[1] + '</td><td id="lastname">' + 
					data[2] + '</td><td id="email">' + 
					data[3] + '</td><td style="text-align:center; vertical-align:middle;"><a><span id="remove" data-toggle="tooltip" data-placement="bottom" title="Remove" class="glyphicon glyphicon-remove" style="margin-left: 10%; cursor: pointer;"></span></a></td></tr>');
				
				$('#' + data[0]).hide();
				$('#' + data[0]).fadeIn(500);

				//$('input#firstname').val("");
				$('input#lastname').val("");
				$('input#email').val("");

			},
			error: function (error) {
				alert('Wystapil blad przy dodawaniu studenta/ów.');
			},
			complete: function() {
				
			}

			});

		}

	});

		$('body').on( "click", 'span#edit', function(){

		if ($(this).attr('class') == 'glyphicon glyphicon-pencil')
			{
				var st_id = $(this).closest('tr').attr('id');

				$(this).closest('tr').children('#firstname').html('<div class="form-group" id="ef' + st_id + '" style="margin-bottom: 0px;"><input id="editf" type="text" class="form-control input-sm" style="width: 72%;" value="' + $(this).closest('tr').children('#firstname').text() +'"/></div>');
				$(this).closest('tr').children('#lastname').html('<div class="form-group" id="el' + st_id + '" style="margin-bottom: 0px;"><input id="editl" type="text" class="form-control input-sm" style="width: 72%;" value="' + $(this).closest('tr').children('#lastname').text() + '"/></div');
				$(this).closest('tr').children('#email').html('<div class="form-group" id="em' + st_id + '" style="margin-bottom: 0px;"><input id="editm" type="text" class="form-control input-sm" style="width: 72%;" value="' + $(this).closest('tr').children('#email').text() + '"/></div>');

				$(this).attr('title', 'Confirm');

				$(this).attr('class', 'glyphicon glyphicon-ok');
			}
			else
			{
				var st_id = $(this).closest('tr').attr('id');

				$(this).attr('title', 'Edit');

				if ($('div#ef' + st_id + ' input#editf').val().trim() == '') {
					$('div#ef' + st_id).attr('class', 'form-group has-error');
				} else {
					$('div#ef' + st_id).attr('class', 'form-group');
				}

				if ($('div#el' + st_id + ' input#editl').val().trim() == '') {
					$('div#el' + st_id).attr('class', 'form-group has-error');
				} else {
					$('div#el' + st_id).attr('class', 'form-group');
				}

				if ($('div#em' + st_id + ' input#editm').val().trim() == '') {
					$('div#em' + st_id).attr('class', 'form-group has-error');
				} else {
					$('div#em' + st_id).attr('class', 'form-group');
				}

				if($('div#ef' + st_id + ' input#editf').val().trim() != '' && $('div#el' + st_id + ' input#editl').val().trim() != '' && $('div#em' + st_id + ' input#editm').val().trim() != '')
				{

					$.ajax({

						type: "POST",
						url: "lib/Ajax/AjaxStudentUpdatingRequest.php",
						dataType: "JSON",
						data: {
							student_id : st_id,
							firstname : $('#editf').val().trim(),
							lastname : $('#editl').val().trim(),
							email : $('#editm').val().trim()
						},
						success: function (data) {

							$('tr#'+st_id).closest('tr').children('#firstname').html(data[0]);
							$('tr#'+st_id).closest('tr').children('#lastname').html(data[1]);
							$('tr#'+st_id).closest('tr').children('#email').html(data[2]);
							
							$('tr#'+st_id+' #edit').attr('class', 'glyphicon glyphicon-pencil');

						},
						error: function (error) {
							alert('Wystapil blad przy edycji danych studenta.');
						},
						complete: function() {
							
						}

						});

					}
		}

	});

		$('body').on( "click", 'span#remove', function(){

		var st_id = $(this).parent().parent().parent().first().attr('id');
		
		$.ajax({

			type: "POST",
			url: "lib/Ajax/AjaxStudentDeletingRequest.php",
			dataType: "JSON",
			data: {
				student_id : st_id,
				exam_id : $('span#exam_id').text().trim()
			},
			success: function (data) {

				if (data[0] && data[1])
				{

					$('tr#' + st_id).hide(300, function(){ 
						$('tr#' + st_id).remove(); 

						$('td#number').each(function(index) {
						$(this).text(index+1);
					});

					});
				}

			},
			error: function (error) {
				alert('Wystapil blad przy usuwaniu studenta.');
			},
			complete: function() {
				
			}

			});

	});

	$('#add_one_student').click(function() {

		if (!$('#mail_div').length)
		{
			$('#buttons').append('<div id="mail_div" class="col-lg-4"><div id="em" class="input-group"><input id="email" type="text" class="form-control input-sm" maxlength="50"><span class="input-group-btn"><button id="add" class="btn btn-default btn-sm" type="button"><span class="glyphicon glyphicon-plus"></span></button></span></div></div></div>');
			$('#mail_div').hide();
			$('#mail_div').fadeIn(400);

			$('#email').focus();

		}
	});

});