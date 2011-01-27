Adept.Core.namespace('Adept.Controller.Form');

Adept.Controller.Form.CommandLink = Class.create(Adept.Controller.Form.Button,
{
    submit: function($super,event)
    {
    	try{
            $super(event);
            Adept.Observer.notifyDomListeners(this.getForm(),'submit');

    	}catch(e)
    	{
    		this.createEventInput();
    	
    		this.getForm().submit();
    	}
	   
    },
    
    createEventInput: function()
    {
    	var input = document.createElement('input');
    	input.type = 'hidden';
    	input.name = 'event[' + this.getElementId() + ']';
    	input.value = 'click';
    	this.getForm().appendChild(input); 
    }
	    
});

    