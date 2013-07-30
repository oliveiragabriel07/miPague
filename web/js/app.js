/*
 * MPG namespace
 */

var MPG = {};

MPG.view = {};
MPG.model = {};
MPG.collection = {};
MPG.BLANK_IMAGE = '../web/img/blank.gif';
MPG.emptyFn = function() {};

MPG.AppRouter = Backbone.Router.extend({
    routes:{
        '': 'home',
        'groups/:id': 'groupDetails',
        'user/profile': 'userProfile',
        'bill/add': 'addBill'
    },

    initialize:function () {
        this.user = new MPG.model.User(MPG.Bootstrap.User, {parse: true});
        this.groups = this.user.groups;
        
        this.appView = new MPG.AppLayout({model : this.user});
        this.mainEl = $('.main-content', this.appView.el);
    },
    
    home: function() {
        this.mainEl.html('Home Page');
    },
    
    groupDetails: function(id) {
        var groups = this.user.groups,
            activeGroup = groups.get(id);
        
        if (!activeGroup) {
            alert('erro');
            return;
        }
        
        var groupView = new MPG.view.Group({model: activeGroup});
        this.mainEl.html(groupView.render().el);
        
        activeGroup.activities.fetch();
    },
    
    userProfile: function() {
        var userView = new MPG.view.User({model: this.user});
       this.mainEl.html(userView.render().el);
    },
    
    addBill: function() {
		var billView = new MPG.view.BillForm();
    	this.mainEl.html(billView.render().el);
    	billView.enhanceElements();
    }
});
    