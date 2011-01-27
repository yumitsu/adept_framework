Adept.Core.namespace('Adept.Logger.Writer');

Adept.Logger.Writer.FireBug = Class.create(Adept.Logger.Writer,
{

    log: function(message)
    {
      Try.these(function() { console.log("LOG:" + message);});
    },
    
    error: function(message)
    {
      Try.these(function() {console.error(message);});
    },
    
    debug: function(message)
    {
        Try.these(function() {console.debug(message);});
    },
    
    warn: function(message)
    {
        Try.these(function() {console.warn(message);});
    },
    
    info: function(message)
    {
        Try.these(function() {console.info(message);});
    },
    
    fine: function(message)
    {
        Try.these(function() {console.log("FINE: " + message);});
    }    
    
});
