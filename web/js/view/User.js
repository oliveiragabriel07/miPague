MPG.view.User = Backbone.View.extend({
    tagName: 'div',
    
    template: JST['user/profile'],
    
    render: function() {
        this.$el.html(this.template(this.model.toJSON()));
        this.enhanceElements();
        return this;
    },
    
    enhanceElements: function() {
        var self = this;
        
        Backbone.Validation.bind(this);
        
        $('.editfield', this.$el).editable({
            callback: $.proxy(this.onEditName, this)
        });
    },
    
    onEditName: function(btn) {
        // update model
        if (btn === 'save') {
            var name = this.$('input[name="name"]').val(),
                surname = this.$('input[name="surname"]').val(),
                data = {
                    name : name,
                    surname : surname,
                    displayname: name + ' ' + surname
                }; 

            
            if (!this.model.set(data)) {
                return false;
            }
            
            // self.model.sync();
        }
        
        this.render();
    }
});
