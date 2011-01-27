Adept.Core.namespace('Adept.Validator');

Adept.Validator.Url = Class.create(Adept.Validator.Abstract,
{
    check: function()
    {
        var value = this.getComponent().value;
        if(value.strip() == ''){
            return true;
        }
        
        re = /^(?:(?:http|ftp|https):\/\/)?(((\w+\d*)[-]?(\w+\d*))\.)+(\w+\d*)+[\/]?$/;
        if (re.test(value)) {
            return true;
        }
        return false;

    }
    

});