/*global MPG, Backbone */
jQuery(function($) {
    "use strict";
	MPG.app = new MPG.AppRouter();
	Backbone.history.start();
});