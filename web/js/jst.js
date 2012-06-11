var JST = {
	'app/layout': _.template([
		'<div class="wrapper header-wrapper">',
			'<div class="section section-header"></div>',
		'</div>',
		'<div class="wrapper body-wrapper">',
			'<div class="section">',
				'<div class="body">',
					'<div class="navigation"></div>',
					'<div class="content">',
						'<div class="main-content"></div>',
						'<div class="side-content"></div>',
					'</div>',
				'</div>',			
			'</div>',
		'</div>',
		'<div class="wrapper footer-wrapper">',
			'<div class="section">',
				'<div class="footer"></div>',			
			'</div>',
		'</div>'					
	].join('')),
	
	'header': _.template([
		'<h1 class="mpg-logo"><a href="#" title="miPague">miPague</a></h1>',
		'<div class="mpg-notification"></div>',
		'<div class="mpg-right-menu">',
			'<ul class="mpg-link-list"></ul>',
		'</div>'
	].join('')),
	
	'button': _.template([
			'<span class="mpg-btn-l"></span>',
			'<span class="mpg-btn-m"><em class="<%= menuclass %>"><button type="<%= type %>"><%= text %></button></em></span>',
			'<span class="mpg-btn-r"></span>'
	].join('')),
	
	'menuitem': _.template([
		'<li class="mpg-menu-item"><a href="<%= href %>"><%= text %></a></li>'
	].join('')),
	
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
	
	'activity/listitem' : _.template([
		'<ul>',
			'<li><img class="mpg-activity-img mpg-<%= type %>" src="<%= MPG.BLANK_IMAGE %>" /></li>',
			'<li><%= date.toString("dd/MM/yyyy") %></li>',
			'<li><% print((type === "repayment") ? (userFrom + " reembolsou " + userTo ) : userList.toList(", ", " e ") + " " + MPG.util.Format.plural(userList.length, "pagou", "pagaram") + " por " + description) %></li>',
			'<li><%= value %></li>',
		'</ul>'
	].join(''))
};
