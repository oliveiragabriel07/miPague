(function($){
	MPG.util = {};

	MPG.util.Format = {};
	var UtilFormat = MPG.util.Format;
	
	UtilFormat.plural = function(v, s, p) {
		return v === 1 ? s : p;
	}
}(jQuery))
