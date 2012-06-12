MPG.Menu = Backbone.View.extend({
	tagName: 'ul',
	
	className: 'mpg-menu',
	
	itemTpl:  JST['menuitem'],
	
	offset: '0 -1',
	
	align: {
		my: 'right top',
		at: 'right bottom'
	},
	
	initialize: function(cfg) {
		this.items = cfg.items;
		this.target = cfg.target;
		this.position = $.extend({
			offset: this.offset,
			of: this.target
		},this.align);
	},
	
	// private
	render: function() {
		var el = this.$el,
			itemTpl = this.itemTpl,
			borderOffset;
		
		$.each(this.items, function(index, item) {
			el.append(itemTpl(item));
		});
		
		this.$el.addClass('mpg-hide-display');
		
		//append to body
		$('body').append(this.el);
		
		//check min width
		if (this.$el.width() < this.target.width()) {
			borderOffset = this.$el.outerWidth(false) - this.$el.width();
			this.$el.width(this.target.width() - borderOffset);
		}
		
		//re-position
		this.$el.position(this.position);
		
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
