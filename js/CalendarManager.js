jQuery( document ).ready(function( $ ) {

	function createDateKey ( date , separator ) { 
		stringDate = ((dateStart.getDate().length === 2 ) ?  dateStart.getDate() : ( "0" + dateStart.getDate() ) ) + separator + 
					 ((dateStart.getMonth().length === 2 ) ?  dateStart.getMonth() : ( "0" + dateStart.getMonth() ) ) + separator + 
					 dateStart.getFullYear() ; 
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
			
			
			for ( var item in examUnits ) 
			{ 
				//alert ( item +" is item " ) ; 
				/*$("#calendar-control").html(  createDateKey ( examUnits[item].date ,  '.' ) ) ;
				// alert (  this.prepareTimeString ( examUnits[item].date  ) ) ;
				//alert (  this.prepareTimeString ( this.addDurationToDate ( examUnits[item].date, examUnits[item].duration ) ) ) ;
			    $("#calendar-control").html(  this.prepareTimeString ( examUnits[item].date  ) ) ;
				$("#calendar-control").html( this.prepareTimeString ( this.addDurationToDate ( examUnits[item].date, examUnits[item].duration ) )) ; 
				
				$("#calendar-control").html( this.controlStyleBegin() ) ; */
			} 
			
			htmlControl += this.controlStyleEnd () ;
			
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
			begin = '<div class="row"  style="' + this.height + 'px">'  
					+ '<div class="col-md-3">'	 
					+ '	<div class="panel panel-primary "> ' 
					+ '		<div class="panel-heading"> ' + date + ' </div> '  
					+ '			<div class="panel-body">'  
					+ ' 				<table class="table">'  
					+ ' 					<thead> '  
					+ '						<tr> '  
					+ '							<th>blokuj</th>'  
					+ '							<th>godzina</th>'
					+ '						</tr>'
					+ '						</thead>' ; 
			return begin  ; 
		} ; 
			
		
		this.controlStyleEnd = function ( end) {
			end = '				</table>'
				  + '			</div>'
				  + '			<button type="button" class="btn btn-success" style="float:right;">'
				  + '				<i class="glyphicon glyphicon-plus" style="font-size:20px; font-weight:bold;"></i>'
				  + '			</button>'
				  + '		</div>'
				  + '		</div>'
				  + '</div>' ; 
			return end  ; 
		} ;
		
		
	}

	CalendarDayControl.prototype.height = 300; 


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