MPG.AppLayout = Backbone.View.extend({
	tagName: 'div',
	
	className: 'mpg-app',
	
	template: JST['app/layout'],
	
	initialize: function() {
		this.headerView = new MPG.Header();
		this.render();
	},
	
	render: function() {
		this.$el.html(this.template());
		$('.section-header', this.el).html(this.headerView.render().el);
		$('body').html(this.el);
	}
});

MPG.Header = Backbone.View.extend({
	className: 'mpg-header',
	
	template: JST['header'],
	
	initialize: function() {
		this.navigateAccountBtn = new MPG.Header.LinkButton({
			text: 'Gabriel Oliveira',
			menu: [{
				text: 'Sair',
				href: '/login/logout'
			},{
				text: 'Configuracoes da conta',
				href: '#'
			}]
		});
	},
	
	render: function() {
		this.$el.html(this.template());

		$('ul.mpg-link-list', this.el).append(this.navigateAccountBtn.render().el);
		return this;
	}
	
});

MPG.Header.LinkButton = MPG.Button.extend({
	tagName: 'li',
	cls: 'mpg-btn-link'
})
