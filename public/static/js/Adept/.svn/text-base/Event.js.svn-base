 Adept.Core.namespace('Adept');

Adept.Event = Class.create(
{
    
    type: null,
    sender: null,
    stopped: false,
    options: {},
    /**
     * @constructor
     * @param Object sender object which fire this event
     * @param String eventName for example 'click' or 'blur' 
     * @param Hash options additional parameters
     */
    initialize: function(sender, eventName, options)
    {
        this.sender = sender;
        this.type = eventName;
        this.options = options || {};
    },

    // DOM compatibility -------------------------------------------------------
    
    /**
     * @return Element 
     */
    element: function()
    {
        return this.getSender();
    },
    
    stop: function()
    {
        this.stopped = true;
    },
    
    
    
    // Properties --------------------------------------------------------------
    
    getSender: function()
    {
        return this.sender;
    },
    
    setSender: function(sender)
    {
        this.sender = sender;
    },
    
    getEventName: function()
    {
        return this.type;
    },
    
    setEventName: function(eventName)
    {
        this.type = eventName;
    },
    
    getOptions: function()
    {
        return this.options;
    },
    
    setOptions: function(options)
    {
        this.options = options;
    },
    
    isStopped: function()
    {
    	return this.stopped;
    }
    
});
