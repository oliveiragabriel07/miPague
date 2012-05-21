MPG.view.GroupListItem = Backbone.View.extend({
	tagName: 'li',
	
	template: JST['group/listitem'],
	
    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
		this.$el.addClass(this.model.get('cls'));
        return this;
    }
});