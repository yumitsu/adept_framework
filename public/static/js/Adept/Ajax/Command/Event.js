Adept.Core.namespace("Adept.Ajax.Command");
Adept.Ajax.Command.Event = Class.create(Adept.Ajax.Command,
{

    execute: function(params)
    { 
    	var element;
    	if(Adept.Core.isset(params['evaluateElement']) && params['evaluateElement'] == true){
    	    element  = eval(params['element']);	
    	} else{
    		element  = params['element'];
    	}
        Adept.Observer.notify(element, params['event']);
    },

    undo: function()
    { }
});