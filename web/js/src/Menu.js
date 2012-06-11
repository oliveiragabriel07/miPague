MPG.Menu = Backbone.View.extend({
	tagName: 'ul',
	
	className: 'mpg-menu',
	
	initialize: function(cfg) {
		this.items = cfg.items;
		this.target = cfg.target;
	},
	
	// private
	render: function() {
		var el = this.$el,
			itemTpl = JST['menuitem'],
			target = this.target
			w = target.width(),
			h = target.height();
		
		$.each(this.items, function(index, item) {
			el.append(itemTpl(item));
		});
		
		this.$el.addClass('mpg-hide-display');
		this.$el.width(w);
		this.$el.css('top', h);
		
		target.append(this.el);
		this.rendered = true;
		
		return this;
	},
	
	show: function() {
		if (!this.rendered) {
			this.render();			
		}
		
		this.$el.removeClass('mpg-hide-display');
		return this;
	},
	
	hide: function() {
		this.$el.addClass('mpg-hide-display');
	}
	
});
