MPG.model.User = MPG.NestedModel.extend({
	defaults: {
		id : 0,
		name : '',
		surname : '',
		nickname: '',
		username : '',
		status : ''
	},
	
	associations: [{
		type : 'hasMany',
		model : 'GroupCollection',
		key : 'groups',
		associationKey : 'groupList',
		reverseKey : 'user'
	}],
	
	parse: function(response) {
		MPG.NestedModel.prototype.parse.apply(this, arguments);
		
		response.id = parseInt(response.id, 10);
		return response;
	}
});