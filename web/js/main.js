jQuery(function($) {
	$('#logout').click(function(e){
		e.preventDefault();
		window.location = '/login/logout';
	});
	
	MPG.app = new MPG.App();
	Backbone.history.start()
});