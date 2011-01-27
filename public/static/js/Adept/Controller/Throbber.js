Adept.Core.namespace('Adept.Controller');


Adept.Controller.Throbber = Class.create(Adept.Controller,
{
    /**
     * Throbber offset
     */ 
    offsetX: 16,
    offsetY: 16,
    
    active: false,    
    
    mouseX: 0,
    mouseY: 0,
    
    processes: 0,
	
    init: function() 
    {
    	
    	this.hide();
    	
        Adept.Observer.addListener(document, 'mousemove', this.onMouseMove.bindAsEventListener(this));
        
        Adept.Observer.addListener(document, 'mouseover', this.onMouseOver.bindAsEventListener(this));
        Adept.Observer.addListener(document, 'mouseout', this.onMouseOut.bindAsEventListener(this));
        
        Adept.Observer.addListener(Adept.Application, 'idle', this.onIdle.bind(this));
        Adept.Observer.addListener(Adept.Application, 'processing', this.onBusy.bind(this));
        Adept.Observer.addListener(Adept.Application, 'busy', this.onBusy.bind(this));
    },
    
    onIdle: function()
    {
    	if (this.processes > 0) {
    		this.processes--;
	        if (this.processes == 0 && this.active) {
	            this.hide();
	        }
    	}
    },
    
    onBusy: function()
    {
        if (!this.active) {
        	this.show();
        }	
        this.processes++;
    },
    
    onMouseOver: function(event)
    {
        if (this.active) {
            this.setPosition(Event.pointerX(event), Event.pointerY(event));
            Element.show(this.getElement());
        }
    },
        
    onMouseOut: function(event)
    {
        if (this.active) {
            Element.hide(this.getElement());
        }
    },
    
    setPosition: function(mouseX, mouseY)
    {
        this.getElement().style.left = (mouseX + this.offsetX) + 'px';
        this.getElement().style.top = (mouseY + this.offsetY) + 'px';
    },
    
    onMouseMove: function(event) 
    {
    	// Save mouse pointer
        this.mouseX = Event.pointerX(event);
        this.mouseY = Event.pointerY(event);
        
        // Move if active
        if (this.active) {
            this.setPosition(this.mouseX, this.mouseY);
        }
    },

    show: function() 
    {
        this.setPosition(this.mouseX, this.mouseY);
        Element.show(this.getElement());
        this.active = true;
    },
    
    hide: function()
    {
        this.active = false;
        Element.hide(this.getElement());
    }    
	
});

