MPG.view.ActivityListItem = Backbone.View.extend({
	tagName: 'li',
	
	template: JST['activity/listitem'],
	
    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});
