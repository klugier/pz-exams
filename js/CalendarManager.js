jQuery( document ).ready(function( $ ) {

	// klasa wymiany danych na kartach dodaj egzamin 
	
	function converToMinutes(s) {
		var c = s.split(':');
		return parseInt(c[0]) * 60 + parseInt(c[1]);
	}

	function parseTime(s) {
		if (parseInt(s) % 60 == 0){
			return Math.floor(parseInt(s) / 60) + ":" + "00";
		} else {
			return Math.floor(parseInt(s) / 60) + ":" + parseInt(s) % 60;
		}
	}

	// when hour is in format like this 
	// 12:3 it converts this time to 12:30 
	function prepareValidHourFormat ( hour ) { 
		var hourArray = hour.split(':') ; 
		return hourArray[0] + ':' + ( ( hourArray[1].length == 1 ) ? hourArray[1]+"0"  : hourArray[1] ) ;   
	} 
	
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

		this.sortExamUnit = function(date){
			var tmpB = new Array();
			var tmpE = new Array();

			for (var k in this.day[date]){
				
				tmpB.push(converToMinutes(this.day[date][k].bHour));
				tmpE.push(converToMinutes(this.day[date][k].eHour));            
			}
			tmpB.sort();
			tmpE.sort();
			delete this.day[date];
			this.day[date] = new Array();       
			for( var i in tmpB ){
				var exmUnit = new ExamUnit(parseTime(tmpB[i]), parseTime(tmpE[i]));
				this.day[date].push(exmUnit);
			}
		};
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
			begin = '<div class="col-md-3">' +	 
					'	<div class="panel panel-primary "> ' +
					'		<div class="panel-heading" >' + date + ' </div> ' +  
					'			<div class="panel-body" style="height:' + this.height +  'px; overflow-y: scroll;">' +
					' 				<table class="table">' +  
					' 					<thead> ' + 
					'						<tr> ' + 
					'							<th>usuń</th>' +  
					'							<th>godzina</th>' +
					'						</tr>' +
					'						</thead> ' +
					'						<tbody>' ; 
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
			examUnit =	'<tr> '
						+ '		<td><input type="checkbox" checked ></td> '
						+ '		<td style="white-space:nowrap">' + prepareValidHourFormat ( startTime )  + '-' + prepareValidHourFormat ( endTime )  + '</td> ' 
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
			
			calendarControl+=this.addRibbonStart() ; 
			
			for(var day in this.examDays)
    		{
				calendarDayControl = new CalendarDayControl ( day , this.examDays[day]) ;
				calendarControl+=calendarDayControl.printControl(); 
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
	
	// test
	var exam = new Exam ( "" , 20 ) ; 
	/*exam.addTerm( "21.02.03" , "10:20", "13:20", 30) ; 
	
	exam.addTerm( "21.02.03" , "14:20", "15:20", 30) ;
	
	exam.addTerm( "21.02.03" , "19:20", "21:20", 30) ;
	
	exam.addTerm( "11.02.03" , "14:20", "15:20", 30) ;
	
	exam.addTerm( "11.02.03" , "19:20", "21:20", 30) ;*/
	
	var calendarControl = new CalendarControl() ;
	
	// jQuery functions 
	
	$('#addExamForm').submit(function () {
		exam.addTerm( $("#exam-date").val() , $("#start-hour").val() , $("#end-hour").val()  , $("#duration").val() ) ;  
		calendarControl.examDays = exam.day ;
		calendarControl.printCalendar() ;
		$('#myModal').modal('hide') ; 
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
	
	$("#addExamDayGlyph").click( function ( ) { 
		 $("#duration").val( $('#exam_duration').val() );
	}); 
	
} ); 