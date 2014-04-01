$("#contactForm").validate({
    errorClass: "text-error",
    rules: {
	subject: "required",
	message: "required",
	email: {
	    required: true,
	    email: true,
	    message:true
	}
    },
    messages: {
	subject: "Prosz podac temat",
	message: "Prosze wpisac tresc wiadomosci",
	email: {
	    required: "Prosze podac swoj kontaktowy adres e-mail",
	    email: "Adres powinien posiadac format name@domain.com"
	}
    }
});
