Adept.Core.namespace("Adept.Ajax");
/**
 * @class send the Ajax Request
 * @event 'request' before request
 * @event 'complite' after response call back and execute
 */
Adept.Ajax.Request = Class.create(
{
    REQUEST_EVENT: 'request',
    COMPLITE_EVENT: 'complite',
    ERROR_EVENT: 'error',
    
    IDLE: 0,
    BUSY: 1,
    PROCESSING: 2,
    
    events: null,
    action: null,
    url: '',
    params: null,
    
    busyState: null, 
    
    method: 'POST',
    transport: null,

    /**
     * @constructor
     * Configure Ajax request
     * @param String|Hash params  
     * @param String url
     * @throws Adept.Exception.IlegalArgument if params not Hash or string  
     */
    initialize: function(params, url)
    {
    	this.events = new Object();
        this.params  = new Object();
        this.url = url;
        
        this.busyState = this.BUSY;
        
        if (Adept.Core.isset(params)) {
            this.setParams(params);
        }
    },
    
    /**
     * Send Ajax Request
     * @throws Ajax.Exception if can not send request
     */
    send: function()
    {
       this.beforeRequest();
        
       this.transport = new Adept.Ajax.Transport(this.getUrl(), {
            method: this.getMethod(),
            parameters: this.getRequestString()
        }, this.completeCallback.bind(this), this.exceptionCallback.bind(this), this.failureCallback.bind(this));
    },
    
    
    /**
     * Add listener on Request Event
     * @param Function listenser
     */
    addRequestListener: function(listener)
    {
        Adept.Observer.addListener(this, this.REQUEST_EVENT, listener);
    },
    
    /**
     * Add listener on Complite Event
     * @param Function 
     */
    addCompliteListener: function(listener) 
    {
        Adept.Observer.addListener(this, this.COMPLITE_EVENT, listener);
    },
    
    // Properites---------------------------------------------------------------
        
     addEvent: function(id, event)
     {
         this.events[id] = event;
     },
    
     setAction: function(action)
     {
         this.action = action;
     },
    
     getUrl: function()
     {
         return this.url || window.location.href;
     },
    
     setUrl: function(url)
     {
         this.url = url;
     },
    
     getParams: function()
     {
         return this.params;
     },
    
     setParams: function(params)
     {
         if (Object.isString(params)) {
             this.params = params.toQueryParams();
    
         } else {
             if(params instanceof Object){
             this.params = params;
            
             }else{
             throw new Adept.Exception.IlegalArgument('Invalid params');
             }
         }
     },
    
     getMethod: function()
     {
         return this.method;
     },
    
     setMethod: function(method)
     {
         this.method = method;
     },

     getBusyState: function()
     {
         return this.busyState;
     }, 
     
     setBusyState: function(busyState)
     {
         this.busyState = busyState;
     },     
     
     // Internal Methods---------------------------------------------------------
     
     /**
     * @private Internal Method 
     */
     getRequestString: function()
     {
     	this.params.ajax = 1;
        if(Adept.Core.isset(this.action)){
             this.params.action = this.action;
         }
        return Object.toQueryString(this.params) + "&" + this.makeEventString();
    },

    /**
     * @private Internal Method 
     */
    completeCallback: function(response)
    {
        Adept.Ajax.Processor.processResponse(response);
        this.afterComplite();
        Adept.Ajax.Backend.unregister(this);
    },
    
    exceptionCallback: function(transport, exception)
    {
        Adept.Logger.error("Ajax trouble: Can not parse response " + exception.message);
        Adept.Observer.notify(this, this.ERROR_EVENT);
        Adept.Ajax.Backend.unregister(this);
        
    },
    
    failureCallback: function()
    {
        Adept.Logger.error("Ajax trouble: request fallure");
        Adept.Observer.notify(this, this.ERROR_EVENT);
        Adept.Ajax.Backend.unregister(this);
    },
         
    /**
    * @private Internal Method 
    */
      
    beforeRequest: function()
    {
        if (this.busyState == this.BUSY) {
            Adept.Observer.notify(Adept.Application, Adept.Application.BUSY_EVENT);
        }
        
        Adept.Observer.notify(this, this.REQUEST_EVENT);
    },
    
    /**
     * @private Internal Method 
     */
     afterComplite:function()
     {
         Adept.Observer.notify(this, this.COMPLITE_EVENT);
         
         if (this.busyState == this.BUSY) {
             Adept.Observer.notify(Adept.Application, Adept.Application.IDLE_EVENT);
         }
     },
    
     /**
     * @private Internal method
     */
    makeEventString: function()
    {
         var eventsString = '';
         var first = true;
         for (key in this.events) {
             if(!first){
                 eventsString += '&';
         }
         first = false;
         eventsString += 'event[' + key + ']=' + encodeURIComponent(this.events[key]);
         }
        return eventsString;
    }
    
});

