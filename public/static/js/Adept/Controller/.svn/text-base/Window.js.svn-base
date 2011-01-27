Adept.Core.namespace("Adept.Controller");

Adept.Controller.Window  = Class.create(Adept.Controller,
{
	cssPrefix: 'a',
 	left: 300,
	top: 300,
	visible: false,
	modal:false,
	parent:null,
	center: false,
	ajaxLoading: false,
	forceUpdate: false,
	updated: false,
	draggable: false,
	
	initialize: function($super, id, draggable)
	{
	   	$super(id);
	   	this.draggable = draggable;
	   	Adept.Observer.addListener(id + 'CloseIcon', 'click', this.hide.bind(this));
   	    Adept.Observer.addListener(window, 'scroll', this.positionedAfterScrol.bindAsEventListener(this));
   	    Adept.Observer.addListener(this.getParent(), 'scroll', this.positionedAfterScrol.bindAsEventListener(this));
   	    Adept.Observer.addListener(window, 'resize', this.positionedAfterResize.bindAsEventListener(this));
   	    if(draggable){
   	    	this.draggable = new Draggable(this.getElement(),{handle:this.getElementId() + "_title"});
   	    }
	},
	
	updateContent: function()
	{
		var request = Adept.Ajax.Backend.createRequest();
		request.addEvent(this.getElementId(), 'show');
		request.send();
		
	},
	
	
	showRelated: function(event, placement, modal, disableAjax)
	{
	    disableAjax = Adept.Core.defaultValue(disableAjax, false);
	    modal = Adept.Core.defaultValue(modal, false);
	    
	    this.setLeft(this.calculateRelativeLeft(event.element()));
	    
	    this.setTop(this.calculateRelativeTop(event.element()));
	    this.show(modal, disableAjax);
	       
	},
	
	calculateRelativeLeft: function(relativeElement)
	{
	    var pageSize = Adept.Controller.Window.Utils.getPageSize();
	    
	    var offset = relativeElement.cumulativeOffset();
	    var width  = relativeElement.getWidth();
	    var position = offset.left + width + 5;
	    
	    if(position + this.getElement().getWidth() > pageSize.pageWidth){
            position  = offset.left - this.getElement().getWidth() - 5;
	    }
	    
	    return position;
	    
	},
	
	
	calculateRelativeTop: function(relativeElement)
	{
	    var pageSize = Adept.Controller.Window.Utils.getPageSize();
	    var offset = relativeElement.cumulativeOffset();
	    var position = offset.top;
	    
	    if(position + this.getElement().getHeight() > pageSize.pageHeight){
	    	if(pageSize.pageHeight - this.getElement().getHeight() > 0){
	    		position = pageSize.pageHeight - this.getElement().getHeight();
	    	}
	    }
	    
	    return position;
	},
	
	
	
	
	show: function(modal, disableAjax)
    {
    	
    	modal = Adept.Core.defaultValue(modal, false);
    	if(typeof(disableAjax) != 'boolean'){
    		disableAjax = false;
    	}
    	
    	disableAjax = Adept.Core.defaultValue(disableAjax, false);
    	
    	if(modal){
    		Adept.Controller.Window.Overlay.show(this.getElement());
    		this.modal = true;
    	}
    	if(this.ajaxLoading && !this.updated && !disableAjax){
    	   this.updateContent();
    	   if(!this.forceUpdate){
    	   	   this.updated = true;
    	   }	
    	}
    	
    	this.getElement().addClassName(this.getRealClassName('window-show'));
    	this.visible = true;
    },
    
    showCenter: function(modal, disableAjax)
    {
    	modal = Adept.Core.defaultValue(modal, false);
    	disableAjax = Adept.Core.defaultValue(disableAjax, false);
    	this.center = true;
    	this.centered();
    	this.show(modal, disableAjax);
        
    },
    
    hide: function()
    {
    	this.getElement().removeClassName(this.getRealClassName('window-show'));
    	this.visible = false;
    	if(this.modal){
    	  Adept.Controller.Window.Overlay.hide(this.getElement());
    	  this.modal = false;	
    	}
    	if(this.center){
    		this.center = false;
    	}
    },
	// Private Metgods---------------------------------------------------------
	getRealClassName: function(name)
	{
		return this.cssPrefix + '-' + name;
	},
	
	positionedAfterScrol: function(e)
	{
		
		if(this.center){
		  var windowScroll = Adept.Controller.Window.Utils.getWindowScroll(this.getParent());
		  this.getElement().style.top = this.getTop() +  windowScroll.top +  'px';
		  this.getElement().style.left = this.getLeft() + windowScroll.left + 'px';
		}
		
		
	},
	
	positionedAfterResize: function(e)
    {
    	if(this.center){
            this.centered();
            this.positionedAfterScrol();
    	}
        if(this.modal){
          Adept.Controller.Window.Overlay.calcSize();
        }
    },
	
	centered: function()
	{
		var pageSize = Adept.Controller.Window.Utils.getPageSize(this.getParent());
//		TODO some parameter add
        var dimensions = this.getElement().getDimensions();
        this.height = dimensions.height;
        this.width =  dimensions.width;    
		this.top = (pageSize.windowHeight - ( this.height))/2;
   		this.left = (pageSize.windowWidth - (this.width ))/2;
   		this.getElement().style.top = this.top + 'px';
   		this.getElement().style.left = this.left + 'px';
   		this.positionedAfterScrol();
	},
		
	// Properties---------------------------------------------------------------

	getCssPrefix: function() 
	{
		 return this.cssPrefix;
	},

	setCssPrefix: function (cssPrefix) 
	{
		 this.cssPrefix =  cssPrefix;
	},
	
	getWidth: function() 
	{
		 return this.getElement().getWidth();
	},

	setWidth: function (width) 
	{
		 this.getElement().style.width =  width + 'px';
	},
	
	getHeight: function() 
	{
		 return this.getElement().getHeight();
	},

	setHeight: function (height) 
	{
		 this.getElement().style.height =  height + 'px';
	},
	
	getLeft: function() 
	{
		 return this.left;
	},

	setLeft: function(left) 
	{
		 this.left =  left;
		 this.getElement().style.left = left + 'px';
	},
	
	getTop: function() 
	{
		 return this.top;
	},

	setTop: function(top) 
	{
		 this.top =  top;
		 this.getElement().style.top = top + 'px';
	},
	
	getParent: function() 
	{
		if(this.parent == null){
			this.parent = document.body;
		}
		 return this.parent;
		 
	},

	setParent: function (parent) 
	{
		 this.parent =  parent;
	},
	
	getAjaxLoading: function() 
	{
		 return this.ajaxLoading;
	},

	setAjaxLoading: function (ajaxLoading) 
	{
		 this.ajaxLoading =  ajaxLoading;
	},
	
	getForceUpdate: function() 
	{
		 return this.forceUpdate;
	},

	setForceUpdate: function (forceUpdate) 
	{
		 this.forceUpdate =  forceUpdate;
	},
	
	isDraggable: function() 
	{
		 return this.draggable;
	},

	setDraggable: function (draggable) 
	{
		 this.draggable =  draggable;
	}
	
});

