
Adept.Core.namespace("Adept.Controller.Form");
Adept.Controller.Form.AbstractButton = Class.create(Adept.Controller,
{
	formId:null,
	ajax: null,
	CLICK_EVENT: 'click',
	
	initialize: function($super, componentId, formId)
	{
		$super(componentId);
		if(Adept.Core.isset(formId)){
			this.formId = formId;
		}
		Adept.Observer.addListener(this.getElementId(), this.CLICK_EVENT, this.submit.bindAsEventListener(this));
	},
	
	submit: function(event)
	{

		
	},
	
	isAjax: function()
	{
		return this.ajax != null ? this.ajax : false;   
	},

	setAjax: function(ajax)
	{
		this.ajax = ajax;
	},
	
	getForm: function()
	{
		return $(this.formId);	
	},
	
	getFormId: function()
	{
		return this.formId;
	},
	
	setFormId: function(formId)
	{
		this.formId = formId;
	}
	
});

