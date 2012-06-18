MPG.AppLayout = Backbone.View.extend({
	tagName: 'div',
	
	className: 'mpg-app',
	
	template: JST['app/layout'],
	
	initialize: function() {
		this.headerView = new MPG.Header();
		this.render();
	},
	
	render: function() {
		this.$el.html(this.template());
		$('.section-header', this.el).html(this.headerView.render().el);
		$('body').html(this.el);
	}
});
