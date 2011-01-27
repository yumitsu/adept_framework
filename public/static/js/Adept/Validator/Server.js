Adept.Core.namespace('Adept.Validator');

Adept.Validator.Server = Class.create(Adept.Validator.Abstract,
{
    validatorId: null,
    initialize: function($super, validatorId, componentId, event)
    {
        $super(componentId, event);
        this.validatorId = validatorId;
    },
    
    validate: function()
    {
        Adept.Observer.addListener(this.getComponentId(), Adept.Event.Type.Proprietary.VALID, this.onValid.bind(this));
        Adept.Observer.addListener(this.getComponentId(), Adept.Event.Type.Proprietary.INVALID, this.onInvalid.bind(this));
        var backend  = new Adept.Ajax.Backend();
        backend.addEvent(this.getValidatorId(), 'validate');
        backend.sendRequest(this.getValidatorId() + ':value=' +  this.getComponent().value);
    },
    
    onValid: function(e)
    {
        this.valid = true;
    },
    onInvalid: function(e)
    {
        this.valid = false;
    },
    
    getValidatorId: function()
    {
       return this.validatorId;
    },
    
    setValidatorId: function(validatorId)
    {
        this.validatorId = validatorId;
    }
});