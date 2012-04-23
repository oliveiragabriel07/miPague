jQuery(function($){
	$('#username').watermark('e-mail');
	
	$('#password').watermark('senha');
	
	$('#loginForm').validate({
		debug: true,
		rules: {
			username: {
				required: true,
				email: true
			},
			password: {
				required: true
			}
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
						alert('Erro! ' + data.message);
					}
				}
			});
		}
	});
});