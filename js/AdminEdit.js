$(function () {
 
    $("#add").click(function() {
       
       val = $('#add_domain').val();
        
       listitem_html = '<li>';
       listitem_html += val;
       listitem_html += '<input type="hidden" name="Domains[]" value="' + val + '" /> ';
       listitem_html += '<a href="#" class="remove_domain">Usuń</a>'
       listitem_html += '</li>';
       
        $('#domains').append(listitem_html);

		$( ".remove_domain" ).bind('click', function(e) {
			e.preventDefault();
			$(this).parent().remove();
		});
        
    });
    
    $('.remove_domain').on('click', function(e) {

		e.preventDefault();
		$(this).parent().remove();
    });
    
});
