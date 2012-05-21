var JST = {
	'group/listitem' : _.template(
		'<a href="#groups/<%= id %>"><%= name %></a>'
	),
	
	'group/details' : _.template([
		'<h3><%= name %></h3>',
		'<ul>',
			'<li><a href="#">inicio</a></li>',
			'<li><a href="#">pessoas</a></li>',
			'<li><a href="#">analises</a></li>',
			'<li><a href="#">planejamento</a></li>',
		'</ul>',
		'<div class="group-main"></div>'
	].join('')),
	
	'group/home' : _.template([
		'<button class="new-repayment">Reembolso</button>',
		'<button class="new-expense">Despesa</button>',
	].join('')),
	
	'operation/listitem' : _.template([
		'<ul>',
			'<li><%= DATE %></li>',
			'<li><%= USERNAME %> pagou por <%= DESCRIPTION %></li>',
			'<li><%= VALUE %></li>',
		'</ul>'
	].join(''))
};
