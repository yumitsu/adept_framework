Adept.Core.namespace('Adept.Controller');
/**
 * Pager Controller
 */
 
Adept.Controller.Pager = Class.create(Adept.Controller,
{
    ajaxLoading: false,
    
    initialize: function($super, id) 
    {
        $super(id);
        
        oThis = this;
        var links = this.getElement().getElementsByTagName('a');
        $A(links).each(
            function(link) {
                Adept.Observer.addListener(link, 'click', oThis.onSend.bindAsEventListener(oThis));
            }
        );
    },
    
    onSend: function(event)
    {
        if (this.isAjaxLoading()) {
            var link =  event.element();
            var request = Adept.Ajax.Backend.createRequest(link.href);
            request.send();
            event.stop();
        }
    },
    
    isAjaxLoading: function() 
    {
        return this.ajaxLoading;
    },
    
    setAjaxLoading: function(ajaxLoading)
    {
        this.ajaxLoading = ajaxLoading;
    }
});