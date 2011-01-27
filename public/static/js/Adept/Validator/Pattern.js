Adept.Core.namespace('Adept.Validator');

Adept.Validator.Pattern = Class.create(Adept.Validator.Abstract,
{
    pattern: null,
    
    initialize: function($super, componentId, pattern, event)
    {
        $super(componentId, event);
        this.pattern = pattern;
    },
    
    check: function()
    {
        var value = this.getComponent().value;
        if(value.strip() == ''){
            return true;
        }
        
        if (this.pattern.test(value)) {
            return true;
        }
        return false;

    }
    

});