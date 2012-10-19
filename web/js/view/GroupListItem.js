MPG.view.GroupListItem = Backbone.View.extend({
	tagName: 'li',
	
	className: 'group-list-item',
	
	template: JST['group/listitem'],
	
    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
		this.$el.addClass(this.model.get('cls'));
        return this;
    }
});
