MPG.view.GroupList = Backbone.View.extend({

	tagName: 'ul',
	
	className: 'mpg-group-list',
	
	initialize: function(cfg) {
		//bind events
		_.bindAll(this, 'render');

		//bind collection
		// this.collection.bind('reset', this.render);
	},
	
	render: function() {
		var self = this,
			el = this.$el;

		el.empty();
		// if (this.collection.models.length === 0) {
			// //how to create a group
		// } else {
			// this.collection.each(function(model){
				// el.append(new MPG.view.GroupListItem({model: model}).render().el);
			// }, this);
		// }
		
		return this;
	}
});
