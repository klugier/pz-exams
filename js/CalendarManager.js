jQuery( document ).ready(function( $ ) {

	function createDateKey ( date , separator ) { 
		stringDate = ((dateStart.getDate().length === 2 ) ?  dateStart.getDate() : ( "0" + dateStart.getDate() ) ) + separator + 
					 ((dateStart.getMonth().length === 2 ) ?  dateStart.getMonth() : ( "0" + dateStart.getMonth() ) ) + separator + 
					 dateStart.getFullYear() ; 
					 
		//alert  ( stringDate) ; 
		return stringDate ;   
	}  
	
	function ExamUnit (  date , duration  ) { 
		this.date = date ;  
		this.duration = duration  ;
	}  

	function CalendarDayControl ( examUnits) { 
		this.printControl = function ( ) { 
			
			if ( examUnits.length == 0 ) { 
				return ; 
			} 

			blockDate = createDateKey ( examUnits[0].date ,  '-' ); 
			htmlControl = this.controlStyleBegin ( blockDate ); 
			
			for ( var item in examUnits )  { 
				htmlControl += this.controlAddExamUnit( this.prepareTimeString ( examUnits[item].date  ) , this.prepareTimeString ( this.addDurationToDate ( examUnits[item].date, examUnits[item].duration ) ));
			} 
			htmlControl += this.controlAddSeparator () ;
			
			htmlControl += this.controlAddExamUnit ( "20:13" , "12:20" ) ; 
			htmlControl += this.controlAddExamUnit ( "20:13" , "12:20" ) ;
			htmlControl += this.controlAddExamUnit ( "20:13" , "12:20" ) ;
			htmlControl += this.controlAddExamUnit ( "20:13" , "12:20" ) ;
			
			
			htmlControl += this.controlStyleEnd () ;
		    // document.write ( htmlControl  ); 
			//$("#calendar-control").html(htmlControl);
		} ;  
		
		this.prepareTimeString = function ( date , duration ) {
			stringTime = date.getHours() + ":" + date.getMinutes(); 
			return stringTime ; 
		} ; 
		
		this.addDurationToDate = function( date , duration ) {
			return new Date(date.getTime() + duration * 60000 ) ; 
		} ; 
		
		this.controlStyleBegin = function ( date) {
			//alert ( "height : " + this.height) ; 
			begin = '<div class="row" style="height:' + this.height + 'px;">' +  
				    '<div class="col-md-3" >' +	 
					'	<div class="panel panel-primary "> ' +
					'		<div class="panel-heading"> ' + date + ' </div> ' +  
					'			<div class="panel-body">' +
					' 				<table class="table">' +  
					' 					<thead> ' + 
					'						<tr> ' + 
					'							<th>blokuj</th>' +  
					'							<th>godzina</th>' +
					'						</tr>' +
					'						</thead> ' +
					'						<tbody>' ; 
			return begin  ; 
		} ; 
			
		
		this.controlStyleEnd = function ( end) {
			end = '						</tbody>' +
				  '				</table>' +
				  '			</div>'+
				  '			<button type="button" class="btn btn-success" style="float:right;">' +
				  '				<i class="glyphicon glyphicon-plus" style="font-size:20px; font-weight:bold;"></i>'+
				  '			</button>'+
				  '		</div>'+
				  '		</div>'+
				  '</div>' ; 
			return end  ; 
		} ;
		
		this.controlAddExamUnit = function ( startTime , endTime ) { 
			//alert ( startTime +" aa  " +  endTime ) ; 
			examUnit =	'<tr> '
						+ '		<td><input type="checkbox" ></td> '
						+ '		<td> od ' + startTime + ' do ' + endTime + '</td> ' 
						+ '</tr> ' ; 
			return examUnit ; 
		} ; 
		
		this.controlAddSeparator = function ( ) { 
			return '<tr><td colspan="2" style="text-align:center;"> *** </td></tr>' ; 
		} ;
	}

	CalendarDayControl.prototype.height = 100; 


	function CalendarControl ( )  { 
		this.examDays = new Array () ; 
		this.addExamBlock = function ( dateStart , dateEnd , duration  ) { 
        	 numOfExams = (  (dateEnd.getHours() * 60 + dateEnd.getMinutes()) - (dateStart.getHours() *60 + dateStart.getMinutes()) ) / duration ;
			 //alert( numOfExams ); 
			 for (var i=0;i<numOfExams;i++) {
				dateKey = createDateKey ( dateStart , "-" )  ;
				//alert(dateKey); 
				if( this.examDays[dateKey] === undefined ) {
					this.examDays[dateKey] = new Array();
				}
				
				examUnit = new ExamUnit ( new Date(dateStart.getTime() + i * duration *60000) , duration ) ; 
				this.examDays[dateKey].push(examUnit) ;
			}  
			//alert ( this.examDays.length ) ;
		} ;	

		this.printCalendar = function ( ) 	{ 
			//alert ( this.examDays.length ) ; 
			for(var day in this.examDays)
    		{
				calendarDayControl = new CalendarDayControl (this.examDays[day]) ;
				calendarDayControl.printControl(); 
			} 
		} ; 
	} 
	
	// test
	dateStart = new Date ( 2006, 9, 1, 12, 20, 0 , 0 ) ;
	dateEnd = new Date ( 2006, 9, 1, 14, 20, 0 , 0 ) ;  
	calendarControl = new CalendarControl() ; 
	calendarControl.addExamBlock( dateStart , dateEnd , 30 ) ;   
	calendarControl.printCalendar() ; 
} ); 