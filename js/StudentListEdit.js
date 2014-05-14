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
				if(data['status'] == 'failed'){
					bootbox.alert('<div class="alert alert-danger"><strong>'+ data['errorMsg'] +'</strong></div>');		
				} else {
					bootbox.alert('<div class="alert alert-success">Mail został wysłany na adres <b>'+ email +'</b>!</div>');
				}
			},
			error: function (error) {
				alert('Wystąpil błąd przy wysyłaniu maila!');
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
				if(data['status'] == 'failed'){
					bootbox.alert('<div class="alert alert-danger"><strong>'+ data['errorMsg'] +'</strong></div>');		
				} else {
					bootbox.alert('<div class="alert alert-success"><strong>Maile zostały wysłane do studentów z listy!</strong></div>');	
				}				
			},
			error: function (error) {
				alert('Wystapil blad przy wysyłaniu mailów!');
			},
			complete: function() {
			}
		});
	});
	$('button#add_students').click( function(){

		var errorCounter = 0;
		var repetGlobalCounter = 0;

		var email_p = /[<]?(([^()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))[>]?/gm;

		var parts = $('#student_list').val().trim().split(",");

		if (parts != null) {

			for(var i = 0; i < parts.length; i++) {

				var repetCounter = 0;

				var elems = parts[i].trim().split(" ");

				if (parts[i] != null & parts[i] != "") {
				if (elems[elems.length-1].trim().match(email_p) != null) {

					var emailToAppend = elems[elems.length-1].trim().replace("<", "").replace(">", "");

					if (elems.length == 1) {

						$('.student').each(function(index, element) {
							if ($(element).find('#emails').text() == emailToAppend) {
								repetCounter++;
							}
						});

						if (repetCounter == 0) {
							addStudent("", "", emailToAppend);
							$('#student_list').val($('#student_list').val().trim().replace(parts[i], ""));

						} else {
							repetGlobalCounter++;
						}

					} else {

						var firstnameStr = elems[0].trim();
						var lastnameStr = "";

						for (var j = 1; j < elems.length-1; j++) {
							lastnameStr += " " + elems[j].trim();
						}

						$('.student').each(function(index, element) {
							if ($(element).find('#emails').text() == emailToAppend) {
								repetCounter++;
							}
						});

						if (repetCounter == 0) {
							addStudent(firstnameStr, lastnameStr, emailToAppend);
							$('#student_list').val($('#student_list').val().trim().replace(parts[i], ""));

						} else {
							repetGlobalCounter++;
						}
					}

				} else { errorCounter++;}
			}
		}
		}

		if(errorCounter > 0) {

			if (!($("div#error_msg").length > 0)) {
				$('div#student_input').append('<div id="error_msg" class="form-group has-error"><label class="control-label">Część danych została wprowadzona w niewłaściwym formacie</label></div>');
				$("div#error_msg").hide();
				$("div#error_msg").fadeIn();
			}
		} else {
			if ($("div#error_msg").length > 0) {
				$('div#error_msg').fadeOut();
			}
		}

		if(repetGlobalCounter > 0) {

			if (!($("div#repet_msg").length > 0)) {
				$('div#student_input').append('<div id="repet_msg" class="form-group has-warning"><label class="control-label">Niektóre dane zostały już wprowadzone</label></div>');
				$("div#repet_msg").hide();
				$("div#repet_msg").fadeIn();
			}
		} else {
			if ($("div#repet_msg").length > 0) {
				$('div#repet_msg').fadeOut();
			}
		}

});


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

function addStudent(fn, ln, em) {

		$.ajax({

			type: "POST",
			url: "lib/Ajax/AjaxStudentAddingRequest.php",
			dataType: "JSON",
			data: {
				exam_id : String(window.location).split("examID=")[1],
				firstname : fn,
				lastname : ln,
				email : em
			},
			success: function (data) {

				if (data != null) {

					var nr = $('#students').find('tr').size();
					var first = "";
					var last = "";

					if (data[1] == "") {
						first = "-";
					} else {
						first = data[1];
					}

					if (data[2] == "") {
						last = "-";
					} else {
						last = data[2];
					}

					$('table#students tbody').append('<tr class="student" id="' + data[0] + '"><td id="number" style="text-align: center;">' + nr +'.</td><td id="firstname">' + 
					first + '</td><td id="lastname">' + 
					last + '</td><td id="emails">' + 
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
