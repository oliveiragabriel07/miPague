MPG.view.OperationList = Backbone.View.extend({

	tagName: 'ul',
	
	className: 'mpg-opearation-list',
	
	initialize: function(cfg) {
		//bind events
		_.bindAll(this, 'render');

		//bind collection
		this.collection.bind('reset', this.render);
	},
	
	render: function() {
		var self = this,
			el = this.$el;

		el.empty();
		if (this.collection.models.length === 0) {
			//empty message
		} else {
			this.collection.each(function(model){
				el.append(new MPG.view.OperationListItem({model: model}).render().el);
			});
		}
		
		return this;
	}
});
