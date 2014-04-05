jQuery( document ).ready(function( $ ) {

	function createDateKey ( date , separator ) 
	{ 
		stringDate = ((dateStart.getDate().length === 2 ) ?  dateStart.getDate() : ( "0" + dateStart.getDate() ) ) + separator + 
					 ((dateStart.getMonth().length === 2 ) ?  dateStart.getMonth() : ( "0" + dateStart.getMonth() ) ) + separator + 
					 dateStart.getFullYear() ; 
		return stringDate ;   
	}  
	
	function ExamUnit (  date , duration  )
	{ 
		this.date = date ;  
		this.duration = duration  ;
	}  

	function CalendarDayControl ( examUnits) { 
		this.printControl = function ( ) { 
			for ( var item in examUnits ) 
			{ 
				//alert ( item +" is item " ) ; 
				//$("#calendar-control").html(  createDateKey ( examUnits[item].date ,  '.' ) ) ; 
							
			} 
		} ;  
	}

	CalendarDayControl.prototype.height = 200; 


	function CalendarControl ( ) 
	{ 
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

		this.printCalendar = function ( ) 
		{ 
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
