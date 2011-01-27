
Adept.Core.namespace('Adept.Controller');

Adept.Controller.Scroll = Class.create(Adept.Controller,
{
	
	bottomThreshold: 300,
	
	initialize: function($super, id)
	{
		$super(id);
	},
	
	scrollBottom: function()
	{
	    var scrollElement = this.getElement();
        var currentHeight = this.getCurrentHeight();
        var height = scrollElement.style.pixelHeight ? scrollElement.style.pixelHeight : scrollElement.offsetHeight;

        if (currentHeight - scrollElement.scrollTop - height < this.bottomThreshold) {
            this.makeScrollBottom();
        }
        scrollDiv = null;
	},
	
	getCurrentHeight: function()
	{
	    if (this.getElement().scrollHeight > 0) {
            return this.getElement().scrollHeight;
        } else { 
            if (this.getElement().offsetHeight > 0) {
                return this.getElement().offsetHeight;
            }
        }
        return 0;
	},
	
	makeScrollBottom: function()
	{
	    this.getElement().scrollTop = this.getCurrentHeight();
	}
	
});