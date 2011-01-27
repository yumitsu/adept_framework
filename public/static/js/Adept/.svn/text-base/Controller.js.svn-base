
Adept.Core.namespace('Adept');

/**
 * Base controller. 
 * @abstract
 */
Adept.Controller = Class.create(
{
    INIT_EVENT: 'init',

    id: null,
    
    initialize: function(id)
    {
    	// Controller ID
        this.id = id;
        // Register controller in application scope
        Adept.Application.registerController(id, this);
        
        // Custom initialization
        this.init();
        
        // Notify listeners                  
        Adept.Observer.notify(this.getElementId(), this.INIT_EVENT);
                
        Adept.Logger.info('Controller ' + id + ' has been initialized');
    },
    
    init: function()
    {    	
    },
    
    /**
     * Returns controller element.
     * 
     * @return DOMElement 
     */
    getElement: function() 
    {
        return $(this.id);
    },
    
    /**
     * @return String Controlled element ID.
     */
    getElementId: function()
    {
        return this.id;
    }
    
});
