Adept.Core.namespace('Adept.Controller.Message');

Adept.Controller.Message.ToolBox = Class.create(Adept.Controller,
{
    loaded: false,
    open:false,
    cssPrefix: '',
    SHOW_EVENT: 'show',
    absoluteId: true,

    initialize: function($super,id, open, loaded, cssPrefix)
    {
        $super(id);
        this.loaded = loaded;
        this.open = open;
        this.cssPrefix = cssPrefix;
        
        if (!this.open) {
            this.collapse();
        }
        
        Adept.Core.disableSelection(this.getElementId() + ':head');
        
        Adept.Observer.addListener(this.getHeadElement(), 'click', this.onClick.bindAsEventListener(this));
        Adept.Observer.addListener(this.getHeadElement(), 'mouseover', this.onMouseOver.bindAsEventListener(this));
        Adept.Observer.addListener(this.getHeadElement(), 'mouseout', this.onMouseOut.bindAsEventListener(this));
        Adept.Observer.addListener(this.getHeadElement(), 'mousedown', this.onMouseDown.bindAsEventListener(this));
        Adept.Observer.addListener(this.getHeadElement(), 'mouseup', this.onMouseUp.bindAsEventListener(this));
    },
    
    getBodyElement: function() 
    {
        return $(this.getElementId() + ':body');
    },
    
    getHeadElement: function()
    {
        return $(this.getElementId() + ':head');
    },
    
    updateCss: function() 
    {
        if (this.open) {
            this.getElement().addClassName(this.cssPrefix + '-open');
            this.getElement().removeClassName(this.cssPrefix + '-closed');
        } else {
            this.getElement().removeClassName(this.cssPrefix + '-open');
            this.getElement().addClassName(this.cssPrefix + '-closed');
        }
        
        var headClass = this.cssPrefix + '-head';
        if (this.pressed) {
            headClass = headClass + ' ' + this.cssPrefix + '-head-pres';        
        } else if (this.hover) {
            headClass = headClass + ' ' + this.cssPrefix + '-head-hov';
        } 
        this.getHeadElement().className = headClass;
    },
    
    expand: function() {
    	
        if (!this.loaded) {
        	var request = Adept.Ajax.Backend.createRequest();
        	request.addEvent(this.getElementId(), this.SHOW_EVENT);
        	request.send();
            this.loaded = true;
        }
        
        this.open = true;
        Element.show(this.getBodyElement());
        this.updateCss();
        
        Adept.DataBag.save(this.isAbsoluteId() ? '_absolute' : Adept.Core.getPageId(), this.getElementId() + ':open', 1, { expires:7 });
    },
    
    collapse: function() {
        this.open = false;
        Element.hide(this.getBodyElement());
        this.updateCss();
        Adept.DataBag.save(this.isAbsoluteId() ? '_absolute' : Adept.Core.getPageId(), this.getElementId() + ':open', 0, { expires:7 });
    },
    
    onClick: function(e) {
        if (this.open) {
            this.collapse();
        } else {
            this.expand();
        }
    },
    
    onMouseOver: function(e) {
        this.hover = true;
        this.updateCss();
    },
    
    onMouseOut: function(e) {
        this.hover = false;
        this.pressed = false;
        this.updateCss();
    },
    
    onMouseDown: function(e) {
        this.pressed = true;
        this.updateCss();
    },
    
    onMouseUp: function(e) {
        this.pressed = false;
        this.updateCss();
    },
    
    isAbsoluteId: function()
    {
    	return this.absoluteId;
    },
    
    setAbsoluteId: function(absoluteId)
    {
    	this.absoluteId = absoluteId;
    }

});

