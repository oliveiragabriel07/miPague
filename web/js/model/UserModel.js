/*global MPG */
MPG.model.User = MPG.NestedModel.extend({
	defaults: {
		id : 0,
		name : '',
		surname : '',
		displayname: '',
		username : '',
		status : ''
	},
	
	validation: {
	    username: {
	        required: true
	    },
	    
	    surname: {
            required: true
        },
        
        displayname: {
            required: true
        }
	},
	
	associations: [{
		type : 'hasMany',
		model : 'GroupCollection',
		key : 'groups',
		associationKey : 'groupList',
		foreignKey : 'user'
	}],
	
	parse: function(response) {
		MPG.NestedModel.prototype.parse.apply(this, arguments);
		response.id = parseInt(response.id, 10);
		return response;
	}
});