Adept.Core.namespace('Adept.Validator');

Adept.Validator.Size = Class.create(Adept.Validator.Abstract,
{
    minValue: null,
    maxValue: null,
    
    initialize: function($super, componentId, minValue, maxValue, event)
    {
        $super(componentId, event);
        this.minValue = minValue;
        this.maxValue = maxValue;
    },
    
    check: function()
    {
        var value = this.getComponent().value;
        return (value > this.minValue && value < this.maxValue);
    }
});