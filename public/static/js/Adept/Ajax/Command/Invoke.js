Adept.Core.namespace('Adept.Ajax.Command');
Adept.Ajax.Command.Invoke = Class.create(Adept.Ajax.Command,
{
    
    /**
     * 'controllerId'
     * 'method'
     * 'params'
     */
     
     
    execute: function(options)
    { 
    	var controller = Adept.Application.getController(options['controllerId']);
    	var methodName = options['methodName'];
    	var params = $A(options['params']);
    	var paramString = '(';
    	var first = true;
    	params.each(
    	   function(item){
    	   	if(!first){
    	   		paramString +=','
    	   	}
    	   	paramString += item;
    	   	first = false;
    	   }
    	);
    	
      paramString += ");";
      methodName +=paramString;
      eval('Adept.Application.getController(options["controllerId"]).' + methodName);
    },

    undo: function()
    { }

});