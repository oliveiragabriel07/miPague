/*global Backbone, MPG, JST, $*/
(function() {
    'use strict';
    
    MPG.Header = Backbone.View.extend({
        className: 'mpg-header',
        
        template: JST.header,
        
    
        initialize: function() {
            this.model.on('change:displayname', this.onUserDisplayNameChange, this);
        },
    
        
        render: function() {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        },
        
    // listeners
        onUserDisplayNameChange: function(model, value) {
            this.$('.user-dropdown a.mpg-btn-link').html(model.get('displayname'));
        }
    });    
}());
