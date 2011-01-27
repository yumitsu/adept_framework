
Adept.Core.namespace('Adept.Controller');
/**
 * Form Controller
 * @event 'beforeSubmit' After request is processed
 * @event 'afterSubmit' Before form submit
 */
 
Adept.Controller.Form = Class.create(Adept.Controller,
{
    action: null,
    ajax: false,
    validators: null,
    serverEvent: null,

    BEFORE_SUBMIT_EVENT: 'beforeSubmit',
    AFTER_SUBMIT_EVENT: 'afterSubmit',
    
    /**
     * Init form construct
     * @constructor
     * @param String id form identificator 
     */
    initialize: function($super, id) 
    {
        this.validators = new Array();
        $super(id);

        Adept.Observer.addListener(this.getElementId(), 'submit', this.onSubmit.bindAsEventListener(this));
        // todo BUG dirty fix,re-design!
//        this.getElement().enable();
    },
    
    /**
     * Add validators to form
     * @param Adept.Validator validator
     */
    addValidator: function(validator)
    {
        this.validators.push(validator);
    },
    
    /**
     * Add listeners for before submit event
     * @param Function listener
     */
    addBeforeSubmitListener: function(listener)
    {
        Adept.Observer.addListener(this.getElementId(), this.BEFORE_SUBMIT_EVENT, listener);
    },
    
    /**
     * Add listeners for after submit event
     * @param Function listener
     */
    addAfterSubmitListener: function(listener)
    {
        Adept.Observer.addListener(this.getElementId(), this.AFTER_SUBMIT_EVENT, listener);
    },
    
    /**
     * Form submit listener
     * @param Adept.Event| Event
     */
    onSubmit: function(event)
    {
        this.submit(event);
    },
    
    /**
     * submit form
     * @param Adept.Event| Event
     */
     
    submit: function(event)
    {
        
        if (this.validate()) {
            
            if (this.isAjax()) {
                return this.submitAjax(event);
            } else {
                    //add hudden field with server event
                if(this.serverEvent != null){
                    var field = document.createElement("INPUT");
                    field.type = 'hidden';
                    field.name = "event[" + this.serverEvent.sender + "]";
                    field.value = this.serverEvent.event;
                    this.getElement().appendChild(field);
                }
                return this.getElement().submit();
            }
        } else {
        event.stop();
        }   
    },
    
    attachServerEvent: function(sender, event)
    {
        this.serverEvent = {};
        this.serverEvent.sender = sender;
        this.serverEvent.event = event;
    },
    
        
    // Properties---------------------------------------------------------------

    getAction: function() 
    {
        return this.action || window.location.href;
    },
    
    setAction: function(action)
    {
        this.action = action;
    },
    
    isAjax: function() 
    {
        return this.ajax;
    },
    
    setAjax: function(ajax)
    {
        this.ajax = ajax;
    },    
    
    getMethod: function() 
    { 
        return this.getElement().method || 'post';
    },
    

    /**
     * @private Internal Methods
     */
    submitAjax: function(event)
    {
        try {
            var request = Adept.Ajax.Backend.createRequest(Form.serialize(this.getElementId()), this.getAction());
            if (this.serverEvent != null) {
                request.addEvent(this.serverEvent.sender, this.serverEvent.event);
            }
            
            Adept.Observer.addListener(request, "request", 
                function() { 
                    Adept.Logger.info("form " + this.getElementId() + " notify beforeSubmit");
                    Adept.Observer.notify(this.getElementId(), this.BEFORE_SUBMIT_EVENT);
                    Form.disable(this.getElementId());
                    // WARN: 
                    //Adept.Observer.removeListener(this.getElementId(), 'submit', this.onSubmit.bindAsEventListener(this));
                }.bind(this), true);
            
            Adept.Observer.addListener(request, "complite", 
                function() {
                    Form.enable(this.getElementId());
                    Adept.Logger.info("form " + this.getElementId() + " notify afterSubmit");
                    Adept.Observer.notify(this.getElementId(), this.AFTER_SUBMIT_EVENT);
                }.bind(this), true);
                
            Adept.Observer.addListener(request, "error", 
                function() {
                    Form.enable(this.getElementId());
                    Adept.Logger.error('Can not submit form: ');
                }.bind(this), true);
            request.send();

            //  Stop submit event propognation   
            event.stop();
        } catch(e) {            
            Adept.Logger.error('Can not submit form: ' + e.message);
            event.stop();
        }
    },
    
    
    /**
     * @private Internal Methods
     */
    validate: function()
    {   
        try {
            var valid = true;
            for (var i = 0; i < this.validators.length; i++) {
                if (!(this.validators[i] instanceof Adept.Validator.Server)) {
                    this.validators[i].validate();    
                    if (!this.validators[i].isValid()) {
                        valid = false;
                    }
                }
            }
            return valid;
        } catch(e) {
            alert(e);
        }
    }
    
});
    
    

