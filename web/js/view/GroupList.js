MP.view.GroupList = Backbone.View.extend({

	tagName: 'ul',
	
	className: 'mpg-group-list',
	
	initialize: function(cfg) {
		//apply configs
		$.extend(this, cfg);

		this.collection = new MP.collection.Group();
		
		//bind events
		_.bindAll(this, 'render');

		//bind collection
		this.collection.bind('reset', this.refresh, this);

		//load collection
		this.collection.fetch();
	},
	
	render: function() {
		this.refresh();
		return this;
	},

	refresh: function() {
		var self = this,
			el = this.$el;

		el.html('');
		if (this.collection.models.length === 0) {
			//how to create a group
		} else {
			_(this.collection.models).each(function(model){
				el.append(new MP.view.GroupListItem({model: model}).render().el);
			});
		}

	}
});
