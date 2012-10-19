MPG.association = {
	HASMANY : 'hasMany',
	HASONE : 'hasOne'
}

MPG.NestedModel = Backbone.Model.extend({
	associations: [],
	
	parse: function(data) {
		var cls, coll, m;
		
		_.each(this.associations, function(o) {
			if (o.type === MPG.association.HASMANY) {
				cls = MPG.ClassMgr.get(o.model);
				coll = this[o.key] = new cls();
				coll[o.foreignKey] = this;
				
				if (data[o.associationKey]) {
					this[o.key].reset(data[o.associationKey]);
					delete data[o.associationKey];
				}
			}
		}, this);
	}
});