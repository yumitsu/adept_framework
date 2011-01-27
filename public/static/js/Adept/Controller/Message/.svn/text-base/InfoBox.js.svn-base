Adept.Core.namespace('Adept.Controller.Message');

Adept.Controller.Message.InfoBox = Class.create(Adept.Controller,
{
    closeIcon: null,

    initialize: function($super, id)
    {
        $super(id);
        this.closeIcon = $(id + '_Icon');
		
		Adept.Observer.addListener(this.closeIcon, 'mouseover', this.overIcon.bindAsEventListener(this));
		Adept.Observer.addListener(this.closeIcon, 'mouseout', this.outIcon.bindAsEventListener(this));
		Adept.Observer.addListener(this.closeIcon, 'click', this.hide.bindAsEventListener(this));
    },
	
	hide: function()
    {
        Element.removeClassName(this.getElementId(), 'a-infobox-show');
    },
	
	show:function(e)
    {
        this.getElement().style.left = this.calculateRelativeLeft(e.element()) + 'px';
        this.getElement().style.top = this.calculateRelativeTop(e.element()) + 'px';
        Element.addClassName(this.getElement(), 'a-infobox-show');
    },
    
    overIcon: function()
    {
        Element.addClassName(this.closeIcon, 'a-infobox-icon-selected');
    },
    
    outIcon: function()
    {
        Element.removeClassName(this.closeIcon, 'a-infobox-icon-selected');
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
            position  = offset.top - this.getElement().getHeight();
	    }
	    
	    return position;
	}

});