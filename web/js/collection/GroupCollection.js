MPG.collection.Group = Backbone.Collection.extend({
	url: '../group/getList',
	model: MPG.model.Group
});

MPG.ClassMgr.reg('GroupCollection', MPG.collection.Group);
