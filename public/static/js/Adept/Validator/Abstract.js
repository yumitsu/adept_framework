Adept.Core.namespace('Adept.Validator');

Adept.Validator.Abstract = Class.create(
{
	VALID_EVENT: 'valid',
	INVALID_EVENT: 'invalid',
	
    componentId: null,
    message:'',
    
    
    valid: false,
    initialize:function(componentId, event)
    {
        this.componentId = componentId;
        if (Adept.Core.isset(event)) {
            Adept.Observer.addListener(this.getComponent(), event, this.validate.bindAsEventListener(this));
        } else {
            Adept.Observer.addListener(this.getComponent(), 'blur', this.validate.bindAsEventListener(this));
         
        }
    },
    
    assignToForm: function(form)
    {
        form.addValidator(this);
    },
    
    
    validate: function()
    {
        if(this.check()){
            this.valid = true;
            this.onValid();
        }else {
            this.valid = false;
            this.onInvalid();
        }
        
    },
    
    check: function()
    {
        
    },
    
    isValid: function()
    {
        return this.valid;    
    },
    
    onValid: function()
    {
        Adept.Observer.notify(this.getComponentId(), this.VALID_EVENT);
    },

    onInvalid: function()
    {
        Adept.Observer.notify(this.getComponentId(), this.INVALID_EVENT, {message: this.getMessage()});
    },
    
    getComponent: function()
    {
        return $(this.componentId);    
    },
    
    getComponentId: function()
    {
        return this.componentId;    
    },
    
    setComponentId: function(componentId)
    {
        this.component = component;
    },
    
    getMessage: function()
    {
        return this.message;
    },
    
    setMessage: function(message)
    {
        this.message = message;
    }
    
});
