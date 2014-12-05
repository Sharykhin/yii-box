/*! Tmpl.js v0.1.1 | GC92 | MIT | https://github.com/GC92/tmpl */
(function () {
	String.prototype.tmpl = function (data) {
		return this.replace(/{{\s*?(\w*)\s*?}}/g, function(match, key, position) {
			return data[key];
		});
	};
})();
