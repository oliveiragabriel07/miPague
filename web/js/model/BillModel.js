MPG.model.Bill = Backbone.Model.extend({
	defaults: {
		description : undefined,
		group: undefined,
		date : (new Date()).toString('yyyy-MM-dd'),
		value : 0,
		expenses: [],
		shares: []
	}
});
