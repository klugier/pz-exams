var emails;
var first_names;
var last_names;

// GLOBAL FUNCTIONS SECTION BEGIN *********************************************************************************************************
function go_to_stage2()
{
	var errors = new Array();

	if($('input#exam_name').val().trim() == "") {
			$('div#exam_name_group').attr('class', 'form-group has-error');
			errors[errors.length] = true;
			$('span#exam_name-error-message').remove();
			$('div#exam_name_group').append('<span class="help-block" id="exam_name-error-message">Podaj nazwę egzaminu</span>');
			$('span#exam_name-error-message').hide();
			$('span#exam_name-error-message').fadeIn(500);
	} else {
			$('div#exam_name_group').attr('class', 'form-group');
			errors[errors.length] = false;
			$('span#exam_name-error-message').remove();
	}

	if($('input#exam_duration').val() == "") {
			$('div#duration_group').attr('class', 'form-group has-error');
			errors[errors.length] = true;
			$('span#duration-error-message').remove();
			$('div#duration_group').append('<span class="help-block" id="duration-error-message">Podaj czas trwania egzaminu</span>');
			$('span#duration-error-message').hide();
			$('span#duration-error-message').fadeIn(500);
	} else {
			$('div#duration_group').attr('class', 'form-group');
			errors[errors.length] = false;
			$('span#duration-error-message').remove();
	}

	for(var i = 0; i < errors.length; i++) {
			if (errors[i] == true) {
				return false;
			}
	}

	$('#stage1').hide(300);

	$('#stages').append($('#stage2'));
	$('#stage3').show(400);

	$('li#exam_option1').css("font-weight", "bold");
	$('li#exam_option0').css("font-weight", "");

}

function back_to_stage1()
{
	$('#stage3').hide(300);

	$('#stages').append($('#stage1').show(400));

	$('li#exam_option0').css("font-weight", "bold");
	$('li#exam_option1').css("font-weight", "");
}

// GLOBAL FUNCTIONS SECTION END *********************************************************************************************************

