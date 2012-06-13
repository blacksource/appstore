YUI.add('ntes-tabs-base', function(Y) {

/**
 * The NTES Tabs base module 
 *
 * @module ntes-tabs
 * @submodule ntes-tabs-base
 */

var Lang = Y.Lang,
	
	DOT = '.',
	TRIGGER = 'trigger',
	PANEL = 'panel',
	SELECTED = 'selected';
	
/**
 * Provides a tabs widget interface 
 * 
 * @class Tabs
 * @param config {Object} Object literal specifying tabs configuration properties
 * @constructor
 * @extends Widget
 */
function Tabs (config) {
	Tabs.superclass.constructor.apply(this, arguments);
};

Y.extend(Tabs, Y.Widget, {

	// Y.Tabs prototype

    /**
     * Construction logic executed during Tabs instantiation.
     *
     * @method initializer
     * @protected
     */
	initializer: function () {
		this._items = [];
		this.publish('selectTab', {
            defaultFn: this._defSelectTabFn
        });
        this.publish('deselectTab', {
            defaultFn: this._defDeselectTabFn
        });
	},

	/**
     * Detaches Tabs event listeners.
     *
     * @method destructor
     * @protected
     */
	destructor: function () {
		this.get('contentBox').detach(this.get('triggerEvent'));
		this.detach('selectedIndexChange');
	},

	/**
     * Create the DOM structure for the Tabs.
     *
     * @method renderUI
     * @protected
     */
	renderUI: function () {
		var triggers = this.get('triggers'),
			panels = this.get('panels'),
			classNames = {
				trigger: this.getClassName(TRIGGER),
				panel: this.getClassName(PANEL),
				selectedTrigger: this.getClassName(TRIGGER, SELECTED),
				selectedPanel: this.getClassName(PANEL, SELECTED)
			},
			i = 0, trigger, panel, selectedIndex, selection;
			
		while ( ( trigger = triggers.item(i) ) && ( panel = panels.item(i) ) ) {
			if ( trigger.hasClass(classNames.selectedTrigger) ) {
				selectedIndex = i;
			}
			
			this._items.push({
				trigger: trigger,
				panel: panel,
				selected: false
			});
			trigger.addClass(classNames.trigger);
			panel.addClass(classNames.panel);
			
			i++;
		}
		
		if ( !Lang.isNumber(selectedIndex) ) {
			selectedIndex = this.get('selectedIndex');
			selection = this.item(selectedIndex);
			selection.trigger.addClass(classNames.selectedTrigger);
			selection.panel.addClass(classNames.selectedPanel);
		}
		this.set('selectedIndex', selectedIndex);
	},

	/**
     * Creates the trigger event delegate used to handle the tab switch and
     * binds Tabs interaction to the configured value model.
     *
     * @method bindUI
     * @protected
     */
	bindUI: function () {
		this.get('contentBox').delegate(this.get('triggerEvent'), this._onTrigger, DOT + this.getClassName(TRIGGER), this);
		this.after('selectedIndexChange', this._afterSelectedIndexChange);
	},

	/**
     * Delegated event handler for item <code>trigger</code> events.
     *
     * @method _onTrigger
     * @param e {EventTarget}
     * @protected
     */
	_onTrigger: function (e) {
		var index = this.get('triggers').indexOf(e.currentTarget);
		
		e.preventDefault();
		this.select(index);
	},

	/**
     * Handles changes to the <code>selectedIndex</code> attribute.
     *
     * @method _afterSelectedIndexChange
     * @param e {Event} The selectedIndexChange event object
     * @protected
     */
	_afterSelectedIndexChange: function (e) {
		var prevTab = this.item(e.prevVal),
			newTab = this.item(e.newVal);
			
		prevTab.selected = false;
		this.fire('selectTab', { trigger: newTab.trigger, panel: newTab.panel });
		this.fire('deselectTab', { trigger: prevTab.trigger, panel: prevTab.panel });
	},

	/**
     * Default behavior for the select tab event.
     *
     * @method _defSelectTabFn
     * @param e {Event} the EventFacade for the select tab custom event
     * @protected
     */
	_defSelectTabFn: function (e) {
		e.trigger.addClass( this.getClassName(TRIGGER, SELECTED) );
		e.panel.addClass( this.getClassName(PANEL, SELECTED) );
	},

	/**
     * Default behavior for the deselect tab event.
     *
     * @method _defDeselectTabFn
     * @param e {Event} the EventFacade for the deselect tab custom event
     * @protected
     */
	_defDeselectTabFn: function (e) {
		e.trigger.removeClass( this.getClassName(TRIGGER, SELECTED) );
		e.panel.removeClass( this.getClassName(PANEL, SELECTED) );
	},

	/**
     * Selects the item at the given index (zero-based).
     *
     * @method select
     * @param index {Number} the index of the item to be selected
     */
	select: function (index) {
		this.set('selectedIndex', index);
	}
}, {

	// Y.Tabs static properties

    /**
     * The identity of the tabs.
     *
     * @property Tabs.NAME
     * @type String
     * @default 'tabs'
     * @readOnly
     * @protected
     * @static
     */
	NAME: 'tabs',

	/**
     * Static property used to define the default attribute configuration of the Tabs.
     *
     * @property Tabs.ATTRS
     * @type {Object}
     * @protected
     * @static
     */
	ATTRS: {

		/**
	     * Nodelist of the tabs's triggers. 
	     *
	     * @attribute triggers
	     * @type NodeList|String
	     * @writeonce
	     */
	    triggers: {
	    	setter: function (nodelist) {
	    		if ( Lang.isString(nodelist) ) {
	    			nodelist = this.get('contentBox').all(nodelist);
	    		}
	
	            return nodelist;
	    	},
	    	writeOnce: true
	    },

		/**
	     * Nodelist of the tabs's panels. 
	     *
	     * @attribute panels
	     * @type NodeList|String
	     * @writeonce
	     */
	    panels: {
	    	setter: function (nodelist) {
	    		if ( Lang.isString(nodelist) ) {
	    			nodelist = this.get('contentBox').all(nodelist);
	    		}
	
	            return nodelist;
	    	},
	    	writeOnce: true
	    },

		/**
		 * Trigger event
         *
         * @attribute triggerEvent
         * @default "click" 
         * @type String
         * @writeonce
         */
		triggerEvent: {
	    	value: 'click',
	    	writeOnce: true,
	    	validator: Lang.isString
	   	},

		/**
	     * Current selected index.
	     *
	     * @attribute selectedIndex
	     * @type Number
	     */
	    selectedIndex: {
	    	value: 0,
	    	setter: function (index) {
	    		this.item(index).selected = true;
	    		
	    		return index;
	    	},
	    	validator: function (value) {
	    		return Lang.isNumber(value) && value >= 0 && value < this.size();
	    	}
	    }
   	},

	/**
     * Object hash, defining how attribute values are to be parsed from
	 * markup contained in the tabs's content box.
     *
     * @property Tabs.HTML_PARSER
     * @type {Object}
     * @protected
     * @static
     */
   	HTML_PARSER: {
		triggers: ['> ul > li'],
		panels: ['> div > div']
	}
});

Y.augment(Tabs, Y.ArrayList);

Y.Tabs = Tabs;

}, '3.3.0' ,{requires:['widget', 'arraylist']});
YUI.add('ntes-tabs-transition', function(Y) {

/**
 * Provides a plugin which can be used to switch tabs with transition.
 *
 * @module ntes-tabs
 * @submodule ntes-tabs-transition
 */
var Lang = Y.Lang,

	BOUNDING_BOX = 'boundingBox',
	TRIGGER = 'trigger',
	PANEL = 'panel',
	SELECTED = 'selected',
	RENDERUI = 'renderUI',
	BINDUI = 'bindUI',
	
	HOST = 'host',
	TRANSITION = 'transition',
	FX = 'fx',
	FX_CHANGE = 'fxChange',
	NONE = 'none',
	_IN = 'In',
	_OUT = 'Out',
	EVT_SELECT_TAB = 'tabs:selectTab',
	EVT_DESELECT_TAB = 'tabs:deselectTab';

/**
 * A plugin class which can be used to switch tabs with transition.
 *
 * @class TabsTransition
 * @param config {Object} The user configuration for the plugin  
 * @extends Plugin.Base
 * @namespace Plugin
 */	
function TabsTransition (config) {
	TabsTransition.superclass.constructor.apply(this, arguments);
};


/**
 * The namespace for the plugin. This will be the property on the widget, which will 
 * reference the plugin instance, when it's plugged in.
 *
 * @property TabsTransition.NS
 * @static
 * @type String
 * @default "transition"
 */
TabsTransition.NS = 'transition';

/**
 * The NAME of the TabsTransition class. Used to prefix events generated
 * by the plugin class.
 *
 * @property TabsTransition.NAME
 * @static
 * @type String
 * @default "pluginTabsTransition"
 */
TabsTransition.NAME = 'pluginTabsTransition';

/**
 * Pre-Packaged TabsTransition implementations, which can be used for selectTab and deselectTab event.
 *
 * @property TabsTransition.FX
 * @static
 * @type Object
 */
TabsTransition.FX = {
	
	fadeOut: {
        opacity: 0,
        duration: 0.5,
        easing: 'ease-out',
        on: {
        	end: function () {
        		this.setStyle('opacity', (Y.UA.ie) ? 1 : '');
        	}
        }
    },

    fadeIn: {
        opacity: 1,
        duration: 0.5,
        easing: 'ease-in',
        on: {
        	start: function () {
        		this.setStyle('opacity', 0);
        	}
        }
    },
    
    sizeXOut: {
    	width: 0,
    	duration: 0.5,
        easing: 'ease',
        on: {
            start: function() {
                var overflow = this.getStyle('overflow');
                if (overflow !== 'hidden') {
                    this.setStyle('overflow', 'hidden');
                    this._transitionOverflow = overflow;
                }
            },

            end: function() {
                if (this._transitionOverflow) {
                    this.setStyle('overflow', this._transitionOverflow);
                }
                this.setStyle('width', '');
            }
        }
    },
    
    sizeXIn: {
    	width: function(node) {
        	return node.get('scrollWidth') + 'px';
    	},
    	duration: 0.5,
        easing: 'ease',
        on: {
            start: function() {
                var overflow = this.getStyle('overflow');
                if (overflow !== 'hidden') {
                    this.setStyle('overflow', 'hidden');
                    this._transitionOverflow = overflow;
                }
                this.setStyle('width', 0);
            },

            end: function() {
                if (this._transitionOverflow) {
                    this.setStyle('overflow', this._transitionOverflow);
                }
            }
        } 
    },
    
    sizeYOut: {
    	height: 0,
    	duration: 0.5,
        easing: 'ease',
        on: {
            start: function() {
                var overflow = this.getStyle('overflow');
                if (overflow !== 'hidden') {
                    this.setStyle('overflow', 'hidden');
                    this._transitionOverflow = overflow;
                }
            },

            end: function() {
                if (this._transitionOverflow) {
                    this.setStyle('overflow', this._transitionOverflow);
                }
                this.setStyle('height', '');
            }
        }
    },
    
    sizeYIn: {
    	height: function(node) {
        	return node.get('scrollHeight') + 'px';
    	},
    	duration: 0.5,
        easing: 'ease',
        on: {
            start: function() {
                var overflow = this.getStyle('overflow');
                if (overflow !== 'hidden') {
                    this.setStyle('overflow', 'hidden');
                    this._transitionOverflow = overflow;
                }
                this.setStyle('height', 0);
            },

            end: function() {
                if (this._transitionOverflow) {
                    this.setStyle('overflow', this._transitionOverflow);
                }
            }
        } 
    }
};

/**
 * Static property used to define the default attribute 
 * configuration for the plugin.
 *
 * @property TabsTransition.ATTRS
 * @type Object
 * @static
 */
TabsTransition.ATTRS = {

	/**
     * Used as the default effect for the transition.
     *
     * @attribute fx
     * @type String
     * @default "fade"
     */
	fx: {
		value: 'fade',
		validator: Lang.isString
	}
};

Y.extend(TabsTransition, Y.Plugin.Base, {
	
	/**
     * The initializer lifecycle implementation.
     *
     * @method initializer
     * @protected 
     */
	initializer: function () {
		var tabs = this.get(HOST);
		
		this.after(FX_CHANGE, this._afterFxChange);
		tabs.get(BOUNDING_BOX).addClass( tabs.getClassName(TRANSITION, this.get(FX) ) );
		tabs.on(EVT_SELECT_TAB, this._onSelectTab, this);
		tabs.on(EVT_DESELECT_TAB, this._onDeselectTab, this);
	},
	
	/**
     * The initializer destructor implementation.
     * 
     * @method destructor
     * @protected 
     */
	destructor: function () {
		var tabs = this.get(HOST);
		tabs.detach(EVT_SELECT_TAB);
		tabs.detach(EVT_DESELECT_TAB);
	},
	
	/**
     * Handles changes to the <code>fx</code> attribute.
     *
     * @method _afterFxChange
     * @param e {Event} The fxChange event object
     * @protected
     */
	_afterFxChange: function (e) {
		var boundingBox = this.get(BOUNDING_BOX);

		boundingBox.removeClass( this.getClassName(FX, e.prevVal) );
		boundingBox.addClass( this.getClassName(FX, e.newVal) );
	},
	
	/**
     * Dispatches the selectTab event.
     *
     * @method _onSelectTab
     * @param e {DOMEvent} the selectTab event object
     * @protected
     */
	_onSelectTab: function (e) {
		var tabs = this.get(HOST),
			fx = this.get(FX);
			
		e.preventDefault();
		e.trigger.addClass( tabs.getClassName(TRIGGER, SELECTED) );
		e.panel.addClass( tabs.getClassName(PANEL, SELECTED) );
		
		if (fx !== NONE) {
			e.panel.transition(TabsTransition.FX[fx + _IN]);
		}
	},
	
	/**
     * Dispatches the deselectTab event.
     *
     * @method _onDeselectTab
     * @param e {DOMEvent} the deselectTab event object
     * @protected
     */
	_onDeselectTab: function (e) {
		var tabs = this.get(HOST),
			fx = this.get(FX);
		
		e.preventDefault();
		e.trigger.removeClass( tabs.getClassName(TRIGGER, SELECTED) );
		
		if (fx !== NONE) {
			e.panel.transition(TabsTransition.FX[fx + _OUT], function () {
				this.removeClass( tabs.getClassName(PANEL, SELECTED) );
			});
		} else {
			e.panel.removeClass( tabs.getClassName(PANEL, SELECTED) );
		}
	}
});

Y.namespace('Plugin').TabsTransition = TabsTransition;

}, '3.3.0', {requires:['plugin', 'ntes-tabs-base', 'transition']});
YUI.add('ntes-tabs-player', function(Y) {

/**
 * Provides a plugin which can be used to play tabs at the same time intervals.
 *
 * @module ntes-tabs
 * @submodule ntes-tabs-player
 */
var Lang = Y.Lang,

	DOT = '.',
	HOST = 'host',
	BOUNDING_BOX = 'boundingBox',
	TRIGGER = 'trigger',
	PANEL = 'panel',
	SELECTED_INDEX = 'selectedIndex',
	
	AUTOPLAY = 'autoplay',
	PAUSE_ON_HOVER = 'pauseOnHover',
	INTERVAL = 'interval',
	PLAYING = 'playing',
	EVT_SWITCH = 'switch',
	INTERVAL_CHANGE = 'intervalChange',
	PLAYING_CHANGE = 'playingChange',
	MOUSEENTER = 'mouseenter',
	MOUSELEAVE = 'mouseleave';

/**
 * A plugin class which can be used to play tabs at the same time intervals.
 *
 * @class TabsPlayer
 * @param config {Object} The user configuration for the plugin  
 * @extends Plugin.Base
 * @namespace Plugin
 */	
function TabsPlayer (config) {
	TabsPlayer.superclass.constructor.apply(this, arguments);
};

/**
 * The namespace for the plugin. This will be the property on the widget, which will 
 * reference the plugin instance, when it's plugged in.
 *
 * @property TabsPlayer.NS
 * @static
 * @type String
 * @default "player"
 */
TabsPlayer.NS = 'player';

/**
 * The NAME of the TabsPlayer class. Used to prefix events generated
 * by the plugin class.
 *
 * @property TabsPlayer.NAME
 * @static
 * @type String
 * @default "pluginTabsPlayer"
 */
TabsPlayer.NAME = 'pluginTabsPlayer';

/**
 * Static property used to define the default attribute 
 * configuration for the plugin.
 *
 * @property TabsPlayer.ATTRS
 * @type Object
 * @static
 */
TabsPlayer.ATTRS = {
	
	/**
	 * Whether or not the tabs to be playing at initializer.
	 * 
     * @attribute autoplay
     * @type Boolean
     * @default true
     * @writeOnce 
     */
	autoplay: {
		value: true,
		validator: Lang.isBoolean,
		writeOnce: true
	},
	
	/**
	 * Whether or not the playing tabs to be paused when the mouse is over the triggers or panels.
	 * 
     * @attribute pauseOnHover
     * @type Boolean
     * @default true
     * @writeOnce 
     */
	pauseOnHover: {
   		value: true,
   		validator: Lang.isBoolean,
   		writeOnce: true
   	},
   	
   	/**
     * Default interval in seconds. Used as the default interval for the default play implementations
     *
     * @attribute interval
     * @type Number
     * @default 5 (seconds)s
     */
	interval: {
		value: 5,
		validator: function (value) {
			return Lang.isNumber(value) && value > 0;
		}
   	},
   	
   	/**
     * Whether or not the tabs are currently playing.
     * @attribute playing 
     * @type Boolean
     * @default false 
     * @readOnly
     */
   	playing: {
   		value: false,
   		readOnly: true
   	}
};

Y.extend(TabsPlayer, Y.Plugin.Base, {
	
	/**
     * The initializer lifecycle implementation.
     *
     * @method initializer
     * @protected 
     */
	initializer: function () {
		var tabs, boundingBox, filter;

		if ( this.get(PAUSE_ON_HOVER) ) {
			tabs = this.get(HOST);
			boundingBox = tabs.get(BOUNDING_BOX);
			filter = DOT + tabs.getClassName(TRIGGER) + ', ' + DOT + tabs.getClassName(PANEL);
			
			boundingBox.delegate(MOUSEENTER, this._onMouseEnter, filter, this);
			boundingBox.delegate(MOUSELEAVE, this._onMouseLeave, filter, this);
		}
		
		this.after(INTERVAL_CHANGE, this._afterIntervalChange);
		this.after(PLAYING_CHANGE, this._afterPlayingChange);
		
		this.publish(EVT_SWITCH, {
            defaultFn: this._defSwitchFn
        });
		
		if ( this.get(AUTOPLAY) ) {
			this.play();	
		}
	},
	
	/**
     * The initializer destructor implementation.
     * 
     * @method destructor
     * @protected 
     */
	destructor: function () {
		var boundingBox;
		
		this.pause();
		if ( this.get(PAUSE_ON_HOVER) ) {
			boundingBox = this.get(HOST).get(BOUNDING_BOX);
			
			boundingBox.detach(MOUSEENTER);
			boundingBox.detach(MOUSELEAVE);
		}
	},
	
	/**
     * Handles changes to the <code>interval</code> attribute.
     *
     * @method _afterIntervalChange
     * @param e {Event} The intervalChange event object
     * @protected
     */
	_afterIntervalChange: function (e) {
		this.play();
	},
	
	/**
     * Handles changes to the <code>playing</code> attribute.
     *
     * @method _afterPlayingChange
     * @param e {Event} The playingChange event object
     * @protected
     */
	_afterPlayingChange: function (e) {
		if (this._timer) {
			this._timer.cancel();
			this._timer = undefined;
		}
		if (e.newVal) {
			this._timer = Y.later(this.get(INTERVAL) * 1000, this, function () {
				this.fire(EVT_SWITCH);
			}, null, true);
		}
	},
	
	/**
     * Dispatches the mouseEnter event.
     *
     * @method _onMouseEnter
     * @param e {DOMEvent} the mouseentter event object
     * @protected
     */
	_onMouseEnter: function () {
		if ( this.get(PLAYING) ) {
			this.pause();
		}
	},
	
	/**
     * Dispatches the mouseLeave event.
     *
     * @method _onMouseLeave
     * @param e {DOMEvent} the mouseleave event object
     * @protected
     */
	_onMouseLeave: function () {
		if ( !this.get(PLAYING) ) {
			this.play();
		}
	},
		
	/**
     * Default behavior for the switch event.
     *
     * @method _defSwitchFn
     * @param e {Event} the EventFacade for the switch custom event
     * @protected
     */
	_defSwitchFn: function (e) {
		var tabs = this.get(HOST);
		
		tabs.select( this.nextIndex(true) );
	},
	
	/**
     * play the tabs.
     *
     * @method play
     */
	play: function () {
		this._set(PLAYING, true);
	},
	
	/**
     * pause the playing tabs.
     *
     * @method pause
     */
	pause: function () {
		this._set(PLAYING, false);
	},
	
	/**
	 * Returns the Tabs's next index to be selected.
	 * 
     * @method nextIndex
     * @param circular {Boolean} Boolean indicating if the Tabs's last tab 
     * should be returned if the child has no next tab.
     * @return index {Number}. 
     */
	nextIndex: function (circular) {
        var tabs = this.get(HOST),
        	index = tabs.get(SELECTED_INDEX);

		if (index < tabs.size() - 1) {
			index = index + 1;
		} else if (circular) {
			index = 0;
		}

        return index;
   	},
    	
	/**
	 * Returns the Tabs's previous index to be selected.
	 * 
     * @method prevIndex
     * @param circular {Boolean} Boolean indicating if the Tabs's first tab 
     * should be returned if the child has no previous tab.
     * @return index {Number}. 
     */
   	prevIndex: function (circular) {
        var tabs = this.get(HOST),
        	index = tabs.get(SELECTED_INDEX);

		if (index > 0) {
			index = index - 1;
		} else if (circular) {
			index = tabs.size() - 1;
		}

        return index;
    }
});

Y.namespace('Plugin').TabsPlayer = TabsPlayer;

}, '3.3.0' ,{requires:['plugin', 'ntes-tabs-base', 'event-mouseenter']});

YUI.add('ntes-tabs', function(Y){}, '3.3.0' ,{use:['ntes-tabs-base', 'ntes-tabs-transition', 'ntes-tabs-player']});