Adept.Core.namespace('Adept.Validator');

Adept.Validator.Equal = Class.create(Adept.Validator.Abstract,
{
    forId: null,
    
    initialize: function($super, componentId, forId, event)
    {
        $super(componentId, event);
        this.forId = forId;
    },
    
    getFor: function()
    {
        return $(this.forId);
    },
    
    check: function()
    {
        var value = this.getComponent().value;
        var forValue = this.getFor().value;
        return value.strip() == this.forValue.strip();
    }
});