$( document ).ready(function() {

	Ladda.bind('button#confirm');

	$('#stage2').hide();
	$('#stage3').hide();

	$('input#exam_duration').keyup(function () { 
				this.value = this.value.replace(/[^0-9\.]/g,'');
	});

	$('button#prev1').click(function () {
		$('#tabs a[href="#data"]').tab('show');
	});

	$('button#next1').click(function () {

		go_to_stage2();

	});

	$('button#next2').click(function () {

		$('#stage2').hide(300);


		$('#stages').append($('#stage3').show(400));

		$('li#exam_option3').css("font-weight", "bold");
		$('li#exam_option2').css("font-weight", "");

	});

	$('button#prev1').click(function () {

		$('#stage2').hide(300);

		$('#stages').append($('#stage1').show(400));

		$('li#exam_option1').css("font-weight", "bold");
		$('li#exam_option2').css("font-weight", "");

	});

	$('button#prev2').click(function () {

		back_to_stage1();

	});

	$('li#exam_option0').click(function(){

		back_to_stage1();

	})

	$('li#exam_option1').click(function(){

		go_to_stage2();
		
	})

	$('button#add_students').click( function(){

		$(this).attr("disabled", "disabled");

		var email_p = /<(([^()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))>/gm;
		var full_name_p = /[a-zA-Z\-\'\sżźćńółęąśŻŹĆĄŚĘŁÓŃ]+[\s]+/gm;
		var elements = $();

		emails = $('#student_list').val().match(email_p);
		var full_names = $('#student_list').val().match(full_name_p);

		first_names = new Array();
		last_names = new Array();

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
				elements = elements.add('<div class="panel col-md-12" style="margin: 2px; margin-right: 0px; padding-right: 0px; padding-left: 6px; box-shadow: 2px 2px 5px #AAA;" id="student"><span style="margin-right: 10px;">' + first_names[i] + " " + last_names[i] + " (" + emails[i].replace("<", "").replace(">", "") + ')</span></div>');
			}

			$('#student_list').val("");
			$('#student_data').append(elements);

			$('div#student').hide();
			$('div#student').fadeIn(500);


		}

		$(this).removeAttr("disabled");

	});


	$('button#confirm').click(function(e){

		// var l = Ladda.create( document.querySelector( 'button#confirm' ) );

		var unlocked_units = new Object();

		for(key in exam.day) {
			unlocked_units[key] = new Object();

			for(var i = 0; i < exam.day[key].length; i++) {
				unlocked_units[key][i] = new Array(exam.day[key][i].bHour, exam.day[key][i].eHour, true);
			}
		}

		$.ajax({

		type: "POST",
		url: "php/CreateExamInBase.php",
		dataType: "JSON",
		data: {
			exam_name : $('input#exam_name').val().trim(),
			exam_duration : $('input#exam_duration').val(),
			students_emails : emails,
			firstnames : first_names,
			lastnames : last_names,
			unlocked_units : unlocked_units,
		},
		success: function (data) {
			alert('Pomyślnie dodano egzamin. Możesz już dokonać aktywacji na Twojej liście egzaminów.');
		},
		error: function (error) {
			alert('Wystąpił blad przy dodawaniu egzaminu.');
		},
		complete: function() {
			window.location = 'ExamList.php';
		}

		});
	});

	$('#addExamForm').submit(function () { 
		var validate = 0;
		var examDate = $('#exam-date').val();
		var today = new Date();		 
		var startHour = converToMinutes($('#start-hour').val());
		var endHour = converToMinutes($('#end-hour').val());
		
		if(exam.day[examDate] != undefined){
			for(term in exam.day[examDate]){				
				if(startHour >= converToMinutes(exam.day[examDate][term].bHour) && startHour < converToMinutes(exam.day[examDate][term].eHour)){
					validate = 5;
				}
				if(endHour > converToMinutes(exam.day[examDate][term].bHour) && endHour <= converToMinutes(exam.day[examDate][term].eHour)){
					validate = 5
				}
			}
		}
		if(converToMinutes($('#start-hour').val()) >= converToMinutes($('#end-hour').val())){			
			validate = 1;
		}
		if ( $("#duration").val() == '' || $("#exam-date").val() == '' || $("#start-hour").val() == '' || $("#end-hour").val() == ''){
			validate = 2;
		}
		if (Date.parse(examDate) < today){
			validate = 3;
		}
		if ($("#duration").val() < 5) {
			validate = 4;
		}

		switch(validate)
		{
		case 1:
  			$("#error").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
							'<span style="padding:5px">Godzina rozpoczęcia powinna być wcześniej niż godzina zakończenia.</span>') ; 			
  			break;
		case 2:
  			$("#error").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px">Należy wypełnić wszystkie pola.</span>') ;
  			break;
  		case 3:
  			$("#error").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px">Podana data już minęła. Podaj inną date.</span>') ;
  			break;
  		case 4:
  			$("#error").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px">Czas egzaminu powinien wynosić co najmniej 5 minut.</span>') ;
  			break;
  		case 5:
  			$("#error").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px">Godziny egzaminu nakładają się na siebie! Podaj inne czasy.</span>') ;
  			break;
		default:
  			exam.addTerm( $("#exam-date").val() , $("#start-hour").val() , $("#end-hour").val()  , $("#duration").val() ) ;  
			calendarControl.examDays = exam.day ;
			calendarControl.printCalendar() ;			
			$("#error").html('');
			$('#myModal').modal('hide') ;						 
			$('#addExamForm')[0].reset();
		}  
		return false ; 
	} );	
	
	
	$('#exam_name').focusout ( function ( ) {  
		//alert("exam name is " + $(this).val() );
		exam.name =  $(this).val() ; 
		exam.duration = $('#exam_duration').val();  
	}); 
	
	$('#exam_duration').focusout ( function ( ) {  
		exam.duration = $(this).val() ;
	}); 
	
	$(document).on("click", "#removeDayButton", function() {  
		// alert( $(this).attr("name") ) ; 
		exam.delTerm($(this).attr("name"));
		calendarControl.examDays = exam.day ;
		calendarControl.printCalendar() ;
	});  
	
	$(document).on("click", "#removeRecordIcon", function() {
			var currentInput = $(this) ;  
			$(this).closest("tr").fadeOut("slow" , function () { 
				var date =   jQuery.trim( currentInput.closest(".panel").find(".panel-heading").html()) ;
				var examHours = currentInput.closest("td").next().html().split("-") ;
				var startHour = jQuery.trim(examHours[0]) ; 
				exam.removeExamHoursForDay ( date , startHour ) ; 
				calendarControl.examDays = exam.day ;
				//alert ("printing calendar" ) ; 
				calendarControl.printCalendar() ;
			}) ; 
	});
	
	$("#addExamDayGlyph").click( function ( ) { 
		$("#duration").val( $('#exam_duration').val() );
	}); 
});
