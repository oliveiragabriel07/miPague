/*
 * MPG namespace
 */

var MPG = {
	view: {},
	model: {},
	collection: {}
};

MPG.BLANK_IMAGE = '../web/img/blank.gif';

MPG.emptyFn = function() {};

MPG.AppRouter = Backbone.Router.extend({
    routes:{
        '': 'home',
        'groups/:id': 'groupDetails'
    },

    initialize:function () {
		this.groups = new MPG.collection.Group();
		
		this.appView = new MPG.AppLayout();
		this.navigateView = new MPG.view.GroupList({collection: this.groups});
		
		$('.navigation', this.appView.el).html(this.navigateView.render().el);
		
		/*
    	 * Todo bootstrap
    	 */
		this.groups.fetch();
    },
    
    home: function() {
    	$('.main-content', this.appView.el).html('Home Page');
    },
    
    groupDetails: function(id) {
    	this.group = this.groups.get(id);
    	
    	if (!this.group) {
    		alert('erro');
    		return;
    	}
    	
    	var groupView = new MPG.view.Group({model: this.group});
    	$('.main-content', this.appView.el).html(groupView.render().el);
    	
		this.group.activities.fetch();
    }
});

