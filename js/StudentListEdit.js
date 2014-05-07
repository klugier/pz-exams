$(document).ready(function() {

	$("a[id^=send").click(function() {
		var studentID = $(this).parent().parent().first().attr('id');
		var email = $(this).parent().parent().find("#emails").html();
		
		$.ajax({
			type: "POST",
			url: "lib/Ajax/AjaxSendMailsToStudents.php",
			dataType: "JSON",
			data: {
				examID : String(window.location).split("examID=")[1],
				studentID : studentID,				
			},
			success: function (data) {
				bootbox.alert('<div class="alert alert-success">Mail został wysłany na adres <b>'+ email +'</b>!</div>');
			},
			error: function (error) {
				alert('Wystapil blad przy wysyłaniu mailów!');
			},
			complete: function() {
			}
		});
	});

	$('button#sendEmails').click( function() {
		$.ajax({
			type: "POST",
			url: "lib/Ajax/AjaxSendMailsToStudents.php",
			dataType: "JSON",
			data: {
				examID : String(window.location).split("examID=")[1],
				mails : 1,				
			},
			success: function (data) {
				bootbox.alert('<div class="alert alert-success"><strong>Maile zostały wysłane do studentów z listy!</strong></div>');	
			},
			error: function (error) {
				alert('Wystapil blad przy wysyłaniu maila!');
			},
			complete: function() {
			}
		});
	});
	$('button#add_students').click( function(){

		var email_p = /(([^()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/gm;
		var full_name_p = /[a-zA-Z\-\'\sżźćńółęąśŻŹĆĄŚĘŁÓŃ]+[\s]+/gm;
		var elements = $();

		var emails = $('#student_list').val().match(email_p);
		var full_names = $('#student_list').val().match(full_name_p);

		var first_names = new Array();
		var last_names = new Array();

		for (var i = 0; i < full_names.length; i++) {

			full_names[i] = full_names[i].trim();

			var pieces = full_names[i].split(" ");
			first_names.push(pieces[0].trim());

			pieces.shift();

			last_names.push(pieces.join(" "));

		}

		if (emails != null && first_names != null && last_names != null) {

		for (var i = 0; i < emails.length; i++) {

			emails[i] = emails[i].replace("<", "").replace(">", "");

			$.ajax({

			type: "POST",
			url: "lib/Ajax/AjaxStudentAddingRequest.php",
			dataType: "JSON",
			data: {
				exam_id : String(window.location).split("examID=")[1],
				firstname : first_names[i],
				lastname : last_names[i],
				email : emails[i]
			},
			success: function (data) {

				if (data != null) {

					var nr = $('#students').find('tr').size();

					$('table#students tbody').append('<tr id="' + data[0] + '"><td id="number" style="text-align: center;">' + nr +'.</td><td id="firstname">' + 
					data[1] + '</td><td id="lastname">' + 
					data[2] + '</td><td id="email">' + 
					data[3] + '</td><td style="text-align:center; vertical-align:middle;"><a><i id="remove" title="Remove" class="glyphicon glyphicon-trash" style="margin-right: 5px; cursor: pointer;"></i></a><a id="send" title="Wyślij wiadomość z kodem dostępu do studenta" style="cursor: pointer;"><i class="glyphicon glyphicon-envelope"></i></a></td></tr>');

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
				exam_id : String(window.location).split("examID=")[1],
				//firstname : $('input#firstname').val().trim(),
				//lastname : $('input#lastname').val().trim(),
				email : $('input#email').val().trim()
			},
			success: function (data) {

				var nr = $('#students').find('tr').size();

				$('table#students tbody').append('<tr id="' + data[0] + '"><td id="number" style="text-align: center;">' + nr +'.</td><td id="firstname">' + 
					data[1] + '</td><td id="lastname">' + 
					data[2] + '</td><td id="email">' + 
					data[3] + '</td><td style="text-align:center; vertical-align:middle;"><a><i id="remove" title="Remove" class="glyphicon glyphicon-trash" style="margin-right: 5px; cursor: pointer;"></i></a><a id="send" title="Wyślij wiadomość z kodem dostępu do studenta" style="cursor: pointer;"><i class="glyphicon glyphicon-envelope"></i></a></td></tr>');
				
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

	// 	$('body').on( "click", 'a#edit', function(){

	// 	if ($(this).attr('class') == 'glyphicon glyphicon-pencil')
	// 		{
	// 			var st_id = $(this).closest('tr').attr('id');

	// 			$(this).closest('tr').children('#firstname').html('<div class="form-group" id="ef' + st_id + '" style="margin-bottom: 0px;"><input id="editf" type="text" class="form-control input-sm" style="width: 72%;" value="' + $(this).closest('tr').children('#firstname').text() +'"/></div>');
	// 			$(this).closest('tr').children('#lastname').html('<div class="form-group" id="el' + st_id + '" style="margin-bottom: 0px;"><input id="editl" type="text" class="form-control input-sm" style="width: 72%;" value="' + $(this).closest('tr').children('#lastname').text() + '"/></div');
	// 			$(this).closest('tr').children('#email').html('<div class="form-group" id="em' + st_id + '" style="margin-bottom: 0px;"><input id="editm" type="text" class="form-control input-sm" style="width: 72%;" value="' + $(this).closest('tr').children('#email').text() + '"/></div>');

	// 			$(this).attr('title', 'Confirm');

	// 			$(this).attr('class', 'glyphicon glyphicon-ok');
	// 		}
	// 		else
	// 		{
	// 			var st_id = $(this).closest('tr').attr('id');

	// 			$(this).attr('title', 'Edit');

	// 			if ($('div#ef' + st_id + ' input#editf').val().trim() == '') {
	// 				$('div#ef' + st_id).attr('class', 'form-group has-error');
	// 			} else {
	// 				$('div#ef' + st_id).attr('class', 'form-group');
	// 			}

	// 			if ($('div#el' + st_id + ' input#editl').val().trim() == '') {
	// 				$('div#el' + st_id).attr('class', 'form-group has-error');
	// 			} else {
	// 				$('div#el' + st_id).attr('class', 'form-group');
	// 			}

	// 			if ($('div#em' + st_id + ' input#editm').val().trim() == '') {
	// 				$('div#em' + st_id).attr('class', 'form-group has-error');
	// 			} else {
	// 				$('div#em' + st_id).attr('class', 'form-group');
	// 			}

	// 			if($('div#ef' + st_id + ' input#editf').val().trim() != '' && $('div#el' + st_id + ' input#editl').val().trim() != '' && $('div#em' + st_id + ' input#editm').val().trim() != '')
	// 			{

	// 				$.ajax({

	// 					type: "POST",
	// 					url: "lib/Ajax/AjaxStudentUpdatingRequest.php",
	// 					dataType: "JSON",
	// 					data: {
	// 						student_id : st_id,
	// 						firstname : $('#editf').val().trim(),
	// 						lastname : $('#editl').val().trim(),
	// 						email : $('#editm').val().trim()
	// 					},
	// 					success: function (data) {

	// 						$('tr#'+st_id).closest('tr').children('#firstname').html(data[0]);
	// 						$('tr#'+st_id).closest('tr').children('#lastname').html(data[1]);
	// 						$('tr#'+st_id).closest('tr').children('#email').html(data[2]);
							
	// 						$('tr#'+st_id+' #edit').attr('class', 'glyphicon glyphicon-pencil');

	// 					},
	// 					error: function (error) {
	// 						alert('Wystapil blad przy edycji danych studenta.');
	// 					},
	// 					complete: function() {
							
	// 					}

	// 					});

	// 				}
	// 	}

	// });

		//alert(window.location.split('ExamID=')[1]);

		$('body').on( "click", 'i#remove', function(){

		var st_id = $(this).parent().parent().parent().first().attr('id');

		$.ajax({

			type: "POST",
			url: "lib/Ajax/AjaxStudentDeletingRequest.php",
			dataType: "JSON",
			data: {
				student_id : st_id,
				exam_id : String(window.location).split("examID=")[1]
			},
			success: function (data) {

				if (data)
				{

					$('tr#' + st_id).hide(300, function(){ 
						$('tr#' + st_id).remove(); 

						$('td#number').each(function(index) {
						$(this).text((index+1) + '.');
					});

					});
				}

			},
			error: function (error) {
				alert('Wystapił błąd przy usuwaniu studenta.');
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
