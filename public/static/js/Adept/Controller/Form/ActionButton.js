
Adept.Core.namespace('Adept.Controller.Form');

Adept.Controller.Form.ActionButton = Class.create(Adept.Controller.Form.AbstractButton,
{
    submit: function(event)
    {
        var request = Adept.Ajax.Backend.createRequest();
        request.addEvent(this.getElementId(), this.CLICK_EVENT);
        request.send();
    }	
});
