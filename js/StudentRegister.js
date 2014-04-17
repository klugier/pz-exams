jQuery(document).ready(function ($) {

	$("a#signOutGlyph").click(function () {
		$("#innerStudentID").val($('#studentID').val());
		$("#innerStudentCode").val($('#studentCode').val());
		$("#innerExamID").val($(this).attr("value"));
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
			url: './../php/StudentSignInOut.php',
			data: { action: 'step1', exam: innerIExamID },
			dataType: "html",
			cache: false,
			success: function (html) {
				$('#signInBody').html(html)
			}
		});

	});


	$("a#date").click(function (e) {
		e.preventDefault();

		var examDate = $(this).attr("examDate");

		$.ajax({
			type: "POST",
			url: './../php/StudentSignInOut.php',
			data: { action: 'step2', examDate: examDate },
			dataType: "html",
			cache: false,
			success: function (html) {
				$('#signInBody').html(html)
			}
		});

	});
}); 