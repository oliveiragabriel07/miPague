MPG.collection.Group = Backbone.Collection.extend({
	url: '../home/getUserGroupList',
	model: MPG.model.Group
});