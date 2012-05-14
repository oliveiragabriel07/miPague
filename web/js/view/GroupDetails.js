MP.view.GroupDetails = Backbone.View.extend({
	tagName: 'div',
	
	className: 'mpg-group-details',
	
	template: JST['group/details'],
	
	initialize: function(cfg) {
		$.extend(this, cfg);
		
		//bind events
		_.bindAll(this, 'render');		
	},
	
	render: function() {
		var el = this.$el;
		
		return this;
	}
});
