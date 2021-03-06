MPG.view.Group = Backbone.View.extend({
	tagName: 'div',
	
	className: 'mpg-group-details',
	
	template: JST['group/details'],
	
	initialize: function(cfg) {
		this.homeView = new MPG.view.Group.Home({collection: this.model.activities});
		
		//bind events
		_.bindAll(this, 'render');		
	},
	
	render: function() {
		this.$el.html(this.template(this.model.toJSON()));
		this.mainEl = $('div.group-main', this.el);
		this.mainEl.html(this.homeView.render().el);
		
		return this;
	}
});

MPG.view.Group.Home = Backbone.View.extend({
	tagName: 'div',
	
	template: JST['group/home'],
	
	events: {
		'click button.new-expense': 'addExpense',
		'click button.new-repayment': 'addRepayment'
	},
	
	initialize: function () {
		this.activityListView = new MPG.view.ActivityList({collection: this.collection});
		_.bindAll(this, 'render');
	},
	
	render: function() {
		this.$el.html(this.template());
		
		//append activities list
		this.$el.append(this.activityListView.render().el);
		
		return this;
	},
	
	addRepayment: function() {
		console.log('new repayment');
	},
	
	addExpense: function() {
		console.log('new expense');
	}
})
