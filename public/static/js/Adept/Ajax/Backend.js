Adept.Core.namespace('Adept.Ajax');
/**
 * Adept.Ajax.Request factory
 * @see Adept.Ajax.Request 
 */
Adept.Ajax.Backend =  
{
    requests: [],    
    
    /**
     * Create request object
     * @param String|Hash params 
     * @param String url
     * @return Adept.Ajax.Request
     */
    createRequest: function(params, url)
    {
    	var request = new Adept.Ajax.Request(params, url);
    	this.register(request); 
    	return request;
    },
    
    /**
     * Register new request 
     * @param Adept.Ajax.Request
     */
    register: function(request)
    {
        this.requests.push(request);      
    },
    
    /**
     * Unregister reqiest
     * @param Adept.Ajax.Request
     */
    unregister: function(request)
    {
        this.requests = this.requests.without(request); 
    },
    
    flush: function()
    {
    	 this.requests = [];
    }
};