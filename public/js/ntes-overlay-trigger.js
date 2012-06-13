YUI.add('ntes-overlay-trigger', function(Y) {

var HOST = 'host',
	CONTENT_BOX = 'boundingBox',
	NODE = 'node',
	TRIGGER = 'trigger',
	SELECTED = 'selected',
	VISIBLE_CHANGE = 'visibleChange',
	MOUSEENTER = 'mouseenter',
	MOUSELEAVE = 'mouseleave';
	
function OverlayTrigger (config) {
	OverlayTrigger.superclass.constructor.apply(this, arguments);
};

OverlayTrigger.NS = 'trigger';

OverlayTrigger.NAME = 'pluginOverlayTrigger';

OverlayTrigger.ATTRS = {
	node: {
		setter: function (node) {
			node = Y.one(node);
            if (node) {
                node.addClass(this._className.trigger);
            }
            return node;
		}
	}
};

Y.extend(OverlayTrigger, Y.Plugin.Base, {
	initializer: function () {
		var overlay = this.get(HOST),
			contentBox = overlay.get(CONTENT_BOX),
			trigger;
		
		this._className = {
			trigger: overlay.getClassName(TRIGGER),
			selectedTrigger: overlay.getClassName(TRIGGER, SELECTED)
		}
		
		trigger = this.get(NODE);
		
		this._ovrEvents = [
			overlay.after(VISIBLE_CHANGE, this._afterVisibleChange, this),
			trigger.on(MOUSEENTER, this._onMouseenter, this),
			trigger.on(MOUSELEAVE, this._onMouseleave, this),
    		contentBox.on(MOUSEENTER, this._onMouseenter, this),
    		contentBox.on(MOUSELEAVE, this._onMouseleave, this)	
		]
		
	},
	
	destructor: function () {
		var events = this._ovrEvents;

        while (events && events.length) {
            events.pop().detach();
        }
	},
	
	_afterVisibleChange: function (e) {
		this.get(NODE).toggleClass(this._className.selectedTrigger, e.newVal);
	},
	
	_onMouseenter: function () {
		if (this._timer) {
			this._timer.cancel();
			this._timer = undefined;
		} else {
			this._timer = Y.later(100, this, function () {
				this.get(HOST).align(this.get(NODE), ['tl', 'bl']);
				this.get(HOST).show();
				this._timer = undefined;
			});
		}
	},
	
	_onMouseleave: function () {
		if (this._timer) {
			this._timer.cancel();
			this._timer = undefined;
		} else {
			this._timer = Y.later(100, this, function () {
				this.get(HOST).hide();
				this._timer = undefined;
			});
		}
	}
});
				
Y.namespace('Plugin').OverlayTrigger = OverlayTrigger;

}, '3.3.0' ,{requires:['plugin', 'overlay']});