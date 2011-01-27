Adept.Core.namespace('Adept');

/**
 * Asserts 
 * 
 */
Adept.Assert = 
{

    failed: function(message)
    {
        Adept.Logger.error(message);
    },

    isset: function(value) 
    {   
        if (!Adept.Core.isset(value)) {
            Adept.Assert.failed('Adept.Assert.isset: value is not set');
        }
    },
    
    isString: function(value) 
    {
        if (!Adept.Core.isset(value) || 'string' == typeof(value)) {
            Adept.Assert.failed('Adept.Assert.isString: value is not set');
        }
    },
    
    isInteger: function() 
    {
    },
    
    elementExists: function(id)
    {
        if (!$(id)) {
            Adept.Assert.failed('Adept.Assert.elementExists: element ' + id + ' is not found');
        }
    },

    elementNotExists: function(id)    
    {
        if ($(id)) {
            Adept.Assert.failed('Adept.Assert.elementNotExists: element ' + id + ' is presents');
        }
    }
    
};