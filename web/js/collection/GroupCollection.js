MPG.collection.Group = Backbone.Collection.extend({
	url: '../group/getUserGroupList',
	model: MPG.model.Group
});