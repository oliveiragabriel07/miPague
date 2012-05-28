MPG.collection.Activity = Backbone.Collection.extend({
	model: MPG.model.Activity,
	
	initialize: function(cfg) {
		this.group = cfg.group;
		this.url = '../group/getGroupActivity?groupId=' + this.group.get('id');
	}
});
