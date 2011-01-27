Adept.Core.namespace('Adept');

/**
 * Observer object.
 * 
 * Use this object for handling any kind of events.  
 */
Adept.Observer =
{
    propListeners: {},
    domListeners: {},

    /**
     * @param Element|String element DOMElement or element ID 
     * @param String event Kind of event, like 'click', 'mouseover' etc.
     * @param Object listener Callback function 
     * @param bool proprietary Flag shows that event is not standard browser event. 
     * 
     * @throws Adept.Exception.IllegalArgument If DOM event type is wrong.
     * @throws Adept.Exception.IllegalState If listener is not valid Object.
     */
    addListener: function(element, event, listener, proprietary)
    {
        proprietary = proprietary || false;
        
        if (!Adept.Core.isset(event)) {
            throw Adept.Exception.IllegalArgument("event undefined");
        }
        
        if (!(listener instanceof Object)) {
            throw new Adept.Exception.IllegalState("Illegal listener type");
        }
        
        
        if (this.isDomEvent(element, event) && !proprietary) {
            this.addDomListener(element, event, listener);
        } else {
            this.addProprietaryListener(element, event, listener);
        }
    },
    
    /**
     * Remove event listener.
     *  
     * @param Element|String element DOMElement or element ID 
     * @param String event Kind of event, like 'click', 'mouseover' etc.
     * @param Object listener Callback function 
     * @param bool proprietary Flag shows that event is not standard browser event. 
     * 
     * @throws Adept.Exception.IllegalArgument If element type is wrong.
     */
    removeListener: function(element, event, listener, proprietary)
    {
        var elementId = this.getElementUniqueId(element);
        element = $(element);
        
        if (this.isDomEvent(element, event) && !proprietary) {
        	
            if (!Adept.Core.isset(element.domListeners) || !Adept.Core.isset(element.domListeners[event])) {
                return;
            }
            //FIXME
                Event.stopObserving(element, event, element.domListeners[event].invokeListenersChain);
                element.domListeners[event] = null;
               
            // Clear array if it was last listener. 
//           if (element.domListeners[event].getListeners().length == 0) {
//           
//               element.domListeners[event] = null;
//            }
        } else {
            if (!Adept.Core.isset(element.propListeners[elementId]) && !Adept.Core.isset(element.propListeners[event])) {
                return;
            }
            element.propListeners[event].flush();
            if (element.propListeners[event].getListeners().length == 0) {
               element.propListeners[event] = null;
            }
        }
    },

    /**
     * Notify event listeners that proprietary event fired.
     * @param Element|String element DOMElement or element ID 
     * @param String event Kind of event, like 'click', 'mouseover' etc.
     * @param Object options Custom event options. 
     * 
     * @throws Adept.Exception.IllegalArgument If element type is wrong.  
     */
    notify: function(element, event, options)
    {
        Adept.Logger.info("[Notify] '" + element + "', Event: '" + event + "'");
      
        var controller = this.getObject(element);  
        
        
        if (!Adept.Core.isset(controller.propListeners) || !Adept.Core.isset(controller.propListeners[event])) {
            return;
        }
        
        var chain = controller.propListeners[event];
        var event = new Adept.Event($(element), event, options);
        chain.invokeChain(event);
    },

    /**
     * Flush any listeners.
     *  
     * @return void 
     */
    flush: function() {
        this.propListeners = {};
        this.domListeners = {};
//        Event.unloadCache();
    },
    
    clear: function(element, event)
    {
    	
    },
    
    // Private methods ---------------------------------------------------------
    
    
    getObject: function(element)
    {
    	if(Object.isString(element)) {
    	 if(!Adept.Core.isset($(element))){
                //return new Object();
            }
            element = $(element);
            return element;
        }
        return element;
    },
    /**
     * @private Internal method.
     */
    isDomEvent: function(element, event)
    {   
        return element == window || element == document || (Object.isElement($(element)) && Adept.Event.Dom.has(event));
    },
    
    /**
     * @private Internal method.
     */
    getElementUniqueId: function(element) 
    {
    	
        if(Object.isString(element)) {
            if(!Adept.Core.isset($(element))){
                return element;
            }
            element = $(element);
        }
        
        if(Object.isElement(element)){
        	return element.id;
        }
        Adept.Core.getUniqueId(element);
        
        return Adept.Core.getUniqueId(element);
    },    
    
    /**
     * @private Internal method.
     */
    addProprietaryListener: function(element, event, listener)
    {
        Adept.Logger.info("[Listen Propriertary Event] '" + element + "', Event '" + event + "'");

        var elementId = this.getElementUniqueId(element);
         var elementObject = this.getObject(element);
                         
        if (!Adept.Core.isset(elementObject.propListeners)) {
            elementObject.propListeners = new Object();
        }
        
        if(!Adept.Core.isset(elementObject.propListeners[event])){
            elementObject.propListeners[event] = new Adept.ListenerChain();
        }
        
        elementObject.propListeners[event].add(listener);
    },
        
    /**
     * @private Internal method.
     */
    addDomListener: function(element, event, listener)
    {
        Adept.Logger.info("[Listen DOM Event] '" + element + "', Event '" + event + "'");
                    
       var elementObject = this.getObject(element);
          
        if (!Adept.Core.isset(elementObject.domListeners)) {
            elementObject.domListeners = new Object();
        }
        
        if (!Adept.Core.isset(elementObject.domListeners[event])) {
            var chain = new Adept.ListenerChain();
            Event.observe(element, event, chain.invokeChain.bindAsEventListener(chain));
            elementObject.domListeners[event] = chain;
        }         
        
        elementObject.domListeners[event].add(listener);
        
    },
    
    notifyDomListeners: function(element, event)
    {
    	Try.these(
    	   function()
	    	   {
	    	   	var eventObj = document.createEvent("Events");
	             eventObj.initEvent(event, true, true);
	             element.dispatchEvent(eventObj);
	             
	    	   },
           function()
	    	   {
	    	   	 var eventObj = document.createEventObject();
				  element.fireEvent('on' + event,eventObj);
	    	   	
	    	   }
    	);
    }
    
};
