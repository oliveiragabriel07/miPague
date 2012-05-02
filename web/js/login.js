jQuery(function($){
	$('#username').watermark('e-mail     ');
	
	$('#password').watermark('senha     ');
	
	$('#loginForm').validate({
		debug: true,
		rules: {
			username: {
				required: true,
				email: true
			},
			password: 'required'
		},
		messages: {
			username: {
				required: 'Digite seu email.'
			},
			password: 'Digite sua senha.'
		},
		submitHandler: function(form) {
			$.ajax({
				type: 'POST',
				data: $(form).serializeArray(),
				url: '../login/doLogin',
				dataType: 'json',
				success: function(data) {
					if (data.success) {
						window.location = '/' + data.url;
					} else {
						var passEl = $('input[name=password]'),
							next = passEl.next(),
							error = $($.format('<label class="error">{0}</label>', data.message));
						
						next && next.remove();
						error.insertAfter(passEl);
						passEl.addClass('error');
						passEl.focus();
					}
				}
			});
		}
	});
});