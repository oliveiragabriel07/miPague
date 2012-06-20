(function() {
	var map = {};
	
	MPG.ClassMgr = {
		reg: function(id, klass) {
			map[id] = klass;
		},
		
		unreg: function(id) {
			delete map[id];
		},
		
		get: function(id) {
			return map[id];
		}
	}
})();