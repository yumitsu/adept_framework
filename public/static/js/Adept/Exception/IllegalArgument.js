Adept.Core.namespace('Adept');

Adept.Exception.IllegalArgument  = Class.create(Adept.Exception,
{
    
    initialize: function($super, message)
    {
        message = Adept.Core.defaultValue(message, 'Illegal argument');
        $super(message);
    }

});