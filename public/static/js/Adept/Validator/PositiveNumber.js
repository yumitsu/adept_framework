Adept.Core.namespace('Adept.Validator');

Adept.Validator.PositiveNumber = Class.create(Adept.Validator.Abstract,
{
    check: function()
    {
        var value = parseInt(this.getComponent().value);
        
        return value > 0;
    }
    

});