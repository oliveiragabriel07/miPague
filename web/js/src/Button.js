MPG.Button = Backbone.View.extend({
//configs {
	cls: '',
	text: '',
	type: 'button',
	scope: this,
	handler: MPG.emptyFn,
//}
	
	tagName: 'div',
	
	className: 'mpg-btn',
	
	template: JST['button'],
	
	events: {
		'click': 'onClick',
		'mouseover': 'onMouseOver'
	},
	
	initialize: function(cfg) {
		$.extend(this, cfg);
		
		if (this.menu) {
			this.menu = new MPG.Menu({
				items: this.menu,
				target: this.$el
			});
		}
	},
	
	render: function() {
		this.$el.html(this.template({
			text: this.text,
			type: this.type,
			menuclass: this.menu ? 'mpg-btn-arrow' : ''
		}));
		
		this.$el.addClass(this.cls);
		
		return this;
	},
	
//listeners
	onClick: function(e) {
		e.preventDefault();
		if (this.menu) {
			this.menu.show();
		}
		if (this.handler) {
			this.handler.call(this.scope, this, e);			
		}
	},
	
	onMouseOver: function(e) {
		var el = this.$el,
			me = this;
		if (!el.hasClass('mpg-btn-over')) {
			el.addClass('mpg-btn-over');
			var fn = function(evt) {
				if (el.has(evt.target).length === 0) {
					el.removeClass('mpg-btn-over');
					$(document).off('mouseover', fn);					
				}
			}
			$(document).on('mouseover', fn);
		}
	}
});