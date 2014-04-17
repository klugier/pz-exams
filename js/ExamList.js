jQuery(document).ready(function($) {
	bootbox.setDefaults({ locale: "pl" });
	
	$("a[id^=row-delete-id-]").click(function() {
		var id       = $(this).attr("id");
		var examID   = id.slice(id.lastIndexOf("-") + 1, id.length);
		var examName = $("#row-name-id-" + examID).html();
		var rowID    = "#row-id-" + examID;
		
		bootbox.confirm("Czy na pewno chcesz usunąć następujący egzamin <b>\"" + examName + "\"</b>?", function(result) {
			if (result) {
				$.ajax({
					type: "POST",
					url:  "lib/Ajax/AjaxExamDeleteRequest.php",
					data: {
						ID : examID
					},
					success: function(data, status) {
						status = data.status.trim();
						
						if (status === "success") {
							$(rowID).remove();
							
							var lastLp = 0;
							$("td[id^=row-lp-]").each(function() {
								var id = $(this).attr("id");
								var lp = id.slice(id.lastIndexOf("-") + 1, id.length);
								
								if (lastLp + 1 != lp) {
									$("#" + id).html((lastLp + 1) + ".");
								}
								lastLp = lastLp + 1;
							});
						}
						else if (status === "failed") {
							msg = data.errorMsg.trim();
							
							if (msg != null) {
								alert(msg);
							}
						}
					},
					error: function(xhr, textStatus, errorThrown) {
						alert("Nie udało się uruchomić zapytania Ajax.");
					}
				});
			}
		});
	});
	
	$("button[id^=row-activate-button-id-]").click(function() {
		var status = $(this).attr("value");
		var id = $(this).attr("id");
		var examID = id.slice(id.lastIndexOf("-") + 1, id.length);		
		

		$.ajax({
			type: "POST",
			url: "lib/Ajax/AjaxExamActivationRequest.php",
			dataType: "JSON",
			data: {
				examID : examID,
			},
			success: function (data) {
				if(status == 0){
					alert('Pomyślnie zmieniono status na aktywny.');
				} else {
					alert('Deaktywowano egzamin.');
				}

			},
			error: function (error) {
				alert('Wystąpił blad przy aktywacji egzaminu.');
			},
			complete: function() {
				//window.location = 'ExamList.php';
			}
		});
		
		
		if(status == 1) {
			$("#" + id).attr("class", "btn btn-success dropdown-toggle btn-sm");
			$("#" + id).html("<b>Aktywuj</b>");
			$("#row-activated-id-" + examID).html("<b style=\"color: #801313;\">Nie</b>");
			$("#" + id).attr("value", 0);
		} else {
			$("#" + id).attr("class", "btn btn-danger dropdown-toggle btn-sm");
			$("#" + id).html("<b>Dezaktywuj</b>");
			$("#row-activated-id-" + examID).html("<b style=\"color: #156815;\">Tak</b>");
			$("#" + id).attr("value", 1);
		}
		
	});
	
	$("button[id^=row-deactivate-button-id-]").click(function() {
		var status = $(this).attr("value");
		var id = $(this).attr("id");
		var examID = id.slice(id.lastIndexOf("-") + 1, id.length);		
		
		$.ajax({
			type: "POST",
			url: "lib/Ajax/AjaxExamActivationRequest.php",
			dataType: "JSON",
			data: {
				examID : examID,
			},
			success: function (data) {
				if(status == 0){
					alert('Pomyślnie zmieniono status na aktywny.');
				} else {
					alert('Deaktywowano egzamin.');
				}
			},
			error: function (error) {
				alert('Wystąpił blad przy aktywacji egzaminu.');
			},
			complete: function() {
				//window.location = 'ExamList.php';
			}
		});
		
		if(status == 1) {
			$("#" + id).attr("class", "btn btn-success dropdown-toggle btn-sm");
			$("#" + id).html("<b>Aktywuj</b>");
			$("#row-activated-id-" + examID).html("<b style=\"color: #801313;\">Nie</b>");
			$("#" + id).attr("value", 0);
		} else {
			$("#" + id).attr("class", "btn btn-danger dropdown-toggle btn-sm");
			$("#" + id).html("<b>Dezaktywuj</b>");
			$("#row-activated-id-" + examID).html("<b style=\"color: #156815;\">Tak</b>");
			$("#" + id).attr("value", 1);
		}
	});
	
});
