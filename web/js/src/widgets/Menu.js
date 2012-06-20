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
		
		$(window).on('resize', _.bind(this.onWindowResize, this));
	},
	
//listeners
	onWindowResize: function() {
		var me = this;
		
		if (!this.visible) {
			return;
		}
		setTimeout(function() {
			me.hide();
		}, 200);
	},
	
	onMouseDown: function(e) {
		if ($(e.target).closest('.mpg-menu').length === 0) {
			this.hide();
			$(document).off('mousedown.menu');			
		}
	},

//other methods
	// private
	render: function() {
		var el = this.$el,
			itemTpl = this.itemTpl,
			borderOffset;
		
		$.each(this.items, function(index, item) {
			el.append(itemTpl(item));
		});
		
		this.$el.addClass('mpg-hide-visibility');
		
		//append this element to body
		$('body').append(this.el);
		
		//check min width
		if (this.$el.width() < this.target.width()) {
			borderOffset = this.$el.outerWidth(false) - this.$el.width();
			this.$el.width(this.target.width() - borderOffset);
		}
		
		//rise rendered flag
		this.rendered = true;
		
		return this;
	},
	
	doAlign: function() {
		this.$el.position(this.position);
	},
	
	show: function() {
		if (!this.rendered) {
			this.render();			
		}
		
		//align menu to target
		this.doAlign();
		//remove hidden css class
		this.$el.removeClass('mpg-hide-visibility');
		//bind window mouse down
		$(document).on('mousedown.menu', _.bind(this.onMouseDown, this));
		//rise visible flag
		this.visible = true;
		this.trigger('show');
		
		return this;
	},
	
	hide: function() {
		this.$el.addClass('mpg-hide-visibility');
		this.visible = false;
		this.trigger('hide');
	},
	
	isVisible: function() {
		return !!this.visible;
	}
	
});
