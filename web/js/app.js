/*
 * MPG namespace
 */

var MPG = {
	view: {},
	model: {},
	collection: {}
};

MPG.App = Backbone.Router.extend({
    routes:{
        '': 'home',
        'groups/:id': 'groupDetails'
    },

    initialize:function () {
    	/*
    	 * Todo bootstrap
    	 */
		this.groups = new MPG.collection.Group();
		this.groups.fetch();
    },
    
    home: function() {
    	if (!this.groupList) {
			this.groupList = new MPG.view.GroupList({collection: this.groups});
			this.groupList.render();    		
    	}
		
		$('body').html(this.groupList.el);
    },
    
    groupDetails: function(id) {
    	this.group = this.groups.get(id);
    	
    	if (!this.group) {
    		alert('erro');
    		return;
    	}
    	
    	this.group.activities.fetch();
    	var groupView = new MPG.view.Group({model: this.group});

    	$('body').html(groupView.render().el);
    }
});

