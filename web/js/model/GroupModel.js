MPG.model.Group = Backbone.Model.extend({
	idAttribute: 'id',

	defaults: {
		id: '',
		name: '',
		cls: ''
	},
	
	initialize: function () {
		this.operations = new MPG.collection.Operation();
	}
});
