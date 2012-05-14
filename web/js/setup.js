jQuery(function($) {
	$('#logout').click(function(e){
		e.preventDefault();
		window.location = '/login/logout';
	});
	
	var groupList = new MP.view.GroupList();
	
	$('body').append(groupList.render().el);
	
});