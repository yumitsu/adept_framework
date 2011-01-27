Adept.Core.namespace('Adept.Exception');

// depricated

Adept.Exception.Manager = 
{
    type: function(exception, type)
    {
        if(!(exception instanceof type)){
            
            throw exception;
            
        }
    }
};