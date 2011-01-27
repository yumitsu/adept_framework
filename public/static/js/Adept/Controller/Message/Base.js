Adept.Core.namespace('Adept.Controller.Message');

Adept.Controller.Message.Base = Class.create(Adept.Controller,
{
    
    fieldId: null,

    initialize: function($super,id, fieldId)
    {
        $super(id);
        
        this.fieldId = fieldId;
        
        Adept.Observer.addListener(fieldId, 'invalid', this.onInvalid.bind(this));  
        Adept.Observer.addListener(fieldId, 'valid', this.onValid.bind(this));
    },
    
    onValid: function(event)
    {
        this.getElement().innerHTML = '';
    },
    
    onInvalid: function(event)
    {        
        var message = event.getOptions().message;
        if (Adept.Core.isset(message)) {
            this.getElement().innerHTML = message;
        }
    }

});

