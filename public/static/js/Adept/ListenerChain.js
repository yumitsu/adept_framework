Adept.Core.namespace('Adept');

/**
 * @private Internal class. Used in Adept.Observer. 
 */
Adept.ListenerChain = Class.create(
{
    listeners: [],
    
    initialize: function() 
    {
        this.listeners = [];
    },
            
    invokeChain: function(event)
    {
        for (var i = 0; i < this.listeners.length; i++) {
            if(event.stopped){
                break ;
            }
            listener = this.listeners[i];
            listener(event);
        }
    },
        
    /**
     * @todo Add listener calling priority. 
     */
    add: function(listener, priority)
    {
        this.listeners.push(listener);
    },
    
    remove: function(listener)
    {
        this.listeners = this.listeners.without(listener);
    },
    
    flush: function()
    {
    	this.listeners = [];
    },
    
    getListeners: function()
    {
        return this.listeners;
    },
    
    setListeners: function(listeners)
    {
        this.listeners = listeners;
    }

});
