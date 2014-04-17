jQuery(document).ready(function ($) {

	$("a#signOutGlyph").click(function () {
		$("#innerStudentID").val($('#studentID').val());
		$("#innerStudentCode").val($('#studentCode').val());
		$("#innerExamID").val($(this).attr("value"));
	});

	$("a#signInGlyph").click(function (e) {
		/*
		e.preventDefault();
		$("#signInModal").load("lib/Dialog/ExamSignInButton.php", function (response, status, xhr) {
			if (status == "error") {
				var msg = "Sorry but there was an error: ";
				$("#signInModal").html(msg + xhr.status + " " + xhr.statusText);
			}
		});
		*/
		$("#innerIStudentID").val($('#studentID').val());
		$("#innerIStudentCode").val($('#studentCode').val());
		$("#innerIExamID").val($(this).attr("value"));
		//$("#innerExamName").val($(this).attr("examname"));
		document.getElementById('innerExamName').innerHTML = $(this).attr("examname");
		var innerIStudentID = $('#studentID').val();
		var innerIStudentCode = $('#studentCode').val();
		var innerIExamID = $(this).attr("value");

		var xmlhttp;
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		}
		else {// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("valueField").innerHTML = xmlhttp.responseText; // use the xmlhttp.responseText however you need.
			}
		}
		xmlhttp.open("GET", "./../lib/Dialog/SignInModalTrigger.php?exam=" + innerIExamID + "&code=" + innerIStudentCode, true);   //somename is whatever you want to send in there as name
		xmlhttp.send();
		if($("#session").val() != $(this).attr("value")){ //EVIL HAX THAT WORKS
			location.reload();
		}
		//alert("Script loaded");
		//document.getElementById("signInModal").reload();
		//$("#signInModal").load("./../lib/Dialog/ExamSignInButton.php"); 
	});


	$("button#date").click(function (e) {
		//keep the links from going to another page by preventing their default behavior
        e.preventDefault();

        //this = link; grab the url
        var pageLocation = this.href;

        //fire off an ajax request
		/*
        $.ajax({ 
            url: pageLocation, 

            //on success, set the html to the responsetext
            success: function(data){ 
                $("#content").html(data.responseText); 
            } 
        });
		*/
		$("#examDate").val($(this).attr("examDate"));
	});
}); 