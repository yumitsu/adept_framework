Adept.Core.namespace("Adept.Controller");

Adept.Controller.TabItem = Class.create(Adept.Controller,
 {

    tabulator: null,
    selector: null,
    loaded: true,
    forceUpdate: false,
    
    initialize: function($super, id, tabulator, loaded, forceUpdate)
    {
    	$super(id);
        this.tabulator = $(tabulator);
        this.forceUpdate  = Adept.Core.defaultValue(forceUpdate, false);
        
        this.selector = $(id + '_selector');
        this.loaded = loaded;
        
        Adept.Observer.addListener(this.selector, "click", this.toggle.bindAsEventListener(this));
        Adept.Observer.addListener(this.selector, "mouseover", this.onMouseOver.bindAsEventListener(this));
        Adept.Observer.addListener(this.selector, "mouseout", this.onMouseOut.bindAsEventListener(this));

    },
    
    getCssPrefix: function()
    {
    	return this.tabulator.getCssPrefix();
    },
    
    getContent: function()
    {
		var request = Adept.Ajax.Backend.createRequest();
		request.addEvent(this.getElementId(), 'show');
		request.send();
		this.loaded = true;
    },
    
    isUpdateNeeded: function()
    {
    	return (!this.loaded || this.forceUpdate) && this.getTabulator().getActiveItem() != this; 
    },
    
    show: function() 
    {
        if (this.isUpdateNeeded()) {
        	this.getContent();
        }
    
        var classes = this.selector.className.split(' ');
        classes.push(this.getCssPrefix() + '-tabselector-sel');
        this.selector.className = classes.join(' ');
        
        Element.show(this.getElementId());
        Adept.DataBag.save(Adept.Core.getPageId(), this.tabulator.getElementId() + "_selected", this.getElementId());
    },
    
    hide: function() {
        var classes = this.selector.className.split(' ');
        classes = classes.without(this.getCssPrefix() + '-tabselector-sel');
        this.selector.className = classes.join(' ');
        Element.hide(this.getElementId());
    },
    
    onMouseOver: function(e) {
        var classes = this.selector.className.split(' ');
        classes.push(this.getCssPrefix() + '-tabselector-hov');
        this.selector.className = classes.join(' ');
    },
    
    onMouseOut: function(e) {
        var classes = this.selector.className.split(' ');
        classes = classes.without(this.getCssPrefix() + '-tabselector-hov');
        this.selector.className = classes.join(' ');
    },
    
    toggle: function(e) {
        this.tabulator.toggle(this);
    },
    
    getTabulator: function()
    {
    	return this.tabulator;
    }
    
});

