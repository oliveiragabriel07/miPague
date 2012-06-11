MPG.view.ActivityListItem = Backbone.View.extend({
	tagName: 'li',
	
	className: 'mpg-activity-list-item',
	
	template: JST['activity/listitem'],
	
    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});
