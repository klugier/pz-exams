$( document ).ready(function() {

$('#stage2').hide();
$('#stage3').hide();

$('#tab1a').attr('class', 'disabled');
$('#tab2a').attr('class', 'disabled active');

$('#tab1a').click(function(event){
		if ($(this).hasClass('disabled')) {
				return false;
		}
});
$('#tab2a').click(function(event){
		if ($(this).hasClass('disabled')) {
				return false;
		}
});

$('input#duration').keyup(function () { 
			this.value = this.value.replace(/[^0-9\.]/g,'');
});

$('button#prev1').click(function () {
	$('#tabs a[href="#data"]').tab('show');
});

$('button#next1').click(function () {

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

	if($('input#duration').val() == "") {
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

	//$('#stage1').fadeOut(500);
	$('#stage1').hide(300);



	$('#stages').append($('#stage2'));
	$('#stage2').show(400);

	$('li#exam_option2').css("font-weight", "bold");
	$('li#exam_option1').css("font-weight", "");


	//$('p#exam_info').text("Dla egzaminu: " + $('input#exam_name').val() + " (" + $('input#duration').val() + " min)");

		//$('#tabs a[href="#students"]').tab('show');
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

	$('#stage3').hide(300);

	$('#stages').append($('#stage2').show(400));

	$('li#exam_option2').css("font-weight", "bold");
	$('li#exam_option3').css("font-weight", "");

});








$('button#add_students').click( function(){

	 var emails = new Array();
	 var first_names = new Array();

	 var email_p = /<(([^()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))>/gm;
	 var f_name_p = /[a-zA-Z\-\'\s]+[\s]*</gm;
	 var l_name_p = /[a-zA-Z\-\'\s]+[\s]*</gm;
	 var elements = $();

		emails = $('#student_list').val().match(email_p);
		first_names = $('#student_list').val().match(f_name_p);
		last_names = $('#student_list').val().match(l_name_p);

		if (emails != null && first_names != null && last_names != null) {
			for (var i = 0; i < first_names.length; i++){ 
				first_names[i] = first_names[i].replace("<", "").replace(">", "").split(" ")[0].trim();
			}

			for (var i = 0; i < last_names.length; i++) {
				last_names[i] = last_names[i].split(" ").splice(1, 2).join(' ').replace("<", "").trim();;
			}

		for (var i = 0; i < emails.length; i++) {
			elements = elements.add('<div class="panel col-md-12" style="margin: 2px; padding-right: 6px; padding-left: 6px; box-shadow: 2px 2px 5px #AAA;" id="student">' + first_names[i] + " " + last_names[i] + " (" + emails[i].replace("<", "").replace(">", "")+ ')<span class="pull-right"><span class="glyphicon glyphicon-remove"></span></span></div>');
		}

		$('#student_list').val("");
		$('#student_data').append(elements);

		$('div#student').hide();
		$('div#student').fadeIn(500);
	}

});

});