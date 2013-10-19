/*global Backbone, MPG, JST, $*/
(function () {
   "use strict";

    MPG.AppLayout = Backbone.View.extend({
        tagName: 'div',
        
        className: 'app-layout',
        
        template: JST['app/layout'],
        
        initialize: function() {
            this.headerView = new MPG.Header({ model : this.model });
            this.navigateView = new MPG.Navigation({ model : this.model }); 
            this.render();
        },
        
        render: function() {
            this.$el.html(this.template());
            $('.header', this.el).html(this.headerView.render().el);
            $('.navigation', this.el).html(this.navigateView.render().el);
            $('body').html(this.el);
        }
    });
    
    MPG.Navigation = Backbone.View.extend({
        template: JST.navigation,
        
        initialize: function() {
            this.navigateGroups = new MPG.view.GroupList({collection: this.model.groups});
        },
        
        render: function() {
            this.$el.html(this.template(this.model.toJSON()));
            $('.mpg-navigate-group', this.el).html(this.navigateGroups.render().el);
            return this;
        }
    });   
}());

