jQuery( document ).ready(function( $ ) {

// CLASSES & FUNCTIONS SECTION BEGIN ***************************************************************************************************
	// klasa wymiany danych na kartach dodaj egzamin 
	function converToMinutes(s) {
		var c = s.split(':');
		return parseInt(c[0]) * 60 + parseInt(c[1]);
	}

	function parseTime(s) {
		if (parseInt(s) % 60 == 0){
			return Math.floor(parseInt(s) / 60) + ":" + "00";
		} else {
			return Math.floor(parseInt(s) / 60) + ":" + (( parseInt(s) % 60  < 10 ) ?  "0"+(parseInt(s)%60) : (parseInt(s)%60) )  ;
		}
	}

	// when hour is in format like this 
	// 12:3 it converts this time to 12:30 

	function ExamUnit(bHour, eHour){
		this.bHour = bHour;
		this.eHour = eHour;
	}
	function Exam(name, durration){
		this.name = name;
		this.durration = durration;
		this.day = new Array();
		this.blockedUnits = new Array();

		this.addTerm = function (date, begHour, endHour, durat) {
			var bHour = converToMinutes(begHour);
			var eHour = converToMinutes(endHour);
			var diff = eHour - bHour;
			var count = diff / durat;
			for (var i=0;i<count;i++){
				
				if(this.day[date] === undefined){
					this.day[date] = new Array();
				}
				var conv1 = parseTime(bHour + durat * i);      
				var conv2 = parseTime(bHour + durat * (i + 1));
				var ExmUnit = new ExamUnit(conv1, conv2);
				this.day[date].push(ExmUnit);
			}
			
			// sort days 
			this.sortDaysArray ( )  ;
			// sort within days 
			this.sortAllExamUnits();
		};

		this.delTerm = function(date) {
			delete this.day[date];
		};
		
		this.blockUnit = function(date, fromHour, toHour) {
			if(this.blockedUnits[date] === undefined) {
				this.blockedUnits[date] = new Array();
			}
			this.blockedUnits[date].push(fromHour);
			this.blockedUnits[date].push(fromHour);
		};

			// sort numbers in asc order 
		this.sortNumbers = function ( arg1 , arg2  ) {  
			return arg1 - arg2 ;  
		} ; 
		
		this.sortAllExamUnits = function (){ 
			for ( var date in this.day ) {
				this.sortExamUnit ( date  ) ;
			} 
		} ; 
		
		this.sortExamUnit = function(date){
			var tmpB = new Array();
			var tmpE = new Array();

			for (var k in this.day[date]){
				tmpB.push(converToMinutes(this.day[date][k].bHour));
				tmpE.push(converToMinutes(this.day[date][k].eHour));            
			}
			
			tmpB.sort(this.sortNumbers);
			tmpE.sort(this.sortNumbers); 
			delete this.day[date];
			this.day[date] = new Array();       
			for( var i in tmpB ){
				var exmUnit = new ExamUnit(parseTime(tmpB[i]), parseTime(tmpE[i]));
				this.day[date].push(exmUnit);
			}
		};
		
		this.removeDaysWithoutExams = function ( ) { 
			for ( var date in this.day ) {  
				if ( this.day[date].length === 0 ) {
					delete this.day[ date ]  ;
				} 
			} 
		} ; 
		
		this.sortDaysArray  = function ( ) { 
			var sortedDaysArray = new Array( ); 
			var keyOrder = new Array () ; 
			for (var key in this.day) {
				keyOrder.push(key);
			}
			keyOrder.sort ( this.sortDaysKey ) ;
			for ( var i= 0 ; i < keyOrder.length ; i++ ) { 
				sortedDaysArray[keyOrder[i]] = ( this.day[ keyOrder[i] ] )  ;
			} 
			this.day = sortedDaysArray ; 
		} ; 
		
		this.sortDaysKey = function ( arg1 , arg2 ) {  
			var dateRegexPattern = /^(\d{4})[\/\- ](\d{2})[\/\- ](\d{2})/;
			a1 = arg1.replace(dateRegexPattern,"$1$2$3");
			a2 = arg2.replace(dateRegexPattern,"$1$2$3");
			if ( a1 > a2 ) return 1 ; 
			else if ( a2 > a1 ) return -1 ; 
			else return 0 ;
		} ; 
		
		this.removeExamHoursForDay = function ( date , startHour   )  {
			for (var indx in this.day[date]) {
				if ( this.day[date][indx].bHour == startHour ) { 
						this.day[date].splice(indx, 1);
						this.removeDaysWithoutExams() ; 
				} 
			} 
		} ;
	}    
	
	
	function CalendarDayControl ( day , examUnits) {
		
		this.separatorPositions = new Array () ; 
		this.printControl = function ( ) { 
			
			if ( examUnits.length == 0 ) { 
				return ; 
			} 
 
			htmlControl = this.controlStyleBegin ( day ); 
			this.findSeparatorPositions(); 
			
			//alert ( this.separatorPositions.toString() ) ;  
			
			var i = 0 ; 
			var separatorIndex = this.separatorPositions.shift(); 
			for ( var item in examUnits )  { 
				htmlControl += this.controlAddExamUnit(  examUnits[item].bHour , examUnits[item].eHour );
				if ( separatorIndex == i ) { 
					separatorIndex = this.separatorPositions.shift(); 
					htmlControl += this.controlAddSeparator () ;
				} 
				i++ ; 
			} 
			htmlControl += this.controlAddSeparator () ;
			
			htmlControl += this.controlStyleEnd (day) ;
		    // document.write ( htmlControl  ); 
			return htmlControl ; 
		} ;  
		
		this.findSeparatorPositions = function ( ) { 
			for ( var i=0; i<examUnits.length-1 ; i++ ) { 
				if ( examUnits[i].eHour !== examUnits[i+1].bHour  ) { 
					this.separatorPositions.push(i);
				} 
			} 
		} ; 
		
		this.controlStyleBegin = function ( date) {
			//alert ( "height : " + this.height) ; 
			begin = '<div class="col-xs-3 col-sm-3 col-md-3">' +	 
					'	<div class="panel panel-primary "> ' +
					'		<div class="panel-heading" >' + date + ' </div> ' +  
					'		<div class="panel-body" style="height:' + this.height +  'px; overflow-y: scroll;">' +
					' 			<table class="table">' +  
					' 				<thead> ' + 
					'					<tr> ' + 
					'						<th>usuń</th>' +  
					'						<th>godzina</th>' +
					'					</tr>' +
					'				</thead> ' +
					'				<tbody>' ; 
			return begin  ; 
		} ; 
			
		
		this.controlStyleEnd = function (date) {
			end = '						</tbody>' +
				  '				</table>' +
				  '			</div>'+
				  '			<button type="button" class="btn btn-danger" id="removeDayButton" style="float:right;" name="'+ date + '">' +
				  '				<i class="glyphicon glyphicon-minus" style="font-size:20px; font-weight:bold;"></i>'+
				  '			</button>'+
				  '		</div>'+
				  '		</div>' ; 
			return end  ; 
		} ;
		
		this.controlAddExamUnit = function ( startTime , endTime ) { 
			//alert ( startTime +" aa  " +  endTime ) ; 
			examUnit =	'<tr>'
						+ '		<td><i id="removeRecordIcon" class="glyphicon glyphicon-trash"></i></td> '
						+ '		<td style="white-space:nowrap">' +  startTime   + '-' +   endTime   + '</td> ' 
						+ '</tr> ' ; 
			return examUnit ; 
		} ; 
		
		this.controlAddSeparator = function ( ) { 
			return '<tr><td colspan="2" style="text-align:center;"> *** </td></tr>' ; 
		} ;
	}

	CalendarDayControl.prototype.height = 400; 

	function CalendarControl (  )  { 
		this.examDays = new Array() ; 
		this.printCalendar = function ( ) 	{ 
			//alert ( this.examDays.length ) ;
			
			var calendarControl = "" ; 
			var maxDaysNumPerRibbon = 4 ; 
			var daysCounter = 0 ; 
			
			calendarControl+=this.addRibbonStart() ; 
			
			for(var day in this.examDays) {
				if ( (daysCounter % maxDaysNumPerRibbon == 0) && ( daysCounter != 0 )    ) { 
					calendarControl+=this.addRibbonEnd ();
					calendarControl+="<hr>" ;
					calendarControl+=this.addRibbonStart() ; 
				} 
				//alert ( " day in calendar " + day   ) ;
				calendarDayControl = new CalendarDayControl ( day , this.examDays[day]) ;
				calendarControl+=calendarDayControl.printControl();
				daysCounter++; 
			} 
			
			calendarControl+=this.addRibbonEnd ();
		
			$("#calendar-control").html(calendarControl);
		} ; 
		
		this.addRibbonStart = function ( ) { 
			start = ' <div class="row" style="background:url(img/calendarPanel.png);" >' ;  
			return start ; 
		} ; 
		
	
		this.addRibbonEnd = function () { 
			end = '</div>' ;  
			return end ; 
		} ;
	} 

	function EditExamCalendarManager() { 
		
		this.calendarControl = new CalendarControl() ; 
		
		this.getExamID = function() {
			query = window.location.search.substring(1); 
			queryPart = query.split('&');
			examID = null ; 
			for ( var idx in queryPart ) {  
				if ( queryPart[idx].match(/examID/) != null  )  { 
					examID = queryPart[idx].match(/\d+/ ) ; 
					break ; 
				}
			}     
			return examID ;  	
		} ;
		
		this.sendAjaxExamCalendarRequest = function ( $examID ) {
			// $examID	= this.getExamID () ; 
			$.ajax({
				url: 'lib/Ajax/AjaxExamCalendarRequest.php',
				async: false , 
				type: 'post',
				data: { 'examID' : $examID },
				success: function(data, status) { 
					alert ( data + " s: " + status  ) ;  
					if(data.status.trim() === "dataRecived") {
						if (data.examID.trim() === "existsInDB") {  
							console.log ( data ) ; 
							return ; 
						} 
					} 
					console.log("Zapytanie ajax nie powiodło się ( Nie udało się sprawdzić czy exam ID występuje w bazie )");  	 
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus);
				}
			}); 
		} ;	
	} 
// CLASSES & FUNCTIONS SECTION END *************************************************************************************************
	
// JQUERY SECTION BEGIN *****************************************************************************************************************
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
			exam.addTerm( $("#exam-date").val() , $("#start-hour").val() , $("#end-hour").val()  , $("#duration").val() ) ;  
			calendarControl.examDays = exam.day ;
			calendarControl.printCalendar() ;			
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
// JQUERY SECTION END *****************************************************************************************************************
	
// VARIABLES SECTION BEGIN ************************************************************************************************************
	// test
	exam = new Exam ( "" , 20 ) ; 
	
	/*exam.addTerm( "21.02.03" , "10:20", "13:20", 30) ; 
	
	exam.addTerm( "21.02.03" , "14:20", "15:20", 30) ;
	
	exam.addTerm( "21.02.03" , "19:20", "21:20", 30) ;
	
	exam.addTerm( "11.02.03" , "14:20", "15:20", 30) ;
	
	exam.addTerm( "11.02.03" , "19:20", "21:20", 30) ;*/
	
	// exam.sortDaysArray("2014-12-01" , "2014-02-02") ;
	
    calendarControl = new CalendarControl() ;
	editExamCalendarManager = new EditExamCalendarManager () ; 
	// jQuery functions 
	
} ); 
