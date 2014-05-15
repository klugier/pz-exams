var char1 = "<";
var char2 = ">";
var separator = ",";
var emailsAdded = new Array();

$(document).ready(function() {

	$('button#add_students').attr("disabled", "disabled");

	$('body').on( 'click', 'a#send', function(){
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
		var rep = false;

		var email_p = new RegExp("^[\\" + char1 + "]?[\\w-_\.+]*[\\w-_\.]\@([\\w]+\\.)+[\\w]+[\\w][\\" + char2 +"]?$", "gm");

		var parts = $('#student_list').val().trim().split(separator);

		if (parts != null) {

			for(var i = 0; i < parts.length; i++) {

				var repetCounter = 0;

				var elems = parts[i].trim().split(" ");

				if (parts[i].trim() != "" && parts[i] != null) {

				 if (elems[elems.length-1].trim().match(email_p) != null) {

				 	var repThis = false;

					var emailToAppend = elems[elems.length-1].trim().replace(char1, "").replace(char2, "");
					emailsAdded.push(emailToAppend);

					for (var g = 0; g < emailsAdded.length-1; g++) {
						if (emailToAppend.trim() == emailsAdded[g]) {
							rep = true;
						}
					}

					for (var g = 0; g < emailsAdded.length-1; g++) {
						if (emailToAppend.trim() == emailsAdded[g]) {
							repThis = true;
					}}

					if (elems.length == 1) {

							addStudent("", "", emailToAppend);
												
							if (!repThis) {				
								var textToReplace = new RegExp(parts[i].trim() + '[\s]*[' + separator + ']?[\s]*');
								$('#student_list').val($('#student_list').val().trim().replace(textToReplace, "")); 
							}

							$('#student_list').val($('#student_list').val().trim());


					} else {

						var firstnameStr = elems[0].trim();
						var lastnameStr = "";

						for (var j = 1; j < elems.length-1; j++) {
							lastnameStr += " " + elems[j].trim();
						}

						addStudent(firstnameStr, lastnameStr, emailToAppend);
					 							
					 	if (!repThis) {
					 		var textToReplace = new RegExp(parts[i].trim() + '[\s]*[' + separator + ']?[\s]*');
							$('#student_list').val($('#student_list').val().trim().replace(textToReplace, ""));
						}

						$('#student_list').val($('#student_list').val().trim()); 
					}

				} else { 
					errorCounter++;
				}
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

		if(rep) {

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

					var isEmpty = false;

					if ($('tbody .student').length == 1) {
						isEmpty = true;
					}

					$('tr#' + st_id).hide(300, function(){ 
						$('tr#' + st_id).remove(); 

						$('td#number').each(function(index) {
						$(this).text((index+1) + '.');
					});

					});

					if (isEmpty) {
						$('#empty_list').fadeIn();

						$('#students').css('display', 'none');
					}


				}

			},
			error: function (error) {
				alert('Wystapił błąd przy usuwaniu studenta.');
			},
			complete: function() {
				
			}

			});

	});


	$('a#changeChars').click(function() {

		if ($(this).text() == "Zmień") {

			$('span#char1').html('<input id="charToSet1" type="text" value="' + char1 + '" style="width: 3%; margin-right: 0px;" maxlength="1"/>');
			$('span#char2').html('<input id="charToSet2" type="text" value="' + char2 + '" style="width: 3%; margin-right: 0px;" maxlength="1"/>');
			$('span#separator').html('<input id="separatorToSet" type="text" value="' + separator + '" style="width: 3%; margin-right: 0px;" maxlength="1"/>');
		
			$('a#changeChars').text('Zatwierdź');

			$('button#add_students').attr('disabled', 'disabled');

		} else {

			char1 = $('#charToSet1').val();
			char2 = $('#charToSet2').val();
			separator = $('#separatorToSet').val();

			$('span#char1').html(char1);
			$('span#char2').html(char2);
			$('span#separator').html(separator);

			$('a#changeChars').text('Zmień');

			$('button#add_students').removeAttr("disabled");
		}
	});

	$('#student_list').keyup(function() {

		if ($('#student_list').val().trim() == "") {
			$('button#add_students').attr("disabled", "disabled");
		} else {
			$('button#add_students').removeAttr("disabled");
		}
	});

	$('#student_list').change(function() {

		if ($('#student_list').val().trim() == "") {
			$('button#add_students').attr("disabled", "disabled");
		} else {
			$('button#add_students').removeAttr("disabled");
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

					$('#empty_list').fadeOut();

					$('#students').css('display', '');

				}

			},
			error: function (error) {
				alert('Wystapil blad przy dodawaniu studenta/ów.');
			},
			complete: function() {
				
			}

			});

	
}
