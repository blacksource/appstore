YUI.add('ntes-placeholder', function(Y) {

function Placeholder(cfg) {
	this._host = cfg.host;
	Placeholder.superclass.constructor.apply(this, arguments);
}

Placeholder.NAME = "placeholder";
Placeholder.NS = "placeholder";

var clsName = Y.ClassNameManager.getClassName(Placeholder.NAME, 'enable'),
	supported = "placeholder" in document.createElement("input");
	
Y.extend(Placeholder, Y.Plugin.Base, {
	initializer: function() {
		if(supported) {
			return false;
		} else {
			var self = this,
				host = this._host,
				form = this._form = host.ancestor("form");
			
			this._revert();
			this._simulate();
			
			host.on("focus", function() { self._revert(); });
			host.on("blur", function() { self._simulate(); });
			if(form) {
				form.on("submit", function() { self._revert(); });
			}
		}
	},

	destructor: function() {
		if(supported) {
			return false;
		} else {
			var host = this._host,
				form = this._form;
			
			this._revert();
			host.detachAll();
			if(form) {
				form.detachAll();
			}
		}
	},
	
	_simulate: function() {
		var host = this._host,
			placeholderText = host.getAttribute("placeholder");
		
		if(host.get("value") == "") {
			host.addClass(clsName).set("value", placeholderText);
		}
	},
 
	_revert: function() {
		var host = this._host,
			placeholderText = host.getAttribute("placeholder");
		
		if(host.get("value") == placeholderText) {
			host.removeClass(clsName).set("value", "");
		}
	},

	getValue: function() {
		var host = this._host,
			placeholderText = host.getAttribute("placeholder"),
			val = host.get("value");

		if(supported) {
			return val;
		} else {
			return placeholderText == val ? "" : val;
		}
	}
});

Y.namespace('Plugin');
Y.Plugin.Placeholder = Placeholder;


}, '3.3.0' ,{requires:['classnamemanager', 'node', 'plugin']});