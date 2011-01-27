Adept.Core.namespace('Adept.Validator');

//Adept.Validator.UserConfirm  = Class.create();

Adept.Validator.UserConfirm = Class.create(Adept.Validator.Abstract,
{
    message: '',
    
    initialize: function($super,message)
    {
    	$super();
        this.message = message;       
    },
    
    check: function()
    {
        return confirm(this.message)
    }
}); 


