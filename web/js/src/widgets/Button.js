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
			//create menu
			this.menu = new MPG.Menu({
				items: this.menu,
				target: this.$el
			});
			//bind menu events
			this.menu.on('show', this.onShowMenu, this);
			this.menu.on('hide', this.onHideMenu, this);
			//extra css class
			this.cls += ' mpg-btn-menu';
		}
	},
	
	render: function() {
		this.$el.html(this.template({
			text: this.text,
			type: this.type,
			menuclass: this.menu ? 'mpg-btn-arrow' : ''
		}));
		
		this.$el.addClass(this.cls);
		this.rendered = true;
		
		return this;
	},
	
//listeners
	onClick: function(e) {
		e.preventDefault();
		if (this.menu && !this.menu.isVisible() && !this.ignoreClick) {
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
	},
	
	onHideMenu: function() {
		this.ignoreClick = true;
		setTimeout(_.bind(this.restoreClick, this), 250);
		this.$el.removeClass('mpg-btn-menu-active');
	},
	
	onShowMenu: function() {
		this.ignoreClick = false;
		this.$el.addClass('mpg-btn-menu-active');
	},
	
//other methods
	restoreClick: function() {
		this.ignoreClick = false;
	},
	
//public
    setText: function(text) {
        this.text = text;
        if (this.rendered) {
            $('button', this.el).html(this.text);
        }
        
    }
});