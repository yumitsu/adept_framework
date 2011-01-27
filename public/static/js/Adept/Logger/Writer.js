Adept.Core.namespace('Adept.Logger');

Adept.Logger.Writer = Class.create(
{
    
    log: function(message)
    {
        throw "Abstract method called";
    },
    
    error: function(message)
    {
        throw "Abstract method called";
    },
    
    debug: function(message)
    {
        throw "Abstract method called";
    },
    
    warn: function(message)
    {
        throw "Abstract method called";
    },
    
    info: function(message)
    {
        throw "Abstract method called";
    },
    
    fine: function(message)
    {
        throw "Abstract method called";
    }    
    
});