
$( document ).ready(function() {
	
	$('#addExamForm').submit(function () { 
		var validate = 0;
		var examDate = $('#exam-date').val();
		var today = new Date();		 
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

		if( validate == 1){
			$("#error").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px">Godzina rozpoczęcia powinna być wcześniej niż godzina zakończenia.</span>') ; 			
		} else if ( validate == 2) {
			$("#error").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px">Należy wypełnić wszystkie pola.</span>') ;			
		} else if ( validate == 3) {
			$("#error").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px">Podana data już minęła. Podaj inną date.</span>') ;			
		} else if ( validate == 4) {
			$("#error").html('<span style="background-color:#F13333;" class="badge pull-left ">!</span>' +
											'<span style="padding:5px">Czas egzaminu powinien wynosić co najmniej 5 minut.</span>') ;			
		} else {
			editExamCalendarManager.insertExamUnits( $("#exam-date").val() , $("#start-hour").val() , $("#end-hour").val()  , $("#duration").val() ) ;  
			editExamCalendarManager.calendarControl.examDays = editExamCalendarManager.exam.day ;
			editExamCalendarManager.printCalendar() ;			
			$("#error").html('');
			$('#myModal').modal('hide') ;						 
			$('#addExamForm')[0].reset();
		}
		// alert  ( exam.name + " --- " + exam.duration  ) ; 
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
		editExamCalendarManager.exam.delTerm($(this).attr("name"));
		editExamCalendarManager.calendarControl.examDays = editExamCalendarManager.exam.day ;
		editExamCalendarManager.printCalendar() ;
	});  
	
	$(document).on("click", "#removeRecordIcon", function() {
			var currentInput = $(this) ;
			$(this).closest("tr").fadeOut("slow" , function () {
				var date =   jQuery.trim( currentInput.closest(".panel").find(".panel-heading").html()) ;
				var examHours = currentInput.closest("td").next().html().split("-") ;
				var startHour = jQuery.trim(examHours[0]) ;
				editExamCalendarManager.exam.removeExamHoursForDay ( date , startHour ) ; 
				editExamCalendarManager.calendarControl.examDays = editExamCalendarManager.exam.day ;
				editExamCalendarManager.printCalendar();
			}) ; 
	});
	
	$("#addExamDayGlyph").click( function ( ) { 
		$("#duration").val( $('#exam_duration').val() );
	});
}) ; 