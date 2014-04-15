$("#contactForm").validate({
	errorElement: 'span',
	rules: {
		subject: "required",
		message: "required",
		captcha_code: {
		required: true,
		minlength: 6
		},
		email: {
			required: true,
			email: true
		}
	},
	messages: {
		subject: "Prosz podac temat",
		message: "Prosze wpisac tresc wiadomosci",
		captcha_code: {
			required: "Prosze wpisac kod z obrazka",
			minlength: "Wpisano nieprawidlowa ilosc znakow"
		},
		email: {
			required: "Prosze podac swoj kontaktowy adres e-mail",
			email: "Adres powinien posiadac format name@domain.com"
		}
	},
	//odpowiedzialne za umieszcenie komunikatu wewntrz odpowiedniego element
	//o id [element]-error-message, gdzie [element] jest podany jako parametr funkcji
	errorPlacement: function(error, element) {
		var name = $(element).attr("name");
		if(error.length>0){
			$("#" + name + "-error-message").append("<span class=\"badge pull-left\" style=\"background-color:#F13333;\">!</span>");
			error.appendTo($("#" + name + "-error-message"));
			$("#" + name + "-error-message").children("span").eq(1).css(
			{
				padding: '5px',
				color: '#B94A48'
			});
		}else{
			$("#" + name + "-error-message").empty();
		}
	}
});
