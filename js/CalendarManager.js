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

	function ExamUnit(bHour, eHour){
		this.bHour = bHour;
		this.eHour = eHour;
	}
	function Exam(name, durration){
		this.name = "name";
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
		this.printControl = function ( ) { 
			
			if ( examUnits.length == 0 ) { 
				return ; 
			} 
 
			htmlControl = this.controlStyleBegin ( day ); 
			
			for ( var item in examUnits )  { 
				htmlControl += this.controlAddExamUnit(  examUnits[item].bHour , examUnits[item].eHour );
			} 
			htmlControl += this.controlAddSeparator () ;
			
			htmlControl += this.controlStyleEnd () ;
		    // document.write ( htmlControl  ); 
			//$("#calendar-control").html(htmlControl);
		} ;  
		
		this.controlStyleBegin = function ( date) {
			//alert ( "height : " + this.height) ; 
			begin = '<div class="row" >' +  
				    '<div class="col-md-3" >' +	 
					'	<div class="panel panel-primary "> ' +
					'		<div class="panel-heading"> ' + date + ' </div> ' +  
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

	CalendarDayControl.prototype.height = 400; 


	function CalendarControl ( examDays )  { 
		this.printCalendar = function ( ) 	{ 
			//alert ( this.examDays.length ) ; 
			for(var day in examDays)
    		{
				calendarDayControl = new CalendarDayControl ( day , examDays[day]) ;
				calendarDayControl.printControl(); 
			} 
		} ; 
	} 
	
	// test
	name = "egzamin z WOS " ; 
	exam = new Exam ( name , duration ) ; 
	exam.addTerm( "21.02.03" , "10:20", "13:20", 30) ; 
	
	exam.addTerm( "21.02.03" , "14:20", "15:20", 30) ;
	
	calendarControl = new CalendarControl(exam.day) ;    
	calendarControl.printCalendar() ; 
} ); 