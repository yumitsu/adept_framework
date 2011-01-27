Adept.Core.namespace('Adept.Validator');

Adept.Validator.Equal = Class.create(Adept.Validator.Abstract,
{
    valueArray: null,
    
    initialize: function($super, componentId, valueArray, event)
    {
        $super(componentId, event);
        this.valueArray = valueArray;
    },
    
    check: function()
    {
        var value = this.getComponent().value.strip();
        return this.valueArray.indexOf(value) >= 0;
    }
});