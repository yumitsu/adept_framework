Adept.Core.namespace('Adept.Validator');

Adept.Validator.Number = Class.create(Adept.Validator.Abstract,
{
    check: function()
    {
        var value = this.getComponent().value;
        if(value.strip() == ''){
            return true;
        }
        
        re = /^[\+\-]?\d+([\.]{1}\d+)?$/;
        if (re.test(value)) {
            return true;
        }
        return false;

    }
    

});