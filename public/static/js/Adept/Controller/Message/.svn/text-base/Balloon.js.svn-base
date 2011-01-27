Adept.Core.namespace('Adept.Controller.Message');

Adept.Controller.Message.Balloon = Class.create(Adept.Controller.Message.Base,
{
    offsetLeft:10,
    offsetTop:-20,
    
    initialize: function($super,id, fieldId)
    {
        $super(id, fieldId);
        
        
    },


    onValid: function(event)
    {
        
        this.hide();        

    },

    onInvalid: function(event)
    {
        var valMessage = event.getOptions().message;
        
        $(this.getElementId() + ":message").innerHTML = valMessage;
        
        this.show();
    },
    
    calculatePosition: function()
    {
        Position.clone($(this.fieldId), this.getElement(), {offsetLeft:this.getOffsetLeft(), offsetTop:this.getOffsetTop()});
    },
    
    show: function()
    {
        this.calculatePosition();
        this.getElement().addClassName("a-balloon-show");
    },
    
    hide: function()
    {
        this.getElement().removeClassName("a-balloon-show");
    },
    
    
    getOffsetLeft: function()
    {
        return this.offsetLeft;
    },
    
    setOffsetLeft: function(offsetLeft)
    {
        this.offsetLeft = offsetLeft;
    },
    
    getOffsetTop: function()
    {
        return this.offsetTop;
    },
    
    setOffsetTop: function(offsetTop)
    {
        this.offsetTop = offsetTop;
    }

});