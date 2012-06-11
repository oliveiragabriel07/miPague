Array.prototype.toList = function(separator, aggregator) {
	aggregator = aggregator || separator;
	return this.join(aggregator, [this.join(separator, this.slice(0, -1)), this.slice(-1)]);
};