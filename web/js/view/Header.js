MPG.Header = Backbone.View.extend({
	className: 'mpg-header',
	
	template: JST['header'],
	
	initialize: function() {
		var text = '{0} {1}',
			data = MPG.Bootstrap.User;
			
		//TODO ModelMgr
		//this.model = MPG.ModelMgr.get('MPG.model.User');
		//model.onchange -> updata dropdown text
			
		this.navigateAccountBtn = new MPG.Header.LinkButton({
			text: $.format(text, data.name, data.surname),
			menu: [{
				text: 'Sair',
				href: '/login/logout'
			},{
				text: 'Configuracoes da conta',
				href: '/#user'
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
});
