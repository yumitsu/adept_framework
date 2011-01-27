Adept.Core.namespace('Adept.Validator');

Adept.Validator.Email = Class.create(Adept.Validator.Abstract,
{
    check: function()
    {
        var value = this.getComponent().value;
        if(value.strip() == ''){
            return true;
        }
        
        re = /^[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/;
        if (re.test(value)) {
            return true;
        }
        return false;

    }
    

});