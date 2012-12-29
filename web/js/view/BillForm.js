MPG.view.BillForm = Backbone.View.extend({
	tagName: 'div',
	
	template: JST['bill/form'],
	
	events: {
		'click button#send': 'addBill'
	},
	
	addBill: function(e) {
		e.preventDefault();
		
		$.ajax({
			type: 'POST',
			data: {
				date: (new Date()).toString('yyyy-MM-dd'),
				description: 'Nova despesa',
				group: '1',
				value: '99.98',
				expenses: [{
					user: '2',
					value: '99.98'
				}],
				shares: [{
					user: '1',
					value: '49.99'
				},{
					user: '2',
					value: '49.99'
				}]
			},
			url: '../expense',
			dataType: 'json',
			success: function(data) {
				alert('Successo')
			}
		});
	},
	
	render: function() {
		this.$el.html(this.template());
		return this;
	}
});
