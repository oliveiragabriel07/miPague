MPG.view.OperationListItem = Backbone.View.extend({
	tagName: 'li',
	
	template: JST['operation/listitem'],
	
    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});
