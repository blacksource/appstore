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