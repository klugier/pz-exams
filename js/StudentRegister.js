function validateRadio(obj) {
	var checked = null;
	var inputs = document.getElementsByName('optionsRadios');
	for (var i = 0; i < inputs.length; i++) {
		if (inputs[i].checked) {
			checked = inputs[i];
			break;
		}
	}
	if (checked == null) {
		return false;
	}
}

jQuery(document).ready(function ($) {

	$("a#signOutGlyph").click(function () {
		$("#innerStudentID").val($('#studentID').val());
		$("#innerStudentCode").val($('#studentCode').val());
		$("#innerExamID").val($(this).attr("value"));

		var innerStudentID = $('#studentID').val();
		var innerExamID = $(this).attr("value");

		$.ajax({
			type: "POST",
			url: 'php/StudentSignInOut.php',
			data: { action: 'stepOut', exam: innerExamID, student: innerStudentID },
			dataType: "html",
			cache: false,
			success: function (html) {
				$('#signOutBody').html(html)
			}
		});
	});

	$("a#signInGlyph").click(function () {

		$("#innerIStudentID").val($('#studentID').val());
		$("#innerIStudentCode").val($('#studentCode').val());
		$("#innerIExamID").val($(this).attr("value"));
		$("#innerExamName").val($(this).attr("examname"));
		document.getElementById('innerExamName').innerHTML = $(this).attr("examname");
		var innerIStudentID = $('#studentID').val();
		var innerIStudentCode = $('#studentCode').val();
		var innerIExamID = $(this).attr("value");

		$.ajax({
			type: "POST",
			url: 'php/StudentSignInOut.php',
			data: { action: 'step1', exam: innerIExamID },
			dataType: "html",
			cache: false,
			success: function (html) {
				$('#signInBody').html(html)
			}
		});

		$.ajax({
			type: "POST",
			url: 'php/StudentSignInOut.php',
			data: { action: 'stepF1' },
			dataType: "html",
			cache: false,
			success: function (html) {
				$('#signInFooter').html(html)
			}
		});

	});

	$("div").on("click", "a#date", function () {

		var examDate = $(this).attr("examDate");
		var innerIExamID = $("#innerIExamID").val();

		$.ajax({
			type: "POST",
			url: 'php/StudentSignInOut.php',
			data: { action: 'step2', exam: innerIExamID, examDate: examDate },
			dataType: "html",
			cache: false,
			success: function (html) {
				$('#signInBody').html(html)
			}
		});

		$.ajax({
			type: "POST",
			url: 'php/StudentSignInOut.php',
			data: { action: 'stepF2' },
			dataType: "html",
			cache: false,
			success: function (html) {
				$('#signInFooter').html(html)
			}
		});

	});

	$("div").on("click", "a#back", function () {

		var innerIExamID = $("#innerIExamID").val();

		$.ajax({
			type: "POST",
			url: 'php/StudentSignInOut.php',
			data: { action: 'step1', exam: innerIExamID },
			dataType: "html",
			cache: false,
			success: function (html) {
				$('#signInBody').html(html)
			}
		});

		$.ajax({
			type: "POST",
			url: 'php/StudentSignInOut.php',
			data: { action: 'stepF1' },
			dataType: "html",
			cache: false,
			success: function (html) {
				$('#signInFooter').html(html)
			}
		});

	});

});