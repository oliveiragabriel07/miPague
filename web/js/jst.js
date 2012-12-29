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
// <div class="dropdown">
  // <!-- Link or button to toggle dropdown -->
  // <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    // <li><a tabindex="-1" href="#">Action</a></li>
    // <li><a tabindex="-1" href="#">Another action</a></li>
    // <li><a tabindex="-1" href="#">Something else here</a></li>
    // <li class="divider"></li>
    // <li><a tabindex="-1" href="#">Separated link</a></li>
  // </ul>
// </div>	
	'header': _.template([
		'<h1 class="mpg-logo"><a href="#" title="miPague">miPague</a></h1>',
		'<div class="mpg-notification"></div>',
        '<div class="mpg-right-menu">',
            '<ul class="mpg-link-list">',
                '<li class="dropdown">',
                    // '<div class="mpg-btn-link">',
                        // '<span class="mpg-btn-l"></span>',
                        // '<span class="mpg-btn-m">',
                            // '<em>',
                                '<a href="#" class="btn dropdown-toggle" data-toggle="dropdown">',
                                    '<%= displayname %>',
                                    '<span class="caret"></span>',
                                '</a>',
                                
                                '<ul class="dropdown-menu" role="menu">',
                                    '<li><a tabindex="-1" href="#">home</a></li>',
                                    '<li><a tabindex="-1" href="#user/profile">perfil</a></li>',
                                    '<li><a tabindex="-1" href="/login/logout">sair</a></li>',
                                '</ul>',
                            // '</em>',
                        // '</span>',
                        // '<span class="mpg-btn-r"></span>',
                    // '</div>',
                '</li>',
            '</ul>',
		'</div>'
	].join('')),
	
	'navigation': _.template([
	    '<div class="mpg-navigate-user">',
	       '<a href="#user/profile" class="navigate-profile user-profile-img-box">',
	           '<img src="<%= MPG.BLANK_IMAGE %>" class="user-profile-img"/>',
	       '</a>',
	       '<a href="#user/profile" class="navigate-profile user-profile-name"><%= displayname %></a>',
	    '</div>',
	    '<div class="mpg-navigate-main">',
    	    '<ul>',
    	       '<li><a href="#" class="navigate-home">Resumo</a></li>',
    	    '</ul>',
        '</div>',
        '<div class="mpg-navigate-group">',
        '</div>'
	].join('')),
	
	'button': _.template([
			'<span class="mpg-btn-l"></span>',
			'<span class="mpg-btn-m">',
				'<em class="<%= menuclass %>">',
					'<button type="<%= type %>"><%= text %></button>',
					'<span class="mpg-arrow"></span>',
				'</em>',
			'</span>',
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
		'<button class="new-expense">Despesa</button>'
	].join('')),
	
	'user/profile' : _.template([
	    '<div class="editfield">',
	       '<div class="view"><%= displayname%></div>',
	       '<div class="edit">',
	           '<input type="text" name="name" value="<%= name%>" />',
	           '<input type="text" name="surname" value="<%= surname%>" />',
	       '</div>',
	    '</div>'
	].join('')),
	
	'activity/listitem' : _.template([
		'<ul>',
			'<li><img class="mpg-activity-img mpg-<%= type %>" src="<%= MPG.BLANK_IMAGE %>" /></li>',
			'<li><%= date.toString("dd/MM/yyyy") %></li>',
			'<li><% print((type === "repayment") ? (userFrom + " reembolsou " + userTo ) : userList.toList(", ", " e ") + " " + MPG.util.Format.plural(userList.length, "pagou", "pagaram") + " por " + description) %></li>',
			'<li><%= value %></li>',
		'</ul>'
	].join('')),
	
	'bill/form': _.template([
		'<form>',
			'<p>Nova Conta</p>',
			'<button type="submit" id="send">Enviar</button>',
		'</form>'
	].join(''))
};
