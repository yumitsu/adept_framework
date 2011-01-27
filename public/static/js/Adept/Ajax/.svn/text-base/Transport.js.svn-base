Adept.Core.namespace('Adept.Ajax');
/**
 * Ajax.Request Wrapper
 * For Internal use
 */
Adept.Ajax.Transport = Class.create(Ajax.Request,
{

    initialize: function($super, url, options, onCompleteCallback, onExceptionCallback, onFailure)
    {
        Object.extend(options, { asynchronous: true, evalScripts: true, frequency: 5});
        
        this.onCompleteCallback = onCompleteCallback;
        
        
        options.onSuccess = (function()
        {
            
                this.onCompleteCallback(this.transport.responseText);
            
        }).bind(this);
        options.onException = onExceptionCallback;
        options.onFailure = onFailure;
        $super(url, options);    
    }

});


