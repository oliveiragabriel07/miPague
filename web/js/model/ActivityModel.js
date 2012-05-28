MPG.model.Activity = Backbone.Model.extend({
	defaults: {
		id : 0,
		type : '',
		value : 0,
		date : new Date(),
		description : '',
		userList : [],
		userFrom : '',
		userTo : ''
	},
	
	parse: function(response) {
		response.id = parseInt(response.id, 10);
		response.value = parseFloat(response.value);
		response.date = Date.parse(response.date);
		response.userList = response.userList.split(',');
	}
});
