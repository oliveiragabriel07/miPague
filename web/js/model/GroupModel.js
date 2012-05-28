MPG.model.Group = Backbone.Model.extend({
	idAttribute: 'id',

	defaults: {
		id: '',
		name: '',
		cls: ''
	},
	
	initialize: function () {
		this.activities = new MPG.collection.Activity({group: this});
	}
});
