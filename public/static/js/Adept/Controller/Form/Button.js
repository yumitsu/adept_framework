Adept.Core.namespace('Adept.Controller.Form');

Adept.Controller.Form.Button = Class.create(Adept.Controller.Form.AbstractButton,
{
	submit: function(event)
    {
        var formController = Adept.Application.getController(this.getFormId());
        formController.attachServerEvent(this.getElementId(), 'click');
        if (this.isAjax()){
            formController.setAjax(true);
        }
    	  
    }
    

});

