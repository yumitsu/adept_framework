
Adept.Core.namespace('Adept.Controller.ColorPicker');

Adept.Controller.ColorPicker.ValueControl = Class.create(
{

    color: null,

    initialize: function(id) 
    {
        this.color = new Adept.Color();
    
        this.id = id;
        this.onValuesChanged = null;
        
        this.getHexInput().value = this.color.getHex();
        
        Event.observe(this.getHexInput(), 'keyup', this.onHexKeyUp.bindAsEventListener(this));
    },
    
    fireChangedEvent: function()
    {
        if (this.onValuesChanged) {
            this.onValuesChanged(this);
        }
    },
    
    getHexInput: function()
    {
        return $(this.id + ':hex');
    },
    
    onHexKeyUp: function(e) {
        if (e.element().value == '') {
            return;
        }
        this.validateHex(e.element().value);
        this.setValuesFromHex();
        this.fireChangedEvent();
    },
    
    validateHex: function(hex) 
    {
        hex = hex.replace(/[^A-Fa-f0-9]/g, '0');
        if (hex.length > 6) {
             hex = hex.substring(0, 6);
        }
        this.getHexInput().value = hex;
    },
    
    setValuesFromHex: function() 
    {
        this.color.setHex(this.getHexInput().value);
    },
    
    updateFromHsv: function(h, s, v) 
    {
        this.color.setHsv(h, s, v);
        this.getHexInput().value = this.color.getHex();
    }

});
