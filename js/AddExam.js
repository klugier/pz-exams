var emails;
var first_names;
var last_names;

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

	 emails = new Array();
	 first_names = new Array();
	 last_names = new Array();

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
			emails[i] = emails[i].replace("<", "").replace(">", "");
			elements = elements.add('<div class="panel col-md-12" style="margin: 2px; margin-right: 0px; padding-right: 0px; padding-left: 6px; box-shadow: 2px 2px 5px #AAA;" id="student"><span style="margin-right: 10px;">' + first_names[i] + " " + last_names[i] + " (" + emails[i].replace("<", "").replace(">", "") + ')</span><i class="glyphicon glyphicon-remove pull-right" style="vertical-align: middle; font-size: 16px; margin-left: 18px;"></i></div>');
		}

		$('#student_list').val("");
		$('#student_data').append(elements);

		$('div#student').hide();
		$('div#student').fadeIn(500);
	}

});


$('button#confirm').click(function(){

		$.ajax({

		type: "POST",
		url: "../php/CreateExamInBase.php",
		dataType: 'JSON',
		data: {
			exam_name : $('input#exam_name').val().trim(),
			exam_duration : $('input#duration').val(),
			students_emails : emails,
			firstnames : first_names,
			lastnames : last_names
		},
		success: function (data) {
			alert('Pomyslnie dodano egzamin');
		},
		error: function (error) {
			alert('Wystapil blad przy dodawaniu egzaminu.');
		},
		complete: function() {
			window.location = '../index.php';
		}

		});


});


});

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

