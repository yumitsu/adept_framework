Adept.Core.namespace('Adept');

Adept.Application =
{
    
    IDLE_EVENT: 'idle',
    PROCESSING_EVENT: 'processing',
    BUSY_EVENT: 'busy',

    backends: {},
    controllers: {},

    initialize: function()
    {
    },

    loaded: function()
    {
    },
  
    registerController: function(clientId, controller)
    {
        
        this.controllers[clientId] = controller;
        
    },
    
    /**
     * @param String|DOMElement Controller identifier or DOMElement.
     * @return Adept.Controller
     * 
     * @throws Adept.Exception If controller not found.
     */
     
     
    getController: function(element)
    {
        if (Object.isElement($(element))) {
        	   
               element = $(element).id;         
        }
        if (!Adept.Core.isset(this.controllers[element])) {
            throw  new Adept.Exception("Controller for " + element + " is not defined. ");
        }
        return this.controllers[element];
    }
    
};

// Magic functions 

function $AC(element) 
{
    return Adept.Application.getController(element);
}

Adept.Application.initialize();

 

