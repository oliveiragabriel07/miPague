MP.collection.Group = Backbone.Collection.extend({
	url: '../home/getUserGroupList',
	model: MP.model.Group
});